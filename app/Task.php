<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    /**
      * The files that belong to the task.
      */
     public function files()
     {
         return $this->belongsToMany('App\File');
     }
}
