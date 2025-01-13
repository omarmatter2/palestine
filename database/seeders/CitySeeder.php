<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:33 AM
 * @Project: SadeemGeo
 * @FileName: CitySeeder.php
 ******************************************************************************/

namespace Database\Seeders;

use App\Core\Exceptions\AppException;
use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws AppException
     */
    public function run(): void
    {
        if (City::count()){
            return;
        }

        $path = resource_path('assets/geoDataSeed/cities.json');
        $cities = json_decode(file_get_contents($path), true);
        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
