<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Detarmina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool   {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
      
    public function rules(): array  {

        // Definir las reglas de validación para los campos del producto
        $rules = [
            'id_categoria' => 'required',
            'nombre'=>'required',
            'descripcion' => 'nullable',
            'precio' => 'required',
            'precio_venta' => 'required',
            'stock' => 'required',
        ];
        
        // Imagen obligatoria en POST (crear)
        if ($this->isMethod('POST')) {
        $rules['imagen'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        // Imagen opcional en PUT/PATCH (actualizar)
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
        $rules['imagen'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    public function messages(): array   {
        return [
        'nombre.required' => 'El campo nombre es obligatorio.',
        'imagen.required' => 'La imagen es obligatoria.',
        'imagen.image' => 'El archivo debe ser una imagen.',
        'imagen.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.',
        'imagen.max' => 'El tamaño de la imagen no puede ser mayor a 2MB.',
        'precio.required' => 'El campo precio es obligatorio.',
        'precio_venta.required' => 'El campo precio de venta es obligatorio.',
        'stock.required' => 'El campo stock es obligatorio.',
        ];
    }
}