<?php

Class Store_Model extends MY_Model {

	public $table='stores';
	public $config = array(
        array(
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Enter store name',
                ),
        ),
		/*array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required',
				'errors' => array(
						'required' => 'Enter store email',
				),
	    ),
		array(
                'field' => 'phone',
                'label' => 'phone',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Enter store phone',
                ),
        ),*/
		array(
                'field' => 'url',
                'label' => 'url',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Enter store url',
                ),
        ),
		/*array(
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Enter store address',
                ),
        ),*/
		array(
                'field' => 'langue_id',
                'label' => 'langue_id',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Select store langue',
                ),
        ),

		/*array(
                'field' => 'currency_id[]',
                'label' => 'currency_id',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Select store currency',
                ),
        )*/

    );

	public function save($data) {

		$id=isset($data['id']) ? $data['id']:'';

		if(!empty($id)){


			$this->db->where('id', $id);
			$query = $this->db->update($this->table, $data);
			if ($query) {

               return $id;
			} else {
				return 0;
			}
		}else{

			$data['created']=date('Y-m-d H:i:s');

			$query = $this->db->insert($this->table, $data);
			if ($query) {
               return $insert_id = $this->db->insert_id();
			} else {
				return 0;
			}

		}
    }
	public function getStoreDropDownList($status=null) {

        $this->db->select('id,name');
		$condition=array();
		$condition['status']=1;
		//$condition['stor_type']=1;
		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getStoreList($status=null) {

		$datanew=array();
        $this->db->select('id,name');
		$condition=array();
		$condition['status']=1;
		//$condition['stor_type']=1;
		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();

		foreach($data as $key=>$val){

			$datanew[$val['id']]=$val['name'];
		}

		return $datanew;

    }

	public function getAllStoreList($status=null) {

		$datanew=array();
        $this->db->select('*');
		$condition=array();
		$condition['status']=1;
		//$condition['stor_type']=1;
		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();

		foreach($data as $key=>$val){

			$datanew[$val['id']]=$val;
		}

		return $datanew;

    }

	public function getStoreListData($main_store_id=null) {


		$datanew=array();
        $this->db->select(array('stores.*','language.name as language_name','language.id as language_id'));
		$this->db->join('language','language.id=stores.langue_id', 'left');

		$condition=array();
		$condition['stores.status']=1;
		if(!empty($main_store_id)){

			$condition['stores.main_store_id']=$main_store_id;
		}
		//$condition['stores.stor_type']=1;
		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();

		$Currency=$this->getCurrencyList();
		foreach($data as $key=>$val){

			$CurrencyList=array();
			$currency_ids=!empty($val['currency_id']) ? explode(",",$val['currency_id']):array();
			foreach($currency_ids as $currency_id){
				if(array_key_exists($currency_id,$Currency)){

					$CurrencyList[$currency_id]=$Currency[$currency_id];

				}
			}
			$val['CurrencyList']=$CurrencyList;
			$datanew[$val['id']]=$val;
		}
		return $datanew;

    }
	public function getDataById($id) {

        $this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id',$id);
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;

    }

	public function getList() {

        $this->db->select('*');
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;


    }
	public function getLanguageList() {

		$datanew=array();
        $this->db->select('*');
		$this->db->from('language');
        $query = $this->db->get();
		$data=$query->result_array();
		foreach($data as $key=>$val){

			$datanew[$val['id']]=$val['name'];
		}
		return $datanew;
    }

	public function getCurrencyList() {

		$datanew=array();
        $this->db->select('*');
		$this->db->from('currency');
		$this->db->order_by('order','asc');
        $query = $this->db->get();
		$data=$query->result_array();
		foreach($data as $key=>$val){

			$datanew[$val['id']]=$val;
		}
		return $datanew;

    }


	public function getPickupStoresList() {

        $this->db->select('*');
		$this->db->from('pickup_stores');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getPickupStoreDataById($id) {

        $this->db->select('*');
		$this->db->from('pickup_stores');
		$this->db->where('id',$id);
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;

    }


	public function MainStoreList($status=null) {

        $this->db->select('*');
		$condition=array();
		$condition['status']=1;
		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();
		$dataNew=array();
	    foreach($data as $val){

			$main_store_id=$val['main_store_id'];
			$name=$val['name'];
			if(array_key_exists($main_store_id,$dataNew)){

				$name=$dataNew[$main_store_id].' & '.$name;

				$dataNew[$main_store_id]=$name;
			}else{
				$dataNew[$main_store_id]=$name;
			}

		}
		return $dataNew;

    }
	public function getStoreDataById($id=null) {
		if(empty($id)){
			$id=1;
		}

        $this->db->select('*');
		$condition=array();
		$condition['id']=$id;
		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;

    }

	public function getStoreEmailTemapleImage($store_id=null,$template_name=null) {

        $this->db->select('image');
		$condition=array();
		$condition['store_id']=$store_id;
		$condition['email_template_name']=$template_name;
		$this->db->where($condition);
		$this->db->from('stores_email_images');
        $query = $this->db->get();
		$data=(array)$query->row();

		$image='';
		if(!empty($data)){

			$image=!empty($data['image']) ? $data['image']:'';
		}

		return $image;
    }


}
?>