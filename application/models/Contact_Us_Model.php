<?php

Class Contact_Us_Model extends MY_Model {

	public $table='contact_us';

	public $rules = [
        [
          'field' => 'name',
          'label' => 'Name',
          'rules' => 'required',
        ],
        [
          'field' => 'phone',
          'label' => 'Phone',
          'rules' => 'required|integer|max_length[10]|min_length[10]',
        ],
        [
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'required|valid_email',
        ],
        [
          'field' => 'comment',
          'label' => 'Comment',
          'rules' => 'required',
        ],
  ];

  public function save($data)
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
}
?>
