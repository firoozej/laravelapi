<?php

namespace App\Services;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;

class UserService
{
    use AuthorizesRequests;

    public function create($args)
    {
        $this->authorize('create', UserService::class);

        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password']),
        ]);
        $user->syncRoles($args['roles']);
        return $user;
    }

    public function view($id)
    {
        $this->authorize('view', UserService::class);

        $user = User::with('roles')
            ->where('id', $id)
            ->get();
        return $user;
    }

    public function update($args)
    {
        $this->authorize('update', UserService::class);

        $user = User::find($args['id']);
        $user->update([
            'name' => $args['name'],
            'email' => $args['email'],
        ]);
        if($args['password'] !== '') {
            $user->update([
                'password' => bcrypt($args['password']),
            ]);
        }
        $user->syncRoles($args['roles']);

        $user = User::find($args['id']);
        return $user;
    }

    public function delete($id)
    {
        $this->authorize('delete', UserService::class);

        $user = User::find($id);
        $user->delete();
        return $user;
    }

    public function index()
    {
        $this->authorize('index', UserService::class);

        return User::all();
    }
}