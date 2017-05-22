<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array();
        $roles[] = ['name' => 'admin'];
        $roles[] = ['name' => 'subscriber'];

        foreach ($roles as $role) {
	        DB::table('roles')->insert($role);	
        }
    }
}
