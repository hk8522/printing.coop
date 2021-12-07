<?php

Class Service_Model extends MY_Model {

	public $table = 'services';

    public $rules = [
	     [
          'field' => 'main_store_id',
          'label' => 'Website',
          'rules' => 'required',
        ],
        [
          'field' => 'name',
          'label' => 'Name',
          'rules' => 'required',
        ],
        [
          'field' => 'description',
          'label' => 'Description',
          'rules' => 'required',
        ],
  ];

  public function saveService($data)
  {
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

  public function getAllServices()
  {
      return $this->db->select('*')->from($this->table)->get()->result_array();
  }

  public function getServiceById($id)
  {
      return $this->db->select('*')->from($this->table)->where(array('id'=>$id, 'status'=> 1))->get()->row_array();
  }

	public function getActiveServices($website_store_id=null)
  {
      return $this->db->select('*')->from($this->table)->where(array('status'=>1,'main_store_id'=>$website_store_id))->get()->result_array();
  }
}
?>
