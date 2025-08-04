<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilaController;
use App\Http\Controllers\HospitalController;
use App\Models\Hospital;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $hospitais = Hospital::with('fila')->get();
    return view('dashboard', compact('hospitais'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [FilaController::class, 'index'])->name('filas.index');

Route::middleware(['auth'])->group(function () {
    Route::resource('hospitais', HospitalController::class);
});


// ...existing code...
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('hospitais', App\Http\Controllers\Admin\HospitalController::class);
});

Route::get('/admin/hospitais/create', [HospitalController::class, 'create'])->name('hospitais.create');


// Route::get('/dashboard', function () {
//     $hospitais = Hospital::with('fila')->get();
//     return view('dashboard', compact('hospitais'));
// });

// // rota para mostrar o formulário
// Route::get('/hospitais/create', [HospitalController::class, 'create'])->name('hospitais.create');

// // rota para salvar o hospital
// Route::post('/hospitais', [HospitalController::class, 'store'])->name('hospitais.store');


require __DIR__.'/auth.php';
