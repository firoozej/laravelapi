<?php
namespace App\GraphQL\Mutation\Content\Item;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Delete extends Mutation
{
    protected $attributes = [
        'name' => 'deleteItem'
    ];

    public function type()
    {
        return GraphQL::type('Item');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\ItemService');
        return $serviceProvider->delete($args['id']);
    }
}