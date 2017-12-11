<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $attributes = Attribute::orderBy('created_at','desc')->paginate(5);
          return view('attributes.index',compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
         $result =  Attribute::create([
           'name'=> request('name'),
           'created_by'=> auth()->user()->id
       ]);
       session()->flash('message','Complate create attribute: '.request('name'));
        return redirect('/attribute');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
      
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
          $attribute = Attribute::where('attribute_id',request('attribute_id'))->first();
        if($attribute){
             return view('attributes.edit',compact('attribute'));
        }else{
             return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
         $result = Attribute::where('attribute_id',request('attribute_id'))->update(['name'=>request('name')]);
       
       session()->flash('message','Update Success attribute: '.request('name'));

        return redirect('/attribute');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        if(count(Attribute::where('attribute_id',request('attribute_id'))->first()->values) > 0)
          {
            return redirect('/attribute')->withErrors([
                'message' =>  'Can not delete this attribute, have some values.'
            ]);
          }else{
            $result = Attribute::where('attribute_id',request('attribute_id'))->delete();
            session()->flash('message','Delete completed!!!');
            return redirect('/attribute');
          }  
    }
}
