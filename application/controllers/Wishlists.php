<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wishlists extends Public_Controller
{
	public $class_name='';
	function __construct()
	{
		parent::__construct();
		$this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
		
        if(empty($this->loginId)){

			redirect('Logins');
		}
		
	}
	
	public function index()
	{  
                $this->load->model('User_Model');
		$this->data['page_title']='Wishlists';
		$wishlists=$this->User_Model->getWishlistList($this->loginId);
		$this->data['wishlists']=$wishlists;
		$this->render($this->class_name.'index');
	}
	
	public function addByAjax()
	{  
        $json=array('status'=>0,'msg'=>'');
		$this->load->model('Product_Model');
		$this->load->model('User_Model');
		$product_id=$this->input->post('product_id');
		$productData=$this->Product_Model->getProductDataById($product_id);
		if(!empty($productData)){
			
			$count=$this->User_Model->geWishlistCount($this->loginId,$product_id);
			if($count==0){
				
				$data=array();
				$data['user_id']=$this->loginId;
				$data['product_id']=$product_id;
			   	$this->User_Model->saveWishlist($data);
				$count=$this->User_Model->geWishlistCount($this->loginId);
			    $json['status']=1;
			    $json['count'] =$count;
				 $json['msg']=ucfirst(strtolower($productData['name'].' is added to your wishlist list.'));
			}else{
				
				$json['msg'] ='This product is already added in your wishlist.';
			}
			
			
			
			
		}else{
			$json['msg'] ='Product does not exist';
		}
		
		echo json_encode($json);
	}
	
	public function deleteWishlist()
    {	 
	    
		$id=$this->input->post('wishlist_id');
		$json=array('status'=>0,'msg'=>'');
		
        if(!empty($id)){
			
				$page_title='Product Remove From Wishlist';
				$this->load->model('User_Model');
				if ($this->User_Model->deleteWishlist($id))
				{   
			        
				    //$this->session->set_flashdata('message_success',$page_title.' Successfully.');
					//redirect('Wishlists');
					$count=$this->User_Model->geWishlistCount($this->loginId);
					$json=array('status'=>1,'msg'=>$page_title.' Successfully.','count'=>$count);
				}
				else
				{
				    //$this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
					$json=array('status'=>0,'msg'=>$page_title.' unsuccessfully.');
				}
		}
		echo json_encode($json);
    }
	
	
}
?>