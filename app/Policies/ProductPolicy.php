<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    public function getUserRoleId()
    {
        //fetch the user role ID from role table
        $userRole = Role::where('name', 'user')->first();
        return $userRole ? $userRole->id : null;
    }

    public function getAdminRoleId()
    {
        //fetch the admin role ID from role table
        $adminRole = Role::where('name', 'admin')->first();
        return $adminRole ? $adminRole->id : null;
    }

    public function productManagerRoleId()
    {
        //fetch the product manager role ID from role table
        $productManagerRole = Role::where('name', 'Product Manager')->first();
        return $productManagerRole ? $productManagerRole->id : null;
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
        //$adminRoleId = $this->getAdminRoleId();
        $userRoleId = $this->getUserRoleId();
        
        return $user->roles->contains('id', $userRoleId);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
    
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
    
        // Fetch the admin role ID dynamically
        $adminRoleId = $this->getAdminRoleId();

        // Allow delete if the user has the admin role
        return $user->roles->contains('id', $adminRoleId);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }

    public function forward(User $user, Product $product): bool
    {
        $adminRoleId = $this->getAdminRoleId();
        $userRoleId = $this->getUserRoleId();
    
        return $user->roles->contains('id', $adminRoleId) || $user->roles->contains('id', $userRoleId);
    }

    public function confirm(User $user, Product $product): bool
    {
        // Fetch the admin role ID dynamically
        $adminRoleId = $this->getAdminRoleId();
        $productManagerRoleId = $this->productManagerRoleId();
        // Allow confirm if the user has the admin role or Product Manager role
        return $user->roles->contains('id', $adminRoleId) || $user->roles->contains('id', $productManagerRoleId);
    }

    // public function createOrForward(User $user, Product $product)
    // {
    //     // Only Users or Admin can create and forward products
    //     return $user->role->name === 'user' || $user->role->name === 'admin';
    // }
}
