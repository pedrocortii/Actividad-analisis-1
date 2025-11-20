<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtenemos todos los roles para poder asignarlos en un desplegable
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('pdf')) {
            return $this->exportPDF($request);
        }

        $query = User::with('roles');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->paginate(10);
        $roles = Role::all(); // Necesitamos los roles para el filtro en la vista

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
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
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
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

    /**
     * Exporta los usuarios a un archivo PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportPDF(Request $request)
    {
        $query = User::with('roles');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->get();
        
        $pdf = Pdf::loadView('users.pdf', compact('users'))
                  ->setPaper('a4', 'landscape');
        
        return $pdf->download('users.pdf');
    }
}