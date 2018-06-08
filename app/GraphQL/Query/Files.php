<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class Files extends Query
{
    protected $attributes = [
        'name' => 'files'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('File'));
    }

    public function args()
    {
        return [
            'path' => ['name' => 'path', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\FileService');
        return $serviceProvider->index($args);
    }
}