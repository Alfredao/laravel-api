<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extrato extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tipo', 'operacao', 'valor', 'descricao'];

    // Constantes para os valores de operação
    const OPERACAO_SAQUE = 'Saque';
    const OPERACAO_DEPOSITO = 'Deposito';
    const OPERACAO_INVESTIMENTO = 'Investimento';
    const OPERACAO_PROVENTOS = 'Proventos';

    // Método para obter todas as operações possíveis
    public static function operacoes()
    {
        return [
            self::OPERACAO_SAQUE,
            self::OPERACAO_DEPOSITO,
            self::OPERACAO_INVESTIMENTO,
            self::OPERACAO_PROVENTOS,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Acessor para a descrição da operação
    public function getOperacaoDescricaoAttribute(): string
    {
        return match ($this->operacao) {
            self::OPERACAO_DEPOSITO => 'Depósito', // Converte para exibir com acento
            self::OPERACAO_SAQUE => 'Saque',
            self::OPERACAO_INVESTIMENTO => 'Investimento',
            self::OPERACAO_PROVENTOS => 'Proventos',
            default => 'Desconhecido',
        };
    }
}
