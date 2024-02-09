<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
// use App\Area;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', ['only' => ['index']]);
    }

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        // $areas = Area::get();
        return view('admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'lastname' => ['required'],
            'telefono' => ['required'],
            'documento' => ['required'],
            // 'areas_id' => ['required']
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lastname' => $request->lastname,
            'telefono' => $request->telefono,
            'documento' => $request->documento,
            // 'areas_id' => $request->areas_id
        ]);

        //avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/adminlte/dist/img/', $name);
            $user->avatar = $name;
            $user->save();
        }


        $user->assignRole($request->role);
        return redirect()->route('users.index')->with('flash', 'registrado');
    }
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        // $areas = Area::get();
        return view('admin.users.edit', compact('roles', 'user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            'lastname' => ['required'],
            'telefono' => ['required'],
            'documento' => ['required'],
        ]);

        // Actualizar solo si se proporciona una nueva contraseña y se activa la opción "Cambiar contraseña"
        if ($request->cambiar_pass == "SI" && $request->password) {
            $request->validate([
                'password' => ['required', 'confirmed'],
            ]);

            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Actualizar los otros campos sin considerar la contraseña
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'lastname' => $request->lastname,
            'telefono' => $request->telefono,
            'documento' => $request->documento,
        ]);

        // Actualizar avatar si se proporciona
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/adminlte/dist/img/', $name);
            $user->avatar = $name;
            $user->save();
        }

        // Actualizar roles
        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('flash', 'actualizado');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('flash', 'eliminado');
    }

    public function updateProfile(User $user, Request $request)
    {

        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'telefono' => $request->telefono,
            'documento' => $request->documento,
            // 'areas_id' => $request->areas_id
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/adminlte/dist/img/', $name);
            $user->avatar = $name;
            $user->save();
        }

        return redirect()->route('users.show', $user);
        // return redirect()->route('users.index')->with('flash', 'actualizado');
    }
}
