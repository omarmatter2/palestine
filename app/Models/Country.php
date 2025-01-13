<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author  : Shaker Awad <shaker@sadem.co>
 * @Date    : 9/7/22, 9:31 AM
 * @Project : SadeemGeo
 * @FileName: Country.php
 ******************************************************************************/


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Lang;


class Country extends Model
{
    use HasFactory;
    use TraitGeoModelShared;

    protected $table = "geo_countries";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            "geo_country_id",
            "en_common_name",
            "en_official_name",
            "ar_common_name",
            "ar_official_name",
            "he_common_name",
            "he_official_name",
            "native_common_name",
            "native_official_name",
            "native_lang_code",
            "top_level_domine",
            "code",
            "code_ccn3",
            "code_cca3",
            "code_cioc",
            "phone_code",
            "independent",
            "currency_code",
            "capital_id",
            "continent",
            "latitude",
            "longitude",
            "area",
            "flag_image",
            "population",
            "start_of_week",
            "status",
            "will_sync",
        ];

    /**
     * @return bool
     */
    public function canEdit(): bool
    {
        return auth()->can('geo::countries.edit');
    }

    /**
     * @return string
     */
    public function getFlagUrl()
    {
        return asset("assets/flag-images/{$this->getAttribute('flag_image')}");
    }

    /**
     * @param $language
     *
     * @return string
     */
    public function getCommonName($language = null): string
    {
        if (!$language) {
            $language = Lang::getLocale();
        }

        $commonName = $this->getAttribute($language . "_common_name");
        if (!$commonName) {
            $commonName = $this->getAttribute("en_common_name");
        }
        return $commonName;
    }

    /**
     * @param $language
     *
     * @return string
     */
    public function getOfficialName($language = null): string
    {
        if (!$language) {
            $language = Lang::getLocale();
        }

        $official_name = $this->getAttribute($language . "_official_name");
        if (!$official_name) {
            $official_name = $this->getAttribute("en_official_name");
        }
        return $official_name;
    }

    /**
     * @return HasOne
     */
    public function capitalCity(): HasOne
    {
        return $this->hasOne(City::class, "geo_city_id", "capital_id");
    }

    /**
     * @return HasMany
     */
    public function governorates(): HasMany
    {
        return $this->hasMany(Governorate::class, "country_id", "geo_country_id");
    }

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, "country_id", "geo_country_id");
    }

    /**
     * @return array
     */
    public function asOption($language = null)
    {
        return [
            'value'           => $this->getAttribute('geo_country_id'),
            'label'           => $this->getCommonName($language),
            'data-code'       => $this->getAttribute('code'),
            'data-phone-code' => $this->getAttribute('phone_code'),
            'data-capital-id' => $this->getAttribute('capital_id'),
            'data-continent'  => $this->getAttribute('continent'),
            'data-capital'    => $this->getAttribute('capital'),
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function toSelect2(array $params = []): array
    {
        return [
            'id'              => $this->getAttribute('geo_country_id'),
            'value'           => $this->getAttribute('geo_country_id'),
            'text'            => $this->getCommonName($params['language'] ?? null),
            'label'           => $this->getCommonName($params['language'] ?? null),
            'data-code'       => $this->getAttribute('code'),
            'data-phone-code' => $this->getAttribute('phone_code'),
            'data-capital-id' => $this->getAttribute('capital_id'),
            'data-continent'  => $this->getAttribute('continent'),
            'data-capital'    => $this->getAttribute('capital'),
            'data-geo-type'   => 'country',
        ];
    }
}
