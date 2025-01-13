<?php

/*******************************************************************************
 * Copyright (c) 2022.
 *
 * @Author: Shaker Awad <shaker@sadem.co>
 * @Date: 9/7/22, 9:31 AM
 * @Project: SadeemGeo
 * @FileName: Currency.php
 ******************************************************************************/


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Currency extends Model
{
    use HasFactory;
    use TraitGeoModelShared;

    protected $table = "geo_currencies";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "geo_currency_id",
        "en_name",
        "ar_name",
        "code",
        "symbol",
        "symbol_native",
        "decimal_digits",
        "name_plural",
        "status",
        "will_sync",
    ];

    /**
     * @return bool
     */
    public function canEdit(): bool
    {
        return auth()->can('geo::currencies.edit');
    }


    /**
     * @param array $params
     *
     * @return array
     */
    public function toSelect2(array $params = []): array
    {
        return [
            'id'          => $this->getAttribute('geo_currency_id'),
            'value'       => $this->getAttribute('geo_currency_id'),
            'text'        => $this->getName($params['language'] ?? null),
            'label'       => $this->getName($params['language'] ?? null),
            'data-code'   => $this->getAttribute('code'),
            'data-symbol' => $this->getAttribute('symbol'),
            'data-type'   => 'currency',
        ];
    }
}
