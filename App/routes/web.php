<?php

use App\Http\Controllers\ProfileController;
//use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/operacion/suma/{n1}/{n2}', function ($n1= 0,$n2=0) {
    $resultado= $n1+$n2;
    return $resultado;
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);
Route::get('/operacion/resta/{n1}/{n2}', function ($n1= 0,$n2=0) {
    $resultado= $n1-$n2;
    return $resultado;
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);
Route::get('/operacion/multiplicacion/{n1}/{n2}', function ($n1= 0,$n2=0) {
    $resultado= $n1*$n2;
    return $resultado;
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);
Route::get('/operacion/division/{n1}/{n2}', function ($n1= 0,$n2=0) {
    $resultado= $n1/$n2;
    return $resultado;
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);

Route::get('/saludar/{nombre}/{apellido?}', function ($name,$apellido= "Apellido") {
    return 'Hola '. $name.' '. $apellido;
})->where(['nombre' => '[a-zA-z]+', 'apellido' => '[a-z]+']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.store')->where(['id' => '[0-9]+']);
Route::get('/users-create', [UserController::class, 'store'])->name('users.store');
Route::get('/users-update/{id}', [UserController::class, 'update'])->name('users.store')->where(['id' => '[0-9]+']);
Route::get('/users-delete/{id}', [UserController::class, 'destroy'])->name('users.store')->where(['id' => '[0-9]+']);;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

require __DIR__.'/auth.php';
