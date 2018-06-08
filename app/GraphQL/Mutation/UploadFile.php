<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UploadFile extends Mutation
{
    protected $attributes = [
        'name' => 'uploadFile'
    ];

    public function type()
    {
        return GraphQL::type('File');
    }

    public function args()
    {
        return [
            'path' => ['name' => 'path', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'file' => ['name' => 'file', 'type' => Type::nonNull(Type::string())]
        ];
    }

    public function resolve($root, $args)
    {
        $fileService = resolve('App\Services\FileService');
        return $fileService->create($args);
    }
}