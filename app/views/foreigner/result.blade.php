<?if($result == -1):?>
    Account will not find
<?else if($result == 0):?>
    Account of non-payment or even still in the processing queue.
<?else:?>
    The bill is paid.
<?endif?>
<?var_dump(Input::all())?>