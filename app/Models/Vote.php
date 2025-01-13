<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{








    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
