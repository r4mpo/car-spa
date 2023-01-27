<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('modelo', 100);
            $table->string('placa', 8);
            $table->string('cor', 10);
            $table->string('status', 25);
            
            $table->unsignedBigInteger('valor');
            $table->unsignedBigInteger('ano');

            
            $table->unsignedBigInteger('quantidade_de_parcelas')->nullable(); // null
            $table->date('data_de_venda')->nullable(); // null
            
            // chave estrangeira
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carros');
    }
}
