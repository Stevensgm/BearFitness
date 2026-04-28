<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ////obtener carrito y cliente de prueba

        $carrito=Session::get('cart',[]);
        $cliente=Cliente::find(1);

        if(empty($carrito)){
           
            return redirect()->back()->with('error','El carrito esta vacio');
            
        }
        
        if (!$cliente) {
            
            return redirect()->back()->with('error', 'El cliente de prueba  no existe.');

        }

        try{  

            DB::transaction(function () use($carrito,$cliente){

             $totalVenta=0;
             

               $venta = Venta::create([
                    'cliente_id' => $cliente->id,    
                    'descuento' => 0,
                    'total' => 0,
                    'estado' => 'completada',
                ]);

                foreach($carrito as $item){

                    
                 $productoId = $item['producto']->id;
                 $cantidad = $item['cantidad'] ?? 0;
                 $producto = Producto::find($productoId);



                  if (!$producto || $producto->stock < $cantidad || $cantidad <= 0) {

                        $nombre = $producto ? $producto->nombre : 'Producto Desconocido';
                        throw ValidationException::withMessages([
                            'stock' => "El producto '{$nombre}' no tiene suficiente stock disponible."
                        ]);
                    }

                    $subtotal = $producto->precio * $cantidad;
                 $totalVenta += $subtotal;

                  DetalleVenta::create([
                        'venta_id' => $venta->id,
                        'producto_id' => $producto->id,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $producto->precio,
                        'subtotal' => $subtotal,
                    ]);

                  $producto->stock -= $cantidad;
                  $producto->save();

                }
                
                $venta->total = $totalVenta;
                $venta->save();


            });

             Session::forget('cart');
             return redirect()->back()->with('success', 'compra exitosa.');;

        }catch(ValidationException $e){
              return redirect()->back()->withErrors($e->errors()) ->withInput();;
        }catch(Exception $e){
            
                      dd('exepcoonajsdlkfjalksd..'+$e);
             return redirect()->back()->with('error', 'error transaccion no completada') ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //|
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
