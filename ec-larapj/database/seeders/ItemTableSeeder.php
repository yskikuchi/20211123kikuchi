<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<60;$i++){
        DB::table('items')->insert([
            'name' =>"sandal${i}",
            'price' => 3000,
            'image' => 'storage/images/beigesandal.jpg'
        ]);
    }
    }
}
