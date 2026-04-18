<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    public function run()
    {
        DB::table('colors')->insert([
            'nav' => '#037555',
            'footer' => '#1b4789',
            'scroller'=>'#2460B9'
        ]);
    }
}
