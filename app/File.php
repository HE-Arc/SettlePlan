<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $timestamps = false;

     /**
      * The tasks that belong to the file.
      */
     public function tasks()
     {
         return $this->belongsToMany('App\Task');
     }

     public function getPath()
     {
       return $this->attributes['path'];
     }

     public function setPath($value)
     {
       $this->attributes['path'] = $value;
     }

     public function getName()
     {
       return $this->attributes['name'];
     }

     public function setName($value)
     {
       $this->attributes['name'] = $value;
     }
}
