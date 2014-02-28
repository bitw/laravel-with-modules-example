<?if($result == -1):?>
    <h3>Account will not find</h3>
<?elseif($result == 0):?>
    <h3>Account of non-payment or even still in the processing queue.</h3>
<?else:?>
    <h3>Проздавля! Плаота успеншо парлша!</h3>
<?endif?>