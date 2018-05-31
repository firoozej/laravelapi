<?php
namespace App\GraphQL\Mutation\Content\Category;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Edit extends Mutation
{
    protected $attributes = [
        'name' => 'editCategory'
    ];

    public function type()
    {
        return GraphQL::type('Category');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())],
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'parent' => ['name' => 'parent', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\CategoryService');
        return $serviceProvider->update($args);
    }
}