<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'endereco',
        'telefone',
        'horario',
        'fonte_api',
    ];

    public function fila()
    {
        return $this->hasOne(FilaCache::class)->latest('atualizado_em');
    }
}
