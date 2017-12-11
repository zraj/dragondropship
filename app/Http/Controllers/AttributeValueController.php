<?php

namespace App\Http\Controllers;

use App\AttributeValue;
use App\Attribute;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
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
        $att = Attribute::where('attribute_id',request('attribute_id'))->first();
        return view('attributes.values.create',compact('att'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
        // dd(request());
        $result = AttributeValue::create([
            'value_name' => request('value_name'),
            'attribute_id' => request('attribute_id'),
            'created_by' => auth()->user()->id
        ]);
        session()->flash('message','Success add value : '.$result->value_name);
      //  dd($result);
         return redirect('/attribute');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $result = AttributeValue::where('att_value_id',request('att_value_id'))->delete();
        session()->flash('message','delete success');
        return back();
    }
}
