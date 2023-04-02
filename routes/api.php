<?php

use App\Http\Controllers\Api\HelperController;

Route::group(['namespace' => 'Api'], function () {

    // Route::post('getAPIAccessToken', 'HelperController@getAPIAccessToken');
    // Provinsi
    Route::get('getAPIProvinsiAll', 'HelperController@getprovinsi');
    //Kabupaten
    Route::get('getAPIKabupatenAll', 'HelperController@getkabupaten');
    Route::get('getAPIKabupatenProp', 'HelperController@getKabupatenProp');
    //Kecamatan
    Route::get('getAPIKecamatanAll', 'HelperController@getkecamatan');
    Route::get('getAPIKecamatanKab', 'HelperController@getKecamatanKab');
    Route::get('getAPIKecamatan', 'HelperController@getKecamatanKode');

    //Desa
    Route::get('getAPIDesaAll', 'HelperController@getdesa');
    Route::get('getAPIDesaKec', 'HelperController@getDesaKec');
    Route::get('getAPIDesa', 'HelperController@getDesaKode');
});
