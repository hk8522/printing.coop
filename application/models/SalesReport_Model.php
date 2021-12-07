<?php

Class SalesReport_Model extends MY_Model {
	
	public $table='sales_reports';
	public $config = array(
        array(
                'field' => 'csv_file',
                'label' => 'csv file',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Select csv file',
                ),
        )
    );
	
	public function getList($limit,$start) {
		
        $this->db->select(array('*'));
		$this->db->from($this->table);
		$this->db->order_by('start_date','asc');
		$this->db->limit($limit, $start);
        $query = $this->db->get();
		$data=$query->result_array();
        //print_r($this->db->last_query());		
		return $data;
		
    }
	
	public function getCount() {
		
        $this->db->select(array('*'));
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->num_rows(); 
		return $data;
		
    }
	
	public function getSearchList($StartDate=null,$EndDate=null,$CampaignName=null,$keywords=null) {
		
        $this->db->select(array('*'));
		$this->db->from($this->table);
		if(!empty($StartDate) && !empty($EndDate) && !empty($CampaignName) && !empty($keywords)){
			
			$this->db->where("start_date >='".$StartDate."'");
			$this->db->where("end_date <='".$EndDate."'");
			$CampaignName=trim($CampaignName);
			$this->db->like('campaign_name',$CampaignName);
			
			if($keywords=='0-impressions'){
				
			    $this->db->where("spend !='$ 0.00'");
                $this->db->where("impressions ='0'");				
			}
			
		}
		$this->db->order_by('start_date','asc');
        $query = $this->db->get();
		$data=$query->result_array();
		$temp=array();
		$top=array();
		$bottom=array();
		if(!empty($data)){
			
			foreach($data as $key=>$val){
				
			    $spend=trim(str_replace("$","",$val['spend']));
                $ACOS=trim(str_replace("%","",$val['total_advertising_cost_of_sales']));
                $CTR=trim(str_replace("%","",$val['click_thru_rate']));
                $CR=trim(str_replace("%","",$val['7_day_conversion_rate']));
                $clicks=trim($val['clicks']);
				$revenue=trim(str_replace("$","",$val['7_day_total_sales']));
				$Unitssold=trim($val['7_day_total_units']);
				
				if($keywords=='0-impressions' || $keywords=='spend'){
					
				    $totalSum= (double)$spend+(double)$ACOS+(double)$CTR+(int)$clicks+(double)$revenue+(int)$Unitssold;
				}else if($keywords=='revenue'){
					
					$totalSum= (double)$revenue+(int)$Unitssold;
				}
				
				$val['totalSum']=$totalSum;
				$temp[$key]=$val;
			}
			
			usort($temp, function($a, $b) {
              //return $a['totalSum'] <=> $b['totalSum'];
			  return $a['totalSum'] <= $b['totalSum'];
            });
			
			if(count($temp) <=5){
				
				$top=$temp;
				
			}else if(count($temp) > 5){
				
				foreach($temp as $key=>$val){
					if($key <=4){
						
						$top[$key]=$val;
					}else{
						
						break;
					}
				}
				
				usort($temp, function($a, $b) {

			       return $a['totalSum'] <=> $b['totalSum'];
                });
				
				$loopCount=4;
				if(count($temp) ==6){
					$loopCount=0;
				} else if(count($temp) ==7){
                   $loopCount=1;
				}else if(count($temp) ==8){
                   $loopCount=2;
				}else if(count($temp) ==9){
                   $loopCount=3;
				}
				
				foreach($temp as $key=>$val){
					
					if($key <= $loopCount){
						
						$bottom[$key]=$val;
					}else{
						
						break;
					}
				}
				
			}
			
			$data=array_merge($top,$bottom);
		}
		
		//pr($data); die();
		return $data;
		
    }
	public function getDataById($id) {
		
        $this->db->select('*');
        $this->db->from($this->table);
		$this->db->where(array('id'=>$id));
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }
	public function save($data) {
		
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
	
	public function deleteRow($id) {
		
		$this->db->where('id',$id);
        $query = $this->db->delete($this->table);
		if ($query) {
            return 1;
		} else {
			return 0;
		}
		
    }
    
}
?>