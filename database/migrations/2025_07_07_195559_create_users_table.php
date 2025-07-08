<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // SERIAL PRIMARY KEY
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();

            // Campos adicionales
            $table->string('usuario');
            $table->string('cuil_cuit')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('piso');
            $table->string('departamento');
            $table->string('localidad');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('apellido')->nullable();
            $table->string('dni')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};