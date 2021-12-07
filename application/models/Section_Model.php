<?php

Class Section_Model extends MY_Model {

	public $table = 'sections';

  public $rules = [
        /*[
          'field' => 'main_store_id',
          'label' => 'Website',
          'rules' => 'required',
        ],*/
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
        [
          'field' => 'section_order',
          'label' => 'Section Order',
          'rules' => 'integer',
        ],
  ];

  public function saveSection($data)
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

  public function getAllSections()
  {
      return $this->db->select('*')->from($this->table)->get()->result_array();
  }

  public function getSectionById($id)
  {
      return $this->db->select('*')->from($this->table)->where(array('id'=>$id, 'status'=> 1))->get()->row_array();
  }
}
?>
