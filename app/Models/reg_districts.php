<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reg_districts extends Model
{
    use HasFactory;

    public function regency()
    {
        return $this->belongsTo(reg_regencies::class, 'regency_id');
    }

    public function villages()
    {
        return $this->hasMany(reg_villages::class, 'district_id');
    }
}
