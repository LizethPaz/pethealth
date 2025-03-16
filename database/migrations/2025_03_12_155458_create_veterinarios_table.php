<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('veterinarios', function (Blueprint $table) {
            $table->id('idVete');
            $table->string('nombreVete');
            $table->string('correo');
            $table->string('especialidad');
            $table->string('telefono');
            $table->timestamps();
            $table->softDeletes(); // Para implementar softDeletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('veterinarios');
    }
};