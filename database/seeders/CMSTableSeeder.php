<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CMSTableSeeder extends Seeder
{

    public function run(): void
    {
        // Insert multiple title records
        DB::table('cms_pages')->insert([
            [
                'title' => 'Home Page',
                'description' => 'Home Page',
            ],
            [
                'title' => 'About Us',
                'description' => 'About Us',
            ],
            [
                'title' => 'Terms & Conditions',
                'description' => 'Terms & Conditions',
            ],
            [
                'title' => 'Privacy Policy',
                'description' => 'Privacy Policy',
    
            ],
            [
                'title' => 'Contact Us',
                'description' => 'Contact Us',
    
            ],
         
        ]);
    }
}
