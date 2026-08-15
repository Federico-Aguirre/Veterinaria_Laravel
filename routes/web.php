<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/registrarse', function () {
    return view('registrarse');
})->name('registrarse');

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/acercaDeNosotros.php', function () {
    return view('acercaDeNosotros');
})->name('acercaDeNosotros');

Route::get('/agregar_cliente.php', function () {
    return view('agregar_cliente');
})->name('agregar_cliente');

Route::get('/conexion.php', function () {
    return view('conexion');
})->name('conexion');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');


Route::get('/editar_perfil', function () {
    return view('editar_perfil');
})->name('editar_perfil');

Route::get('/agregar_mascota', function () {
    return view('agregar_mascota');
})->name('agregar_mascota_formulario');

Route::get('/editar_mascota/{id?}', function($id = null){
    return view('editar_mascota', ['mascotaId' => $id]);
})->name('editar_mascota_formulario');

Route::get('/ver_mascota', function () {
    return view('ver_mascota');
})->name('ver_mascota');

Route::get('/borrar_mascota', function () {
    return view('borrar_mascota');
})->name('borrar_mascota_formulario');


Route::get('/agregar_turno', function () {
    return view('agregar_turno');
})->name('agregar_turno_formulario');

Route::get('/editar-turno', function () {
    return view('editar_turno');
})->name('editar_turno');

Route::get('/ver_turno', function () {
    return view('ver_turno');
})->name('ver_turno');

Route::get('/borrar-turno', function () {
    return view('borrar_turno');
})->name('borrar_turno');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logOut');

use App\Http\Controllers\RecuperarClaveControlador;
Route::get('/recuperar_clave', [RecuperarClaveControlador::class, 'mostrarFormulario'])->name('recuperar_clave');
Route::post('/recuperar_clave', [RecuperarClaveControlador::class, 'enviar'])->name('recuperar_clave.enviar');

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

use App\Http\Controllers\SocialAuthController;
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);


Route::get('/api/productos', function () {
    $path = resource_path('json/productos.json');
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

Route::get('/ver_productos', function () {
    return view('ver_productos'); // Esta vista contiene <livewire:ver-productos />
})->name('ver_productos');


use App\Http\Controllers\CarroDeComprasControlador;
Route::get('/carro', [CarroDeComprasControlador::class, 'mostrarCarro'])->name('carro_de_compras');

Route::post('/carro/agregar', [CarroDeComprasControlador::class, 'agregar'])
    ->middleware('auth')
    ->name('agregar_al_carro');

Route::delete('/carro/remover/{id}', [CarroDeComprasControlador::class, 'removerDelCarro'])->name('carro.remover');

Route::post('/carro/confirmar-compra', [CarroDeComprasControlador::class, 'confirmarCompra']);


use App\Http\Controllers\ComprasRealizadasControlador;

Route::middleware(['auth'])->group(function () {
    Route::get('/compras_realizadas', [ComprasRealizadasControlador::class, 'mostrarCompras'])->name('compras.realizadas');
});

Route::post('/finalizar-compra', [ComprasRealizadasControlador::class, 'procesarCompra'])
    ->middleware('auth')
    ->name('finalizar_compra');

    
Route::get('/obtenerCantidadProductosEnCarro', [CarroDeComprasControlador::class, 'obtenerCantidadProductosEnCarro']);

use App\Http\Controllers\Auth\SocialController;
Route::get('/login/{provider}', [SocialController::class, 'redirect']);
Route::get('/login/{provider}/callback', [SocialController::class, 'callback']);