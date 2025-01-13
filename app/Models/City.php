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


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;
    use TraitGeoModelShared;

    protected $table = "geo_cities";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            "geo_city_id",
            "en_name",
            "ar_name",
            "he_name",
            "code",
            "governorate_id",
            "country_id",
            "continent",
            "is_capital_city",
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
        return auth()->can('geo::cities.edit');
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'geo_country_id');
    }

    /**
     * @return BelongsTo
     */
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, 'governorate_id', 'geo_governorate_id');
    }

    /**
     * @return HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'city_id', 'geo_city_id');
    }

    /**
     * @return array
     */
    public function exportableColumns(): array
    {
        return [];
    }

    /**
     * @param string $column
     * @param array $options
     *
     * @return mixed
     */
    public function getExportableColumnValue(string $column, array $options = []): mixed
    {
        return $this->getAttribute($column);
    }

    /**
     * @return array
     */
    public function asOption()
    {
        return [
            'value'               => $this->geo_city_id,
            'label'               => $this->getName(),
            'data-code'           => $this->code,
            'data-governorate-id' => $this->governorate_id,
            'data-country-id'     => $this->country_id,
            'data-continent'      => $this->continent,
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
            'id'                  => $this->getAttribute('geo_city_id'),
            'value'               => $this->getAttribute('geo_city_id'),
            'text'                => $this->getName($params['language'] ?? null),
            'label'               => $this->getName($params['language'] ?? null),
            'data-code'           => $this->getAttribute('code'),
            'data-governorate-id' => $this->getAttribute('governorate_id'),
            'data-country-id'     => $this->getAttribute('country_id'),
            'data-continent'      => $this->getAttribute('continent'),
            'data-geo-type'       => 'city',
        ];
    }
}
