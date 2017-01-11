<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//rodo welcome page contenta
Route::get('/', 'WelcomeController@index');

//rodo prisijungus page contenta
Route::get('/home', 'HomeController@index');

//login/register pages
Auth::routes();

//about page contentas
Route::get('/aboutPage', function () {
    return view('aboutPage');
});

//rodo itemus
Route::get('/indexItem', 'ItemController@index');

//deda itemus i db
Route::post('/indexItem', 'ItemController@store');

//rodo create item page
Route::get('/createItem', 'ItemController@create');

//rodo konkretaus itemo page pagal id
Route::get('/showItem/{id}', 'ItemController@show');

//rodo userio idetus itemus
Route::get('/userItems', 'ItemController@listUserItems');

//rodo editinamo itemo puslapi
Route::get('/editItem/{id}', 'ItemController@edit');
//update itema
Route::put('/userItems/{id}', 'ItemController@update');
//delete item
Route::delete('/userItems', 'ItemController@destroy');

//itemu pagal kategorija puslapis
Route::get('/itemsByCategory/{category}', 'ItemController@itemsByCategory');

//BIDINIMAS
Route::put('/showItem/{id}', 'ItemController@bidFunction')->where('id', '[0-9]+');

//AJAX padaryt itema neaktyvu
Route::post('/showItem/{id}', 'ItemController@makeItemInactive');

//HOME BANK INFO
Route::put('/home', 'HomeController@enterBankAccNumber');

//show userWins page
Route::get('/userWins', 'ItemController@showUserWinsPage');
//send winner to database
Route::post('/showItem/{id}', 'ItemController@declareWinner');

//search
Route::get('/searchItem', 'QueryController@search');
