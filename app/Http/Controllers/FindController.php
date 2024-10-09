<?php

namespace App\Http\Controllers;

use App\Models\reg_districts;
use App\Models\reg_provinces;
use App\Models\reg_regencies;
use App\Models\reg_villages;
use Illuminate\Http\Request;


class FindController extends Controller
{
    public function index()
    {
        $data = reg_provinces::all();
        $data_city = reg_regencies::all();
        $data_district = reg_districts::all();
        $data_subdistrict = reg_villages::all();
        $datas = reg_provinces::with('regencies.districts.villages')->paginate(10);

        return view('lokasi.index', compact('data', 'data_city', 'data_district', 'data_subdistrict', 'datas'));
    }

    public function getDataLokasi(Request $request)
    {
        if ($request->ajax()) {
            $query = reg_provinces::with('regencies.districts.villages');

            if ($request->provinsi && $request->provinsi != 'all') {
                $query->where('id', $request->provinsi);
            }

            $data = $query->get();

            $result = [];

            foreach ($data as $province) {
                foreach ($province->regencies as $city) {
                    if ($request->kota && $request->kota != 'all' && $city->id != $request->kota) {
                        continue;
                    }

                    foreach ($city->districts as $district) {
                        if ($request->kabupaten && $request->kabupaten != 'all' && $district->id != $request->kabupaten) {
                            continue;
                        }

                        foreach ($district->villages as $village) {
                            if ($request->subdistrict && $request->subdistrict != 'all' && $village->id != $request->subdistrict) {
                                continue;
                            }

                            $result[] = [
                                'province_name' => $province->name,
                                'city_name'     => $city->name,
                                'district_name' => $district->name,
                                'subdistrict_name' => $village->name
                            ];
                        }
                    }
                }
            }

            return datatables()->of($result)
                ->addIndexColumn()
                ->make(true);
        }
    }



    public function getCities(Request $request)
    {
        $cities = reg_regencies::where('province_id', $request->province_id)->get();
        return response()->json($cities);
    }

    public function getDistricts(Request $request)
    {
        $districts = reg_districts::where('regency_id', $request->city_id)->get();
        return response()->json($districts);
    }

    public function getVillages(Request $request)
    {
        $villages = reg_villages::where('district_id', $request->district_id)->get();
        return response()->json($villages);
    }


}

