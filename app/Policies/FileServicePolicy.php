<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\Access\Authorizable;

class FileServicePolicy
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
        return $user->can('file');
    }
    public function update($user) {
        return $user->can('file');
    }
    public function delete($user) {
        return $user->can('file');
    }
    public function view($user) {
        return $user->can('file');
    }
}
