<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('duenos', function (Blueprint $table) {
            $table->id('idDueno');
            $table->string('nombre');
            $table->unsignedBigInteger('idMascota');
            $table->string('celular');
            $table->string('direccion');
            $table->string('correo');
            $table->string('ciudad');
            $table->timestamps();
            $table->softDeletes(); // Añade la columna deleted_at para SoftDeletes
            
            // Clave foránea
            $table->foreign('idMascota')->references('idMascota')->on('mascotas')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duenos');
    }
};