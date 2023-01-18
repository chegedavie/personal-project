<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tagPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;1500>$i;$i++){
            DB::table('tag_blog')->insert([
                'blog_id' => fake()->numberBetween(1,300),
                'tag_id' => fake()->numberBetween(1,6),
     
            ]);
        }
    }
}
