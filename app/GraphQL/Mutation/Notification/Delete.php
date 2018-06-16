<?php
namespace App\GraphQL\Mutation\Notification;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class Delete extends Mutation
{
    protected $attributes = [
        'name' => 'deleteNotification'
    ];

    public function type()
    {
        return GraphQL::type('Notification');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\NotificationService');
        return $serviceProvider->delete($args['id']);
    }
}