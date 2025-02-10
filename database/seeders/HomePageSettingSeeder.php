<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data1 = [
            [
                'category' => 3,
                'sub_category' => 2,
                'child_category' => 3,
            ],
            [
                'category' => 4,
                'sub_category' => 4,
                'child_category' => 5,
            ],
            [
                'category' => 5,
                'sub_category' => 6,
                'child_category' => 7,
            ],
            [
                'category' => 6,
                'sub_category' => 7,
                'child_category' => 8,
            ]
        ];


        $data2 = [
            
                'category' => 3,
                'sub_category' => 2,
                'child_category' => 3,
            
        ];



        DB::table('home_page_settings')->insert([
            [
                'key' => 'popular_category_section',
                'value' => json_encode($data1)
            ],
            [
                'key' => 'product_slider_section_one',
                'value' => json_encode($data2)
            ]
        ]);
    }
}
