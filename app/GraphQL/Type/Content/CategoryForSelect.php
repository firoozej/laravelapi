<?php

namespace App\GraphQL\Type\Content;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CategoryForSelect extends GraphQLType
{
    protected $attributes = [
        'name' => 'CategoryForSelect'
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