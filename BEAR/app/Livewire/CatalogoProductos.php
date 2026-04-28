<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;

class CatalogoProductos extends Component
{
    // Campo de búsqueda para filtrar los productos por nombre.  
    public $search='';

    // Arreglo para almacenar los productos obtenidos de la base de datos.
    public $productos=[];

    public function render()
    {
        // Si el campo de búsqueda está vacío, obtenemos todos los productos con stock mayor a 0. De lo contrario, filtramos los productos por nombre utilizando una consulta "like".
        if(empty($this->search)){
            $this->productos=Producto::where('stock','>',0)->get();
        }else{
            $this->productos=Producto::where('stock','>',0)->where('nombre','like','%'.$this->search.'%')->get();
        }

        // Retornamos la vista del componente Livewire, pasando los productos obtenidos.
        return view('livewire.catalogo-productos');
    }
}
