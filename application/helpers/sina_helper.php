<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * API Helper
 */
function curl_helper(string $url, string $method = 'get', array $data = null, string $token = null)
{
    if (strcasecmp($method, 'post') != 0 && strcasecmp($method, 'get') != 0)
        return null; // Unsupported yet

    if (strcasecmp($method, 'get') == 0 && $data)
        $url = "$url?" . http_build_query($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    if (strcasecmp($method, 'post') == 0)
        curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
       "Accept: application/json",
       "Content-Type: application/json",
    );
    if ($token)
        $headers[] = "Authorization: Bearer $token";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if (strcasecmp($method, 'post') == 0 && $data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    // //for debug only!
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($ch);
    curl_close($ch);

    if ($resp === false)
        return false;

    return json_decode($resp) ?? $resp;
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

function sina_products()
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/product";
    return curl_helper($url, 'get');
}

function sina_product_info(int $product_id, string $store = 'en_us')
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/product/$product_id/$store";
    return curl_helper($url, 'get');
}

function sina_price(int $product_id, array $options, string $store = 'en_us')
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/price/$product_id/$store";
    return curl_helper($url, 'post', ['productOptions' => $options]);
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
        'notes' => 'Business Card Test Order',
        ], $token);
}

/**
 * Database Helper
 */
function sina_attributes($attribute_ids)
{
    $ci = get_instance();
    $ci->load->model('Provider_Model');

    $provider = $ci->Provider_Model->getProvider('sina');
    $itemInfo = is_string($attribute_ids) ? json_decode($attribute_ids) : $attribute_ids;
    $itemInfo->options = $ci->Provider_Model->getAttributesByValueIds($provider->id, $itemInfo->provider_product_id, $itemInfo->provider_option_value_ids);

    return $itemInfo;
}

function sina_attributes_map($attribute_ids)
{
    $itemInfo = sina_attributes($attribute_ids);
    $func = function($option) {
        $attribute_name = $option->type == App\Common\ProductOptionType::Quantity ? 'Qautntiy' : ($option->type == App\Common\ProductOptionType::Size ? 'Size' : $option->name);
        return ['attribute_name' => $attribute_name, 'item_name' => $option->value];
    };
    return array_map($func, $itemInfo->options);
}

function sina_shipping_methods($order_id)
{
    $ci = get_instance();
    $ci->load->model('Address_Model');
    $ci->load->model('ProductOrder_Model');
    $ci->load->model('Provider_Model');

    $order = $ci->ProductOrder_Model->getOrder($order_id);

    $provider = $ci->Provider_Model->getProvider('sina');
    $items = [];
    foreach ($order->items as $item) {
        $itemInfo = json_decode($item->attribute_ids);
        $attributes = $ci->Provider_Model->getAttributesByValueIds($provider->id, $itemInfo->provider_product_id, $itemInfo->provider_option_value_ids);
        $options = [];
        foreach ($attributes as $attribute)
            $options[$attribute->name] = $attribute->provider_option_value_id;
        $items[] = [
            'productId' => $itemInfo->provider_product_id,
            'options' => $options,
        ];
    }

    $country = (object) $ci->Address_Model->getCountryById($order->shipping_country);
    $state = (object) $ci->Address_Model->getStateById($order->shipping_state);

    $error = false;
    if (count($items) > 0 && $state && $country) {
        $shippingInfo = [
            'ShipState' => $state ? $state->iso2 : '',
            'ShipZip' => $order->shipping_pin_code,
            'ShipCountry' => $country ? $country->iso2 : null,
        ];

        $token = sina_access_token();
        $response = sina_order_shippingEstimate(
            $items, $shippingInfo, $token
        );

        if ($response->statusCode == 200)
            return $response->body;
    }

    return [];
}

function sina_order_info(string $token, int $order_id)
{
    $sina = config_item('sina');
    $url = $sina['endpoint'] . "/order/$order_id";
    return curl_helper($url, 'get', null, $token);
}
