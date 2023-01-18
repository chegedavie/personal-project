<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(50)->create();
        \App\Models\Blog::factory(300)->create();
        \App\Models\Tag::factory(6)->create();
        \App\Models\Comment::factory(2000)->create();
        //\App\Models\Reaction::factory(500)->create();
        $this->call([
            //RoleAndPermissionSeeder::class,
            tagPostSeeder::class,
        ]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
