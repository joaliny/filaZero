<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('admin.hospitais.create');
}


    /**
     * Store a newly created resource in storage.
     */
   // ...existing code...
public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
    ]);

    \App\Models\Hospital::create([
        'nome' => $request->nome,
    ]);

    return redirect()->route('admin.hospitais.index')->with('success', 'Hospital cadastrado com sucesso!');
}
// .

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
