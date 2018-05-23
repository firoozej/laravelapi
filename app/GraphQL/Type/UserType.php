<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string())
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'email' => [
                'type' => Type::string(),
            ],
            'password' => [
                'type' => Type::string(),
            ],
            'roles' => [
                'type' => Type::listOf(GraphQL::type('Role')),
            ],
            'access_token' => [
                'type' => Type::string(),
            ],
            'expires_in' => [
                'type' => Type::string(),
            ]
        ];
    }
}