<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $users = array();
	    $users[] = [
	    			'role_id' => 1,
	    			'is_active' => 1,
	    			'name' => 'John Doe',
	    			'email' => 'john@gmail.com',
	    			'password' => bcrypt('123'),
	    			'photo_id' => 0,
	    			'slug' => 'john-doe'
	    		   ];

	    foreach ($users as $user) {
	        DB::table('users')->insert($user);	
	    }
    }
}
