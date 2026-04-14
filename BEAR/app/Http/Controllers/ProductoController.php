<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;

class ProductoController extends Controller
{
    /**
     * Constructor del controlador que aplica middleware de permisos para controlar el acceso a las acciones del controlador según los permisos definidos en el sistema.
     * Aplica middleware de permisos para controlar el acceso a las acciones del controlador según los permisos definidos en el sistema.
     * 
     */
    public function __construct()
    {
        // Permiso para listar productos
        $this->middleware('can:producto.index')->only('index');

        // Permiso para crear productos
        $this->middleware('can:producto.create')->only(['create', 'store']);

        // Permiso para actualizar productos
        $this->middleware('can:producto.update')->only(['edit', 'update']);

        // Permiso para eliminar productos
        $this->middleware('can:producto.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        // obtener todas las categorías para el filtro
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
            $query->where('nombre', 'like', '%'.$request->buscar.'%');
        }

        // ordenar y paginar
        $productos = $query->orderBy('id', 'desc')->paginate(5);

        // mostrar la vista con los productos y las categorías
        return view('producto.index', compact('productos', 'categorias'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto, incluyendo un select con las categorías disponibles.
     */
    public function create()
    {
        // obtener las categorias para el select
        $categorias = Categoria::orderBy('id', 'desc')
        ->select('categorias.id', 'categorias.nombre')
        ->get();

        // mostrar la vista de creación con las categorías
        return view('producto.create', compact('categorias'));
    }

    /**
     * Almacena un nuevo producto en la base de datos después de validar los datos del formulario y manejar la imagen subida.
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
     *  Muestra un producto específico.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Muestra el formulario para editar un producto específico.
     */
    public function edit(Producto $producto)
    {
        // obtener las categorias para el select
        $categorias = Categoria::orderBy('id', 'desc')
        ->select('categorias.id', 'categorias.nombre')
        ->get();

        // mostrar la vista de edición con el producto y las categorías
        return view('producto.edit', compact('categorias','producto'));
    }

    /**
     * Actualiza un producto específico en la base de datos.
     */
    public function update(Request $request, Producto $producto)
    {
        // Validar los datos del formulario
        request()->validate([
            'id_categoria' => 'required',
            'nombre'=>'required',
            'descripcion' => 'nullable',
            'precio' => 'required',
            'precio_venta' => 'required',
            'stock' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Manejar la imagen
        if ($request->hasFile('imagen')) {

            // Verificar si el producto tiene una imagen existente y eliminarla
            if ($producto->imagen&& file_exists(public_path('img/' . $producto->imagen))) {
                // Eliminar la imagen anterior
                unlink(public_path('img/' . $producto->imagen));
            }
            
            // Guardar la nueva imagen
            $imagen = $request->file('imagen');

            // la imagen se guarda en la carpeta 'public/productos' y se obtiene su nombre
            $nombreImagen = $request->file('imagen')->store('productos', 'public');
        } else {

            // Si no se sube una nueva imagen, mantener la imagen existente
            $nombreImagen = $producto->imagen;
        }

        // Actualizar los datos del producto
        $data=$request->except('imagen');
        $data['imagen']=$nombreImagen;

        // Guardar los cambios en la base de datos
        $producto->update($data);

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('producto.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Elimina un producto específico de la base de datos.
     */
    public function destroy(Producto $producto)
    {
        // Intentar eliminar el producto y manejar posibles excepciones
        try{
            // Verificar si el producto tiene una imagen existente y eliminarla
            if ($producto->imagen) {
                // Eliminar la imagen del producto
                Storage::disk('public')->delete($producto->imagen);
            }

            // Eliminar el producto de la base de datos
            $producto->delete();

            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('producto.index')->with('success', 'Producto eliminado exitosamente.');
        }catch(QueryException $e){

            // Verificar si el error es debido a una restricción de clave foránea (código 23000)
            if($e->getCode() === '23000'){
            
                // Redirigir al usuario con un mensaje de error indicando que el producto no se puede eliminar debido a registros relacionados
                return redirect()->back()->with('error', 'No se puede eliminar el producto porque tiene registros relacionados.');
            }

            // Redirigir al usuario con un mensaje de error genérico para otros tipos de errores
            return redirect()->back()->with('error', 'Ocurrió un error inesperado al eliminar el producto.');
        }
    }
}
