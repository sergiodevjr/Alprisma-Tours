<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\Paquete;
use Illuminate\Http\Request;

class PaqueteController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $paquetes = Paquete::with('destino')
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

        return view('paquetes.index', compact('paquetes', 'buscar'));
    }
        public function create()
    {
        $destinos = Destino::orderBy('nombre')->get();
        
        return view('paquetes.create', compact('destinos'));
    }
        public function store(Request $request)
    {
        $datos = $request->validate([
            'destino_id' => 'required|exists:destinos,id',
            'titulo' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'cupos' => 'required|integer|min:1',
            'fecha_salida' => 'required|date|after_or_equal:today',
        ]);
        paquete::create($datos);

        return redirect()->route('paquetes.index')->with('success', 'Paquete creado con éxito');
    }
        public function edit(Paquete $paquete)
    {
        $destinos = Destino::orderBy('nombre')->get();
        
        return view('paquetes.edit', compact('paquete', 'destinos'));
    }
 public function update(Request $request, Paquete $paquete)
    {
        $datos = $request->validate([
            'destino_id' => 'required|exists:destinos,id',
            'titulo' => 'required|string|max:150',
            'precio' => 'required|numeric|min:0',
            'cupos' => 'required|integer|min:0',
            'fecha_salida' => 'required|date',
        ]);

        $paquete->update($datos);

        return redirect()->route('paquetes.index')->with('success', 'Paquete actualizado con éxito');
    }
    public function destroy(Paquete $paquete)
    {
        if ($paquete->reservaciones()->exists()) {
            return redirect()->route('paquetes.index')->with('error', 'No se puede eliminar el paquete porque tiene reservaciones asociadas');
        }

        $paquete->delete();


        return redirect()->route('paquetes.index')->with('success', 'Paquete eliminado con éxito');
    }           
}
