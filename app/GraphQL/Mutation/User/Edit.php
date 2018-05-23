<?php
namespace App\GraphQL\Mutation\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Edit extends Mutation
{
    protected $attributes = [
        'name' => 'editUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())],
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::string()],
            'roles' => ['name' => 'roles', 'type' => Type::listOf(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\UserService');
        return $serviceProvider->update($args);
    }
}