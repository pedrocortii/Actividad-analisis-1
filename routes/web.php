<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# Rutas Tareas

Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'index'])
    ->name('tareas.index');

Route::get('/tareas/create', [App\Http\Controllers\TareaController::class, 'create'])
    ->name('tareas.create');

Route::post('/tareas', [App\Http\Controllers\TareaController::class, 'store'])
    ->name('tareas.store');

Route::get('/tareas/{tarea}/edit', [App\Http\Controllers\TareaController::class, 'edit'])
    ->name('tareas.edit');

Route::put('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'update'])
    ->name('tareas.update');

Route::delete('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'destroy'])
    ->name('tareas.destroy');

# Rutas Vehiculos

Route::get('/vehiculos', [App\Http\Controllers\VehiculoController::class, 'index'])
    ->name('vehiculos.index');

Route::get('/vehiculos/create', [App\Http\Controllers\VehiculoController::class, 'create'])
    ->name('vehiculos.create');

Route::post('/vehiculos', [App\Http\Controllers\VehiculoController::class, 'store'])
    ->name('vehiculos.store');

Route::get('/vehiculos/{vehiculo}/edit', [App\Http\Controllers\VehiculoController::class, 'edit'])
    ->name('vehiculos.edit');

Route::put('/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculoController::class, 'update'])
    ->name('vehiculos.update');

Route::delete('/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculoController::class, 'destroy'])
    ->name('vehiculos.destroy');

# Rutas Employees

Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])
    ->name('employees.index');

Route::get('/employees/create', [App\Http\Controllers\EmployeeController::class, 'create'])
    ->name('employees.create');

Route::post('/employees', [App\Http\Controllers\EmployeeController::class, 'store'])
    ->name('employees.store');

Route::get('/employees/{employee}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])
    ->name('employees.edit');

Route::put('/employees/{employee}', [App\Http\Controllers\EmployeeController::class, 'update'])
    ->name('employees.update');

Route::delete('/employees/{employee}', [App\Http\Controllers\EmployeeController::class, 'destroy'])
    ->name('employees.destroy');

# Rutas Work Groups


# Rutas Work Groups Employees