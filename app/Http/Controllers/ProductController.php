<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductAttribute;
use App\Supplier;
use App\Stores;
use App\Style;
use App\Photo;
use App\Logs;
use PDF_Code128;
use App\Inventory;
use App\Subscribe;
use App\Shop;


class ProductController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      try {
        if (auth()->user()->user_type == config('constants.admintype')) {
          $products = Product::orderBy('created_at','desc')->paginate(10);
          return view('product.index',compact('products'));
        }elseif (auth()->user()->user_type == config('constants.suppliertype')) {
          $storeid = Stores::where('supplier_id',auth()->user()->supplier->id)->pluck('id');
          $products = Product::whereIn('store_id',$storeid)->orderBy('created_at','desc')->paginate(10);
          return view('product.index',compact('products'));
        }elseif (auth()->user()->user_type == config('constants.resellertype')) {
          $storeid = Shop::where('reseller_id',auth()->user()->reseller->id)->pluck('store_id');
          $products = Product::whereIn('store_id',$storeid)->orderBy('created_at','desc')->paginate(10);
          return view('product.resell',compact('products'));

        }elseif (auth()->user()->user_type == config('constants.sellertype')) {
          $storeid = Shop::where('shop_user',auth()->user()->id)->pluck('store_id');
          $products = Product::whereIn('store_id',$storeid)->orderBy('created_at','desc')->paginate(10);
          return view('product.sell',compact('products'));
        }
      } catch (Exception $e) {
         dd($e);
      }
    }

    public function search(){
      try {
        $search_term = request('input-search');
        if (!empty($search_term)) {
          if (auth()->user()->user_type == config('constants.admintype')) {
            $products = Product::orderBy('created_at','desc')->where('item_code',$search_term)->orderBy('created_at','desc')->paginate(10);
            return view('product.index',compact('products'));
          }elseif (auth()->user()->user_type == config('constants.suppliertype')) {
            $storeid = Stores::where('supplier_id',auth()->user()->supplier->id)->pluck('id');
            $products = Product::whereIn('store_id',$storeid)->where('item_code',$search_term)->orderBy('created_at','desc')->paginate(10);
            return view('product.index',compact('products'));
          }elseif (auth()->user()->user_type == config('constants.resellertype')) {
            $storeid = Shop::where('reseller_id',auth()->user()->reseller->id)->pluck('store_id');
            $products = Product::whereIn('store_id',$storeid)->where('item_code',$search_term)->orderBy('created_at','desc')->paginate(10);
            return view('product.resell',compact('products'));

          }elseif (auth()->user()->user_type == config('constants.sellertype')) {
            $storeid = Shop::where('shop_user',auth()->user()->id)->pluck('store_id');
            $products = Product::whereIn('store_id',$storeid)->where('item_code',$search_term)->orderBy('created_at','desc')->paginate(10);
            return view('product.sell',compact('products'));
          }
        }else{
           return redirect('/product');
        }

      } catch (Exception $e) {
         dd($e);
      }
    }



    public function create2(){
      try {
        $store = Stores::where('id',request('store_id'))->first();
        $style = Style::where('id',request('style_id'))->first();
         return view('product.create2',compact('store','style'));
      } catch (Exception $e) {
        dd($e);
      }

    }
    public function precreate($store_id){

      if (auth()->user()->user_type == config('constants.admintype') || auth()->user()->user_type == config('constants.suppliertype')) {
          try {
            $store = Stores::where('id',$store_id)->first();
            $styles = Style::where('store_id',$store_id)->get();

            return view('product.precreate',compact('store','styles'));
          } catch (Exception $e) {
            dd($e);
          }
      }else {
        session()->flash('message','Not authorize !!');
        return redirect('/');
      }




    }

    public function create(){
      if (auth()->user()->user_type == config('constants.admintype') || auth()->user()->user_type == config('constants.suppliertype')) {
        # code...
        $category = Category::orderBy('cat_name','asc')->get();
        $stores = null;
        if (auth()->user()->user_type == config('constants.admintype')) {
          $stores =  Stores::orderBy('store_name','asc')->get();
        }else {
          $stores =   Supplier::where('store_user',auth()->id())->get();
          $stores = $stores->stores; //call hasMany
        }

        return view('product.create',compact('category','stores'));
      }else {
        session()->flash('message','Not authorize !!');
        return redirect('/product');
      }
    }
    public function store(){
      try {
        $filename = null;
          // dd(request());
        // if(request()->file('base_image')){
        //      request()->file('base_image')->store('product/base_images','uploads');
        //      $filename = request()->file('base_image')->hashName();
        // }

        $result = Product::create([
            'product_name' => request('product_name'),
            'base_price' => request('base_price'),
            'L1' => request('retail_price'),
            'L2' => request('retail_price'),
            'L3' => request('retail_price'),
            'L4' => request('retail_price'),
            'L5' => request('retail_price'),
            'L6' => request('retail_price'),
            'L7' => request('retail_price'),
            'L8' => request('retail_price'),
            'L9' => request('retail_price'),
            'qty' => 0,
            'weight' => request('weight'),
            'created_by'=> auth()->user()->id,
            'category_id'=> request('category_id'),
            'style_id'=> request('style_id'),
            'item_code'=> request('item_style').request('product_code'),
            'item_style'=> request('item_style'),
            'base_image' => $filename,
            'product_desc' => request('product_desc'),
            'store_id' => request('store_id')
        ]);

        if(count($result)){
              //   foreach(request('att_value_id') as $att)
              //  ProductAttribute::create([
              //    'product_id' => $result->id,
              //    'att_value_id' => $att
              // ]);
              Logs::create([
                 'type' => config('constants.logtype.product_activity'),
                 'action' => config('constants.action.add_product'),
                 'message' => 'สร้างสินค้าใหม่',
                 'ref_id' => $result->id,
                 'created_by' => auth()->user()->id
              ]);
              session()->flash('message','Completed create : '.$result->product_name);
              return redirect('/product');
        }else{
              return redirect('/product/create')->withErrors(['message','Error create product'])->withInput();
        }
      } catch (Exception $e) {
        dd($e);
      }



    }

    public function updateproduct(){
      try {
        $filename = null;
        // dd(request());
        if(request()->hasFile('base_image')){
             request()->file('base_image')->store('product/base_images','uploads');
             $filename = request()->file('base_image')->hashName();
        }else{
          $filename = Product::findOrFail(request('product_id'))->base_image;
        }

        $r = ProductAttribute::where('product_id',request('product_id'))->delete();

         Product::findOrFail(request('product_id'))->update([
            'product_name' => request('product_name'),
            'base_price' => request('base_price'),
            // 'qty' => request('qty'),
              'weight' => request('weight'),
            'created_by'=> auth()->user()->id,
            // 'category_id'=> request('category_id'),
            'base_image' => $filename,
            'product_desc' => request('product_desc')
        ]);


              // foreach(request('att_value_id') as $att)
              // {
              //   ProductAttribute::create([
              //     'product_id' => request('product_id'),
              //     'att_value_id' => $att
              //  ]);
              // }
              Logs::create([
                 'type' => config('constants.logtype.product_activity'),
                 'action' => config('constants.action.update_product'),
                 'message' => 'อัพเดทข้อมูลสินค้า',
                 'ref_id' => request('product_id'),
                 'created_by' => auth()->user()->id
              ]);
              session()->flash('message','Completed update : '.request('product_name'));
              return redirect('/product/'.request('product_id'));

      } catch (Exception $e) {

      }



    }

    public function show(Product $product)
    {
       //
       // dd($product);
       try {
        $gallery =   Photo::where('ref_id',$product->style_id)->orderBy('created_at','desc')->get();
        $logs = Logs::where([
          ['ref_id','=',$product->id],
          ['type','=',config('constants.logtype.product_activity')]

          ])->orderBy('created_at','desc')->get();

           return view('product.show',compact('product','gallery','logs'));
       } catch (Exception $e) {
          dd($e);
       }


    }
    public function edit(Product $product)
    {
      if (auth()->user()->user_type == config('constants.admintype') || auth()->user()->user_type == config('constants.suppliertype')) {
        # code...
        $category = Category::orderBy('cat_name','asc')->get();
        $stores = null;
        if (auth()->user()->user_type == config('constants.admintype')) {
          $stores =  Stores::orderBy('store_name','asc')->get();
        }else {
          $stores =   Supplier::where('store_user',auth()->id())->first();
          $stores = $stores->stores; //call hasMany
        }
        return view('product.edit',compact('category','product','stores'));
      }else {
        session()->flash('message','Not authorize !!');
        return redirect('/product');
      }

    }

    public function updatelevel(){
      try {
        $product = Product::findOrFail(request('product_id'));
        $product->update([
          'L1' => request('level1'),
          'L2' => request('level2'),
          'L3' => request('level3'),
          'L4' => request('level4'),
          'L5' => request('level5'),
          'L6' => request('level6'),
          'L7' => request('level7'),
          'L8' => request('level8'),
          'L9' => request('level9'),
        ]);
        session()->flash('message','update completed.');
        return back();

      } catch (Exception $e) {
        return back()->withErrors(['error:'.$e->message]);
      }


    }

     public function destroy(Product $product)
    {
       //
       // dd($product);
       try {
         $r = ProductAttribute::where('product_id',$product->id)->delete();
         $result = $product->delete();

         if(count($result) == 1){
             session()->flash('message','Delete Completed ');
              return redirect('product');
         }
         else{
             return back()->withErrors(['message','Error : cannot delete product']);
         }
       } catch (Exception $e) {
         return back()->withErrors(['error:'.$e->message]);
       }




    }

    public function dropdown_att($id){

            $category = Category::where('category_id',$id)->first();
            if($category){
                return view('product.dropdown_att',compact('category'));
            }else{
                return back();
            }

    }


    public function productgroup($store_id){
      $products = Product::where('store_id',$store_id)->orderBy('created_at','desc')->paginate(10);
      return view('product.index',compact('products'));
    }

   public function groupedit(){


     try {
       $products = Product::whereIn('id',request('product_id'))->orderBy('item_code','asc')->get();
       return view('product.groupedit',compact('products'));
     } catch (Exception $e) {
        dd($e);
     }

   }

   public function groupsave(){
     try {
        // dd(request());
         foreach (request('product_id') as $key => $value) {
            $product = product::find($value);

            $product->update([
              'L1' => request('L1')[$key],
              'L2' => request('L2')[$key],
              'L3' => request('L3')[$key],
              'L4' => request('L4')[$key],
              'L5' => request('L5')[$key],
              'L6' => request('L6')[$key],
              'L7' => request('L7')[$key],
              'L8' => request('L8')[$key],
              'L9' => request('L9')[$key],
            ]);
         }
         session()->flash('message',config('constants.message.success_update'));
         return redirect('/product');

     } catch (Exception $e) {
       dd($e);
     }

   }

   public function genbarcode(Product $product){
      try {

        return view('product.barcode',compact('product'));
      } catch (Exception $e) {
        dd($e);
      }

   }



   public function printbarcode(){
      try {
           $product = Product::findOrFail(request('product_id'));
           $this->bar_a4($product->item_code);
      } catch (Exception $e) {
        dd($e);
      }

   }

   public function check_itemcode($itemcode){
      try {
          $product_count = Product::where(['item_code'=> $itemcode])->count();
          echo $product_count;
          //dd($product);
      } catch (Exception $e) {
         echo $e->getMessage();
      }

   }


   public function bar_a4($item_code)
   {
     try {
       include(app_path() . '\functions\code128\code128.php');

       $pdf=new PDF_Code128();
       $pdf->AddPage();
       $pdf->SetFont('Arial','',10);

       //A set

       $code=$item_code;
       $height = 12;
       $rowoffset = 18;
       /*$pdf->Code128(50,20,$code,80,20);
       $pdf->SetXY(50,45);
       $pdf->Write(5,$code);

       $code='DDL01S45';
       $pdf->Code128(50,70,$code,50,20);
       $pdf->SetXY(50,95);
       $pdf->Write(5,$code);*/

       for($i=0;$i<15;$i++){
       /* $pdf->Code128(10,5 + ( $i * 35),$code,50,20);
       $pdf->SetXY(10,25 + ( $i * 35));
       $pdf->Write(5,$code);

       $pdf->Code128(70,5 + ( $i * 35),$code,50,20);
       $pdf->SetXY(70,25 + ( $i * 35));
       $pdf->Write(5,$code);

       $pdf->Code128(130,5 + ( $i * 35),$code,50,20);
       $pdf->SetXY(130,25 + ( $i * 35));
       $pdf->Write(5,$code); */

       $pdf->Code128(5,5 + ( $i * $rowoffset),$code,35,$height);
       $pdf->SetXY(5,17 + ( $i * $rowoffset));
       $pdf->Write(5,$code);

       $pdf->Code128(45,5 + ( $i * $rowoffset),$code,35,$height);
       $pdf->SetXY(45,17 + ( $i * $rowoffset));
       $pdf->Write(5,$code);

       $pdf->Code128(85,5 + ( $i * $rowoffset),$code,35,$height);
       $pdf->SetXY(85,17 + ( $i * $rowoffset));
       $pdf->Write(5,$code);

       $pdf->Code128(125,5 + ( $i * $rowoffset),$code,35,$height);
       $pdf->SetXY(125,17 + ( $i * $rowoffset));
       $pdf->Write(5,$code);

       $pdf->Code128(165,5 + ( $i * $rowoffset),$code,35,$height);
       $pdf->SetXY(165,17 + ( $i * $rowoffset));
       $pdf->Write(5,$code);
       }
       /*
       //B set
       $code='Code 128';
       $pdf->Code128(50,70,$code,80,20);
       $pdf->SetXY(50,95);
       $pdf->Write(5,'B set: "'.$code.'"');

       //C set
       $code='12345678901234567890';
       $pdf->Code128(50,120,$code,110,20);
       $pdf->SetXY(50,145);
       $pdf->Write(5,'C set: "'.$code.'"');

       //A,C,B sets
       $code='ABCDEFG1234567890AbCdEf';
       $pdf->Code128(50,170,$code,125,20);
       $pdf->SetXY(50,195);
       $pdf->Write(5,'ABC sets combined: "'.$code.'"');
       */
       $pdf->Output();

     } catch (Exception $e) {
       dd($e);
     }

   }


   public function productqty(Product $product)
   {
      try {
         return view('product.qty',compact('product'));

      } catch (Exception $e) {
         dd($e);
      }

   }

   public function qtyupdate($productid,$qty)
   {
     try {

       $product = Product::findOrFail($productid);
       $inv = Inventory::create([
          'product_id' => $product->id,
          'qty' => $qty,
          'created_by' => auth()->user()->id
       ]);
       $sumqty = Inventory::where('product_id',$product->id)->sum('qty');
       $result = $product->update([
          'qty' => $sumqty
       ]);

       Logs::create([
          'type' => config('constants.logtype.product_activity'),
          'action' => config('constants.action.update_product'),
          'message' => 'อัพเดทจำนวนสินค้า : '.$qty.' รวม '.$sumqty ,
          'ref_id' => $productid,
          'created_by' => auth()->user()->id
       ]);

        return $result;

     } catch (Exception $e) {
       return false;
     }
   }

   public function adjustqty()
   {
     try {
      // dd(request());
       $qty = request('qty');
       if (request('adjust_type') == '1') {
        $qty = $qty * 1;
       }elseif (request('adjust_type') == '2') {
        $qty = $qty * -1;
       }
      //  $product = Product::findOrFail(request('product_id'));
      //  $inv = Inventory::create([
      //     'product_id' => $product->id,
      //     'qty' => $qty,
      //     'created_by' => auth()->user()->id
      //  ]);
      //  $sumqty = Inventory::where('product_id',$product->id)->sum('qty');
      //  $result = $product->update([
      //     'qty' => $sumqty
      //  ]);
       //
      //  Logs::create([
      //     'type' => config('constants.logtype.product_activity'),
      //     'action' => config('constants.action.update_product'),
      //     'message' => 'อัพเดทจำนวนสินค้า : '.$qty.' รวม '.$sumqty ,
      //     'ref_id' => request('product_id'),
      //     'created_by' => auth()->user()->id
      //  ]);
      //  dd($result);
      $productid = request('product_id');

      if ($this->qtyupdate($productid,$qty) == false) {
        # code...
      }else {
        return redirect('/product/'.$productid);
      }


     } catch (Exception $e) {
       dd($e);
     }

   }
}
