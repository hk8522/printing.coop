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

    public function save($data) {
        if ($data['id'] > 0) {
            $query = $this->db->update($this->table, $data);
            return $data['id'];
        } else {
            $query = $this->db->insert($this->table, $data);
            if ($query)
                return $this->db->insert_id();
        }
        return 0;
    }
}
