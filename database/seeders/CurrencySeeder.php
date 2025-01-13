<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:33 AM
 * @Project: SadeemGeo
 * @FileName: CurrencySeeder.php
 ******************************************************************************/

namespace Database\Seeders;


use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws AppException
     */
    public function run(): void
    {
        if (Currency::count()){
            return;
        }

        $path       = resource_path('assets/geoDataSeed/currencies.json');
        $currencies = json_decode(file_get_contents($path), true);
        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
