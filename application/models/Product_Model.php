<?php

class Product_Model extends MY_Model
{
    public $table = 'products';
    public $config = array(
        array(
            'field' => 'name',
            'label' => 'product name',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter product name',
            ),
        ),
        /*array(
        'field' => 'category_id',
        'label' => 'category',
        'rules' => 'required',
        'errors' => array(
        'required' => 'Select Category',
        ),
        ),
        array(
        'field' => 'sub_category_id',
        'label' => 'Sub Category',
        'rules' => 'required',
        'errors' => array(
        'required' => 'Select Sub Category',
        ),
        ),*/
        array(
            'field' => 'price',
            'label' => 'product price',
            'rules' => 'required|numeric',
            'errors' => array(
                'required' => 'Enter product price',
            ),
        ),
        /*array(
        'field' => 'total_stock',
        'label' => 'product stock',
        'rules' => 'required|integer',
        'errors' => array(
        'required' => 'Enter product stock',
        ),
        ),*/
        array(
            'field' => 'discount',
            'label' => 'discount',
            'rules' => 'integer|less_than[101]',
            'errors' => array(
                'less_than' => 'Discount maximum value allowed only 100',
            ),
        ),
        /*array(
        'field' => 'short_description',
        'label' => 'product short  description ',
        'rules' => 'required',
        'errors' => array(
        'required' => 'Enter product short description',
        ),
        ),
        array(
        'field' => 'full_description',
        'label' => 'product full description',
        'rules' => 'required',
        'errors' => array(
        'required' => 'Enter product full description',
        ),
        ),*/

        /*array(
    'field' => 'store_id[]',
    'label' => 'store_id',
    'rules' => 'required',
    'errors' => array(
    'required' => 'Select store',
    ),
    )*/

    );

    public $ratingRules = [
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
        ],
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required',
        ],
        [
            'field' => 'review',
            'label' => 'Password',
            'rules' => 'required',
        ],
    ];

    public $EmailRules = [
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|is_unique[subscribe_emails.email]',
            'errors' => [
                'is_unique' => 'You have already subscribe this email id',
            ],
        ],
    ];

    public function getProductList($id = null, $product_id = null, $limit = null, $start = null, $order = 'desc')
    {
        $this->db->select(array('Product.*',
            'Category.name as category_name', 'Category.name_french as category_name_french',
            'SubCategory.name as sub_category_name', 'SubCategory.name_french as sub_category_name_french',
            'provider_products.provider_product_id',
        ));
        $this->db->from($this->table . ' as Product');
        $where = [];
        if ($id) {
            $where['Product.id'] = $id;
        }
        if ($product_id) {
            $where['Product.id'] = $product_id;
        }
        $this->db->where($where);
        $this->db->join('categories as Category', 'Category.id=Product.category_id', 'left');
        $this->db->join('sub_categories as SubCategory', 'SubCategory.id=Product.sub_category_id', 'left');
        $this->db->join('provider_products', 'provider_products.product_id = Product.id', 'left');

        //$this->db->join('brands as Brand', 'Brand.id=Product.brand', 'left');
        //$this->db->join('discounts as Discount', 'Discount.id=Product.discount_id', 'left');
        //$this->db->order_by('Category.category_order', 'asc');
        //$this->db->order_by('SubCategory.sub_category_order', 'asc');
        $this->db->order_by('Product.updated', $order);
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        //echo $this->db->last_query(); die();
        if ($id) {
            $data = (array) $query->row();
        } else {
            $data = $query->result_array();
        }

        return $data;
    }

    public function getProductTotal($product_id = null)
    {
        $this->db->select(array('Product.*', 'Category.name as category_name', 'SubCategory.name as sub_category_name'));
        $this->db->from($this->table . ' as Product');
        $where = [];
        if ($product_id) {
            $where['Product.id'] = $product_id;
        }
        $this->db->where($where);
        $this->db->join('categories as Category', 'Category.id=Product.category_id', 'left');
        $this->db->join('sub_categories as SubCategory', 'SubCategory.id=Product.sub_category_id', 'left');
        //$this->db->join('brands as Brand', 'Brand.id=Product.brand', 'left');
        //$this->db->join('discounts as Discount', 'Discount.id=Product.discount_id', 'left');
        $this->db->order_by('Category.category_order', 'asc');
        $this->db->order_by('SubCategory.sub_category_order', 'asc');
        $this->db->order_by('Product.name', 'asc');
        $query = $this->db->get();
        $data = $query->num_rows();
        return $data;
    }

    public function getPersonailise($id = null)
    {
        $this->db->select(array('*'));
        $this->db->from('product_personalise');

        //$this->db->where(array('Menu.status' => 1, 'Category.status' => 1, 'SubCategory.status' => 1));

        $this->db->where(array('product_Id' => $id));

        $query = $this->db->get();
        if (!empty($id)) {
            $data = (array) $query->row();
        } else {
            $data = $query->result_array();
        }

        return $data;
    }

    public function getActiveProductList($category_id = null, $sub_category_id = null, $order_by = 'name', $type = 'asc', $start = 0, $limit = 12, $printer_brand = null, $printer_series = null, $printer_models = null)
    {
        $this->db->select('*');
        $condition = array();
        $condition['status'] = 1;
        $productIds = [];
        if (!empty($category_id)) {
            //$condition['category_id'] = $category_id;
            $productIds = $this->getProductIdsByCategory($category_id);
        }
        if (!empty($sub_category_id)) {
            $productIds = $this->getProductIdsBySubCategory($category_id, $sub_category_id);
            //$condition['sub_category_id'] = $sub_category_id;
        }

        if ($productIds) {
            $this->db->where_in('id', $productIds);
        }

        if (!empty($printer_brand)) {
            $this->db->like('name', $printer_brand);
        }
        if (!empty($printer_series)) {
            $this->db->like('code', $printer_series);
        }
        if (!empty($printer_models)) {
            $this->db->like('model', $printer_models);
        }

        $this->db->where($condition);
        $this->db->from($this->table);
        $this->db->limit($limit, $start);
        $this->db->order_by($order_by, $type);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }
    public function getCSVProductList($category_id = null, $sub_category_id = null, $order_by = 'name', $type = 'asc', $printer_brand = null)
    {
        $this->db->select('*');
        $condition = array();
        $condition['status'] = 1;
        if (!empty($category_id)) {
            //$condition['category_id'] = $category_id;
            $productIds = $this->getProductIdsByCategory($category_id);
        }
        if (!empty($sub_category_id)) {
            $productIds = $this->getProductIdsBySubCategory($category_id, $sub_category_id);
            //$condition['sub_category_id'] = $sub_category_id;
        }

        if ($productIds) {
            $this->db->where_in('id', $productIds);
        }

        if (!empty($printer_brand)) {
            $this->db->like('name', $printer_brand);
        }

        $this->db->where($condition);
        $this->db->from($this->table);
        //$this->db->limit($limit, $start);
        $this->db->order_by($order_by, $type);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }
    public function getTotalActiveProduct($category_id = null, $sub_category_id = null, $printer_brand = null, $printer_series = null, $printer_models = null)
    {
        $this->db->select('*');
        $condition = array();
        $condition['status'] = 1;
        $productIds = [];
        if (!empty($category_id)) {
            //$condition['category_id'] = $category_id;
            $productIds = $this->getProductIdsByCategory($category_id);
        }
        if (!empty($sub_category_id)) {
            $productIds = $this->getProductIdsBySubCategory($category_id, $sub_category_id);
            //$condition['sub_category_id'] = $sub_category_id;
        }

        if ($productIds) {
            $this->db->where_in('id', $productIds);
        }

        if (!empty($printer_brand)) {
            $this->db->like('name', $printer_brand);
        }
        if (!empty($printer_series)) {
            $this->db->like('code', $printer_series);
        }
        if (!empty($printer_models)) {
            $this->db->like('model', $printer_models);
        }
        $this->db->where($condition);
        $this->db->from($this->table);
        $total = $this->db->get()->num_rows();
        return $total;
    }

    public function getProductIdsByCategory($category_id)
    {
        $this->db->select('product_id');
        $this->db->from('product_category');
        $this->db->where('category_id', $category_id);
        $query = $this->db->get();
        $productids = array();
        $data = $query->result_array();

        foreach ($data as $key => $val) {
            $productids[] = $val['product_id'];
        }

        return $productids;
    }

    public function getProductIdsBySubCategory($category_id, $sub_category_id)
    {
        $this->db->select('product_id');

        $this->db->from('product_subcategory');
        $this->db->where(array('category_id' => $category_id, 'sub_category_id' => $sub_category_id));
        $query = $this->db->get();
        $productids = array();
        $data = $query->result_array();

        foreach ($data as $key => $val) {
            $productids[] = $val['product_id'];
        }

        return $productids;
    }

    public function getLatestProducts()
    {
        $this->db->select('*');
        $condition = array();
        $condition['status'] = 1;
        $this->db->where($condition);
        $this->db->from($this->table);
        $this->db->order_by('created', 'desc');
        $this->db->limit(8);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    public function getProductSearchList($searchtext)
    {
        $searchtext = trim($searchtext);
        $this->db->select(array('id', 'name', 'name_french', 'product_image', 'status', ''));
        $condition = array();
        $condition['status'] = '1';
        $this->db->where($condition);
        $this->db->like('name', $searchtext);
        $this->db->or_like('code', $searchtext);
        $this->db->or_like('model', $searchtext);
        $this->db->from($this->table);
        $this->db->order_by('name', 'asc');
        $this->db->limit(50);
        $query = $this->db->get();
        $data = $query->result_array();
        //pr($data,1);

        return $data;
    }
    public function getProductSearchFranchList($searchtext)
    {
        $searchtext = trim($searchtext);
        $this->db->select(array('id', 'name', 'name_french', 'product_image', 'status'));
        $condition = array();
        $condition['status'] = '1';
        $this->db->where($condition);
        $this->db->like('name_french', $searchtext);
        $this->db->or_like('code_french', $searchtext);
        $this->db->or_like('model_french', $searchtext);
        $this->db->from($this->table);
        $this->db->order_by('name', 'asc');
        $this->db->limit(50);
        $query = $this->db->get();
        $data = $query->result_array();
        //pr($data,1);

        return $data;
    }
    public function getProductSearchAdminList($searchtext)
    {
        $searchtext = trim($searchtext);
        $this->db->select(array('id', 'name', 'product_image'));
        /*$condition = array();
        $condition['status'] = 1;
        $this->db->where($condition);*/

        $this->db->like('name', $searchtext);
        $this->db->or_like('code', $searchtext);
        $this->db->or_like('model', $searchtext);

        $this->db->from($this->table);
        $this->db->order_by('name', 'asc');
        $this->db->limit(50);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getTodayDealProducts()
    {
        $today_date = date('Y-m-d');
        $this->db->select('*');
        $condition = array();
        $condition['status'] = 1;
        $condition['is_today_deal'] = 1;
        $condition['is_today_deal_date'] = $today_date;
        $this->db->where($condition);
        $this->db->from($this->table);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getSpecialProducts()
    {
        $this->db->select('*');
        $condition = array();
        $condition['status'] = 1;
        $condition['is_special'] = 1;
        $this->db->where($condition);
        $this->db->from($this->table);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getBestsellerProducts()
    {
        $this->db->select('*');
        $condition = array();
        $condition['status'] = 1;
        $condition['is_bestseller'] = 1;
        $this->db->where($condition);
        $this->db->from($this->table);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getTopVisitedProducts()
    {
        $this->db->select('*');
        $condition = array();
        $condition['status'] = 1;
        $this->db->where($condition);
        $this->db->from($this->table);
        $this->db->order_by('total_visited', 'desc');
        $this->db->limit(30);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    public function getProductDataById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function deleteProduct($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete($this->table);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function saveProduct($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $data['updated'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update($this->table, $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created'] = date('Y-m-d H:i:s');
            $data['updated'] = date('Y-m-d H:i:s');
            $query = $this->db->insert($this->table, $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function getProductDropDownList($menu_id = null)
    {
        $lists = array();
        if (!empty($menu_id)) {
            $this->db->select(array('id', 'name'));
            $this->db->where(array('status' => '1', 'menu_id' => $menu_id));

            $this->db->from($this->table);
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();

            foreach ($data as $val) {
                $lists[$val['id']] = ucfirst($val['name']);
            }
        }
        return $lists;
    }
    public function getBrandDropDownList()
    {
        $lists = array();
        $this->db->select(array('id', 'name'));
        $this->db->where(array('status' => '1'));
        $this->db->from('brands');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        foreach ($data as $val) {
            $lists[$val['id']] = ucfirst($val['name']);
        }
        return $lists;
    }

    //banners function
    public $configBanners = array(
        array(
            'field' => 'name',
            'label' => 'banner',
            'rules' => 'required|max_length[50]',
            'errors' => array(
                'required' => 'Enter banner name',
            ),
        ),
        array(
            'field' => 'product_id',
            'label' => 'Product',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Select Sub Category',
            ),
        ),
        array(
            'field' => 'short_description',
            'label' => 'banner short  description ',
            'rules' => 'max_length[150]',
            'errors' => array(
                //'required' => 'Enter banner short description',
            ),
        ),
        array(
            'field' => 'full_description',
            'label' => 'banner full description',
            'rules' => 'max_length[200]',
            'errors' => array(
                //'required' => 'Enter banner full description',
            ),
        ),

        /*array(
    'field' => 'files',
    'label' => 'banner images',
    'rules' => 'required',
    'errors' => array(
    'required' => 'Select image for banner',
    ),
    )*/
    );

    public function getBannerList($id = null)
    {
        $this->db->select(array('Banner.*', 'Menu.name as menu_name', 'Product.name as product_name'));
        $this->db->from('banners' . ' as Banner');
        $this->db->where(array('Menu.status' => 1));
        if (!empty($id)) {
            $this->db->where(array('Menu.status' => 1, 'Banner.id' => $id));
        }

        $this->db->join('menus as Menu', 'Menu.id=Banner.menu_id', 'left');
        $this->db->join('products as Product', 'Product.id=Banner.product_id', 'left');

        $query = $this->db->get();
        if (!empty($id)) {
            $data = (array) $query->row();
        } else {
            $data = $query->result_array();
        }

        return $data;
    }

    public function getActivegetBannerList()
    {
        $this->db->select('*');
        $this->db->from('banners');
        $this->db->where(array('status' => 1));
        $this->db->order_by('updated', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getBannerDataById($id)
    {
        $this->db->select('*');
        $this->db->from('banners');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function deleteBanner($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('banners');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function saveBanner($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $data['updated'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update('banners', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created'] = date('Y-m-d H:i:s');
            $data['updated'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('banners', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }
    //banners function
    public $configBrands = array(
        array(
            'field' => 'name',
            'label' => 'brand',
            'rules' => 'required|max_length[50]',
            'errors' => array(
                'required' => 'Enter brand name',
            ),
        ),
        array(
            'field' => 'short_description',
            'label' => 'brand short  description ',
            'rules' => 'required|max_length[150]',
            'errors' => array(
                'required' => 'Enter brand short description',
            ),
        ),
        array(
            'field' => 'full_description',
            'label' => 'brand full description',
            'rules' => 'max_length[250]',
            'errors' => array(
                //'required' => 'Enter banner full description',
            ),
        ),
    );

    public function getBrandList($id = null)
    {
        $this->db->select('*');
        $this->db->from('brands');
        $this->db->order_by('updated', 'desc');
        $query = $this->db->get();

        if (!empty($id)) {
            $data = (array) $query->row();
        } else {
            $data = $query->result_array();
        }

        return $data;
    }

    public function getActiveBrandList()
    {
        $this->db->select('*');
        $this->db->from('brands');
        $this->db->where(array('status' => 1));
        $this->db->order_by('updated', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getBrandDataById($id)
    {
        $this->db->select('*');
        $this->db->from('brands');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function deleteBrand($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('brands');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function saveBrand($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $data['updated'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update('brands', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created'] = date('Y-m-d H:i:s');
            $data['updated'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('brands', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }
    //Size function
    public $configSizes = array(
        array(
            'field' => 'size_name',
            'label' => 'size name',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter Size Name',
            ),
        ),
        array(
            'field' => 'set_order',
            'label' => 'set order',
            'rules' => 'integer',
            'errors' => array(
            ),
        ),
    );

    public $configSizeOptions = array(
        array(
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter Name',
            ),
        ),
    );

    public $configQuantity = array(
        array(
            'field' => 'name',
            'label' => 'Quantity',
            'rules' => 'required|is_unique[quantity.name]',
            'errors' => array(
                'required' => 'Enter Quantity',
            ),
        ),
    );
    public $configQuantityEdit = array(
        array(
            'field' => 'name',
            'label' => 'Quantity',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter Quantity',
            ),
        ),
    );
    public function getSizeList($id = null)
    {
        $this->db->select('*');
        $this->db->from('sizes');
        $this->db->order_by('size_name', 'asc');
        $query = $this->db->get();

        if (!empty($id)) {
            $data = (array) $query->row();
        } else {
            $data = $query->result_array();
        }

        return $data;
    }

    public function getQuantityList($id = null)
    {
        $this->db->select('*');
        $this->db->from('quantity');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();

        if (!empty($id)) {
            $data = (array) $query->row();
        } else {
            $data = $query->result_array();
        }

        return $data;
    }

    public function getSizeDataById($id)
    {
        $this->db->select('*');
        $this->db->from('sizes');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function deleteSize($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('sizes');
        $this->db->where('size_id', $id);
        $query = $this->db->delete('product_size_new');
        $this->db->where('size_id', $id);
        $query = $this->db->delete('size_multiple_attributes');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function deleteQuantity($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('quantity');

        $this->db->where('qty', $id);
        $query = $this->db->delete('product_quantity');
        $this->db->where('qty', $id);
        $query = $this->db->delete('product_size_new');
        $this->db->where('qty', $id);
        $query = $this->db->delete('size_multiple_attributes');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function saveSize($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $this->db->where('id', $id);
            $query = $this->db->update('s', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $query = $this->db->insert('sizes', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }
    public function saveQuantity($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $this->db->where('id', $id);
            $query = $this->db->update('quantity', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $query = $this->db->insert('quantity', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }
    public $configAttributes = array(
        array(
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter name',
            ),
        ),
    );

    public function getAttributesList($id = null)
    {
        $this->db->select('*');
        $this->db->from('product_attributes');
        $this->db->order_by('updated', 'desc');
        $query = $this->db->get();

        if (!empty($id)) {
            $data = (array) $query->row();
        } else {
            $data = $query->result_array();
        }

        return $data;
    }

    public function getAttributesListDropDwon()
    {
        $this->db->select('*');
        $this->db->from('product_attributes');
        $this->db->where('status', '1');
        $this->db->order_by('name', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();
        $dataNew = array();
        foreach ($data as $key => $val) {
            $id = $val['id'];
            $this->db->select('*');
            $this->db->from('product_attribute_items');
            $this->db->where('product_attribute_id', $id);
            $this->db->order_by('id', 'asc');
            $query = $this->db->get();
            $attribute_items = $query->result_array();
            $attribute_items_new = array();

            foreach ($attribute_items as $key1 => $val1) {
                $attribute_items_new[$val1['id']] = $val1['item_name'];
            }
            $dataNew[$val['id']] = array('name' => $val['name'], 'items' => $attribute_items_new);
        }
        return $dataNew;
    }

    public function getAttributesDataById($id)
    {
        $this->db->select('*');
        $this->db->from('product_attributes');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function getAttributesItemDataById($id)
    {
        $this->db->select('*');
        $this->db->from('product_attribute_items');
        $this->db->where(array('product_attribute_id' => $id));
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function deleteAttributes($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('product_attributes');
        if ($query) {
            $this->db->where('product_attribute_id', $id);
            $this->db->delete('product_attribute_items');
            $this->db->where('attribute_id', $id);
            $this->db->delete('product_attribute_datas');
            $this->db->where('attribute_id', $id);
            $this->db->delete('product_attribute_item_datas');

            return 1;
        } else {
            return 0;
        }
    }

    public function saveAttributes($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $data['updated'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update('product_attributes', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created'] = date('Y-m-d H:i:s');
            $data['updated'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('product_attributes', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function saveAttributeItem($data, $product_attribute_id)
    {
        if (!empty($product_attribute_id) && !empty($data)) {
            $this->db->where('product_attribute_id', $product_attribute_id);
            $this->db->select('*');
            $this->db->from('product_attribute_items');
            $query = $this->db->get();
            $old_data = $query->result_array();
            $old_data_ids = array();
            $update_data_ids = array();

            foreach ($data as $key => $val) {
                if (!empty($val['item_name'])) {
                    if (!empty($val['id'])) {
                        unset($val['created']);
                        $this->db->where('id', $val['id']);
                        $this->db->update('product_attribute_items', $val);

                        $update_data_ids[] = $val['id'];
                    } else {
                        $this->db->insert('product_attribute_items', $val);
                    }
                }
            }

            foreach ($old_data as $key => $val) {
                $id = $val['id'];
                if (!in_array($id, $update_data_ids)) {
                    $this->db->where('id', $id);
                    $this->db->delete('product_attribute_items');
                }
            }
            /*$query = $this->db->insert_batch('product_attribute_items', $data);
        if ($query) {
        return true;
        } else {
        return false;
        }*/
        }
    }

    public $configMultipleAttributes = array(
        array(
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter name',
            ),
        ),
    );

    public function getMultipleAttributes()
    {
        $this->db->select('*');
        $this->db->from('product_multiple_attributes');
        $this->db->order_by('set_order', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getMultipleAttributesDropDown()
    {
        $this->db->select('*');
        $this->db->from('product_multiple_attributes');
        $this->db->where('status', '1');
        $this->db->order_by('set_order', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        $dataNew = array();
        foreach ($data as $key => $val) {
            $id = $val['id'];
            $this->db->select('*');
            $this->db->from('product_multiple_attribute_items');
            $this->db->where('product_attribute_id', $id);
            $this->db->order_by('id', 'asc');
            $query = $this->db->get();
            $attribute_items = $query->result_array();
            $attribute_items_new = array();

            foreach ($attribute_items as $key1 => $val1) {
                $attribute_items_new[$val1['id']] = $val1['item_name'];
            }
            $dataNew[$val['id']] = array('name' => $val['name'], 'items' => $attribute_items_new);
        }
        return $dataNew;
    }

    public function getMultipleAttribute($id)
    {
        $this->db->select('*');
        $this->db->from('product_multiple_attributes');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function getMultipleAttributeItems($attribute_id)
    {
        $this->db->select('*');
        $this->db->from('product_multiple_attribute_items');
        $this->db->where(array('product_attribute_id' => $attribute_id));
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function deleteMultipleAttributes($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('product_multiple_attributes');
        if ($query) {
            $this->db->where('product_attribute_id', $id);
            $this->db->delete('product_multiple_attribute_items');
            $this->db->where('attribute_id', $id);
            $query = $this->db->delete('size_multiple_attributes');

            return 1;
        } else {
            return 0;
        }
    }

    public function saveMultipleAttributes($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $data['updated'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update('product_multiple_attributes', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created'] = date('Y-m-d H:i:s');
            $data['updated'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('product_multiple_attributes', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function saveMultipleAttributeItem($data, $product_attribute_id)
    {
        if (!empty($product_attribute_id) && !empty($data)) {
            $this->db->where('product_attribute_id', $product_attribute_id);
            $this->db->select('*');
            $this->db->from('product_multiple_attribute_items');
            $query = $this->db->get();
            $old_data = $query->result_array();
            $old_data_ids = array();
            $update_data_ids = array();

            foreach ($data as $key => $val) {
                if (!empty($val['item_name'])) {
                    if (!empty($val['id'])) {
                        unset($val['created']);
                        $this->db->where('id', $val['id']);
                        $this->db->update('product_multiple_attribute_items', $val);

                        $update_data_ids[] = $val['id'];
                    } else {
                        $this->db->insert('product_multiple_attribute_items', $val);
                    }
                }
            }

            foreach ($old_data as $key => $val) {
                $id = $val['id'];
                if (!in_array($id, $update_data_ids)) {
                    $this->db->where('id', $id);
                    $this->db->delete('product_multiple_attribute_items');
                }
            }
            /*$query = $this->db->insert_batch('product_attribute_items', $data);
        if ($query) {
        return true;
        } else {
        return false;
        }*/
        }
    }

    public function getProductAttributesByItemId($id = null)
    {
        $data_new = array();
        if (!empty($id)) {
            $this->db->select('*');
            $this->db->from('product_attribute_datas');
            $this->db->where('product_id', $id);
            $this->db->order_by('show_order', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
            $data_new = array();
            foreach ($data as $key => $val) {
                $attribute_id = $val['attribute_id'];

                $this->db->select('*');
                $this->db->from('product_attribute_item_datas');
                $this->db->where(array('product_id' => $id, 'attribute_id' => $attribute_id));
                $this->db->order_by('show_order', 'asc');
                $query = $this->db->get();
                $items = $query->result_array();
                $attribute_items_new = array();
                foreach ($items as $key1 => $val1) {
                    $attribute_items_new[$val1['attribute_item_id']] = $val1;
                }

                $data_new[$attribute_id]['data'] = $val;
                $data_new[$attribute_id]['items'] = $attribute_items_new;
            }
        }
        return $data_new;
    }

    public function getProductAttributesByItemIdFrontEnd($id = null)
    {
        $data_new = array();
        if (!empty($id)) {
            $this->db->select('product_attribute_datas.* , product_attributes.name as attribute_name,, product_attributes.name_french as attribute_name_french');
            $this->db->from('product_attribute_datas');
            $this->db->join('product_attributes', 'product_attributes.id=product_attribute_datas.attribute_id', 'inner');
            $this->db->where(array('product_attribute_datas.product_id' => $id, 'product_attributes.status' => 1));
            $this->db->order_by('product_attribute_datas.show_order', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
            //pr($data);
            //echo $this->db->last_query();
            $data_new = array();
            foreach ($data as $key => $val) {
                $attribute_id = $val['attribute_id'];

                $this->db->select('product_attribute_item_datas.*,product_attribute_items.item_name,product_attribute_items.item_name_french');
                $this->db->from('product_attribute_item_datas');
                $this->db->join('product_attribute_items', 'product_attribute_items.id=product_attribute_item_datas.attribute_item_id', 'inner');

                $this->db->where(array('product_attribute_item_datas.product_id' => $id, 'product_attribute_item_datas.attribute_id' => $attribute_id));
                $this->db->order_by('product_attribute_item_datas.show_order', 'asc');
                $query = $this->db->get();
                $items = $query->result_array();
                $attribute_items_new = array();

                foreach ($items as $key1 => $val1) {
                    $attribute_items_new[$val1['attribute_item_id']] = $val1;
                }

                $data_new[$attribute_id]['data'] = $val;
                $data_new[$attribute_id]['items'] = $attribute_items_new;
            }
        }
        return $data_new;
    }

    public function saveProductAttributesData($attributes_data, $attributes_item_data, $product_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_attribute_datas');
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_attribute_item_datas');
        $query = false;

        if (count($attributes_data) > 0) {
            $query = $this->db->insert_batch('product_attribute_datas', $attributes_data);
        }
        if ($query) {
            if (count($attributes_item_data) > 0) {
                $query = $this->db->insert_batch('product_attribute_item_datas', $attributes_item_data);
            }
        } else {
            return false;
        }
    }

    public function getTotalSumAvgReting($product_id = null)
    {
        $sql = "SELECT  COUNT(id) as total, SUM(rate) as sum ,AVG(rate) as avg FROM rating WHERE product_id='" . $product_id . "'";
        $query = $this->db->query($sql);
        $data = (array) $query->row();
        return $data;
    }

    public function getToatalReting($product_id = null, $rate = null)
    {
        $sql = "SELECT  COUNT(id) as total FROM rating WHERE product_id='" . $product_id . "'";

        if (!empty($rate)) {
            $sql .= " AND rate='" . $rate . "'";
        }
        $query = $this->db->query($sql);
        $data = (array) $query->row();
        return $data['total'];
    }

    public function getRatings($product_id)
    {
        $this->db->select('*');
        $condition = array('product_id' => $product_id);
        $this->db->where($condition);
        $this->db->from('rating');
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function CheckRatingByUserIdAndProductId($user_id, $product_id)
    {
        $this->db->select('id');
        $this->db->from('rating');
        $condition = array('user_id' => $user_id, 'product_id' => $product_id);
        $this->db->where($condition);

        if ($this->db->get()->num_rows()) {
            return true;
        }
        return false;
    }

    public function saveRating($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $data['updated'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update('rating', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created'] = date('Y-m-d H:i:s');
            $data['updated'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('rating', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }
    public function getsubscribeEmail()
    {
        $this->db->select('*');
        $condition = array();
        $this->db->where($condition);
        $this->db->from('subscribe_emails');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    public function getCountSubscribeEmail()
    {
        $this->db->select('id');
        $condition = array();
        $this->db->from('subscribe_emails');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function getCountProducts()
    {
        $this->db->select('id');
        $condition = array();
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function deleteSubscribeEmail($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('subscribe_emails');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
    public function saveSubscribeEmail($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $data['updated'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update('subscribe_emails', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created'] = date('Y-m-d H:i:s');
            $data['updated'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('subscribe_emails', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function getProductByTagName($tagname = null)
    {
        return $this->db->select(array('Product.*', 'Category.name as category_name'))
            ->from($this->table . ' as Product')
            ->where(['Product.status' => 1, 'Product.' . $tagname => 1])
            ->join('categories as Category', 'Category.id=Product.category_id', 'left')
            ->order_by('Product.name', 'asc')
            ->limit(4)
            ->get()
            ->result_array();
    }

    public function getProductByTagId($id = null, $limit = 4)
    {
        $this->db->select(array('Product.*', 'Category.name as category_name'));
        $this->db->from($this->table . ' as Product');
        $this->db->where('Product.status', 1);
        $this->db->where("find_in_set('" . $id . "',product_tag) <> 0");

        $this->db->join('categories as Category', 'Category.id=Product.category_id', 'left');
        $this->db->order_by('Product.updated', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        $data = $query->result_array();
        #pr($data,1);
        return $data;
    }

    public function getActiveSubCategoryAndProductListBycategoryId($category_id)
    {
        $data = array();
        $this->db->select('id,name');
        $condition = array();
        $condition['status'] = 1;
        $condition['category_id'] = $category_id;
        $this->db->where($condition);
        $this->db->from($this->table);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data['products'] = $query->result_array();

        $this->db->select('id,name');
        $condition = array();
        $condition['status'] = 1;
        $condition['category_id'] = $category_id;
        $this->db->where($condition);
        $this->db->from('sub_categories');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data['sub_categories'] = $query->result_array();
        return $data;
    }
    public function getActiveProductListBySubCategoryId($sub_category_id)
    {
        $data = array();
        $this->db->select('id,name');
        $condition = array();
        $condition['status'] = 1;
        $condition['sub_category_id'] = $sub_category_id;
        $this->db->where($condition);
        $this->db->from($this->table);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        #pr($data);
        return $data;
    }

    public function getProductDescriptionById($id = null)
    {
        $this->db->select(array('*'));
        $this->db->from('product_descriptions');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        #echo $this->db->last_query(); die();
        return $query->result_array();
    }

    public function getProductTemplatesById($id = null)
    {
        $this->db->select(array('*'));
        $this->db->from('product_templates');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        #echo $this->db->last_query(); die();
        return $query->result_array();
    }

    public function saveProductDescription($data, $product_id)
    {
        if (empty($data)) {
            return true;
        }
        $query = $this->db->insert_batch('product_descriptions', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function saveProductTemplate($data, $product_id)
    {
        if (empty($data)) {
            return true;
        }
        $query = $this->db->insert_batch('product_templates', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getSizeById($id)
    {
        $this->db->select('*');
        $this->db->from('sizes');
        $this->db->where('id', $id);
        $this->db->order_by('set_order', 'asc');
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function getQtyById($id)
    {
        $this->db->select('*');
        $this->db->from('quantity');
        $this->db->where('id', $id);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function getSizeListDropDwon()
    {
        $this->db->select('*');
        $this->db->from('sizes');
        $this->db->where('status', '1');
        $this->db->order_by('set_order', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        $dataNew = array();
        $dataNew1 = array();
        foreach ($data as $key => $val) {
            $id = $val['id'];
            $dataNew[$id] = $val['size_name'];
        }
        return $dataNew;
    }

    public function getQuantityListDropDwon()
    {
        $this->db->select('*');
        $this->db->from('quantity');
        $this->db->where('status', '1');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        $dataNew = array();
        foreach ($data as $key => $val) {
            $id = $val['id'];
            $dataNew[$id] = $val['name'];
        }

        return $dataNew;
    }

    public function ProductSizeListDropDown($product_id)
    {
        $this->db->select('*');
        $this->db->from('product_size');
        $this->db->where('product_id', $product_id);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        $dataNew = array();
        foreach ($data as $key => $val) {
            $size_id = $val['size_id'];
            $qty = $val['qty'];
            $sizeData = $this->getSizeById($size_id);
            $qtyData = $this->getQtyById($qty);
            $val['size_name'] = $sizeData['size_name'];
            $val['size_name_french'] = $sizeData['size_name_french'];
            $val['qty_name'] = $qtyData['name'];
            $val['qty_name_french'] = $qtyData['name_french'];
            if (!empty($val['size_name']) && !empty($val['qty_name'])) {
                $dataNew[$qty][$size_id][] = $val;
            }
        }
        return $dataNew;
    }
    public function ProductQuantityDropDwon($product_id)
    {
        $this->db->select(array('product_quantity.price', 'product_quantity.qty', 'quantity.name as qty_name', 'quantity.name_french as qty_name_french'));
        $this->db->from('product_quantity');
        $this->db->join('quantity', 'product_quantity.qty=quantity.id', 'inner');
        $this->db->where('product_quantity.product_id', $product_id);
        $this->db->where('quantity.status', 1);
        $this->db->group_by('product_quantity.qty');
        $this->db->order_by('quantity.name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        $qdataNew = array();
        foreach ($data as $key => $val) {
            $qty = $val['qty'];
            $qdataNew[$qty] = $val;
        }
        return $qdataNew;
    }

    public function ProductQuantitySizeDropDwon($product_id)
    {
        $this->db->select(array('product_quantity.price', 'product_quantity.qty', 'quantity.name as qty_name', 'quantity.name_french as qty_name_french'));
        $this->db->from('product_quantity');
        $this->db->join('quantity', 'product_quantity.qty=quantity.id', 'inner');
        $this->db->where('product_quantity.product_id', $product_id);
        $this->db->where('quantity.status', 1);
        $this->db->group_by('product_quantity.qty');
        $this->db->order_by('quantity.set_order', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        $qdataNew = array();

        foreach ($data as $key => $val) {
            $qty = $val['qty'];
            $val['name'] = $val['qty_name'];
            $val['name_french'] = $val['qty_name_french'];
            $this->db->select(array('product_size_new.size_id', 'product_size_new.extra_price', 'sizes.size_name', 'sizes.size_name_french'));
            $this->db->from('product_size_new');
            $this->db->join('sizes', 'product_size_new.size_id=sizes.id', 'inner');
            $this->db->where(array('product_size_new.product_id' => $product_id, 'product_size_new.qty' => $qty, 'sizes.status' => 1));
            $this->db->group_by('product_size_new.size_id');
            $this->db->order_by('sizes.set_order', 'asc');
            $this->db->order_by('sizes.size_name', 'desc');
            $query = $this->db->get();
            $datasize = $query->result_array();
            $dataNew = array();
            foreach ($datasize as $skey => $sval) {
                $size_id = $sval['size_id'];
                if (!empty($size_id)) {
                    $sval['size_name'] = $sval['size_name'];
                    $sval['size_name_french'] = $sval['size_name_french'];
                    $dataNew[$size_id] = $sval;
                }
            }
            $val['sizeData'] = $dataNew;
            $qdataNew[$qty] = $val;
        }
        return $qdataNew;
    }

    /*public function ProductQuantitySizeAttributeDropDown($product_id) {
    $this->db->select(array('product_quantity.price', 'product_quantity.qty', 'quantity.name', 'quantity.name_french'));
    $this->db->from('product_quantity');
    $this->db->join('quantity', 'product_quantity.qty=quantity.id', 'inner');
    $this->db->where('product_quantity.product_id', $product_id);
    $this->db->where('quantity.status',1);
    $this->db->group_by('product_quantity.qty');
    $this->db->order_by('quantity.set_order', 'asc');
    $query = $this->db->get();
    $data = $query->result_array();
    $qdataNew = array();

    foreach($data as $key => $val) {
    $qty = $val['qty'];
    $val['qty_name'] = $val['name'];
    $val['qty_name_french'] = $val['name_french'];
    $this->db->select(array('product_size_new.size_id', 'product_size_new.extra_price', 'sizes.size_name', 'sizes.size_name_french'));
    $this->db->from('product_size_new');
    $this->db->join('sizes', 'product_size_new.size_id=sizes.id', 'inner');
    $this->db->where(array('product_size_new.product_id' => $product_id, 'product_size_new.qty' => $qty, 'sizes.status' => 1));
    $this->db->group_by('product_size_new.size_id');
    $this->db->order_by('sizes.set_order', 'asc');
    $this->db->order_by('sizes.size_name', 'desc');
    $query = $this->db->get();
    $datasize = $query->result_array();
    $dataNew = array();
    foreach($datasize as $skey => $sval) {
    $size_id = $sval['size_id'];
    if (!empty($size_id)) {
    $sval['size_name'] = $sval['size_name'];
    $sval['size_name_french'] = $sval['size_name_french'];
    $this->db->select('*');
    $this->db->from('product_size');
    $this->db->where(array('product_id' => $product_id, 'qty' => $qty, 'size_id' => $size_id));
    $this->db->order_by('id', 'asc');
    $query = $this->db->get();
    $attribute = $query->result_array();
    $sval['attribute'] = $attribute;
    $dataNew[$size_id] = $sval;
    }
    }
    $val['sizeData'] = $dataNew;
    $qdataNew[$qty] = $val;
    }
    return $qdataNew;
    }*/

    public function ProductQuantitySizeAttributeDropDown($product_id)
    {
        $this->db->select(array('product_quantity.price', 'product_quantity.qty', 'quantity.name', 'quantity.name_french'));
        $this->db->from('product_quantity');
        $this->db->join('quantity', 'product_quantity.qty=quantity.id', 'inner');
        $this->db->where('product_quantity.product_id', $product_id);
        $this->db->where('quantity.status', 1);
        $this->db->group_by('product_quantity.qty');
        $this->db->order_by('quantity.name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        $qdataNew = array();
        #pr($data);
        foreach ($data as $key => $val) {
            $qty = $val['qty'];
            $val['qty_name'] = $val['name'];
            $val['qty_name_french'] = $val['name_french'];
            $this->db->select(array('product_size_new.size_id', 'product_size_new.extra_price', 'sizes.size_name', 'sizes.size_name_french'));
            $this->db->from('product_size_new');
            $this->db->join('sizes', 'product_size_new.size_id=sizes.id', 'inner');
            $this->db->where(array('product_size_new.product_id' => $product_id, 'product_size_new.qty' => $qty, 'sizes.status' => 1));
            $this->db->group_by('product_size_new.size_id');
            $this->db->order_by('sizes.set_order', 'asc');
            $this->db->order_by('sizes.size_name', 'desc');
            $query = $this->db->get();
            $datasize = $query->result_array();
            $dataNew = array();
            //pr($datasize);
            foreach ($datasize as $skey => $sval) {
                $size_id = $sval['size_id'];
                if (!empty($size_id)) {
                    $sval['size_name'] = $sval['size_name'];
                    $sval['size_name_french'] = $sval['size_name_french'];

                    $this->db->select(array('size_multiple_attributes.*', 'product_multiple_attributes.name as attributes_name', 'product_multiple_attributes.name_french as attributes_name_french', 'product_multiple_attribute_items.item_name as attributes_item_name', 'product_multiple_attribute_items.item_name_french as attributes_item_name_french'));

                    $this->db->from('size_multiple_attributes');
                    $this->db->join('product_multiple_attributes', 'size_multiple_attributes.attribute_id=product_multiple_attributes.id', 'inner');

                    $this->db->join('product_multiple_attribute_items', 'size_multiple_attributes.attribute_item_id=product_multiple_attribute_items.id', 'inner');

                    $this->db->where(array('size_multiple_attributes.product_id' => $product_id, 'size_multiple_attributes.qty' => $qty, 'size_multiple_attributes.size_id' => $size_id, 'product_multiple_attributes.status' => 1));

                    $this->db->order_by('product_multiple_attributes.set_order', 'asc');
                    $query = $this->db->get();
                    $attribute = $query->result_array();
                    //pr($attribute);
                    //$sval['attribute'] = $attribute;
                    $attributeNew = array();
                    $attributeNewData = array();
                    foreach ($attribute as $akey => $aval) {
                        $attribute_id = $aval['attribute_id'];
                        $attribute_item_id = $aval['attribute_item_id'];
                        $attribute_items = array();

                        if (!empty($attribute_id) && !empty($attribute_item_id)) {
                            $attributeNew[$attribute_id][$attribute_item_id] = $aval;
                        }
                    }

                    foreach ($attributeNew as $atkey => $atval) {
                        $keysarray = array_keys($atval);
                        $attributeNewData[$atkey]['attribute_name'] = $atval[$keysarray[0]]['attributes_name'];
                        $attributeNewData[$atkey]['attributes_name_french'] = $atval[$keysarray[0]]['attributes_name_french'];
                        $attributeNewData[$atkey]['attribute_items'] = $atval;
                    }
                    //pr($attributeNew);
                    $sval['attribute'] = $attributeNewData;
                    $dataNew[$size_id] = $sval;
                }
            }
            $val['sizeData'] = $dataNew;
            $qdataNew[$qty] = $val;
        }
        return $qdataNew;
    }

    public function ProductOnlyQuantityDropDwon($product_id)
    {
        $this->db->select(array('price', 'qty'));
        $this->db->from('product_quantity');
        $this->db->where('product_id', $product_id);
        $this->db->group_by('qty');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        $qdataNew = array();
        foreach ($data as $key => $val) {
            $qty = $val['qty'];
            $qdataNew[$qty] = $val;
        }
        return $qdataNew;
    }
    public function ProductOnlySizeDropDwon($product_id, $qty)
    {
        $this->db->select(array('size_id', 'extra_price'));
        $this->db->from('product_size_new');
        $this->db->where(array('product_id' => $product_id, 'qty' => $qty));
        $this->db->group_by('size_id');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        $datasize = $query->result_array();
        $dataNew = array();
        foreach ($datasize as $skey => $sval) {
            $size_id = $sval['size_id'];
            if (!empty($size_id)) {
                $dataNew[$size_id] = $sval;
            }
        }
        return $dataNew;
    }

    public function ProductOnlySizeMultipleAttributesDropDwon($product_id, $qty, $size_id, $attribute_id)
    {
        $this->db->select(array('attribute_item_id'));
        $this->db->from('size_multiple_attributes');
        $this->db->where(array('product_id' => $product_id, 'qty' => $qty, 'size_id' => $size_id, 'attribute_id' => $attribute_id));

        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        $datasize = $query->result_array();
        $dataNew = array();
        foreach ($datasize as $skey => $sval) {
            $attribute_item_id = $sval['attribute_item_id'];
            if (!empty($attribute_item_id)) {
                $dataNew[$attribute_item_id] = $sval;
            }
        }

        return $dataNew;
    }
    public function ProductSizeMultipleAttributeBYId($id)
    {
        $this->db->select('*');
        $this->db->from('size_multiple_attributes');
        $this->db->where(array('id' => $id));
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function saveProductSize($data, $product_id)
    {
        if (empty($data)) {
            return true;
        }
        $query = $this->db->insert_batch('product_size', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function saveProductQty($data, $product_id)
    {
        $id = isset($data['id']) ? $data['id'] : '';
        if (!empty($id)) {
            unset($data['id']);
            $data['updated_at'] = date('Y-m-d H:i:s');

            $this->db->where('qty', $id);
            $this->db->where('product_id', $product_id);
            $query = $this->db->update('product_quantity', $data);

            unset($data['price']);
            $this->db->where('qty', $id);
            $this->db->where('product_id', $product_id);
            $query = $this->db->update('product_size_new', $data);

            $this->db->where('qty', $id);
            $this->db->where('product_id', $product_id);
            $query = $this->db->update('size_multiple_attributes', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('product_quantity', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }
    public function saveProductSizeData($data, $product_id)
    {
        $id = isset($data['id']) ? $data['id'] : '';
        $qty = isset($data['qty']) ? $data['qty'] : '';
        //pr($data,1);
        if (!empty($id)) {
            unset($data['id']);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('size_id', $id);
            $this->db->where('qty', $qty);
            $this->db->where('product_id', $product_id);
            $query = $this->db->update('product_size_new', $data);

            unset($data['extra_price']);
            $this->db->where('size_id', $id);
            $this->db->where('qty', $qty);
            $this->db->where('product_id', $product_id);
            $query = $this->db->update('size_multiple_attributes', $data);

            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('product_size_new', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function saveSizeMultipleAttributesData($data, $product_id)
    {
        $id = isset($data['id']) ? $data['id'] : '';
        if (!empty($id)) {
            unset($data['id']);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update('size_multiple_attributes', $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('size_multiple_attributes', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }
    public function deleteProductQty($product_id, $qty)
    {
        $this->db->where('qty', $qty);
        $this->db->where('product_id', $product_id);
        $query = $this->db->delete('product_quantity');

        $this->db->where('qty', $qty);
        $this->db->where('product_id', $product_id);
        $query = $this->db->delete('product_size');

        $this->db->where('qty', $qty);
        $this->db->where('product_id', $product_id);
        $query = $this->db->delete('size_multiple_attributes');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function deleteProductSize($product_id, $qty, $size_id)
    {
        $this->db->where('size_id', $size_id);
        $this->db->where('qty', $qty);
        $this->db->where('product_id', $product_id);
        $query = $this->db->delete('product_size_new');

        $this->db->where('size_id', $size_id);
        $this->db->where('qty', $qty);
        $this->db->where('product_id', $product_id);
        $query = $this->db->delete('size_multiple_attributes');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
    public function deleteProductMultipalAttribute($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('size_multiple_attributes');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
    public function sizeOptions($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($table == 'page_size') {
            $this->db->order_by('total_page', 'asc');
        }
        $query = $this->db->get();

        $data = $query->result_array();
        return $data;
    }

    public function getProductPages()
    {
        $this->db->select('*');
        $this->db->from('page_size');
        $this->db->where('status', 1);
        $this->db->order_by('total_page', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        //pr($data,1);
        return $data;
    }

    public function getProductSheets()
    {
        $this->db->select('*');
        $this->db->from('sheets');
        $this->db->where('status', 1);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        //pr($data,1);
        return $data;
    }

    public function getPageQuantity()
    {
        $this->db->select('*');
        $this->db->from('page_quantity');
        $this->db->where('status', 1);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        //pr($data,1);
        return $data;
    }
    public function getNCRNumberPartsList()
    {
        $this->db->select('*');
        $this->db->from('ncr_parts');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $data = $query->result_array();

        return $data;
    }

    public function getPaperList()
    {
        $this->db->select('*');
        $this->db->from('paper');

        $query = $this->db->get();
        $data = $query->result_array();

        return $data;
    }

    public function getPaperQualityList()
    {
        $this->db->select('*');
        $this->db->from('paper_quality');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getColorList()
    {
        $this->db->select('*');
        $this->db->from('colors');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $data = $query->result_array();

        return $data;
    }

    public function getStockList()
    {
        $this->db->select('*');
        $this->db->from('stocks');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getDiameterList()
    {
        $this->db->select('*');
        $this->db->from('diameter');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getShapePaperList()
    {
        $this->db->select('*');
        $this->db->from('shapepaper');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getBundlingList()
    {
        $this->db->select('*');
        $this->db->from('bundling');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    public function getCoatingList()
    {
        $this->db->select('*');
        $this->db->from('coating');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getGrommetsList()
    {
        $this->db->select('*');
        $this->db->from('grommets');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getPageSizeList()
    {
        $this->db->select('*');
        $this->db->from('page_size');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getDataById($table, $id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function deleteFromTable($table, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete($table);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function save($table, $data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $this->db->where('id', $id);
            $query = $this->db->update($table, $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $query = $this->db->insert($table, $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function getProductMultipalCategoriesAndSubCategories($id)
    {
        $categoryQueryData = array();

        $categoryQuery = $this->db->select('*')->from('product_category')->where(['product_id' => $id]);
        $ProductCategories = $categoryQuery->get()->result_array();
        foreach ($ProductCategories as $key => $category) {
            $category_id = $category['category_id'];

            $subCategoryQuery = $this->db->select('*')->from('product_subcategory')->where(['category_id' => $category_id, 'product_id' => $id]);
            $subCategoryQuery = $subCategoryQuery->get()->result_array();
            //pr($subCategoryQuery);

            $subCategoryQueryData = array();
            foreach ($subCategoryQuery as $val) {
                $subCategoryQueryData[] = $val['sub_category_id'];
            }
            $categoryQueryData[$category_id] = $subCategoryQueryData;
        }
        #pr($categoryQueryData);
        return $categoryQueryData;
    }

    public function saveProductSubCategory($data)
    {
        if (empty($data)) {
            return true;
        }
        $query = $this->db->insert_batch('product_subcategory', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function saveProductSingleSubCategory($data)
    {
        if (empty($data)) {
            return true;
        }
        $query = $this->db->insert('product_subcategory', $data);
        if ($query) {
            return $insert_id = $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function saveProductCategory($data)
    {
        if (empty($data)) {
            return true;
        }
        $query = $this->db->insert('product_category', $data);

        if ($query) {
            return $insert_id = $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function quantities()
    {
        $this->db->select(array('id', 'name', 'name_french'));
        $this->db->from('quantity');
        $this->db->where('status', 1);
        $this->db->order_by('name', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function sizes()
    {
        $this->db->select(array('id', 'size_name', 'size_name_french'));
        $this->db->from('sizes');
        $this->db->where('status', 1);
        $this->db->order_by('size_name', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function attributes()
    {
        $this->db->select(array('id', 'name', 'name_french'));
        $this->db->from('product_multiple_attributes');
        $this->db->where('status', 1);
        $this->db->order_by('name', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function attributeItems($attribute_id)
    {
        $this->db->select(array('id', 'item_name', 'item_name_french'));
        $this->db->from('product_multiple_attribute_items');
        $this->db->where('product_attribute_id', $attribute_id);
        $this->db->order_by('item_name', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    // public function attributeItems() {
    //     $this->db->select(array('id', 'item_name', 'item_name_french', 'product_attribute_id'));
    //     $this->db->from('product_multiple_attribute_items');
    //     $this->db->order_by('item_name', 'asc');
    //     $items = $this->db->get()->result_array();
    //     $result = [];
    //     foreach ($items as $item) {
    //         $attribute_id = $item['product_attribute_id'];
    //         if (!array_key_exists($attribute_id, $result))
    //             $result[$attribute_id] = [];
    //         $result[$attribute_id][] = $item;
    //     }
    //     return $result;
    // }

    public function productQuantities($product_id)
    {
        $this->db->select(array('quantity.id', 'quantity.name', 'quantity.name_french', 'product_quantity.price'));
        $this->db->from('product_quantity');
        $this->db->join('quantity', 'quantity.id=product_quantity.qty', 'inner');
        $this->db->where('product_quantity.product_id', $product_id);
        $this->db->where('quantity.status', 1);
        $this->db->order_by('quantity.name', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function productAutoSizes($product_id)
    {
        $this->db->select(array('sizes.id', 'sizes.size_name', 'sizes.size_name_french', 'product_a_sizes.extra_price'));
        $this->db->from('product_a_sizes');
        $this->db->join('sizes', 'sizes.id=product_a_sizes.size_id', 'inner');
        $this->db->where('product_a_sizes.product_id', $product_id);
        $this->db->where('sizes.status', 1);
        $this->db->order_by('sizes.size_name', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function autoSizeAdd($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';
        $product_id = $data['product_id'];

        if (!empty($id)) {
            unset($data['id']);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('product_id', $product_id);
            $this->db->where('size_id', $id);
            $query = $this->db->update('product_a_sizes', $data);

            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('product_a_sizes', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function autoSizeDelete($product_id, $size_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->where('size_id', $size_id);
        $query = $this->db->delete('product_a_sizes');
        if ($query) {
            return true;
        } else {
            return false;
        }

    }

    public function productAutoAttributes($product_id)
    {
        $this->db->select(array('product_multiple_attributes.id', 'product_multiple_attributes.name', 'product_multiple_attributes.name_french'));
        $this->db->from('product_a_attributes');
        $this->db->join('product_multiple_attributes', 'product_multiple_attributes.id=product_a_attributes.attribute_id', 'inner');
        $this->db->where('product_a_attributes.product_id', $product_id);
        $this->db->where('product_multiple_attributes.status', 1);
        $this->db->order_by('product_a_attributes.id', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function productAutoAttributeDetails($product_id)
    {
        $this->db->select(array('product_a_attribute_items.attribute_id', 'product_multiple_attribute_items.id', 'product_multiple_attribute_items.item_name', 'product_multiple_attribute_items.item_name_french', 'product_a_attribute_items.extra_price'));
        $this->db->from('product_a_attribute_items');
        $this->db->join('product_multiple_attribute_items', 'product_multiple_attribute_items.id=product_a_attribute_items.attribute_item_id', 'inner');
        $this->db->where('product_a_attribute_items.product_id', $product_id);
        $this->db->order_by('product_multiple_attribute_items.item_name', 'asc');
        $items = $this->db->get()->result_array();
        $result = [];
        foreach ($items as $item) {
            $attribute_id = $item['attribute_id'];
            if (!array_key_exists($attribute_id, $result)) {
                $result[$attribute_id] = [];
            }

            $result[$attribute_id][] = $item;
        }
        return $result;
    }

    public function autoAttributeAdd($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';
        $product_id = $data['product_id'];

        if (!empty($id)) {
            unset($data['id']);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('product_id', $product_id);
            $this->db->where('attribute_id', $id);
            $query = $this->db->update('product_a_attributes', $data);

            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('product_a_attributes', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function autoAttributeDelete($product_id, $attribute_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->where('attribute_id', $attribute_id);
        $query = $this->db->delete('product_a_attribute_items');

        $this->db->where('product_id', $product_id);
        $this->db->where('attribute_id', $attribute_id);
        $query = $this->db->delete('product_a_attributes');

        if ($query) {
            return true;
        } else {
            return false;
        }

    }

    public function productAutoAttributeItems($product_id, $attribute_id)
    {
        $this->db->select(array('product_multiple_attribute_items.id', 'product_multiple_attribute_items.item_name', 'product_multiple_attribute_items.item_name_french', 'product_a_attribute_items.extra_price'));
        $this->db->from('product_a_attribute_items');
        $this->db->join('product_multiple_attribute_items', 'product_multiple_attribute_items.id=product_a_attribute_items.attribute_item_id', 'inner');
        $this->db->where('product_a_attribute_items.product_id', $product_id);
        $this->db->where('product_a_attribute_items.attribute_id', $attribute_id);
        $this->db->order_by('product_a_attribute_items.id', 'asc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function autoAttributeItemAdd($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';
        $product_id = $data['product_id'];
        $attribute_id = $data['attribute_id'];

        if (!empty($id)) {
            unset($data['id']);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('product_id', $product_id);
            $this->db->where('attribute_id', $attribute_id);
            $this->db->where('attribute_item_id', $id);
            $query = $this->db->update('product_a_attribute_items', $data);

            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $query = $this->db->insert('product_a_attribute_items', $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function autoAttributeItemDelete($product_id, $attribute_id, $attribute_item_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->where('attribute_id', $attribute_id);
        $this->db->where('attribute_item_id', $attribute_item_id);
        $query = $this->db->delete('product_a_attribute_items');
        if ($query) {
            return true;
        } else {
            return false;
        }

    }

    public function autoGenerateAttributes($product_id)
    {
        $result = $this->db->query("INSERT INTO `product_size_new` (`product_id`, `qty`, `size_id`, `extra_price`, `created_at`, `updated_at`)
            SELECT q.`product_id`, q.`qty`, s.`size_id`, s.`extra_price`, NOW() AS created_at, NOW() AS updated_at
            FROM `product_quantity` AS q
                INNER JOIN `product_a_sizes` AS s ON q.`product_id`=$product_id AND s.`product_id`=$product_id
                LEFT JOIN `product_size_new` AS d ON d.`product_id`=$product_id AND d.`qty`=q.`qty` AND d.`size_id`=s.`size_id`
            WHERE d.`id` IS NULL
            ORDER BY q.`qty`, s.`size_id`, s.`extra_price`");
        if (!$result) {
            return false;
        }

        $result = $this->db->query("INSERT INTO `size_multiple_attributes` (`product_id`, `qty`, `size_id`, `attribute_id`, `attribute_item_id`, `extra_price`, `created_at`, `updated_at`)
            SELECT q.`product_id`, q.`qty`, s.`size_id`, i.`attribute_id`, i.`attribute_item_id`, i.`extra_price`, NOW() AS created_at, NOW() AS updated_at
            FROM `product_quantity` AS q
                INNER JOIN `product_a_sizes` AS s ON q.`product_id`=$product_id AND s.`product_id`=$product_id
                INNER JOIN `product_a_attributes` AS a ON a.`product_id`=$product_id
                INNER JOIN `product_a_attribute_items` AS i ON i.`product_id`=$product_id AND i.`attribute_id`=a.`attribute_id`
                LEFT JOIN `size_multiple_attributes` AS d ON d.`product_id`=$product_id AND d.`qty`=q.`qty` AND d.`size_id`=s.`size_id` AND d.`attribute_id`=i.`attribute_id` AND d.`attribute_item_id`=i.`attribute_item_id`
            WHERE d.`id` IS NULL
            ORDER BY q.`qty`, s.`size_id`, i.`attribute_id`, i.`attribute_item_id`, s.`extra_price`");
        if (!$result) {
            return false;
        }

        return true;
    }

    public function autoAttributesReportGenerate($product_id)
    {
        $query = $this->db->query("SELECT `quantity`.`name` AS quantity, `sizes`.`size_name` AS size, `product_multiple_attributes`.`name` AS attribute, `product_multiple_attribute_items`.`item_name` AS item, if (d.`id` IS NULL, i.`extra_price`, d.`extra_price`) AS `extra_price`
                FROM `product_quantity` AS q
                INNER JOIN `product_a_sizes` AS s ON q.`product_id`=$product_id AND s.`product_id`=$product_id
                INNER JOIN `product_a_attributes` AS a ON a.`product_id`=$product_id
                INNER JOIN `product_a_attribute_items` AS i ON i.`product_id`=$product_id AND i.`attribute_id`=a.`attribute_id`
                INNER JOIN `quantity` ON `quantity`.`id`=q.`qty`
                INNER JOIN `sizes` ON `sizes`.`id`=s.`size_id`
                INNER JOIN `product_multiple_attributes` ON `product_multiple_attributes`.`id`=a.`attribute_id`
                INNER JOIN `product_multiple_attribute_items` ON `product_multiple_attribute_items`.`id`=i.`attribute_item_id`
                LEFT JOIN `size_multiple_attributes` AS d ON d.`product_id`=$product_id AND d.`qty`=q.`qty` AND d.`size_id`=s.`size_id` AND d.`attribute_id`=i.`attribute_id` AND d.`attribute_item_id`=i.`attribute_item_id`
            UNION ALL
            SELECT `quantity`.`name` AS quantity, NULL AS sizes, NULL AS attribute, NULL AS item, q.`price` AS extra_price
                FROM `product_quantity` AS q
                INNER JOIN `quantity` ON `quantity`.`id`=q.`qty`
                WHERE q.`product_id`=$product_id
            UNION ALL
            SELECT `quantity`.`name` AS quantity, `sizes`.`size_name` AS size, NULL AS attribute, NULL AS item, s.`extra_price`
                FROM `product_quantity` AS q
                INNER JOIN `product_a_sizes` AS s ON q.`product_id`=$product_id AND s.`product_id`=$product_id
                INNER JOIN `quantity` ON `quantity`.`id`=q.`qty`
                INNER JOIN `sizes` ON `sizes`.`id`=s.`size_id`
            ORDER BY `quantity`, `size`, `attribute`, `item`, `extra_price`");
        return $query->result_array();
    }

    public function autoAttributesReportGenerateCurrent($product_id)
    {
        $query = $this->db->query("SELECT `quantity`.`name` AS quantity, `sizes`.`size_name` AS size, `product_multiple_attributes`.`name` AS attribute, `product_multiple_attribute_items`.`item_name` AS item, d.`extra_price`
            FROM `size_multiple_attributes` AS d
            INNER JOIN `quantity` ON `quantity`.`id`=d.`qty`
            INNER JOIN `sizes` ON `sizes`.`id`=d.`size_id`
            INNER JOIN `product_multiple_attributes` ON `product_multiple_attributes`.`id`=d.`attribute_id`
            INNER JOIN `product_multiple_attribute_items` ON `product_multiple_attribute_items`.`id`=d.`attribute_item_id`
            WHERE d.`product_id`=$product_id
            ORDER BY `quantity`.`name`, `sizes`.`size_name`, `product_multiple_attributes`.`name`, `product_multiple_attribute_items`.`item_name`, d.`extra_price`");
        return $query->result_array();
    }

    public function autoAttributeDeleteAll($product_id)
    {
        $this->db->where('product_id', $product_id);
        $query = $this->db->delete('size_multiple_attributes');

        $this->db->where('product_id', $product_id);
        $query = $this->db->delete('product_size_new');

        $this->db->where('product_id', $product_id);
        $query = $this->db->delete('product_quantity');

        if ($query) {
            return true;
        } else {
            return false;
        }

    }

    public function quantityId($quantity)
    {
        $this->db->select('id');
        $this->db->from('quantity');
        $this->db->where('name', $quantity);
        $result = $this->db->get()->result_array();
        if (count($result) == 0) {
            return 0;
        }

        return $result[0]['id'];
    }

    public function sizeId($size)
    {
        $this->db->select('id');
        $this->db->from('sizes');
        $this->db->where('size_name', $size);
        $result = $this->db->get()->result_array();
        if (count($result) == 0) {
            return 0;
        }

        return $result[0]['id'];
    }

    public function attributeId($attribute)
    {
        $this->db->select('id');
        $this->db->from('product_multiple_attributes');
        $this->db->where('name', $attribute);
        $result = $this->db->get()->result_array();
        if (count($result) == 0) {
            return 0;
        }

        return $result[0]['id'];
    }

    public function attributeItemId($attribute_id, $attribute_item)
    {
        $this->db->select('id');
        $this->db->from('product_multiple_attribute_items');
        $this->db->where('product_attribute_id', $attribute_id);
        $this->db->where('item_name', $attribute_item);
        $result = $this->db->get()->result_array();
        if (count($result) == 0) {
            return 0;
        }

        return $result[0]['id'];
    }

    public function autoBatchAttribute($product_id, $attributes)
    {
        if (!$this->autoAttributeDeleteAll($product_id)) {
            return -1;
        }

        $checked = 0;
        $processed = 0;
        $recs = [];
        for ($i = 2; array_key_exists($i, $attributes); $i++) {
            $checked++;

            $row = $attributes[$i];
            $quantity = trim($row['A']);
            $size = trim($row['B']);
            $attribute = trim($row['C']);
            $attribute_item = trim($row['D']);
            $extra_price = trim($row['E']);

            $rec = [];
            $rec['product_id'] = $product_id;
            $rec['created_at'] = date('Y-m-d H:i:s');
            $rec['updated_at'] = date('Y-m-d H:i:s');

            $quantity_id = $this->quantityId($quantity);
            if ($quantity_id == 0) {
                continue;
            }

            if ($attribute_item == null || $attribute_item == '') {
                if ($size == null || $size == '') {
                    // Add to product_quantity
                    $rec['qty'] = $quantity_id;
                    $rec['price'] = $extra_price;
                    $this->db->insert('product_quantity', $rec);
                } else {
                    // Add to product_size_new
                    $size_id = $this->sizeId($size);
                    if ($size_id == 0) {
                        continue;
                    }

                    $rec['qty'] = $quantity_id;
                    $rec['size_id'] = $size_id;
                    $rec['extra_price'] = $extra_price;
                    $this->db->insert('product_size_new', $rec);
                }
            } else {
                // Add to size_multiple_attributes
                $attribute_id = $this->attributeId($attribute);
                $attribute_item_id = $this->attributeItemId($attribute_id, $attribute_item);
                if ($attribute_id == 0 || $attribute_item_id == 0) {
                    continue;
                }

                $rec['qty'] = $quantity_id;
                $rec['size_id'] = $size_id;
                $rec['extra_price'] = $extra_price;
                $rec['attribute_id'] = $attribute_id;
                $rec['attribute_item_id'] = $attribute_item_id;
                $recs[] = $rec;
                if (count($recs) > 100) {
                    $this->db->insert_batch('size_multiple_attributes', $recs);
                    $recs = [];
                }
                // $this->db->insert('size_multiple_attributes', $rec);
            }
            //print("$row, $quantity, $size, $attribute, $item, $extra_price");
            $processed++;
        }
        if (count($recs) > 0) {
            $this->db->insert_batch('size_multiple_attributes', $recs);
            $recs = [];
        }
        return $checked - $processed;
    }

    public function convert_printnew_option($option)
    {
        $cdata = [
            '50 lb. Uncoated Text' => '50 lb. Uncoated Text',
            '60 lb. Uncoated Text' => '60 lb. Uncoated Text',
            '70 lb. Uncoated Text' => '70 lb. Uncoated Text',
            '3.5 x 8.5 Portrait' => '3.5" x 8.5"',
            '4.25 x 5.5 Portrait' => '4.25" x 5.5"',
            '5.5 x 4.25 Landscape' => '4.25" x 5.5"',
            '5.5 x 8.5 Portrait' => '5.5" x 8.5"',
            '8.5 x 5.5 Landscape' => '5.5" x 8.5"',
            '8.5 x 11 Portrait' => '8.5" x 11"',
            '11 x 8.5 Landscape' => '8.5" x 11"',
            '4 x 4 Square' => '4" x 4"',
            'Colour Both Sides' => 'Full Color (CMYK)',
            'Colour Front Side Only' => 'Full Color (CMYK)',
            'Colour Both Sides' => 'Full Color (CMYK)',
            'Colour Front Side Only' => 'Full Color (CMYK)',
            '25 Sheets Per Pad Printed One Side' => '25 sheets per pads',
            '50 Sheets Per Pad Printed One Side' => '50 sheets per pads',
            '25 Sheets Per Pad Printed Two Sides' => '25 sheets per pads',
            '50 Sheets Per Pad Printed Two Sides' => '50 sheets per pads',
            'Top Glued Edge' => 'Glued on top  Each pad includes 14pt backing',
            'Left Glued Edge' => 'Glued on left side  Each pad includes 14pt backing',
            'none' => 'Non',
            'Magnetic Strip on the Back' => 'Magnetic strip on back',
            '3 Hole Drill on Left Edge' => '3 Hole Drill on Left Edge',
        ];
        if (array_key_exists($option, $cdata)) {
            return $cdata[$option];
        } else {
            false;
        }

    }

    public function autoBatchFullPriceList($product_id, $data)
    {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_full_prices');

        // Prepare keys
        $col_paper = 'B';
        $col_size = 'C';
        $col_ink = 'D';
        $col_pages = 'E';
        $col_binding = 'F';
        $col_finishing = 'G';

        $quantities_1 = [];
        $col_quantities = [];
        foreach ($data[1] as $key => $val) {
            if (strcasecmp($val, 'Paper') == 0) {
                $col_paper = $key;
            } else if (strcasecmp($val, 'Size') == 0) {
                $col_size = $key;
            } else if (strcasecmp($val, 'Ink') == 0) {
                $col_ink = $key;
            } else if (strcasecmp($val, 'Pages') == 0) {
                $col_pages = $key;
            } else if (strcasecmp($val, 'Binding') == 0) {
                $col_binding = $key;
            } else if (strcasecmp($val, 'Finishing') == 0) {
                $col_finishing = $key;
            } else if (preg_match('/^[0-9]+$/i', $val) || $val > 0) {
                $quantities_1[$key] = [$val, 0];
                if (!array_key_exists($val, $col_quantities)) {
                    $col_quantities[$val] = [];
                }

                $col_quantities[$val][0] = $key;
            } else if (preg_match('/^unit \\* ([0-9]+)$/i', $val, $m)) {
                $quantities_1[$key] = [$m[1], 1];
                if (!array_key_exists($m[1], $col_quantities)) {
                    $col_quantities[$m[1]] = [];
                }

                $col_quantities[$m[1]][1] = $key;
            }
        }

        $stock_id = $this->attributeId('Stock');
        $ink_color_id = $this->attributeId('Ink Color');
        $side_id = $this->attributeId('Printed Sides');
        $numpages_id = $this->attributeId('Number of Pages');
        $glue_id = $this->attributeId('Notepads Glue');
        $finishing_id = $this->attributeId('Finishing');
        //print("$stock_id, $ink_color_id, $side_id, $numpages_id, $glue_id");

        $checked = 0;
        $processed = 0;

        $side_one_id = $this->attributeItemId($side_id, 'One Side');
        $side_double_id = $this->attributeItemId($side_id, 'Double Sided (4/4) Different Image');

        $fmt = numfmt_create('en_US', NumberFormatter::CURRENCY);

        $quantity_ids = [];
        $size_ids = [];
        $stock_item_ids = [];
        $ink_color_item_ids = [];
        $numpages_item_ids = [];
        $glue_item_ids = [];
        $finishing_item_ids = [];

        $recs = [];
        for ($i = 2; array_key_exists($i, $data); $i++) {
            $checked++;

            $row = $data[$i];

            if (!array_key_exists($row[$col_size])) {
                $size = $this->convert_printnew_option($row[$col_size]);
                $size_ids[$row[$col_size]] = $this->sizeId($size);
            }

            if (!array_key_exists($row[$col_paper], $stock_item_ids)) {
                $stock_item_ids[$row[$col_paper]] = $this->attributeItemId($stock_id, $this->convert_printnew_option($row[$col_paper]));
            }

            if (!array_key_exists($row[$col_ink], $ink_color_ids)) {
                $ink_color_item_ids[$row[$col_ink]] = $this->attributeItemId($ink_color_id, $this->convert_printnew_option($row[$col_ink]));
            }

            $side_item_id = $row[$col_ink] == 'Colour Front Side Only' ? $side_one_id : $side_double_id;
            if (!array_key_exists($row[$col_pages], $numpages_item_ids)) {
                $numpages_item_ids[$row[$col_pages]] = $this->attributeItemId($numpages_id, $this->convert_printnew_option($row[$col_pages]));
            }

            if (!array_key_exists($row[$col_binding], $glue_item_ids)) {
                $glue_item_ids[$row[$col_binding]] = $this->attributeItemId($glue_id, $this->convert_printnew_option($row[$col_binding]));
            }

            if (!array_key_exists($row[$col_finishing], $finishing_item_ids)) {
                $finishing_item_ids[$row[col_finishing]] = $this->attributeItemId($finishing_id, $this->convert_printnew_option($row[$col_finishing]));
            }

            $size_id = $size_ids[$row[$col_size]];
            $stock_item_id = $stock_item_ids[$row[$col_paper]];
            $ink_color_item_id = $ink_color_item_ids[$row[$col_ink]];
            $numpages_item_id = $numpages_item_ids[$row[$col_pages]];
            $glue_item_id = $glue_item_ids[$row[$col_binding]];
            $finishing_item_id = $finishing_item_ids[$row[col_finishing]];

            foreach ($col_quantities as $quantity => $qcols) {
                if (!array_key_exists($quantity, $quantity_ids)) {
                    $quantity_ids[$quantity] = $this->quantityId($quantity);
                }

                $quantity_id = $quantity_ids[$quantity];
                $price = $fmt->parseCurrency($row[$qcols[1]], $curr) * 0.85;

                $attributes = array(
                    [$stock_id, $stock_item_id],
                    [$ink_color_id, $ink_color_item_id],
                    [$side_id, $side_item_id],
                    [$numpages_id, $numpages_item_id],
                    [$glue_id, $glue_item_id],
                    [$finishing_id, $finishing_item_id],
                );
                usort($attributes, function ($a, $b) {
                    if ($a[0] < $b[0]) {
                        return -1;
                    } else if ($a[0] > $b[0]) {
                        return 1;
                    }

                    return 0;
                });
                $s_attributes = [];
                foreach ($attributes as $attribute) {
                    $s_attributes[] = "$attribute[0]-$attribute[1]";
                }

                $rec = [
                    'product_id' => $product_id, 'quantity_id' => $quantity_id, 'size_id' => $size_id,
                    'attributes' => join(',', $s_attributes),
                    'price' => $price,
                ];
                $recs[] = $rec;
            }
            if (count($recs) > 100) {
                $this->db->insert_batch('product_full_prices', $recs);
                $recs = [];
            }
            //print("$processed<br>");
            //exit(0);
            $processed++;
            //break;
        }
        if (count($recs) > 0) {
            $this->db->insert_batch('product_full_prices', $recs);
            $recs = [];
        }
        return $checked - $processed;
    }

    public function getFullPrice($product_id, $quantity_id, $size_id, $attributes)
    {
        if (empty($attributes))
            return 0;
        $this->db->select('price');
        $this->db->from('product_full_prices');
        $this->db->where('product_id', $product_id);
        $this->db->where('quantity_id', $quantity_id);
        $this->db->where('size_id', $size_id);
        $this->db->where('attributes', $attributes);
        $result = $this->db->get()->result_array();
        if (count($result) == 0) {
            return 0;
        }

        return $result[0]['price'];
    }

    /**
     * Get extra prices with attribute_id & attribute_item_id from product_attribute_item_datas
     */
    public function getSumExtraPriceOfSingleAttributes($product_id, $attributes)
    {
        if (empty($attributes))
            return 0;
        $attribute_items = [];
        foreach ($attributes as $attribute) {
            $attribute_items[] = $attribute[1];
        }

        $this->db->select('SUM(extra_price)');
        $this->db->from('product_attribute_item_datas');
        $this->db->where('product_id', $product_id);
        $this->db->where_in('attribute_item_id', $attribute_items);
        // if (count($attributes) > 0) {
        //     $this->db->group_start();
        //     foreach ($attributes as $attribute) {
        //         $attribute_id = $attribute[0];
        //         $attribute_item_id = $attribute[1];
        //         $this->db->or_where("(`attribute_id` = '$attribute_id' AND `attribute_item_id` = '$attribute_item_id')");
        //     }
        //     $this->db->group_end();
        // }
        $result = $this->db->get()->result_array();
        if (!$result) {
            return 0;
        }

        return $result[0]['SUM(extra_price)'];
    }

    public function getSumExtraPriceOfQuantity($product_id, $quantity_id)
    {
        $this->db->select('price');
        $this->db->from('product_quantity');
        $this->db->where('product_id', $product_id);
        $this->db->where('qty', $quantity_id);
        $result = $this->db->get()->result_array();
        if (!$result) {
            return 0;
        }

        return $result[0]['price'];
    }

    public function getSumExtraPriceOfQuantitySize($product_id, $quantity_id, $size_id)
    {
        $this->db->select('extra_price');
        $this->db->from('product_size_new');
        $this->db->where('product_id', $product_id);
        $this->db->where('qty', $quantity_id);
        $this->db->where('size_id', $size_id);
        $result = $this->db->get()->result_array();
        if (!$result) {
            return 0;
        }

        return $result[0]['extra_price'];
    }

    public function getSumExtraPriceOfMultipleAttributes($product_id, $quantity_id, $size_id, $multiple_attributes)
    {
        if (empty($multiple_attributes))
            return 0;
        $attribute_items = [];
        foreach ($multiple_attributes as $attribute) {
            $attribute_items[] = $attribute[1];
        }

        $this->db->select('SUM(extra_price)');
        $this->db->from('size_multiple_attributes');
        $this->db->where('product_id', $product_id);
        $this->db->where('qty', $quantity_id);
        $this->db->where('size_id', $size_id);
        $this->db->where_in('attribute_item_id', $attribute_items);
        // if (count($multiple_attributes) > 0) {
        //     $this->db->group_start();
        //     foreach ($multiple_attributes as $attribute) {
        //         $attribute_id = $attribute[0];
        //         $attribute_item_id = $attribute[1];
        //         $this->db->or_where("(`attribute_id` = '$attribute_id' AND `attribute_item_id` = '$attribute_item_id')");
        //     }
        //     $this->db->group_end();
        // }
        $result = $this->db->get()->result_array();
        if (!$result) {
            return 0;
        }

        return $result[0]['SUM(extra_price)'];
    }

    public function getAttributes($q, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('product_attributes');
        $this->db->like('name', $q);
        $total = $this->db->get()->row();
        $total = reset($total);

        $this->db->select('product_attributes.*');
        $this->db->from('product_attributes');
        $this->db->like('name', $q);
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0) {
            $this->db->limit($take, $skip);
        } else {
            $this->db->offset($skip);
        }

        $data = $this->db->get()->result();
    }

    public function getAttributesMap($q, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('attributes');
        $this->db->like('name', $q);
        $total = $this->db->get()->row();
        $total = reset($total);

        $this->db->select('attributes.*, COUNT(DISTINCT(attribute_items.id)) AS item_count');
        $this->db->from('attributes');
        $this->db->join('attribute_items', 'attribute_items.attribute_id=attributes.id', 'left');
        $this->db->group_by('attributes.id');
        $this->db->like('attributes.name', $q);
        $this->db->order_by('attributes.type, attributes.name');
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0) {
            $this->db->limit($take, $skip);
        } else {
            $this->db->offset($skip);
        }

        $data = $this->db->get()->result();
    }

    public function attributeCreate($data)
    {
        if (empty($data['name']))
            return 'Name is required';

        // Check duplication
        $this->db->from('attributes');
        $this->db->where('name', $data['name']);
        $org = $this->db->get()->row();
        if ($org)
            return 'Name is duplicated';

        $this->db->insert('attributes', [
            'name' => $data['name'],
            'label' => $data['label'] ?? $data['name'],
            'label_fr' => $data['label_fr'] ?? $data['label'] ?? $data['name'],
            'type' => $data['type'],
        ]);

        return null;
    }

    public function attributeUpdate($id, $data)
    {
        if (empty($data['name']))
            return 'Name is required';

        // Check duplication
        $this->db->from('attributes');
        $this->db->where('id !=', $id);
        $this->db->where('name', $data['name']);
        $org = $this->db->get()->row();
        if ($org)
            return 'Name is duplicated';

        $this->db->where('id', $id);
        $this->db->update('attributes', $data);
    }

    public function attributeDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('attributes');
    }

    public function getAttributeItemsMap($attribute_id, $q, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('attribute_items');
        $this->db->join('attributes', 'attributes.id=attribute_items.attribute_id');
        if ($attribute_id)
            $this->db->where('attribute_items.attribute_id', $attribute_id);
        if ($q) {
            $this->db->group_start();
            $this->db->like('attributes.name', $q);
            $this->db->or_like('attribute_items.name', $q);
            $this->db->group_end();
        }
        $total = $this->db->get()->row();
        $total = reset($total);

        $this->db->select('attribute_items.*, attributes.name AS attribute_name');
        $this->db->from('attribute_items');
        $this->db->join('attributes', 'attributes.id=attribute_items.attribute_id');
        if ($attribute_id)
            $this->db->where('attribute_items.attribute_id', $attribute_id);
        if ($q) {
            $this->db->group_start();
            $this->db->like('attributes.name', $q);
            $this->db->or_like('attribute_items.name', $q);
            $this->db->group_end();
        }
        $this->db->order_by('attributes.name, CAST(attribute_items.name AS FLOAT), attribute_items.name');
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0) {
            $this->db->limit($take, $skip);
        } else {
            $this->db->offset($skip);
        }

        $data = $this->db->get()->result();
    }

    public function attributeItemCreate($data)
    {
        if (empty($data['name']))
            return 'Name is required';

        // Check duplication
        $this->db->from('attribute_items');
        $this->db->where('attribute_id', $data['attribute_id']);
        $this->db->where('name', $data['name']);
        $org = $this->db->get()->row();
        if ($org)
            return 'Name is duplicated';

        $this->db->insert('attribute_items', [
            'attribute_id' => $data['attribute_id'],
            'name' => $data['name'],
            'name_fr' => $data['name_fr'] ?? $data['name'],
        ]);

        return null;
    }

    public function attributeItemUpdate($id, $data)
    {
        if (empty($data['name']))
            return 'Name is required';

        // Check duplication
        $this->db->from('attribute_items');
        $this->db->where('id', $id);
        $org = $this->db->get()->row();
        if (!$org)
            return 'No data found with the specified id';
        $attribute_id = $org->attribute_id; // attribute_id is readonly

        $this->db->from('attribute_items');
        $this->db->where('id !=', $id);
        $this->db->where('attribute_id', $attribute_id);
        $this->db->where('name', $data['name']);
        $org = $this->db->get()->row();
        if ($org)
            return 'Name is duplicated';

        $this->db->set('name', $data['name']);
        $this->db->set('name_fr', $data['name_fr']);
        $this->db->where('id', $id);
        $this->db->update('attribute_items');
    }

    public function attributeItemDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('attribute_items');
    }

    public function getProductAttributes($product_id, $q, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('product_attribute_map');
        $this->db->join('attributes', 'attributes.id=product_attribute_map.attribute_id');
        $this->db->where('product_attribute_map.product_id', $product_id);
        if ($q)
            $this->db->like('attributes.name', $q);
        $total = $this->db->get()->row();
        $total = reset($total);

        $this->db->select('product_attribute_map.*, attributes.name, attributes.label, attributes.label_fr, attributes.type, COUNT(DISTINCT(product_attribute_item_map.attribute_item_id)) AS item_count');
        $this->db->from('product_attribute_map');
        $this->db->join('attributes', 'attributes.id=product_attribute_map.attribute_id');
        $this->db->join('product_attribute_item_map', "product_attribute_item_map.product_id=$product_id AND product_attribute_item_map.attribute_id=product_attribute_map.attribute_id", 'left');
        $this->db->group_by('product_attribute_map.attribute_id');
        $this->db->where('product_attribute_map.product_id', $product_id);
        // $this->db->order_by('attributes.type');
        $this->db->order_by('product_attribute_map.show_order');
        if ($q)
            $this->db->like('attributes.name', $q);
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0) {
            $this->db->limit($take, $skip);
        } else {
            $this->db->offset($skip);
        }

        $data = $this->db->get()->result();
    }

    public function productAttributeCreate($data)
    {
        if (!$data['product_id'] || !$data['attribute_id'])
            return 'Invalid parameters';

        // Check duplication
        $this->db->from('product_attribute_map');
        $this->db->where('product_id', $data['product_id']);
        $this->db->where('attribute_id', $data['attribute_id']);
        $org = $this->db->get()->row();
        if ($org)
            return 'Attribute is duplicated';

        $this->db->insert('product_attribute_map', $data);

        return null;
    }

    public function productAttributeUpdate($id, $data)
    {
        // Check readonly values
        unset($data['product_id']);
        unset($data['attribute_id']);

        $this->db->where('id', $id);
        $this->db->update('product_attribute_map', $data);
    }

    public function productAttributeDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->from('product_attribute_map');
        $attribute = $this->db->get()->row();
        if ($attribute) {
            $this->db->where('product_id', $attribute->product_id);
            $this->db->where('attribute_id', $attribute->attribute_id);
            $this->db->delete('product_attribute_item_map');
        }
        $this->db->where('id', $id);
        $this->db->delete('product_attribute_map');
    }

    public function getProductAttributeItems($product_id, $attribute_id, $q, $take, $skip, &$data, &$total)
    {
        $this->db->select('COUNT(DISTINCT(product_attribute_item_map.id))');
        $this->db->from('product_attribute_item_map');
        $this->db->join('attributes', 'attributes.id=product_attribute_item_map.attribute_id');
        $this->db->join('attribute_items', 'attribute_items.id=product_attribute_item_map.attribute_item_id');
        $this->db->where('product_attribute_item_map.product_id', $product_id);
        if ($attribute_id)
            $this->db->where('product_attribute_item_map.attribute_id', $attribute_id);
        if ($q) {
            $this->db->group_start();
            $this->db->like('attributes.name', $q);
            $this->db->or_like('attribute_items.name', $q);
            $this->db->group_end();
        }
        $total = $this->db->get()->row();
        $total = reset($total);

        $this->db->select('product_attribute_item_map.id, ' .
            'attributes.name AS attribute_name, attributes.label AS attribute_label, attributes.label_fr AS attribute_label_fr, attributes.type, ' .
            'attribute_items.name AS attribute_item_name, attribute_items.name_fr AS attribute_item_name_fr, ' .
            'product_attribute_item_map.product_id, product_attribute_item_map.attribute_id, product_attribute_item_map.attribute_item_id, product_attribute_item_map.additional_fee, ' .
            'product_attribute_item_map.show_order'
        );
        $this->db->from('product_attribute_item_map');
        $this->db->join('attributes', 'attributes.id=product_attribute_item_map.attribute_id');
        $this->db->join('attribute_items', 'attribute_items.id=product_attribute_item_map.attribute_item_id');
        $this->db->join('product_attribute_map', 'product_attribute_map.product_id=product_attribute_item_map.product_id AND product_attribute_map.attribute_id=product_attribute_item_map.attribute_id');
        $this->db->where('product_attribute_item_map.product_id', $product_id);
        if ($attribute_id)
            $this->db->where('product_attribute_item_map.attribute_id', $attribute_id);
        if ($q) {
            $this->db->group_start();
            $this->db->like('attributes.name', $q);
            $this->db->or_like('attribute_items.name', $q);
            $this->db->group_end();
        }
        $this->db->group_by('product_attribute_item_map.id');
        // $this->db->order_by('attributes.type');
        $this->db->order_by('product_attribute_map.show_order, attributes.type, attributes.name, product_attribute_item_map.show_order, attribute_items.name');
        $take = $take > 0 ? $take : 0;
        $skip = $skip > 0 ? $skip : 0;
        if ($take > 0) {
            $this->db->limit($take, $skip);
        } else {
            $this->db->offset($skip);
        }

        $data = $this->db->get()->result();
    }

    public function productAttributeItemCreate($data)
    {
        if (!$data['product_id'] || !$data['attribute_id'] || !$data['attribute_item_id'])
            return 'Invalid parameters';

        // Check duplication
        $this->db->from('product_attribute_item_map');
        $this->db->where('product_id', $data['product_id']);
        $this->db->where('attribute_id', $data['attribute_id']);
        $this->db->where('attribute_item_id', $data['attribute_item_id']);
        $org = $this->db->get()->row();
        if ($org)
            return 'Item is duplicated';

        $this->db->insert('product_attribute_item_map', $data);

        return null;
    }

    public function productAttributeItemUpdate($id, $data)
    {
        // Check readonly values
        unset($data['product_id']);
        unset($data['attribute_id']);
        unset($data['attribute_item_id']);

        $this->db->where('id', $id);
        $this->db->update('product_attribute_item_map', $data);
    }

    public function productAttributeItemDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('product_attribute_item_map');
    }

    public function attributeDataFromIds($product_id, $attributes)
    {
        $this->db->from('product_attribute_map');
        $this->db->join('attributes', 'attributes.id=product_attribute_map.attribute_id');
        $this->db->join('product_attribute_item_map', 'product_attribute_item_map.product_id=product_attribute_map.product_id AND product_attribute_item_map.attribute_id=product_attribute_map.attribute_id AND product_attribute_map.use_items=1', 'left');
        $this->db->join('attribute_items', 'attribute_items.id=product_attribute_item_map.attribute_item_id', 'left');
        $this->db->where('product_attribute_map.product_id', $product_id);
        $this->db->select('product_attribute_map.value_min, product_attribute_map.value_max, product_attribute_map.use_items, product_attribute_map.attribute_id, product_attribute_item_map.attribute_item_id, attributes.name AS attribute_name_real, attributes.label AS attribute_name, attributes.label_fr AS attribute_name_french, attribute_items.name AS item_name, attribute_items.name_fr AS item_name_french');
        if (!empty($attributes)) {
            $this->db->group_start();
            $first = true;
            foreach ($attributes as $attribute_id => $attribute_item_id) {
                if ($first) {
                    $this->db->where("(product_attribute_map.attribute_id='$attribute_id' AND (product_attribute_item_map.attribute_item_id IS NULL OR product_attribute_item_map.attribute_item_id='$attribute_item_id'))");
                    $first = false;
                } else {
                    $this->db->or_where("(product_attribute_map.attribute_id='$attribute_id' AND (product_attribute_item_map.attribute_item_id IS NULL OR product_attribute_item_map.attribute_item_id='$attribute_item_id'))");
                }
            }
            $this->db->group_end();
        }
        $this->db->group_by('product_attribute_map.attribute_id, product_attribute_item_map.attribute_item_id');
        $data = $this->db->get()->result_array();

        $attributes_value = [];
        foreach ($attributes as $attribute_id => $attribute_item_id) {
            foreach ($data as &$item) {
                if ($item['attribute_id'] == $attribute_id) {
                    if (!$item['use_items']) {
                        $item['item_name'] = $attribute_item_id;
                        $item['item_name_french'] = $attribute_item_id;
                    }
                    $found = true;
                    break;
                }
            }
        }

        return $data;
    }
}
