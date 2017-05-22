<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photos = array();
        $photos[] = [
        			'path' => '1491771648_php.png'
        		   ];

        foreach ($photos as $photo) {
            DB::table('photos')->insert($photo);	
        }
    }
}
