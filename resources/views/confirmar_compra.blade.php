@if (!isset($_COOKIE['profile_viewer_uid'])) {
    die("Cookie profile_viewer_uid no está definida");
} @endif

$cookie = $_COOKIE['profile_viewer_uid'];

include("conexion.php");
$connect = mysqli_connect($host, $user, $pass, $bd);

// Verificar si la conexión fue exitosa
@if (!$connect) {
    die("Error en la conexión: " . mysqli_connect_error());
} @endif

/* Consulta para obtener las "producto_id" de la tabla "carro_de_compras" 
y guardarlo en la variable $id_lista */
$query = "SELECT producto_id FROM carro_de_compras";
$resultado = mysqli_query($connect, $query);
$id_lista = [];

@while ($row = mysqli_fetch_assoc($resultado)) {
    $id_lista[] = $row['producto_id'];
} @endwhile

// Lista de archivos JSON a consultar
$archivos_json = [
    '../json/alimentos.json',
    '../json/camas.json',
    '../json/juguetes.json',
    '../json/otros.json',
    '../json/productos.json',
    '../json/transportadoras.json',
];

// Array para almacenar los datos modificados
$data_modificada = [];

// Recorrer las id obtenidas
@foreach ($id_lista as $id_a_buscar) {
    @foreach ($archivos_json as $archivo) {
        // Verificar si el archivo existe
        @if (!file_exists($archivo)) {
            die("El archivo JSON $archivo no existe.");
        } @endif

        // Leer el contenido del archivo JSON
        $json = file_get_contents($archivo);
        // Decodificar el JSON en un array asociativo
        $data = json_decode($json, true);

        @if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            die("Error al decodificar el JSON: " . json_last_error_msg());
        } @endif

        // Iterar sobre el array JSON para encontrar el objeto con el id deseado
        @foreach ($data as &$registro) { // Usar & para referenciar directamente el registro en $data
            @if ($registro['id'] == $id_a_buscar) {
                // Consulta para obtener la cantidad comprada
                $cantidadCompradaQuery = "SELECT producto_cantidad FROM carro_de_compras WHERE producto_id = " . $registro['id'];
                $resultadoCantidadComprada = mysqli_query($connect, $cantidadCompradaQuery);

                @if ($resultadoCantidadComprada && mysqli_num_rows($resultadoCantidadComprada) > 0) {
                    $cantidadCompradaRow = mysqli_fetch_assoc($resultadoCantidadComprada);
                    $cantidadComprada = $cantidadCompradaRow['producto_cantidad']; // Obtenemos la cantidad comprada
                    
                    // Modificar el valor del campo 'stock' en el json
                    $registro['stock'] -= $cantidadComprada; // Resta la cantidad comprada del stock
                } @else {
                    echo "No se encontró la cantidad para el producto con ID: " . $registro['id'];
                } @endif
                break; // Salir del bucle una vez encontrado el id
            } @endif
        } @endforeach

        // Guardar los datos modificados para este archivo
        $data_modificada[$archivo] = $data;
    } @endforeach
}

// Guardar los JSON modificados en la sesión
$_SESSION['json_modificados'] = $data_modificada;

// Consulta para insertar productos en compras_realizadas
@if (!mysqli_query($connect, "INSERT INTO compras_realizadas(id, id_cliente, producto_id, producto_cantidad, 
    producto_imagen, producto_descripcion, producto_precio, producto_stock, producto_caracteristicas_1,
    producto_caracteristicas_2, producto_caracteristicas_3, producto_caracteristicas_4, 
    producto_caracteristicas_5, producto_precio_total, fecha_de_compra)
    SELECT id, id_cliente, producto_id, producto_cantidad, producto_imagen, producto_descripcion, producto_precio, 
    producto_stock, producto_caracteristicas_1, producto_caracteristicas_2, producto_caracteristicas_3, 
    producto_caracteristicas_4, producto_caracteristicas_5, producto_precio_total, NOW()
    FROM carro_de_compras")) {
    error_log("Error en la consulta de inserción: " . mysqli_error($connect));
    exit(); // Finaliza el script sin generar salida visible
} @endif

// Borrar productos del carrito
@if (!mysqli_query($connect, "DELETE FROM carro_de_compras")) {
    die("Error en la consulta de borrado: " . mysqli_error($connect));
} @endif

// Borrar la cookie creada para confirmar la compra
setcookie("profile_viewer_uid", "", time()-3600);

// Resetear el número en el logo del carro ubicado en el header
$suma = mysqli_query($connect, "SELECT SUM(producto_cantidad) as total FROM carro_de_compras");
@if ($suma) {
    $rowSuma = mysqli_fetch_array($suma);
    $sumaResultado = $rowSuma['total'] ?? 0;  // Si es NULL, asignar 0
    $_SESSION["cantidadDeProductosEnCarro"] = $sumaResultado;
} @else {
    $_SESSION["cantidadDeProductosEnCarro"] = 0;
} @endif

// Cerrar la conexión
$connect->close();

// Redirigir a la página de compras realizadas
Header("Location: compras_realizadas.php");
exit(); // Finaliza el script después de la redirección