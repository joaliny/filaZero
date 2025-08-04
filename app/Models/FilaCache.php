<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilaCache extends Model
{
    protected $table = 'fila_cache';
    protected $fillable = [
        'hospital_id',
        'updated_at',
        'created_at',
    ];
}
