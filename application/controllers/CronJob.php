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

        $products = $this->Provider_Model->getUpdatingProducts($provider);
        foreach ($products as $product) {
            $productInfo = sina_product_info($sina_access_token, $product->id);
            $this->Provider_Model->updateProductInfo($product, $productInfo);
            echo '<p>' . $product->name . '</p>';
            flush();
        }
    }
}
