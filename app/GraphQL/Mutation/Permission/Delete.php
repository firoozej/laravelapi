<?php
namespace App\GraphQL\Mutation\Permission;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Delete extends Mutation
{
    protected $attributes = [
        'name' => 'deletePermission'
    ];

    public function type()
    {
        return GraphQL::type('Permission');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\PermissionService');
        return $serviceProvider->delete($args['id']);
    }
}