<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use Illuminate\Database\QueryException;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $categorias = Categoria::all();
        // preparar la consulta base
        $query=Producto::query();
        // filtrar por categoria
        if($request->filled('categoria')) {
            $query->where('id_categoria', $request->categoria);
        }
        // filtrar por stock
        if($request->stock ==('con')) {
            $query->where('stock', '>', 0);
        } elseif($request->stock ==('sin')) {
            $query->where('stock', '=', 0);
        }
        // filtrar por nombre
        if($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }
        // ordenar y paginar
        
        $productos = $query->orderBy('id', 'desc')->paginate(4);


        return view('producto.index', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::orderBy('id', 'desc')
        ->select('categorias.id', 'categorias.nombre')
        ->get();
        return view('producto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        
        // Validar los datos del formulario
        $data = $request->validated();

        // Manejar la imagen
        $nombreImagen = null;

        // Verificar si se ha subido una imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');

            // la imagen se guarda en la carpeta 'public/productos' y se obtiene su nombre
            $nombreImagen = $request->file('imagen')->store('productos', 'public');
        }

        // Agregar el nombre de la imagen al arreglo de datos
        $data['imagen']=$nombreImagen;

        // Guardar el producto en la base de datos
        Producto::create($data);

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('producto.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     *  muestra un producto específico.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
        request()->validate();

        if ($request->hasFile('imagen')) {
            if ($producto->imagen&& file_exists(public_path('img/' . $producto->imagen))) {
                // Eliminar la imagen anterior
                    unlink(public_path('img/' . $producto->imagen));
                }
            
            $imagen = $request->file('imagen');
            $nombreImagen = time().'_'.$imagen->getClientOriginalName();
            $imagen->move(public_path('img'), $nombreImagen);
        } else {
            $nombreImagen = $producto->imagen;
        }
        $data=$request->except('imagen');
        $data['imagen']=$nombreImagen;

        $producto->update($data);
        return redirect()->route('producto.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
        try{
            $producto->delete();
            return redirect()->route('producto.index')->with('success', 'Producto eliminado exitosamente.');
        }catch(QueryException $e){
        if($e->getCode() === '23000'){
            return redirect()->back()->with('error', 'No se puede eliminar el producto porque tiene registros relacionados.');
        }
            return redirect()->back()->with('error', 'Ocurrió un error inesperado al eliminar el producto.');
        }
    }
}
