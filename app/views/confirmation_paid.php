<!--form action="https://merchant.roboxchange.com/Index.aspx" method=POST-->
<form action="http://test.robokassa.ru/Index.aspx" method=POST>
    <h3>Payment for: <?=$order->name?>&nbsp;<?=$order->surname?></h3>
    <h4>Amount: <strong><?=$out_summ?></strong> &euro;</h4>
    <input type=hidden name=MrchLogin value="<?=$mrh_login?>"/>
    <input type=hidden name=OutSum value="<?=$out_summ?>"/>
    <input type=hidden name=InvId value="<?=$inv_id?>"/>
    <input type=hidden name=Desc value="<?=$inv_desc?>"/>
    <input type=hidden name=SignatureValue value="<?=$crc?>"/>
    <input type=hidden name=IncCurrLabel value="<?=$in_curr?>"/>
    <input type=hidden name=Culture value="<?=$culture?>"/>
    <input type=hidden name=Shp_paid_key value="<?=$shp_paid_key?>"/>
    <button class="btn btn-default" type="button" onclick="window.location.href='<?=route('kiform.cancel_check', array('key'=>$shp_paid_key))?>'">Cancel</button>&nbsp;<button class="btn btn-primary" type="submit">Go to payment</button>
</form>