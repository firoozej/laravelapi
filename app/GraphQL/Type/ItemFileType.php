<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ItemFileType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ItemFile'
    ];

    public function fields()
    {
        return [
            'path' => [
                'type' => Type::string()
            ]
        ];
    }
}