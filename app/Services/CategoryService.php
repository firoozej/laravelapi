<?php

namespace App\Services;

use App\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryService
{
    use AuthorizesRequests;

    public function create($args)
    {
        $this->authorize('create', CategoryService::class);

        if (isset($args['parent'])) {
            $parent = Category::find($args['parent']);
            $node = Category::create(['name' => $args['name']], $parent);
        } else {
            $node = Category::create(['name' => $args['name']]);
        }
        $node->parent = $node->ancestors->count() ? implode(' > ', $node->ancestors->pluck('name')->toArray()) : 'Top Level';
        return $node;

    }

    public function view($id)
    {
        $this->authorize('view', CategoryService::class);
        $node = Category::find($id);
        $node->parent = $node->parent_id;
        return collect([$node]);
    }

    public function update($args)
    {
        $this->authorize('update', CategoryService::class);
        $node = Category::find($args['id']);
        $node->name = $args['name'];
        $node->parent_id = $args['parent'];
        $node->save();
        $node->parent = $node->ancestors->count() ? implode(' > ', $node->ancestors->pluck('name')->toArray()) : 'Top Level';;
        return $node;
    }

    public function delete($id)
    {
        $this->authorize('delete', CategoryService::class);
        $node = Category::find($id);
        $node->delete();
        return $node;
    }

    public function index()
    {
        $this->authorize('view', CategoryService::class);
        $categories = Category::with('ancestors')->get();
        $array = array();
        foreach ($categories as $i => $category) {
            $array[] = array(
                'id' => $category->id,
                'name' => $category->name,
                'parent' => $category->ancestors->count() ? implode(' > ', $category->ancestors->pluck('name')->toArray()) : 'Top Level'
            );
        }
        return $array;
    }

    public function indexForSelect()
    {
        $this->authorize('view', CategoryService::class);

        $nodes = Category::get()->toTree();
        $traverse = function ($nodes, $prefix = '-') use (&$traverse) {
            $nodeArray = [];
            foreach ($nodes as $node) {
                $nodeArray[] = [
                    'id' => $node->id,
                    'name' => $prefix.' '.$node->name,
                   ];

                $nodeArray = array_merge($nodeArray ,
                    $traverse($node->children, $prefix.'-'));
            }
            return $nodeArray;
        };

        return $traverse($nodes);
    }
}