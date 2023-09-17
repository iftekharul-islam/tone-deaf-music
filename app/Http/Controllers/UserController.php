<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $user = auth()->user();
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        $users = User::with('roles')
            ->latest()
            ->get();

        return Inertia::render('Users/Users', [
            'permissions' => $permissions,
            'users' => $users,
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $user = auth()->user();
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        return Inertia::render('Users/Create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $auth_user = auth()->user();
        $permissions = $auth_user->getAllPermissions()->pluck('name')->toArray();

        $user->load('roles');

        return Inertia::render('Users/Edit', [
            'permissions' => $permissions,
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['required'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles([$request->role]);
    }
}
