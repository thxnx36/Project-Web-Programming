<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    function places() {
        return $this->hasMany(RiskyPlace::class, 'district_name');
    }
}
