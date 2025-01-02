<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPacote extends Model
{
    use HasFactory;

    protected $table = 'usuario_pacotes'; // Nome da tabela

    protected $fillable = [
        'user_id',
        'pacote_investimento_id',
        'quantidade',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pacoteInvestimento()
    {
        return $this->belongsTo(PacoteInvestimento::class, 'pacote_investimento_id');
    }
}
