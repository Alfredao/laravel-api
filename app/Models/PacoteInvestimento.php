<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacoteInvestimento extends Model
{
    use HasFactory;

    protected $table = 'pacotes_investimento'; // Nome da tabela

    protected $fillable = [
        'nome',
        'rentabilidade_mensal',
        'custo',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_pacotes')
            ->withPivot('quantidade') // Inclui o campo quantidade
            ->withTimestamps(); // Inclui os timestamps
    }
}
