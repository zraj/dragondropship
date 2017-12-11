<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Style;
use App\Stores;
use App\Category;

class StyleController extends Controller
{
    //

    public function main(){
       $stores = Stores::orderBy('store_name','asc')->get();
       return view('style.main',compact('stores'));
    }

    public function create($store_id){
       $store = Stores::where('id',$store_id)->first();
       $categories = Category::orderBy('cat_name','asc')->get();
       return view('style.create',compact('categories','store'));
    }

     public function store()
    {
      // dd(request());
      try {
           $result = Style::create([
               'category_id' => request('cat_id'),
               'store_id' =>request('store_id'),
               'description' => request('style_desc'),
               'style_code' => request('style_code'),
                'created_by' => auth()->user()->id
           ]);

           if(count($result)){

                 session()->flash('message','Completed create : '.$result->style_code);
                 return redirect('/style/main');
           }else{
                 return redirect('/product/create')->withErrors(['message','Error create style'])->withInput();
           }

      } catch (Exception $e) {
        dd($e);
      }


    }

    public function edit(Style $style){
        // dd($style);
         $categories = Category::orderBy('cat_name','asc')->get();
         return view('style.edit',compact('style','categories'));
    }

    public function update(Style $style){
      try {
        // dd(request());
         $result = $style->update([
            'style_code' => request('style_code'),
            'description' => request('style_desc'),
            'category_id' => request('cat_id')
          ]);
          session()->flash('message', config('constants.message.success_update'));
          return redirect('/style/main');
      } catch (Exception $e) {
        dd($e);
      }

    }
}
