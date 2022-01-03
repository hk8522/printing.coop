<?php

Class SubCategory_Model extends MY_Model {

	public $table='sub_categories';
	public $config = array(
        array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Enter sub category name',
                ),
        ),
		array(
                'field' => 'category_id',
                'label' => 'Menu',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Select Category',
                ),
        )
    );

    public function getSubCategoryList()
		{
        $this->db->select(array('SubCategory.*','Category.name as category_name'));
        $this->db->from($this->table.' as SubCategory');
		$this->db->join('categories as Category', 'Category.id=SubCategory.category_id', 'inner');
        $this->db->order_by('Category.category_order','asc');
		$this->db->order_by('SubCategory.sub_category_order','asc');
        return $this->db->get()->result_array();
    }
	public function getSubCategoryDataById($id) {

        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('id'=>$id));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }

	public function getSubCategoryDropDownList($menu_id = null, $category_id = null)
	{
			$lists = [];

			$this->db->select(array('id','name'));
			$this->db->where('status', 1);

			if ($menu_id && $category_id) {

			   $this->db->where([ 'menu_id' => $menu_id, 'category_id' => $category_id ]);

	         } elseif ($category_id) {
					$this->db->where('category_id', $category_id);
			} elseif ($menu_id) {
					$this->db->where('menu_id', $menu_id);
			}

			$this->db->from($this->table);
			$this->db->order_by('sub_category_order','asc');
			$data = $this->db->get()->result_array();

			foreach ($data as $val) {
					$lists[$val['id']] = $val['name'];
			}

			return $lists;
  }

	public function getActiveSubCategoryListByCategoryId($menu_id=null,$category_id=null) {

		$lists=array();
		if(!empty($menu_id) && !empty($category_id)){

			$this->db->select(array('id','name'));
			$this->db->where(array('status'=>'1','menu_id'=>$menu_id,'category_id'=>$category_id));
			$this->db->from($this->table);
			$this->db->order_by('sub_category_order','asc');
			$query = $this->db->get();
			$lists=$query->result_array();
		}
		return $lists;
    }
	public function saveSubCategory($data) {

		$id=isset($data['id']) ? $data['id']:'';

		if(!empty($id)){

			$data['updated']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$query = $this->db->update($this->table, $data);
		}else{

			$data['created']=date('Y-m-d H:i:s');
			$data['updated']=date('Y-m-d H:i:s');
			$query = $this->db->insert($this->table, $data);
		}

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

}
?>
