<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
     /**
      * The tasks that belong to the file.
      */
     public function tasks()
     {
         return $this->belongsToMany('App\Task');
     }
}
