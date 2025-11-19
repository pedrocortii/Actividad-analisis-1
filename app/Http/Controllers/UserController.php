<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // Obtenemos todos los roles para poder asignarlos en un desplegable
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name', // Asegura que el rol exista
        ]);

        // 2. Creación del usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Asignación del rol
        $user->assignRole($request->role);

        // 4. Redirección con mensaje de éxito
        // (Asumimos que tendrás una vista 'users.index' en el futuro)
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra una lista de todos los usuarios.
     * (Añadido para que la redirección del store() funcione)
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        // Carga los roles del usuario para preseleccionar en el formulario
        $userRole = $user->roles->pluck('name')->first();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Actualiza un usuario existente en la base de datos.
     */
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 
            'password' => 'nullable|string|min:8|confirmed', 
            'role' => 'required|string|exists:roles,name', 
        ]);

        
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        
        $user->syncRoles($request->role); 

        
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario existente de la base de datos.
     */
    public function destroy(User $user)
    {
        // Regla 1: Impedir que un usuario se elimine a sí mismo.
        if (auth()->user()->id == $user->id) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar tu propio perfil de usuario.');
        }

        // Regla 2: Impedir que se elimine el último Administrador.
        if ($user->hasRole('Admin') && User::role('Admin')->count() <= 1) {
            return redirect()->route('users.index')->with('error', 'No se puede eliminar al único administrador del sistema.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
