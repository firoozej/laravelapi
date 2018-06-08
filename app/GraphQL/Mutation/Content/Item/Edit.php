<?php
namespace App\GraphQL\Mutation\Content\Item;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Edit extends Mutation
{
    protected $attributes = [
        'name' => 'editItem'
    ];

    public function type()
    {
        return GraphQL::type('Item');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())],
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'category' => ['name' => 'category', 'type' => Type::string()],
            'description' => ['name' => 'description', 'type' => Type::string()],
            'files' => ['name' => 'files', 'type' => Type::listOf(Type::string())],
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\ItemService');
        return $serviceProvider->update($args);
    }
}