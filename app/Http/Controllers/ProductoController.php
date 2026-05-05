<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('stock')) {
            if ($request->stock === 'con') {
                $query->where('stock', '>', 0);
            } elseif ($request->stock === 'sin') {
                $query->where('stock', '=', 0);
            }
        }

        $productos = $query->orderBy('id', 'desc')->paginate(1)->withQueryString();

        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => 'required|max:150',
            'descripcion'  => 'nullable',
            'precio'       => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categoria'    => 'required|in:suplementos,ropa,accesorios',
            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombre = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('img/productos'), $nombre);
            $data['imagen'] = $nombre;
        }

        $data['activo'] = $request->has('activo') ? true : false;

        Producto::create($data);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        return view('admin.productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre'       => 'required|max:150',
            'descripcion'  => 'nullable',
            'precio'       => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categoria'    => 'required|in:suplementos,ropa,accesorios',
            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && file_exists(public_path('img/productos/' . $producto->imagen))) {
                unlink(public_path('img/productos/' . $producto->imagen));
            }
            $imagen = $request->file('imagen');
            $nombre = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('img/productos'), $nombre);
            $data['imagen'] = $nombre;
        } else {
            $data['imagen'] = $producto->imagen;
        }

        $data['activo'] = $request->has('activo') ? true : false;

        $producto->update($data);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->imagen && file_exists(public_path('img/productos/' . $producto->imagen))) {
            unlink(public_path('img/productos/' . $producto->imagen));
        }
        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    public function pdf(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $productos = $query->orderBy('nombre')->get();

        $pdf = Pdf::loadView('admin.pdf.productos', compact('productos'));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('reporte-productos.pdf');
    }
}
