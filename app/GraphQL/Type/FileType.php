<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class FileType extends GraphQLType
{
    protected $attributes = [
        'name' => 'File'
    ];

    public function fields()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string())
            ],
            'type' => [
                'type' => Type::nonNull(Type::string())
            ],
            'path' => [
                'type' => Type::string()
            ],
            'file' => [
                'type' => Type::string()
            ],
        ];
    }
}