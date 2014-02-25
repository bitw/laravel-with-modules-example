<?php

Route::get('/',  array(
	'as'    => 'frontend',
	'uses'  => 'App\Modules\Frontend\Controllers\FrontendController@getIndex'
));