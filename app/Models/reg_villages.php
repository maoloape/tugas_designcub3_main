<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reg_villages extends Model
{
    use HasFactory;

    public function district()
    {
        return $this->belongsTo(reg_districts::class, 'district_id');
    }
}
