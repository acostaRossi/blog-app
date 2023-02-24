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
        \App\Models\User::factory(100)->create();

        \App\Models\Category::create([
            'title' => 'Sport'
        ]);
        \App\Models\Category::create([
            'title' => 'Cronaca'
        ]);
        \App\Models\Category::create([
            'title' => 'Cultura'
        ]);

        \App\Models\News::factory(100)->create();

        \App\Models\Comment::factory(1000)->create();
    }
}
