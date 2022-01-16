<?php

Class ProductOrder_Model extends MY_Model {
	public $table='product_orders';
	public $config = array(
         array(
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                        'required' => 'Enter customer name',
                ),
         ),
		 array(
				'field' => 'mobile',
				'label' => 'mobile',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Enter customer mobile',
				),
		 ),
		  array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Enter customer email',
				),
		 ),
		 array(
				'field' => 'billing_name',
				'label' => 'billing_name',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Enter customer billing name',
				),
		 ),
		  array(
				'field' => 'billing_address',
				'label' => 'billing_address',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Enter customer billing address',
				),
		 ),
		  array(
				'field' => 'billing_city',
				'label' => 'billing_city',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Enter customer billing city',
				),
		 ),
		 array(
				'field' => 'billing_pin_code',
				'label' => 'billing_pin_code',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Enter customer postal code',
				),
		 ),

		 array(
				'field' => 'billing_state',
				'label' => 'billing_state',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Select customer billing state',
				),
		 ),
		  array(
				'field' => 'billing_country',
				'label' => 'billing_country',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Select customer billing country',
				),
		 ),
		 array(
				'field' => 'payment_status',
				'label' => 'payment_status',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Plese select payment status',
				),
		 ),

		 array(
				'field' => 'payment_type',
				'label' => 'payment_type',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Plese select payment type',
				),
		 ),

    );

    public function getProductOrderList($user_id=null) {
		$Orderdata=array();
		$this->db->select('*');
		$this->db->where(array('user_id'=>$user_id,'user_delete'=>1));

        $this->db->where_in('status', array(2,3,4,5,6,7,9));
        $this->db->from($this->table);
		$this->db->order_by('updated','desc');
        $query = $this->db->get();
		if($query->num_rows() > 0) {
            $data=(array)$query->result_array();

			foreach($data as $key=>$val){
				$id=$val['id'];
				$OrderItem=array();
				$OrderItem=$this->getProductOrderItemDataById($id);
				$val['OrderItem']=$OrderItem;
				$Orderdata[$key]=$val;
			}
        }
		return $Orderdata;
    }

	public function getOrderList($status=null,$user_id=null,$fromDate=null,$toDate=null) {
		$Orderdata=array();
		$this->db->select('*');
		$where=array('admin_delete'=>1);
		if(!empty($user_id)){
			$where['user_id']=$user_id;
		}

		if(!empty($fromDate)){
		   $this->db->where('order_date >=',$fromDate);
		}

		if(!empty($toDate)){
		   $this->db->where('order_date <=',$toDate);
		}

		$this->db->where($where);
		$status=strtolower($status);

		if($status=='all' || empty($status)){
		    $this->db->where_in('status', array(2,3,4,5,6,7,9));
		}else if(strtolower($status)=='new'){
			$this->db->where_in('status', array(2));
		}else if(strtolower($status)=='processing'){
			$this->db->where_in('status', array(3));
		}else if(strtolower($status)=='shipped'){
			$this->db->where_in('status', array(4));
		}else if(strtolower($status)=='delivered'){
			$this->db->where_in('status', array(5));
		}else if(strtolower($status)=='cancelled'){
			$this->db->where_in('status', array(6));
		}else if(strtolower($status)=='failed'){
			$this->db->where_in('status', array(7));
		}else if(strtolower($status)=='ready-for-pickup'){
			$this->db->where_in('status', array(9));
		}
		else{
			 $this->db->where_in('status', array(2,3,4,5,6,7,9));
		}

        $this->db->from($this->table);
		$this->db->order_by('updated','desc');
        $query = $this->db->get();
		if($query->num_rows() > 0) {
			$data=(array)$query->result_array();
			foreach($data as $key=>$val){
				$id=$val['id'];
				$OrderItem=array();
				$OrderItem=$this->getProductOrderItemDataById($id);
				$val['OrderItem']=$OrderItem;
				$Orderdata[$key]=$val;
			}
        }
		//print_r($Orderdata);
		return $Orderdata;
    }
	public function getOrdersByStatus($status=null) {
		$Orderdata=array();
		$this->db->select('*');
		$where=array('admin_delete'=>1);
		$this->db->where($where);
		$status=strtolower($status);
		$this->db->where(array('status'=>$status));
        $this->db->from($this->table);
		$this->db->order_by('updated','desc');
		$this->db->limit(10,0);
        $query = $this->db->get();
		$data=$query->result_array();
	    return $data;
    }

    public function personaliseDetail($id){
    	 $this->db->select('*');
        $this->db->from('product_personalise_by_user');
		$this->db->where(array('id'=>$id));
        $query = $this->db->get();
		$data=(array)$query->row();
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

	public function getProductOrderItemDataById($order_id) {
        $this->db->select('*');
		$this->db->where('order_id',$order_id);
        $this->db->from('product_order_items');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function deleteProductOrder($id,$type=1) {
		$this->db->where('id',$id);

		$saveData['id']=$id;
		if($type==1){
		   $saveData['user_delete']=2;
		}else if($type==2){
			$saveData['admin_delete']=2;
		}
		$insert_id=$this->saveProductOrder($saveData);
		if ($insert_id > 0) {
            return 1;
		} else {
			return 0;
		}
    }

	public function saveProductOrder($data) {
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
			$data['order_date']=date('Y-m-d');
			$data['updated']=date('Y-m-d H:i:s');
			$query = $this->db->insert($this->table, $data);
			if ($query) {
               return $insert_id = $this->db->insert_id();
			} else {
				return 0;
			}
		}
    }

	public function getCountOuder($status=null) {
        $this->db->select('id');
		$condition=array();
		if(!empty($status)){
			$condition['status']=$status;
			$this->db->where($condition);
		}
		$this->db->from($this->table);
        $query = $this->db->get();
		return $query->num_rows();
    }

	public function saveProductOrderItem($data) {
		$id=isset($data['id']) ? $data['id']:'';
		if(!empty($id)){
			$data['updated']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$query = $this->db->update('product_order_items', $data);
			if ($query) {
               return $id;
			} else {
				return 0;
			}
		}else{
			$data['created']=date('Y-m-d H:i:s');
			$data['updated']=date('Y-m-d H:i:s');
			$query = $this->db->insert('product_order_items', $data);
			if ($query) {
               return $insert_id = $this->db->insert_id();
			} else {
				return 0;
			}
		}
    }
}
?>