<?php

class Address_Model extends MY_Model
{
    public $table = 'addresses';

    public $config = array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => 'required|max_length[50]',
            'errors' => array(
                'required' => 'Enter First Name',
            ),
        ),

        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => 'required|max_length[50]',
            'errors' => array(
                'required' => 'Enter Last Name',
            ),
        ),

        array(
            'field' => 'mobile',
            'label' => 'phone number',
            'rules' => 'max_length[14]|min_length[6]',
            'errors' => array(
                'required' => 'Enter phone number',
            ),
        ),
        array(
            'field' => 'alternate_phone',
            'label' => 'alternate phone',
            'rules' => 'max_length[14]|min_length[6]',
            'errors' => array(

            ),
        ),
        array(
            'field' => 'pin_code',
            'label' => 'pincode',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter pincode',
            ),
        ),
        array(
            'field' => 'address',
            'label' => 'address',
            'rules' => 'required|max_length[150]',
            'errors' => array(
                'required' => 'Enter Address',
            ),
        ),
        array(
            'field' => 'city',
            'label' => 'city',
            'rules' => 'required|max_length[50]',
            'errors' => array(
                'required' => 'Enter city',
            ),
        ),
        array(
            'field' => 'state',
            'label' => 'state',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Select state',
            ),
        ),
    );

    public function getAddressListByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->select(array('Address.*', 'State.name as StateName', 'city.name as cityName', 'Country.iso2 as CountryName'));
        $this->db->where(array('user_id' => $user_id));
        $this->db->from($this->table . ' as Address');
        $this->db->join('states as State', 'State.id=Address.state', 'left');
        $this->db->join('cities as city', 'city.id=Address.city', 'left');
        $this->db->join('countries as Country', 'Country.id=Address.country', 'left');
        $this->db->order_by('Address.default_delivery_address', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function getAddressDataById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }

    public function deleteAddress($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete($this->table);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function saveAddress($data)
    {
        $id = isset($data['id']) ? $data['id'] : '';

        if (!empty($id)) {
            $data['updated'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update($this->table, $data);
            if ($query) {
                return $id;
            } else {
                return 0;
            }
        } else {
            $data['created'] = date('Y-m-d H:i:s');
            $data['updated'] = date('Y-m-d H:i:s');
            $query = $this->db->insert($this->table, $data);
            if ($query) {
                return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function CheckDeliveryAddress($id, $data)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('default_delivery_address' => '1', 'user_id' => $data['user_id']));
        $query = $this->db->get();

        if (empty($data['default_delivery_address'])) {
            if ($query->num_rows() == 0) {
                $sdata['id'] = $id;
                $sdata['default_delivery_address'] = 1;
                $this->saveAddress($sdata);
            }
        } else {
            if ($query->num_rows() > 0) {
                $datas = $query->result_array();
                foreach ($datas as $v) {
                    if ($v['id'] != $id) {
                        $sndata['id'] = $v['id'];
                        $sndata['default_delivery_address'] = 0;
                        $this->saveAddress($sndata);
                    }
                }
            }
        }
    }

    public function getState($country_id = null)
    {
        $data = array();
        if ($country_id) {
            $this->db->select('*');
            $this->db->from('states');
            $this->db->where('country_id', $country_id);

            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
        }
        return $data;
    }
    public function getCity($state_id = null)
    {
        $data = array();
        if ($state_id) {
            $this->db->select('*');
            $this->db->from('cities');
            $this->db->where('state_id', $state_id);

            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
        }
        return $data;
    }

    public function getCountries($country_id = "39")
    {
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->order_by('name', 'asc');
        if (!empty($country_id)) {
            $this->db->where('id', $country_id);
        }
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    public function getStateById($id)
    {
        $this->db->select('*');
        $this->db->from('states');
        $this->db->where('id', $id);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }
    public function getCityById($id)
    {
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('id', $id);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }
    public function getCountryById($id)
    {
        $this->db->select('*', 'name as CountryName');
        $this->db->from('countries');
        $this->db->where('id', $id);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }
    public function salesTaxRatesProvincesById($id)
    {
        $this->db->select('*');
        $this->db->from('sales-tax-rates-provinces');
        $this->db->where('state_id', $id);
        $query = $this->db->get();
        $data = (array) $query->row();
        return $data;
    }
    public function salesTaxRatesProvinces()
    {
        $this->db->select('*');
        $this->db->from('sales-tax-rates-provinces');
        $data = $this->db->get()->result();
        $result = [];
        foreach ($data as $item) {
            $result[$item->state_id] = $item;
        }

        return $result;
    }
}
