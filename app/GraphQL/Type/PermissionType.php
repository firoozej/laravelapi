<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PermissionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Permission'
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
            'roles' => [
                'type' => Type::listOf(GraphQL::type('Role')),
            ]
        ];
    }
}