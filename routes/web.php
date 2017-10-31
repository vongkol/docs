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

Route::get('/admin',"HomeController@index");
Route::get("/", "FrontController@index");
Route::get("/request", "FrontController@request");
Route::get("/front/login", "FrontController@login");
Route::post("/front/dologin", "FrontController@dologin");
Route::get("/front/logout", "FrontController@logout");
Route::get("/front/sub1/{id}", "FrontController@sub1");
Route::get("/front/sub2/{id}", "FrontController@sub2");
Route::get("/front/sub3/{id}", "FrontController@sub3");
Route::get("/front/sub4/{id}", "FrontController@sub4");
Route::get("/front/search", "FrontController@search");
Route::get("/front/dosearch", "FrontController@do_search");
Route::get("/front/setting", "FrontController@setting");
Route::post("/front/dosetting", "FrontController@dosetting");
Route::get("/front/home", "FrontController@home");
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");
Route::get('/user/branch/{id}', "UserController@branch");
Route::post('/user/branch/save', "UserController@add_branch");
Route::get('/user/branch/delete/{id}', "UserController@delete_branch");
// role
Route::get('/role', "RoleController@index");
Route::get('/role/create', "RoleController@create");
Route::post('/role/save', "RoleController@save");
Route::get('/role/delete/{id}', "RoleController@delete");
Route::get('/role/edit/{id}', "RoleController@edit");
Route::post('/role/update', "RoleController@update");
Route::get('/role/permission/{id}', "PermissionController@index");
Route::post('/rolepermission/save', "PermissionController@save");

// document
Route::get("/document", 'DocumentController@index');
Route::get("/category", 'CategoryController@index');
Route::post("/category/save", 'CategoryController@save');
Route::get("/category/delete/{id}", "CategoryController@delete");
Route::post('/category/update', "CategoryController@update");
// subcategory 1
Route::get('/sub1/{id}', "CategoryController@sub1");
Route::get('/sub1/delete/{id}', "CategoryController@deletesub1");
Route::post('/sub1/save', "CategoryController@savesub1");
Route::post('/sub1/update', "CategoryController@updatesub1");
// subcategory 2
Route::get('/sub2/{id}', "CategoryController@sub2");
Route::post('/sub2/save', "Sub2Controller@save");
Route::post('/sub2/update', "Sub2Controller@update");
Route::get('/sub2/delete/{id}', "Sub2Controller@delete");
// subcategory 3
Route::get('/sub3/{id}', "Sub3Controller@index");
Route::post('/sub3/save', "Sub3Controller@save");
Route::post('/sub3/update', "Sub3Controller@update");
Route::get('/sub3/delete/{id}', "Sub3Controller@delete");
// document
Route::post("/document/get", "DocumentController@get");
Route::get("/document/delete/{id}", "DocumentController@delete");
Route::post("/document/save", "DocumentController@save");
// asset
Route::get("/asset", "AssetController@index");
Route::get("/asset/create", "AssetController@create");
Route::get("/asset/edit/{id}", "AssetController@edit");
Route::get("/asset/delete/{id}", "AssetController@delete");
Route::post("/asset/save", "AssetController@save");
Route::post("/asset/update", "AssetController@update");

// Slider
Route::get("/slider", "PhotoController@index");
Route::get("/slider/create", "PhotoController@create");
Route::post("/slider/save", "PhotoController@save");
Route::get("/slider/delete/{id}", "PhotoController@delete");
Route::get("/slider/edit/{id}", "PhotoController@edit");
Route::post("/slider/update", "PhotoController@update");