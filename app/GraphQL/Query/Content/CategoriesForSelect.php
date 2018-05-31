<?php

namespace App\GraphQL\Query\Content;

use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

class CategoriesForSelect extends Query
{
    protected $attributes = [
        'name' => 'categoriesForSelect'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('CategoryForSelect'));
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\CategoryService');
        return $serviceProvider->indexForSelect();
    }
}