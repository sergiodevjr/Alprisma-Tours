<?php

use App\Http\Controllers\DestinoController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservacionController;
use App\Models\Destino;
use App\Models\Paquete;
use App\Models\Reservacion;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->esAdmin()) {
        $datos = [
            'Destinos' => Destino::count(),
            'Paquetes' => Paquete::count(),
            'Reservaciones confirmadas' => Reservacion::where('estado', 'confirmada')->count(),
            'Paquetes agotados' => Paquete::where('cupos', 0)->count(),
        ];
    } else {
        $datos = [
            'Mis reservaciones activas' => Reservacion::where('user_id', $user->id)
                ->where('estado', 'confirmada')->count(),
            'Paquetes disponibles' => Paquete::where('cupos', '>', 0)
                ->whereDate('fecha_salida', '>=', today())->count(),
        ];
    }

    return view('dashboard', compact('datos'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas solo para administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('dashboard');
    })->name('admin');

    Route::resource('destinos', DestinoController::class)->except('show');
    Route::resource('paquetes', PaqueteController::class)->except('show');
});

// Rutas para cualquier usuario con sesión
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/catalogo', [ReservacionController::class, 'catalogo'])->name('catalogo');
    Route::get('/reservaciones', [ReservacionController::class, 'index'])->name('reservaciones.index');
    Route::get('/reservaciones/crear/{paquete}', [ReservacionController::class, 'create'])->name('reservaciones.create');
    Route::post('/reservaciones/{paquete}', [ReservacionController::class, 'store'])->name('reservaciones.store');
    Route::patch('/reservaciones/{reservacion}/cancelar', [ReservacionController::class, 'cancelar'])->name('reservaciones.cancelar');
});

require __DIR__.'/auth.php';