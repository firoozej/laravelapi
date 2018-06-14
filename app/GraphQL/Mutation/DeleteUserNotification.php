<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteUserNotification extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUserNotification'
    ];

    public function type()
    {
        return GraphQL::type('UserNotification');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $roleService = resolve('App\Services\UserNotificationService');
        return $roleService->delete($args['id']);
    }
}