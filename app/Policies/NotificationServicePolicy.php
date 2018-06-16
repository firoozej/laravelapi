<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationServicePolicy
{
    use HandlesAuthorization;

    public function create($user) {
        return $user->can('notification');
    }
    public function update($user) {
        return $user->can('notification');
    }
    public function delete($user) {
        return $user->can('notification');
    }
    public function view($user) {
        return $user->can('notification');
    }
}
