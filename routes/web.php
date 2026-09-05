<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RecuperarClaveControlador;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\CarroDeComprasControlador;
use App\Http\Controllers\ComprasRealizadasControlador;

/*
|--------------------------------------------------------------------------
| Vistas Públicas Estáticas
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::view('/registrarse', 'registrarse')->name('registrarse');
Route::view('/login', 'login')->name('login');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/acercaDeNosotros.php', 'acercaDeNosotros')->name('acercaDeNosotros');
Route::view('/agregar_cliente.php', 'agregar_cliente')->name('agregar_cliente');
Route::view('/conexion.php', 'conexion')->name('conexion');
Route::view('/editar_perfil', 'editar_perfil')->name('editar_perfil');
Route::view('/ver_productos', 'ver_productos')->name('ver_productos');

/*
|--------------------------------------------------------------------------
| Gestión de Mascotas y Turnos
|--------------------------------------------------------------------------
*/
Route::view('/agregar_mascota', 'agregar_mascota')->name('agregar_mascota_formulario');
Route::get('/editar_mascota/{id?}', function ($id = null) {
    return view('editar_mascota', ['mascotaId' => $id]);
})->name('editar_mascota_formulario');
Route::view('/ver_mascota', 'ver_mascota')->name('ver_mascota');
Route::view('/borrar_mascota', 'borrar_mascota')->name('borrar_mascota_formulario');

Route::view('/agregar_turno', 'agregar_turno')->name('agregar_turno_formulario');
Route::view('/editar-turno', 'editar_turno')->name('editar_turno');
Route::view('/ver_turno', 'ver_turno')->name('ver_turno');
Route::view('/borrar-turno', 'borrar_turno')->name('borrar_turno');

/*
|--------------------------------------------------------------------------
| Autenticación y Sesión
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logOut');

// Recuperación de clave personalizada
Route::controller(RecuperarClaveControlador::class)->group(function () {
    Route::get('/recuperar_clave', 'mostrarFormulario')->name('recuperar_clave');
    Route::post('/recuperar_clave', 'enviar')->name('recuperar_clave.enviar');
});

// Recuperación de clave nativa de Laravel
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('password/reset', 'reset')->name('password.update');
});

// Autenticación Social
Route::controller(SocialAuthController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
    Route::get('/auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('/auth/facebook/callback', 'handleFacebookCallback');
});

Route::controller(SocialController::class)->group(function () {
    Route::get('/login/{provider}', 'redirect');
    Route::get('/login/{provider}/callback', 'callback');
});

/*
|--------------------------------------------------------------------------
| Carrito de Compras y Pedidos
|--------------------------------------------------------------------------
*/
Route::controller(CarroDeComprasControlador::class)->group(function () {
    Route::get('/carro', 'mostrarCarro')->name('carro_de_compras');
    Route::delete('/carro/remover/{id}', 'removerDelCarro')->name('carro.remover');
    Route::post('/carro/confirmar-compra', 'confirmarCompra');
    Route::get('/obtenerCantidadProductosEnCarro', 'obtenerCantidadProductosEnCarro');
});

// Rutas protegidas que requieren iniciar sesión
Route::middleware(['auth'])->group(function () {
    Route::post('/carro/agregar', [CarroDeComprasControlador::class, 'agregar'])->name('agregar_al_carro');
    Route::get('/compras_realizadas', [ComprasRealizadasControlador::class, 'mostrarCompras'])->name('compras.realizadas');
    Route::post('/finalizar-compra', [ComprasRealizadasControlador::class, 'procesarCompra'])->name('finalizar_compra');
});

/*
|--------------------------------------------------------------------------
| Endpoints / API Internas
|--------------------------------------------------------------------------
*/
Route::get('/api/productos', function () {
    $path = resource_path('json/productos.json');
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
});