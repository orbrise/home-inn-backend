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

Route::middleware('web')->prefix('customers')->group( function(){

Route::get('/', 'CustomerLogin@index')->name('login');
Route::post('/dologin','CustomerLogin@MakeLogin');

Route::get('/dashboard', 'HomeController@index');

Route::get('/company-setting', 'HomeController@ViewCompanySetting');
Route::post('/savecompanydata', 'HomeController@SaveCompanyData');
Route::get('/logout', 'HomeController@LogOut');

#======================================product section

         #====catagories ====

Route::get('/categories/{level?}/{catid?}/{shopid?}/{id?}','ProductManage@index');
Route::post('/addcategory', 'ProductManage@AddCat');
Route::get('/editcat/{catid}', 'ProductManage@EditCat');
Route::post('/updatecat/', 'ProductManage@UpdateCat');
Route::get('/deletecat/{id}/', 'ProductManage@DelCat');

# =========== attributes ====

Route::get('/attributes', 'ProductManage@Attrs');

#===== product ajax urls

Route::post('/addnewattr', 'AjaxContoller@CreateAttr');
Route::post('/getattrval', 'AjaxContoller@GetAttrVal');
Route::post('/addattroption', 'AjaxContoller@SaveOptionVal');
Route::post('/updateattroption', 'AjaxContoller@UpdateOptionVal');
Route::post('/deletegroupattr', 'AjaxContoller@DeleteGroupAttr');
Route::post('/deleteattroption', 'AjaxContoller@DeleteAttrOption');
Route::post('/getlevels1', 'AjaxContoller@GetLevel1');
Route::post('/appendattr', 'AjaxContoller@AppendAttr');
Route::post('/getopts', 'AjaxContoller@Getoptions');
Route::post('/appendbrand', 'AjaxContoller@AppendBrand');
Route::post('/deleteattr', 'AjaxContoller@DelAttr');
Route::post('/coverimg', 'AjaxContoller@CoverImg');
Route::post('/delimg', 'AjaxContoller@DelImg');
Route::post('/saveattr', 'AjaxContoller@SaveAttr');
Route::post('/searchproduct', 'AjaxContoller@SearchProduct');
Route::post('/isfeatured', 'AjaxContoller@FeaturedProduct');
Route::post('/updatecatgroup', 'AjaxContoller@UpdateCatGroup');
Route::post('/updatecurl', 'AjaxContoller@UpdateCurl');

# ====== end ajax


# === ading product

Route::get('/add-new-product', 'ProductManage@AddNewProduct');
Route::get('/brands', 'ProductManage@Brands');
Route::post('/addnewproductpost', 'ProductManage@AddNewProductPost');
Route::post('/addcoversion', 'ProductManage@AddNewConversion');
Route::get('/delconversion/{convid}', 'ProductManage@DeleteConv');



Route::get('/products', 'ProductManage@AllProducts');
Route::get('/products/featured', 'ProductManage@FeaturedProducts');
Route::get('/edit-product/{prod_id}', 'ProductManage@EditProduct');
Route::post('/editproduct', 'ProductManage@EditProductInfo');
Route::post('/addnewbrand', 'ProductManage@AddNewBrand');
Route::get('/delbrand/{id}', 'ProductManage@DellBrand');
Route::get('/delprod/{id}', 'ProductManage@DellProd');
Route::get('/activeprod/{id}', 'ProductManage@ActivateProd');
Route::get('/currency-conversion', 'ProductManage@CurrencyChanger');
Route::get('/shipment-charges', 'ProductManage@ShipmentCharges');
Route::post('/addshipment', 'ProductManage@AddShipment');
Route::get('/delshipment/{id}', 'ProductManage@DellShipment');
#==================================end product section

#ordres -=============

Route::get('/orders', 'HomeController@Orders');
Route::get('/orderview/{orderno}', 'HomeController@OrderView');
Route::post('/updateorderstatus', 'HomeController@UpdateOrderStatus');

## ------------- Blogs
Route::get('/blogs', 'HomeController@Blogs');
Route::get('/newblog', 'HomeController@NewBlog');
Route::post('/addnewpost', 'HomeController@NewPost');
Route::get('/editpost/{id}', 'HomeController@EditPost');
Route::post('/updatepost', 'HomeController@UpdatePost');
Route::get('/activepost/{id}', 'HomeController@ActivePost');
Route::get('/inactive/{id}', 'HomeController@InactivePost');


# == venders ==================

Route::get('/vendors', 'HomeController@Vendors');
Route::get('/newvendor', 'HomeController@NewVendor');
Route::post('/addnewvendor', 'HomeController@AddNewVendor');


});