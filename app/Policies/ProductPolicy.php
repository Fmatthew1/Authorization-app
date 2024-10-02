<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;

class ProductPolicy
{
    /**
     * Get the role ID for a given role name.
     */
    private function getRoleId($roleName)
    {
        $role = Role::where('name', $roleName)->first();
        return $role ? $role->id : null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Product $product): bool
    {
        return true;  // Allow everyone to view products
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        // Only allow users who are NOT Product Managers to create a product
        $productManagerRoleId = $this->getRoleId('Product Manager');
        return !$user->roles->contains('id', $productManagerRoleId);
        //return true;  // Allow everyone to view a specific product
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only allow users who are NOT Product Managers to create a product
        $productManagerRoleId = $this->getRoleId('Product Manager');
        return !$user->roles->contains('id', $productManagerRoleId);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        $adminRoleId = $this->getRoleId('admin');
        return $user->roles->contains('id', $adminRoleId);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        $adminRoleId = $this->getRoleId('admin');
        return $user->roles->contains('id', $adminRoleId);
    }

    /**
     * Allow the creator (or an admin) to forward the product.
     */
    public function forward(User $user, Product $product): bool
    {
        // $adminRoleId = $this->getRoleId('admin');
        // // Allow if the user is the creator or an admin
        // return $user->id === $product->created_by || $user->roles->contains('id', $adminRoleId);

        $adminRoleId = $this->getRoleId('admin');
        $creatorRoleId = $this->getRoleId('creator');

        // Check if the product is in a "Pending" state (assuming status ID 1 is "Pending")
        if ($product->status_id == 1) {
            // Allow if the user is the creator or an admin
            return $user->id === $product->created_by || $user->roles->contains('id', $adminRoleId) || $user->roles->contains('id', $creatorRoleId);
        }

        return false;
    
    }

    /**
     * Allow only admins and Product Managers to confirm the product.
     */
    public function confirm(User $user, Product $product): bool
    {
        // $adminRoleId = $this->getRoleId('admin');
        // $productManagerRoleId = $this->getRoleId('Product Manager');
        // return $user->roles->contains('id', $adminRoleId) || $user->roles->contains('id', $productManagerRoleId);

        $adminRoleId = $this->getRoleId('admin');
        $productManagerRoleId = $this->getRoleId('Product Manager');

        // Check if the product is in a "Forwarded" state (assuming status ID 2 is "Forwarded")
        if ($product->status_id == 2) {
            // Allow if the user is an admin or a Product Manager
            return $user->roles->contains('id', $adminRoleId) || $user->roles->contains('id', $productManagerRoleId);
        }

        return false;
    }

}

