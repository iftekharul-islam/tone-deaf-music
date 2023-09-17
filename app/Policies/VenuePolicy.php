<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Venue;
use App\Constants\RolesConstant;
use Illuminate\Auth\Access\Response;

class VenuePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasRole(RolesConstant::VENUE_MANAGERS) || $user->hasRole(RolesConstant::VENUE_STAFF)
            ? Response::allow()
            : Response::deny('You must be a venue manager or venue staff to view venues.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Venue $venue): Response
    {
        return $user->hasRole(RolesConstant::VENUE_MANAGERS) || $user->hasRole(RolesConstant::VENUE_STAFF)
            ? Response::allow()
            : Response::deny('You must be a venue manager or venue staff to view venues.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasRole(RolesConstant::VENUE_MANAGERS) || $user->hasRole(RolesConstant::VENUE_STAFF)
            ? Response::allow()
            : Response::deny('You must be a venue manager or venue staff to create venues.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Venue $venue): Response
    {
        return $user->hasRole(RolesConstant::VENUE_MANAGERS) || $user->hasRole(RolesConstant::VENUE_STAFF)
            ? Response::allow()
            : Response::deny('You must be a venue manager or venue staff to update venues.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Venue $venue): Response
    {
        return $user->hasRole(RolesConstant::VENUE_MANAGERS)
            ? Response::allow()
            : Response::deny('You must be a venue manager to delete venues.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Venue $venue): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Venue $venue): bool
    {
        //
    }
}
