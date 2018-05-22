<?php

namespace App\GraphQL\Type;

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
            'access_token' => [
                'type' => Type::string(),
            ],
            'expires_in' => [
                'type' => Type::string(),
            ]
        ];
    }
}