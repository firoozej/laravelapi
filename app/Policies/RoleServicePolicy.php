<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoleServicePolicy
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
        return true;
        //if user can create visa return true
        //else return false
    }
    public function update($user) {
        return true;
    }
    public function delete($user) {
        return true;
    }
    public function index($user) {
        return true;
    }
    public function view($user) {
        return true;
    }
}
