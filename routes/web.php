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

Route::get('/work-groups', [App\Http\Controllers\WorkGroupController::class, 'index'])
    ->name('work-groups.index');

Route::get('/work-groups/create', [App\Http\Controllers\WorkGroupController::class, 'create'])
    ->name('work-groups.create');

Route::post('/work-groups', [App\Http\Controllers\WorkGroupController::class, 'store'])
    ->name('work-groups.store');

Route::get('/work-groups/{workGroup}/edit', [App\Http\Controllers\WorkGroupController::class, 'edit'])
    ->name('work-groups.edit');

Route::put('/work-groups/{workGroup}', [App\Http\Controllers\WorkGroupController::class, 'update'])
    ->name('work-groups.update');

Route::delete('/work-groups/{workGroup}', [App\Http\Controllers\WorkGroupController::class, 'destroy'])
    ->name('work-groups.destroy');

Route::get('/work-groups/{workGroup}', [App\Http\Controllers\WorkGroupController::class, 'show'])
    ->name('work-groups.show');

# Rutas Work Groups Employees

Route::get('/work-group-employees', [App\Http\Controllers\WorkGroupEmployeeController::class, 'index'])
    ->name('work-group-employees.index');

Route::get('/work-group-employees/create', [App\Http\Controllers\WorkGroupEmployeeController::class, 'create'])
    ->name('work-group-employees.create');

Route::post('/work-group-employees', [App\Http\Controllers\WorkGroupEmployeeController::class, 'store'])    
    ->name('work-group-employees.store');

Route::get('/work-group-employees/{workGroupEmployee}/edit', [App\Http\Controllers\WorkGroupEmployeeController::class, 'edit'])
    ->name('work-group-employees.edit');

Route::put('/work-group-employees/{workGroupEmployee}', [App\Http\Controllers\WorkGroupEmployeeController::class, 'update'])
    ->name('work-group-employees.update');

Route::delete('/work-group-employees/{workGroupEmployee}', [App\Http\Controllers\WorkGroupEmployeeController::class, 'destroy'])
    ->name('work-group-employees.destroy');

# Rutas Marca Vehiculos

Route::get('/marcaVehiculos', [App\Http\Controllers\MarcaVehiculoController::class, 'index'])
    ->name('marcaVehiculos.index');

Route::get('/marcaVehiculos/create', [App\Http\Controllers\MarcaVehiculoController::class, 'create'])
    ->name('marcaVehiculos.create');

Route::post('/marcaVehiculos', [App\Http\Controllers\MarcaVehiculoController::class, 'store'])
    ->name('marcaVehiculos.store');

Route::get('/marcaVehiculos/{marcaVehiculo}/edit', [App\Http\Controllers\MarcaVehiculoController::class, 'edit'])
    ->name('marcaVehiculo.edit');

Route::put('/marcaVehiculos/{marcaVehiculo}', [App\Http\Controllers\MarcaVehiculoController::class, 'update'])
    ->name('marcaVehiculos.update');

Route::delete('/marcaVehiculos/{marcaVehiculo}', [App\Http\Controllers\MarcaVehiculoController::class, 'destroy'])
    ->name('marcaVehiculo.destroy');

# Rutas Skills

Route::get('/skills', [App\Http\Controllers\SkillController::class, 'index'])
    ->name('skills.index');

Route::get('/skills/create', [App\Http\Controllers\SkillController::class, 'create'])
    ->name('skills.create');

Route::post('/skills', [App\Http\Controllers\SkillController::class, 'store'])
    ->name('skills.store');

Route::get('/skills/{skill}/edit', [App\Http\Controllers\SkillController::class, 'edit'])
    ->name('skills.edit');

Route::put('/skills/{skill}', [App\Http\Controllers\SkillController::class, 'update'])
    ->name('skills.update');

Route::delete('/skills/{skill}', [App\Http\Controllers\SkillController::class, 'destroy'])
    ->name('skills.destroy');

