<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUser extends Model
{

  protected $table = 'user_user';

	//https://stackoverflow.com/questions/36332005/laravel-model-with-two-primary-keys-update
	protected $primaryKey = ['user_id', 'user_id1'];

}
