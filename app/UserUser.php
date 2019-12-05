<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUser extends Model
{

  protected $table = 'user_user';

	//https://stackoverflow.com/questions/36332005/laravel-model-with-two-primary-keys-update
	protected $primaryKey = ['user_id', 'user_id1'];

	$table->foreign('user_id')->references('id')->on('users')
	$table->foreign('user_id1')->references('id')->on('users')

	public $incrementing = false;

	$table->boolean('status')
}
