<?php

Route::get('signin',  array(
	'as'    => 'users.signin',
	'uses'  => 'App\Modules\Users\Controllers\UsersController@getSignin'
));

Route::post('signin', array(
	'as'    => 'users.signin.post',
	'uses'  => 'App\Modules\Users\Controllers\UsersController@postSignin'
));

Route::get('signout', array(
	'as'    => 'users.signout',
	'uses'  => 'App\Modules\Users\Controllers\UsersController@getSignout'
));