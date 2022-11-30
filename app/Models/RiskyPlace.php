<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskyPlace extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description','district_name'];

    public function post() {
        return $this->belongsTo(District::class);
    }
}
