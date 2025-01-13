<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:33 AM
 * @Project: SadeemGeo
 * @FileName: GeoDatabaseSeeder.php
 ******************************************************************************/

namespace Database\Seeders;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class GeoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CurrencySeeder::class,
            CountrySeeder::class,
            GovernorateSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
        ]);

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
