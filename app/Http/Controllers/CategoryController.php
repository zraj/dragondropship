<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //

    public function index(){
         $categories = Category::orderBy('cat_code','desc')->paginate(5);
        return view('category.index',compact('categories'));
    }

    public function checkcode($cat_code){
      try {
        return count(Category::where('cat_code',$cat_code)->get());
      } catch (Exception $e) {
        dd($e);
      }

    }


    public function destroy()
    {
         $result = Category::where('category_id',request('category_id'))->delete();

         session()->flash('message','Delete completed!!!');
         return redirect('/category');
    }


    public function update()
    {
       // dd(request());
       try {
          if ($this->checkcode(request('cat_code')) == 0) {
            $result = Category::where('category_id',request('category_id'))
            ->update([
              'cat_name'=> request('cat_name'),
              'cat_code' => request('cat_code')
            ]);

            session()->flash('message','อัพเดทสมบูรณ์ : '.request('cat_name'));

             return redirect('/category');
          }else {
            session()->flash('message','ไม่สามารถอัพเดท : '.request('cat_name'));

             return redirect('/category');
          }
       } catch (Exception $e) {
          dd($e);
       }


    }

    public function display()
    {
        // dd(request());
        $category_id = request('category_id');
        $category = Category::where('category_id',request('category_id'))->first();
        if($category){
             return view('category.display',compact('category'));
        }else{
             return back();
        }


    }

    public function store()
    {
       $result =  Category::create([
           'cat_name'=> request('cat_name'),
            'cat_code'=> request('cat_code'),
           'created_by'=> auth()->user()->id
       ]);
       session()->flash('message','Complete create : '.request('cat_name'));
        return redirect('/category');
    }

    public function create()
    {
        return view('category.create');
    }
}
