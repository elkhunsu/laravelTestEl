<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ArticlesTableSeeder;
use Database\Seeders\CommentsTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ArticlesTableSeeder::class,
            CommentsTableSeeder::class,
            // Other seeders...
        ]);
    }
}
