<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Role;

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
        return true;  // Allow everyone to view a specific product
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Product $product): bool
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
        $adminRoleId = $this->getRoleId('admin');

        // Allow if the user is the creator or an admin
        return $user->id === $product->created_by || $user->roles->contains('id', $adminRoleId);
    }

    /**
     * Allow only admins and Product Managers to confirm the product.
     */
    public function confirm(User $user, Product $product): bool
    {
        $adminRoleId = $this->getRoleId('admin');
        $productManagerRoleId = $this->getRoleId('Product Manager');

        return $user->roles->contains('id', $adminRoleId) || $user->roles->contains('id', $productManagerRoleId);
    }
}
