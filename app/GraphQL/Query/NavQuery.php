<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class NavQuery extends Query
{
    protected $attributes = [
        'name' => 'nav'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Permission'));
    }

    public function resolve()
    {
        $serviceProvider = resolve('App\Services\PermissionService');
        return $serviceProvider->userPermissions();
    }
}