<?php
namespace App\Services;
use App\Notification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NotificationService
{
    use AuthorizesRequests;
    private $user;

    public function __construct(Application $app)
    {
        $this->user  = $app->make('auth')->user();
    }

    public function create($args) {
        $this->authorize('create', NotificationService::class);

        $model = Notification::create([
            'text' => $args['text'],
            'owner_id' => $this->user->id
        ]);
        $model->users()->sync($args['users']);
        return $model;
    }
    public function view($id) {
        $this->authorize('view', NotificationService::class);

        $model = Notification::with('users')
            ->where('id', $id)
            ->get();
        return $model;
    }
    public function update($args) {
        $this->authorize('update', NotificationService::class);

        $model = Notification::find($args['id']);
        $model->update(['text' => $args['text']]);
        $model->users()->sync($args['users']);

        $model = Notification::find($args['id']);
        return $model;
    }
    public function delete($id) {
        $this->authorize('delete', NotificationService::class);

        $model = Notification::find($id);
        $model->users()->detach();
        $model->delete();
        return $model;
    }
    public function index() {
        $this->authorize('view', NotificationService::class);

        return Notification::with('users')->where('owner_id', $this->user->id)->get();

    }
}