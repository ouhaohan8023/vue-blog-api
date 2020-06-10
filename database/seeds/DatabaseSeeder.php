<?php

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
//        $this->call(NovelsTableSeeder::class);
        $this->call(ClassifyTableSeeder::class);
        $this->call(TagsTableSeeder::class);
    }
}
