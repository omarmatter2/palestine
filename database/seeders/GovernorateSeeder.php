<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:33 AM
 * @Project: SadeemGeo
 * @FileName: GovernorateSeeder.php
 ******************************************************************************/

namespace Database\Seeders;


use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (Governorate::count()){
            return;
        }
        // get the path of the json file in resources folder in the app
$path = resource_path('assets/geoDataSeed/governorates.json');
        $governorates = json_decode(file_get_contents($path), true);
        foreach ($governorates as $governorate) {
            Governorate::create($governorate);
        }
    }
}
