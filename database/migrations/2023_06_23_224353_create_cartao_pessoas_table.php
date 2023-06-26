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
        Schema::create('cartao_pessoa', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('user_id')->default(20)->unsigned();
            $table->integer('cartao_id')->unsigned();
            $table->date('cartaoPessoa_dtEntrega');
            $table->timestamps();

            $table->foreign('cartao_id')->references('id')->on('cartao');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartao_pessoa');
    }
};
