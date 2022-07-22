<?php

Class Personalise_Model extends MY_Model {
    public $table='product_personalise';

      public function savePersonalise($data) {
        //print_r($data);die;
        $color=$data['color'];
        $writeown=$data['writeown'];
        $paragraph_char=$data['paragraph_char'];
        $productId=$data['productId'];
        $textfield=json_encode($data['textfield']);

        $paragraph=json_encode($data['paragraph']);
        $total_upload_image=$data['total_upload_image'];
        //$newdata=array('product_Id'=>$productId,'text_field'=>$textfield,'paragraph'=>$paragraph,'image_upload'=>$total_upload_image,'color'=>$color);
        //print_r($newdata);die;

        $id=isset($data['productId']) ? $data['productId']:'';
       $chk=$this->db->query("select * from product_personalise where product_Id='".$id."'")->num_rows();

        if($chk>0){
            //$this->db->where('id', $id);
            $query = $query=$this->db->query("UPDATE product_personalise SET color = '".$color."', text_field = '".$textfield."', paragraph='".$paragraph."',image_upload='".$total_upload_image."',writeown_paragraph_char='".$paragraph_char."',writeown='".$writeown."' WHERE product_Id='".$id."'");
            //echo $str = $this->db->last_query();die;
            if ($query) {
               return $id;
            } else {
                return 0;
            }
        }else{
            $query=$this->db->query("INSERT INTO `product_personalise` (`product_Id`, `color`, `text_field`, `paragraph`, `image_upload`,writeown_paragraph_char,writeown) VALUES ('".$productId."', '".$color."','".$textfield."','".$paragraph."','".$total_upload_image."','".$paragraph_char."','".$writeown."')");

            if ($query) {
               return $insert_id = $this->db->insert_id();
            } else {
                return 0;
            }
        }
    }

    public function getdatabyid($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('product_Id'=>$id));
        $query = $this->db->get();
        $data=(array)$query->row();
        return $data;
    }
}
