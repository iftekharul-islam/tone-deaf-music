<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Venue;
use App\Events\VenueCreated;
use App\Events\VenueUpdated;
use Illuminate\Http\Request;
use App\Constants\RolesConstant;
use Illuminate\Support\Facades\Cache;

class VenueController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Venue::class);

        $user = auth()->user();
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        $venues = Cache::remember('venues', 3600, function () use ($user) {
            return Venue::with('owner')
                ->when($user->hasRole(RolesConstant::VENUE_MANAGERS), function ($query) use ($user) {
                    return $query->where('owner_id', $user->id);
                })
                ->when($user->hasRole(RolesConstant::VENUE_STAFF), function ($query) use ($user) {
                    return $query->where('staff_id', $user->id);
                })
                ->latest()
                ->get();
        });

        return Inertia::render('Venues/Venues', [
            'permissions' => $permissions,
            'venues' => $venues,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Venue::class);

        $user = auth()->user();
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        $staffs = $user->staffs()
            ->latest()
            ->get();

        return Inertia::render('Venues/Create', [
            'permissions' => $permissions,
            'staffs' => $staffs,
        ]);
    }

    public function store(Request $request)
    {

        $this->authorize('create', Venue::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:venues,email',
        ]);

        $venue =  Venue::create([
            'owner_id' => auth()->user()->id,
            'staff_id' => $request->staff_id,
            'name' => $request->name,
            'is_private' => $request->is_private,
            'type' => $request->type,
            'is_active' => $request->is_active,
            'description' => $request->description,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        VenueCreated::dispatch($venue);

        Cache::forget('venues');
    }

    public function show(Venue $venue)
    {

        $this->authorize('view', $venue);

        $user = auth()->user();
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        $venue->load('staff');

        return Inertia::render('Venues/View', [
            'permissions' => $permissions,
            'venue' => $venue,
        ]);
    }

    public function edit(Venue $venue)
    {
        $this->authorize('update', $venue);

        $user = auth()->user();
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        $venue->load('staff');

        $staffs = $user->staffs()
            ->latest()
            ->get();

        return Inertia::render('Venues/Edit', [
            'permissions' => $permissions,
            'venue' => $venue,
            'staffs' => $staffs,
        ]);
    }

    public function update(Request $request, Venue $venue)
    {
        $this->authorize('update', $venue);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:venues,email,' . $venue->id,
        ]);

        $venue->update([
            'staff_id' => $request->staff_id,
            'name' => $request->name,
            'is_private' => $request->is_private,
            'type' => $request->type,
            'is_active' => $request->is_active,
            'description' => $request->description,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        Cache::forget('venues');

        VenueUpdated::dispatch($venue);
    }

    public function destroy(Venue $venue)
    {
        $this->authorize('delete', $venue);

        $venue->delete();
        Cache::forget('venues');
        VenueUpdated::dispatch($venue);
    }
}
