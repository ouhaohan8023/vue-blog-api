<?php

use Illuminate\Database\Seeder;
use App\Models\Classify;

class ClassifyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classify::create([
            'id'   => 1,
            'name' => '首页',
        ]);

        $slip = Classify::find(1);

        $children = [
            2 => ['name' => '开发者'],
            3 => ['name' => '工具文档'],
            4 => ['name' => '观点与感想'],
        ];

        foreach ($children as $key => $child) {
            $data = $child;
            $data['id'] = $key;
            $slip->createChild($data);
        }

        $sec = Classify::find(2);

        $sec->createChild(['id' => 5, 'name' => '开发者2']);
    }
}
