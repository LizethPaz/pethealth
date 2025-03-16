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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id('idMascota');
            $table->string('nomMascota');
            $table->integer('edadMascota');
            $table->string('colorMascota');
            $table->string('tipoMascota');
            $table->timestamps();
            $table->softDeletes(); // Añade la columna deleted_at para SoftDeletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};