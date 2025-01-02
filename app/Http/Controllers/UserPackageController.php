<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPackageController extends Controller
{
    public function index(Request $request)
    {
        // Obter o usuário autenticado
        $user = $request->user();

        // Obter os pacotes que o usuário possui, com a quantidade
        $pacotes = $user->pacotes()->withPivot('quantidade')->get();

        return response()->json([
            'data' => $pacotes->map(function ($pacote) {
                return [
                    'id' => $pacote->id,
                    'nome' => $pacote->nome,
                    'rentabilidade_mensal' => $pacote->rentabilidade_mensal,
                    'custo' => $pacote->custo,
                    'quantidade' => $pacote->pivot->quantidade,
                    'created_at' => $pacote->pivot->created_at, // Data de quando o pacote foi adquirido
                ];
            }),
        ]);
    }
}
