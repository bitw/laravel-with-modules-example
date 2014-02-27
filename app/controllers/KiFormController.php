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

    public function Result()
    {
        // регистрационная информация (пароль #2)
        // registration info (password #2)
        $mrh_pass2 = "kirf_pass#2";

        //установка текущего времени
        //current date
        /*
        $tm=getdate(time()+9*3600);
        $date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";
        */

        // чтение параметров
        // read parameters
        $out_summ       = Input::get("OutSum");
        $inv_id         = Input::get("InvId");
        $shp_paid_key   = Input::get("Shp_paid_key");
        $shp_user_email = Input::get("Shp_user_email");
        $crc            = Input::get("SignatureValue");

        $crc = strtoupper($crc);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_paid_key=$shp_paid_key"));

        // проверка корректности подписи
        // check signature
        if ($my_crc !=$crc)
        {
            return "bad sign\n";
        }

        // признак успешно проведенной операции
        // success
        //echo "OK$inv_id\n";

        // запись информации о прведенной операции
        // save order info
        /*
        $f=@fopen("order.txt","a+") or
            die("error");
        fputs($f,"order_num :$inv_id;Summ :$out_summ;Date :$date\n");
        fclose($f);
        */
        $check = Foreigner::where('key', '=', $shp_paid_key)->where('email', '=', $shp_user_email)->get()->first();

        $check->paid = true;
        $check->billing_information = serialize(Input::all());

        $check->save();

        return "Ok\n";
    }

    public function Fail()
    {
        $inv_id = $_REQUEST["InvId"];
        echo "Вы отказались от оплаты. Заказ# $inv_id\n";
        echo "You have refused payment. Order# $inv_id\n";
        return;
    }

    public function Success()
    {
        // регистрационная информация (пароль #1)
        // registration info (password #1)
        $mrh_pass1 = "kirf_pass#1";

        // чтение параметров
        // read parameters
        $out_summ = Input::get("OutSum");
        $inv_id = Input::get("InvId");
        $shp_paid_key = Input::get("Shp_paid_key");
        $shp_user_email = Input::get("Shp_user_email");
        $crc = Input::get("SignatureValue");

        $crc = strtoupper($crc);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_paid_key:Shp_user_email=$shp_user_email"));
echo $crc."<br/>\n";
echo $my_crc;
        exit;
        // проверка корректности подписи
        // check signature
        if ($my_crc !=$crc)
        {
            return "bad sign\n";
        }

        // проверка наличия номера счета в истории операций
        // check of number of the order info in history of operations
        /*
        $f=@fopen("order.txt","r+") or die("error");

        while(!feof($f))
        {
            $str=fgets($f);

            $str_exp = explode(";", $str);
            if ($str_exp[0]=="order_num :$inv_id")
            {
                echo "Операция прошла успешно\n";
                echo "Operation of payment is successfully completed\n";
            }
        }
        fclose($f);
        */

        $check = Foreigner::where('key', '=', $shp_paid_key)->where('email', '=', $shp_user_email)->get()->first();

        if(!$check)
        {
            // Account will not find
            return View::make('foreigner.success', array(
                'result'    => -1
            ))->render();
        }

        if($check && $check->paid == 0)
        {
            // Account of non-payment or even still in the processing queue.
            return View::make('foreigner.success', array(
                'result'    => 0
            ))->render();
        }

        //The bill is paid.
        return View::make('foreigner.success', array(
            'result'    => 1
        ))->render();
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
        $shp_user_email = $order->email;

        // предлагаемая валюта платежа
        // default payment e-currency
        $in_curr = "";

        // язык
        // language
        $culture = "ru";

        // формирование подписи
        // generate signature
        $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_paid_key=$shp_paid_key:Shp_user_email=$shp_user_email");

        // форма оплаты товара
        // payment form
        $data = array(
            'mrh_login'     => $mrh_login,
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