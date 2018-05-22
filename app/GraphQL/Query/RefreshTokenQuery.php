<?php
namespace App\GraphQL\Query;

use GraphQL;
use Folklore\GraphQL\Support\Query;

class RefreshTokenQuery extends Query
{
    protected $attributes = [
        'name' => 'refreshToken'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
    }

    public function resolve($root, $args)
    {
        $authService = resolve('App\Services\AuthService');
        return $authService->refreshToken();

    }
}