<?php
namespace App\GraphQL\Mutation\Content\Item;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Add extends Mutation
{
    protected $attributes = [
        'name' => 'addItem'
    ];

    public function type()
    {
        return GraphQL::type('Item');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'category' => ['name' => 'category', 'type' => Type::string()],
            'description' => ['name' => 'description', 'type' => Type::string()],
            'files' => ['name' => 'files', 'type' => Type::listOf(Type::string())],
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\ItemService');
        return $serviceProvider->create($args);
    }
}