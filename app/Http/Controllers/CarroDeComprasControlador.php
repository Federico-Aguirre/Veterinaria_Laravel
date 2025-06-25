<?php

namespace App\Http\Controllers;

use App\Models\CarroDeComprasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CarroDeComprasControlador extends Controller
{
    public function agregar(Request $request)
    {
        try {
            // Verificamos si el usuario está autenticado
            if (!Auth::check()) {
                return response()->json(['success' => false, 'error' => 'Usuario no autenticado'], 401);
            }
    
            // Obtenemos el id del cliente autenticado
            $id_cliente = Auth::id();
    
            // Obtenemos los productos del request
            $productos = $request->input('productos');
            
            // Validamos si los productos fueron enviados
            if (empty($productos)) {
                return response()->json(['success' => false, 'error' => 'No se enviaron productos'], 400);
            }
    
            // Cargamos el archivo JSON de productos
            $productosJson = json_decode(file_get_contents(storage_path('app/json/productos.json')), true);
    
            // Iteramos sobre los productos para guardarlos en la base de datos
            foreach ($productos as $producto) {
                // Validamos que el producto tenga los datos necesarios
                if (
                    !isset($producto['producto_id']) || 
                    !isset($producto['producto_cantidad']) || 
                    $producto['producto_cantidad'] <= 0
                ) {
                    continue;
                }
    
                // Buscar el producto en el JSON
                $productoJson = null;
                foreach ($productosJson as $prod) {
                    if ($prod['id'] == $producto['producto_id']) {
                        $productoJson = $prod;
                        break;
                    }
                }
    
                // Si el producto no se encuentra en el JSON, lo omitimos
                if (!$productoJson) {
                    continue;
                }
    
                // Obtener la categoría desde el JSON
                $categoria = $productoJson['categoria'];
    
                // Separar características
                $caracteristicas = $producto['producto_caracteristicas'];
                $carac = array_pad($caracteristicas, 5, null); // Llenamos las características faltantes con null
    
                // Creamos el producto en el carrito
                CarroDeComprasModel::create([
                    'id_cliente' => $id_cliente,
                    'producto_id' => $producto['producto_id'],
                    'producto_cantidad' => $producto['producto_cantidad'],
                    'producto_imagen' => $producto['producto_imagen'],
                    'producto_descripcion' => $producto['producto_descripcion'],
                    'producto_precio' => $producto['producto_precio'],
                    'producto_stock' => $producto['producto_stock'],
                    'producto_precio_total' => $producto['producto_precio'] * $producto['producto_cantidad'],
                    'producto_caracteristicas_1' => $carac[0],
                    'producto_caracteristicas_2' => $carac[1],
                    'producto_caracteristicas_3' => $carac[2],
                    'producto_caracteristicas_4' => $carac[3],
                    'producto_caracteristicas_5' => $carac[4],
                    'producto_categoria' => $categoria, // Usamos la categoría del JSON
                ]);
            }
    
            // Actualizamos la cantidad de productos en la sesión
            $cantidadDeProductosEnCarro = CarroDeComprasModel::where('id_cliente', $id_cliente)->sum('producto_cantidad');
            session(['cantidadDeProductosEnCarro' => $cantidadDeProductosEnCarro]);

            // Si todo sale bien, retornamos una respuesta exitosa
            return response()->json([
                'success' => true,
                'redirect' => route('carro_de_compras') // ← importante
            ]);
    
        } catch (\Exception $e) {
            // Si ocurre un error, lo logueamos y enviamos una respuesta con el error
            Log::error('Error al agregar productos al carrito: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function removerDelCarro($id)
    {
        try {
            $producto = CarroDeComprasModel::where('id', $id)
                                            ->where('id_cliente', Auth::id())
                                            ->first();
            if (!$producto) {
                return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
            }
    
            $producto->delete();
    
            // Actualizamos la cantidad de productos en la sesión después de eliminar un producto
            $cantidadDeProductosEnCarro = CarroDeComprasModel::where('id_cliente', Auth::id())->sum('producto_cantidad');
            session(['cantidadDeProductosEnCarro' => $cantidadDeProductosEnCarro]);
    
            return response()->json(['success' => true, 'message' => 'Producto eliminado del carrito',
            'nuevaCantidad' => $cantidadDeProductosEnCarro]);
        } catch (\Exception $e) {
            Log::error('Error al eliminar producto del carrito: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Hubo un problema al eliminar el producto'], 500);
        }
    }
    

    public function obtenerCantidadProductosEnCarro()
    {
        $idCliente = Auth::id();
    
        if ($idCliente) {
            $cantidad = DB::table('carro_de_compras')
                ->where('id_cliente', $idCliente)
                ->sum('producto_cantidad');
        } else {
            $cantidad = 0;
        }
    
        return response()->json(['cantidad' => $cantidad]);
    }
    

    public function mostrarCarro()
    {
        $productos = CarroDeComprasModel::where('id_cliente', Auth::id())->get();
    
        // Reconstruir las características como array
        foreach ($productos as $producto) {
            $producto->caracteristicas = array_filter([
                $producto->producto_caracteristicas_1,
                $producto->producto_caracteristicas_2,
                $producto->producto_caracteristicas_3,
                $producto->producto_caracteristicas_4,
                $producto->producto_caracteristicas_5,
            ]);
        }
    
        $total = $productos->sum(function ($producto) {
            return $producto->producto_precio * $producto->producto_cantidad;
        });
    
        return view('carro_de_compras', compact('productos', 'total'));
    }

    public function confirmarCompra(Request $request)
    {
        try {
            $usuarioId = Auth::id();

            // Aca se guarda la orden en una tabla de compras
            // y luego se vacia el carro:
            CarroDeComprasModel::where('id_cliente', $usuarioId)->delete();

            session(['cantidadDeProductosEnCarro' => 0]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error al confirmar compra: ' . $e->getMessage());
            return response()->json(['success' => false]);
        }
    }

// En el controlador de compra
public function finalizarCompra(Request $request)
{
    // Verificar si el pago fue completado
    if ($request->input('payment_status') === 'completed') {
        // Usar Auth::id() directamente
        $cliente_id = Auth::id();

        // Vaciamos el carrito de compras
        DB::table('carro_de_compras')
            ->where('id_cliente', $cliente_id)
            ->delete();

        return response()->json([
            'success' => true,
            'redirect' => route('compras_realizadas')
        ]);
    }

    // Si el pago no fue exitoso
    return response()->json(['success' => false, 'message' => 'Error al procesar el pago.']);
}
}
