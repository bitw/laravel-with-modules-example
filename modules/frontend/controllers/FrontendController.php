<?php namespace App\Modules\Frontend\Controllers;

use View;

class FrontendController extends \BaseController {

	public function getIndex()
	{
		return View::make('frontend::default');
	}

}