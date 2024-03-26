<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('logout', 'Auth\LoginController@logout');

Route::middleware(['auth'])->group(function () {
    Route::get('home', 'HomeController@index');

    Route::prefix('table')->group(function () {
        Route::get('', 'Table\TableController@index');
    });

    Route::prefix('settings-system')->group(function () {
        Route::prefix('/work-status')->group(function () {
            Route::get('', 'Settings\SetStatusController@index');

            Route::get('/table-work-status', 'Settings\SetStatusController@showDataStatus');
            Route::post('/save-work-status', 'Settings\SetStatusController@saveDataWorkStatus');
            Route::get('/show-edit-status/{statusID}','Settings\SetStatusController@showEditStatus');
            Route::post('/edit-work-status/{statusID}','Settings\SetStatusController@editStatus');

            Route::get('/table-flag-type', 'Settings\SetStatusController@showDataFlagType');
            Route::post('/save-flag-type','Settings\SetStatusController@saveDataFlagType');
            Route::get('/show-edit-flag-type/{typeID}','Settings\SetStatusController@showEditFlagType');
            Route::post('/edit-work-flag-type/{typeID}','Settings\SetStatusController@editFlagType');
        });

        Route::prefix('/menu')->group(function () {
            Route::get('', 'Settings\MenuController@index');
        });

        Route::prefix('/about-company')->group(function () {
            Route::get('', 'Settings\AboutCompanyController@index');

            Route::get('/table-company', 'Settings\AboutCompanyController@showDataCompany');
            Route::get('/table-department', 'Settings\AboutCompanyController@showDataDepartment');
            Route::get('/table-group', 'Settings\AboutCompanyController@showDataGroup');

            Route::post('/save-company', 'Settings\AboutCompanyController@saveDataCompany');


            Route::post('/save-department', 'Settings\AboutCompanyController@saveDataDepartment');
            Route::post('/save-group', 'Settings\AboutCompanyController@saveDataGroup');

        });
    });


    Route::prefix('getMaster')->group(function () {
        Route::get('/get-company/{id}','Master\getDataMasterController@getDataCompany');
        Route::get('/get-department/{id}','Master\getDataMasterController@getDataDepartment');
    });

    Route::prefix('test')->group(function () {
        Route::post('', 'Test\KongkiatController@index');
    });
});


//Clear route cache:
Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});
