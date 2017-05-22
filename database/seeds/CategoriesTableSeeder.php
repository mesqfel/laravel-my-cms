<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array();
        $categories[] = ['name' => 'sports'];
        $categories[] = ['name' => 'music'];
        $categories[] = ['name' => 'science'];
        $categories[] = ['name' => 'programming'];
        $categories[] = ['name' => 'tourism'];

        foreach ($categories as $category) {
	        DB::table('categories')->insert($category);	
        }
    }
}
