<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'private', 'user_id'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function tasks()
    {
      return $this->hasMany('App\Task');
    }
}
