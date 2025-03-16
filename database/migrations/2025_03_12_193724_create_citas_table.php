<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('idCita');
            $table->dateTime('fecha');
            $table->unsignedBigInteger('idDueno');
            $table->unsignedBigInteger('idMascota');
            $table->unsignedBigInteger('idVete');
            $table->string('tipoCita');
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('idDueno')->references('idDueno')->on('duenos');
            $table->foreign('idMascota')->references('idMascota')->on('mascotas');
            $table->foreign('idVete')->references('idVete')->on('veterinarios');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};