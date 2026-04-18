<?php

namespace Database\Seeders;

use App\Models\OfficeSetting;
use Illuminate\Database\Seeder;

class OfficeSettingSeeder extends Seeder
{
    public function run()
    {
        if (config('default.dual_language')) {
            OfficeSetting::create([
                'office_name' => null,
                'office_name_en' => null,
                'office_phone' => null,
                'office_email' => null,
                'cover_photo' => null,
                'office_address' => null,
                'background_img'=>null,
                'office_address_en' => null,
                'en_header' => null,
                'ne_header' => null,
                'map_iframe' => null,
                'facebook_iframe' => null,
                'twitter_iframe' => null,
            ]);
        }
        else
        {
            OfficeSetting::create([
                'office_name' => null,
                'office_phone' => null,
                'office_email' => null,
                'background_img'=>null,
                'cover_photo' => null,
                'office_address' => null,
                'en_header' => null,
                'ne_header' => null,
                'map_iframe' => null,
                'facebook_iframe' => null,
                'twitter_iframe' => null,
            ]);
        }

    }
}
