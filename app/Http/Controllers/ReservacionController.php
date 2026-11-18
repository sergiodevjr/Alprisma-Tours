<?php

namespace App\Http\Controllers;

use App\Models\Paquete;
use App\Models\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservacionController extends Controller
{
    public function catalogo(Request $request)
    {
        $buscar = $request->input('buscar');
        
        $paquetes = Paquete::with('destino')
            ->where('cupos', '>', 0)
            ->when($buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('titulo', 'like', "%{$buscar}%")
                      ->orWhereHas('destino', function ($d) use ($buscar) {
                          $d->where('nombre', 'like', "%{$buscar}%");
                      });
                });
            })
            ->orderBy('fecha_salida')
            ->paginate(10)
            ->withQueryString();

        return view('reservaciones.catalogo', compact('paquetes', 'buscar'));
    }
    public function index()
    {
        $query = Reservacion::with(['paquete.destino', 'user'])->latest();

        if (!auth()->user()->esAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $reservaciones = $query->paginate(10);

        return view('reservaciones.index', compact('reservaciones'));
    }
    public function create(Paquete $paquete)
    {
        if ($paquete->cupos < 1) {
            return redirect()->route('reservaciones.catalogo')->with('error', 'No hay cupos disponibles para este paquete.');
        }
        return view('reservaciones.create', compact('paquete'));
    }
    public function store(Request $request, Paquete $paquete)
    {
        $datos = $request->validate([
            'personas' => 'required|integer|min:1|max:10',
        ]);

        try {
            DB::transaction(function () use ($paquete, $datos) {
                $actual = Paquete::lockForUpdate()->findOrFail($paquete->id);

                if ($actual->cupos < $datos['personas']) {
                    throw new \RuntimeException(
                        "Solo quedan {$actual->cupos} cupos disponibles para este paquete."
                    );
                }

                $actual->decrement('cupos', $datos['personas']);

                Reservacion::create([
                    'user_id' => auth()->id(),
                    'paquete_id' => $paquete->id,
                    'personas' => $datos['personas'],
                    'estado' => 'confirmada',
                ]);
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('reservaciones.index')->with('success', 'Reservación creada con éxito');
    }
    public function cancelar(Reservacion $reservacion)
    {
        abort_unless(
            auth()->user()->esAdmin() || $reservacion->user_id === auth()->id(),
            403
        );

        if ($reservacion->estado === 'cancelada') {
            return redirect()->route('reservaciones.index')->with('error', 'La reservación ya está cancelada');
        }

        DB::transaction(function () use ($reservacion) {
            Paquete::where('id', $reservacion->paquete_id)
                ->increment('cupos', $reservacion->personas);

                $reservacion->update(['estado' => 'cancelada']);
        });

        return redirect()->route('reservaciones.index')
            ->with('success', 'Reservación cancelada. Los cupos fueron devueltos.');
    }
}
