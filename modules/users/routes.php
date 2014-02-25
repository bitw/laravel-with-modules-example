<?php

Route::get('signin',  array(
	'as'    => 'signin',
	'uses'  => 'App\Modules\Users\Controllers\UsersController@getSignin'
));

Route::post('signin', array(
	'as'    => 'signin.post',
	'uses'  => 'App\Modules\Users\Controllers\UsersController@postSignin'
));

Route::get('signout', array(
	'as'    => 'signout',
	'uses'  => 'App\Modules\Users\Controllers\UsersController@getSignout'
));