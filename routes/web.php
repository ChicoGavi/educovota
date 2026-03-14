<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/reparar-acceso', function () {
    $user = \App\Models\User::updateOrCreate(
        ['email' => 'admin@email.co'],
        [
            'name' => 'Administrador EducoVota',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123')
        ]
    );
    return '¡Éxito! Base de datos forzada. Ya puedes ir a /admin e ingresar con Correo: admin@email.co y Contraseña: admin123';
});
