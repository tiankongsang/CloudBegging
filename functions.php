<?php

function CreateOrder($order,$money,$notify_url,$return_url,$pay_type)
{
    require './config.php';
    $parameter = array(
        'appid' => $config['app_id'],
        'merchant_tradeno' => $order,
        'amount' => $money,
        'notify_url' => $notify_url,
        'return_url' => $return_url,
        'pay_type' => $pay_type
    );
    $parameter['sign'] = Sign($parameter);

    $parameter = http_build_query($parameter);

    $request = HttpPost('https://dd.fubuki.dev/api/trade/create', $parameter);
    if($request === false) return false;
    else return json_decode($request); 
}

function HttpPost($url,$d)
{
    $ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $d);
	$res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function Sign($parameter)
{
    require './config.php';
    ksort($parameter);
    $query = http_build_query($params);
    $query = strtolower(md5($query));
    $signature = strtolower(hash('sha256', $query.$config['app_secret']));
    return $signature;
}
