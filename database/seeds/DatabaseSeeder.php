<?php

use Illuminate\Database\Seeder;

//https://laravel.com/docs/master/seeding
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@he-arc.ch',
            'password' => bcrypt('password'),
        ]);
		
		DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@he-arc.ch',
            'password' => bcrypt('password'),
        ]);
		
		DB::table('users_has_users')->insert([
            'user_id' => 0,
            'user_id1' => 1,
            'status' => 0,
        ]);
		
		DB::table('categorie')->insert([
            'name' => Str::random(10),
            'private' => 1,
            'user_id' => 0,
        ]);
		
		DB::table('categorie')->insert([
            'name' => Str::random(10),
            'private' => 1,
            'user_id' => 0,
        ]);
		
		DB::table('categorie')->insert([
            'name' => Str::random(10),
            'private' => 0,
            'user_id' => 0,
        ]);
		
		DB::table('categorie')->insert([
            'name' => Str::random(10),
            'private' => 0,
            'user_id' => 1,
        ]);
		
		
/*		DB::table('task')->insert([
            'user_id' => 0,
            'user_id1' => 1,
            'status' => 0,
        ]);
		
		DB::table('files')->insert([
            'path' => Str::random(100)
        ]);
		
		DB::table('tasks_has_files')->insert([
            'task_id' => Str::random(10),
            'file_id' => 0,
        ]);*/
    }
}
