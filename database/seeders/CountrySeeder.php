<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:33 AM
 * @Project: SadeemGeo
 * @FileName: CountrySeeder.php
 ******************************************************************************/

namespace Database\Seeders;


use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Country::count()){
            return;
        }

        $path      = resource_path('assets/geoDataSeed/countries.json');
        $countries = json_decode(file_get_contents($path), true);
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
