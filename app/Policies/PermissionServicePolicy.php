<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionServicePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function create($user) {
        return $user->can('permission-add');
    }
    public function update($user) {
        return $user->can('permission-edit');
    }
    public function delete($user) {
        return $user->can('permission-delete');
    }
    public function view($user) {
        return $user->can('permission-view');
    }
}
