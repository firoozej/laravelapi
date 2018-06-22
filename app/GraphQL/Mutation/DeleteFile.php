<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteFile extends Mutation
{
    protected $attributes = [
        'name' => 'deleteFile'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('File'));
    }

    public function args()
    {
        return [
            'files' => ['name' => 'files', 'type' => Type::listOf(Type::string())],
            'folders' => ['name' => 'folders', 'type' => Type::listOf(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $fileService = resolve('App\Services\FileService');
        return $fileService->deleteFile($args);
    }
}