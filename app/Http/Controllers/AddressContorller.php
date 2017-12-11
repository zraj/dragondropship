<?php

namespace App\Http\Controllers;

use App\Address;
use App\Amphures;
use App\District;
use App\Province;
use Illuminate\Http\Request;
use DB;

class AddressContorller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


   public function getbycode($zipcode){


         $districts = DB::table('zipcodes')
             ->join('districts', 'zipcodes.district_code', '=', 'districts.DISTRICT_CODE')
             ->select('districts.*')
             ->where('zipcodes.zipcode','=',$zipcode)
             ->get();

         $amphures = DB::table('zipcodes')
             ->join('districts', 'zipcodes.district_code', '=', 'districts.DISTRICT_CODE')
             ->join('amphures', 'districts.AMPHUR_ID', '=', 'amphures.AMPHUR_ID')
             ->select('amphures.AMPHUR_ID','amphures.AMPHUR_NAME')
             ->where('zipcodes.zipcode','=',$zipcode)
             ->groupBy('amphures.AMPHUR_ID','amphures.AMPHUR_NAME')
             ->get();

         $provinces = DB::table('zipcodes')
             ->join('districts', 'zipcodes.district_code', '=', 'districts.DISTRICT_CODE')
             ->join('amphures', 'districts.AMPHUR_ID', '=', 'amphures.AMPHUR_ID')
             ->join('provinces', 'amphures.PROVINCE_ID', '=', 'provinces.PROVINCE_ID')
             ->select('provinces.PROVINCE_ID','provinces.PROVINCE_NAME')
             ->where('zipcodes.zipcode','=',$zipcode)
             ->groupBy('provinces.PROVINCE_ID','provinces.PROVINCE_NAME')
             ->get();

        // dd($amphures);


         return view('test',compact('districts','amphures','provinces'));
   }

   public function getprovince($zipcode){



     $provinces = DB::table('zipcodes')
         ->join('districts', 'zipcodes.district_code', '=', 'districts.DISTRICT_CODE')
         ->join('amphures', 'districts.AMPHUR_ID', '=', 'amphures.AMPHUR_ID')
         ->join('provinces', 'amphures.PROVINCE_ID', '=', 'provinces.PROVINCE_ID')
         ->select('provinces.PROVINCE_ID','provinces.PROVINCE_NAME')
         ->where('zipcodes.zipcode','=',$zipcode)
         ->groupBy('provinces.PROVINCE_ID','provinces.PROVINCE_NAME')
         ->get();



         return view('services.province',compact('provinces'));
   }

   public function getamphur($zipcode){



         $amphures = DB::table('zipcodes')
             ->join('districts', 'zipcodes.district_code', '=', 'districts.DISTRICT_CODE')
             ->join('amphures', 'districts.AMPHUR_ID', '=', 'amphures.AMPHUR_ID')
             ->select('amphures.AMPHUR_ID','amphures.AMPHUR_NAME')
             ->where('zipcodes.zipcode','=',$zipcode)
             ->groupBy('amphures.AMPHUR_ID','amphures.AMPHUR_NAME')
             ->get();



         return view('services.amphur',compact('amphures'));
   }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
