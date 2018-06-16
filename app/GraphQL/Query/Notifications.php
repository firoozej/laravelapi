<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class Notifications extends Query
{
    protected $attributes = [
        'name' => 'notifications'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Notification'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $roleService = resolve('App\Services\NotificationService');
        if(isset($args['id'])) {
             return $roleService->view($args['id']);
        }
        else {
            return $roleService->index();
        }
    }
}