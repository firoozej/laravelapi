<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\Access\Authorizable;

class RoleServicePolicy
{
    use HandlesAuthorization, Authorizable;

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
        return $user->can('role-add');
    }
    public function update($user) {
        return $user->can('role-edit');
    }
    public function delete($user) {
        return $user->can('role-delete');
    }
    public function index($user) {
        return $user->can('role-index');
    }
    public function view($user) {
        return $user->can('role-view');
    }
}
