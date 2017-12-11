<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Product;
use App\Style;
use App\Stores;
use Illuminate\Http\Request;
use Storage;
use File;

class PhotoController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store_id)
    {
      try {
        $store = Stores::where('id',$store_id)->first();
        $styles = Style::where('store_id',$store_id)->get();
         return view('gallery.precreate',compact('store','styles'));
      } catch (Exception $e) {
        dd($e);
      }

    }

    public function gallery()
    {
      // $styles  = Style::orderBy('')
      return view('gallery.index');
    }
    public function showgal(Product $product){
        // dd($product->gallery);
        // foreach($product->gallery as $gal){
        //     echo $gal->id. ":" . $gal->photo_name;
        // }
        $gallery = $product->gallery;
        return view('gallery.card',compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      try {
        // dd(request());
        $store = Stores::where('id',request('store_id'))->first();
        $style = Style::where('id',request('style_id'))->first();
        $gallery = Photo::where('ref_id',request('style_id'))->orderBy('created_at','desc')->get();
        return view('gallery.show',compact('gallery','style','store'));
      } catch (Exception $e) {
        dd($e);
      }


    }




    public function upload()
    {
      try {
        $ref_id = 0;
        $filename = null;
        if(request('style_id')){
            $ref_id = request('style_id');
        }

        if(request()->file('photo_image')){
             $store_path = 'product/gallery/'.request('item_style');
             request()->file('photo_image')->store($store_path,'uploads');
             $filename = request()->file('photo_image')->hashName();
            $result = Photo::create([
                'ref_id' => $ref_id,
                'photo_name' =>  $filename,
                'created_by'=> auth()->user()->id,
                'item_style' => request('item_style')
            ]);
            if($result){
                return back();;
                // echo "success";
            }else{
                // echo "failed";
                session()->flash('message','failed to upload');
                  return back();
            }

        }else{
             return back();
        }
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
        //
        $ref_id = 0;
        $filename = null;
        if(request('product_id')){
            $ref_id = request('product_id');
        }

        if(request()->file('photo_image')){
             request()->file('photo_image')->store('product/gallery','uploads');
             $filename = request()->file('photo_image')->hashName();
            $result = Photo::create([
                'ref_id' => $ref_id,
                'photo_name' =>  $filename,
                'created_by'=> auth()->user()->id
            ]);
            if($result){
                echo "success";
            }else{
                echo "failed";
            }

        }else{
             return back();
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        try{
           $path= 'uploads/product/gallery/'.$photo->item_style.'/';
         \File::delete($path . $photo->photo_name);
         $photo->delete();

         return back();
        } catch (\Exception $ex) {
          dd($ex);

        }


    }
}
