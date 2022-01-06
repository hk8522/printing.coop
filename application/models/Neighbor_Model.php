<?php

class Neighbor_Model extends MY_Model
{
    public $table = 'n_neighbors';
    public $config = array(
        array(
            'field' => 'name',
            'label' => 'Neighbor name',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter neighbor name',
            ),
        ),
        array(
            'field' => 'url',
            'label' => 'Neighbor url',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter neighbor url',
            ),
        ),
    );

    public function getNeighbors($neighbor_id = null, $limit = null, $start = null, $order = 'desc') {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($neighbor_id)
            $this->db->where('id', $neighbor_id);
        $this->db->order_by('updated_at', $order);
        if (!empty($limit))
            $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getNeighborsCount($neighbor_id = null) {
        $this->db->select('COUNT(*)');
        $this->db->from($this->table);
        if ($neighbor_id)
            $this->db->where('id', $neighbor_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['COUNT(*)'];
    }

    public function save($data, $table = null) {
        if ($table == null)
            $table = $this->table;
        if ($data['id'] > 0) {
            $this->db->where('id', $data['id']);
            $query = $this->db->update($table, $data);
            return $data['id'];
        } else {
            $query = $this->db->insert($table, $data);
            if ($query)
                return $this->db->insert_id();
        }
        return 0;
    }

    public function saveAttribute($data) {
        return $this->save($data, 'n_attributes');
    }

    public function getAttributeData($neighbor_id, $data_id = null, $limit = null, $start = null, $order = 'desc') {
        $this->db->select('*');
        $this->db->from('n_attributes');
        $this->db->where('neighbor_id', $neighbor_id);
        if ($data_id)
            $this->db->where('id', $data_id);
        $this->db->order_by('updated_at', $order);
        if (!empty($limit))
            $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getAttributeDataCount($neighbor_id, $data_id = null) {
        $this->db->select('COUNT(*)');
        $this->db->from('n_attributes');
        $this->db->where('neighbor_id', $neighbor_id);
        if ($data_id)
            $this->db->where('id', $data_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['COUNT(*)'];
    }

    public function attributesFull($neighbor_id) {
        $this->db->select(array('n_attributes.*', 'product_multiple_attributes.id AS attribute_id', 'product_multiple_attributes.name AS attribute_name'));
        $this->db->from('product_multiple_attributes');
        $this->db->join('n_attributes', 'n_attributes.attribute_id=product_multiple_attributes.id', 'left');
        $this->db->order_by('product_multiple_attributes.name');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function attributeItemsFull($neighbor_id) {
        $this->db->select(array('n_attribute_items.*',
            'product_multiple_attributes.id AS attribute_id',
            'product_multiple_attribute_items.id AS attribute_item_id',
            'product_multiple_attribute_items.item_name AS attribute_item_name'));
        $this->db->from('product_multiple_attribute_items');
        $this->db->join('n_attribute_items', 'n_attribute_items.attribute_item_id=product_multiple_attribute_items.id', 'left');
        $this->db->join('product_multiple_attributes', 'product_multiple_attributes.id=product_multiple_attribute_items.product_attribute_id', 'left');
        $this->db->join('n_attributes', 'n_attributes.attribute_id=product_multiple_attributes.id', 'left');
        $this->db->where('n_attributes.neighbor_id', $neighbor_id);
        $this->db->order_by('n_attribute_items.neighbor_id');
        $this->db->order_by('product_multiple_attribute_items.item_name');
        $data = $this->db->get()->result_array();
        $result = [];
        foreach ($data as $item) {
            $attribute_id = $item['attribute_id'];
            if (!array_key_exists($attribute_id, $result))
                $result[$attribute_id] = [];
            $result[$attribute_id][] = $item;
        }
        return $result;
    }

    public function saveAttributes($neighbor_id, $attributesOrg, $attributesNew) {
        if (count($attributesOrg) > 0)
            $this->db->update_batch('n_attributes', $attributesOrg, 'id');
        if (count($attributesNew) > 0)
            $this->db->insert_batch('n_attributes', $attributesNew);
    }
}
