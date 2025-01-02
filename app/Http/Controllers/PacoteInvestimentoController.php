<?php

namespace App\Http\Controllers;

use App\Models\PacoteInvestimento;
use App\Models\Extrato; // Modelo para a tabela de extratos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacoteInvestimentoController extends Controller
{
    // Mostrar um único pacote
    public function show($id)
    {
        $pacote = PacoteInvestimento::findOrFail($id);
        return response()->json($pacote);
    }
    public function comprar(Request $request)
    {
        $validated = $request->validate([
            'pacote_id' => 'required|exists:pacotes_investimento,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $pacote = PacoteInvestimento::findOrFail($validated['pacote_id']);
        $custoTotal = $pacote->custo * $validated['quantidade'];

        // Verifica o usuário autenticado
        $user = $request->user();

        // Verifica se o saldo é suficiente
        if ($user->saldo < $custoTotal) {
            return response()->json(['message' => 'Saldo insuficiente'], 400);
        }

        // Insere o débito no extrato
        $user->extratos()->create([
            'tipo' => 'debito',
            'valor' => $custoTotal,
            'operacao' => Extrato::OPERACAO_INVESTIMENTO,
            'descricao' => "Compra via saldo de {$validated['quantidade']} pacote(s) - {$pacote->nome}",
        ]);

        // Insere um novo registro no relacionamento usuário-pacotes
        $user->pacotes()->attach($pacote->id, [
            'quantidade' => $validated['quantidade'],
        ]);

        return response()->json(['message' => 'Compra realizada com sucesso']);
    }
}
