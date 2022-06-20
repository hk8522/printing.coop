<?php

Class Menu_Model extends MY_Model {
    public $table='menus';
    public $config = array(
        array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Enter menu name',
                ),
        )
    );

    public function getMenuList() {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function getCollectionMenu() {
        $this->db->select('*');
        $this->db->where(array('status'=>1,'collection'=>1));
        $this->db->from($this->table);
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function getMenuDropDownList() {
        $this->db->select(array('id','name'));
        $this->db->where(array('status'=>1));
        $this->db->from($this->table);
        $this->db->order_by('menu_order','asc');
        $query = $this->db->get();
        $data=$query->result_array();
        $lists=array();
        foreach($data as $val){
            $lists[$val['id']]=ucfirst($val['name']);
        }

        return $lists;
    }
    public function getMenuDataById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('id'=>$id));
        $query = $this->db->get();
        $data=(array)$query->row();
        return $data;
    }

    public function saveMenu($data) {
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

    public function getActiveMenuList() {
        $this->db->select(array('id','name'));
        $this->db->where(array('status'=>1));
        $this->db->from($this->table);
        $this->db->order_by('menu_order','asc');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }
}
?>
