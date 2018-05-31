<?php

namespace App\GraphQL\Query\Content;

use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

class Categories extends Query
{
    protected $attributes = [
        'name' => 'categories'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Category'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\CategoryService');
        if(isset($args['id'])) {
            return $serviceProvider->view($args['id']);
        }
        else {
            return $serviceProvider->index();
        }
    }
}