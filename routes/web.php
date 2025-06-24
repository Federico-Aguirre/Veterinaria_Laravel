<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CrearUsuarioControlador;
Route::get('/registrarse', function () {
    return view('registrarse');
})->name('registrarse');
// Ruta para procesar el formulario de registro (POST)
Route::post('/registrarse', [CrearUsuarioControlador::class, 'store'])->name('procesarRegistro');

use App\Http\Controllers\LoginControlador;
// Ruta para mostrar el formulario de inicio de sesión (GET)
Route::get('/login', function () {
    return view('login');
})->name('login');
// Ruta para mostrar el formulario de inicio de sesión (POST)
Route::post('/login', [LoginControlador::class, 'login'])->name('procesarLogin');

use App\Http\Controllers\LeerJsonsControlador;
Route::get('/productos/json', [LeerJsonsControlador::class, 'leerJsons']);

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

Route::get('/agregar_turno.php', function () {
    return view('agregar_turno');
})->name('agregar_turno');

use App\Http\Controllers\ContactoControlador;

// Ruta para mostrar el formulario de contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Ruta para procesar el formulario y enviar el email
Route::post('/contacto/enviar', [ContactoControlador::class, 'enviar'])->name('contacto.enviar');





use App\Http\Controllers\VerPerfilControlador;
Route::middleware(['auth'])->get('/ver_perfil', [VerPerfilControlador::class, 'mostrar'])->name('ver_perfil');

use App\Http\Controllers\EditarPerfilControlador;
Route::middleware(['auth'])->group(function () {
    Route::get('/editar_perfil', [EditarPerfilControlador::class, 'editar'])->name('editar_perfil');
    Route::put('/editar_perfil', [EditarPerfilControlador::class, 'actualizar'])->name('actualizar_perfil');
});

use App\Http\Controllers\BorrarPerfilControlador;
Route::middleware(['auth'])->group(function () {
    Route::delete('/borrar_perfil', [BorrarPerfilControlador::class, 'borrar'])->name('borrar_perfil');
});

// En web.php
use App\Http\Controllers\AgregarMascotaControlador;
// Ruta para mostrar el formulario de agregar mascota
Route::get('/agregar_mascota', function () {
    return view('agregar_mascota');
})->name('agregar_mascota_formulario');
// Ruta para procesar el formulario de agregar mascota
Route::post('/agregar_mascota', [AgregarMascotaControlador::class, 'store'])->name('agregar_mascota');

use App\Http\Controllers\EditarMascotaControlador;
Route::get('/editar_mascota', function () {
    return view('editar_mascota');
})->name('editar_mascota_formulario');
// Ruta para mostrar el formulario con el select (sin ID)
Route::get('/editar_mascota', [EditarMascotaControlador::class, 'index'])->name('editar_mascota');
// Ruta para editar la mascota, con un parámetro id en la URL
Route::get('/editar_mascota/{id?}', [EditarMascotaControlador::class, 'edit'])->name('editar_mascota_formulario');
// Ruta para actualizar la mascota
Route::put('/editar_mascota/{id}', [EditarMascotaControlador::class, 'update'])->name('editar_mascota_update');

use App\Http\Controllers\VerMascotaControlador;
Route::get('/ver_mascota', [VerMascotaControlador::class, 'index'])->name('ver_mascota');

use App\Http\Controllers\BorrarMascotaControlador;
Route::get('/borrar_mascota', [BorrarMascotaControlador::class, 'index'])->name('borrar_mascota_formulario');
Route::delete('/borrar_mascota/{id}', [BorrarMascotaControlador::class, 'destroy'])->name('borrar_mascota');


use App\Http\Controllers\AgregarTurnoControlador;
// Ruta para mostrar el formulario de agregar turno
Route::get('/agregar_turno', [AgregarTurnoControlador::class, 'create'])->name('agregar_turno_formulario');
// Ruta para procesar el formulario de agregar turno
Route::post('/agregar_turno', [AgregarTurnoControlador::class, 'store'])->name('agregar_turno');
Route::post('/verificar-turno', [AgregarTurnoControlador::class, 'verificarTurno'])->name('verificar_turno');

use App\Http\Controllers\EditarTurnoControlador;
// Ruta para mostrar el formulario de seleccionar turno y editarlo
Route::get('/editar_turno', [EditarTurnoControlador::class, 'create'])->name('editar_turno');
// Ruta para procesar la actualización del turno
Route::post('/editar_turno/{id}', [EditarTurnoControlador::class, 'update'])->name('editar_turno_update');

use App\Http\Controllers\VerTurnoControlador;
Route::get('/ver_turno', [VerTurnoControlador::class, 'index'])->name('ver_turno');

use App\Http\Controllers\BorrarTurnoControlador;
Route::get('/borrar_turno', [BorrarTurnoControlador::class, 'index'])->name('borrar_turno');
Route::post('/borrar_turno/{id}', [BorrarTurnoControlador::class, 'destroy'])->name('borrar_turno_destroy');

Route::post('/logout', function () {
    Auth::logout(); // Cierra la sesión del usuario
    return redirect()->route('home'); // Redirige a la página de inicio
})->name('logOut');

use App\Http\Controllers\RecuperarClaveControlador;
Route::get('/recuperar_clave', [RecuperarClaveControlador::class, 'mostrarFormulario'])->name('recuperar_clave');
Route::post('/recuperar_clave', [RecuperarClaveControlador::class, 'enviar'])->name('recuperar_clave.enviar');

// Rutas para el restablecimiento de contraseña
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

use App\Http\Controllers\SocialAuthController;
// Google
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
// Facebook
Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

use App\Http\Controllers\VerProductoControlador;
Route::get('/ver_productos', [VerProductoControlador::class, 'mostrarProductos'])->name('ver_productos');
// API que usa JavaScript
Route::get('/api/productos/{categoria?}', [VerProductoControlador::class, 'apiProductos']);


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
