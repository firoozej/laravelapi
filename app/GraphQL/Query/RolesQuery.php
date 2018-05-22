<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class RolesQuery extends Query
{
    protected $attributes = [
        'name' => 'roles'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Role'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $roleService = resolve('App\Services\RoleService');
        if(isset($args['id'])) {
             return $roleService->view($args['id']);
        }
        else {
            return $roleService->index();
        }
    }
}