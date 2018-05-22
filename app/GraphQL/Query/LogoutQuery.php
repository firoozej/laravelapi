<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

class LogoutQuery extends Query
{
    protected $attributes = [
        'name' => 'logout'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
    }

    public function resolve()
    {
        $authService = resolve('App\Services\AuthService');
        return $authService->logout();
    }
}