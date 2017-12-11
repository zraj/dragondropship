<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::auth();
Route::group(['middleware'=>['admin']],function(){

  Route::get('/createuser','UserController@create')->middleware('admin');
  Route::post('/registration','UserController@registration')->middleware('admin');
  Route::get('/viewprofile/{user}','UserController@viewprofile')->middleware('admin');

});

Route::group(['middleware'=>['auth']],function(){
  Route::get('/', function () {
      return view('dashboard');
  })->middleware('auth')->name('home');

  Route::get('/dash', function () {
      return view('dashboard');
  })->middleware('auth');


  Route::get('/master', function () {
      return view('home');
  })->middleware('auth');
  Route::get('/home', function () {
      return view('dashboard');
  });
  Route::get('/logout','UserController@destroy');
  Route::get('/profile','UserController@profile');
  Route::get('/listuser','UserController@listuser');
  
});



Route::get('/login','UserController@index')->middleware('guest')->name('login');
Route::post('/login','UserController@login')->middleware('guest');

// Route::get('/createuser','UserController@create')->middleware('admin');
// Route::post('/registration','UserController@registration')->middleware('admin');
// Route::get('/viewprofile/{user}','UserController@viewprofile')->middleware('admin');


Route::get('/category','CategoryController@index');
Route::post('/display_cat','CategoryController@display');
Route::post('/edit_cat','CategoryController@update');
Route::post('/create_cat','CategoryController@store');
Route::get('/create_cat','CategoryController@create');
Route::post('/delete_cat','CategoryController@destroy');

Route::get('/attribute','AttributeController@index');
Route::get('/create_att','AttributeController@create');
Route::post('/create_att','AttributeController@store');
Route::get('/edit_att','AttributeController@edit');
Route::post('/edit_att','AttributeController@update');
Route::post('/delete_att','AttributeController@destroy');

Route::get('/create_att_value','AttributeValueController@create');
Route::post('/create_att_value','AttributeValueController@store');
Route::post('/del_att_val','AttributeValueController@destroy');

Route::resource('catAttributes','CatAttributesController');

Route::get('photo/{product}','PhotoController@showgal');
Route::get('gallery/create/{store_id}','PhotoController@index');
// Route::post('gallery/create','PhotoController@create');
Route::get('gallery/show','PhotoController@create');
Route::post('gallery/upload','PhotoController@upload');
Route::resource('photo','PhotoController');


Route::get('/product','ProductController@index');
Route::post('/product','ProductController@store');
// Route::get('product/create','ProductController@create');
Route::get('product/create','ProductController@precreate');
Route::get('product/precreate/{store_id}','ProductController@precreate');
Route::post('product/create','ProductController@create2');
Route::post('product/groupedit','ProductController@groupedit');
Route::post('product/groupsave','ProductController@groupsave');
Route::get('product/{product}','ProductController@show');
Route::delete('product/{product}','ProductController@destroy');
Route::get('product/dropdown_att/{id}','ProductController@dropdown_att');
Route::post('updatelevel','ProductController@updatelevel');
Route::get('editproduct/{product}','ProductController@edit');
Route::post('updateproduct','ProductController@updateproduct');
Route::get('barcodeproduct/{product}','ProductController@genbarcode');
Route::post('barcodeproduct','ProductController@printbarcode');
Route::get('checkitemcode/{itemcode}','ProductController@check_itemcode');
Route::get('productqty/{product}','ProductController@productqty');
Route::post('adjustqty','ProductController@adjustqty');
Route::post('/searchproduct','ProductController@search');

Route::resource('supplier','SupplierController');
Route::resource('reseller','ResellerController');

Route::get('/province/{zipcode}','AddressContorller@getprovince');
Route::get('/amphur/{zipcode}','AddressContorller@getamphur');

Route::get('/store/create','StoreController@create');
Route::get('/store','StoreController@index');
Route::post('/store','StoreController@store');
Route::post('/store/update/{stores}','StoreController@update');
Route::get('/store/edit/{store}','StoreController@edit');

Route::get('/storegroup/{supplier_id}','StoreController@storegroup');
Route::get('/productgroup/{store_id}','ProductController@productgroup');

Route::get('/style/main','StyleController@main');
Route::get('/style/create/{store_id}','StyleController@create');
Route::get('/style/edit/{style}','StyleController@edit');
Route::post('/style/store','StyleController@store');
Route::post('/style/update/{style}','StyleController@update');
Route::get('/shipping','ShippingController@index');
Route::get('/shipping/create','ShippingController@create');
Route::post('/shipping','ShippingController@store');

Route::get('/deposit','CashController@deposit_index');
Route::post('/deposit','CashController@deposit');
Route::get('/withdraw','CashController@withdraw_index');
Route::post('/withdraw','CashController@withdraw');
Route::get('/cash','CashController@index');
Route::get('/cashadmin','CashController@cash_admin');
Route::post('/approvecash/{tran}','CashController@approvecash');
Route::post('/rejectcash/{tran}','CashController@rejectcash');

Route::get('/subscribe/{reseller}','ResellerController@subscribe_index');
Route::post('/subscribe/add','ResellerController@subscribe_add');
Route::post('/subscribe/create','ResellerController@subscribe_create');
Route::post('/subscribe/remove','ResellerController@subscribe_remove');
Route::post('/createshop','ShopController@store');
Route::post('/removeshop','ShopController@remove');

Route::get('/cart','CartController@index');
Route::get('/cartcount','CartController@cartcount');
Route::post('/addcart','CartController@addcart');
Route::post('/updatecartqty/{cart}','CartController@updateqty');
Route::post('/removecart/{cart}','CartController@removecart');

Route::post('/orderreview','OrderController@review');
Route::post('/createorder','OrderController@createorder');

Route::get('/myorder','OrderController@myorder');
Route::get('/orderview/{order}','OrderController@orderview');
Route::get('/cancelorder/{order}','OrderController@cancelorder');
Route::get('/processorder/{order}','OrderController@processorder');
Route::get('/getorderdetail/{order}','OrderController@json_orderdetail');
Route::get('/updatepacking/{order}','OrderController@updatepacking');
Route::get('/ordership','OrderController@waitshippingorder');
