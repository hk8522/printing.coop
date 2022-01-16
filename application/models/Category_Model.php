 <?php

Class Category_Model extends MY_Model {
	public $table='categories';

	public $config = [
    [
      'field' => 'name',
      'label' => 'Name',
      'rules' => 'required',
      'errors' => [
          'required' => 'Enter category name',
      ],
    ],
  ];

   public $config_tags =[
    [
	  'field' => 'name',
      'label' => 'Name',
      'rules' => 'required',
      'errors' => [
          'required' => 'Enter tag name',
      ],
    ]
  ];

	public function getCategoryList()
	{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->order_by('category_order','asc');
			$query = $this->db->get();
			return $query->result_array();
	}
	public function ourPrintedProductsCategory($store_id=null)
	{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where(array('status'=>'1','show_our_printed_product'=>1));
			if(!empty($store_id)){
				$this->db->where("find_in_set($store_id, store_id)");
			}
			$this->db->order_by('category_order','asc');
			$query = $this->db->get();
			$data=$query->result_array();
			$dataNew=array();
			foreach($data as $key=>$val){
				$id=$val['id'];
				$categoryImages=$this->getCategoriesImagesDataBy($id);
				$val['categoryImages']=$categoryImages;
				$dataNew[]=$val;
			}
			return $dataNew;
	}

	public function getActiveCategoryListByMenuId($menu_id=null) {
        $data=array();

		if(!empty($menu_id)){
			$this->db->select(array('id','name'));
			$this->db->where(array('status'=>'1','menu_id'=>$menu_id));
			$this->db->from($this->table);
			$this->db->order_by('category_order','asc');
			$query = $this->db->get();
			$data=$query->result_array();
		}
		return $data;
    }

	public function getActiveCategoryListByFooterMenu($store_id=null){
		$data=array();
		$this->db->select(array('id','name','name_french'));
		$this->db->where(array('status'=>'1','show_footer_menu'=>1));

		if(!empty($store_id)){
		    $this->db->where("find_in_set($store_id, store_id)");
	    }
		$this->db->from($this->table);
		$this->db->order_by('category_order','asc');
		$query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }
	public function getCategoryDataById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('id'=>$id));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }

	public function getCategoryDropDownList($menu_id = null)
	{
			$lists = [];

			$this->db->select(array('id','name'));
			$this->db->where('status', 1);
			if ($menu_id) {
					$this->db->where('menu_id', $menu_id);
			}

			$this->db->from($this->table);
			$this->db->order_by('category_order','asc');
			$data = $this->db->get()->result_array();
			foreach ($data as $val) {
				 $lists[$val['id']] = $val['name'];
			}
			return $lists;
	 }

	public function saveCategory($data) {
		$id=isset($data['id']) ? $data['id']:'';

		if(!empty($id)){
			$data['updated']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$query = $this->db->update($this->table, $data);
			if ($query) {
               return $id;
			} else {
				return 0;
			}
		}else{
			$data['created']=date('Y-m-d H:i:s');
			$data['updated']=date('Y-m-d H:i:s');
			$query = $this->db->insert($this->table, $data);
			if ($query) {
               return $insert_id = $this->db->insert_id();
			} else {
				return 0;
			}
		}
    }

		public function getCategoriesAndSubCategories()
		{
				$categoryQuery = $this->db->select('*')->from($this->table)->where(['status'=>'1'])->order_by('category_order','asc');
				$data['categories'] = $categoryQuery->get()->result_array();
				$allCategoryProducts = 0;

				foreach($data['categories'] as $key => $category) {
						$subCategoryQuery = $this->db->select('*')->from('sub_categories')->where(['status'=> 1, 'category_id' => $category['id']])->order_by('sub_category_order','asc');
						$data['categories'][$key]['sub_categories'] = $subCategoryQuery->get()->result_array();
						$totalProducts = $this->db->select('products.id')->from('products')->where('category_id',  $category['id']);
						$productsCount= $totalProducts->get()->num_rows();
						$data['categories'][$key]['total_products'] = $productsCount;
						$allCategoryProducts = $allCategoryProducts + $productsCount;
				}
				$data['all_categories_products'] = $allCategoryProducts;
				return $data;
		}

		public function getMultipalCategoriesAndSubCategories()
		{
				$categoryQuery = $this->db->select('id,name')->from($this->table)->where(['status'=>'1'])->order_by('name','asc');
				$categories = $categoryQuery->get()->result_array();

				foreach($categories as $key => $category) {
						$subCategoryQuery = $this->db->select('id,name')->from('sub_categories')->where(['status'=> 1, 'category_id' => $category['id']])->order_by('name','asc');
						$data[$key]=$category;
						$data[$key]['sub_categories'] = $subCategoryQuery->get()->result_array();
				}
				return $data;
		}

        public function getCategoriesAndSubCategoriesForMainMenu($store_id=null)
		{
				$this->db->select('*');
				$this->db->from($this->table);
				$this->db->where(['status'=>'1','show_main_menu'=>1]);
				if(!empty($store_id)){
				   $this->db->where("find_in_set($store_id, store_id)");
			    }
				$this->db->order_by('category_order','asc');
				$categoryQuery=$this->db->get();
				$data['categories'] =$categoryQuery->result_array();

				$allCategoryProducts = 0;

				foreach ($data['categories'] as $key => $category) {
						$subCategoryQuery = $this->db->select('*')->from('sub_categories')->where(['status'=> 1,'category_id' => $category['id'],'show_main_menu'=>1])->order_by('sub_category_order','asc');
						$subCategoryQuery=$subCategoryQuery->get()->result_array();
						$sub_categories=array();
						foreach($subCategoryQuery as $skey=>$subcategory){
							$subcategory_id=$subcategory['id'];
							$products=$this->getActiveProductListBySubCategoryId($category['id'],$subcategory_id);

							$subcategory['products']=$products;
							$subcategory['sub_category_total_products']=$products;
							$sub_categories[$skey]=$subcategory;
						}
						$data['categories'][$key]['sub_categories'] =$sub_categories;

						$productsCount= $this->getActiveProductListByCategoryId($category['id']);

						$data['categories'][$key]['total_products'] = $productsCount;
						$allCategoryProducts = $allCategoryProducts + $productsCount;
				}

				$data['all_categories_products'] = $allCategoryProducts;
				return $data;
		}
         public function getCategoriesAndSubCategoriesForMainMenuBk()
		{
				$categoryQuery = $this->db->select('*')->from($this->table)->where(['status'=>'1','show_main_menu'=>1])->order_by('category_order','asc');
				$data['categories'] = $categoryQuery->get()->result_array();
				$allCategoryProducts = 0;

				foreach ($data['categories'] as $key => $category) {
						$subCategoryQuery = $this->db->select('*')->from('sub_categories')->where(['status'=> 1,'category_id' => $category['id'],'show_main_menu'=>1])->order_by('sub_category_order','asc');
						$subCategoryQuery->get()->result_array();

						$data['categories'][$key]['sub_categories'] = $subCategoryQuery->get()->result_array();

						$totalProducts = $this->db->select('products.id')->from('products')->where('category_id',  $category['id']);
						$productsCount= $totalProducts->get()->num_rows();
						$data['categories'][$key]['total_products'] = $productsCount;
				}

				$data['all_categories_products'] = $this->getTotalActiveProduct();
				return $data;
		}
		public function deleteCategory($id)
		{
			 $this->db->delete('products', array('category_id' => $id));
			 $this->db->delete('sub_categories', array('category_id' => $id));
			 $query = $this->db->delete('categories', array('id' => $id));

			 if ($query) {
				 return 1;
			 }

			 return 0;
	    }

	    /*function getActiveProductListBySubCategoryId($sub_category_id){
			$data=array();
			$this->db->select('id,name');
			$condition=array();
			$condition['status']=1;
			$condition['sub_category_id']=$sub_category_id;
			$this->db->where($condition);
			$this->db->from('products');
			$this->db->order_by('name','asc');
			$query = $this->db->get();
			$data=$query->result_array();
			#pr($data);
			return $data;
        }*/

        function getActiveProductListBySubCategoryId($category_id,$sub_category_id){
			$data=array();
			$this->db->select('product_subcategory.id');
			$this->db->from('product_subcategory');
			$this->db->join('products', 'products.id=product_subcategory.product_id', 'left');
			$condition=array();
			$condition['products.status']=1;
			$condition['product_subcategory.category_id']=$category_id;
			$condition['product_subcategory.sub_category_id']=$sub_category_id;
			$this->db->where($condition);
			$query = $this->db->get();
			$data=$query->num_rows();
			#pr($data);
			return $data;
        }

        function getActiveProductListByCategoryId($category_id){
			$data=array();
			$this->db->select('product_category.id');
			$this->db->from('product_category');
			$this->db->join('products', 'products.id=product_category.product_id', 'left');
			$condition=array();
			$condition['products.status']=1;
			$condition['product_category.category_id']=$category_id;
			$this->db->where($condition);
			$query = $this->db->get();
			$data=$query->num_rows();
			#pr($data);
			return $data;
        }

        function getTotalActiveProduct(){
			$data=array();
			$this->db->select('id');
			$this->db->from('products');
			$condition=array();
			$condition['products.status']=1;
			$this->db->where($condition);
			$query = $this->db->get();
			$data=$query->num_rows();
			#pr($data);
			return $data;
        }

	public function getTasgList($status=null,$proudly_display_your_brand=null,$montreal_book_printing=null,$footer=null,$store_id=null)
	{
			$this->db->select('*');
			$this->db->from('tags');
			if($status==1){
				$this->db->where('status',1);
			}
			if($status==1){
				$this->db->where('status',1);
			}
			if($proudly_display_your_brand==1){
				$this->db->where('proudly_display_your_brand',1);
			}
			if($montreal_book_printing==1){
				$this->db->where('montreal_book_printing',1);
			}
			if($footer==1){
				$this->db->where('footer',1);
			}

			if(!empty($store_id)){
				$this->db->where("find_in_set($store_id, store_id)");
			}

			$this->db->order_by('tag_order','asc');
			$query = $this->db->get();
			#$this->db->last_query(); die();

			return $query->result_array();
	}

	public function getTasgDropDwonList($status=null)
	{
			$this->db->select('*');
			$this->db->from('tags');
			if($status==1){
				$this->db->where('status',1);
			}
			$this->db->order_by('tag_order','asc');
			$query = $this->db->get();
			$data=$query->result_array();
			$data_new=array();
			foreach($data as $val){
				$data_new[$val['id']]=$val['name'];
			}
			return $data_new;
	}

	public function saveTags($data) {
		$id=isset($data['id']) ? $data['id']:'';
		if(!empty($id)){
			$data['updated']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$query = $this->db->update('tags', $data);
		}else{
			$data['created']=date('Y-m-d H:i:s');
			$data['updated']=date('Y-m-d H:i:s');
			$query = $this->db->insert('tags', $data);
		}
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

	public function deleteTags($id)
	{
	    $query = $this->db->delete('tags', array('id' => $id));
		if ($query) {
			return 1;
		}
		return 0;
	}

	public function getTagDataById($id) {
        $this->db->select('*');
        $this->db->from('tags');
		$this->db->where(array('id'=>$id));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }

	public function getCategoriesImagesDataBy($id){
        $this->db->select('*');
        $this->db->from('categories_images');
		$this->db->where(array('category_id'=>$id));
        $query = $this->db->get();
		$data=$query->result_array();
		$dataNew=array();

		foreach($data as $key=>$val){
			$dataNew[$val['main_store_id']]=$val;
		}
		return $dataNew;
    }

	public function saveCategoryImage($data) {
		$id=isset($data['id']) ? $data['id']:'';
		if(!empty($id)){
			$this->db->where('id', $id);
			$data['updated']=date('Y-m-d H:i:s');
			$query = $this->db->update('categories_images', $data);
		}else{
			$data['created']=date('Y-m-d H:i:s');
			$data['updated']=date('Y-m-d H:i:s');
			$query = $this->db->insert('categories_images', $data);
		}
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}

?>
