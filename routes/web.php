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
    return view('auth.login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/customsearch', 'HomeController@index');
Route::group(['middleware' => 'auth'], function()
{
    /*
    |   Account |
    */
    Route::get('/profile/{id}', 'AccountController@find');

    /*
    |	Track Record |
    */
    Route::get('/find/records', 'SearchController@index');
    Route::get('/find/records/{id}', 'SearchController@find');


    /*
    |	Office Web Routes 	|
    */
    Route::get('/create/office', 'OfficeController@create');
    Route::post('/store/office', 'OfficeController@store');
    Route::get('/edit/office/{id}', 'OfficeController@edit');
    Route::post('/update/office/{id}', 'OfficeController@update');

    /*
    |	Purchase Request Description Web Routes 	|
    */
    Route::get('/create/prdescription', 'PrDescriptionController@create');
    Route::post('/store/prdescription', 'PrDescriptionController@store');
    Route::get('/edit/prdescription/{id}', 'PrDescriptionController@edit');
    Route::post('/update/prdescription/{id}', 'PrDescriptionController@update');

    /*
    |	Process Types Web Routes 	|
    */
    Route::get('/create/processtype', 'ProcessTypeController@create');
    Route::post('/store/processtype', 'ProcessTypeController@store');
    Route::get('/edit/processtype/{id}', 'ProcessTypeController@edit');
    Route::post('/update/processtype/{id}', 'ProcessTypeController@update');

    /*
    |	Transactions Web Routes 	|
    */
    Route::get('/create/transaction', 'TransactionController@create')->middleware('checkuser');
    Route::post('/store/transaction', 'TransactionController@store');
    Route::get('/edit/transaction/{id}', 'TransactionController@edit');
    Route::post('/update/transaction/{id}', 'TransactionController@update');
    Route::get('/view/transaction/{id}', 'TransactionController@view');
    Route::get('/barcode/transaction/{id}', 'TransactionController@barcode');

    /*
    |	Endorsement Web Routes 	|
    */
    Route::get('/endorsement', 'EndorsementController@index');
    Route::get('/create/endorsement/{id}', 'EndorsementController@create');
    Route::post('/store/endorsement/{id}', 'EndorsementController@store');
    Route::get('/endorsement/status/accepted/{id}', 'EndorsementController@accept');
    Route::get('/edit/endorsement/{id}', 'EndorsementController@edit');
    Route::post('/update/endorsement/{id}', 'EndorsementController@update');
    Route::get('/view/endorsement/{id}', 'EndorsementController@view');
    Route::get('/endorsement/history/', 'EndorsementController@history');
    Route::get('/endorsement/edit/records/{id}', 'EndorsementController@edit');
    Route::get('/endorsement/delete/records/{id}', 'EndorsementController@delete');

    /*
    |	Event Update Web Routes 	|
    */
    Route::get('create/document/update/{id}', 'EventUpdateController@create');
    Route::POST('create/document/store/{id}', 'EventUpdateController@store');
    Route::get('create/document/delete/{id}', 'EventUpdateController@delete');

    /*
    |   Reports  |
    */
    Route::get('/view/reports/summary', 'HomeController@summary');
    Route::get('/summary/customsearch', 'HomeController@summary');
});
