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
    return redirect()->route('login');
});

Route::get('/address/fetch/firstclasspostcodes/{pcode}', 'HomeController@firstclasspostcodes');

Auth::routes();

Route::get('/page/{slug}', 'SiteController@page');
Route::get('/{slug}', 'SiteController@page')->where('slug', 'about-us|support');

Route::middleware('auth')->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', 'HomeController@index')->name('dashboard');
        Route::get('/statics', 'HomeController@projectStatics')->name('dashboard.statics');
        Route::get('/gantt', 'HomeController@projectGantt')->name('dashboard.gantt');
        Route::get('/suppliervsestimate', 'HomeController@suppliervsestimate')->name('dashboard.suppliervsestimate');
        Route::get('/projecttasktime', 'HomeController@projecttasktime')->name('dashboard.projecttasktime');
        Route::get('/getuserhourthisweek', 'HomeController@getuserhourthisweek')->name('dashboard.getuserhourthisweek');
        Route::get('/purchase-report', 'HomeController@purchaseReports')->name('dashboard.purchase.report.list');
    });

    //Route::get('/dashboard/staff-report', 'HomeController@staffdataReports')->name('dashboard.staff.timesheet.report.info');
    
    //Route::get('/profile/{id}', 'HomeController@profile')->name('profile');
    //Route::post('/profile/update/{id}', 'HomeController@profileUpdate')->name('profile.update');
    Route::post('/change-flag/{table}/{id}', 'HomeController@changeFlag')->name('changeflag');
    Route::post('/change-action/{table}/{id}', 'HomeController@changeAction')->name('changeaction');



    Route::prefix('emailtemplates')->group(function () {
        Route::get('/', 'EmailTemplatesController@index')->name('emailtemplates');
        Route::get('/ajax/list', 'EmailTemplatesController@ajaxList')->name('emailtemplates.ajax.list');
        Route::get('/view/{id}', 'EmailTemplatesController@show');
        Route::get('/add', 'EmailTemplatesController@create')->name('emailtemplates.add');
        Route::post('/store', 'EmailTemplatesController@store')->name('emailtemplates.store');
        Route::post('/update/{id}', 'EmailTemplatesController@update')->name('emailtemplates.update');
        Route::get('/edit/{id}', 'EmailTemplatesController@edit')->name('emailtemplates.edit');

    });
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('storage:link');
    //$exitCode = exec('composer dump-autoload');
    // return what you want
});





