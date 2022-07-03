<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function curl_helper(string $url, string $method = 'get', array $data = null, string $token = null)
{
    if (strcasecmp($method, 'post') != 0 && strcasecmp($method, 'get') != 0)
        return null; // Unsupported yet

    if (strcasecmp($method, 'get') == 0 && $data)
        $url = "$url?" . http_build_query($data);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    if (strcasecmp($method, 'post') == 0)
        curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
       "Accept: application/json",
       "Content-Type: application/json",
    );
    if ($token)
        $headers[] = "Authorization: Bearer $token";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    if (strcasecmp($method, 'post') == 0 && $data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    // //for debug only!
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);

    if ($resp === false)
        return false;

    return json_decode($resp);
}

function sina_access_token()
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/auth/token";
    $data = [
        'client_id' => $sina['client_id'],
        'client_secret' => $sina['client_secret'],
        'audience' => $sina['audience'],
        'grant_type' => $sina['grant_type'],
    ];
    $resp = curl_helper($url, 'post', $data);

    if ($resp === false)
        return false;
    return $resp->access_token;
}

function sina_products(string $token)
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/product";
    return curl_helper($url, 'get', null, $token);
}

function sina_product_info(string $token, int $product_id, string $store = 'en_us')
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/product/$product_id/$store";
    return curl_helper($url, 'get', null, $token);
}

function sina_price(string $token, int $product_id, array $options, string $store = 'en_us')
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/price/$product_id/$store";
    return curl_helper($url, 'post', ['productOptions' => $options], $token);
}

function sina_order_shippingEstimate($items, $shippingInfo, $token)
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/order/shippingEstimate";
    return curl_helper($url, 'post', [
        'items' => $items,
        'shippingInfo' => $shippingInfo,
        ], $token);
}

function sina_order_new($items, $shippingInfo, $billingInfo, $token)
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/order/new";
    return curl_helper($url, 'post', [
        'items' => $items,
        'shippingInfo' => $shippingInfo,
        'billingInfo' => $billingInfo,
        ], $token);
}
