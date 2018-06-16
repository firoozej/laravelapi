<?php
namespace App\GraphQL\Mutation\Notification;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Edit extends Mutation
{
    protected $attributes = [
        'name' => 'editNotification'
    ];

    public function type()
    {
        return GraphQL::type('Notification');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())],
            'text' => ['name' => 'text', 'type' => Type::nonNull(Type::string())],
            'users' => ['name' => 'users', 'type' => Type::listOf(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\NotificationService');
        return $serviceProvider->update($args);
    }
}