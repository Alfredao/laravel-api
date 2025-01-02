<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacotesInvestimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacotes_investimento', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique(); // Nome do pacote
            $table->decimal('rentabilidade_mensal', 5, 2); // Rentabilidade mensal (em %)
            $table->decimal('custo', 10, 2); // Custo do pacote
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacotes_investimento');
    }
}
