<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class AddRoleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'addRole'
    ];

    public function type()
    {
        return GraphQL::type('Role');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $roleService = resolve('App\Services\RoleService');
        return $roleService->create($args['name']);
    }
}