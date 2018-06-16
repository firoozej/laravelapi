<?php

namespace App\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notification;
use Illuminate\Support\Facades\DB;

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
        $this->authorize('delete', UserNotificationService::class);

        $model = Notification::find($id);
        $model->users()->updateExistingPivot($this->user->id, ['seen' => 1]);

        return $model;
    }

    public function index()
    {
        $this->authorize('view', UserNotificationService::class);

        $query = DB::table('notifications')
            ->join('notification_user' , function ($join) {
                $join->on('notifications.id', '=', 'notification_user.notification_id')
                    ->where('seen', '=', 0);
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'notification_user.user_id')
                    ->where('users.id', '=', $this->user->id);
            })
            ->select('notifications.id','notifications.text');
        return $query->get();
    }
}