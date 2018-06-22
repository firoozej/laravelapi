<?php

namespace App\Services;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class FileService
{
    use AuthorizesRequests;

    public function create($args)
    {
        $this->authorize('create', FileService::class);
        $path = $args['path'] ? 'FileManager/' . $args['path'] : 'FileManager';
        $fileData = explode(';base64,', $args['file']);
        Storage::put($path . '/' . $args['name'], base64_decode($fileData[1]));
        return array(
            'name' => $args['name'],
            'path' => $path . '/' . $args['name'],
            'type' => 'file'
        );

    }

    public function newFolder($args)
    {
        $this->authorize('newFolder', FileService::class);
        $path = $args['path'] ? 'FileManager/' . $args['path'] : 'FileManager';
        Storage::makeDirectory($path . '/' . $args['folderName']);
        return array(
            'name' => $args['folderName'],
            'path' => $args['path'] . '/' . $args['folderName'],
            'type' => 'directory'
        );
    }

    public function deleteFile($args)
    {
        $this->authorize('deleteFile', FileService::class);
        $deletedResource = array();

        Storage::delete($args['files']);
        foreach($args['files'] as $file) {
            $deletedResource[] = array(
                'name' => basename($file),
                'path' => $file,
                'type' => 'file'
            );
        }

        foreach ($args['folders'] as $folder) {
            Storage::deleteDirectory('FileManager/' . $folder);
            $deletedResource[] = array(
                'name' => $folder,
                'path' => 'FileManager/' . $folder,
                'type' => 'directory'
            );
        }
        return $deletedResource;

    }

    public function index($args)
    {
        $this->authorize('view', FileService::class);
        $path = $args['path'] ? 'FileManager/' . $args['path'] : 'FileManager';
        $files = Storage::files($path);
        $directories = Storage::directories($path);
        $content = array();
        foreach ($directories as $directory) {
            $content[] = array(
                'name' => basename($directory),
                'path' => str_replace('FileManager/', '', $directory),
                'type' => 'directory'
            );
        }
        foreach ($files as $file) {
            $content[] = array(
                'name' => basename($file),
                'path' => $file,
                'type' => 'file'
            );
        }
        return $content;
    }
}