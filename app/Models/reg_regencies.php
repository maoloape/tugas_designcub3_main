<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reg_regencies extends Model
{
    use HasFactory;

    public function province()
    {
        return $this->belongsTo(reg_provinces::class, 'province_id');
    }

    public function districts()
    {
        return $this->hasMany(reg_districts::class, 'regency_id');
    }
}
