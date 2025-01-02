<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\RentabilidadeController;

class GerarRendimentosDiarios extends Command
{
    /**
     * O nome e a assinatura do comando no terminal.
     *
     * @var string
     */
    protected $signature = 'rendimentos:gerar';

    /**
     * A descrição do comando.
     *
     * @var string
     */
    protected $description = 'Gera rendimentos diários para os usuários com pacotes de investimento';

    /**
     * Execute o comando.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // Instancia o controller e chama o método de geração de rendimentos
            $rentabilidadeController = new RentabilidadeController();
            $rentabilidadeController->gerarRendimentosDiarios();

            $this->info('Rendimentos diários gerados com sucesso.');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Erro ao gerar rendimentos: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
