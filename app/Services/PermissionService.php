<?php
namespace App\Services;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
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
        $this->authorize('view', PermissionService::class);

        return Permission::orderBy('name')->get();
    }

    public function userPermissions() {
        $user = auth()->user();
        if($user->superAdmin()) {
            return Permission::all();
        }

        $userRoles = $user->roles()->pluck('id')->toArray();
        $permissions  = DB::table('permissions as p')
            ->join('role_has_permissions as rp', 'p.id', '=', 'rp.permission_id')
            ->select('p.*')
            ->whereIn('rp.role_id', $userRoles)
            ->get();
        return $permissions;

    }
}