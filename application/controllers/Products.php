<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'common/AttributeType.php';
require_once APPPATH . 'common/ProviderProductInformationType.php';

use App\Common\ProviderProductInformationType;

class Products extends Public_Controller
{
    public $class_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->class_name = ucfirst(strtolower($this->router->fetch_class())) . '/';
    }

    public function index($category_id = null, $sub_category_id = null)
    {
        $this->load->model('Product_Model');
        $this->load->model('Category_Model');
        $this->load->model('SubCategory_Model');
        $this->load->model('Page_Model');

        $this->data['category_id'] = '';
        $this->data['category_name'] = '';
        $this->data['category_data'] = '';
        $this->data['sub_category_id'] = '';
        $this->data['sub_category_name'] = '';
        $this->data['sub_category_data'] = '';
        $this->data['printer_brand'] = '';
        $this->data['printer_series'] = '';
        $this->data['printer_models'] = '';
        $title = 'All Categories';
        $title = $this->language_name == 'French' ? 'toutes catégories' : 'All Categories';
        $category_id = !empty($category_id) ? base64_decode($category_id) : 0;
        $sub_category_id = !empty($sub_category_id) ? base64_decode($sub_category_id) : 0;
        $url = base_url() . "Products/";

        if (isset($_GET['category_id'])) {
            $category_id = base64_decode($_GET['category_id']);
        }
        #check condition ecoink
        if ($this->main_store_data['show_all_categories'] == 0 && $category_id != 13 && $this->website_store_id == 5) {
            $category_id = 13;
            $url .= '?category_id=' . base64_encode($category_id);
            redirect($url);
        }

        $sub_category_id = isset($_GET['sub_category_id']) ? base64_decode($_GET['sub_category_id']) : null;
        $printer_brand = $_GET['printer_brand'] ?? null;
        $printer_series = $_GET['printer_series'] ?? null;
        $printer_models = $_GET['printer_models'] ?? null;

        if (!empty($category_id)) {
            $this->data['category_id'] = $category_id;
            $data = $this->Category_Model->getCategoryDataById($category_id);
            $this->data['category_name'] = $data['name'];
            $this->data['category_data'] = $data;
            $title = $this->language_name == 'French' ? ucfirst($data['name_french']) : ucfirst($data['name']);
            $pageData = $data;
            $url .= '?category_id=' . base64_encode($category_id);
        } else {
            $url .= '?category_id=';
            $pageData = $this->Page_Model->getPageDataBySlug('products', $this->website_store_id);
        }

        if (!empty($sub_category_id)) {
            $this->data['sub_category_id'] = $sub_category_id;
            $data = $this->SubCategory_Model->getSubCategoryDataById($sub_category_id);
            $this->data['sub_category_name'] = $data['name'];
            $this->data['sub_category_data'] = $data;
            //$title .= " /".ucfirst($data['name']);

            $title .= $this->language_name == 'French' ? " /" . ucfirst($data['name_french']) : " /" . ucfirst($data['name']);

            $url .= '&sub_category_id=' . base64_encode($sub_category_id);
        } else {
            $url .= '&sub_category_id=';
        }

        if (!empty($printer_brand)) {
            $this->data['printer_brand'] = $printer_brand;
            $title .= " / " . $printer_brand;
            $url .= '&printer_brand=' . $printer_brand;
        } else {
            $url .= '&printer_brand=';
        }
        if (!empty($printer_series)) {
            $this->data['printer_series'] = $printer_series;
            $title .= " / " . $printer_series;
            $url .= '&printer_series=' . $printer_series;
        } else {
            $url .= '&printer_series=';
        }

        if (!empty($printer_models)) {
            $this->data['printer_models'] = $printer_models;
            $title .= " / " . $printer_models;
            $url .= '&printer_models=' . $printer_models;
        } else {
            $url .= '&printer_models=';
        }

        $this->data['page_title'] = $title;
        if (!empty($pageData)) {
            $this->data['meta_page_title'] = $pageData['page_title'];
            $this->data['meta_description_content'] = $pageData['meta_description_content'];
            $this->data['meta_keywords_content'] = $pageData['meta_keywords_content'];

            if ($this->language_name == 'French') {
                $this->data['meta_page_title'] = $pageData['page_title_french'];
                $this->data['meta_description_content'] = $pageData['meta_description_content_french'];
                $this->data['meta_keywords_content'] = $pageData['meta_keywords_content_french'];
            }
        }
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
        } else {
            $sortBy = 'name';
        }

        $url .= "&sort_by=" . $sortBy;
        $sortByOptions = getSortByDropdown();
        $sortByOptions = $sortByOptions[$sortBy] ?? '';
        $order_by = $sortByOptions['order_by'] ?? '';
        $type = $sortByOptions['type'] ?? '';
        $this->data['order'] = $sortBy;
        $total = $this->Product_Model->getTotalActiveProduct($category_id, $sub_category_id, $printer_brand, $printer_series, $printer_models);

        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 12;
        $offset = ($pageno - 1) * $no_of_records_per_page;
        $total_pages = ceil($total / $no_of_records_per_page);

        $lists = $this->Product_Model->getActiveProductList($category_id, $sub_category_id, $order_by, $type, $offset, $no_of_records_per_page, $printer_brand, $printer_series, $printer_models);

        $prevPage = $pageno - 1;
        $NextPage = $pageno + 1;

        if ($total_pages == $pageno) {
            $NextPage = '';
        }
        if ($pageno == 1) {
            $prevPage = '';
        }

        $this->data['url'] = $url;
        $this->data['total'] = $total;
        $this->data['NextPage'] = $NextPage;
        $this->data['prevPage'] = $prevPage;

        $this->data['lists'] = $lists;
        foreach ($lists as $key => $list) {
            $this->data['lists'][$key]['category'] = $this->Category_Model->getCategoryDataById($list['category_id']);

            $multipalCategory = $this->Product_Model->getProductMultipalCategoriesAndSubCategories($list['id']);
            $multipalCategoryData = array();
            foreach ($multipalCategory as $ckey => $cval) {
                $multipalCategoryData[$ckey] = $this->Category_Model->getCategoryDataById($ckey);
            }

            $this->data['lists'][$key]['multipalCategory'] = $multipalCategoryData;
        }

        $this->render($this->class_name . 'index');
    }

    public function view($id = null)
    {
        if (empty($id)) {
            redirect('/');
        }

        $id = base64_decode($id);
        $this->load->model('Product_Model');
        $this->load->model('ProductImage_Model');
        $this->load->model('Provider_Model');

        $this->data['page_title'] = 'Product Details';

        $Product = $this->Product_Model->getProductList($id);
        $ProductDescriptions = $this->Product_Model->getProductDescriptionById($id);
        $ProductTemplates = $this->Product_Model->getProductTemplatesById($id);

        if (!$Product) {
            redirect('/');
        }

        //pr($Product);

        $ProductImages = $this->ProductImage_Model->getProductImageDataByProductId($id);
        $this->data['ProductImages'] = $ProductImages;

        $multipalCategory = $this->Product_Model->getProductMultipalCategoriesAndSubCategories($Product['id']);
        $multipalCategoryData = array();
        foreach ($multipalCategory as $ckey => $cval) {
            $category = $this->Category_Model->getCategoryDataById($ckey);
            if ($category) {
                $multipalCategoryData[$ckey] = $category;
            }
        }
        $Product['multipalCategoryData'] = $multipalCategoryData;

        #check condition ecoink
        if ($this->main_store_data['show_all_categories'] == 0 && !array_key_exists(13, $multipalCategoryData) && $this->main_store_data['id'] == 5) {
            $url = base_url() . "Products/";
            $category_id = 13;
            $url .= '?category_id=' . base64_encode($category_id);
            redirect($url);
        }

        $this->data['Product'] = $Product;
        //pr($multipalCategoryData);
        $this->data['ProductDescriptions'] = $ProductDescriptions;
        $this->data['ProductTemplates'] = $ProductTemplates;
        $ProductAttributes = $this->Product_Model->getProductAttributesByItemIdFrontEnd($id);
        $this->data['ProductAttributes'] = $ProductAttributes;
        $ProductSizes = $this->Product_Model->ProductQuantityDropDwon($id);
        //pr($ProductSizes, 1);
        $this->data['ProductSizes'] = $ProductSizes;
        $ProductPages = $this->Product_Model->getProductPages();
        $ProductSheets = $this->Product_Model->getProductSheets();
        $pageQuantity = $this->Product_Model->getPageQuantity();
        $this->data['ProductPages'] = $ProductPages;
        $this->data['ProductSheets'] = $ProductSheets;
        $this->data['pageQuantity'] = $pageQuantity;

        $total_items = $this->cart->total_items();
        $productRowid = '';
        $productQty = 0;

        if ($total_items > 0) {
            $carts = $this->cart->contents();
            foreach ($carts as $rowid => $cart) {
                if ($cart['id'] == $Product['id']) {
                    $productQty = $cart['qty'];
                    $productRowid = $rowid;
                    break;
                }
            }
        }
        $this->data['productRowid'] = $productRowid;
        $this->data['productQty'] = $productQty;

        ///// new structure
        $this->Product_Model->getProductAttributes($id, null, 0, 0, $attributes, $attributes_count);
        $this->Product_Model->getProductAttributeItems($id, null, null, 0, 0, $attribute_items, $attribute_items_count);
        $this->data['attributes'] = $attributes;
        $this->data['attribute_items'] = $attribute_items;

        // Check Provider binding
        $provider = $this->Provider_Model->getProvider('sina');
        $providerProduct = $this->Provider_Model->getProductByProductId($provider->id, $id);
        if ($providerProduct) {
            $providerInfo = [];
            $optionGroups = $this->Provider_Model->getProductOptionGroups($provider->id, $providerProduct->provider_product_id);
            $options = [];
            foreach ($optionGroups as $item) {
                $options[$item->id] = $item;
            }

            $data = $this->Provider_Model->getProductOptionValues($provider->id, $providerProduct->provider_product_id);
            foreach ($data as $item) {
                if ($item->provider_option_value_id == null || $item->value == null) {
                    continue;
                }

                $option = $options[$item->option_id];
                if (!isset($option->values)) {
                    $option->values = [];
                }
                $option->values[] = $item;
            }
            $this->data['provider'] = (object) [
                'id' => $provider->id,
                'product_id' => $id,
                'options' => $options,
                'shipping_extra_days' => $shipping_extra_days,
                'price_rate' => $providerProduct->price_rate,
            ];
            $this->data['providerProduct'] = $providerProduct;
        } else {
            $this->data['provider'] = false;
        }

        $this->render($this->class_name . 'view');
    }

    public function viewMap($id = null)
    {
        if (empty($id)) {
            redirect('/');
        }

        $id = base64_decode($id);
        $this->load->model('Product_Model');
        $this->load->model('ProductImage_Model');
        $this->load->model('Provider_Model');

        $this->data['page_title'] = 'Product Details';

        $Product = $this->Product_Model->getProductList($id);
        $ProductDescriptions = $this->Product_Model->getProductDescriptionById($id);
        $ProductTemplates = $this->Product_Model->getProductTemplatesById($id);

        if (!$Product) {
            redirect('/');
        }

        //pr($Product);

        $ProductImages = $this->ProductImage_Model->getProductImageDataByProductId($id);
        $this->data['ProductImages'] = $ProductImages;

        $multipalCategory = $this->Product_Model->getProductMultipalCategoriesAndSubCategories($Product['id']);
        $multipalCategoryData = array();
        foreach ($multipalCategory as $ckey => $cval) {
            $category = $this->Category_Model->getCategoryDataById($ckey);
            if ($category) {
                $multipalCategoryData[$ckey] = $category;
            }
        }
        $Product['multipalCategoryData'] = $multipalCategoryData;

        #check condition ecoink
        if ($this->main_store_data['show_all_categories'] == 0 && !array_key_exists(13, $multipalCategoryData) && $this->main_store_data['id'] == 5) {
            $url = base_url() . "Products/";
            $category_id = 13;
            $url .= '?category_id=' . base64_encode($category_id);
            redirect($url);
        }

        $this->data['Product'] = $Product;
        //pr($multipalCategoryData);
        $this->data['ProductDescriptions'] = $ProductDescriptions;
        $this->data['ProductTemplates'] = $ProductTemplates;
        $ProductAttributes = $this->Product_Model->getProductAttributesByItemIdFrontEnd($id);
        $this->data['ProductAttributes'] = $ProductAttributes;
        $ProductSizes = $this->Product_Model->ProductQuantityDropDwon($id);
        //pr($ProductSizes, 1);
        $this->data['ProductSizes'] = $ProductSizes;
        $ProductPages = $this->Product_Model->getProductPages();
        $ProductSheets = $this->Product_Model->getProductSheets();
        $pageQuantity = $this->Product_Model->getPageQuantity();
        $this->data['ProductPages'] = $ProductPages;
        $this->data['ProductSheets'] = $ProductSheets;
        $this->data['pageQuantity'] = $pageQuantity;

        $total_items = $this->cart->total_items();
        $productRowid = '';
        $productQty = 0;

        if ($total_items > 0) {
            $carts = $this->cart->contents();
            foreach ($carts as $rowid => $cart) {
                if ($cart['id'] == $Product['id']) {
                    $productQty = $cart['qty'];
                    $productRowid = $rowid;
                    break;
                }
            }
        }
        $this->data['productRowid'] = $productRowid;
        $this->data['productQty'] = $productQty;

        ///// new structure
        $this->Product_Model->getProductAttributes($id, null, 0, 0, $attributes, $attributes_count);
        $this->Product_Model->getProductAttributeItems($id, null, null, 0, 0, $attribute_items, $attribute_items_count);
        $this->data['attributes'] = $attributes;
        $this->data['attribute_items'] = $attribute_items;

        // Check Provider binding
        $provider = $this->Provider_Model->getProvider('sina');
        $providerProduct = $this->Provider_Model->getProductByProductId($provider->id, $id);
        if ($providerProduct) {
            $providerInfo = [];
            $optionGroups = $this->Provider_Model->getProductOptionGroups($provider->id, $providerProduct->provider_product_id);
            $options = [];
            foreach ($optionGroups as $item) {
                $options[$item->id] = $item;
            }

            $data = $this->Provider_Model->getProductOptionValues($provider->id, $providerProduct->provider_product_id);
            foreach ($data as $item) {
                if ($item->provider_option_value_id == null || $item->value == null) {
                    continue;
                }

                $option = $options[$item->option_id];
                if (!isset($option->values)) {
                    $option->values = [];
                }
                $option->values[] = $item;
            }
            $this->data['provider'] = (object) [
                'id' => $provider->id,
                'product_id' => $id,
                'options' => $options,
                'shipping_extra_days' => $shipping_extra_days,
                'price_rate' => $providerProduct->price_rate,
            ];
            $this->data['providerProduct'] = $providerProduct;
        } else {
            $this->data['provider'] = false;
        }

        $this->render($this->class_name . 'view-map');
    }

    public function searchProduct()
    {
        $searchtext = $this->input->post('searchtext');
        if ($searchtext != '') {
            $searchtext = trim($searchtext);
            $this->load->model('Product_Model');
            if ($this->language_name == 'French') {
                $lists = $this->Product_Model->getProductSearchFranchList($searchtext);
            } else {
                $lists = $this->Product_Model->getProductSearchList($searchtext);
            }
            //pr($lists, 1);
            $search_result = '';
            if (!empty($lists)) {
                foreach ($lists as $list) {
                    if ($list['status'] == 1) {
                        $url = base_url() . "Products/view/" . base64_encode($list['id']);
                        $name = $this->language_name == 'French' ? $list['name_french'] : $list['name'];
                        $name = ucfirst($name);
                        $imageurl = getProductImage($list['product_image'], 'medium');

                        if ($this->main_store_id == 5) {
                            $category_id = 13;
                            $multipalCategory = $this->Product_Model->getProductMultipalCategoriesAndSubCategories($list['id']);
                            if (array_key_exists($category_id, $multipalCategory)) {
                                $search_result .= '<li><img src="' . $imageurl . '" width="50"><a href="' . $url . '">' . $name . '</a></li>';
                            }
                        } else {
                            $search_result .= '<li><img src="' . $imageurl . '" width="50"><a href="' . $url . '">' . $name . '</a></li>';
                        }
                    }
                }
            } else {
                $search_result = '<li><i class="fas fa-search"></i><a href="javascript:void(0)">product not found</a></li>';
            }
        } else {
            $search_result = '<li><i class="fas fa-search"></i><a href="javascript:void(0)">product not found</a></li>';
        }
        if (empty($search_result)) {
            $search_result = '<li><i class="fas fa-search"></i><a href="javascript:void(0)">product not found</a></li>';
        }

        echo $search_result;
    }

    public function addRating()
    {
        $this->load->model('Product_Model');
        $this->load->library('form_validation');
        $rules = $this->Product_Model->ratingRules;
        $this->form_validation->set_rules($rules);

        $response = [
            'status' => 'success',
            'msg' => '',
            'errors' => [],
        ];

        if ($this->form_validation->run() == false) {
            $response['status'] = 'error';
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $name = $this->input->post('name');
            $rate = $this->input->post('rate');
            $review = $this->input->post('review');
            $product_id = $this->input->post('product_id');
            $postData = [];
            $postData['name'] = $name;
            $postData['rate'] = $rate;
            $postData['review'] = $review;
            $postData['product_id'] = $product_id;
            $postData['user_id'] = $this->loginId;

            if (!$this->Product_Model->CheckRatingByUserIdAndProductId($this->loginId, $product_id)) {
                if ($this->Product_Model->saveRating($postData)) {
                    $data = $this->Product_Model->getTotalSumAvgReting($product_id);
                    $PdoductSaveData['rating'] = ceil($data['avg']);
                    $PdoductSaveData['reviews'] = $data['total'];
                    $PdoductSaveData['id'] = $product_id;
                    $this->Product_Model->saveProduct($PdoductSaveData);
                    $response['msg'] = 'Your review posted successfully.';
                } else {
                    $response['status'] = 'error';
                    $response['msg'] = 'Your review posted unsuccessfully.';
                }
            } else {
                $response['status'] = 'error';
                $response['msg'] = 'You have already add review on this product.';
            }
        }

        echo json_encode($response);
    }

    public function emailSubscribe()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            /*$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[subscribe_emails.email]', 'errors' => array(
            'required' => 'Enter email id',
            'is_unique' => 'Email id already registered'
            ));*/

            $this->load->model('Product_Model');
            $set_rules = $this->Product_Model->EmailRules;
            $this->form_validation->set_rules($set_rules);
            $response = [
                'status' => 'error',
                'msg' => '',
                'errors' => [],
            ];

            if ($this->form_validation->run() == false) {
                $response['errors'] = $this->form_validation->error_array();
            } else {
                $postData = [];
                $postData['email'] = $this->input->post('email');
                $postData['store_id'] = $this->main_store_id;

                if ($this->Product_Model->saveSubscribeEmail($postData)) {
                    $response['status'] = 'success';

                    $response['msg'] = 'Your email id subscribe successfully.';
                    if ($this->language_name == 'French') {
                        $response['msg'] = "Votre adresse e-mail s'est abonnée avec succès.";
                    }
                } else {
                    $response['msg'] = 'Your review posted unsuccessfully.';
                    if ($this->language_name == 'French') {
                        $response['msg'] = "Votre adresse e-mail s'est abonnée sans succès";
                    }
                }
            }

            echo json_encode($response);
        } else {
            redirect(base_url());
        }
    }

    public function calculatePrice()
    {
        $response = array();
        $product_id = $this->input->post('product_id');
        $price = $this->input->post('price');
        $quantity = $this->input->post('quantity');

        $quantity_id = $this->input->post('product_quantity_id');
        $size_id = $this->input->post('product_size_id');

        $add_length_width = $this->input->post('add_length_width');
        $page_add_length_width = $this->input->post('page_add_length_width');
        $depth_add_length_width = $this->input->post('depth_add_length_width');
        $recto_verso = $this->input->post('recto_verso');
        $recto_verso_price = $this->input->post('recto_verso_price');
        $quantity = !empty($quantity) ? $quantity : 1;

        /**
         * Find Price from full price list of outside source(like newprint, sina)
         */
        $multiple_attributes = [];
        foreach ($_POST as $key => $val) {
            if ($val == '') {
                continue;
            }

            if (preg_match('/^multiple_attribute_([0-9]+)$/i', $key, $m)) {
                $attribute_id = $m[1];
                $attribute_item_id = $val;
                $multiple_attributes[] = [$attribute_id, $attribute_item_id];
            }
        }
        usort($multiple_attributes, function ($a, $b) {
            if ($a[0] < $b[0]) {
                return -1;
            } else if ($a[0] > $b[0]) {
                return 1;
            }

            return 0;
        });
        $s_multiple_attributes = [];
        foreach ($multiple_attributes as $attribute) {
            $s_multiple_attributes[] = "$attribute[0] - $attribute[1]";
        }

        $price_newprint = $this->Product_Model->getFullPrice($product_id, $quantity_id, $size_id, join(',', $s_multiple_attributes));
        if ($price_newprint > 0) {
            $price = $price_newprint;
        } else {
            /**
             * Original price logic
             */
            $attributes = [];
            foreach ($_POST as $key => $val) {
                if ($val == '') {
                    continue;
                }

                if (preg_match('/^attribute_id_([0-9]+)$/i', $key, $m)) {
                    $attribute_id = $m[1];
                    $attribute_item_id = $val;
                    $attributes[] = [$attribute_id, $attribute_item_id];
                }
            }
            $price += $this->Product_Model->getSumExtraPriceOfSingleAttributes($product_id, $attributes);

            $price += $this->Product_Model->getSumExtraPriceOfQuantity($product_id, $quantity_id);
            $price += $this->Product_Model->getSumExtraPriceOfQuantitySize($product_id, $quantity_id, $size_id);
            $price += $this->Product_Model->getSumExtraPriceOfMultipleAttributes($product_id, $quantity_id, $size_id, $multiple_attributes);

            $Product = $this->Product_Model->getProductList($product_id);

            if (!empty($add_length_width)) {
                $product_length = $this->input->post('product_length');
                $product_width = $this->input->post('product_width');
                $product_total_page = $this->input->post('product_total_page');
                $length_width_quantity_show = $this->input->post('length_width_quantity_show');
                $length_width_color = $this->input->post('length_width_color');

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
                    $response['product_length'] = '';
                    $response['product_length_error'] = 'Please enter length';
                    if ($this->language_name == 'French') {
                        $response['product_length_error'] = 'Veuillez saisir la longueur';
                    }
                } else if ($product_length < $min_length || $product_length > $max_length) {
                    $response['product_length'] = 0;
                    $response['product_length_error'] = 'Please enter length between ' . showValue($min_length) . ' and ' . showValue($max_length);
                    if ($this->language_name == 'French') {
                        $response['product_length_error'] = 'Veuillez saisir la longueur entre ' . showValue($min_length) . ' et ' . showValue($max_length);
                    }
                } else if (empty($product_width)) {
                    $response['product_width'] = '';
                    $response['product_width_error'] = 'Please enter width';
                    if ($this->language_name == 'French') {
                        $response['product_width_error'] = 'Veuillez saisir la largeur';
                    }
                } else if ($product_width < $min_width || $product_width > $max_width) {
                    $response['product_width'] = 0;
                    $response['product_width_error'] = 'Please enter width between ' . showValue($min_width) . ' and ' . showValue($max_width);
                    if ($this->language_name == 'French') {
                        $response['product_width_error'] = 'Veuillez saisir la largeur entre ' . showValue($min_width) . ' et ' . showValue($max_width);
                    }
                } else if (empty($product_total_page) && $length_width_quantity_show == 1) {
                    $response['product_total_page'] = '';
                    $response['product_total_page_error'] = 'Please enter quantity';
                    if ($this->language_name == 'French') {
                        $response['product_total_page_error'] = 'Veuillez saisir la quantité';
                    }
                } else if (!empty($product_total_page) && $length_width_quantity_show == 1 && $length_width_pages_type == 'input' && ($product_total_page < $length_width_min_quantity || $product_total_page > $length_width_max_quantity)) {
                    $response['product_total_page'] = 0;
                    $response['product_total_page_error'] = 'Please enter quantity between ' . showValue($length_width_min_quantity) . ' and ' . showValue($length_width_max_quantity);
                    if ($this->language_name == 'French') {
                        $response['product_total_page_error'] = 'Veuillez saisir la quantité entre ' . showValue($length_width_min_quantity) . ' et ' . showValue($length_width_max_quantity);
                    }
                } else {
                    $rq_area = $product_length * $product_width;
                    $extra_price = 0;
                    if ($length_width_color_show == 1) {
                        if ($length_width_color == 'black') {
                            $extra_price = $length_width_unit_price_black * $rq_area;
                        } else if ($length_width_color == 'color') {
                            $extra_price = $length_width_price_color * $rq_area;
                        } else {
                            $extra_price = $min_length_min_width_price * $rq_area;
                        }
                    } else {
                        $extra_price = $min_length_min_width_price * $rq_area;
                    }

                    if ($length_width_quantity_show == 1 && !empty($product_total_page)) {
                        $extra_price = $product_total_page * $extra_price;
                    }

                    $price += $extra_price;
                    $response['product_width'] = $product_width;
                    $response['product_width_error'] = '';

                    $response['product_length'] = $product_length;
                    $response['product_length_error'] = '';

                    $response['product_total_page'] = $product_total_page;
                    $response['product_total_page_error'] = '';
                }
            }

            if (!empty($depth_add_length_width)) {
                $product_depth = $this->input->post('product_depth');
                $product_depth_length = $this->input->post('product_depth_length');
                $product_depth_width = $this->input->post('product_depth_width');
                $product_depth_total_page = $this->input->post('product_depth_total_page');
                $depth_width_length_quantity_show = $this->input->post('depth_width_length_quantity_show');
                $depth_color = $this->input->post('depth_color');

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

                $response['product_depth_length'] = $product_depth_length;
                $response['product_depth_length_error'] = '';

                $response['product_depth_width'] = $product_depth_width;
                $response['product_depth_width_error'] = '';

                $response['product_depth'] = $product_depth;
                $response['product_depth_error'] = '';

                $response['product_depth_total_page'] = $product_depth_total_page;
                $response['product_depth_total_page_error'] = '';

                if (empty($product_depth_length)) {
                    $response['product_depth_length'] = '';
                    $response['product_depth_length_error'] = 'Please enter length';
                    if ($this->language_name == 'French') {
                        $response['product_depth_length_error'] = 'Veuillez saisir la longueur';
                    }
                } else if ($product_depth_length < $depth_min_length || $product_depth_length > $depth_max_length) {
                    $response['product_depth_length'] = 0;
                    $response['product_depth_length_error'] = 'Please enter length between ' . showValue($depth_min_length) . ' and ' . showValue($depth_max_length);
                    if ($this->language_name == 'French') {
                        $response['product_depth_length_error'] = 'Veuillez saisir la longueur entre ' . showValue($depth_min_length) . ' et ' . showValue($depth_max_length);
                    }
                } else if (empty($product_depth_width)) {
                    $response['product_depth_width'] = '';
                    $response['product_depth_width_error'] = 'Please enter width';
                    if ($this->language_name == 'French') {
                        $response['product_depth_width_error'] = 'Veuillez saisir la largeur';
                    }
                } else if ($product_depth_width < $depth_min_width || $product_depth_width > $depth_max_width) {
                    $response['product_depth_width'] = 0;
                    $response['product_depth_width_error'] = 'Please enter width between ' . showValue($depth_min_width) . ' and ' . showValue($depth_max_width);
                    if ($this->language_name == 'French') {
                        $response['product_depth_width_error'] = 'Veuillez saisir la largeur entre ' . showValue($depth_min_width) . ' and ' . showValue($depth_max_width);
                    }
                } else if (empty($product_depth)) {
                    $response['product_depth'] = '';
                    $response['product_depth_error'] = 'Please enter depth';
                    if ($this->language_name == 'French') {
                        $response['product_depth_error'] = 'Please enter depth';
                    }
                } else if ($product_depth < $min_depth || $product_depth > $max_depth) {
                    $response['product_depth'] = 0;
                    $response['product_depth_error'] = 'Please enter depth between ' . showValue($min_depth) . ' and ' . showValue($max_depth);
                    if ($this->language_name == 'French') {
                        $response['product_depth_error'] = 'Veuillez saisir la profondeur entre ' . showValue($min_depth) . ' et ' . showValue($max_depth);
                    }
                } else if (empty($product_depth_total_page) && $depth_width_length_quantity_show == 1) {
                    $response['product_depth_total_page'] = '';
                    $response['product_depth_total_page_error'] = 'Please enter quantity';
                    if ($this->language_name == 'French') {
                        $response['product_depth_total_page_error'] = 'Veuillez saisir la quantité';
                    }
                } else if (!empty($product_depth_total_page) && $depth_width_length_quantity_show == 1 && $depth_width_length_type == 'input' && ($product_depth_total_page < $depth_min_quantity || $product_depth_total_page > $depth_max_quantity)) {
                    $response['product_depth_total_page'] = 0;
                    $response['product_depth_total_page_error'] = 'Please enter quantity between ' . showValue($depth_min_quantity) . ' and ' . showValue($depth_max_quantity);
                    if ($this->language_name == 'French') {
                        $response['product_depth_total_page_error'] = 'Veuillez saisir la quantité entre ' . showValue($depth_min_quantity) . ' et ' . showValue($depth_max_quantity);
                    }
                } else {
                    $rq_area = $product_depth_length * $product_depth_width * $product_depth;
                    $extra_price = 0;
                    if ($depth_color_show == 1) {
                        if ($depth_color == 'black') {
                            $extra_price = $depth_unit_price_black * $rq_area;
                        } else if ($depth_color == 'color') {
                            $extra_price = $depth_price_color * $rq_area;
                        } else {
                            $extra_price = $depth_width_length_price * $rq_area;
                        }
                    } else {
                        $extra_price = $depth_width_length_price * $rq_area;
                    }

                    if ($depth_width_length_quantity_show == 1 && !empty($product_depth_total_page)) {
                        $extra_price = $product_depth_total_page * $extra_price;
                    }

                    $price += $extra_price;
                    $response['product_depth_length'] = $product_depth_length;
                    $response['product_depth_width_error'] = '';

                    $response['product_depth_width'] = $product_depth_width;
                    $response['product_depth_length_error'] = '';

                    $response['product_depth'] = $product_depth;
                    $response['product_depth_error'] = '';

                    $response['product_depth_total_page'] = $product_depth_total_page;
                    $response['product_depth_total_page_error'] = '';
                }
            }

            if (!empty($page_add_length_width)) {
                $page_product_length = $this->input->post('page_product_length');
                $page_product_width = $this->input->post('page_product_width');
                $page_product_total_page = $this->input->post('page_product_total_page');
                $page_product_total_sheets = $this->input->post('page_product_total_sheets');

                $page_length_width_pages_show = $this->input->post('page_length_width_pages_show');
                $page_length_width_sheets_show = $this->input->post('page_length_width_sheets_show');

                $page_length_width_quantity_show = $this->input->post('page_length_width_quantity_show');
                $page_product_total_quantity = $this->input->post('page_product_total_quantity');

                $page_length_width_color = $this->input->post('page_length_width_color');

                $page_min_length = $Product['page_min_length'];
                $page_max_length = $Product['page_max_length'];
                $page_min_width = $Product['page_min_width'];
                $page_max_width = $Product['page_max_width'];
                $page_min_length_min_width_price = $Product['page_min_length_min_width_price'];
                $page_length_width_price_color = $Product['page_length_width_price_color'];

                $page_length_width_price_black = $Product['page_length_width_price_black'];
                $page_length_width_min_quantity = $Product['page_length_width_min_quantity'];
                $page_length_width_max_quantity = $Product['page_length_width_max_quantity'];
                $page_length_width_color_show = $Product['page_length_width_color_show'];
                $page_length_width_quantity_type = $Product['page_length_width_quantity_type'];

                $response['page_product_length'] = $page_product_length;
                $response['page_product_length_error'] = '';
                $response['page_product_width'] = $page_product_width;
                $response['page_product_width_error'] = '';

                $response['page_product_total_page'] = $page_product_total_page;
                $response['page_product_total_page_error'] = '';

                $response['page_product_total_sheets'] = $page_product_total_sheets;
                $response['page_product_total_sheets_error'] = '';

                $response['page_product_total_quantity'] = $page_product_total_quantity;
                $response['page_product_total_quantity_error'] = '';

                if (empty($page_product_length)) {
                    $response['page_product_length'] = '';
                    $response['page_product_length_error'] = 'Please enter Page length';
                    if ($this->language_name == 'French') {
                        $response['page_product_length_error'] = 'Veuillez saisir la longueur de la page';
                    }
                } else if ($page_product_length < $page_min_length || $page_product_length > $page_max_length) {
                    $response['page_product_length'] = 0;
                    $response['page_product_length_error'] = 'Please enter page length between ' . showValue($page_min_length) . ' and ' . showValue($page_max_length);
                    if ($this->language_name == 'French') {
                        $response['page_product_length_error'] = 'Veuillez saisir la longueur de la page entre ' . showValue($page_min_length) . ' et ' . showValue($page_max_length);
                    }
                } else if (empty($page_product_width)) {
                    $response['page_product_width'] = '';
                    $response['page_product_width_error'] = 'Please enter page width';
                    if ($this->language_name == 'French') {
                        $response['page_product_width_error'] = 'Veuillez saisir la largeur de la page';
                    }
                } else if ($page_product_width < $page_min_width || $page_product_width > $page_max_width) {
                    $response['page_product_width'] = 0;
                    $response['page_product_width_error'] = 'Please enter page width between ' . showValue($page_min_width) . ' and ' . showValue($page_max_width);
                    if ($this->language_name == 'French') {
                        $response['page_product_width_error'] = 'Veuillez saisir la largeur de page entre ' . showValue($page_min_width) . ' et ' . showValue($page_max_width);
                    }
                } else if (empty($page_product_total_page) && $page_length_width_pages_show == 1) {
                    $response['page_product_total_page'] = '';
                    $response['page_product_total_page_error'] = 'Please select pages';
                    if ($this->language_name == 'French') {
                        $response['page_product_total_page_error'] = 'Veuillez sélectionner des pages';
                    }
                } else if (empty($page_product_total_sheets) && $page_length_width_sheets_show == 1) {
                    $$response['page_product_total_sheets'] = '';
                    $response['page_product_total_sheets_error'] = 'Please Select Sheet per pad';
                    if ($this->language_name == 'French') {
                        $response['page_product_total_sheets_error'] = 'Veuillez sélectionner une feuille par bloc';
                    }
                } else if (empty($page_product_total_quantity) && $page_length_width_quantity_show == 1) {
                    $response['page_product_total_quantity'] = $page_product_total_quantity;
                    $response['page_product_total_quantity_error'] = 'Please enter quantity';
                    if ($this->language_name == 'French') {
                        $response['page_product_total_quantity_error'] = 'Veuillez saisir la quantité';
                    }
                } else if (!empty($page_product_total_quantity) && $page_length_width_quantity_show == 1 && $page_length_width_quantity_type == 'input' && ($page_product_total_quantity < $page_length_width_min_quantity || $page_product_total_quantity > $page_length_width_max_quantity)) {
                    $response['page_product_total_quantity'] = 0;
                    $response['page_product_total_quantity_error'] = 'Please enter quantity between ' . showValue($page_length_width_min_quantity) . ' and ' . showValue($page_length_width_max_quantity);
                    if ($this->language_name == 'French') {
                        $response['page_product_total_quantity_error'] = 'Veuillez saisir la quantité entre ' . showValue($page_length_width_min_quantity) . ' et ' . showValue($page_length_width_max_quantity);
                    }
                } else {
                    $rq_area = $page_product_length * $page_product_width;
                    $extra_price = 0;
                    if ($page_length_width_color_show == 1) {
                        if ($page_length_width_color == 'black') {
                            $extra_price = $page_length_width_price_black * $rq_area;
                        } else if ($page_length_width_color == 'color') {
                            $extra_price = $page_length_width_price_color * $rq_area;
                        } else {
                            $extra_price = $page_min_length_min_width_price * $rq_area;
                        }
                    } else {
                        $extra_price = $page_min_length_min_width_price * $rq_area;
                    }

                    if (!empty($page_product_total_page) && $page_length_width_pages_show == 1) {
                        $page_product_total_page_error = explode('-', $page_product_total_page);
                        $page_extra_price = $page_product_total_page_error[0] * $extra_price;
                        $page_product_total_page = $page_product_total_page_error[0];
                        if (!empty($page_product_total_sheets) && $page_length_width_sheets_show == 1) {
                            $sheets_extra_price = $page_product_total_sheets * $extra_price;
                            if ($page_extra_price > 0 || $sheets_extra_price > 0) {
                                $extra_price = $page_extra_price + $sheets_extra_price;
                            }
                        }
                    }

                    if (!empty($page_product_total_quantity) && $page_length_width_quantity_show == 1) {
                        $extra_price = $page_product_total_quantity * $extra_price;
                    }

                    $price += $extra_price;
                    $response['page_product_width'] = $page_product_width;
                    $response['page_product_width_error'] = '';

                    $response['page_product_length'] = $page_product_length;
                    $response['page_product_length_error'] = '';

                    $response['page_product_total_sheets'] = $page_product_total_sheets;
                    $response['page_product_total_sheets_error'] = '';

                    $response['page_product_total_quantity'] = $page_product_total_quantity;
                    $response['page_product_total_quantity_error'] = '';
                }
            }

            #RECTO PRICE CAl.
            if (!empty($recto_verso) && $recto_verso == "Yes" && !empty($recto_verso_price)) {
                $price = $price + (($price * $recto_verso_price) / 100);
            }
        }

        // $response['form'] = $_POST;
        // $response['parsed'] = $multiple_attributes;
        $response['success'] = 1;
        $response['price'] = number_format($price * $quantity, 2);
        echo json_encode($response);
        exit(0);
    }

    public function GetQuantity()
    {
        $product_id = $this->input->post('product_id');
        $price = $this->input->post('price');
        $quantity = $this->input->post('quantity');
        $product_quantity_id = $this->input->post('product_quantity_id');

        $product_size_id = $this->input->post('product_size_id');

        $add_length_width = $this->input->post('add_length_width');

        $page_add_length_width = $this->input->post('page_add_length_width');

        $depth_add_length_width = $this->input->post('depth_add_length_width');

        $recto_verso = $this->input->post('recto_verso');
        $recto_verso_price = $this->input->post('recto_verso_price');

        $quantity = !empty($quantity) ? $quantity : 1;

        $ProductSizes = $this->Product_Model->ProductQuantitySizeDropDwon($product_id);
        $quantityData = isset($ProductSizes[$product_quantity_id]) ? $ProductSizes[$product_quantity_id] : array();

        $qty_ext_price = isset($quantityData['price']) ? $quantityData['price'] : 0;

        $price = $price + $qty_ext_price;

        $sizeData = isset($ProductSizes[$product_quantity_id]['sizeData'][$product_size_id]) ? $ProductSizes[$product_quantity_id]['sizeData'][$product_size_id] : array();

        $extra_price = isset($sizeData['extra_price']) ? $sizeData['extra_price'] : 0;

        $price = $price + $extra_price;

        $ProductAttributes = $this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);
        foreach ($ProductAttributes as $key => $val) {
            $attribute_name = 'attribute_id_' . $key;
            $attribute_item_id = isset($_POST[$attribute_name]) ? $this->input->post($attribute_name) : '';
            $items = $val['items'];

            if (!empty($attribute_item_id) && array_key_exists($attribute_item_id, $items)) {
                $extra_price = $items[$attribute_item_id]['extra_price'];
                $price += $extra_price;
            }
        }

        if (!empty($add_length_width)) {
            $product_length = $this->input->post('product_length');
            $product_width = $this->input->post('product_width');

            $product_total_page = $this->input->post('product_total_page');

            $length_width_quantity_show = $this->input->post('length_width_quantity_show');

            $length_width_color = $this->input->post('length_width_color');

            if (!empty($product_length) && !empty($product_width)) {
                $Product = $this->Product_Model->getProductList($product_id);
                $min_length = $Product['min_length'];
                $max_length = $Product['max_length'];
                $min_width = $Product['min_width'];
                $max_width = $Product['max_width'];
                $min_length_min_width_price = $Product['min_length_min_width_price'];

                $length_width_color_show = $Product['length_width_color_show'];

                $length_width_unit_price_black = $Product['length_width_unit_price_black'];
                $length_width_price_color = $Product['length_width_price_color'];

                $rq_area = $product_length * $product_width;
                $extra_price = 0;

                if ($length_width_color_show == 1) {
                    if (!empty($length_width_color)) {
                        if ($length_width_color == 'black') {
                            $extra_price = $length_width_unit_price_black * $rq_area;
                        } else if ($length_width_color == 'color') {
                            $extra_price = $length_width_price_color * $rq_area;
                        }
                    } else {
                        $extra_price = $min_length_min_width_price * $rq_area;
                    }
                } else {
                    $extra_price = $min_length_min_width_price * $rq_area;
                }

                if ($length_width_quantity_show == 1 && !empty($product_total_page)) {
                    $extra_price = $product_total_page * $extra_price;
                }

                $price += $extra_price;
            }
        }

        if (!empty($depth_add_length_width)) {
            $product_depth_length = $this->input->post('product_depth_length');
            $product_depth_width = $this->input->post('product_depth_width');

            $product_depth_total_page = $this->input->post('product_depth_total_page');

            $product_depth = $this->input->post('product_depth');
            $depth_width_length_quantity_show = $this->input->post('depth_width_length_quantity_show');

            $depth_color = $this->input->post('depth_color');

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

            if (!empty($product_depth_length) && !empty($product_depth_width) && !empty($product_depth)) {
                $rq_area = $product_depth_length * $product_depth_width * $product_depth;
                $extra_price = 0;

                if ($depth_color_show == 1) {
                    if (!empty($depth_color)) {
                        if ($depth_color == 'black') {
                            $extra_price = $depth_unit_price_black * $rq_area;
                        } else if ($depth_color == 'color') {
                            $extra_price = $depth_price_color * $rq_area;
                        }
                    } else {
                        $extra_price = $depth_width_length_price * $rq_area;
                    }
                } else {
                    $extra_price = $depth_width_length_price * $rq_area;
                }

                if ($depth_width_length_quantity_show == 1 && !empty($product_depth_total_page)) {
                    $extra_price = $product_depth_total_page * $extra_price;
                }
            }
        }

        if (!empty($page_add_length_width)) {
            $page_product_length = $this->input->post('page_product_length');
            $page_product_width = $this->input->post('page_product_width');
            $page_product_total_sheets = $this->input->post('page_product_total_sheets');
            $page_product_total_page = $this->input->post('page_product_total_page');

            $page_length_width_pages_show = $this->input->post('page_length_width_pages_show');
            $page_length_width_sheets_show = $this->input->post('page_length_width_sheets_show');
            $page_length_width_color = $this->input->post('page_length_width_color');

            $page_length_width_quantity_show = $this->input->post('page_length_width_quantity_show');

            $page_product_total_quantity = $this->input->post('page_product_total_quantity');

            if (!empty($page_product_length) && !empty($page_product_width)) {
                $Product = $this->Product_Model->getProductList($product_id);

                $page_min_length = $Product['page_min_length'];
                $page_max_length = $Product['page_max_length'];
                $page_min_width = $Product['page_min_width'];
                $page_max_width = $Product['page_max_width'];
                $page_min_length_min_width_price = $Product['page_min_length_min_width_price'];

                $page_length_width_price_color = $Product['page_length_width_price_color'];
                $page_length_width_price_black = $Product['page_length_width_price_black'];

                $page_length_width_color_show = $Product['page_length_width_color_show'];

                $rq_area = $page_product_length * $page_product_width;

                $extra_price = 0;
                if ($page_length_width_color_show == 1) {
                    if (!empty($page_length_width_color)) {
                        if ($page_length_width_color == 'black') {
                            $extra_price = $page_length_width_price_black * $rq_area;
                        } else if ($page_length_width_color == 'color') {
                            $extra_price = $page_length_width_price_color * $rq_area;
                        }
                    } else {
                        $extra_price = $page_min_length_min_width_price * $rq_area;
                    }
                } else {
                    $extra_price = $page_min_length_min_width_price * $rq_area;
                }
                $page_extra_price = 0;
                $sheets_extra_price = 0;
                if (!empty($page_product_total_page) && $page_length_width_pages_show == 1) {
                    $page_product_total_page_error = explode('-', $page_product_total_page);
                    $page_extra_price = $page_product_total_page_error[0] * $extra_price;
                }

                if (!empty($page_product_total_sheets) && $page_length_width_sheets_show == 1) {
                    $sheets_extra_price = $page_product_total_sheets * $extra_price;
                }

                if (!empty($page_extra_price) || !empty($sheets_extra_price)) {
                    $extra_price = $page_extra_price + $sheets_extra_price;
                }

                if (!empty($page_product_total_quantity) && $page_length_width_quantity_show == 1) {
                    $extra_price = $page_product_total_quantity * $extra_price;
                }

                $price += $extra_price;
            }
        }

        #RECTO PRICE CAl.
        if (!empty($recto_verso) && $recto_verso == "Yes" && !empty($recto_verso_price)) {
            $price = $price + (($price * $recto_verso_price) / 100);
        }

        $response = array();
        $response['success'] = 1;
        $price = $price * $quantity;
        $response['price'] = number_format($price, 2);
        $response['sizeoptions'] = $this->getSizeOptions($product_id, $product_quantity_id, $product_size_id, 1);
        //pr($response, 1);
        echo json_encode($response);
        exit(0);
    }

    public function getSizeOptions($product_id = null, $product_quantity_id = null, $product_size_id = null, $fl = 0)
    {
        if (empty($product_id)) {
            redirect(base_url());
        }
        $this->load->model('Product_Model');
        $ProductSizes = $this->Product_Model->ProductQuantitySizeAttributeDropDown($product_id);
        $MultipleAttributes = $this->Product_Model->getMultipleAttributesDropDown();
        $response = array();

        $options = $this->language_name == 'French' ? '<option value="">Choisis une option...</option>' : '<option value="">Choose an option...</option>';
        $options_size = '';
        $size_disabled = true;
        $AtirbuteProductSizes = array();
        if (!empty($product_quantity_id) && !empty($product_size_id)) {
            $quantityData = $ProductSizes[$product_quantity_id];
            $sizeData = isset($quantityData['sizeData']) ? $quantityData['sizeData'] : array();
            $attribute = isset($sizeData[$product_size_id]['attribute']) ? $sizeData[$product_size_id]['attribute'] : array();

            if (!empty($sizeData)) {
                $options_size = $options;
                $size_disabled = false;
                foreach ($sizeData as $key1 => $val1) {
                    $label = $this->language_name == 'French' ? $val1['size_name_french'] : $val1['size_name'];
                    $selected = '';
                    if ($key1 == $product_size_id) {
                        $selected = 'selected="selected"';
                    }
                    $options_size = $options_size . "<option value='" . $key1 . "' $selected>" . $label . "</option>";
                }
            }

            if (!empty($attribute)) {
                foreach ($MultipleAttributes as $mkey => $mval) {
                    if (array_key_exists($mkey, $attribute)) {
                        $AtirbuteProductSizes[$mkey]['attribute_name'] = $attribute[$mkey]['attribute_name'];
                        $AtirbuteProductSizes[$mkey]['attributes_name_french'] = $attribute[$mkey]['attributes_name_french'];
                        $AtirbuteProductSizes[$mkey]['attribute_items'] = $attribute[$mkey]['attribute_items'];
                    }
                }
            }
        } else if (!empty($product_quantity_id) && empty($product_size_id)) {
            $quantityData = $ProductSizes[$product_quantity_id];
            $sizeData = isset($quantityData['sizeData']) ? $quantityData['sizeData'] : array();

            if (!empty($sizeData)) {
                $options_size = $options;
                $size_disabled = false;
                foreach ($sizeData as $key1 => $val1) {
                    $label = $this->language_name == 'French' ? $val1['size_name_french'] : $val1['size_name'];

                    $options_size = $options_size . "<option value='" . $key1 . "'>" . $label . "</option>";
                    $attribute = isset($val1['attribute']) ? $val1['attribute'] : array();
                    if (!empty($attribute)) {
                        foreach ($MultipleAttributes as $mkey => $mval) {
                            if (array_key_exists($mkey, $attribute)) {
                                $AtirbuteProductSizes[$mkey]['attribute_name'] = $attribute[$mkey]['attribute_name'];
                                $AtirbuteProductSizes[$mkey]['attributes_name_french'] = $attribute[$mkey]['attributes_name_french'];
                                $AtirbuteProductSizes[$mkey]['attribute_items'] = $attribute[$mkey]['attribute_items'];
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($ProductSizes as $key => $val) {
                $sizeData = isset($val['sizeData']) ? $val['sizeData'] : array();
                if (!empty($sizeData)) {
                    $options_size = $options;
                    foreach ($sizeData as $key1 => $val1) {
                        $attribute = isset($val1['attribute']) ? $val1['attribute'] : array();

                        if (!empty($attribute)) {
                            foreach ($MultipleAttributes as $mkey => $mval) {
                                if (array_key_exists($mkey, $attribute)) {
                                    $AtirbuteProductSizes[$mkey]['attribute_name'] = $attribute[$mkey]['attribute_name'];
                                    $AtirbuteProductSizes[$mkey]['attributes_name_french'] = $attribute[$mkey]['attributes_name_french'];
                                    $AtirbuteProductSizes[$mkey]['attribute_items'] = $attribute[$mkey]['attribute_items'];
                                }
                            }
                        }
                    }
                }
            }
        }

        $response = $this->data;
        $response['language_name'] = $this->language_name;
        $response['product_quantity_id'] = $product_quantity_id;
        $response['product_size_id'] = $product_size_id;
        $response['product_id'] = $product_id;
        $response['ProductSizes'] = $ProductSizes;
        $response['MultipleAttributes'] = $MultipleAttributes;
        $response['options'] = $options;
        $response['options_size'] = $options_size;
        $response['size_disabled'] = $size_disabled;
        $response['AtirbuteProductSizes'] = $AtirbuteProductSizes;
        if (empty($options_size)) {
            return 0;
            exit();
        }
        if ($fl) {
            return $this->load->view('Products/size_options', $response, true);
        } else {
            echo $this->load->view('Products/size_options', $response, true);
        }
        exit();
    }

    public function uploadImage()
    {
        #unset($_SESSION['product_id']); die();
        $product_id = $_POST['product_id'];
        /* Getting file name */
        $filename = $_FILES['file']['name'];
        /* Getting File size */
        $filesize = $_FILES['file']['size'];
        $filetype = $_FILES['file']['type'];
        /* Location */
        $time = time();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newfileName = "cart-image/" . $time . '.' . $ext;
        $location = FILE_UPLOAD_BASE_PATH . "cart-image/" . $time . '.' . $ext;
        $return_arr = array();
        $session_data = array();
        /* Upload file */
        $data = $this->data;

        $return_arr = array("name" => $filename, "size" => $filesize, "src" => $src, 'skey' => $key, 'product_id' => $product_id, 'location' => $location, 'cumment' => '', 'error' => '', 'error_msg' => '', 'file_base_url' => '');

        if ($filetype != 'application/pdf') {
            $return_arr['error'] = 1;
            $return_arr['error_msg'] = $this->language_name == 'French' ? 'Type de fichier autorisé uniquement pdf' : 'Allowed file type only pdf';
        } else if ($filesize > 262144000) { //250MB

            $return_arr['error'] = 1;
            $return_arr['error_msg'] = 'Maximum file size allowed for upload 250 MB';
            $return_arr['error_msg'] = $this->language_name == 'French' ? 'Taille de fichier maximale autorisée pour le téléchargement 250 Mo' : 'Maximum file size allowed for upload 250 MB';
        } else if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            $src = DEFAULT_IMAGE_URL . "pdf-icon.png";

            $file_base_url = FILE_UPLOAD_BASE_URL . $newfileName;

            // checking file is image or not
            /*if (is_array(getimagesize($location))) {
            $src = FILE_UPLOAD_BASE_URL.$newfileName;
            }*/

            $range = range(1, 5000);
            $key = array_rand($range);
            $return_arr = array("name" => $filename, "size" => $filesize, "src" => $src, 'skey' => $key, 'product_id' => $product_id, 'location' => $location, 'cumment' => '', 'error' => '', 'error_msg' => '', 'file_base_url' => $file_base_url);

            $_SESSION['product_id'][$product_id][$key] = $return_arr;

            $data['return_arr'] = $return_arr;
        } else {
            $return_arr['error'] = 1;
            $return_arr['error_msg'] = $this->language_name == 'French' ? 'Le téléchargement du fichier a échoué' : 'File upload failed';
        }

        if (empty($return_arr['error'])) {
            $html = $this->load->view('Ajax/file_data', $data, true);
            $return_arr['html'] = $html;
        } else {
            $return_arr['html'] = '';
        }
        echo json_encode($return_arr);
    }

    public function updateCumment()
    {
        $product_id = $_POST['product_id'];
        $skey = $_POST['skey'];
        $cumment = $_POST['cumment'];

        if (isset($_SESSION['product_id'][$product_id])) {
            $_SESSION['product_id'][$product_id][$skey]['cumment'] = $cumment;
        }
        exit(0);
        //echo json_encode($return_arr);
    }

    public function deleteImage()
    {
        $product_id = $_POST['product_id'];
        $skey = $_POST['skey'];
        $location = $_POST['location'];
        if (isset($_SESSION['product_id'][$product_id])) {
            unset($_SESSION['product_id'][$product_id][$skey]);

            /*if (file_exists($location)) {
        unlink($location);
        }*/
        }
        exit(0);
        //echo json_encode($return_arr);
    }

    public function saveEstimate()
    {
        $this->load->library('form_validation');
        $this->load->model('Estimate_Model');

        $rules = $this->Estimate_Model->rules;
        if ($this->language_name == 'French') {
            $rules = $this->Estimate_Model->rulesFrench;
        }

        $this->form_validation->set_rules($rules);

        $response = [
            'status' => 'success',
            'msg' => '',
            'errors' => [],
        ];

        if ($this->form_validation->run() == false) {
            $response['status'] = 'error';
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $postData['contact_name'] = $this->input->post('contact_name');
            $postData['company_name'] = $this->input->post('company_name');
            $postData['email'] = $this->input->post('email');
            $postData['phone_number'] = $this->input->post('phone_number');
            $postData['street'] = $this->input->post('street');
            $postData['city'] = $this->input->post('city');
            $postData['province'] = $this->input->post('province');
            $postData['country'] = $this->input->post('country');
            $postData['postal_code'] = $this->input->post('postal_code');
            $postData['product_type'] = $this->input->post('product_type');
            $postData['product_name'] = $this->input->post('product_name');
            $postData['same_quote_request'] = $this->input->post('same_quote_request');
            $postData['qty_1'] = $this->input->post('qty_1');
            $postData['qty_2'] = $this->input->post('qty_2');
            $postData['qty_3'] = $this->input->post('qty_3');
            $postData['more_qty'] = $this->input->post('more_qty');
            $postData['flat_size'] = $this->input->post('flat_size');
            $postData['finish_size'] = $this->input->post('finish_size');
            $postData['paper_stock'] = $this->input->post('paper_stock');
            $postData['no_of_sides'] = $this->input->post('no_of_sides');
            $postData['folding'] = $this->input->post('folding');
            $postData['total_versions'] = $this->input->post('total_versions');
            $postData['shipping_methods'] = $this->input->post('shipping_methods');
            $postData['notes'] = $this->input->post('notes');
            $postData['store_id'] = $this->main_store_id;

            if ($this->Estimate_Model->saveEstimateData($postData)) {
                $subject = 'Estimate Quote Request';
                $postData['same_quote_request'] = $postData['same_quote_request'] == 0 ? "Nope" : "Yes";
                $postData['no_of_sides'] = $postData['no_of_sides'] == 1 ? "1 side (inches)" : "Flat Format (2 Sides)";
                $body = '<div style="text-align:left;">' .
                addEmailItem('Name Of The Contact', $postData['contact_name']) .
                addEmailItem('Company Name', $postData['company_name']) .
                addEmailItem('Email Address', $postData['email']) .
                addEmailItem('Street', $postData['street']) .
                addEmailItem('City', $postData['city']) .
                addEmailItem('Country', $postData['country']) .
                addEmailItem('State', $postData['province']) .
                addEmailItem('Postal Code', $postData['postal_code']) .
                addEmailItem('Product Type (Postcards, Booklets)', $postData['product_type']) .
                addEmailItem('Product Name', $postData['product_name']) .
                addEmailItem('Ever Requested The Same Quote?', $postData['same_quote_request']) .
                addEmailItem('Qty1', $postData['qty_1']) .
                addEmailItem('Qty2', $postData['qty_2']) .
                addEmailItem('Qty3', $postData['qty_3']) .
                addEmailItem('More quantity', $postData['more_qty']) .
                addEmailItem('Flat Size (inches)', $postData['flat_size']) .
                addEmailItem('Finished Size (inches)', $postData['finish_size']) .
                addEmailItem('Paper / Stock', $postData['paper_stock']) .
                addEmailItem('Number Of Sides', $postData['no_of_sides']) .
                addEmailItem('Folding', $postData['folding']) .
                addEmailItem('Number of Versions', $postData['folding']) .
                addEmailItem('Shipping Method', $postData['shipping_methods']) .
                addEmailItem('Notes', $postData['notes']) .
                    '</div>';

                $logo = $this->data['language_name'] == 'French' ? getLogoImages($this->data['configrations']['logo_image_french'], true) : getLogoImages($this->data['configrations']['logo_image'], true);
                $body = emailTemplate($subject, $body, false, $logo);
                sendEmail(ADMIN_EMAIL, $subject, $body, FROM_EMAIL, 'ADMIN', array());

                $response['msg'] = 'Thank you for contacting printing coop we have received your estimation query our representative will get back to you within 24 hours';
                if ($this->language_name == 'French') {
                    $response['msg'] = "Merci d'avoir contacté Imprimeur.coop nous avons reçu votre demande d'estimation notre représentant vous répondra dans les 24 heures";
                }
            } else {
                $response['status'] = 'error';
                $response['msg'] = 'Your Estimate Not Save Please Try Again.';
                if ($this->language_name == 'French') {
                    $response['msg'] = "Votre estimation n'est pas enregistrée. Veuillez réessayer.";
                }
            }
        }

        echo json_encode($response);
    }

    public function download($filePath = null, $name = null)
    {
        $this->load->helper('download');
        if ($filePath) {
            ///$file = FILE_UPLOAD_BASE_URL."cart-image\\" .$fileName;
            $file = urldecode($filePath);
            // check file exists
            if (file_exists($file)) {
                // get file content
                $data = file_get_contents($file);

                //force download
                force_download(urldecode($name), $data);
                exit();
            }
        }
    }

    public function PrinterSeries($name = null)
    {
        $label = $this->language_name == 'French' ? "Sélectionnez une série d'imprimantes" : 'Select a Printer Series';
        $this->load->model('Printer_Model');
        $options = '<option value="">' . $label . '</option>';
        $name = trim($name);
        $name = str_replace('%20', ' ', $name);

        if (!empty($name)) {
            $data = $this->Printer_Model->getDataByName('printers', $name);
            $printer_brand = $data['id'];
            $PrinterSeries = $this->Printer_Model->getAcctivePrinterSeriesByBrandId($printer_brand);
            foreach ($PrinterSeries as $key => $val) {
                $options .= '<option value="' . $val['name'] . '">' . $val['name'] . '</option>';
            }
        }
        echo $options;
        exit();
    }

    public function PrinterModel($printer_brand = null, $printer_series = null)
    {
        $this->load->model('Printer_Model');
        $label = $this->language_name == 'French' ? "Sélectionnez un modèle d'imprimante" : 'Select a Printer Model';
        $options = '<option value="">' . $label . '</option>';

        $printer_series = trim($printer_series);
        $printer_series = str_replace('%20', ' ', $printer_series);

        $printer_brand = trim($printer_brand);
        $printer_brand = str_replace('%20', ' ', $printer_brand);

        if (!empty($printer_brand) && !empty($printer_series)) {
            $data = $this->Printer_Model->getDataByName('printers', $printer_brand);
            $sdata = $this->Printer_Model->getDataByName('printer_series', $printer_series);
            $printer_brand_id = $data['id'];
            $printer_series_id = $sdata['id'];
            $PrinterModel = $this->Printer_Model->getAcctiveModelByBrandId($printer_brand_id, $printer_series_id);
            foreach ($PrinterModel as $key => $val) {
                $options .= '<option value="' . $val['name'] . '">' . $val['name'] . '</option>';
            }
        }
        echo $options;
        exit();
    }

    public function ProviderPrice()
    {
        $params = [];
        parse_str($this->input->post('params'), $params);

        $provider_id = $params['provider_id'];
        $product_id = $params['product_id'];
        $productOptions = array_filter($params['productOptions']);

        $this->load->model('Provider_Model');
        $providerProduct = $this->Provider_Model->getProductByProductId($provider_id, $product_id);
        if ($providerProduct) {
            if ($providerProduct->information_type == ProviderProductInformationType::Normal) {
                unset($productOptions['turnaround']);
                $options = array_values((array) $productOptions);
            } else if ($providerProduct->information_type == ProviderProductInformationType::RollLabel) {
                // $options = [];
                // foreach ($productOptions as $key => $value) {
                //     $options["productOptions[$key]"] = $value;
                // }
                $options = $productOptions;
            }
            $price = sina_price($providerProduct->provider_product_id, $options);
            $result = ['success' => true, 'price' => $price];
        } else {
            $result = ['success' => false, 'message' => "Can't find product info"];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
