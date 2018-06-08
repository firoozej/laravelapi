<?php

namespace App\Services;

use App\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ItemService
{
    use AuthorizesRequests;

    public function create($args)
    {
        $this->authorize('create', ItemService::class);
        $item = Item::create([
            'name' => $args['name'],
            'category_id' => $args['category'],
            'description' => $args['description'],
        ]);
        $fileList = array();
        foreach($args['files'] as $file) {
            $fileList[] = array('path' => $file);
        }
        $item->files()->createMany($fileList);
        return $item;

    }

    public function view($id)
    {
        $this->authorize('view', ItemService::class);

        $item = Item::with(['category', 'files'])
            ->where('id', $id)
            ->get();
        return $item;
    }

    public function update($args)
    {
        $this->authorize('update', ItemService::class);

        $model = Item::find($args['id']);

        $model->update([
            'name' => $args['name'],
            'category_id' => $args['category'],
            'description' => $args['description']
        ]);

        $model->files()->delete();

        $fileList = array();
        foreach($args['files'] as $file) {
            $fileList[] = array('path' => $file);
        }
        $model->files()->createMany($fileList);

        return Item::find($args['id']);
    }

    public function delete($id)
    {
        $this->authorize('delete', ItemService::class);

        $model = Item::find($id);

        $model->files()->delete();
        $model->delete();

        return $model;
    }

    public function index()
    {
        $this->authorize('view', ItemService::class);
        return Item::with('category')->get();
    }
}