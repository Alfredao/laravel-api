<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperacaoToExtratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extratos', function (Blueprint $table) {
            $table->enum('operacao', ['Saque', 'Deposito', 'Investimento', 'Proventos'])
                  ->nullable()
                  ->after('tipo'); // Adiciona a coluna operacao após tipo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extratos', function (Blueprint $table) {
            $table->dropColumn('operacao'); // Remove a coluna operacao
        });
    }
}
