<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Extrato;

class TesteSaldoSeeder extends Seeder
{
    public function run()
    {
        // Adicionar crédito
        Extrato::create([
            'user_id' => 1,
            'tipo' => 'credito',
            'valor' => 1000.00,
        ]);

        // Adicionar débito
        Extrato::create([
            'user_id' => 1,
            'tipo' => 'debito',
            'valor' => 300.00,
        ]);
    }
}

