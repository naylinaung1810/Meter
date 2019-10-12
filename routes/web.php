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


Auth::routes();
//
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login',[
    'uses'=>'AuthController@getSignIn',
    'as'=>'login'
]);

Route::post('/login',[
    'uses'=>'AuthController@postSignIn',
    'as'=>'login'
]);






Route::group(['middleware'=>'auth'], function () {
    Route::get('/dashboard',[
        'uses'=>'AdminController@getDashboard',
        'as'=>'dashboard'
    ]);
    Route::get('/', function () {
        return view('adminView.welcome');
    });

    Route::get('/logout',[
        'uses'=>'AuthController@logout',
        'as'=>'logout'
    ]);
    Route::post('/password/change',[
        'uses'=>'AuthController@passwordChange',
        'as'=>'change.password'
    ]);
    Route::get('/password/change',[
        'uses'=>'AuthController@passwordChangeView',
        'as'=>'change.password'
    ]);

    Route::get('/account/info',[
        'uses'=>'AdminController@getAccInfo',
        'as'=>'account.info'
    ]);

    Route::post('/account/bill',[
        'uses'=>'AdminController@postBill',
        'as'=>'account.bill'
    ]);


    Route::post('/meter/checkout',[
        'uses'=>'MeterController@postMeterCheckout',
        'as'=>'meter.checkout'
    ]);

    Route::group(['middleware' => ['role:admin']],function (){

        Route::post('/new-user',[
            'uses'=>'AuthController@postNewUser',
            'as'=>'new-user'
        ]);

        Route::get('/new-user',[
            'uses'=>'AuthController@getNewUser',
            'as'=>'new-user'
        ]);

        Route::get('/all/users',[
            'uses'=>'AdminController@getAllUsers',
            'as'=>'users'
        ]);

        Route::post('/user/remove',[
            'uses'=>'AdminController@postRemoveUser',
            'as'=>'remove.user'
        ]);

        Route::post('/user/edit',[
            'uses'=>'AdminController@postEditUser',
            'as'=>'edit.user'
        ]);

        Route::get('/key',[
            'uses'=>'AdminController@getKey',
            'as'=>'key'
        ]);

        Route::post('/key/create',[
            'uses'=>'AdminController@getKeyCreate',
            'as'=>'key.create'
        ]);

        Route::get('/key/print',[
            'uses'=>'AdminController@getKeyPrint',
            'as'=>'key.print'
        ]);

        Route::post('/key/print',[
            'uses'=>'AdminController@postKeyPrint',
            'as'=>'key.print'
        ]);

        Route::get('/key/barcode',[
            'uses'=>'AdminController@getBarcode',
            'as'=>'key.barcode'
        ]);

        Route::get('/user/detail/id/{id}',[
            'uses'=>'AdminController@getUserDetail',
            'as'=>'user.detail'
        ]);

        Route::get('/key/detail/id/{id}',[
            'uses'=>'AdminController@getKeyDetail',
            'as'=>'key.detail'
        ]);

        Route::get('/meter/data',[
            'uses'=>'MeterController@getMeter',
            'as'=>'meter'
        ]);

        Route::post('/meter/new-meter',[
            'uses'=>'MeterController@postMeter',
            'as'=>'meter.new'
        ]);
        Route::get('/meter/check',[
            'uses'=>'MeterController@getCheckMeter',
            'as'=>'meter.check'
        ]);

        Route::post('/meter/check',[
            'uses'=>'MeterController@postCheckMeter',
            'as'=>'meter.check'
        ]);

        Route::get('/meter/checkout/admin/id/{id}',[
            'uses'=>'MeterController@adminCheckout',
            'as'=>'meter.checkout.admin'
        ]);

        Route::get('/meter/user/id/{id}',[
            'uses'=>'MeterController@getMeterUser',
            'as'=>'meter.user'
        ]);

    });

});