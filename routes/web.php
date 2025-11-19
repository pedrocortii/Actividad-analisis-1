<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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
    ->name('tareas.index')
    ->middleware('permission:ver tareas');

Route::get('/tareas/create', [App\Http\Controllers\TareaController::class, 'create'])
    ->name('tareas.create')
    ->middleware('permission:crear tareas');

Route::post('/tareas', [App\Http\Controllers\TareaController::class, 'store'])
    ->name('tareas.store')
    ->middleware('permission:crear tareas');

Route::get('/tareas/{tarea}/edit', [App\Http\Controllers\TareaController::class, 'edit'])
    ->name('tareas.edit')
    ->middleware('permission:editar tareas');

Route::put('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'update'])
    ->name('tareas.update')
    ->middleware('permission:editar tareas');

Route::delete('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'destroy'])
    ->name('tareas.destroy')
    ->middleware('permission:eliminar tareas');

# Rutas Vehiculos

Route::get('/vehiculos', [App\Http\Controllers\VehiculoController::class, 'index'])
    ->name('vehiculos.index')
    ->middleware('permission:ver vehiculos');

Route::get('/vehiculos/create', [App\Http\Controllers\VehiculoController::class, 'create'])
    ->name('vehiculos.create')
    ->middleware('permission:crear vehiculos');

Route::post('/vehiculos', [App\Http\Controllers\VehiculoController::class, 'store'])
    ->name('vehiculos.store')
    ->middleware('permission:crear vehiculos');

Route::get('/vehiculos/{vehiculo}/edit', [App\Http\Controllers\VehiculoController::class, 'edit'])
    ->name('vehiculos.edit')
    ->middleware('permission:editar vehiculos');

Route::put('/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculoController::class, 'update'])
    ->name('vehiculos.update')
    ->middleware('permission:editar vehiculos');

Route::delete('/vehiculos/{vehiculo}', [App\Http\Controllers\VehiculoController::class, 'destroy'])
    ->name('vehiculos.destroy')
    ->middleware('permission:eliminar vehiculos');

# Rutas Employees

Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])
    ->name('employees.index')
    ->middleware('permission:ver employees');

Route::get('/employees/create', [App\Http\Controllers\EmployeeController::class, 'create'])
    ->name('employees.create')
    ->middleware('permission:crear employees');

Route::post('/employees', [App\Http\Controllers\EmployeeController::class, 'store'])
    ->name('employees.store')
    ->middleware('permission:crear employees');

Route::get('/employees/{employee}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])
    ->name('employees.edit')
    ->middleware('permission:editar employees');

Route::put('/employees/{employee}', [App\Http\Controllers\EmployeeController::class, 'update'])
    ->name('employees.update')
    ->middleware('permission:editar employees');

Route::delete('/employees/{employee}', [App\Http\Controllers\EmployeeController::class, 'destroy'])
    ->name('employees.destroy')
    ->middleware('permission:eliminar employees');

# Rutas Work Groups

Route::get('/work-groups', [App\Http\Controllers\WorkGroupController::class, 'index'])
    ->name('work-groups.index')
    ->middleware('permission:ver work groups');

Route::get('/work-groups/create', [App\Http\Controllers\WorkGroupController::class, 'create'])
    ->name('work-groups.create')
    ->middleware('permission:crear work groups');

Route::post('/work-groups', [App\Http\Controllers\WorkGroupController::class, 'store'])
    ->name('work-groups.store')
    ->middleware('permission:crear work groups');

Route::get('/work-groups/{workGroup}/edit', [App\Http\Controllers\WorkGroupController::class, 'edit'])
    ->name('work-groups.edit')
    ->middleware('permission:editar work groups');

Route::put('/work-groups/{workGroup}', [App\Http\Controllers\WorkGroupController::class, 'update'])
    ->name('work-groups.update')
    ->middleware('permission:editar work groups');

Route::delete('/work-groups/{workGroup}', [App\Http\Controllers\WorkGroupController::class, 'destroy'])
    ->name('work-groups.destroy')
    ->middleware('permission:eliminar work groups');

Route::get('/work-groups/{workGroup}', [App\Http\Controllers\WorkGroupController::class, 'show'])
    ->name('work-groups.show')
    ->middleware('permission:ver work groups');

# Rutas Work Groups Employees

Route::get('/work-group-employees', [App\Http\Controllers\WorkGroupEmployeeController::class, 'index'])
    ->name('work-group-employees.index')
    ->middleware('permission:ver work group employees');

Route::get('/work-group-employees/create', [App\Http\Controllers\WorkGroupEmployeeController::class, 'create'])
    ->name('work-group-employees.create')
    ->middleware('permission:crear work group employees');

Route::post('/work-group-employees', [App\Http\Controllers\WorkGroupEmployeeController::class, 'store'])    
    ->name('work-group-employees.store')
    ->middleware('permission:crear work group employees');

Route::get('/work-group-employees/{workGroupEmployee}/edit', [App\Http\Controllers\WorkGroupEmployeeController::class, 'edit'])
    ->name('work-group-employees.edit')
    ->middleware('permission:editar work group employees');

Route::put('/work-group-employees/{workGroupEmployee}', [App\Http\Controllers\WorkGroupEmployeeController::class, 'update'])
    ->name('work-group-employees.update')
    ->middleware('permission:editar work group employees');

Route::delete('/work-group-employees/{workGroupEmployee}', [App\Http\Controllers\WorkGroupEmployeeController::class, 'destroy'])
    ->name('work-group-employees.destroy')
    ->middleware('permission:eliminar work group employees');

# Rutas Marca Vehiculos

Route::get('/marcaVehiculos', [App\Http\Controllers\MarcaVehiculoController::class, 'index'])
    ->name('marcaVehiculos.index')
    ->middleware('permission:ver marca vehiculos');

Route::get('/marcaVehiculos/create', [App\Http\Controllers\MarcaVehiculoController::class, 'create'])
    ->name('marcaVehiculos.create')
    ->middleware('permission:crear marca vehiculos');

Route::post('/marcaVehiculos', [App\Http\Controllers\MarcaVehiculoController::class, 'store'])
    ->name('marcaVehiculos.store')
    ->middleware('permission:crear marca vehiculos');

Route::get('/marcaVehiculos/{marcaVehiculo}/edit', [App\Http\Controllers\MarcaVehiculoController::class, 'edit'])
    ->name('marcaVehiculo.edit')
    ->middleware('permission:editar marca vehiculos');

Route::put('/marcaVehiculos/{marcaVehiculo}', [App\Http\Controllers\MarcaVehiculoController::class, 'update'])
    ->name('marcaVehiculos.update')
    ->middleware('permission:editar marca vehiculos');

Route::delete('/marcaVehiculos/{marcaVehiculo}', [App\Http\Controllers\MarcaVehiculoController::class, 'destroy'])
    ->name('marcaVehiculo.destroy')
    ->middleware('permission:eliminar marca vehiculos');

# Rutas Skills

Route::get('/skills', [App\Http\Controllers\SkillController::class, 'index'])
    ->name('skills.index')
    ->middleware('permission:ver skills');

Route::get('/skills/create', [App\Http\Controllers\SkillController::class, 'create'])
    ->name('skills.create')
    ->middleware('permission:crear skills');

Route::post('/skills', [App\Http\Controllers\SkillController::class, 'store'])
    ->name('skills.store')
    ->middleware('permission:crear skills');

Route::get('/skills/{skill}/edit', [App\Http\Controllers\SkillController::class, 'edit'])
    ->name('skills.edit')
    ->middleware('permission:editar skills');

Route::put('/skills/{skill}', [App\Http\Controllers\SkillController::class, 'update'])
    ->name('skills.update')
    ->middleware('permission:editar skills');

Route::delete('/skills/{skill}', [App\Http\Controllers\SkillController::class, 'destroy'])
    ->name('skills.destroy')
    ->middleware('permission:eliminar skills');

# Rutas Users

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])
    ->name('users.index')
    ->middleware('permission:ver usuarios');

Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])
    ->name('users.create')
    ->middleware('permission:crear usuarios');

Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])
    ->name('users.store')
    ->middleware('permission:crear usuarios');

Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])
    ->name('users.edit')
    ->middleware('permission:editar usuarios');

Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])
    ->name('users.update')
    ->middleware('permission:editar usuarios');

Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('permission:eliminar usuarios');


// Ruta Clientes
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])
    ->middleware('auth', 'role:cliente') // Aseguramos que solo clientes entren aquí
    ->name('clientes.index');

Route::resource('/work-orders', App\Http\Controllers\WorkOrderController::class)
    ->name('*', 'work-orders.index');
// Ruta: cambiar estado de una orden de trabajo
Route::post('/work-orders/{work_order}/estado', [App\Http\Controllers\WorkOrderController::class, 'changeEstado'])
    ->name('work-orders.changeEstado');

//Esta ruta usa el metodo POST por seguridad. 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');