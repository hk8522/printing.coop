<?php

Class ProductImage_Model extends MY_Model {

	public $table='product_images';

	public function getProductImageDataByProductId($product_id) {

        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('product_id'=>$product_id));
        $query = $this->db->get();
		$data=(array)$query->result_array();
		return $data;

    }

	public function saveProductImage($data,$product_id) {

		if(empty($data)){
			return true;
		}
        $this->db->where('product_id', $product_id);
        $this->db->delete($this->table);
		$query=$this->db->insert_batch($this->table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

	public function deleteProductImageById($id) {

        $this->db->where('id',$id);
		if ($this->db->delete($this->table)) {
			return true;
		} else {
			return false;
		}

    }

	public function deleteProductImageByProductId($product_id) {

        $this->db->where('product_id', $product_id);
        if ($this->db->delete($this->table)) {
            return true;
        } else {
            return false;
        }
    }

}
?>