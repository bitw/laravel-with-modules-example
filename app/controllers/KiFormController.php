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

    private function ConfirmationPaid($order)
    {
        // 1.
        // Оплата заданной суммы с выбором валюты на сайте мерчанта
        // Payment of the set sum with a choice of currency on merchant site

        // регистрационная информация (логин, пароль #1)
        // registration info (login, password #1)
        $mrh_login = "kirf";
        $mrh_pass1 = "korf_pass#1";

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

        // кодировка
        // encoding
        $encoding = "utf-8";

        // формирование подписи
        // generate signature
        $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_paid_key");

        // HTML-страница с кассой
        // ROBOKASSA HTML-page
        return "https://merchant.roboxchange.com/Handler/MrchSumPreview.ashx?".
            "MrchLogin=$mrh_login&OutSum=$out_summ&InvId=$inv_id&IncCurrLabel=$in_curr".
            "&Desc=$inv_desc&SignatureValue=$crc&Shp_item=$shp_paid_key".
            "&Culture=$culture&Encoding=$encoding\"";
    }
}