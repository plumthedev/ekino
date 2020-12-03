<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;

class UserObserver
{
    /**
     * Handle created rate.
     *
     * @param \App\Models\User $user
     */
    public function created(User $user): void
    {
        $this->assignUserRole($user);
    }

    /**
     * Assign user role after creating it.
     *
     * @param \App\Models\User $user
     */
    protected function assignUserRole(User $user): void
    {
        $role = Role::firstOrCreate(['name' => Role::USER]);
        $user->assignRole($role);
    }
}
