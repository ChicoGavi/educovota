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

Route::get('/reset-total', function () {
    try {
        // 1. Limpiamos cualquier caché residual
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        
        // 2. Borramos y recreamos la base de datos limpia con la llave actual
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
        
        // 3. Reconectamos las imágenes
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        
        // 4. Te iniciamos sesión a la fuerza con el primer administrador
        $user = \App\Models\User::first();
        if ($user) {
            auth()->login($user);
            return redirect('/admin');
        }
        
        return 'Reset completado. Ve a /admin e ingresa con admin@email.co y contraseña: admin';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
