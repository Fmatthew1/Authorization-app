<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    public function getAdminRoleId()
    {
        //fetch the admin role ID from role table
        $adminRole = Role::where('name', 'admin')->first();
        return $adminRole ? $adminRole->id : null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Product $product): bool
    {
         return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return true;
        // Fetch the admin role ID dynamically
        $adminRoleId = $this->getAdminRoleId();

        // Allow update if the user has the admin role
        return $user->roles->contains('id', $adminRoleId);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return true;
    
        // Fetch the admin role ID dynamically
        $adminRoleId = $this->getAdminRoleId();

        // Allow update if the user has the admin role
        return $user->roles->contains('id', $adminRoleId);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return true;
    }

    public function confirm(User $user, Product $product): bool
    {

    
        // Fetch the admin role ID dynamically
        $adminRoleId = $this->getAdminRoleId();

        // Allow update if the user has the admin role
        return $user->roles->contains('id', $adminRoleId);
    }
}
