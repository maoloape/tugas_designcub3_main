<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reg_districts;
use App\Models\reg_provinces;
use App\Models\reg_regencies;
use App\Models\reg_villages;
use App\Models\email;

class HomeController extends Controller
{
    public function home()
    {
        $getProvince = reg_provinces::all();
        $countAllProvince = $getProvince->count();

        $getRegencies = reg_regencies::all();
        $countAllRegencies = $getRegencies->count();

        $getDistrict = reg_districts::all();
        $countAllDistrict = $getDistrict->count();

        $getVillages = reg_villages::all();
        $countAllVillages = $getVillages->count();

        $getEmails = email::all();
        $countAllEmails = $getEmails->count();
        return view('home', [
            'countAllProvince' => $countAllProvince,
            'countAllRegencies' => $countAllRegencies,
            'countAllDistrict' => $countAllDistrict,
            'countAllVillages' => $countAllVillages,
            'countAllEmails' => $countAllEmails,
        ]);
    }
}
