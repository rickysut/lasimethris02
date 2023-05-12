<?php

use App\Http\Controllers\Api\HelperController;
use App\Http\Controllers\Api\AnggotaMitraController;
use App\Http\Controllers\Api\GetWilayahController;

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

    //Data Realisasi v2
    Route::get('getAPIRealisasiAll', 'RealisasiController@getRealisasiAll');
    Route::get('getAPIRealisasiByYear/{periodetahun}', 'RealisasiController@getRealisasiByYear');

    Route::get('getAPIMonitoringDataByYear/{periodetahun}', 'RealisasiController@MonitoringDataByYear');
    Route::get('getAPIMonitoringDataAll', 'RealisasiController@MonitoringDataAll');

    Route::get('getAPIAnggotaMitraAll', 'AnggotaMitraController@index');
    Route::get('getAPIAnggotaMitraByYear/{periodetahun}', 'AnggotaMitraController@ByYears');
    Route::get('getAPIAnggotaMitra/{id}', 'AnggotaMitraController@show');

    //Data wilayah
    Route::get('getAllProvinsi', 'GetWilayahController@getAllProvinsi');
    Route::get('getKabupatenByProvinsi/{id}', 'GetWilayahController@getKabupatenByProvinsi');
    Route::get('getKecamatanByKabupaten/{id}', 'GetWilayahController@getKecamatanByKabupaten');
    Route::get('getDesaByKecamatan/{id}', 'GetWilayahController@getDesaByKecamatan');

    //data pksmitra
    Route::get('getApiPksMitraAll', 'getPksMitra@getApiPksMitraAll');

    //data Verifikasi v2
    Route::get('getAPIVerifiedByYear/{periodetahun}', 'RealisasiController@getApiVerifiedbyYear');
    Route::get('getAPIVerifiedAll', 'RealisasiController@getAPIVerifiedAll');
});
