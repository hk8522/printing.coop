<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'common/ProviderProductInformationType.php');

use App\Common\ProviderProductInformationType;

class ShoppingCarts extends Public_Controller
{
    public $class_name = '';

    function __construct()
    {
        parent::__construct();
        $this->class_name = ucfirst(strtolower($this->router->fetch_class())).'/';
        $this->class_name = 'ShoppingCarts/';
    }

    public function index()
    {
        #$this->load->model('Product_Model');
        $this->load->model('Provider_Model');

        $this->data['page_title'] = 'Shopping Cart';
        if ($this->language_name == 'French') {
            $this->data['page_title'] = 'Panier';
        }
        $this->render($this->class_name.'index');
    }

    function addpersonailise() {
        echo "<pre>";
        print_r($_FILES);
        print_r($_POST);
    }

    function addToCart()
    {
        $params = [];
        parse_str($this->input->post('params'), $params);

        $json = array('status' => 0, 'msg' => '');
        $this->load->model('Product_Model');
        $this->load->model('Provider_Model');
        $product_id = $params['product_id'];
        $quantity = $params['quantity'];
        $price = $params['price'];

        $product_quantity_id = $params['product_quantity_id'];

        $product_size_id = $params['product_size_id'];

        $add_length_width = $params['add_length_width'];

        $depth_add_length_width = $params['depth_add_length_width'];

        $page_add_length_width = $params['page_add_length_width'];

        $recto_verso = $params['recto_verso'];
        $recto_verso_price = $params['recto_verso_price'];
        $votre_text = $params['votre_text'];

        // Provider
        $provider_id = $params['provider_id'];
        $productOptions = $params['productOptions'];

        $productData = $this->Product_Model->getProductDataById($product_id);
        $ProductAttributes = $this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);

        if ($provider_id) {
            $providerProduct = $this->Provider_Model->getProductByProductId($provider_id, $product_id);
            if ($providerProduct->information_type == ProviderProductInformationType::Normal) {
                $options = array_values((array)$productOptions);
            } else if ($providerProduct->information_type == ProviderProductInformationType::RollLabel) {
                $options = $productOptions;
            }

            $productOptions = (object) [
                'provider_id' => $provider_id,
                'provider_product_id' => $providerProduct->provider_product_id,
                'provider_options' => $productOptions,
            ];
        } else {
            $productOptions = array();
            //pr($ProductAttributes, 1);
            foreach ($ProductAttributes as $key => $val) {
                $attribute_name = 'attribute_id_'.$key;
                $attribute_item_id = isset($_POST[$attribute_name]) ? $params[$attribute_name] : '';
                $items = $val['items'];
                $attribute_data = $val['data'];
                if (!empty($attribute_item_id) && array_key_exists($attribute_item_id, $items)) {
                    $extra_price = $items[$attribute_item_id]['extra_price'];
                    $price += $extra_price;
                    $AttributeData = array();
                    $AttributeData['attribute_name'] = $attribute_data['attribute_name'];
                    $AttributeData['attribute_name_french'] = $attribute_data['attribute_name_french'];
                    $AttributeData['item_name'] = $items[$attribute_item_id]['item_name'];
                    $AttributeData['item_name_french'] = $items[$attribute_item_id]['item_name_french'];
                    $productOptions[] = $AttributeData;
                    //$productOptions[$key] = $attribute_item_id;
                }
            }
        }

        $product_size = array();

        $ProductSizes = $this->Product_Model->ProductQuantySizeAttributeDropDwon($product_id);

        if (!empty($product_quantity_id)) {
            $quantityData = isset($ProductSizes[$product_quantity_id]) ? $ProductSizes[$product_quantity_id]:array();
            $qty_ext_price = isset($quantityData['price']) ? $quantityData['price']:0;
            $price = $price + $qty_ext_price;
            $product_size['product_quantity'] = $quantityData['qty_name'];
            $product_size['product_quantity_french'] = $quantityData['qty_name_french'];
        }

        if (!empty($product_quantity_id) && !empty($product_size_id)) {
            $sizeData = isset($ProductSizes[$product_quantity_id]['sizeData'][$product_size_id]) ? $ProductSizes[$product_quantity_id]['sizeData'][$product_size_id]:array();
            $extra_price = isset($sizeData['extra_price']) ? $sizeData['extra_price']:0;
            $price = $price + $extra_price;
            $product_size['product_size'] = $sizeData['size_name'];
            $product_size['product_size_french'] = $sizeData['size_name_french'];
        }

        $attribute = isset($ProductSizes[$product_quantity_id]['sizeData'][$product_size_id]['attribute']) ? $ProductSizes[$product_quantity_id]['sizeData'][$product_size_id]['attribute']:array();

        $product_size['attribute'] = array();

        foreach ($attribute as $akey => $aval) {
            $multiple_attribute_name = 'multiple_attribute_'.$akey;
            $multiple_attribute_item_id = isset($_POST[$multiple_attribute_name]) ? $params[$multiple_attribute_name] : '';
            $attribute_items = isset($aval['attribute_items']) ? $aval['attribute_items']:array();

            if (!empty($multiple_attribute_item_id) && array_key_exists($multiple_attribute_item_id, $attribute_items)) {
                $extra_price = $attribute_items[$multiple_attribute_item_id]['extra_price'];
                $price += $extra_price;
                $product_size['attribute'][] = $attribute_items[$multiple_attribute_item_id];
            }
        }

        $product_width_length = array();
        $product_depth_length_width = array();
        $page_product_width_length = array();

        if (!empty($add_length_width)) {
            $product_length = $params['product_length'];
            $product_width = $params['product_width'];

            $product_total_page = $params['product_total_page'];

            $length_width_quantity_show = $params['length_width_quantity_show'];

            $length_width_color = $params['length_width_color'];

            $Product = $this->Product_Model->getProductList($product_id);
            $min_length = $Product['min_length'];
            $max_length = $Product['max_length'];
            $min_width = $Product['min_width'];
            $max_width = $Product['max_width'];
            $length_width_min_quantity = $Product['length_width_min_quantity'];

            $length_width_max_quantity = $Product['length_width_max_quantity'];

            $min_length_min_width_price = $Product['min_length_min_width_price'];

            $length_width_unit_price_black = $Product['length_width_unit_price_black'];

            $length_width_price_color = $Product['length_width_price_color'];

            $length_width_color_show = $Product['length_width_color_show'];

            $length_width_pages_type = $Product['length_width_pages_type'];

            $response['product_length'] = $product_length;
            $response['product_length_error'] = '';
            $response['product_width'] = $product_width;
            $response['product_width_error'] = '';

            $response['product_total_page'] = $product_total_page;
            $response['product_total_page_error'] = '';

            if (empty($product_length)) {
                $json['msg'] = 'Please enter length';
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la longueur';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_length) && $product_length < $min_length) {
                $json['msg'] = 'Please length enter between '.$min_length.' and '.$max_length;
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la longueur entre '.$min_length.' et '.$max_length;
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_length) && $product_length > $max_length) {
                $json['msg'] = 'Please length enter between '.$min_length.' and '.$max_length;

                if ($this->language_name == 'French') {
                  $json['msg'] = 'Veuillez saisir la longueur entre '.$min_length.' et '.$max_length;
                }
                echo json_encode($json);
                exit();
            } else if (empty($product_width)) {
                $json['msg'] = 'Please enter width';
                if ($this->language_name == 'French') {
                   $json['msg'] = $json['msg'] = 'Veuillez saisir la largeur';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_width) && $product_width < $min_width) {
                $json['msg'] = 'Please width enter between '.$min_width.' and '.$min_width;
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la largeur entre '.$min_width.' et '.$min_width;
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_width) && $product_width > $max_width) {
                $json['msg'] = 'Please width enter between '.$min_width.' and '.$min_width;
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la largeur entre '.$min_width.' et '.$min_width;
                }
                echo json_encode($json);
                exit();
            } else if (empty($product_total_page) && $length_width_quantity_show == 1) {
                $json['msg'] = 'Please enter quantity';
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la quantité';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_total_page) && $length_width_quantity_show == 1 && $product_total_page > $length_width_max_quantity && $length_width_pages_type == 'input') {
                $json['msg'] = 'Please enter quantity between '.showValue($length_width_min_quantity).' and '.showValue($length_width_max_quantity);
                if ($this->language_name == 'French') {
                  $json['msg'] = 'Veuillez saisir la quantité entre '.showValue($length_width_min_quantity).' et '.showValue($length_width_max_quantity);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_total_page) && $length_width_quantity_show == 1 && $product_total_page < $length_width_min_quantity && $length_width_pages_type == 'input') {
                $json['msg'] = 'Please enter quantity between '.showValue($length_width_min_quantity).' and '.showValue($length_width_max_quantity);
                if ($this->language_name == 'French') {
                  $json['msg'] = 'Veuillez saisir la quantité entre '.showValue($length_width_min_quantity).' et '.showValue($length_width_max_quantity);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_length) && !empty($product_width)) {
                $rq_area = $product_length*$product_width;
                $extra_price = 0;

                if ($length_width_color_show == 1) {
                    if (!empty($length_width_color)) {
                        if ($length_width_color == 'black') {
                            $extra_price  = $length_width_unit_price_black*$rq_area;
                        } else if ($length_width_color == 'color') {
                            $extra_price = $length_width_price_color*$rq_area;
                        }
                    } else {
                        $extra_price = $min_length_min_width_price*$rq_area;
                    }
                } else {
                   $extra_price = $min_length_min_width_price*$rq_area;
                }

                $product_total_page_label = '';
                if ($length_width_quantity_show == 1 && !empty($product_total_page)) {
                    $extra_price = $product_total_page*$extra_price;

                     $product_total_page_label = $product_total_page;
                }

                $price += $extra_price;
                $product_width_length['product_width'] = $product_width;
                $product_width_length['product_length'] = $product_length;

                $product_width_length['product_total_page'] = $product_total_page_label;
                $product_width_length['length_width_color_show'] = $length_width_color_show;
                $product_width_length['length_width_color'] = $length_width_color;

                $product_width_length['length_width_color_french'] = $length_width_color == 'black' ? 'Noire':'Couleur';
            }
        }

        if (!empty($depth_add_length_width)) {
            $product_depth_length = $params['product_depth_length'];
            $product_depth_width = $params['product_depth_width'];

            $product_depth_total_page = $params['product_depth_total_page'];

            $product_depth = $params['product_depth'];
            $depth_width_length_quantity_show = $params['depth_width_length_quantity_show'];

            $depth_color = $params['depth_color'];

            $Product = $this->Product_Model->getProductList($product_id);
            $min_depth = $Product['min_depth'];
            $max_depth = $Product['max_depth'];
            $depth_min_length = $Product['depth_min_length'];
            $depth_max_length = $Product['depth_max_length'];
            $depth_min_width = $Product['depth_min_width'];
            $depth_max_width = $Product['depth_max_width'];

            $depth_min_quantity = $Product['depth_min_quantity'];
            $depth_max_quantity = $Product['depth_max_quantity'];

            $depth_width_length_price = $Product['depth_width_length_price'];

            $depth_unit_price_black = $Product['depth_unit_price_black'];

            $depth_price_color = $Product['depth_price_color'];

            $depth_color_show = $Product['depth_color_show'];

            $depth_width_length_type = $Product['depth_width_length_type'];

            if (empty($product_depth_length)) {
                $json['msg'] = 'Please enter length';
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la longueur';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth_length) && $product_depth_length < $depth_min_length) {
                $json['msg'] = 'Please enter length between '.showValue($depth_min_length).' and '.showValue($depth_max_length);
                if ($this->language_name == 'French') {
                 $json['msg'] = 'Veuillez saisir la longueur entre '.showValue($depth_min_length).' et '.showValue($depth_max_length);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth_length) && $product_depth_length > $depth_max_length) {
                $json['msg'] = 'Please enter length between '.showValue($depth_min_length).' and '.showValue($depth_max_length);
                if ($this->language_name == 'French') {
                 $json['msg'] = 'Veuillez saisir la longueur entre '.showValue($depth_min_length).' et '.showValue($depth_max_length);
                }
                echo json_encode($json);
                exit();
            } else if (empty($product_depth_width)) {
                $json['msg'] = 'Please enter width';
                if ($this->language_name == 'French') {
                 $json['msg'] = 'Veuillez saisir la largeur';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth_width) && $product_depth_width < $depth_min_width) {
                $json['msg'] = 'Please enter width between '.showValue($depth_min_width).' and '.showValue($depth_max_width);
                if ($this->language_name == 'French') {
                 $json['msg'] = 'Veuillez saisir la largeur entre '.showValue($depth_min_width).' et '.showValue($depth_max_width);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth_width) && $product_depth_width > $depth_max_width) {
                $json['msg'] = 'Please enter width between '.showValue($depth_min_width).' and '.showValue($depth_min_width);

                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la largeur entre '.showValue($depth_min_width).' et '.showValue($depth_max_width);
                }
                echo json_encode($json);
                exit();
            } else if (empty($product_depth)) {
                $json['msg'] = 'Please enter depth';
                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la profondeur';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth) && $product_depth < $min_depth) {
                $json['msg'] = 'Please enter depth between '.showValue($min_depth).' and '.showValue($max_depth);
                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la profondeur entre '.showValue($min_depth).' et '.showValue($max_depth);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth) && $product_depth > $max_depth) {
                $json['msg'] = 'Please enter depth between '.showValue($min_depth).' and '.showValue($max_depth);

                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la profondeur entre '.showValue($min_depth).' et '.showValue($max_depth);
                }
                echo json_encode($json);
                exit();
            }
            else if (empty($product_depth_total_page) && $depth_width_length_quantity_show == 1) {
                $json['msg'] = 'Please enter quantity';
                if ($this->language_name == 'French') {
                     $json['msg'] = 'Veuillez saisir la quantité';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth_total_page) && $depth_width_length_quantity_show == 1 &&$product_depth_total_page < $depth_min_quantity && $depth_width_length_type == 'input') {
                $json['msg'] = 'Please enter quantity between '.showValue($depth_min_quantity).' and '.showValue($depth_max_quantity);
                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la quantité entre '.showValue($depth_min_quantity).' et '.showValue($depth_max_quantity);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth_total_page) && $depth_width_length_quantity_show == 1 &&$product_depth_total_page > $depth_max_quantity && $depth_width_length_type == 'input') {
                $json['msg'] = 'Please enter quantity between '.showValue($depth_min_quantity).' and '.showValue($depth_max_quantity);
                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la quantité entre '.showValue($depth_min_quantity).' et '.showValue($depth_max_quantity);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($product_depth_length) && !empty($product_depth_width) && !empty($product_depth)) {
                $rq_area = $product_depth_length*$product_depth_width*$product_depth;
                $extra_price = 0;
                if ($depth_color_show == 1) {
                    if (!empty($depth_color)) {
                        if ($depth_color == 'black') {
                            $extra_price = $depth_unit_price_black*$rq_area;
                        } else if ($depth_color == 'color') {
                            $extra_price = $depth_price_color*$rq_area;
                        }
                    } else {
                        $extra_price = $depth_width_length_price*$rq_area;
                    }
                } else {
                  $extra_price = $depth_width_length_price*$rq_area;
                }

                $product_depth_total_page_label = '';
                if ($depth_width_length_quantity_show == 1 && !empty($product_depth_total_page)) {
                    $extra_price = $product_depth_total_page*$extra_price;
                    $product_depth_total_page_label = $product_depth_total_page;
                }

                $price += $extra_price;
                $product_depth_length_width['product_depth_length'] = $product_depth_length;

                $product_depth_length_width['product_depth_width'] = $product_depth_width;
                $product_depth_length_width['product_depth'] = $product_depth;
                $product_depth_length_width['product_depth_total_page'] = $product_depth_total_page_label;

                $product_depth_length_width['depth_color_show'] = $depth_color_show;

                $product_depth_length_width['depth_color'] = $depth_color;

                $product_depth_length_width['depth_color_french'] = $depth_color == 'black' ? 'Noire':'Couleur';
            }
        }

        if (!empty($page_add_length_width)) {
            $page_product_length = $params['page_product_length'];
            $page_product_width = $params['page_product_width'];
            $page_product_total_page = $params['page_product_total_page'];
            $page_product_total_sheets = $params['page_product_total_sheets'];

            $page_length_width_pages_show = $params['page_length_width_pages_show'];
            $page_length_width_sheets_show = $params['page_length_width_sheets_show'];

            $page_length_width_color = $params['page_length_width_color'];

            $page_length_width_quantity_show = $params['page_length_width_quantity_show'];
            $page_product_total_quantity = $params['page_product_total_quantity'];

            $Product = $this->Product_Model->getProductList($product_id);
            $page_min_length = $Product['page_min_length'];
            $page_max_length = $Product['page_max_length'];
            $page_min_width = $Product['page_min_width'];
            $page_max_width = $Product['page_max_width'];
            $page_min_length_min_width_price = $Product['page_min_length_min_width_price'];
            $page_length_width_price_color = $Product['page_length_width_price_color'];
            $page_length_width_price_black = $Product['page_length_width_price_black'];

            $page_length_width_color_show = $Product['page_length_width_color_show'];

            $page_length_width_min_quantity = $Product['page_length_width_min_quantity'];

            $page_length_width_max_quantity = $Product['page_length_width_max_quantity'];

            $page_length_width_quantity_type = $Product['page_length_width_quantity_type'];

            if (empty($page_product_length)) {
                $json['msg'] = 'Please enter page length';
                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la longueur de la page';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($page_product_lengths) && $page_product_length < $page_min_length) {
                $json['msg'] = 'Please length enter between '.$page_min_length.' and '.$page_max_length;

                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la longueur entre '.$page_min_length.' et '.$page_max_length;
                }
                echo json_encode($json);
                exit();
            } else if (!empty($page_product_length) && $page_product_length > $page_max_length) {
                $json['msg'] = 'Please length enter between '.$page_min_length.' and '.$page_max_length;
                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la longueur entre '.$page_min_length.' et '.$page_max_length;
                }
                echo json_encode($json);
                exit();
            } else if (empty($page_product_width)) {
                $json['msg'] = 'Please enter width';
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la largeur';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($page_product_width) && $page_product_width < $page_min_width) {
                $json['msg'] = 'Please width enter between '.$page_min_width.' and '.$page_min_width;
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la largeur entre '.$page_min_width.' et '.$page_min_width;
                }
                echo json_encode($json);
                exit();
            } else if (!empty($page_product_width) && $page_product_width > $page_max_width) {
                $json['msg'] = 'Please width enter between '.$page_min_width.' and '.$page_min_width;
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la largeur entre '.$page_min_width.' et '.$page_min_width;
                }
                echo json_encode($json);
                exit();
            } else if (empty($page_product_total_page) && $page_length_width_pages_show == 1) {
                $json['msg'] = 'Please select pages';
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez sélectionner des pages';
                }
                echo json_encode($json);
                exit();
            } else if (empty($page_product_total_sheets) && $page_length_width_sheets_show == 1) {
                $json['msg'] = 'Please Select Sheet per pad';
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez sélectionner une feuille par bloc';
                }
                echo json_encode($json);
                exit();
            } else if ( empty($page_product_total_quantity) && $page_length_width_quantity_show == 1) {
                $json['msg'] = 'Please enter quantity';
                if ($this->language_name == 'French') {
                   $json['msg'] = 'Veuillez saisir la quantité';
                }
                echo json_encode($json);
                exit();
            } else if (!empty($page_product_total_quantity) && $page_length_width_quantity_show == 1 && $page_product_total_quantity < $page_length_width_min_quantity && $page_length_width_quantity_type == 'input') {
                $json['msg'] = 'Please enter quantity between '.showValue($page_length_width_min_quantity).' and '.showValue($page_length_width_max_quantity);
                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la quantité entre '.showValue($page_length_width_min_quantity).' and '.showValue($page_length_width_max_quantity);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($page_product_total_quantity) && $page_length_width_quantity_show == 1 && $page_product_total_quantity > $page_length_width_max_quantity && $page_length_width_quantity_type == 'input') {
                $json['msg'] = 'Please enter quantity between '.showValue($page_length_width_min_quantity).' and '.showValue($page_length_width_max_quantity);
                if ($this->language_name == 'French') {
                    $json['msg'] = 'Veuillez saisir la quantité entre '.showValue($page_length_width_min_quantity).' and '.showValue($page_length_width_max_quantity);
                }
                echo json_encode($json);
                exit();
            } else if (!empty($page_product_length) && !empty($page_product_width)) {
                $rq_area = $page_product_length*$page_product_width;
                $extra_price = 0;
                if ($page_length_width_color_show == 1) {
                    if (!empty($page_length_width_color)) {
                        if ($page_length_width_color == 'black') {
                            $extra_price = $page_length_width_price_black*$rq_area;
                        } else if ($page_length_width_color == 'color') {
                            $extra_price = $page_length_width_price_color*$rq_area;
                        }
                    }
                } else {
                    $extra_price = $page_min_length_min_width_price*$rq_area;
                }

                $page_extra_price = 0;
                $sheets_extra_price = 0;
                if (!empty($page_product_total_page) && $page_length_width_pages_show == 1) {
                    $page_product_total_page_error = explode('-', $page_product_total_page);

                    $page_product_total_page_label = count($page_product_total_page_error) > 1 ? $page_product_total_page_error[1]:$page_product_total_page_error[0];

                    $page_product_total_page_label_french = count($page_product_total_page_error) > 2 ? $page_product_total_page_error[2]:$page_product_total_page_error[1];

                    $page_extra_price = $page_product_total_page_error[0]*$extra_price;
                }

                if (!empty($page_product_total_sheets) && $page_length_width_sheets_show == 1) {
                    $sheets_extra_price = $page_product_total_sheets*$extra_price;
                }

                if (!empty($page_extra_price) || !empty($sheets_extra_price)) {
                    $extra_price = $page_extra_price + $sheets_extra_price;
                }

                if (!empty($page_product_total_quantity) && $page_length_width_quantity_show == 1) {
                    $extra_price = $page_product_total_quantity*$extra_price;
                }

                $price += $extra_price;

                $page_product_width_length['page_product_width'] = $page_product_width;
                $page_product_width_length['page_product_length'] = $page_product_length;

                $page_product_width_length['page_product_total_page'] = $page_product_total_page_label;
                $page_product_width_length['page_product_total_page_french'] = $page_product_total_page_label_french;

                $page_product_width_length['page_product_total_sheets'] = $page_product_width_length['page_product_total_sheets_french'] = $page_product_total_sheets;

                $page_product_width_length['page_length_width_color_show'] = $page_length_width_color_show;

                $page_product_width_length['page_length_width_color'] = $page_length_width_color;

                $page_product_width_length['page_length_width_color_french'] = $page_length_width_color == 'black' ? 'Noire':'Couleur';

                $page_product_width_length['page_product_total_quantity'] = $page_product_total_quantity;

                $page_product_width_length['page_length_width_quantity_show'] = $page_length_width_quantity_show;
            }
        }

         #RECTO PRICE CAL
        if (!empty($recto_verso) && $recto_verso == "Yes" && !empty($recto_verso_price)) {
            $price = $price+(($price*$recto_verso_price)/100);
        }
        $recto_verso_french = '';
        if (!empty($recto_verso)) {
            $recto_verso_french = 'Non';
            if ($recto_verso == 'Yes') {
                $recto_verso_french = 'Oui';
            }
        }

        if (!empty($productData)) {
            $data = array();
            $data['id'] =  $productData['id'];
            $data['qty'] = $quantity;
            $data['price'] = $price;

            $name = str_replace('(', '', $productData['name']);
            $name = str_replace(')', '', $name);
            $name = str_replace("'", '', $name);
            $name = str_replace(",", '', $name);
            $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);

            $name_french = str_replace('(', '', $productData['name_french']);
            $name_french = str_replace(')', '', $name_french);
            $name_french = str_replace("'", '', $name_french);
            $name_french = str_replace(",", '', $name_french);
            $name_french = preg_replace('/[^A-Za-z0-9\-]/', '', $name_french);
            $data['name'] = $name;
            $data['name_french'] = $name_french;

            $cart_images = array();
            if (isset($_SESSION['product_id'][$product_id])) {
                $cart_images = $_SESSION['product_id'][$product_id];
            }
            $data['options'] = array(
                'product_id'       => $productData['id'],
                'product_image'    => $productData['product_image'],
                'cart_images'      => $cart_images,
                'provider_product_id' => $provider_id ? $providerProduct->provider_product_id : null,
                'attribute_ids'    => $productOptions,
                'product_size'     => $product_size,
                'product_width_length' => $product_width_length,
                'product_depth_length_width' => $product_depth_length_width,
                'page_product_width_length' => $page_product_width_length,
                'recto_verso' => $recto_verso,
                'recto_verso_french' => $recto_verso_french,
                'votre_text' => $votre_text
            );

            if ($this->cart->insert($data)) {
                $items = $this->cart->contents();
                $row_id = '';
                $tquantity = '';
                foreach ($items as $key => $item) {
                    if ($item['id'] == $product_id) {
                        $row_id = $key;
                        $tquantity = $item['qty'];
                        break;
                    }
                }

                $json['status'] = 1;
                $json['total_item'] = $this->cart->total_items();
                $json['sub_total'] = CURREBCY_SYMBOL.number_format($this->cart->total(), 2);
                $json['row_id'] = $row_id;
                $json['quantity'] = $tquantity;
                $json['msg'] = ucfirst(strtolower($productData['name'].' is added to your shopping cart.'));
                if ($this->language_name == 'French') {
                   $json['msg'] = ucfirst(strtolower($productData['name_french'].' est ajouté à votre panier.'));
                }
            } else {
                $json['msg'] = ucfirst(strtolower($productData['name'].' add to your shopping cart has been field'));
                if ($this->language_name == 'French') {
                   $json['msg'] = ucfirst(strtolower($productData['name_french'].' ajouter à votre panier a été champ.'));
                }
            }
        } else {
            $json['msg'] = 'Product does not exist';
            if ($this->language_name == 'French') {
                $json['msg'] = "Le produit n'existe pas";
            }
        }
        echo json_encode($json);
    }

    function removeCartItem() {
        $json = array('status' => 0, 'msg' => '');
        $rowId = $this->input->post('rowId');
        $data = array();
        if ($this->cart->remove($rowId)) {
            $json['status'] = 1;
            $json['total_item'] = $this->cart->total_items();
            $json['sub_total'] = CURREBCY_SYMBOL.number_format($this->cart->total(), 2);
            $json['msg'] = 'Item has been  remove from  your shopping cart.';

            if ($this->language_name == 'French') {
                $json['msg'] = "L'article a été supprimé de votre panier.";
            }
        } else {
            $json['msg'] = 'shopping cart item remove has been field';
            if ($this->language_name == 'French') {
                $json['msg'] = "L'élément du panier d'achat a été supprimé";
            }
        }
        echo json_encode($json);
    }

    /*function updateCartItem() {
        $this->load->model('Product_Model');
        $productData = $this->Product_Model->getProductDataById($this->input->post('product_id'));
        $json = array('status' => 0, 'msg' => '');
        $rowId = $this->input->post('rowId');
        $quantity = $this->input->post('quantity');
        $personailise = $this->input->post('personailise');
        $copies = $this->input->post('copies');
        $colors = $this->input->post('colors');
        $paperQuality = $this->input->post('paper_quality');
        $sizes = $this->input->post('sizes');
        $personailise_image = '';

        if ($personailise == 1 && isset($_SESSION['personailise_image']) && $_SESSION['personailise_image'] != '') {
            $personailise_image = $_SESSION['personailise_image'];
        } else {
            $personailise = 0;
        }

        $data = array(
            'rowid' => $rowId,
            'qty'   => $quantity
        );

        $data['options'] = array(
            'product_image' => $productData['product_image'],
                'stock' => $productData['total_stock'],
                'personailise' => $personailise,
                'personailise_image' => $personailise_image,
            'copies' => $copies,
            'colors' => $colors,
            'sizes' => $sizes,
            'paper_quality' => $paperQuality,
        );

        if ($this->cart->update($data)) {
            $row = $this->cart->get_item($rowId);
            $json['status'] = 1;
            $json['total_item'] = $this->cart->total_items();
            $json['sub_total'] = CURREBCY_SYMBOL.number_format($this->cart->total(), 2);
            $json['row_sub_total'] = CURREBCY_SYMBOL.number_format($row['subtotal'], 2);
            $json['row_id'] = $rowId;
            $json['product_id'] = $row['id'];

            $productData = $this->Product_Model->getProductDataById($row['id']);

            $json['msg'] = ucfirst(strtolower($productData['name'].' has been  updated to your shopping cart.'));
        } else {
            $json['msg'] = 'shopping cart item update has been field';
        }
        echo json_encode($json);
    }*/

    function updateCartItem() {
        $this->load->model('Product_Model');
        $productData = $this->Product_Model->getProductDataById($this->input->post('product_id'));
        $json = array('status' => 0, 'msg' => '');
        $rowId = $this->input->post('rowId');
        $quantity = $this->input->post('quantity');
        $data = array(
           'rowid' => $rowId,
            'qty'   => $quantity
        );

        if ($this->cart->update($data)) {
            $row = $this->cart->get_item($rowId);
            $json['status'] = 1;
            $json['total_item'] = $this->cart->total_items();
            $json['sub_total'] = CURREBCY_SYMBOL.number_format($this->cart->total(), 2);
            $json['row_sub_total'] = CURREBCY_SYMBOL.number_format($row['subtotal'], 2);
            $json['row_id'] = $rowId;
            $json['product_id'] = $row['id'];
            $json['msg'] = ucfirst(strtolower($productData['name'].' has been  updated to your shopping cart.'));
            if ($this->language_name == 'French') {
            $json['msg'] = ucfirst(strtolower($productData['name_french'].' a été mis à jour dans votre panier.'));
            }
        } else {
            $json['msg'] = 'shopping cart item update has been field';

            if ($this->language_name == 'French') {
                $json['msg'] = "La mise à jour de l'article du panier a été effectuée";
            }
        }
        echo json_encode($json);
    }

    public function getCartItemByAjax()
    {
        $data['BASE_URL'] = base_url();
        $this->load->view('elements/cart-items', $data);
    }

    function saveImage() {
        /*
        *
        * An example php that gets the 64 bit encoded PNG URL and creates an image of it
        *
        */
        //get the base-64 from data
        $base64_str = substr($_POST['base64_image'], strpos($_POST['base64_image'], ",") + 1);
        //decode base64 string
        $decoded = base64_decode($base64_str);
        $png_url = "product-".strtotime('now').".png";
        //create png from decoded base 64 string and save the image in the parent folder
        $result = file_put_contents(FILE_UPLOAD_BASE_PATH.'personailise/'.$png_url, $decoded);
        //send result - the url of the png or 0
        //header('Content-Type: application/json');
        if ($result) {
            if (isset($_SESSION['personailise_image'])) {
               unlink(FILE_UPLOAD_BASE_PATH.'personailise/'.$_SESSION['personailise_image']);
               unset($_SESSION['personailise_image']);
            }
            $_SESSION['personailise_image'] = $png_url;
            //$png_url = get_folder_url().$png_url;
            $png_url = $png_url;
            echo json_encode($png_url);
        }
        else {
            echo json_encode(0);
        }
        exit();
    }

    //returns the current folder URL
    function get_folder_url() {
        $url = $_SERVER['REQUEST_URI']; //returns the current URL
        $parts = explode('/', $url);
        $dir = $_SERVER['SERVER_NAME'];
        for ($i = 0; $i < count($parts) - 1; $i++) {
            $dir .= $parts[$i] . "/";
        }
        return 'http://'.$dir;
    }
}
