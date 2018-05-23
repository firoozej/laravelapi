<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class PermissionsQuery extends Query
{
    protected $attributes = [
        'name' => 'permissions'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Permission'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\PermissionService');
        if(isset($args['id'])) {
             return $serviceProvider->view($args['id']);
        }
        else {
            return $serviceProvider->index();
        }
    }
}