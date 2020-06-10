<?php

use Illuminate\Database\Seeder;

class NovelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Novels::class, 100)->create();
    }
}
