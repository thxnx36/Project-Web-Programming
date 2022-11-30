<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'n_pmc', 'n_prison', 'n_ft', 'n_recovered', 'n_death'];
}
