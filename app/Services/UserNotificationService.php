<?php

namespace App\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notification;

class UserNotificationService
{
    use AuthorizesRequests;
    private $user;

    public function __construct(Application $app)
    {
        $this->user  = $app->make('auth')->user();
    }

    public function delete($id)
    {
        $this->authorize('delete', UserService::class);

        $model = Notification::where('user_id', $this->user->id)->find($id);
        $model->delete();
        return $model;
    }

    public function index()
    {
        $this->authorize('view', UserService::class);


        return Notification::where('user_id', $this->user->id)->get();
    }
}