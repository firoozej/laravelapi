<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Role;

class DeleteRoleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteRole'
    ];

    public function type()
    {
        return GraphQL::type('Role');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $roleService = resolve('App\Services\RoleService');
        return $roleService->delete($args['id']);
    }
}