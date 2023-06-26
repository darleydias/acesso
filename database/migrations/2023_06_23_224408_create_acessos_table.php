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
        Schema::create('acesso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id')->unsigned();
            $table->integer('cartao_id')->unsigned();
            $table->timestamp('acesso_DH')->useCurrent();
            $table->timestamps();

            $table->foreign('local_id')->references('id')->on('local');
            $table->foreign('cartao_id')->references('id')->on('cartao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acesso');
    }
};
