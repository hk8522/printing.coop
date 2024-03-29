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
                'required' => 'Enter the neighbor name',
            ),
        ),
        array(
            'field' => 'url',
            'label' => 'Neighbor url',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Enter the neighbor url',
            ),
        ),
    );

    public function getNeighbors($neighbor_id = null, $limit = null, $start = null, $order = 'desc')
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($neighbor_id) {
            $this->db->where('id', $neighbor_id);
        }

        $this->db->order_by('updated_at', $order);
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getNeighborsCount($neighbor_id = null)
    {
        $this->db->select('COUNT(*)');
        $this->db->from($this->table);
        if ($neighbor_id) {
            $this->db->where('id', $neighbor_id);
        }

        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['COUNT(*)'];
    }

    public function save($data, $table = null)
    {
        if ($table == null) {
            $table = $this->table;
        }

        if ($data['id'] > 0) {
            $this->db->where('id', $data['id']);
            $this->db->update($table, $data);
            return $data['id'];
        } else {
            $query = $this->db->insert($table, $data);
            if ($query) {
                return $this->db->insert_id();
            }

        }
        return 0;
    }

    public function saveAttribute($data)
    {
        return $this->save($data, 'n_attributes');
    }

    public function saveAttributeItem($data)
    {
        return $this->save($data, 'n_attribute_items');
    }

    public function getAttributeData($neighbor_id, $data_id = null, $limit = null, $start = null, $order = 'desc')
    {
        $this->db->select('*');
        $this->db->from('n_attributes');
        $this->db->where('neighbor_id', $neighbor_id);
        if ($data_id) {
            $this->db->where('id', $data_id);
        }

        $this->db->order_by('updated_at', $order);
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getAttributeDataCount($neighbor_id, $data_id = null)
    {
        $this->db->select('COUNT(*)');
        $this->db->from('n_attributes');
        $this->db->where('neighbor_id', $neighbor_id);
        if ($data_id) {
            $this->db->where('id', $data_id);
        }

        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['COUNT(*)'];
    }

    public function attribute($attribute_id)
    {
        $this->db->select('*');
        $this->db->from('n_attributes');
        $this->db->where('id', $attribute_id);
        $result = $this->db->get()->result_array();
        if (count($result) > 0) {
            return $result[0];
        }

        return false;
    }

    public function attributes($neighbor_id)
    {
        $this->db->select('*');
        $this->db->from('n_attributes');
        $this->db->where('neighbor_id', $neighbor_id);
        $this->db->order_by('index', 'asc');
        $this->db->order_by('updated_at', 'desc');
        return $this->db->get()->result_array();
    }

    public function attributeItem($attribute_item_id)
    {
        $this->db->select('*');
        $this->db->from('n_attribute_items');
        $this->db->where('id', $attribute_item_id);
        $result = $this->db->get()->result_array();
        if (count($result) > 0) {
            return $result[0];
        }

        return false;
    }

    public function attributeItems($attribute_id)
    {
        $this->db->select('*');
        $this->db->from('n_attribute_items');
        $this->db->where('attribute_id', $attribute_id);
        $this->db->order_by('index', 'asc');
        $this->db->order_by('updated_at', 'desc');
        return $this->db->get()->result_array();
    }

    public function attributeItemsForNeighbor($neighbor_id)
    {
        $this->db->select('n_attribute_items.*');
        $this->db->from('n_attribute_items');
        $this->db->join('n_attributes', 'n_attributes.id=n_attribute_items.attribute_id');
        $this->db->where('n_attributes.neighbor_id', $neighbor_id);
        $this->db->order_by('attribute_id', 'asc');
        $this->db->order_by('index', 'asc');
        $data = $this->db->get()->result_array();
        $result = [];
        foreach ($data as $item) {
            $attribute_id = $item['attribute_id'];
            if (!array_key_exists($attribute_id, $result)) {
                $result[$attribute_id] = [];
            }

            $result[$attribute_id][] = $item;
        }
        return $result;
    }

    public function attributesFull($neighbor_id)
    {
        $this->db->select(array('n_attributes.*', 'product_multiple_attributes.id AS attribute_id', 'product_multiple_attributes.name AS attribute_name'));
        $this->db->from('product_multiple_attributes');
        $this->db->join('n_attributes', "n_attributes.neighbor_id=$neighbor_id AND n_attributes.attribute_id=product_multiple_attributes.id", 'left');
        $this->db->order_by('product_multiple_attributes.name');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function sizesFull($neighbor_id)
    {
        $this->db->select(array('n_attribute_items.*',
            '0 AS attribute_id',
            'sizes.id AS attribute_item_id',
            'sizes.size_name AS attribute_item_name'));
        $this->db->from('sizes');
        $this->db->join('n_attribute_items', "n_attribute_items.neighbor_id=$neighbor_id AND n_attribute_items.attribute_id=0 AND n_attribute_items.attribute_item_id=sizes.id", 'left');
        $this->db->order_by('sizes.size_name');
        return $this->db->get()->result_array();
    }

    public function attributeItemsFull($neighbor_id)
    {
        $this->db->select(array('n_attribute_items.*',
            'product_multiple_attributes.id AS attribute_id',
            'product_multiple_attribute_items.id AS attribute_item_id',
            'product_multiple_attribute_items.item_name AS attribute_item_name'));
        $this->db->from('product_multiple_attribute_items');
        $this->db->join('n_attribute_items', 'n_attribute_items.attribute_item_id=product_multiple_attribute_items.id', 'left');
        $this->db->join('product_multiple_attributes', 'product_multiple_attributes.id=product_multiple_attribute_items.product_attribute_id', 'left');
        $this->db->join('n_attributes', "n_attributes.neighbor_id=$neighbor_id AND n_attributes.attribute_id=product_multiple_attributes.id", 'left');
        // $this->db->where('n_attributes.neighbor_id', $neighbor_id);
        $this->db->order_by('product_multiple_attributes.id');
        $this->db->order_by('product_multiple_attribute_items.item_name');
        $data = $this->db->get()->result_array();
        $result = [];
        $result[0] = $this->sizesFull($neighbor_id);
        foreach ($data as $item) {
            $attribute_id = $item['attribute_id'];
            if (!array_key_exists($attribute_id, $result)) {
                $result[$attribute_id] = [];
            }

            $result[$attribute_id][] = $item;
        }
        // pr($this->db->last_query());
        // exit(0);
        return $result;
    }

    public function saveAttributes($attributesOrg, $attributesNew)
    {
        if (count($attributesOrg) > 0) {
            $this->db->update_batch('n_attributes', $attributesOrg, 'id');
        }

        if (count($attributesNew) > 0) {
            $this->db->insert_batch('n_attributes', $attributesNew);
        }

    }

    public function deleteAttribute($neighbor_id, $attribute_id)
    {
        $this->db->trans_start();
        $this->db->delete('n_attribute_items', array('attribute_id' => $attribute_id));
        $this->db->delete('n_attributes', array('id' => $attribute_id, 'neighbor_id' => $neighbor_id));
        $this->db->trans_complete();
    }

    public function deleteAttributeItem($neighbor_id, $attribute_id, $attribute_item_id)
    {
        $this->db->delete('n_attribute_items', array('id' => $attribute_item_id, 'attribute_id' => $attribute_id));
    }

    public function saveAttributeItems($itemsOrg, $itemsNew)
    {
        if (count($itemsOrg) > 0) {
            $this->db->update_batch('n_attribute_items', $itemsOrg, 'id');
        }

        if (count($itemsNew) > 0) {
            $this->db->insert_batch('n_attribute_items', $itemsNew);
        }

    }

    public function attributeUpDown($attribute_id, $offset)
    {
        $this->db->set('`index`', "`index`+($offset)", false);
        $this->db->where('id', $attribute_id);
        $this->db->update('n_attributes');
        $this->db->query("UPDATE n_attributes target
            JOIN
            (
                SELECT id, (@rownumber := @rownumber + 1) AS rownum
                FROM n_attributes
                CROSS JOIN (SELECT @rownumber := 0) r
                ORDER BY `index` ASC, updated_at DESC
            ) source ON target.id = source.id
            SET `index` = rownum * 2");
    }

    public function attributeItemUpDown($attribute_item_id, $offset)
    {
        $this->db->set('`index`', "`index`+($offset)", false);
        $this->db->where('id', $attribute_item_id);
        $this->db->update('n_attribute_items');
        $this->db->query("UPDATE n_attribute_items target
            JOIN
            (
                SELECT id, (@rownumber := @rownumber + 1) AS rownum
                FROM n_attribute_items
                CROSS JOIN (SELECT @rownumber := 0) r
                ORDER BY `index` ASC, updated_at DESC
            ) source ON target.id = source.id
            SET `index` = rownum * 2");
    }
}
