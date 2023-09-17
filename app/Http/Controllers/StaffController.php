<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Constants\RolesConstant;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class StaffController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!Gate::allows('staffs.viewAny', $user)) {
            abort(403, 'You must be a venue manager to view staff.');
        }

        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        $staffs = $user->staffs()
            ->latest()
            ->get();

        return Inertia::render('Staffs/Staffs', [
            'permissions' => $permissions,
            'staffs' => $staffs,
        ]);
    }

    public function create()
    {
        $user = auth()->user();

        if (!Gate::allows('staffs.create', $user)) {
            abort(403, 'You must be a venue manager to create staff.');
        }

        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        return Inertia::render('Staffs/Create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (!Gate::allows('staffs.create', $user)) {
            abort(403, 'You must be a venue manager to create staff.');
        }

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],

        ]);

        $staff =  User::create([
            'manager_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $staff->assignRole(RolesConstant::VENUE_STAFF);
    }
}
