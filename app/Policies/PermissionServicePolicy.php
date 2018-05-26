<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionServicePolicy
{
    use HandlesAuthorization;

    public function create($user) {
        return $user->can('permission');
    }
    public function update($user) {
        return $user->can('permission');
    }
    public function delete($user) {
        return $user->can('permission');
    }
    public function view($user) {
        return $user->can('permission');
    }
}
