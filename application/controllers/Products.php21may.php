<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Public_Controller
{
  public $class_name='';

  function __construct()
  {
      parent::__construct();
      $this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
  }

  public function index($category_id = null, $sub_category_id = null)
  {
	  
	  
      $this->load->model('Product_Model');
      $this->load->model('Category_Model');
      $this->load->model('SubCategory_Model');
      $this->data['category_id'] = '';
      $this->data['category_name'] = '';
	  $this->data['category_data'] = '';
      $this->data['sub_category_id'] = '';
      $this->data['sub_category_name'] = '';
	  $this->data['sub_category_data'] = '';
	  $title='Products';
      $category_id =     !empty($category_id) ? base64_decode($category_id) : 0;
	  $sub_category_id = !empty($sub_category_id) ? base64_decode($sub_category_id) : 0;
	  $url=base_url()."Products/";
	  
      if (isset($_GET['category_id'])) {
		  
          $category_id = base64_decode($_GET['category_id']);
		
      }
	  
	  if (isset($_GET['sub_category_id'])) {
		  
          $sub_category_id = base64_decode($_GET['sub_category_id']);
      }
	  
      if (!empty($category_id)) {
		  
          $this->data['category_id'] = $category_id;
          $data = $this->Category_Model->getCategoryDataById($category_id);
          $this->data['category_name'] = $data['name'];
		  $this->data['category_data'] = $data; 
		  $title.="/".ucfirst($data['name']);
		  $url .='?category_id='.base64_encode($category_id);
      }else{
		  $url .='?category_id=';
	  }
	  
      if (!empty($sub_category_id)) {
		  
          $this->data['sub_category_id'] = $sub_category_id;
          $data = $this->SubCategory_Model->getSubCategoryDataById($sub_category_id);
          $this->data['sub_category_name'] = $data['name'];
		  $this->data['sub_category_data'] = $data;
		  $title.="/".ucfirst($data['name']);
		  $url .='&sub_category_id='.base64_encode($sub_category_id);
      }else{
		  $url .='&sub_category_id=';
	  }
	  
	  $this->data['page_title'] = $title;
	  
      if (isset($_GET['sort_by'])) {
		  
          $sortBy = $_GET['sort_by'];
		  
      } else {
            $sortBy = 'name';	
      }
	  
	  $url .="&sort_by=".$sortBy;
	  
      $sortByOptions = getSortByDropdown();
      $sortByOptions = $sortByOptions[$sortBy] ?? '';
	  
      $order_by = $sortByOptions['order_by'] ?? '';
      $type = $sortByOptions['type'] ?? '';
      $this->data['order'] = $sortBy;
	  
	   $total=$this->Product_Model->getToatalActiveProduct($category_id,$sub_category_id);
	   
	    if (isset($_GET['pageno'])) {
			$pageno = $_GET['pageno'];
	    } else {
		    $pageno = 1;
	    }
	   
	   $no_of_records_per_page = 12;
	   $offset =($pageno-1) * $no_of_records_per_page; 
	   $total_pages = ceil($total / $no_of_records_per_page);
	   
	   $lists = $this->Product_Model->getActiveProductList($category_id,$sub_category_id,$order_by,$type,$offset,$no_of_records_per_page);
	   
	   
	    $prevPage=$pageno-1;
	    $NextPage=$pageno+1;
		
	    if($total_pages == $pageno){
			
		   $NextPage='';
	    }
	    if($pageno ==1){
		   
		   $prevPage='';
	    }
		
		
		$this->data['url']      = $url;
        $this->data['total']    = $total;
        $this->data['NextPage'] = $NextPage;
        $this->data['prevPage'] = $prevPage;
		
        $this->data['lists']=$lists;
        foreach ($lists as $key => $list) {
		  
          $this->data['lists'][$key]['category'] = $this->Category_Model->getCategoryDataById($list['category_id']);
		  
        } 
      $this->render($this->class_name.'index');
  }
  
  public function view($id = null)
  {
      if (empty($id)) {
        redirect('/');
      }

      $id = base64_decode($id);
      $this->load->model('Product_Model');
      $this->load->model('ProductImage_Model');
      $this->data['page_title'] = 'Product Details';
      $Product = $this->Product_Model->getProductList($id);
      $ProductDescriptions=$this->Product_Model->getProductDescriptionById($id);
      if (!$Product) {
          redirect('/');
      }

      $ProductImages = $this->ProductImage_Model->getProductImageDataByProductId($id);
      $this->data['ProductImages'] = $ProductImages;
      $this->data['Product'] = $Product;
	  $this->data['ProductDescriptions'] = $ProductDescriptions;
	  $ProductAttributes=$this->Product_Model->getProductAttributesByItemIdFrontEnd($id);
	  $this->data['ProductAttributes']=$ProductAttributes;
      //$this->data['ratings'] = $this->Product_Model->getRatings($id);

      $total_items = $this->cart->total_items();
      $productRowid = '';
      $productQty = 0;

      if ($total_items > 0) {
		  
        $carts = $this->cart->contents();
        foreach ($carts as $rowid =>$cart) {
            if ($cart['id'] == $Product['id']) {
                $productQty = $cart['qty'];
                $productRowid = $rowid;
                break;
            }
        }
      }

      $this->data['productRowid'] = $productRowid;
      $this->data['productQty'] = $productQty;
      $this->render($this->class_name.'view');
  }
  public function personailise($id=null) {



	if(empty($id)){

		redirect('/Homes');
	}

	$id=base64_decode($id);
	$this->load->model('Product_Model');
	$this->load->model('ProductImage_Model');
	$this->data['page_title']='Product Detels';
	$Product=$this->Product_Model->getProductList($id);
	if(empty($Product)){
		redirect('/Homes');
	}
	$ProductImages=$this->ProductImage_Model->getProductImageDataByProductId($id);
    $this->data['ProductImages']=$ProductImages;
	$this->data['Product']=$Product;
	$this->data['ratings']=$this->Product_Model->getRatings($id);
	$total_items=$this->cart->total_items();
	$productRowid='';
	$productQty=0;
	if($total_items > 0){

		$carts=$this->cart->contents();
		foreach($carts as $rowid=>$cart){

			if($cart['id'] ==$Product['id']){

				$productQty=$cart['qty'];
				$productRowid=$rowid;
				break;
			}
		}
	}
	$this->data['productRowid']=$productRowid;
	$this->data['productQty']=$productQty;
	$this->render($this->class_name.'personailise');



  }

   public function searchProduct()
   {
		$searchtext=$this->input->post('searchtext');
        if($searchtext !=''){

			$this->load->model('Product_Model');
		    $lists=$this->Product_Model->getProductSearchList($searchtext);
			//pr($lists,1);
			$search_reslut='';
			if(!empty($lists)){

				foreach($lists as $list){

				   $url=base_url()."Products/view/".base64_encode($list['id']);
				   $name=ucfirst($list['name']);
				   $imageurl = getProductImage($list['product_image'], 'medium');
				   //$search_reslut.='<li><i class="fas fa-search"></i><a href="'.$url.'">'.$name.'</a></li>';
				   
				   $search_reslut.='<li><img src="'.$imageurl.'" width="50"><a href="'.$url.'">'.$name.'</a></li>';
				}

			}else{

			 $search_reslut='<li><i class="fas fa-search"></i><a href="javascript:void(0)">product not found</a></li>';
						}
		}else{

			echo $search_reslut='<li><i class="fas fa-search"></i><a href="javascript:void(0)">product not found</a></li>';

		}
       echo $search_reslut;
    }

	public function addRating()
  {
      $this->load->model('Product_Model');
      $this->load->library('form_validation');
			$rules = $this->Product_Model->ratingRules;
			$this->form_validation->set_rules($rules);

      $response = [
					'status' => 'success',
					'msg'    => '',
					'errors' => [],
			];

      if ($this->form_validation->run() == FALSE) {
					$response['status'] = 'error';
					$response['errors'] = $this->form_validation->error_array();
			} else {
          $name = $this->input->post('name');
          $rate = $this->input->post('rate');
          $review = $this->input->post('review');
          $product_id  = $this->input->post('product_id');
          $postData = [];
          $postData['name'] = $name;
          $postData['rate'] = $rate;
          $postData['review'] = $review;
          $postData['product_id'] = $product_id;
          $postData['user_id'] = $this->loginId;

          if (!$this->Product_Model->CheckRatingByUserIdAndProductId($this->loginId, $product_id)) {
            if ($this->Product_Model->saveRating($postData)) {
                $data = $this->Product_Model->getTotalSumAvgReting($product_id);
                $PdoductSaveData['rating'] = ceil($data['avg']);
                $PdoductSaveData['reviews'] = $data['total'];
                $PdoductSaveData['id'] = $product_id;
                $this->Product_Model->saveProduct($PdoductSaveData);
                $response['msg'] = 'Your review posted successfully.';
            } else {
                $response['status'] = 'error';
                $response['msg'] = 'Your review posted unsuccessfully.';
            }
          } else {
              $response['status'] = 'error';
              $response['msg'] = 'You have already add review on this product.';
          }
      }

      echo json_encode($response);
	}
   
	function emailSubscribe()
  {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

      $this->load->model('Product_Model');

      $response = [
          'status' => 'error',
          'msg'    => '',
          'errors' => [],
      ];

      if ($this->form_validation->run() == FALSE) {
					$response['errors'] =  $this->form_validation->error_array();
			} else {
          $postData = [];
          $postData['email'] = $this->input->post('email');
          if ($this->Product_Model->saveSubscribeEmail($postData)) {
              $response['status'] = 'success';
              $response['msg'] = 'Your email id subscribe successfully.';
          } else {
              $response['msg']='Your review posted unsuccessfully.';
          }
      }

      echo json_encode($response);
	}
	
	 function calculatePrice()
     {
		
	   
	   $product_id=$this->input->post('product_id');
	   $price=$this->input->post('price');
	   $quantity=$this->input->post('quantity');
	   $quantity=!empty($quantity) ? $quantity:1;
	   $ProductAttributes=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);
	   //pr($_POST);
	   foreach($ProductAttributes as $key=>$val){
		   
		   $attribute_name='attribute_id_'.$key;
		   $attribute_item_id=isset($_POST[$attribute_name]) ? $this->input->post($attribute_name):'';
		   $items=$val['items'];
		   
		   if(!empty($attribute_item_id) && array_key_exists($attribute_item_id,$items)){
			    
			    $extra_price=$items[$attribute_item_id]['extra_price'];
			    $price += $extra_price;
		   }
	   }
	   
	   $response=array();
	   $response['success'] = 1;
	   $price=$price*$quantity;
	   $response['price']=number_format($price,2);
       echo json_encode($response);
	   exit(0);
	   
	}
	
   function uploadImage(){
	   
	    #unset($_SESSION['product_id']); die();
	    $product_id=$_POST['product_id'];
	   /* Getting file name */
		$filename =$_FILES['file']['name'];
		/* Getting File size */
		$filesize = $_FILES['file']['size'];
		/* Location */
		$newfileName="cart-image/".time().'-'.$filename;
		$location =FILE_UPLOAD_BASE_PATH."cart-image/".time().'-'.$filename;
		$return_arr = array();
		$session_data=array();
		/* Upload file */
		$data=array();
		if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
			
			$src = DEFAULT_IMAGE_URL."default.png";
			// checking file is image or not
			if(is_array(getimagesize($location))){
				
				$src=FILE_UPLOAD_BASE_URL.$newfileName;
			}
			
			$range=range(1,5000);
			$key=array_rand($range);
			$return_arr = array("name" => $filename,"size" => $filesize, "src"=> $src,'skey'=>$key,'product_id'=>$product_id,'location'=>$location,'cumment'=>'');
			
			$_SESSION['product_id'][$product_id][$key]=$return_arr;
			
			$data['return_arr']=$return_arr;
		}
		
		$html=$this->load->view('Ajax/file_data',$data,true);
		
		$return_arr['html']=$html;
		
		echo json_encode($return_arr);
		
		
		
		
  }
  
  function updateCumment(){
	   
	   $product_id=$_POST['product_id'];
	   $skey=$_POST['skey'];
	   $cumment=$_POST['cumment'];
	   
	   if(isset($_SESSION['product_id'][$product_id])){
		   
		  $_SESSION['product_id'][$product_id][$skey]['cumment']=$cumment;
	   }
       exit(0);	   
      //echo json_encode($return_arr);
  }
  
  function deleteImage(){
	  
	   $product_id=$_POST['product_id'];
	   $skey=$_POST['skey'];
	   $location=$_POST['location'];
	   if(isset($_SESSION['product_id'][$product_id])){
		   
		  unset($_SESSION['product_id'][$product_id][$skey]);
		  
		  /*if(file_exists($location)){
			  
			  unlink($location);
		  }*/
	   }
       exit(0);	   
      //echo json_encode($return_arr);
  }
  
  public function saveEstimate()
  {
      $this->load->library('form_validation');
      $this->load->model('Estimate_Model');
      $rules = $this->Estimate_Model->rules;
      $this->form_validation->set_rules($rules);

      $response = [
				'status' => 'success',
				'msg'    => '',
				'errors' => [],
			];

      if ($this->form_validation->run() == FALSE) {
          $response['status'] = 'error';
          $response['errors'] = $this->form_validation->error_array();
      } else {
          $postData['contact_name'] = $this->input->post('contact_name');
          $postData['company_name'] = $this->input->post('company_name');
          $postData['email'] = $this->input->post('email');
          $postData['phone_number'] = $this->input->post('phone_number');
          $postData['street'] = $this->input->post('street');
          $postData['city'] = $this->input->post('city');
          $postData['province'] = $this->input->post('province');
          $postData['country'] = $this->input->post('country');
          $postData['postal_code'] = $this->input->post('postal_code');
          $postData['product_type'] = $this->input->post('product_type');
          $postData['product_name'] = $this->input->post('product_name');
          $postData['same_quote_request'] = $this->input->post('same_quote_request');
          $postData['qty_1'] = $this->input->post('qty_1');
          $postData['qty_2'] = $this->input->post('qty_2');
          $postData['qty_3'] = $this->input->post('qty_3');
          $postData['more_qty'] = $this->input->post('more_qty');
          $postData['flat_size'] = $this->input->post('flat_size');
          $postData['finish_size'] = $this->input->post('finish_size');
          $postData['paper_stock'] = $this->input->post('paper_stock');
          $postData['no_of_sides'] = $this->input->post('no_of_sides');
          $postData['folding'] = $this->input->post('folding');
          $postData['total_versions'] = $this->input->post('total_versions');
          $postData['shipping_methods'] = $this->input->post('shipping_methods');
          $postData['notes'] = $this->input->post('notes');

          if ($this->Estimate_Model->saveEstimateData($postData)) {
              $response['msg'] = 'Thank you for contacting printing coop we have received your estimation query our representative will get back to you within 24 hours';
          } else {
              $response['status'] = 'error';
              $response['msg'] = 'Your Estimate Not Save Please Try Again.';
          }
      }

      echo json_encode($response);
  }
}
