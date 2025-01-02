<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('extratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relaciona com a tabela users
            $table->enum('tipo', ['credito', 'debito']); // Tipo da movimentação
            $table->decimal('valor', 15, 2); // Valor da movimentação
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('extratos');
    }
};
