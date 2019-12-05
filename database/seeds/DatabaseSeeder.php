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

		DB::table('user_user')->insert([
            'user_id' => 1,
            'user_id1' => 2,
            'status' => 0,
        ]);

		DB::table('categories')->insert([
            'name' => Str::random(10),
            'private' => 1,
            'user_id' => 1,
        ]);

		DB::table('categories')->insert([
            'name' => Str::random(10),
            'private' => 1,
            'user_id' => 1,
        ]);

		DB::table('categories')->insert([
            'name' => Str::random(10),
            'private' => 0,
            'user_id' => 1,
        ]);

		DB::table('categories')->insert([
            'name' => Str::random(10),
            'private' => 0,
            'user_id' => 2,
        ]);

		DB::table('tasks')->insert([
            'category_id' => 1,
            'name' => Str::random(10),
            'description' => Str::random(200),
			'end_at' => '2019-11-07 13:15:39'
        ]);

		DB::table('files')->insert([
            'path' => Str::random(100)
        ]);

		DB::table('tasks_has_files')->insert([
            'task_id' => 1,
            'file_id' => 1,
        ]);
    }
}
