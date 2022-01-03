<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller
{
	public $class_name='';
	function __construct()
	{
		parent::__construct();
		$this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
		$this->data['class_name']= $this->class_name;
		$this->load->model('Personalise_Model');
	}

    public function index($discount_id=null)
    {

		$this->load->model('Personalise_Model');
		$this->load->model('Product_Model');
		$this->data['page_title'] = 'Products';
		$this->data['sub_page_title'] = 'Add New Product';
		$this->data['sub_page_url'] = 'addEdit';
		$this->data['sub_page_view_url'] = 'viewProduct';
		$this->data['sub_page_delete_url'] = 'deleteProduct';
		$this->data['sub_page_url_active_inactive'] = 'activeInactive';
		$lists=$this->Product_Model->getProductList('',$discount_id);
		$this->data['lists']=$lists;
		$this->render($this->class_name.'index');

    }

    public function viewProduct($id=null)
    {
		if(empty($id)){

			redirect('admin/Products');
		}
		$this->load->model('Product_Model');
		$this->data['page_title'] = 'Product Details';
		$this->data['main_page_url'] = '';
		$this->load->model('Product_Model');
		$this->load->model('ProductImage_Model');

		$ProductImages=$this->ProductImage_Model->getProductImageDataByProductId($id);
		$this->data['ProductImages']=$ProductImages;
		$Product=$this->Product_Model->getProductList($id);
		$this->data['Product']=$Product;
		$this->render($this->class_name.'view');

    }

    public function addEdit($id=null)
    {


        $this->load->helper('form');
		$this->data['page_title'] = $page_title = 'Add New Product';
		if(!empty($id)){
	       $this->data['page_title'] = $page_title = 'Edit Product';
		}
		$this->data['main_page_url'] = '';
		$this->load->model('Category_Model');
		$this->load->model('Menu_Model');
		$this->load->model('Product_Model');
		$this->load->model('SubCategory_Model');
		$this->load->model('ProductImage_Model');
        $this->load->model('Personalise_Model');
		$postData=array();
		$personalise=array();

		$postData=$this->Product_Model->getProductDataById($id);
		$personalise=$this->Personalise_Model->getdatabyid($id);
		$ProductImages=$this->ProductImage_Model->getProductImageDataByProductId($id);

		$menuList=$this->Menu_Model->getMenuDropDownList();
		$this->data['menuList']=$menuList;
		$brandList=$this->Product_Model->getBrandDropDownList();
		$this->data['brandList']=$brandList;

		$this->data['ProductImages']=$ProductImages;

		if($this->input->post()){

			$this->load->library('form_validation');
			$set_rules=$this->Product_Model->config;
			if(!empty($id)){

				$remove_index=count($set_rules)-1;
				unset($set_rules[$remove_index]);
			}
			$this->form_validation->set_rules($set_rules);
			$this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

			if(!empty($id)){

			   $postData['id']=$this->input->post('id');
			}

			$postData['name']=$this->input->post('name');
			$postData['menu_id']=$this->input->post('menu_id');
            $postData['category_id']=$this->input->post('category_id');
			$postData['sub_category_id']=$this->input->post('sub_category_id');
			$postData['price']=$this->input->post('price');
			$postData['short_description']=$this->input->post('short_description');
			$postData['full_description']=$this->input->post('full_description');
			$postData['is_today_deal']=!empty($this->input->post('is_today_deal')) ?
			$this->input->post('is_today_deal'):0;
			$postData['is_today_deal_date']=$this->input->post('is_today_deal_date');
			$postData['is_bestseller']=!empty($this->input->post('is_bestseller')) ?
			$this->input->post('is_bestseller'):0;
			$postData['is_featured']=!empty($this->input->post('is_featured')) ?
			$this->input->post('is_featured'):0;

			$postData['is_special']=!empty($this->input->post('is_special')) ?
			$this->input->post('is_special'):0;
		    $postData['is_stock']=!empty($this->input->post('is_stock')) ?
		    $this->input->post('is_stock'):0;
			$postData['total_stock']=$this->input->post('total_stock');

			$postData['is_bestdeal']=!empty($this->input->post('is_bestdeal')) ?
		    $this->input->post('is_bestdeal'):0;

			$postData['discount']=$this->input->post('discount');
			$postData['code']=$this->input->post('code');
			$postData['brand']=$this->input->post('brand');
			$postData['product_type']=$this->input->post('product_type');
			$postData['your_price']=$this->input->post('your_price');
			$postData['color']=$this->input->post('color');
			$postData['weight']=$this->input->post('weight');
			$postData['size']=$this->input->post('size');
			$postData['min_order_quantity']=$this->input->post('min_order_quantity');
			$postData['free_shipping']=$this->input->post('free_shipping');
			$postData['delivery_charge']=$this->input->post('delivery_charge');
			$uploadData=array();
			if($this->form_validation->run()===TRUE)
			{

				$saveData=true;
				$onefilesCount = $_FILES['files']['name'][0];
				if(!empty($onefilesCount)){
                    $filesCount = count($_FILES['files']['name']);
                    for($i = 0; $i < $filesCount; $i++){

						$_FILES['file']['name']     = $_FILES['files']['name'][$i];
						$_FILES['file']['type']     = $_FILES['files']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$_FILES['file']['error']     = $_FILES['files']['error'][$i];
						$_FILES['file']['size']     = $_FILES['files']['size'][$i];

						#File upload configuration
						#$uploadPath = './uploads/products';

						$config['upload_path'] = PRODUCT_IMAGE_BASE_PATH;
						$config['allowed_types'] = FILE_ALLOWED_TYPES;
						$config['max_size']= FILE_MAX_SIZE;

						#Load and initialize upload library
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						#Upload file to server
						if($this->upload->do_upload('file')){

						   #Uploaded file data
						   $fileData = $this->upload->data();
						   $uploadData[$i]['file_name'] = $fileData['file_name'];
						   $this->resizeImage($fileData['file_name'],'small');
						   $this->resizeImage($fileData['file_name'],'medium');
						   $this->resizeImage($fileData['file_name'],'large');

						}else{

							 $this->session->set_flashdata('file_message_error','maximum product image size allowed on only 1Mb');
							 $saveData=false;
							 break;

						}

                    }
			    }else {

					if(empty($id)){

						$this->session->set_flashdata('message_error','Select at least one images of Product');
						$saveData=false;
					}
				}

				if($saveData){

					$old_image=!empty($this->input->post('old_image')) ? $this->input->post('old_image') : array();
					$uploadDataNew=array();
					foreach($uploadData as $k=>$v){

						$uploadDataNew[]=$v['file_name'];

					}

					$uploadDataNew=array_merge($old_image,$uploadDataNew);

					$insert_id=$this->Product_Model->saveProduct($postData);
					if ($insert_id > 0)
					{

                        if($postData['product_type']==2){

						    $personalise['productId']=$insert_id;
							$personalise['color']=implode(",",$this->input->post('personial_color'));
							$personalise['textfield']=array('personial_title'=>$this->input->post('personial_title'),'personial_example'=>$this->input->post('personial_example'),'personial_character'=>$this->input->post('personial_character'));
							$personalise['paragraph']=array('writeown'=>$this->input->post('writeown'),'paragraph_char'=>$this->input->post('paragraph_char'),'paragraph_title'=>$this->input->post('paragraph_title'),'paragraph_character'=>$this->input->post('paragraph_character'),'paragraph_description'=>$this->input->post('paragraph_description'));
							$personalise['total_upload_image']=$this->input->post('total_upload_image');
							$personalise['paragraph_char']=$this->input->post('paragraph_char');
							$personalise['writeown']=$this->input->post('writeown');
							$personaliseid=$this->Personalise_Model->savePersonalise($personalise);
						}

						$data=array();
						foreach($uploadDataNew as $k=>$v){

							$sdata=array();
							$sdata['image']=$v;
							$sdata['created']=date('Y-m-d H:i:s');
	                        $sdata['updated']=date('Y-m-d H:i:s');
							$sdata['product_id']=$insert_id;
						    $data[]=$sdata;

						}

						if($this->ProductImage_Model->saveProductImage($data,$insert_id)){

							$product_main_image=isset($data[0]) ? $data[0]:'';
							$postData=array('id'=>$insert_id,'product_image'=>$product_main_image['image']);

						    $this->Product_Model->saveProduct($postData);
						}
						$this->session->set_flashdata('message_success',$page_title.' Successfully.');
						redirect('admin/Products');
					}
					else
					{
						$this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
					}
				}

			}else{

				$this->session->set_flashdata('message_error','Missing information.');
			}
		}

		$menu_id=isset($postData['menu_id']) ? $postData['menu_id']:'';
		$category_id=isset($postData['category_id']) ? $postData['category_id']:'';

		$categoryList=$this->Category_Model->getCategoryDropDownList($menu_id);
		$this->data['categoryList']=$categoryList;
		$subCategoryList=$this->SubCategory_Model->getSubCategoryDropDownList($menu_id,$category_id);
		$this->data['subCategoryList']=$subCategoryList;
	    $this->data['postData']=$postData;
        $this->data['personalise']=$personalise;
	    $this->render($this->class_name.'add_edit');


    }
    public function activeInactive($id=null,$status=null)
    {

        if(!empty($id) && ($status==1 || $status==0)){

			    $postData['id']=$id;
		        $postData['status']=$status;
				$page_title='Product Active';
				$this->load->model('Product_Model');
				if($status==0){
					$page_title='Product Inactive';
				}
				if ($this->Product_Model->saveProduct($postData))
				{

					$this->session->set_flashdata('message_success',$page_title.' Successfully.');

				}
				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{

			$this->session->set_flashdata('message_error','Missing information.');
	    }
		redirect('admin/Products');
    }

	public function deleteProduct($id=null)
    {

        if(!empty($id)){


				$page_title='Product Delete';
				$this->load->model('Product_Model');
				$this->load->model('ProductImage_Model');
				$productImageData=$this->ProductImage_Model->getProductImageDataByProductId($id);
				if ($this->Product_Model->deleteProduct($id))
				{

					$this->ProductImage_Model->deleteProductImageByProductId($id);

					foreach($productImageData as $key=>$data){

						$imageName=$data['image'];
					    if(file_exists(PRODUCT_IMAGE_SMALL_BASE_PATH.$imageName))
		                unlink(PRODUCT_IMAGE_SMALL_BASE_PATH.$imageName);
						if(file_exists(PRODUCT_IMAGE_MEDIUM_BASE_PATH.$imageName))
							unlink(PRODUCT_IMAGE_MEDIUM_BASE_PATH.$imageName);

						if(file_exists(PRODUCT_IMAGE_LARGE_BASE_PATH.$imageName))
							unlink(PRODUCT_IMAGE_LARGE_BASE_PATH.$imageName);

						if(file_exists(PRODUCT_IMAGE_BASE_PATH.$imageName))
							unlink(PRODUCT_IMAGE_BASE_PATH.$imageName);
				    }

					$this->session->set_flashdata('message_success',$page_title.' Successfully.');

				}
				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{

			$this->session->set_flashdata('message_error','Missing information.');
	    }
		redirect('admin/Products');
    }

	public function banners(){

        $this->load->model('Product_Model');
		$this->data['page_title'] = 'Home Page Banners';
		$this->data['sub_page_title'] = 'Add New Banner';
		$this->data['sub_page_url'] = 'addEditBanner';
		$this->data['sub_page_view_url'] = 'viewBanner';
		$this->data['sub_page_delete_url'] = 'deleteBanner';
		$this->data['sub_page_url_active_inactive'] = 'activeInactiveBanner';
		$lists=$this->Product_Model->getBannerList();
		$this->data['lists']=$lists;
		$this->render($this->class_name.'banners');

	}

	public function viewBanner($id=null)
    {
		if(empty($id)){

			redirect('admin/Products/banners');
		}
		$this->load->model('Product_Model');
		$this->data['page_title'] = 'Banner Details';
		$this->data['main_page_url'] = 'banners';
		$this->load->model('Product_Model');
		$Product=$this->Product_Model->getBannerList($id);
		$this->data['Product']=$Product;
		$this->render($this->class_name.'view_banner');

    }

    public function addEditBanner($id=null)
    {
        $this->load->helper('form');
		$this->data['page_title'] = $page_title = 'Add New Banner';
		if(!empty($id)){
	       $this->data['page_title'] = $page_title = 'Edit Banner';
		}

		$this->data['main_page_url'] = 'banners';
		$this->load->model('Category_Model');
		$this->load->model('Menu_Model');
		$this->load->model('Product_Model');
		$this->load->model('SubCategory_Model');

		$postData=array();
		$postData=$this->Product_Model->getBannerDataById($id);

		$menuList=$this->Menu_Model->getMenuDropDownList();
		$this->data['menuList']=$menuList;

		if($this->input->post()){

			$this->load->library('form_validation');
			$set_rules=$this->Product_Model->configBanners;
			$this->form_validation->set_rules($set_rules);
			$this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

			if(!empty($id)){

			   $postData['id']=$this->input->post('id');
			}

			$postData['name']=$this->input->post('name');
			$postData['menu_id']=$this->input->post('menu_id');
			$postData['product_id']=$this->input->post('product_id');
			$postData['short_description']=$this->input->post('short_description');
			$postData['full_description']=$this->input->post('full_description');

			if($this->form_validation->run()===TRUE)
			{

				$saveData=true;
				$Filename = $_FILES['files']['name'];
				$uploadData=array();

				if(!empty($Filename)){

						$_FILES['file']['name']     = $_FILES['files']['name'];
						$_FILES['file']['type']     = $_FILES['files']['type'];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
						$_FILES['file']['error']     = $_FILES['files']['error'];
						$_FILES['file']['size']     = $_FILES['files']['size'];

						#File upload configuration
						#$uploadPath = './uploads/products';

						$config['upload_path'] =BANNER_IMAGE_BASE_PATH;
						$config['allowed_types'] = FILE_ALLOWED_TYPES;
						$config['max_size']= FILE_MAX_SIZE;

						#Load and initialize upload library
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						#Upload file to server
						if($this->upload->do_upload('file')){

						   #Uploaded file data
						   $uploadData = $this->upload->data();
						   $this->resizeImage($uploadData['file_name'],'small','','','banner');
						   $this->resizeImage($uploadData['file_name'],'medium','','','banner');
						   $this->resizeImage($uploadData['file_name'],'large',1500,570,'banner');

						}else{
							 //$error = array('error' => $this->upload->display_errors());
							 $this->session->set_flashdata('file_message_error','maximum product image size allowed on only 1Mb');
							 $saveData=false;

						}

			    }else {

					if(empty($id)){

						$this->session->set_flashdata('file_message_error','Select  images of banner');
						$saveData=false;
					}
				}

				if($saveData){

					$old_image= !empty($this->input->post('old_image')) ?
                    $this->input->post('old_image') : '';

                    if(!empty($Filename)){

						$postData['banner_image']=$uploadData['file_name'];
					}

					$insert_id=$this->Product_Model->saveBanner($postData);
					if ($insert_id > 0)
					{

						$this->session->set_flashdata('message_success',$page_title.' Successfully.');
						if(!empty($Filename) && !empty($old_image)){

							$imageName=$old_image;

							if(file_exists(BANNER_IMAGE_SMALL_BASE_PATH.$imageName))
							unlink(BANNER_IMAGE_SMALL_BASE_PATH.$imageName);
							if(file_exists(BANNER_IMAGE_MEDIUM_BASE_PATH.$imageName))
								unlink(BANNER_IMAGE_MEDIUM_BASE_PATH.$imageName);

							if(file_exists(BANNER_IMAGE_LARGE_BASE_PATH.$imageName))
								unlink(BANNER_IMAGE_LARGE_BASE_PATH.$imageName);

							if(file_exists(BANNER_IMAGE_BASE_PATH.$imageName))
								unlink(BANNER_IMAGE_BASE_PATH.$imageName);
						}

						redirect('admin/Products/banners');
					}
					else
					{
						$this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
					}
				}

			}else{

				$this->session->set_flashdata('message_error','Missing information.');
			}
		}

		$menu_id=isset($postData['menu_id']) ? $postData['menu_id']:'';
		$ProductList=$this->Product_Model->getProductDropDownList($menu_id);

		$this->data['ProductList']=$ProductList;

	    $this->data['postData']=$postData;

	    $this->render($this->class_name.'add_edit_banner');

    }
    public function activeInactiveBanner($id=null,$status=null)
    {

        if(!empty($id) && ($status==1 || $status==0)){

			    $postData['id']=$id;
		        $postData['status']=$status;
				$page_title='Banner Active';
				$this->load->model('Product_Model');
				if($status==0){
					$page_title='Banner Inactive';
				}
				if ($this->Product_Model->saveBanner($postData))
				{

					$this->session->set_flashdata('message_success',$page_title.' Successfully.');

				}
				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{

			$this->session->set_flashdata('message_error','Missing information.');
	    }
		redirect('admin/Products/banners');
    }

	public function deleteBanner($id=null,$imageName=null)
    {
        if(!empty($id)){


				$page_title='Banner Delete';
				$this->load->model('Product_Model');
				$data=$this->Product_Model->getBannerDataById($id);
				$imageName=$data['banner_image'];
				if ($this->Product_Model->deleteBanner($id))
				{

						if(file_exists(BANNER_IMAGE_SMALL_BASE_PATH.$imageName))
		                unlink(BANNER_IMAGE_SMALL_BASE_PATH.$imageName);
						if(file_exists(BANNER_IMAGE_MEDIUM_BASE_PATH.$imageName))
							unlink(BANNER_IMAGE_MEDIUM_BASE_PATH.$imageName);

						if(file_exists(BANNER_IMAGE_LARGE_BASE_PATH.$imageName))
							unlink(BANNER_IMAGE_LARGE_BASE_PATH.$imageName);

						if(file_exists(BANNER_IMAGE_BASE_PATH.$imageName))
							unlink(BANNER_IMAGE_BASE_PATH.$imageName);


					$this->session->set_flashdata('message_success',$page_title.' Successfully.');

				}
				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{

			$this->session->set_flashdata('message_error','Missing information.');
	    }

		redirect('admin/Products/banners');
    }
	public function brands(){

        $this->load->model('Product_Model');
		$this->data['page_title'] = 'Product Brands';
		$this->data['sub_page_title'] = 'Add New brand';
		$this->data['sub_page_url'] = 'addEditBrand';
		$this->data['sub_page_view_url'] = 'viewBrand';
		$this->data['sub_page_delete_url'] = 'deleteBrand';
		$this->data['sub_page_url_active_inactive'] = 'activeInactiveBrand';
		$lists=$this->Product_Model->getBrandList();
		$this->data['lists']=$lists;
		$this->render($this->class_name.'brands');

	}

	public function viewbrand($id=null)
    {
		if(empty($id)){

			redirect('admin/Products/brands');
		}
		$this->load->model('Product_Model');
		$this->data['page_title'] = 'Brand Details';
		$this->data['main_page_url'] = 'brands';
		$this->load->model('Product_Model');
		$Product=$this->Product_Model->getBrandList($id);
		$this->data['Product']=$Product;
		$this->render($this->class_name.'view_brand');

    }

    public function addEditBrand($id=null)
    {
        $this->load->helper('form');
		$this->data['page_title'] = $page_title = 'Add New Brand';
		if(!empty($id)){
	       $this->data['page_title'] = $page_title = 'Edit Brand';
		}

		$this->data['main_page_url'] = 'brands';
		$this->load->model('Product_Model');
		$postData=array();
		$postData=$this->Product_Model->getBrandDataById($id);

		if($this->input->post()){

			$this->load->library('form_validation');
			$set_rules=$this->Product_Model->configBrands;
			$this->form_validation->set_rules($set_rules);
			$this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

			if(!empty($id)){

			   $postData['id']=$this->input->post('id');
			}

			$postData['name']=$this->input->post('name');

			$postData['short_description']=$this->input->post('short_description');

			$postData['full_description']=$this->input->post('full_description');


			if($this->form_validation->run()===TRUE)
			{

				$saveData=true;
				$Filename = $_FILES['files']['name'];
				$uploadData=array();

				if(!empty($Filename)){

						$_FILES['file']['name']     = $_FILES['files']['name'];
						$_FILES['file']['type']     = $_FILES['files']['type'];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
						$_FILES['file']['error']     = $_FILES['files']['error'];
						$_FILES['file']['size']     = $_FILES['files']['size'];

						#File upload configuration
						#$uploadPath = './uploads/products';

						$config['upload_path'] =BRAND_IMAGE_BASE_PATH;
						$config['allowed_types'] = FILE_ALLOWED_TYPES;
						$config['max_size']= FILE_MAX_SIZE;

						#Load and initialize upload library
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						#Upload file to server
						if($this->upload->do_upload('file')){
						   $uploadData = $this->upload->data();
						   #Uploaded file data
						   $this->resizeImage($uploadData['file_name'],'large',100,100,'brand');

						}else{
							 //$error = array('error' => $this->upload->display_errors());
							 $this->session->set_flashdata('file_message_error','maximum product image size allowed on only 1Mb');
							 $saveData=false;

						}

			    }else {

					if(empty($id)){

						$this->session->set_flashdata('file_message_error','Select  images of brand');
						$saveData=false;
					}
				}

				if($saveData){

					$old_image= !empty($this->input->post('old_image')) ?
                    $this->input->post('old_image') : '';

                    if(!empty($Filename)){

						$postData['brand_image']=$uploadData['file_name'];
					}

					$insert_id=$this->Product_Model->saveBrand($postData);

					if ($insert_id > 0)
					{

						$this->session->set_flashdata('message_success',$page_title.' Successfully.');
						if(!empty($Filename) && !empty($old_image)){

							$imageName=$old_image;
							if(file_exists(BRAND_IMAGE_LARGE_BASE_PATH.$imageName))
								unlink(BRAND_IMAGE_LARGE_BASE_PATH.$imageName);

							if(file_exists(BRAND_IMAGE_BASE_PATH.$imageName))
								unlink(BRAND_IMAGE_BASE_PATH.$imageName);
						}

						redirect('admin/Products/brands');
					}
					else
					{
						$this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
					}
				}

			}else{

				$this->session->set_flashdata('message_error','Missing information.');
			}
		}

	    $this->data['postData']=$postData;

	    $this->render($this->class_name.'add_edit_brand');

    }
    public function activeInactiveBrand($id=null,$status=null)
    {

        if(!empty($id) && ($status==1 || $status==0)){

			    $postData['id']=$id;
		        $postData['status']=$status;
				$page_title='Brand Active';
				$this->load->model('Product_Model');
				if($status==0){
					$page_title='Brand Inactive';
				}
				if ($this->Product_Model->saveBrand($postData))
				{

					$this->session->set_flashdata('message_success',$page_title.' Successfully.');
				}
				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{

			$this->session->set_flashdata('message_error','Missing information.');
	    }
		redirect('admin/Products/brands');
    }

	public function deleteBrand($id=null)
    {
        if(!empty($id)){


				$page_title='Brand Delete';
				$this->load->model('Product_Model');
				$data=$this->Product_Model->getBrandDataById($id);
				$imageName=$data['brand_image'];

				if ($this->Product_Model->deleteBrand($id))
				{


						if(file_exists(BRAND_IMAGE_LARGE_BASE_PATH.$imageName))
							unlink(BRAND_IMAGE_LARGE_BASE_PATH.$imageName);

						if(file_exists(BRAND_IMAGE_BASE_PATH.$imageName))
							unlink(BRAND_IMAGE_BASE_PATH.$imageName);


					$this->session->set_flashdata('message_success',$page_title.' Successfully.');

				}
				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{

			$this->session->set_flashdata('message_error','Missing information.');
	    }

		redirect('admin/Products/brands');
    }

	public function subscribeEmail(){

        $this->load->model('Product_Model');
		$this->data['page_title'] = 'subscribe Email';
		$this->data['sub_page_title'] = '';
		$this->data['sub_page_url'] = '';
		$this->data['sub_page_view_url'] = '';
		$this->data['sub_page_delete_url'] = 'deleteSubscribeEmail';
		$this->data['sub_page_url_active_inactive'] = '';
		$lists=$this->Product_Model->getsubscribeEmail();
		$this->data['lists']=$lists;
		$this->render($this->class_name.'subscribe_email');

	}
	public function deleteSubscribeEmail($id=null)
    {
        if(!empty($id)){


				$page_title='Subscribe Email Delete';
				$this->load->model('Product_Model');
				if ($this->Product_Model->deleteSubscribeEmail($id))
				{
					$this->session->set_flashdata('message_success',$page_title.' Successfully.');

				}
				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{

			$this->session->set_flashdata('message_error','Missing information.');
	    }

		redirect('admin/Products/subscribeEmail');
    }

	public function resizeImage($filename,$type='small',$widthlarge=800,$heightlarge=800,$section='product') {


		$source_path =PRODUCT_IMAGE_BASE_PATH. $filename;
		$target_path = PRODUCT_IMAGE_BASE_PATH.$type.'/'.$filename;
		if($section=='banner'){

			$source_path =BANNER_IMAGE_BASE_PATH. $filename;
		    $target_path = BANNER_IMAGE_BASE_PATH.$type.'/'.$filename;
		}

		if($section=='brand'){

			$source_path = BRAND_IMAGE_BASE_PATH. $filename;
		    $target_path = BRAND_IMAGE_BASE_PATH.$type.'/'.$filename;
		}

		if($type=='medium'){

	        $width=300;
		    $height=300;
		}else if($type=='large'){

			$width=$widthlarge;
		    $height=$heightlarge;

		}else{
		    $width=200;
		    $height=200;
		}
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => FALSE,
			'create_thumb' => TRUE,
			'thumb_marker' => FALSE,
			'width' => $width,
			'height' => $height
		);
		//pr($config_manip);
		$this->load->library('image_lib');
		$this->image_lib->initialize($config_manip);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
        $this->image_lib->clear();
    }

	public function reviews()
    {

		$this->render($this->class_name.'reviews');


    }

}
