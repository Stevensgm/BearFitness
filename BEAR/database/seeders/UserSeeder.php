<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Ejecuta el proceso de siembra para usuarios.
     */
    public function run(): void
    {
        // Crear un usuario administrador
        $user=new User();
        $user->name='Admin';
        $user->email='admin@gmail.com';
        $user->password=bcrypt('12345678');
        $user->save();        
        $user->assignRole('admin');

        $user=new User();
        $user->name='User';
        $user->email='user@gmail.com';
        $user->password=bcrypt('12345678');
        $user->save();
        $user->assignRole('user');
    }
}
