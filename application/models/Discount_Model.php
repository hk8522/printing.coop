<?php

Class Discount_Model extends MY_Model {
	public $table='discounts';
	public $config = array(
        array(
                'field' => 'code',
                'label' => 'code',
                'rules' => 'required|is_unique[discounts.code]',
                'errors' => array(
                        'required' => 'Enter discount code',
						'is_unique'=>'This code already generated'
                ),
        ),
		array(
                'field' => 'discount_type',
                'label' => 'discount type',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'select discount type',
                ),
        ),
		array(
                'field' => 'discount',
                'label' => 'discount',
                'rules' => 'required|numeric',
				'errors' => array(
				        'required' => 'Enter discount',
                        'integer' => 'discount value allowed only numeric',
                ),
        ),
		array(
                'field' => 'discount_valid_from',
                'label' => 'discount valid from',
                'rules' => 'required',
				'errors' => array(
				        'required' => 'select discount valid from',
                ),
        ),
		array(
                'field' => 'discount_valid_to',
                'label' => 'discount_valid_to',
                'rules' => 'required',
				'errors' => array(
				        'required' => 'select discount valid till',
                ),
        ),
		/*array(
                'field' => 'discount_requirement_quantity',
                'label' => 'discount requirement quantity',
                'rules' => 'required|integer',
				'errors' => array(
				        'required' => 'Enter discount requirement quantity',
                ),
        ),
		array(
                'field' => 'discount_code_limit',
                'label' => 'discount code limit',
                'rules' => 'required|integer',
				'errors' => array(
				        'required' => 'Enter discount code limit',
                ),
        )*/
    );

    public function getDiscountsList() {
        $this->db->select(array('*'));
		$this->db->from($this->table);
		//$this->db->where(array('Page_Category.status'=>1));
		$this->db->order_by('id','desc');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getActiveDiscountsList() {
        $this->db->select(array('*'));
		$this->db->from($this->table);
		$this->db->where(array('status'=>1));
		$this->db->order_by('id','desc');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getDiscountDataById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('id'=>$id));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }

	public function getDiscountDataByCode($code) {
        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('code'=>$code));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }

	public function saveDiscount($data) {
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

	public function deleteDiscount($id) {
		$this->db->where('id',$id);
        $query = $this->db->delete($this->table);
		if ($query) {
            return 1;
		} else {
			return 0;
		}
    }
}
?>