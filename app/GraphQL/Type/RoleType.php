<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class RoleType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Role'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string())
            ],
            'name' => [
                'type' => Type::string(),
            ]
        ];
    }
}