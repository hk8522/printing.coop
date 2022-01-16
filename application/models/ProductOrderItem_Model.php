<?php

Class ProductOrderItem extends MY_Model {
	public $table='product_order_items';
	public $config = array(
        array(
                'field' => 'name',
                'label' => 'product name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                        'required' => 'Enter product name',
                ),
        ),
		array(
                'field' => 'menu_id',
                'label' => 'Menu',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Select menu',
                ),
        ),

		array(
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
        ),
		array(
                'field' => 'price',
                'label' => 'product price',
                'rules' => 'required|numeric',
                'errors' => array(
                        'required' => 'Enter product price',
                ),
        ),
		array(
                'field' => 'total_stock',
                'label' => 'product stock',
                'rules' => 'required|integer',
                'errors' => array(
                        'required' => 'Enter product stock',
                ),
        ),array(
                'field' => 'short_description',
                'label' => 'product short  description ',
                'rules' => 'required|max_length[100]',
                'errors' => array(
                        'required' => 'Enter product short description',
                ),
        ),
		array(
                'field' => 'full_description',
                'label' => 'product full description',
                'rules' => 'required|max_length[1000]',
                'errors' => array(
                        'required' => 'Enter product full description',
                ),
        ),

		/*array(
                'field' => 'files',
                'label' => 'files',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Select product images',
                ),
        )*/
    );

    public function getProductOrderList($id=null) {
        $this->db->select(array('Product.*','Menu.name as menu_name','Category.name as category_name','SubCategory.name as sub_category_name'));
        $this->db->from($this->table.' as Product');

		$this->db->where(array('Menu.status'=>1,'Category.status'=>1,'SubCategory.status'=>1));
		if(!empty($id)){
		    $this->db->where(array('Menu.status'=>1,'Category.status'=>1,'SubCategory.status'=>1,'Product.id'=>$id));
		}
		$this->db->join('menus as Menu', 'Menu.id=Product.menu_id', 'inner');
		$this->db->join('categories as Category', 'Category.id=Product.category_id', 'inner');
		$this->db->join('sub_categories as SubCategory', 'SubCategory.id=Product.sub_category_id', 'inner');
        $query = $this->db->get();
		if(!empty($id)){
			$data=(array)$query->row();
		}else{
		    $data=$query->result_array();
		}

		return $data;
    }

	public function getLatestProducts() {
        $this->db->select('*');
		$condition=array();
		$condition['status']=1;
		$this->db->where($condition);
        $this->db->from($this->table);
		$this->db->order_by('created','desc');
		$this->db->limit(8);
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getTodayDealProducts() {
		$today_date=date('Y-m-d');
        $this->db->select('*');
		$condition=array();
		$condition['status']=1;
		$condition['is_today_deal']=1;
		$condition['is_today_deal_date']=$today_date;
		$this->db->where($condition);
        $this->db->from($this->table);
		$this->db->order_by('name','asc');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getSpecialProducts() {
        $this->db->select('*');
		$condition=array();
		$condition['status']=1;
		$condition['is_special']=1;
		$this->db->where($condition);
        $this->db->from($this->table);
		$this->db->order_by('name','asc');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getBestsellerProducts() {
        $this->db->select('*');
		$condition=array();
		$condition['status']=1;
		$condition['is_bestseller']=1;
		$this->db->where($condition);
        $this->db->from($this->table);
		$this->db->order_by('name','asc');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getTopVisitedProducts() {
        $this->db->select('*');
		$condition=array();
		$condition['status']=1;
		$this->db->where($condition);
        $this->db->from($this->table);
		$this->db->order_by('total_visited','desc');
		$this->db->limit(30);
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }
	public function getProductOrderDataById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('id'=>$id));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }

	public function deleteProduct($id) {
		$this->db->where('id',$id);
        $query = $this->db->delete($this->table);
		if ($query) {
            return 1;
		} else {
			return 0;
		}
    }

	public function saveProduct($data) {
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
}
?>