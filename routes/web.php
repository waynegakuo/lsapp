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

//passing a route dynamically-->> instance you wanna have the user's ID & name passed over
//you could use the ID to probably get customer's informaation on the page
// Route::get ('/users/{id}/{name}', function ($id, $name){
//   return "This user is called ".$name." whose ID number is ".$id;
// });
// Route::get('/hello', function () {
//     return "<h1>Hello Wayne Gakuo. This is a new page you have created on web.php</h1>";
// });

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'PagesController@index'); //went to the PagesController and used the function called index

Route::get ('/about', 'PagesController@about');

Route:: get ('/services', 'PagesController@services');

Route:: resource ('posts', 'PostsController'); //table name, then the controller

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
