<?php
namespace App\GraphQL\Mutation\Content\Category;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Add extends Mutation
{
    protected $attributes = [
        'name' => 'addCategory'
    ];

    public function type()
    {
        return GraphQL::type('Category');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'parent' => ['name' => 'parent', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\CategoryService');
        return $serviceProvider->create($args);
    }
}