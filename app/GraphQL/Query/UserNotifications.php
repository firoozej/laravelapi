<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class UserNotifications extends Query
{
    protected $attributes = [
        'name' => 'userNotifications'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('UserNotification'));
    }

    public function resolve($root, $args)
    {
        $serviceProvider = resolve('App\Services\UserNotificationService');
        return $serviceProvider->index();
    }
}