<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\District;
use App\Models\Room;
use App\Models\Ward;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function district(Request $request)
    {
        $code = $request->code ?? '';
        $districts = District::select('name', 'code')->where('province_code', $code)->get();
        return response()->json($districts);
    }

    public function ward(Request $request)
    {
        $code = $request->code ?? '';
        $wards = Ward::select('name', 'code')->where('district_code', $code)->get();
        return response()->json($wards);
    }

    // public function building(Request $request)
    // {
    //     $code = $request->code ?? '';
    //     $buildings = Building::where('ward_code', $code)->get();
    //     return view('address_fields.building', compact('buildings'));
    // }

    // public function room(Request $request)
    // {
    //     $code = $request->code ?? '';
    //     $building_code = Building::where('name', $request->code)->first()->code ?? '';
    //     $rooms = Room::where('building_code', $building_code)->get();
    //     return view('address_fields.room', compact('rooms'));
    // }

    public function getDistrictWard(Request $request)
    {
        $code = $request->code;
        $districts = District::where('province_code', $code)->get();
        $wards = Ward::where('district_code', $districts->first()->code)->get();
        return response()->json(['districts' => $districts, 'wards' => $wards]);
    }

}
