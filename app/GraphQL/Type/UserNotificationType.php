<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserNotificationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserNotification'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string())
            ],
            'text' => [
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }
}