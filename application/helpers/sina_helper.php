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
function sina_options($attribute_ids)
{
    $ci = get_instance();
    $ci->load->model('Provider_Model');

    $itemInfo = is_string($attribute_ids) ? json_decode($attribute_ids) : $attribute_ids;
    if (!is_object($itemInfo) || empty($itemInfo->provider_id))
        return false;
    $providerProduct = $ci->Provider_Model->getProductByProviderProductId($itemInfo->provider_id, $itemInfo->provider_product_id);
    $itemInfo->information_type = $providerProduct->information_type;
    $itemInfo->options = [];
    if ($providerProduct->information_type == App\Common\ProviderProductInformationType::Normal) {
        $data = $ci->Provider_Model->getOptionsByValueIds($itemInfo->provider_id, $itemInfo->provider_product_id, array_values((array)$itemInfo->provider_options));
        foreach ($data as $option)
            $itemInfo->options[$option->name] = $option->provider_option_value_id;
    } else if ($providerProduct->information_type == App\Common\ProviderProductInformationType::RollLabel) {
        $itemInfo->options = $itemInfo->provider_options;
    }

    return $itemInfo;
}

function sina_options_raw($attribute_ids)
{
    $ci = get_instance();
    $ci->load->model('Provider_Model');

    $itemInfo = is_string($attribute_ids) ? json_decode($attribute_ids) : $attribute_ids;
    if (!is_object($itemInfo) || empty($itemInfo->provider_id))
        return false;
    $providerProduct = $ci->Provider_Model->getProductByProviderProductId($itemInfo->provider_id, $itemInfo->provider_product_id);
    $itemInfo->information_type = $providerProduct->information_type;
    if ($providerProduct->information_type == App\Common\ProviderProductInformationType::Normal) {
        $itemInfo->options = $ci->Provider_Model->getOptionsByValueIds($itemInfo->provider_id, $itemInfo->provider_product_id, array_values((array)$itemInfo->provider_options));
    } else if ($providerProduct->information_type == App\Common\ProviderProductInformationType::RollLabel) {
        $itemInfo->options = $itemInfo->provider_options;
    }

    return $itemInfo;
}

function sina_options_map($attribute_ids)
{
    $ci = get_instance();
    $ci->load->model('Provider_Model');

    $itemInfo = sina_options_raw($attribute_ids);
    if (!$itemInfo)
        return false;

    $ci->Provider_Model->getOptions($itemInfo->provider_id, null, 0, 0, $providerOptions, $total);
    $providerOptionsByName = [];
    foreach ($providerOptions as $option) {
        $providerOptionsByName[$option->name] = $option;
    }

    $func = function($key, $option) use ($providerOptionsByName) {
        if (is_object($option)) {
            if ($option->type == App\Common\AttributeType::Quantity) {
                $attribute_name = 'Quantity';
                $attribute_name_french = 'Quantité';
            } else if ($option->type == App\Common\AttributeType::Size) {
                $attribute_name = 'Size';
                $attribute_name_french = 'Taille';
            } else {
                $attribute_name = $option->attribute_name ?? $option->label ?? $option->name;
                $attribute_name_french = $option->attribute_name_french ?? $option->attribute_name ?? $option->label ?? $option->name;
            }
            return ['attribute_name' => ucfirst($attribute_name), 'attribute_name_french' => ucfirst($attribute_name_french), 'item_name' => ucfirst($option->value), 'item_name_french' => ucfirst($option->value)];
        } else {
            $providerOption = $providerOptionsByName[$key];
            if ($providerOption) {
                if ($providerOption->type == App\Common\AttributeType::Quantity) {
                    $attribute_name = 'Quantity';
                    $attribute_name_french = 'Quantité';
                } else if ($providerOption->type == App\Common\AttributeType::Size) {
                    $attribute_name = 'Size';
                    $attribute_name_french = 'Taille';
                } else {
                    $attribute_name = $providerOption->attribute_name ?? $providerOption->label ?? $providerOption->name;
                    $attribute_name_french = $providerOption->attribute_name_french ?? $providerOption->attribute_name ?? $providerOption->label ?? $providerOption->name;
                }
                return ['attribute_name' => ucfirst($attribute_name), 'attribute_name_french' => ucfirst($attribute_name_french), 'item_name' => ucfirst($option), 'item_name_french' => ucfirst($option)];
            } else
                return ['attribute_name' => ucfirst($key), 'attribute_name_french' => ucfirst($key), 'item_name' => ucfirst($option), 'item_name_french' => ucfirst($option)];
        }
    };
    return array_map($func, array_keys((array)$itemInfo->options), (array)$itemInfo->options);
}

function sina_shipping_methods($order_id)
{
    $ci = get_instance();
    $ci->load->model('Address_Model');
    $ci->load->model('ProductOrder_Model');
    $ci->load->model('Provider_Model');

    $order = $ci->ProductOrder_Model->getOrder($order_id);

    $items = [];
    foreach ($order->items as $item) {
        $itemInfo = sina_options($item->attribute_ids);
        if (!$itemInfo)
            continue;
        $items[] = [
            'productId' => $itemInfo->provider_product_id,
            'options' => $itemInfo->options,
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
