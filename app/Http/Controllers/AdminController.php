<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Rutina;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProductos  = Producto::count();
        $totalRutinas    = Rutina::count();
        $totalClientes   = User::where('role', 'cliente')->count();
        $sinStock        = Producto::where('stock', 0)->count();

        return view('admin.dashboard', compact(
            'totalProductos',
            'totalRutinas',
            'totalClientes',
            'sinStock'
        ));
    }
}
