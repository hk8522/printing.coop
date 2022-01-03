<?php

Class Admin_Model extends MY_Model {

	public $table='admins';

	public $config_chnage_password = array(

		array(
                'field' => 'email',
                'label' => 'email id',
                'rules' => 'required|valid_email',
                'errors' => array(

                        'required' => 'Enter email id',
                ),
        )
    );

	public $config_reset_password = array(

		array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => array(

                        'required' => 'Enter new password',
                ),
			),
			array(
				'field' => 'passconf',
                'label' => 're-password',
                'rules' => 'required|matches[password]',
                'errors' => array(

                        'required' => 'Enter re-password',
                ),
        )
    );

	public $config= array(

		array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
                'errors' => array(

                        'required' => 'Enter name',
                ),
	    ),
		array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|is_unique[admins.email]',
                'errors' => array(

                        'required' => 'Enter Email',
						'is_unique'=>'Email id already registered'
                ),
		),
		array(
                'field' => 'username',
                'label' => 'User Name',
                'rules' => 'required|is_unique[admins.username]',
                'errors' => array(

                        'required' => 'Enter user name',
						'is_unique'=>'User name id already registered'
                ),
		),
		array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => array(

                        'required' => 'Enter password',
                ),
		),
		array(
                'field' => 'store_ids[]',
                'label' => 'store_ids',
                'rules' => 'required',
                'errors' => array(

                        'required' => 'Select store',
                ),
		)

    );

	public $editconfig= array(

		array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
                'errors' => array(

                        'required' => 'Enter name',
                ),
	    ),
		array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required',
                'errors' => array(

                        'required' => 'Enter Email',
						'is_unique'=>'Email id already registered'
                ),
		),
		array(
                'field' => 'username',
                'label' => 'User Name',
                'rules' => 'required',
                'errors' => array(

                        'required' => 'Enter user name',
						'is_unique'=>'User name id already registered'
                ),
		),
		array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'min_length[8]|max_length[20]',
                'errors' => array(

                        'required' => 'Enter password',
                ),
			),
		    array(
                'field' => 'store_ids[]',
                'label' => 'store_ids',
                'rules' => 'required',
                'errors' => array(

                        'required' => 'Select store',
                ),
			)

    );


    public function checkAdminLogin($data){

		$LoginUser=array();

		$condition=array('username'=>$data['username'],'password'=>md5($data['password']));
        $this->db->select('*');
        $this->db->from('admins');
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

           $LoginUser=(array)$query->row();
        }
		return $LoginUser;
	}
	public function getAdminList($status=null) {

        $this->db->select('*');
		$condition=array();
		$condition['role']='subadmin';
		if($status=='active'){

			$condition['status']=1;
		}else if($status=='inactive'){

			$condition['status']=0;
		}

		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;

    }
	public function getAdminDataById($id) {

        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('id'=>$id));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }

	public function getDataByEmailId($email) {

        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('email'=>$email));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;

    }

	public function saveAdmin($data) {

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

	public function saveAdminAttributesData($attributes_data,$attributes_item_data,$admin_id) {

        $this->db->where('admin_id', $admin_id);
        $this->db->delete('admin_module');
		$this->db->where('admin_id', $admin_id);
        $this->db->delete('admin_sub_module');
		$query=false;
		if(count($attributes_data) > 0){

		   $query=$this->db->insert_batch('admin_module', $attributes_data);
		}
        if ($query) {

			if(count($attributes_item_data) > 0){

               $query=$this->db->insert_batch('admin_sub_module', $attributes_item_data);
			}

        } else {
            return false;
        }
    }

    public function deleteAdmin($id) {

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