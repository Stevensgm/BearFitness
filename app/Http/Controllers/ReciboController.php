<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReciboController extends Controller
{
    public function generar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto  = Producto::findOrFail($request->producto_id);
        $cantidad  = $request->cantidad;
        $subtotal  = $producto->precio_venta * $cantidad;
        $iva       = $subtotal * 0.19;
        $total     = $subtotal + $iva;
        $numeroPedido = 'BF-' . strtoupper(uniqid());
        $fecha     = now()->format('d/m/Y H:i');
        $cliente   = auth()->user()->name;

        $pdf = Pdf::loadView('cliente.recibo', compact(
            'producto',
            'cantidad',
            'subtotal',
            'iva',
            'total',
            'numeroPedido',
            'fecha',
            'cliente'
        ));
        $pdf->setPaper('letter', 'portrait');

        return $pdf->stream('recibo-' . $numeroPedido . '.pdf');
    }
}
