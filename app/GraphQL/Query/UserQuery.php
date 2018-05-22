<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'User'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
    }

    public function resolve($root, $args)
    {
        $authService = resolve('App\Services\AuthService');
        return $authService->user();
    }
}