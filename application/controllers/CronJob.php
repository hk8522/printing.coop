<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'common/ProductAttributeType.php');

use App\Common\ProductAttributeType;

class CronJob extends Admin_Controller
{

    public function CheckProvider($provider = null)
    {
        $this->load->model('Provider_Model');

        $provider = $this->Provider_Model->getProvider($provider);
        if ($provider->name == 'sina') {
            $this->check_sina($provider);
        } else {
            echo "Unknown provider $provider";
            return;
        }
        echo "$provider->name product list was checked successful.";
    }

    function check_sina($provider)
    {
        if (!$this->session->has_userdata('sina_access_token') || !$this->session->sina_access_token) {
            $sina_access_token = sina_access_token();
            $this->session->set_userdata('sina_access_token', $sina_access_token);
        }
        $sina_access_token = $this->session->sina_access_token;
        if (!$this->session->has_userdata('sina_products') || !$this->session->sina_products) {
            $sina_products = sina_products($sina_access_token);
            $this->session->set_userdata('sina_products', $sina_products);
        }

        $this->Provider_Model->updateProvider($provider, $this->session->sina_products);

        header('Content-Type: text/event-stream');
        // recommended to prevent caching of event data.
        header('Cache-Control: no-cache');
        $products = $this->Provider_Model->getUpdatingProducts($provider);
        foreach ($products as $product) {
            if ($product->provider_product_id != 154)
                continue;
            $productInfo = sina_product_info($sina_access_token, $product->provider_product_id);
            $this->Provider_Model->updateProductInfo($product, $productInfo);
            echo "id: $product->provider_product_id" . PHP_EOL;
            echo "name: " . $product->name . PHP_EOL;
            echo PHP_EOL;
            // echo '<p>' . $product->name . '</p>';
            ob_flush();
            flush();
        }
    }
}
