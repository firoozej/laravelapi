<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'login'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $authService = resolve('App\Services\AuthService');
        return $authService->login($args['email'], $args['password']);
    }
}