<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class NewFolder extends Mutation
{
    protected $attributes = [
        'name' => 'newFolder'
    ];

    public function type()
    {
        return GraphQL::type('File');
    }

    public function args()
    {
        return [
            'folderName' => ['name' => 'folderName', 'type' => Type::nonNull(Type::string())],
            'path' => ['name' => 'path', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $fileService = resolve('App\Services\FileService');
        return $fileService->newFolder($args);
    }
}