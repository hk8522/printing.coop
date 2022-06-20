<?php

Class Page_Category_Model extends MY_Model {
    public $table='page_categories';
    public $config = array(
        array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Enter category name',
                ),
        ),
        array(
                'field' => 'category_order',
                'label' => 'Category Order',
                'rules' => 'integer',
                'errors' => array(
                        'integer' => 'Category order value allowed only number',
                ),
        )
    );

    public function getCategoryList() {
        $this->db->select(array('page_categories.*'));
        $this->db->from($this->table);
        $this->db->order_by('category_order','asc');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function getActiveCategoryList() {
        $this->db->select(array('page_categories.*'));
        $this->db->from($this->table);
        $this->db->where(array('status'=>1));
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

    public function getCategoryDropDownList() {
        $lists=array();

            $this->db->select(array('id','name'));
            $this->db->where(array('status'=>'1'));
            $this->db->from($this->table);
            $this->db->order_by('category_order','asc');
            $query = $this->db->get();
            $data=$query->result_array();
            foreach($data as $val){
                $lists[$val['id']]=ucfirst($val['name']);
            }
        return $lists;
    }

    public function saveCategory($data) {
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

    public function deletePageCategory($id) {
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
