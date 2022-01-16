<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends Admin_Controller
{
	public $class_name='';

	function __construct()
	{
		parent::__construct();
		$this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
		$this->data['class_name']= $this->class_name;
	}

	function getCategoryDropDownListByAjax($menu_id=null){
	    $this->load->model('Category_Model');
        //$menu_id=$this->input->get('menu_id');
		$options='<option value="">Select Category</option>';
		if(!empty($menu_id)){
		    $categoryList=$this->Category_Model->getCategoryDropDownList($menu_id);
			foreach($categoryList as $key=>$val){
				$options .='<option value="'.$key.'">'.$val.'</option>';
			}
		}
		echo $options; exit();
	}

	function getSubCategoryDropDownListByAjax($category_id=null)
	{
			$this->load->model('SubCategory_Model');
			$options = '<option value="">Select Sub Category</option>';

			if ($category_id) {
					$categoryList = $this->SubCategory_Model->getSubCategoryDropDownList(null, $category_id);
					foreach ($categoryList as $key => $val) {
							$options .='<option value="'.$key.'">'.$val.'</option>';
					}
			}

			echo $options; exit();
	}

    function getPrinterSeriesListByAjax($printer_brand_id=null){
	    $this->load->model('Printer_Model');
		$options='<option value="">Select Printer Series</option>';
		if(!empty($printer_brand_id)){
		    $categoryList=$this->Printer_Model->getPrinterSeriesListById($printer_brand_id);
			foreach($categoryList as $key=>$val){
				$options .='<option value="'.$val['id'].'">'.$val['name'].'</option>';
			}
		}
		echo $options; exit();
	}
	function getProductDropDownListByAjax($menu_id=null){
	    $this->load->model('Product_Model');
		$options='<option value="">Select Product Name</option>';
		if(!empty($menu_id)){
		    $productList=$this->Product_Model->getProductDropDownList($menu_id);

			foreach($productList as $key=>$val){
				$options .='<option value="'.$key.'">'.$val.'</option>';
			}
		}
		echo $options; exit();
	}

	function removeProductImage(){
	    $this->load->model('ProductImage_Model');
		$this->load->model('Product_Model');
		$product_id=$this->input->post('product_id');
		$image_id=$this->input->post('id');
		$imageName=$this->input->post('image_name');

        if($this->ProductImage_Model->deleteProductImageById($image_id)){
			$ProductImages=$this->ProductImage_Model->getProductImageDataByProductId($product_id);
			if(!empty($ProductImages)){
				$product_main_image=isset($ProductImages[0]) ? $ProductImages[0]:'';
				$postData=array('id'=>$product_id,'product_image'=>$product_main_image['image']);
				$this->Product_Model->saveProduct($postData);
			}
			if(file_exists(PRODUCT_IMAGE_SMALL_BASE_PATH.$imageName))
		        unlink(PRODUCT_IMAGE_SMALL_BASE_PATH.$imageName);

			if(file_exists(PRODUCT_IMAGE_MEDIUM_BASE_PATH.$imageName))
				unlink(PRODUCT_IMAGE_MEDIUM_BASE_PATH.$imageName);

			if(file_exists(PRODUCT_IMAGE_LARGE_BASE_PATH.$imageName))
				unlink(PRODUCT_IMAGE_LARGE_BASE_PATH.$imageName);

			if(file_exists(PRODUCT_IMAGE_BASE_PATH.$imageName))
			    unlink(PRODUCT_IMAGE_BASE_PATH.$imageName);
			echo 1; exit();
		}else{
			echo 0; exit();
		}
	}

	function getSubCategoryAndProductDropDownListByAjax($category_id=null){
		$this->load->model('Product_Model');
		$json=array();
		$productList=$Sub_Carray_List=array();
		if(!empty($category_id)){
		    $List=$this->Product_Model->getActiveSubCategoryAndProductListBycategoryId($category_id);
			$Sub_Carray_List=$List['sub_categories'];
			$productList=$List['products'];
			#pr($List);
		}
		$options='<option value="">Select Sub Category</option>';
		foreach($Sub_Carray_List as $key=>$val){
				$options .='<option value="'.$val['id'].'">'.$val['name'].'</option>';
		}

		$json['sub_category']=$options;

		$options='<option value="">Select Product </option>';

	    foreach($productList as $key=>$val){
				$options .='<option value="'.$val['id'].'">'.$val['name'].'</option>';
		}
		$json['product_list']=$options;
		echo json_encode($json);
		exit();
	}

	function getActiveProductDropDownListByAjax($sub_category_id=null){
		$this->load->model('Product_Model');
		$json=array();
		$productList=$Sub_Carray_List=array();
		if(!empty($sub_category_id)){
		    $List=$this->Product_Model->getActiveProductListBySubCategoryId($sub_category_id);
			$productList=$List;
			#pr($List);
		}
		$options='<option value="">Select Product </option>';
	    foreach($productList as $key=>$val){
				$options .='<option value="'.$val['id'].'">'.$val['name'].'</option>';
		}
		$json['product_list']=$options;
		echo json_encode($json);
		exit();
	}
}
