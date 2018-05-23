<?php
namespace App\GraphQL\Mutation\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Add extends Mutation
{
    protected $attributes = [
        'name' => 'addUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())],
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'roles' => ['name' => 'roles', 'type' => Type::listOf(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\UserService');
        return $serviceProvider->create($args);
    }
}