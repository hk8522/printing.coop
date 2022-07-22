<?php

Class Estimate_Model extends MY_Model {
    public $table='estimates';

    public $rules = [
        [
          'field' => 'contact_name',
          'label' => 'Contact Name',
          'rules' => 'required',
        ],
        [
          'field' => 'company_name',
          'label' => 'Company Name',
          'rules' => 'required',
        ],
        [
          'field' => 'street',
          'label' => 'Street',
          'rules' => 'required',
        ],
        [
          'field' => 'city',
          'label' => 'City',
          'rules' => 'required',
        ],
        [
          'field' => 'country',
          'label' => 'Country',
          'rules' => 'required',
        ],
        [
          'field' => 'flat_size',
          'label' => 'Flat Size',
          'rules' => 'required',
        ],
        [
          'field' => 'finish_size',
          'label' => 'Finish Size',
          'rules' => 'required',
        ],
        [
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'required|valid_email',
        ],
        [
          'field' => 'phone_number',
          'label' => 'Phone Number',
          'rules' => 'required|max_length[15]|min_length[6]',
        ],
        [
          'field' => 'postal_code',
          'label' => 'Postal Code',
          'rules' => 'required|max_length[10]|min_length[6]',
        ],
  ];
  public $rulesFrench = [
        [
          'field' => 'contact_name',
          'label' => 'Contact Name',
          'rules' => 'required',
        ],
        [
          'field' => 'company_name',
          'label' => 'Company Name',
          'rules' => 'required',
        ],
        [
          'field' => 'street',
          'label' => 'Street',
          'rules' => 'required',
        ],
        [
          'field' => 'city',
          'label' => 'City',
          'rules' => 'required',
        ],
        [
          'field' => 'country',
          'label' => 'Country',
          'rules' => 'required',
        ],
        [
          'field' => 'flat_size',
          'label' => 'Flat Size',
          'rules' => 'required',
        ],
        [
          'field' => 'finish_size',
          'label' => 'Finish Size',
          'rules' => 'required',
        ],
        [
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'required|valid_email',
        ],
        [
          'field' => 'phone_number',
          'label' => 'Phone Number',
          'rules' => 'required|max_length[15]|min_length[6]',
        ],
        [
          'field' => 'postal_code',
          'label' => 'Postal Code',
          'rules' => 'required|max_length[10]|min_length[6]',
        ],
  ];
  public function saveEstimateData($data)
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

    public function getAllEstimates()
    {
        return $this->db->select('*')->from($this->table)->get()->result_array();
    }

    public function getEstimateDataById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('id'=>$id));
        $query = $this->db->get();
        $data=(array)$query->row();
        return $data;
    }

    public function deleteProductEstimates($id) {
        $this->db->where('id',$id);
        $query = $this->db->delete($this->table);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
}
