<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescricaoToExtratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extratos', function (Blueprint $table) {
            $table->string('descricao')->nullable()->after('valor'); // Adiciona o campo 'descricao' após o campo 'valor'
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
            $table->dropColumn('descricao'); // Remove o campo 'descricao'
        });
    }
}
