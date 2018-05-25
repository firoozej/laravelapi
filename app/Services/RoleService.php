<?php
namespace App\Services;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;

class RoleService
{
    use AuthorizesRequests;

    public function create($name) {
        $this->authorize('create', RoleService::class);
        $role = Role::create(['name' => $name]);
        return $role;
    }
    public function view($id) {
        $this->authorize('view', RoleService::class);
        return collect([Role::findById($id)]);
    }
    public function update($args) {
        $this->authorize('update', RoleService::class);
        $role = Role::findById($args['id']);
        $role->name = $args['name'];
        $role->save();
        return $role;
    }
    public function delete($id) {
        $this->authorize('delete', RoleService::class);
        $role = Role::findById($id);
        $role->delete();
        return $role;
    }
    public function index() {
        $this->authorize('view', RoleService::class);
        return Role::all();
    }
}