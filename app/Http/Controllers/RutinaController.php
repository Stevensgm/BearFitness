<?php

namespace App\Http\Controllers;

use App\Models\Rutina;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RutinaController extends Controller
{
    public function index(Request $request)
    {
        $query = Rutina::query();

        if ($request->filled('dia')) {
            $query->where('dia', $request->dia);
        }

        if ($request->filled('nivel')) {
            $query->where('nivel', $request->nivel);
        }

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $rutinas = $query->orderBy('dia')->paginate(8)->withQueryString();

        return view('admin.rutinas.index', compact('rutinas'));
    }

    public function create()
    {
        return view('admin.rutinas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'            => 'required|max:150',
            'descripcion'       => 'nullable',
            'dia'               => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'nivel'             => 'required|in:principiante,intermedio,avanzado',
            'duracion_minutos'  => 'required|integer|min:1',
            'grupo_muscular'    => 'nullable|max:100',
        ]);

        $data['activo'] = $request->has('activo') ? true : false;

        Rutina::create($data);

        return redirect()->route('admin.rutinas.index')
            ->with('success', 'Rutina creada correctamente.');
    }

    public function show(Rutina $rutina)
    {
        return view('admin.rutinas.show', compact('rutina'));
    }

    public function edit(Rutina $rutina)
    {
        return view('admin.rutinas.edit', compact('rutina'));
    }

    public function update(Request $request, Rutina $rutina)
    {
        $data = $request->validate([
            'nombre'            => 'required|max:150',
            'descripcion'       => 'nullable',
            'dia'               => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'nivel'             => 'required|in:principiante,intermedio,avanzado',
            'duracion_minutos'  => 'required|integer|min:1',
            'grupo_muscular'    => 'nullable|max:100',
        ]);

        $data['activo'] = $request->has('activo') ? true : false;

        $rutina->update($data);

        return redirect()->route('admin.rutinas.index')
            ->with('success', 'Rutina actualizada correctamente.');
    }

    public function destroy(Rutina $rutina)
    {
        $rutina->delete();

        return redirect()->route('admin.rutinas.index')
            ->with('success', 'Rutina eliminada correctamente.');
    }

    public function pdf(Request $request)
    {
        $query = Rutina::query();

        if ($request->filled('dia')) {
            $query->where('dia', $request->dia);
        }

        $rutinas = $query->orderBy('dia')->get();

        $pdf = Pdf::loadView('admin.pdf.rutinas', compact('rutinas'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('reporte-rutinas.pdf');
    }
}
