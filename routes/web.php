<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/instalar-sistema', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true, '--seed' => true]);
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return '¡Instalación completada exitosamente! Ya puedes ir a /admin';
});
