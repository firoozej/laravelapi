<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}
