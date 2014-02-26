<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 26.02.14
 * Time: 14:58
 */

use \BaseController;

class HomeController extends BaseController
{
    public function getIndex()
    {
        return View::make('home.index');
    }
}