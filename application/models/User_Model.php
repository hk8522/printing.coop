<?php

Class User_Model extends MY_Model {
    public $table='users';

    public $config = array(
        array(
                'field' => 'fname',
                'label' => 'first name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                        'required' => 'Enter first name',
                ),
        ),
        array(
                'field' => 'lname',
                'label' => 'last name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                    'required' => 'Enter Last name',
                ),
        ),
        array(
                'field' => 'email',
                'label' => 'email id',
                'rules' => 'required|valid_email|max_length[50]|is_unique[users.email]',
                'errors' => array(
                        'required' => 'Enter email id',
                        'is_unique' => 'Email id already registered'
                ),
        ),
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|max_length[20]|min_length[8]',
                'errors' => array(
                        'required' => 'Enter Password',
                ),
        ),
        array(
                'field'  => 'confirm_password',
                'label'  => 'Confirm Password',
                'rules'  => 'required|matches[password]',
          ),
    );

    public $configFranch = array(
        array(
                'field' => 'fname',
                'label' => 'first name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                        'required' => 'entrez votre prénom',
                        'max_length' => "Le champ du nom le plus éloigné ne peut pas dépasser 50 caractères."
                ),
        ),
        array(
                'field' => 'lname',
                'label' => 'last name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                    'required' => 'Entrer le nom de famille',
                    'max_length' => "Le champ du nom de famille ne peut pas dépasser 50 caractères."
                ),
        ),
        array(
                'field' => 'email',
                'label' => 'email id',
                'rules' => 'required|valid_email|max_length[50]|is_unique[users.email]',
                'errors' => array(
                        'required' => "Entrez l'identifiant de l'e-mail",
                        'is_unique' => 'Identifiant de messagerie déjà enregistré',
                        'max_length' => "Le champ de l'e-mail ne peut pas dépasser 50 caractères."
                ),
        ),
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|max_length[20]|min_length[8]',
                'errors' => array(
                        'required' => 'Entrer le mot de passe',
                ),
        ),
        array(
                'field'  => 'confirm_password',
                'label'  => 'Confirm Password',
                'rules'  => 'required|matches[password]',
          ),
    );
    public $prefconfig = array(
        array(
                'field' => 'fname',
                'label' => 'first name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                        'required' => 'Enter first name',
                ),
        ),
        array(
                'field' => 'lname',
                'label' => 'last name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                'required' => 'Enter Last name',
                ),
        ),
        array(
                'field' => 'email',
                'label' => 'email id',
                'rules' => 'required|valid_email|max_length[50]',
                'errors' => array(

                        'required' => 'Enter email id',
                ),
        ),
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|max_length[20]|min_length[8]',
                'errors' => array(
                        'required' => 'Enter Password',
                ),
        )
    );

    public $prefconfigFranch = array(
        array(
                'field' => 'fname',
                'label' => 'first name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                        'required' => 'entrez votre prénom',
                ),
        ),
        array(
                'field' => 'lname',
                'label' => 'last name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                'required' => 'Entrer le nom de famille',
                ),
        ),
        array(
                'field' => 'email',
                'label' => 'email id',
                'rules' => 'required|valid_email|max_length[50]',
                'errors' => array(

                        'required' => "Entrez l'identifiant de l'e-mail",
                ),
        ),
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|max_length[20]|min_length[8]',
                'errors' => array(
                        'required' => 'Entrer le mot de passe',
                ),
        )
    );

    public $config_edit = array(
        array(
                'field' => 'fname',
                'label' => 'first name',
                'rules' => 'required|max_length[50]',
                'errors' => array(
                        'required' => 'Enter first name',
                ),
        ),
        array(
                'field' => 'lname',
                'label' => 'last name',
                'rules' => 'max_length[50]',
                'errors' => array(
                ),
        ),

        array(
                'field' => 'mobile',
                'label' => 'phone number',
                'rules' => 'max_length[14]|min_length[6]',
                'errors' => array(
                        'required' => 'Enter  phone number',
                ),
        ),
        array(
                'field' => 'email',
                'label' => 'email id',
                'rules' => 'required|valid_email|max_length[200]',
                'errors' => array(
                        'required' => 'Enter email id',
                ),
        ),
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'max_length[20]|min_length[8]',
                'errors' => array(
                        'required' => 'Enter Password',
                ),
        )
    );

        public $loginRules = [
                [
                        'field'  => 'loginemail',
                        'label'  => 'Email',
                        'rules'  => 'trim|required|valid_email',
                ],
                [
                        'field'  => 'loginpassword',
                        'label'  => 'password',
                        'rules'  => 'required',
                ],
        ];

    public $configChangePassword = array(

        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|max_length[20]|min_length[8]',
                'errors' => array(
                        'required' => 'Enter Password',
                ),
        )
    );
    public function checkUserLogin($data,$md5=true){
        $LoginUser=array();
        $password=$data['password'];
        if($md5){
            $password=md5($data['password']);
        }

        $condition=array('email' => $data['email'],'password' => $password);
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
           $LoginUser=(array)$query->row();
        }
        return $LoginUser;
    }

    public function checkMobileNumber($mobile_number){
        $LoginUser=array();
        $condition=array('mobile' => $mobile_number);
        $this->db->select(array('mobile'));
        $this->db->from('users');
        $this->db->where($condition);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
           return true;
        }else{
            false;
        }
    }
    public function checkEmailId($email){
        $LoginUser=array();
        $condition=array('email' => $email);
        $this->db->select(array('email'));
        $this->db->from('users');
        $this->db->where($condition);
        $query = $this->db->get();
        $data=(array)$query->row();
        //pr($data);
        if($query->num_rows() > 0) {
           return true;
        }else{
            false;
        }
    }
    public function getUserDataByEmailId($email){
        $LoginUser=array();
        $condition=array('email' => $email);
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $query = $this->db->get();
        $data=(array)$query->row();
        return $data;
    }
    public function getUserList($status=null) {
        $this->db->select('*');
        $condition=array();
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
    public function getPreferredCustomerUserList($status=null) {
        $this->db->select('*');
        $condition=array();
        $condition['user_type']=2;
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

    public function getListNewUser() {
        $this->db->select('*');
        /*$condition=array();
        $this->db->where($condition);*/
        $this->db->from($this->table);
        $this->db->order_by("created", "desc");
        $this->db->limit(10,0);
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function getCountUser($status=null) {
        $this->db->select('id');
        $condition=array();
        if($status=='active'){
            $condition['status']=1;
        }else if($status=='inactive'){
            $condition['status']=0;
        }

        $this->db->where($condition);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getUserDataById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data=(array)$query->row();
        return $data;
    }

    public function deleteUser($id) {
        $this->db->where('id',$id);
        $query = $this->db->delete($this->table);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function saveUser($data) {
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

    public function saveUserPassword($data) {
        $email=isset($data['email']) ? $data['email']:'';

        if(!empty($email)){
            $data['updated']=date('Y-m-d H:i:s');
            $this->db->where('email', $email);
            $query = $this->db->update($this->table, $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    public function getWishlistList($user_id) {
        $this->db->select(array('Wishlist.id as wishlist_id','Wishlist.user_id','Product.*'));
        $this->db->from('wishlists as Wishlist');
        $condition=array();
        $condition['Product.status']=1;
        if(!empty($user_id)){
            $condition['Wishlist.user_id']=$user_id;
        }
        $this->db->where($condition);
        $this->db->join('products as Product', 'Wishlist.product_id=Product.id', 'inner');
        $this->db->order_by('Wishlist.created','desc');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function geWishlistCount($user_id=null,$product_id=null) {
        $this->db->select('*');
        $condition=array();
        if(!empty($user_id)){
            $condition['user_id']=$user_id;
        }

        if(!empty($product_id)){
            $condition['product_id']=$product_id;
        }
        $this->db->where($condition);
        $this->db->from('wishlists');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function saveWishlist($data) {
        $data['created']=date('Y-m-d H:i:s');
        $data['updated']=date('Y-m-d H:i:s');
        $query = $this->db->insert('wishlists', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWishlist($id) {
        $this->db->where('id',$id);
        $query = $this->db->delete('wishlists');
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
}
