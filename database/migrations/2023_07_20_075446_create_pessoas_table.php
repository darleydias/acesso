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
        Schema::create('pessoa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomeCompleto', 250);
            $table->string('sexo', 10);
            $table->timestamp('dtNasc')->nullable();
            $table->string('CPF', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('celular', 100)->nullable();
            $table->integer('id_setor')->unsigned();
            $table->integer('visitante')->nullable()->default(0);
            $table->string('path_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_setor')->references('id')->on('setor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas');
    }
};
