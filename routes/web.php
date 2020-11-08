<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', 'frontend\FrontendController@index');
Route::any('search/{model}/{type?}', 'SearchController')->name('search');

Route::middleware(['isUser:siteUser',"can:isUser",'emailVerified','activeUser'])->name('user.')->group(function(){
Route::get('/dashboard', 'user\UserController@dashboard')->name('dashboard');
Route::get('/profile', 'user\UserController@profile')->name('profile');
});


// Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
// Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/admin-post', 'user\UserController@post');
Route::namespace('user')->group(function(){
	Route::any('/', 'UserController@login')->name('login');
	Route::get('registration', 'UserController@registration')->name('registration');
	Route::post('create-user', 'UserController@createUser')->name('create-user');
	Route::get('email-verification/{id}', 'UserController@emailVerification')->name('email-verification');
	Route::match(['get','post'],'profile', 'UserController@profile')->name('profile');
	Route::	get('logout', 'UserController@logout')->name('logout');
});


	Route::any('forgot-password', 'CommonController@forgotPassword')->name('forgot-password');
	Route::get('reset-password/{id}', 'CommonController@resetPassword')->name('reset-password');
	Route::post('change-password', 'CommonController@changePassword')->name('change-password');


//  *************for admin *************//

Route::prefix('admin')->name('admin.')->group(function(){
Route::any('/login', 'admin\AdminController@adminLogin')->name('login');
});

Route::middleware(['isAdmin:siteAdmin',"can:isAdmin"])->namespace('admin')->prefix('admin')->name('admin.')->group(function(){
Route::get('dashboard', 'AdminController@index')->name('dashboard');
Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@updateProfile')->name('updateProfile');
Route::match(['get','post'],'settings', 'AdminController@settings')->name('settings');
Route::get('logout', 'AdminController@logout')->name('logout');

Route::get('users', 'UserController@userList')->name('users');
Route::match(['get','post'],'user/add', 'UserController@addUser')->name('user.add');
Route::get('user/view/{id}', 'UserController@userView')->name('user.view');
Route::get('user/edit/{id}', 'UserController@userEdit')->name('user.edit');
Route::post('user/update', 'UserController@userUpdate')->name('user.update');
Route::get('user/block/{user}', 'UserController@blockUser')->name('user.block');
Route::get('user/active/{user}', 'UserController@activeUser')->name('user.active');
Route::match(['get','post'],'user/delete/{id?}', 'UserController@userDelete')->name('user.delete');

Route::get('categories/{id?}', 'CategoryController@index')->name('categories');
Route::match(['get','post'],'category/create/{id?}', 'CategoryController@categoryCreate')->name('category.create');
Route::get('category/edit/{id}', 'CategoryController@categoryEdit')->name('category.edit');
Route::post('category/update', 'CategoryController@categoryUpdate')->name('category.update');
Route::get('category/delete/{id}', 'CategoryController@categoryDelete')->name('category.delete');


});
//  *************for admin *************//


