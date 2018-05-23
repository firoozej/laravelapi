<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\Access\Authorizable;

class UserServicePolicy
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
        return $user->can('user-add');
    }
    public function update($user) {
        return $user->can('user-edit');
    }
    public function delete($user) {
        return $user->can('user-delete');
    }
    public function index($user) {
        return $user->can('user-index');
    }
    public function view($user) {
        return $user->can('user-view');
    }
}
