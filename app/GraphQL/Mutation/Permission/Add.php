<?php
namespace App\GraphQL\Mutation\Permission;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Add extends Mutation
{
    protected $attributes = [
        'name' => 'addPermission'
    ];

    public function type()
    {
        return GraphQL::type('Permission');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'roles' => ['name' => 'roles', 'type' => Type::listOf(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\PermissionService');
        return $serviceProvider->create($args);
    }
}