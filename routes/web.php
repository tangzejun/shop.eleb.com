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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shop_categories','Shop_categoryController');

Route::resource('shops','ShopController');

Route::resource('shopusers','ShopUsersController');
Route::get('shopusers_editPassword','ShopUsersController@editPassword')->name('shopusers.editPassword');
Route::post('shopusers_updatePassword','ShopUsersController@updatePassword')->name('shopusers.updatePassword');

//登录
Route::get('login','SessionController@login')->name('login');
//验证
Route::post('login','SessionController@store')->name('login');
//注销
Route::delete('logout','SessionController@logout')->name('logout');

//菜品分类
Route::resource('menucategories','MenuCategoryController');

//菜品
Route::resource('menus','MenusController');

//上传图片
Route::post('upload',function (){
    $storage = \Illuminate\Support\Facades\Storage::disk('oss');
    $fileName = $storage->url($storage->putFile('upload',request()->file('file')));
    return [
        'fileName'=>$fileName
    ];
})->name('upload');