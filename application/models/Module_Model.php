<?php

Class Module_Model extends MY_Model {

	public $table='module';
	
    public function getModuleList(){ 
	
        $this->db->select('*');
        $this->db->from('module');
		$this->db->where('status','1');
		$this->db->order_by('order','asc');
        $query = $this->db->get();
		$data=$query->result_array();
		$dataNew=array();
		#$this->db->last_query(); 
		
		foreach($data as $key=>$val){
			
			$id=$val['id'];
			$this->db->select('*');
            $this->db->from('sub_module');
		    $this->db->where('module_id',$id);
			$this->db->where('status','1');
		    $this->db->order_by('order','asc');
            $query = $this->db->get();
		    $attribute_items=$query->result_array();
			$attribute_items_new=array();
			#$this->db->last_query(); 
			#pr($attribute_items);
			foreach($attribute_items as $key1=>$val1){
				
				 $attribute_items_new[$val1['id']]=$val1['sub_module_name']; 
			}
			
			$dataNew[$val['id']]=array('name'=>$val['module_name'],'items'=>$attribute_items_new);
			
			
		}
		#pr($dataNew);
		return $dataNew;

    }
	
	public function getAdminModuleByAdminId($id=null) {
		
		$data_new=array();
		if(!empty($id)){
			
			$this->db->select('*');
			$this->db->from('admin_module');
			$this->db->where('admin_id',$id);
			$query = $this->db->get();
			$data=$query->result_array();
			$data_new=array();
			
			foreach($data as $key=>$val){
				
				$module_id=$val['module_id'];
				$this->db->select('*');
				$this->db->from('admin_sub_module');
				$this->db->where(array('admin_id'=>$id,'module_id'=>$module_id));
				$query = $this->db->get();
				$items=$query->result_array();
				$attribute_items_new=array();
			       foreach($items as $key1=>$val1){
				
				      $attribute_items_new[$val1['sub_module_id']] =$val1;
				 
			       }
				   
				   $data_new[$module_id]['data']=$val;
				   $data_new[$module_id]['items']=$attribute_items_new;
				
			}
		}
		return $data_new;
    }
	
	public function getMainModuleByAdminId($id=null,$role='admin') {
		
		$module=array();
		if($role !='admin'){
			
			if(!empty($id)){
				
				$this->db->select('*');
				$this->db->from('admin_module');
				$this->db->where('admin_id',$id);
				$query = $this->db->get();
				$data=$query->result_array();
				foreach($data as $key=>$val){
					
					$module_id=$val['module_id'];
					$module[]=$module_id;
				}		
			}
		}else{
			
			    $this->db->select('*');
				$this->db->from('module');
				$query = $this->db->get();
				$data=$query->result_array();
				foreach($data as $key=>$val){
					
					$module_id=$val['id'];
					$module[]=$module_id;
				}
		}
		return $module;
    }
	
	public function getSubModuleByAdminId($id=null,$role='admin') {
		
		$submodule=array();
		if($role !='admin'){
			
			if(!empty($id)){
				
				$this->db->select('*');
				$this->db->from('admin_sub_module');
				$this->db->where('admin_id',$id);
				$query = $this->db->get();
				$data=$query->result_array();
				foreach($data as $key=>$val){
					
					$sub_module_id=$val['sub_module_id'];
					$submodule[]=$sub_module_id;
				}		
			}
		}else{
			
			    $this->db->select('*');
				$this->db->from('sub_module');
				$query = $this->db->get();
				$data=$query->result_array();
				foreach($data as $key=>$val){
					
					$sub_module_id=$val['id'];
					$submodule[]=$sub_module_id;
				}
		}
		return $submodule;
    }
	
	public function getAllModuleList(){ 
	
        $this->db->select('*');
        $this->db->from('module');
		$this->db->where('status','1');
		$this->db->order_by('order','asc');
        $query = $this->db->get();
		$data=$query->result_array();
		$dataNew=array();
		
		foreach($data as $key=>$val){
			
			$id=$val['id'];
			$this->db->select('*');
            $this->db->from('sub_module');
		    $this->db->where('module_id',$id);
			$this->db->where('status','1');
		    $this->db->order_by('order','asc');
            $query = $this->db->get();
		    $attribute_items=$query->result_array();
			$attribute_items_new=array();
			#$this->db->last_query(); 
			#pr($attribute_items);
			foreach($attribute_items as $key1=>$val1){
				
				 $attribute_items_new[$val1['id']]=$val1; 
			}
			$dataNew[$val['id']]=array('module'=>$val,'sub_module'=>$attribute_items_new);
		}
		#pr($dataNew);
		return $dataNew;
    }
	
	function getSubModuleIdByUrl($url){
		
		 $id=0;
	     $url_data=explode("/",$url);
		 $class=isset($url_data[0]) ? $url_data[0]:'';
		 $action=isset($url_data[1]) ? $url_data[1]:'index';
		 $prem=isset($url_data[2]) ? $url_data[2]:'';
		 #pr($url_data);
		 if($class){
			 
			$mainurl= $class."/".$action;
			if(!empty($prem)){
				
				$mainurl= $mainurl."/".$prem;
			}
			$this->db->select('*');
            $this->db->from('sub_module');
		    $this->db->where('url',$mainurl);
			$this->db->where('status','1');
			$query = $this->db->get();
			$row=$query->row();
			#echo $this->db->last_query(); 
			$id=isset($row->id) ? $row->id:'';
			#die();
		 }
		 
		 return $id;
	}
	
}

?>
