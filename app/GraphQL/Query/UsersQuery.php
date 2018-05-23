<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\UserService');
        if(isset($args['id'])) {
             return $serviceProvider->view($args['id']);
        }
        else {
            return $serviceProvider->index();
        }
    }
}