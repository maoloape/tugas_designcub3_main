<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reg_provinces extends Model
{
    use HasFactory;

    public function regencies()
    {
        return $this->hasMany(reg_regencies::class, 'province_id');
    }
}
