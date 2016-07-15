<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',[
  'as'=>'index',
  'uses'=>'HomeController@index'
]);

Route::get('/kk',[
  'as'=>'kk.index',
  'uses'=>'KKController@index'
]);

Route::get('/kk/list',[
  'as'=>'kk.list',
  'uses'=>'KKController@getList'
]);

Route::get('/kk/add',[
  'as'=>'kk.add',
  'uses'=>'KKController@add'
]);

Route::post('/kk/add',[
  'as'=>'kk.add',
  'uses'=>'KKController@store'
]);

Route::get('/kk/edit/{id}',[
  'as'=>'kk.edit',
  'uses'=>'KKController@edit'
]);

Route::post('/kk/edit/{id}',[
  'as'=>'kk.edit',
  'uses'=>'KKController@update'
]);

Route::post('/kk/delete/{id}',[
  'as'=>'kk.delete',
  'uses'=>'KKController@deleteKK'
]);

Route::get('/penduduk',[
    'as'=>'penduduk.index',
    'uses'=>'PendudukController@index'
]);

Route::get('/penduduk/list',[
    'as'=>'penduduk.list',
    'uses'=>'PendudukController@getList'
]);

Route::get('/penduduk/jumpkk/{id}',[
    'as'=>'penduduk.jumpKK',
    'uses'=>'PendudukController@jumpKK'
]);

Route::get('/template',[
    'as'=>'template.index',
    'uses'=>'TemplateController@index'
]);

Route::post('/storekk',[
    'as'=>'template.storekk',
    'uses'=>'TemplateController@storekk'
]);

Route::post('/storependuduk',[
    'as'=>'template.storependuduk',
    'uses'=>'TemplateController@storependuduk'
]);


/*
Route::get('/storetest',function(){
    return view('storetest');
});

Route::get('/gettest','HomeController@gettest');

Route::post('/storetest','HomeController@storetest');
*/
