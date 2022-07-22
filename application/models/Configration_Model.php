<?php

Class Configration_Model extends MY_Model {
    public $table = 'configurations';

  public function saveData($data){
      $id = isset($data['id']) ? $data['id'] : '';

      if ($id) {
          $data['updated'] = date('Y-m-d H:i:s');
          $this->db->where('id', $id);
          $query = $this->db->update($this->table, $data);
      } else {
          $data['created'] = date('Y-m-d H:i:s');
          $data['updated'] = date('Y-m-d H:i:s');
          $query = $this->db->insert($this->table, $data);
      }

      if ($query) {
         return true;
      }

      return false;
    }
    public function getConfigrations($website_store_id=1)
    {
        if(empty($website_store_id)){
            $website_store_id=1;
        }
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('main_store_id',$website_store_id);
        $this->db->order_by('main_store_id','asc');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getConfigrationsList()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('main_store_id','asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getConfigrationsDataById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $this->db->order_by('main_store_id','asc');
        $query = $this->db->get();
        return $query->row_array();
    }
}
