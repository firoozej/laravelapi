<?php
namespace App\GraphQL\Mutation\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Delete extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\UserService');
        return $serviceProvider->delete($args['id']);
    }
}