<?php

namespace App\Http\Controllers;

use App\Models\UsuarioPacote;
use App\Models\Extrato;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RentabilidadeController extends Controller
{
    /**
     * Gera rendimentos diários para todos os usuários com base nos pacotes que possuem.
     * Adiciona os rendimentos no extrato de cada usuário.
     *
     * @return void
     */
    public function gerarRendimentosDiarios()
    {
        // Obter a data atual
        $dataAtual = Carbon::now()->startOfDay();

        // Obter todos os usuários e seus pacotes
        $usuariosPacotes = UsuarioPacote::with('pacoteInvestimento', 'user')
            ->get()
            ->groupBy('user_id'); // Agrupa os pacotes por usuário

        DB::transaction(function () use ($usuariosPacotes, $dataAtual) {
            foreach ($usuariosPacotes as $userId => $pacotes) {
                $rentabilidadeTotal = 0;
                $quantidadeTotal = 0;

                foreach ($pacotes as $pacote) {
                    $pacoteInvestimento = $pacote->pacoteInvestimento;

                    if (!$pacoteInvestimento || $pacoteInvestimento->rentabilidade_mensal <= 0) {
                        continue; // Ignorar pacotes sem rentabilidade
                    }

                    // Calcular a rentabilidade diária
                    $rentabilidadeDiaria = ($pacoteInvestimento->custo * $pacoteInvestimento->rentabilidade_mensal / 100) / 30;
                    $rentabilidadeTotal += $rentabilidadeDiaria * $pacote->quantidade;
                    $quantidadeTotal += $pacote->quantidade;
                }

                if ($rentabilidadeTotal > 0) {
                    // Verificar se já foi gerado rendimento para este usuário nesta data
                    $rendimentoJaGerado = Extrato::where('user_id', $userId)
                        ->where('descricao', 'like', '%Proventos%')
                        ->whereDate('created_at', $dataAtual)
                        ->exists();

                    if (!$rendimentoJaGerado) {
                        // Adicionar crédito no extrato
                        Extrato::create([
                            'user_id' => $userId,
                            'tipo' => 'credito',
                            'operacao' => Extrato::OPERACAO_PROVENTOS,
                            'valor' => $rentabilidadeTotal,
                            'descricao' => "Proventos de {$quantidadeTotal} contrato(s) de investimento",
                        ]);
                    }
                }
            }
        });

        return response()->json(['message' => 'Rendimentos diários gerados com sucesso!']);
    }
}
