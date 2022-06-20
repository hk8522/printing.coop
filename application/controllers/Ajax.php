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

        echo $options;
        exit();
    }

    function getSubCategoryDropDownListByAjax($menu_id=null,$category_id=null){
        $this->load->model('SubCategory_Model');
        //$menu_id=$this->input->get('menu_id');
        $options='<option value="">Select Sub Category</option>';
        if(!empty($menu_id) && !empty($category_id)){
            $categoryList=$this->SubCategory_Model->getSubCategoryDropDownList($menu_id,$category_id);

            foreach($categoryList as $key=>$val){
                $options .='<option value="'.$key.'">'.$val.'</option>';
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

    function removeProductImage($product_id,$image_id=null,$imageName=null){
        $this->load->model('ProductImage_Model');
        $this->load->model('Product_Model');
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
}
