<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankAccount;
use App\BankMaster;
use App\BankTran;
use App\User;
use DB;
class CashController extends Controller
{
  public function __construct()
 {
     $this->middleware('auth');


 }

  public function  index()
  {
     $data = BankTran::where('owner',auth()->user()->id)->orderBy('updated_at','desc')->paginate(20);
    //  dd($data);
     return view('cash.index',compact('data'));
  }

   public function deposit_index(){
      $banks = BankMaster::all();
      $bankacc = BankAccount::all();
      // dd($banks);
     return view('cash.deposit',compact('banks','bankacc'));
   }

   public function deposit()
   {
     try {
       if(request()->file('photo_image')){
            $store_path = 'cash/slip/';
            request()->file('photo_image')->store($store_path,'uploads');
            $bank = Bankmaster::findOrFail(request('bankaccount'));
            // $current_balance = auth()->user()->cash;
            // $prev_balance = BankTran::where('owner',auth()->user()->id)->orderBy('id','desc')->value('prev_balance');
            $result = BankTran::create([
              'amount' => request('amount'),
              'trantype' => 'ฝากเงิน',
              'owner' => auth()->user()->id,
              'from_bank' => request('fromaccount'),
              'from_bank_type' => request('frombank'),
              'to_bank' => $bank->bank_number,
              'to_bank_type' => $bank->bank_type,
              'tran_image' => request()->file('photo_image')->hashName(),
              'remarks' => request('remarks'),
              'trantime' => request('time'),
              'prev_balance' => auth()->user()->cash,
              'cur_balance' => auth()->user()->cash + request('amount')
            ]);

              // auth()->user()->update(['cash',auth()->user()->cash + request('amount')]);
              return redirect('/cash');
          }else {
            session()->flash('message','failed to upload image');
              return back();
          }



     } catch (Exception $e) {
        dd($e);
     }

   }


   public function withdraw()
   {
     try {
            $amount = request('amount') * -1;
            $result = BankTran::create([
              'amount' => $amount,
              'prev_balance' => auth()->user()->cash,
              'cur_balance' => auth()->user()->cash + $amount,
              'trantype' => 'ถอนเงิน',
              'owner' => auth()->user()->id,
              'to_bank' => request('to_bank'),
              'to_bank_type' => request('to_bank_type'),
              'remarks' => request('remarks')
            ]);
              // session()->flash('message','Success');
              // auth()->user()->update(['cash', auth()->user()->cash + $amount]);
              return redirect('/cash');

     } catch (Exception $e) {
        dd($e);
     }
   }
   public function withdraw_index()
   {
     return view('cash.withdraw');
   }


   public function cash_admin(){

     try {
       $data = BankTran::orderBy('updated_at','desc')->paginate(20);
       return view('admin.cash',compact('data'));
     } catch (Exception $e) {
        dd($e);
     }
   }

   public function rejectcash(BankTran $tran)
   {

     try {
       $tran->update([
         'status' => 2
       ]);
       return redirect('/cashadmin');
     } catch (Exception $e) {
       dd($e);
     }

   }

   public function approvecash(BankTran $tran)
   {

     try {
         DB::transaction(function () use ($tran){
            $user = User::findOrFail($tran->owner);

           $tran->update([
             'prev_balance' => $user->cash,
             'cur_balance' => $user->cash + $tran->amount,
             'status' => 1
           ]);



           User::where('id',$tran->owner)->update([
                     'cash' => $user->cash + $tran->amount
                     ]);
        });

       return redirect('/cashadmin');
     } catch (Exception $e) {
       dd($e);
     }

   }

}
