<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 27.02.14
 * Time: 13:05
 */

class Foreigner extends Eloquent
{
    protected $table = 'foreigners';

    protected $softDelete = true;
}