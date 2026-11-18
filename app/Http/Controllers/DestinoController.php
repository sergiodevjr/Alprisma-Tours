<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destino;

class DestinoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $destinos = Destino::when($buscar, function ($query, $buscar){
            $query->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('pais', 'like', "%{$buscar}%");
        })->orderBy('nombre')->paginate(10)->withQueryString();

        return view('destinos.index', compact('destinos', 'buscar'));
        }
        public function create()
        {
            return view('destinos.create');
        }

        public function store(Request $request)
        {
            $datos = $request->validate([
               'nombre' => 'required|string|max:100',
                'pais' => 'required|string|max:100',
                'descripcion' => 'nullable|string|max:1000',
            ]);

            Destino::create($datos);

            return redirect()->route('destinos.index')->with('mensaje', 'Destino creado con éxito');
        }
        public function edit(Destino $destino)
        {
            return view('destinos.edit', compact('destino'));
        }
        public function update(Request $request, Destino $destino)
        {
            $datos = $request->validate([
                'nombre' => 'required|string|max:100',
                'pais' => 'required|string|max:100',
                'descripcion' => 'nullable|string|max:1000',
            ]);

            $destino->update($datos);

            return redirect()->route('destinos.index')->with('mensaje', 'Destino actualizado con éxito');
        }
        public function destroy(Destino $destino)
        {
            if ($destino->paquetes()->exists()) {
                return redirect()->route('destinos.index')->with('error', 'No se puede eliminar el destino porque tiene paquetes asociados');
            }
            $destino->delete();

            return redirect()->route('destinos.index')->with('mensaje', 'Destino eliminado con éxito');
        }
}
