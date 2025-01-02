<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtratoController extends Controller
{
    public function index(Request $request)
    {
        // Recupera o usuário autenticado
        $user = $request->user();

        // Busca os extratos do usuário, ordenados por data (mais recentes primeiro)
        $extratos = $user->extratos()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Mapeia os extratos para incluir a descrição amigável de operação
        $extratos->getCollection()->transform(function ($extrato) {
            return [
                'id' => $extrato->id,
                'tipo' => $extrato->tipo,
                'valor' => $extrato->valor,
                'operacao' => $extrato->operacao_descricao, // Usando o acessor para descrição amigável
                'descricao' => $extrato->descricao,
                'created_at' => $extrato->created_at->toDateTimeString(),
            ];
        });

        // Retorna os extratos em formato JSON
        return response()->json($extratos);
    }
}
