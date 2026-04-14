<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;

class CategoriaController extends Controller
{
    /**
     * Muestra una lista de categorías ordenadas por id descendente y paginadas, con opciones para crear, editar y eliminar categorías.
     */

    public function __construct()
    {
        // Permiso para listar categorías
        $this->middleware('can:categoria.index')->only('index');

        // Permiso para crear categorías
        $this->middleware('can:categoria.create')->only(['create', 'store']);

        // Permiso para actualizar categorías
        $this->middleware('can:categoria.update')->only(['edit', 'update']);

        // Permiso para eliminar categorías
        $this->middleware('can:categoria.destroy')->only('destroy');
    }

    public function index()
    {
        // preparar la consulta base
        $query=Categoria::query();

        // aplicar filtro si se proporciona un término de búsqueda
        if ($buscar = request('buscar')) {
            $query->where('nombre', 'like', "%{$buscar}%");
        }


        // ordenar y paginar
        $categorias=$query->orderBy("id","DESC")->paginate(5);

        // mostrar la vista con las categorias
        return view("categoria.index",compact("categorias"));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     */
    public function create()
    {
        //
        return view("categoria.create");
    }

    /**
     *  Almacena una nueva categoría en la base de datos después de validar los datos del formulario.
     */
    public function store(CategoriaRequest $request)
    {
        //validar la informacion del formulario
        $datosValidos=$request->validated();

        //crear la categoria con los datos validados
        $categoria=Categoria::create($datosValidos);

        //redireccionar a la lista de categorias con un mensaje de exito
        return redirect()->route("categoria.index")->with('success','Categoria agragada correctamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Muestra el formulario para editar una categoría existente, cargando los datos de la categoría seleccionada.
     */
    public function edit( Categoria $categoria)
    {
        // obtener la categoria por su id
        $categoria=Categoria::findOrFail($id);
        return view("categoria.edit",["categoria"=>$categoria]);

    }

    /**
     * Actualiza una categoría existente en la base de datos después de validar los datos del formulario.
     */
    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        //
        $categoria->update($request->validated());
        return redirect()->route("categoria.index")->with('success','Categoria actualizada correctamente');

    }

    /**
     * Elimina una categoría de la base de datos, manejando posibles errores si la categoría tiene productos asociados.
     */
    public function destroy(Categoria $categoria)
    {
        //
        try{
           $categoria->delete();
            return redirect()->route("categoria.index")->with('success','Categoria eliminada correctamente');
        
        }catch(QueryException $e){
            if($e->getCode()==="23000"){
                return redirect()->back()->with('error','No se puede eliminar una categoria que tiene productos asociados');
            }
             return redirect()->back()->with('error','Error inesperado');
        }

        
    }
}
