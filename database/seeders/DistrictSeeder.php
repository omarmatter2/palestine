<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:33 AM
 * @Project: SadeemGeo
 * @FileName: DistrictSeeder.php
 ******************************************************************************/

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        if (District::count()){
            return;
        }

        $path      = resource_path('assets/geoDataSeed/districts.json');
        $districts = json_decode(file_get_contents($path), true);
        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
