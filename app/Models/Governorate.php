<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:31 AM
 * @Project: SadeemGeo
 * @FileName: Governorate.php
 ******************************************************************************/


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Governorate extends Model
{
    use HasFactory;
    use TraitGeoModelShared;

    protected $table = "geo_governorates";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            "geo_governorate_id",
            "en_name",
            "ar_name",
            "he_name",
            "code",
            "country_id",
            "continent",
            "population",
            "latitude",
            "longitude",
            "status",
            "will_sync",
        ];

    /**
     * @return bool
     */
    public function canEdit(): bool
    {
        return auth()->can('geo::governorates.edit');
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'geo_country_id');
    }

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'governorate_id', 'geo_governorate_id');
    }

    /**
     * @return HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'governorate_id', 'geo_governorate_id');
    }

    /**
     * @return array
     */
    public function asOption()
    {
        return [
            'value'           => $this->geo_governorate_id,
            'label'           => $this->getName(),
            'data-code'       => $this->code,
            'data-country-id' => $this->country_id,
            'data-continent'  => $this->continent,
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
            'id'              => $this->getAttribute('geo_governorate_id'),
            'value'           => $this->getAttribute('geo_governorate_id'),
            'text'            => $this->getName($params['language'] ?? null),
            'label'           => $this->getName($params['language'] ?? null),
            'data-code'       => $this->getAttribute('code'),
            'data-country-id' => $this->getAttribute('country_id'),
            'data-continent'  => $this->getAttribute('continent'),
            'data-geo-type'   => 'governorate',
        ];
    }
}
