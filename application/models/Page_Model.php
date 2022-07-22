<?php

Class Page_Model extends MY_Model {
    public $table='pages';
    public $config = array(
        array(
                'field' => 'main_store_id',
                'label' => 'Website',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Select Website',
                ),
        ),
        array(
                'field' => 'title',
                'label' => 'name',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Enter page name',
                ),
        ),
        array(
                'field' => 'shortOrder',
                'label' => 'Page Order',
                'rules' => 'integer',
                'errors' => array(
                        'integer' => 'Page order value allowed only number',
                ),
        )
    );

    public function getPageList($active = null,$display_on_top_menu=null,$display_on_footer=null,$display_on_footer_last_menu=null,$website_store_id=null){
        $this->db->select(array('Page.*'));
        $this->db->from($this->table.' as Page');
        if ($website_store_id) {
            $this->db->where('Page.main_store_id',$website_store_id);
        }
        if ($active) {
            $this->db->where('Page.status',1);
        }

        if($display_on_footer){
             $this->db->where('display_on_footer',1);
        }

        if($display_on_top_menu){
             $this->db->where('display_on_top_menu',1);
        }

        if($display_on_footer_last_menu){
             $this->db->where('display_on_footer_last_menu',1);
        }

        $this->db->order_by('shortOrder','asc');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function getActivePageListByCategoryId($category_id) {
        $this->db->select(array('Page.*'));
        $this->db->from($this->table.' as Page');
        $this->db->where(array('Page.status'=>1,'Page.category_id'=>$category_id));
        $this->db->order_by('Page.shortOrder','asc');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }

    public function getPageDataById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('id'=>$id));
        $query = $this->db->get();
        $data=(array)$query->row();
        return $data;
    }

    public function getPageDataBySlug($slug,$main_store_id=1) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('slug'=>$slug,'main_store_id'=>$main_store_id));
        $query = $this->db->get();
        $data=(array)$query->row();
        return $data;
    }
    public function checkPageSlug($slug,$main_store_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('slug'=>$slug,'main_store_id'=>$main_store_id));
        $query = $this->db->get();
        $data=(array)$query->row();
        return $data;
    }

    public function getSlug($title,$main_store_id){
        $slug=strtolower(str_replace(' ','-',$title));
        //$slug=preg_replace('/[^A-Za-z0-9\]/', '',$slug);
        $data=$this->checkPageSlug($slug,$main_store_id);
        if(!empty($data)){
            $slug=$slug.'-1';
        }
        return $slug;
    }

    public function savePage($data) {
        $id=isset($data['id']) ? $data['id']:'';

        if(!empty($id)){
            $data['updated']=date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $query = $this->db->update($this->table, $data);
        }else{
            $data['created']=date('Y-m-d H:i:s');
            $data['updated']=date('Y-m-d H:i:s');
            $query = $this->db->insert($this->table, $data);
        }

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePage($id) {
        $this->db->where('id',$id);
        $query = $this->db->delete($this->table);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getFooterPagesList($active = null)
        {
        $this->db->select(array('Page.*'));
        $this->db->from($this->table.' as Page');

        if($active){
             $this->db->where(array('Page.status'=>$active , 'display_on_footer' => 1));
        }
        $this->db->order_by('shortOrder','asc');
        $query = $this->db->get();
        $data=$query->result_array();
        return $data;
    }
}
