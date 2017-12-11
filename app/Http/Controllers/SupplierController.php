<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\User;
use App\BankAccount;
use App\Province;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
   {
       $this->middleware('auth');
       $this->middleware('admin');

   }

    public function index()
    {
        //
        $suppliers = Supplier::orderBy('supplier_name','asc')->get();
        return view('supplier.index',compact('suppliers'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       try {
         $userid = Supplier::all()->pluck('store_user');
      
         $users =  User::where([
               ['user_type','=',config('constants.suppliertype')]

           ])->whereNotIn('id',$userid)->orderBy('name','desc')->get();

         $banks = BankAccount::orderBy('name','asc')->get();
         $provinces = Province::orderBy('province_name','asc')->get();
         return view('supplier.create',compact('users','banks','provinces'));
       } catch (Exception $e) {
         dd($e);
       }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
          // dd(request());
          request()->file('id_card')->store('account/file','uploads');
          request()->file('img_bank')->store('account/file','uploads');
          $fileidcard = request()->file('id_card')->hashName();
          $filebank = request()->file('id_card')->hashName();

          $result = Supplier::create([
                'supplier_name' => request('name'),
                'store_user' => request('store_owner'),
                'telephone' => request('telephone'),
                'address' => request('address'),
                'postcode' => request('postcode'),
                'bank_account' => request('bank_account'),
                'bank_type' => request('bank_type'),
                'bank_account_img' => $filebank,
                'id_card' => $fileidcard,
                'district' => request('district'),
                'city' => request('input-amphur'),
                'province' => request('input-province'),
                'created_by' => auth()->id()

          ]);
          session()->flash('message','Success create store');
          return redirect('supplier');
        } catch (Exception $e) {
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //

         $users =  User::where([
              ['user_type','=',config('constants.suppliertype')]

          ])->orderBy('name','desc')->get();
          $banks = BankAccount::orderBy('name','asc')->get();
          $provinces = Province::orderBy('province_name','asc')->get();
          return view('supplier.show',compact('supplier','provinces','banks','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
      try {
        $fileidcard = $supplier->id_card;
        $filebank = $supplier->bank_account_img;
        if (request()->hasFile('id_card')) {
            request()->file('id_card')->store('account/file','uploads');
              $fileidcard = request()->file('id_card')->hashName();
        }
        if (request()->hasFile('img_bank')) {
            request()->file('img_bank')->store('account/file','uploads');

            $filebank = request()->file('img_bank')->hashName();
        }



        $result = $supplier->update([
              'supplier_name' => request('name'),
              'store_user' => request('store_owner'),
              'telephone' => request('telephone'),
              'address' => request('address'),
              'postcode' => request('postcode'),
              'bank_account' => request('bank_account'),
              'bank_type' => request('bank_type'),
              'bank_account_img' => $filebank,
              'id_card' => $fileidcard,
              'district' => request('district'),
              'city' => request('input-amphur'),
              'province' => request('input-province')
        ]);
        session()->flash('message','Success update store');
        return redirect('supplier');
      } catch (Exception $e) {
          dd($e);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
