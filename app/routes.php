<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Blade::setContentTags('<%', '%>'); 		// for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>'); 	// for escaped data

Route::get('/', array(
    'as' => 'index', 'uses' => 'HomeController@getIndex'
));

Route::post('kiform/foreigner', array(
    'as' => 'kiform', 'uses'=> 'KiFormController@postForm'
));

Route::get('form/{status}', array(
    'as' => 'kiform.paid', 'uses' => 'KiFormController@Paid'
));

Route::get('form/foreigner/cancel/{key}/{email}', array(
    'as' => 'kiform.cancel_check', 'uses' => 'KiFormController@cancelCheck'
));