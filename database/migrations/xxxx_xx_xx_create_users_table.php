<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // SERIAL PRIMARY KEY
            $table->string('name', 100);
            $table->string('apellido')->nullable();
            $table->string('usuario');
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps(); // created_at & updated_at

            $table->string('cuil_cuit')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('piso')->default(0);
            $table->string('departamento')->nullable();
            $table->string('localidad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('dni')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
