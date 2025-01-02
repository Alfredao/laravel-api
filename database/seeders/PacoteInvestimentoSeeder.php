<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PacoteInvestimento;

class PacoteInvestimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PacoteInvestimento::create([
            'nome' => 'Pacote Básico',
            'rentabilidade_mensal' => 1.5, // Rentabilidade de 1.5%
            'custo' => 1000.00, // Custo de R$ 1000,00
        ]);

        PacoteInvestimento::create([
            'nome' => 'Pacote Avançado',
            'rentabilidade_mensal' => 2.0, // Rentabilidade de 2%
            'custo' => 5000.00, // Custo de R$ 5000,00
        ]);

        PacoteInvestimento::create([
            'nome' => 'Pacote Premium',
            'rentabilidade_mensal' => 2.5, // Rentabilidade de 2.5%
            'custo' => 10000.00, // Custo de R$ 10000,00
        ]);
    }
}
