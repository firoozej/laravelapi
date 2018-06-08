<?php

namespace App\GraphQL\Type\Content;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ItemType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Item'
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
            'description' => [
                'type' => Type::string(),
            ],
            'category' => [
                'type' => GraphQL::type('Category'),
            ],
            'files' => [
                'type' => Type::listOf(GraphQL::type('ItemFile')),
            ]
        ];
    }
}