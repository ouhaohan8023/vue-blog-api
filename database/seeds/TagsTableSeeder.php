<?php

use Illuminate\Database\Seeder;
use App\Models\Tags;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            1 => 'Laravel',
            2 => 'PHP',
            3 => 'Linux',
            4 => 'Hacker',
            5 => 'Tools',
        ];

        foreach ($arr as $k => $v) {
            Tags::create([
                'name' => $v
            ]);
        }
    }
}
