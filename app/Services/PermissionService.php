<?php
namespace App\Services;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    use AuthorizesRequests;

    public function create($args) {
        $this->authorize('create', PermissionService::class);

        $permission = Permission::create(['name' => $args['name']]);
        $permission->syncRoles($args['roles']);
        return $permission;
    }
    public function view($id) {
        $this->authorize('view', PermissionService::class);

        $permission = Permission::with('roles')
            ->where('id', $id)
            ->get();
        return $permission;
    }
    public function update($args) {
        $this->authorize('update', PermissionService::class);

        $permission = Permission::findById($args['id']);
        $permission->update(['name' => $args['name']]);
        $permission->syncRoles($args['roles']);

        $permission = Permission::findById($args['id']);
        return $permission;
    }
    public function delete($id) {
        $this->authorize('delete', PermissionService::class);

        $permission = Permission::findById($id);
        $permission->delete();
        return $permission;
    }
    public function index() {
        $this->authorize('index', PermissionService::class);

        return Permission::orderBy('name')->get();
    }
}