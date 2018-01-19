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

//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect()->route('profile');
})->name('home');

Route::get('/unsubscribe', 'SentMailController@unsubscribeBefore')->name('sentMail.unsubscribeBefore');
Route::post('/unsubscribe', 'SentMailController@unsubscribeAfter')->name('sentMail.unsubscribeAfter');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', 'ProfileController@index')->name('profile');

    Route::get('/campaign/{campaign}/preview', 'CampaignController@preview')->name('campaign.preview')->middleware('can:preview,campaign');

    Route::post('/campaign/{campaign}/send', 'CampaignController@send')->name('campaign.send');

    Route::resource('campaign', 'CampaignController');

    Route::resource('bunch', 'BunchController');

    Route::resource('template', 'TemplateController');

    Route::group(['prefix' => 'bunch/{bunch}', 'middleware' => 'can:view,bunch'], function () {

        Route::resource('subscriber', 'SubscriberController');

    });

    Route::resource('report', 'ReportController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'report/{report}', 'middleware' => 'can:view,report'], function () {

        Route::resource('sentMail', 'SentMailController', ['only' => ['index']]);

    });

});