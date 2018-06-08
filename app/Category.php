<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    protected $fillable = [
        'name'
    ];
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
