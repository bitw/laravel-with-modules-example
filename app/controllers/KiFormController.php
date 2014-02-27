<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 26.02.14
 * Time: 17:55
 */

//use \BaseController;

class KiFormController extends \BaseController
{
    public function postForm()
    {

        $foreigner = new Foreigner();

        $foreigner->name = Input::get('participant_name');
        $foreigner->surname = Input::get('participant_surname');
        $foreigner->organization = Input::get('participant_organization');
        $foreigner->phone = Input::get('participant_phone');
        $foreigner->email = Input::get('participant_email');
        $foreigner->data = serialize(Input::all());
        $foreigner->key = str_random(8);
        $foreigner->payment_amount = Input::get('total');

        $foreigner->save();

        //var_dump($foreigner->toArray());

        return Response::json(array('html'=>$this->ConfirmationPaid($foreigner)));

    }

    public function Paid($status)
    {
        return Response::json(Input::all());
    }

    public function cancelCheck($key, $email)
    {
        $check = Foreigner::where('key', '=', $key)->where('email', '=', $email)->get()->first();

        if($check) $check->delete();

        return Redirect::to('/#/foreigner');
    }

    private function ConfirmationPaid($order)
    {
        // Оплата заданной суммы с выбором валюты на сайте ROBOKASSA
        // Payment of the set sum with a choice of currency on site ROBOKASSA

        // регистрационная информация (логин, пароль #1)
        // registration info (login, password #1)
        $mrh_login = "kirf";
        $mrh_pass1 = "kirf_pass#1";

        // номер заказа
        // number of order
        $inv_id = $order->id;

        // описание заказа
        // order description
        $inv_desc = "ROBOKASSA Advanced User Guide";

        // сумма заказа
        // sum of order
        $out_summ = $order->payment_amount;

        // тип товара
        // code of goods
        $shp_paid_key = $order->key;

        // предлагаемая валюта платежа
        // default payment e-currency
        $in_curr = "";

        // язык
        // language
        $culture = "en";

        // формирование подписи
        // generate signature
        $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_paid_key=$shp_paid_key");

        // форма оплаты товара
        // payment form
        return View::make('confirmation_paid', array(
            'mrh_login'     => $mrh_login,
            'inv_id'        => $inv_id,
            'inv_desc'      => $inv_desc,
            'out_summ'      => $out_summ,
            'shp_paid_key'  => $shp_paid_key,
            'in_curr'       => $in_curr,
            'culture'       => $culture,
            'crc'           => $crc,
            'order'         => $order,
        ))->render();
    }
}