<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:31 AM
 * @Project: SadeemGeo
 * @FileName: City.php
 ******************************************************************************/




namespace App\Models;

use Illuminate\Support\Facades\Lang;

trait TraitGeoModelShared
{
    /**
     * @param $language
     *
     * @return string
     */
    public function getName($language = null): string
    {
        if (!$language){
            $language = Lang::getLocale();
        }

        $name = $this->getAttribute($language . "_name");
        if (!$name){
            $name = $this->getAttribute("en_name");
        }
        return $name;
    }

    /**
     * @return array
     */
    public function getContinentAsOptions(): array
    {
        return [
            "Asia"          => __('geo::labels.continent_labels.asia'),
            "Africa"        => __('geo::labels.continent_labels.africa'),
            "Europe"        => __('geo::labels.continent_labels.europe'),
            "North America" => __('geo::labels.continent_labels.north_america'),
            "South America" => __('geo::labels.continent_labels.south_america'),
            "Oceania"       => __('geo::labels.continent_labels.oceania'),
            "Antarctica"    => __('geo::labels.continent_labels.antarctica'),
        ];
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        if (isApi()){
            return  $this->toApi();
        }
        return parent::toArray();
    }

    /**
     * @return array
     */
    public function toApi(){
        $data = parent::toArray();
        if (method_exists($this,'getCommonName')){
            $data['label'] = $this->getCommonName();
        }else{
            $data['label'] = $this->getName();
        }
        return $data;
    }

}
