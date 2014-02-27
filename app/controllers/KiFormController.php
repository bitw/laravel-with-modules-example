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
    private $mrh_login = "kirf";

    // регистрационная информация (логин, пароль #1)
    // registration info (login, password #1)
    private $mrh_pass1 = "kiRFpass1";

    // регистрационная информация (логин, пароль #2)
    // registration info (login, password #2)
    private $mrh_pass2 = "kiRFpass2";

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

        return Response::json(array('html'=>$this->InitPaid($foreigner)));
    }

    public function Result()
    {
        // чтение параметров
        $out_summ       = Input::get("OutSum");
        $inv_id         = Input::get("InvId");
        $shp_paid_key   = Input::get("Shp_paid_key");
        $crc            = Input::get("SignatureValue");

        $crc = strtoupper($crc);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:{$this->mrh_pass2}:Shp_paid_key=$shp_paid_key"));
exit;
        // проверка корректности подписи
        if ($my_crc !=$crc)
        {
            return "bad sign\n";
        }

        $check = Foreigner::where('key', '=', $shp_paid_key)->get()->first();

        $check->paid = true;
        $check->billing_information = serialize(Input::all());

        $check->save();

        return "Ok\n";
    }

    public function Fail()
    {
        $inv_id = Input::get("InvId");
        echo "Вы отказались от оплаты. Заказ# $inv_id\n";
        echo "You have refused payment. Order# $inv_id\n";
        return;
    }

    public function Success()
    {
        // чтение параметров
        $out_summ = Input::get("OutSum");
        $inv_id = Input::get("InvId");
        $shp_paid_key = Input::get("Shp_paid_key");
        $crc = Input::get("SignatureValue");

        $crc = strtoupper($crc);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:{$this->mrh_pass1}:Shp_item=$shp_paid_key"));
echo $crc."<br/>\n";
echo $my_crc;
exit;
        // проверка корректности подписи
        if ($my_crc !=$crc) return "bad sign\n";

        $check = Foreigner::where('key', '=', $shp_paid_key)->get()->first();

        if(!$check)
        {
            // Account will not find
            return View::make('foreigner.success', array('result' => -1))->render();
        }

        if($check && $check->paid == 0)
        {
            // Account of non-payment or even still in the processing queue.
            return View::make('foreigner.success', array('result' => 0))->render();
        }

        //The bill is paid.
        return View::make('foreigner.success', array('result' => 1))->render();
    }

    public function cancelCheck($key, $email)
    {
        $check = Foreigner::where('key', '=', $key)->get()->first();

        if($check) $check->delete();

        return Redirect::to('/#/foreigner');
    }

    private function InitPaid($order)
    {
        // Оплата заданной суммы с выбором валюты на сайте ROBOKASSA

        // номер заказа
        $inv_id = $order->id;

        // описание заказа
        $inv_desc = "ROBOKASSA Advanced User Guide";

        // сумма заказа
        $out_summ = $order->payment_amount;

        // тип товара
        $shp_paid_key = $order->key;

        // предлагаемая валюта платежа
        $in_curr = "";

        // язык
        $culture = "ru";

        // формирование подписи
        $crc  = md5("{$this->mrh_login}:$out_summ:$inv_id:{$this->mrh_pass1}:Shp_paid_key=$shp_paid_key");

        // форма оплаты товара
        $data = array(
            'mrh_login'     => $this->mrh_login,
            'inv_id'        => $inv_id,
            'inv_desc'      => $inv_desc,
            'out_summ'      => $out_summ,
            'shp_paid_key'  => $shp_paid_key,
            'in_curr'       => $in_curr,
            'culture'       => $culture,
            'crc'           => $crc,
            'order'         => $order,
        );

        return View::make('confirmation_paid', $data)->render();
    }
}