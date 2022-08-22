<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'common/AttributeType.php';

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

    public function check_sina($provider)
    {
        if (!$this->session->has_userdata('sina_products') || !$this->session->sina_products) {
            $sina_products = sina_products();
            $this->session->set_userdata('sina_products', $sina_products);
        }

        $this->Provider_Model->updateProvider($provider->id, $this->session->sina_products);

        header('Content-Type: text/event-stream');
        // recommended to prevent caching of event data.
        header('Cache-Control: no-cache');
        $products = $this->Provider_Model->getUpdatingProducts($provider->id);
        foreach ($products as $product) {
            $productInfo = sina_product_info($product->provider_product_id);
            $this->Provider_Model->updateProductInfo($product, $productInfo);
            echo "$product->provider_product_id: $product->name" . PHP_EOL;
            ob_flush();
            flush();
        }
    }
}
