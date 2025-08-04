<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index() {
        $hospitais = Hospital::all();
        return view('hospitais.index', compact('hospitais'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
  {
    return view('hospitais.create'); // ou o caminho correto da sua view
 }


    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'horario' => 'nullable|string|max:100',
            'fonte_api' => 'nullable|string|max:255',
        ]);

        Hospital::create($request->all());

        return redirect()->route('hospitais.index')
                         ->with('success', 'Hospital cadastrado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
