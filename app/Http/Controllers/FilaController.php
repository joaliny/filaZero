<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FilaCache; // importa o model correto

class FilaController extends Controller
{
    public function index()
    {
        // Busca todas as filas do hospital 1, ordenadas pelo último update
        $filas = FilaCache::whereIn('hospital_id', [1])
    ->orderBy('updated_at', 'desc') // corrigido
    ->get();

        // Retorna para a view com as filas
        return view('fila.index', compact('filas'));
    }
}
