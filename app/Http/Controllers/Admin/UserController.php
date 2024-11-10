<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $users = User::all();
        } else {
            $users = User::where('id', Auth::user()->id)->get();
        }

        return view('user.index', compact('users'));

    }

    public function edit($id)
    {
        if (Auth::user()->hasRole('Admin')) {
            $users = User::all();
        } else {
            $users = User::where('id', Auth::user()->id);
        }

        $userToEdit = User::findOrFail($id);
        return view('user.index', compact('users', 'userToEdit'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:3|max:255',
        ],[
            'name.required' => 'El campo "Nombre" es obligatorio.',
            'email.required' => 'El campo "Email" es obligatorio.',
            'email.email' => 'El campo "Email" debe ser un correo electrónico válido.',
            'password.required' => 'El campo "Contraseña" es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 3 caracteres.',
        ]);

        $validatedData['email_verified_at'] = now();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);
        return redirect()->route('users');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:3|max:255',
        ], [
            'name.required' => 'El campo "Nombre" es obligatorio.',
            'email.required' => 'El campo "Email" es obligatorio.',
            'email.email' => 'El campo "Email" debe ser un correo electrónico válido.',
            'password.required' => 'El campo "Contraseña" es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 3 caracteres.',
        ]);

        if ($request->has('password') && !empty($request->password)) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users')->with('success', 'Usuario actualizado correctamente.');
    }

}
