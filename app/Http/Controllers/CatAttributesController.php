<?php

namespace App\Http\Controllers;

use App\CatAttribute;
use Illuminate\Http\Request;
use App\Attribute;

class CatAttributesController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category_id = request('category_id');
        $attributes = Attribute::orderBy('name','asc')->get();
//dd($attributes);
        return view('catattributes.create',compact('category_id','attributes'));
    //     dd(request('category_id'));
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
        $result = CatAttribute::create([
            'category_id'=> request('category_id'),
            'attribute_id'=>request('attribute_id'),
            'created_by'=>auth()->user()->id
        ]);
        // session()->flash('flash_message', 'successfully added!');
        session()->flash('message','Success add : '.$result->attribute->name);
        return redirect('/category');
        // dd(request());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CatAttribute  $catAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(CatAttribute $catAttribute)
    {
        //
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatAttribute  $catAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit(CatAttribute $catAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CatAttribute  $catAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatAttribute $catAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CatAttribute  $catAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatAttribute $catAttribute)
    {
        $result = $catAttribute->delete();
         session()->flash('message','Delete success : ');
        return redirect('/category');
        //
        // $result = CatAttribute::
    }
}
