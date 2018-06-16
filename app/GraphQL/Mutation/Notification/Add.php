<?php
namespace App\GraphQL\Mutation\Notification;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Add extends Mutation
{
    protected $attributes = [
        'name' => 'addNotification'
    ];

    public function type()
    {
        return GraphQL::type('Notification');
    }

    public function args()
    {
        return [
            'text' => ['name' => 'text', 'type' => Type::nonNull(Type::string())],
            'users' => ['name' => 'users', 'type' => Type::listOf(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\NotificationService');
        return $serviceProvider->create($args);
    }
}