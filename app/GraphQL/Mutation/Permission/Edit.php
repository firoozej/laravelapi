<?php
namespace App\GraphQL\Mutation\Permission;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Edit extends Mutation
{
    protected $attributes = [
        'name' => 'editPermission'
    ];

    public function type()
    {
        return GraphQL::type('Permission');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())],
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'roles' => ['name' => 'roles', 'type' => Type::listOf(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\PermissionService');
        return $serviceProvider->update($args);
    }
}