<?php

Class Banner_Model extends MY_Model {
	  public $table='banners';

    public $rules = [
        [
            'field' => 'main_store_id',
            'label' => 'WebSite',
            'rules' => 'required|max_length[50]',
        ],
		[
            'field' => 'name',
            'label' => 'banner',
            'rules' => 'required|max_length[50]',
        ],
  		  [
            'field' => 'short_description',
            'label' => 'banner short  description ',
            'rules' => 'max_length[150]',
        ],
    ];

		public function getBannerList($id=null)
		{
				$this->db->select('*');
				$this->db->from($this->table);
				$this->db->where(array('status'=>1));

		   	if (!empty($id)){
					$this->db->where(array('id'=>$id));
				}

				$query = $this->db->get();

    		if (!empty($id)) {
    			$data=(array)$query->row();
    		} else {
    				$data=$query->result_array();
    		}

    		return $data;
		}

    public function saveBanner($data)
    {
    		$id = isset($data['id']) ? $data['id']:'';

    		if (!empty($id)) {
    			$data['updated']=date('Y-m-d H:i:s');
    			$this->db->where('id', $id);
    			$query = $this->db->update('banners', $data);

    			if ($query) {
            return $id;
    			}
    				return 0;
    		} else {
    			$data['created']=date('Y-m-d H:i:s');
    			$data['updated']=date('Y-m-d H:i:s');
    			$query = $this->db->insert('banners', $data);
    			if ($query) {
            return $insert_id = $this->db->insert_id();
    			}
    			return 0;
    		}
    }

    public function getBannerDataById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('id'=>$id));
        return $this->db->get()->row_array();
    }

		public function deleteBanner($id)
		{
				$this->db->where('id',$id);
				$query = $this->db->delete('banners');

				if ($query) {
					 return 1;
				}

				return 0;
		}

		public function getHomePageBanners($website_store_id=null)
		{
				$this->db->select('*');
				$this->db->from($this->table);
				$this->db->where(array('status'=>1, 'menu_id' => NULL, 'product_id' => NULL,'main_store_id'=>$website_store_id));
				return $this->db->get()->result_array();
		}
}
?>
