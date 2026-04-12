<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    //
    public function pdfProductos()
    {
        $productos = Producto::select('id', 'nombre', 'descripcion', 'precio', 'precio_venta', 'stock', 'id_categoria')->orderBy('id', 'ASC')->get();
        $pdf = PDF::loadView('pdf.productos', [
            'productos' => $productos
        ]);
        $pdf->setPaper('carta', 'A4');
        return $pdf->stream();
    }
}
