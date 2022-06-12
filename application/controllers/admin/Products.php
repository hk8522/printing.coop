<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'libraries/xlsxwriter.class.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Products extends Admin_Controller
{
    public $class_name='';

    function __construct()
    {
        parent::__construct();
        $this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
        $this->data['class_name']= $this->class_name;

        $this->session->set_flashdata('message_success', '');
        $this->session->set_flashdata('message_error', '');
    }

    #Start Product List add/Edit Delete Inactive/Inactive
    public function index($product_id = 0, $order = 'desc')
    {
        if ($this->input->post()) {
            $order=$_POST['order'];
            redirect('admin/Products/index/'.$product_id.'/'.$order);
        }

		$this->load->model('Product_Model');
		$this->data['page_title'] = 'Products';
		$this->data['sub_page_title'] = 'Add New Product';
		$this->data['sub_page_url'] = 'addEdit';
		$this->data['sub_page_view_url'] = 'viewProduct';
		$this->data['sub_page_delete_url'] = 'deleteProduct';
		$this->data['sub_page_url_active_inactive'] = 'activeInactive';

		$this->load->library('pagination');
        $this->load->config('pagination');
		$config = $this->config->item('pagination_config');
		$config["base_url"] = base_url(). "admin/Products/index/".$product_id.'/'.$order;
		$config["total_rows"] = $this->Product_Model->getProductTotal($product_id);
		//pr($this->uri,1);
		$config["per_page"] = 20;
		$config["uri_segment"] = 5;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		$this->data["links"] = $this->pagination->create_links();
		$lists = $this->Product_Model->getProductList('', $product_id,$config["per_page"], $page,$order);
		$this->data['lists'] = $lists;
		$this->data['order'] = $order;
		$this->render($this->class_name.'index');
    }

    public function viewProduct($id=null)
    {
		if (empty($id)){
			redirect('admin/Products');
		}
		$this->load->model('Product_Model');
		$this->load->model('Category_Model');

		$this->data['page_title'] = 'Product Details';
		$this->data['main_page_url'] = '';
		$this->load->model('ProductImage_Model');
		$ProductImages=$this->ProductImage_Model->getProductImageDataByProductId($id);
		$this->data['ProductImages']=$ProductImages;
		$Product=$this->Product_Model->getProductList($id);
		$this->data['Product']=$Product;
		$this->data['tagList']=$this->Category_Model->getTasgList(1);
		$this->render($this->class_name.'view');
    }

    public function addEdit($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Product';
        if ($id) {
            $this->data['page_title'] = $page_title = 'Edit Product';
        }
        $this->data['main_page_url'] = '';
        $this->load->model('Category_Model');
        $this->load->model('Menu_Model');
        $this->load->model('Product_Model');
        $this->load->model('SubCategory_Model');
        $this->load->model('ProductImage_Model');
        $this->load->model('Store_Model');
        $postData = [];

        $postData = $this->Product_Model->getProductDataById($id);
        $ProductImages = $this->ProductImage_Model->getProductImageDataByProductId($id);
        $this->data['ProductImages']=$ProductImages;
        $quantity=$this->Product_Model->getQuantityListDropDwon();
        $this->data['quantity']=$quantity;

        $this->data['StoreList']=$this->Store_Model->getStoreDropDownList();

        $ProductDescriptions=array();
        $ProductTemplates=array();
        $old_category_id=$old_subcategory_id='';
        if($id){
            $ProductDescriptions=$this->Product_Model->getProductDescriptionById($id);
            $ProductTemplates=$this->Product_Model->getProductTemplatesById($id);
        }

        $Categoty=$this->data['Categoty']=$this->Category_Model->getMultipalCategoriesAndSubCategories();
        $ProductCategory=array();
        if($id){
            $ProductCategory=$this->Product_Model->getProductMultipalCategoriesAndSubCategories($id);
        }
        $this->data['ProductCategory']=$ProductCategory;

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $set_rules = $this->Product_Model->config;

            if ($id) {
                $postData['id']=$this->input->post('id');
                $old_category_id=$postData['category_id'];
                $old_subcategory_id=$postData['sub_category_id'];
            }

            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            /*$category_id=$postData['category_id'] = $this->input->post('category_id');
            $sub_category_id=$postData['sub_category_id'] = $this->input->post('sub_category_id');*/

            $postData['name'] = $this->input->post('name');

            $postData['name_french'] = $this->input->post('name_french');
            $postData['price'] = $this->input->post('price');
            $postData['short_description'] = $this->input->post('short_description');

            $postData['short_description_french'] = $this->input->post('short_description_french');

            $postData['full_description'] = $this->input->post('full_description');

            $postData['full_description_french'] = $this->input->post('full_description_french');

            $postData['code'] = $this->input->post('code');
            $postData['code_french'] = $this->input->post('code_french');
            $postData['model'] = $this->input->post('model');
            $postData['model_french'] = $this->input->post('model_french');

            $postData['is_stock'] = !empty($this->input->post('is_stock')) ?
            $this->input->post('is_stock'):0;

            $product_tag= !empty($this->input->post('product_tag')) ? $this->input->post('product_tag'):'';
            if(!empty($product_tag)){
                $product_tag=implode(',',$product_tag);
            }
            $postData['product_tag']=$product_tag;

            $postData['add_length_width'] = !empty($this->input->post('add_length_width')) ?
            $this->input->post('add_length_width'):0;

            $postData['min_length'] = isset($_POST['min_length']) ?
            $this->input->post('min_length'):0;

            $postData['max_length'] = isset($_POST['max_length']) ?
            $this->input->post('max_length'):0;

            $postData['min_width'] = isset($_POST['min_width']) ?
            $this->input->post('min_width'):0;

            $postData['max_width'] = isset($_POST['max_width']) ?
            $this->input->post('max_width'):0;

            $postData['min_length_min_width_price'] = isset($_POST['min_length_min_width_price']) ?
            $this->input->post('min_length_min_width_price'):0;

            $postData['length_width_unit_price_black'] = isset($_POST['length_width_unit_price_black']) ?
            $this->input->post('length_width_unit_price_black'):0;

            $postData['length_width_price_color'] = isset($_POST['length_width_price_color']) ?
            $this->input->post('length_width_price_color'):0;

            $postData['length_width_color_show'] = isset($_POST['length_width_color_show']) ?
            $this->input->post('length_width_color_show'):0;

            $postData['length_width_pages_type'] = isset($_POST['length_width_pages_type']) ?
            $this->input->post('length_width_pages_type'):'input';

            $postData['length_width_quantity_show'] = isset($_POST['length_width_quantity_show']) ?
            $this->input->post('length_width_quantity_show'):'0';

            $postData['length_width_min_quantity'] = isset($_POST['length_width_min_quantity']) ?
            $this->input->post('length_width_min_quantity'):25;

            $postData['length_width_max_quantity'] = isset($_POST['length_width_max_quantity']) ?
            $this->input->post('length_width_max_quantity'):5000;

            $postData['page_add_length_width'] = !empty($this->input->post('page_add_length_width')) ?
            $this->input->post('page_add_length_width'):0;

            $postData['page_min_length'] = isset($_POST['page_min_length']) ?
            $this->input->post('page_min_length'):0;

            $postData['page_max_length'] = isset($_POST['page_max_length']) ?
            $this->input->post('page_max_length'):0;

            $postData['page_min_width'] = isset($_POST['page_min_width']) ?
            $this->input->post('page_min_width'):0;

            $postData['page_max_width'] = isset($_POST['page_max_width']) ?
            $this->input->post('page_max_width'):0;

            $postData['page_min_length_min_width_price'] = isset($_POST['page_min_length_min_width_price']) ?
            $this->input->post('page_min_length_min_width_price'):0;

            $postData['page_length_width_price_color'] = isset($_POST['page_length_width_price_color']) ?
            $this->input->post('page_length_width_price_color'):0;

            $postData['page_length_width_price_black'] = isset($_POST['page_length_width_price_black']) ?
            $this->input->post('page_length_width_price_black'):0;

            $postData['page_length_width_color_show'] = isset($_POST['page_length_width_color_show']) ?
            $this->input->post('page_length_width_color_show'):0;

            $postData['page_length_width_pages_type'] = isset($_POST['page_length_width_pages_type']) ?
            $this->input->post('page_length_width_pages_type'):'dropdown';

            $postData['page_length_width_pages_show'] = isset($_POST['page_length_width_pages_show']) ?
            $this->input->post('page_length_width_pages_show'):'0';

            $postData['page_length_width_sheets_type'] = isset($_POST['page_length_width_sheets_type']) ?
            $this->input->post('page_length_width_sheets_type'):'dropdown';

            $postData['page_length_width_sheets_show'] = isset($_POST['page_length_width_sheets_show']) ?
            $this->input->post('page_length_width_sheets_show'):'0';

            $postData['page_length_width_quantity_type'] = isset($_POST['page_length_width_quantity_type']) ?
            $this->input->post('page_length_width_quantity_type'):'input';

            $postData['page_length_width_quantity_show'] = isset($_POST['page_length_width_quantity_show']) ?
            $this->input->post('page_length_width_quantity_show'):'0';

            $postData['page_length_width_min_quantity'] = isset($_POST['page_length_width_min_quantity']) ?
            $this->input->post('page_length_width_min_quantity'):25;

            $postData['page_length_width_max_quantity'] = isset($_POST['page_length_width_max_quantity']) ?
            $this->input->post('page_length_width_max_quantity'):5000;

            $postData['depth_add_length_width'] = !empty($this->input->post('depth_add_length_width')) ?
            $this->input->post('depth_add_length_width'):0;

            $postData['min_depth'] = isset($_POST['min_depth']) ?
            $this->input->post('min_depth'):0;

            $postData['max_depth'] = isset($_POST['max_depth']) ?
            $this->input->post('max_depth'):0;

            $postData['depth_min_length'] = isset($_POST['depth_min_length']) ?
            $this->input->post('depth_min_length'):0;

            $postData['depth_max_length'] = isset($_POST['depth_max_length']) ?
            $this->input->post('depth_max_length'):0;

            $postData['depth_min_width'] = isset($_POST['depth_min_width']) ?
            $this->input->post('depth_min_width'):0;

            $postData['depth_max_width'] = isset($_POST['depth_max_width']) ?
            $this->input->post('depth_max_width'):0;

            $postData['depth_width_length_price'] = isset($_POST['depth_width_length_price']) ?
            $this->input->post('depth_width_length_price'):0;

            $postData['depth_unit_price_black'] = isset($_POST['depth_unit_price_black']) ?
            $this->input->post('depth_unit_price_black'):0;

            $postData['depth_price_color'] = isset($_POST['depth_price_color']) ?
            $this->input->post('depth_price_color'):0;

            $postData['depth_color_show'] = isset($_POST['depth_color_show']) ?
            $this->input->post('depth_color_show'):0;

            $postData['depth_width_length_type'] = isset($_POST['depth_width_length_type']) ?
            $this->input->post('depth_width_length_type'):'input';

            $postData['depth_width_length_quantity_show'] = isset($_POST['depth_width_length_quantity_show']) ?
            $this->input->post('depth_width_length_quantity_show'):'0';

            $postData['depth_min_quantity'] = isset($_POST['depth_min_quantity']) ?
            $this->input->post('depth_min_quantity'):25;

            $postData['depth_max_quantity'] = isset($_POST['depth_max_quantity']) ?
            $this->input->post('depth_max_quantity'):5000;

            $postData['votre_text'] = !empty($this->input->post('votre_text')) ?
            $this->input->post('votre_text'):0;

            $postData['recto_verso'] = !empty($this->input->post('recto_verso')) ?
            $this->input->post('recto_verso'):0;

            $postData['recto_verso_price'] = isset($_POST['recto_verso_price']) ?
            $this->input->post('recto_verso_price'):0;

            $postData['call'] = !empty($this->input->post('call')) ?
            $this->input->post('call'):0;

            $postData['phone_number'] = !empty($this->input->post('phone_number')) ?
            $this->input->post('phone_number'):'';

            #Shiping Box Size Setting

            $postData['shipping_box_length'] = isset($_POST['shipping_box_length']) ?
            $this->input->post('shipping_box_length'):'0';

            $postData['shipping_box_width'] = isset($_POST['shipping_box_width']) ?
            $this->input->post('shipping_box_width'):'0';

            $postData['shipping_box_height'] = isset($_POST['shipping_box_height']) ?
            $this->input->post('shipping_box_height'):'0';

            $postData['shipping_box_weight'] = isset($_POST['shipping_box_weight']) ?
            $this->input->post('shipping_box_weight'):'0';

            /*$postData['store_id']='';
            $store_id=$this->input->post('store_id');

            if(!empty($store_id)){
                $postData['store_id'] = implode(',',$store_id);
            }*/
            //pr($postData,1);
            $uploadData = array();

            if ($this->form_validation->run()===TRUE) {
                $saveData = true;
                $onefilesCount = isset($_FILES['files']['name'][0]) ? $_FILES['files']['name'][0]:0;

                if (!empty($onefilesCount)) {
                    $filesCount = count($_FILES['files']['name']);
                    for ($i = 0; $i < $filesCount; $i++) {
                        $_FILES['file']['name'] = time().$_FILES['files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                        #File upload configuration
                        #$uploadPath = './uploads/products';

                        $config['upload_path'] = PRODUCT_IMAGE_BASE_PATH;
                        $config['allowed_types'] = FILE_ALLOWED_TYPES;

                        //$config['max_size']= FILE_MAX_SIZE;

                        #Load and initialize upload library
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        #Upload file to server

                        if ($this->upload->do_upload('file')) {
                            #Uploaded file data
                            $fileData = $this->upload->data();
                            $uploadData[$i]['file_name'] = $fileData['file_name'];
                            $this->resizeImage($fileData['file_name'],'small');
                            $this->resizeImage($fileData['file_name'],'medium');
                            $this->resizeImage($fileData['file_name'],'large');
                        } else {
                            /*$this->session->set_flashdata('file_message_error','maximum product image size allowed on only 1Mb');
                            $saveData = false;
                            break;*/
                        }
                    }
                } else {
                    /*if (empty($id)) {
                        $this->session->set_flashdata('message_error','Select at least one images of Product');
                        //$saveData = false;
                    }*/
                }

                if ($saveData) {
                    $old_image = isset ($_POST['old_image']) && !empty($this->input->post('old_image')) ? $this->input->post('old_image') : array();
                    $uploadDataNew = array();

                    foreach($uploadData as $k=>$v) {
                        $uploadDataNew[] = $v['file_name'];
                    }

                    //pr($_POST);
                    $uploadDataNew=array_merge($old_image,$uploadDataNew);
                    //pr($old_image);
                    //pr($uploadDataNew,1);
                    $insert_id=$this->Product_Model->saveProduct($postData);

                    if ($insert_id > 0) {
                        $data = array();
                        foreach($uploadDataNew as $k=>$v) {
                            $sdata=array();
                            $sdata['image']=$v;
                            $sdata['created']=date('Y-m-d H:i:s');
                            $sdata['updated']=date('Y-m-d H:i:s');
                            $sdata['product_id']=$insert_id;
                            $data[]=$sdata;
                        }
                        if ($this->ProductImage_Model->saveProductImage($data,$insert_id)){
                            $product_main_image=isset($data[0]) ? $data[0]:'';
                            $postData=array('id'=>$insert_id,'product_image'=>$product_main_image['image']);
                            $this->Product_Model->saveProduct($postData);
                        }

                        $created_at=$updated_at=date('Y-m-d H:i:s');

                        $title=$this->input->post('title');
                        $title_french=$this->input->post('title_french');

                        $description=$this->input->post('description');

                        $description_french=$this->input->post('description_french');

                        $title=isset($title) ? $title:array();

                        $title_french=isset($title_french) ? $title_french:array();

                        $description=isset($description) ? $description:array();

                        $description_french=isset($description_french) ? $description_french:array();

                        $this->db->where('product_id', $insert_id);
                        $this->db->delete('product_descriptions');

                        if(!empty($title)){
                            $data=array();
                            foreach($title as $key=>$val){
                                $descriptionSave=array();
                                if(!empty($val)){
                                    $descriptionSave['title']=$val;
                                    $descriptionSave['title_french']=$title_french[$key];
                                    $descriptionSave['description']=$description[$key];
                                    $descriptionSave['description_french']=$description_french[$key];
                                    $descriptionSave['product_id']=$insert_id;
                                    $descriptionSave['created_at']=$created_at;
                                    $descriptionSave['updated_at']=$updated_at;
                                    $data[]=$descriptionSave;
                                }
                            }
                            if($data){
                                $this->Product_Model->saveProductDescription($data,$insert_id);
                            }
                        }

                        $final_dimensions=$this->input->post('final_dimensions');
                        $final_dimensions_french=$this->input->post('final_dimensions_french');

                        $template_description=$this->input->post('template_description');

                        $template_description_french=$this->input->post('template_description_french');

                        $final_dimensions=isset($final_dimensions) ? $final_dimensions:array();

                        $final_dimensions_french=isset($final_dimensions_french) ? $final_dimensions_french:array();

                        $template_description=isset($template_description) ? $template_description:array();

                        $template_description_french=isset($template_description_french) ? $template_description_french:array();

                        $template_file_old=isset($_POST['template_file_old']) ? $this->input->post('template_file_old'):array();
                        $template_file=isset($_FILES['template_file']) ? $_FILES['template_file']:array();

                        $this->db->where('product_id', $insert_id);
                        $this->db->delete('product_templates');

                        if(!empty($final_dimensions)){
                            $data=array();
                            foreach($final_dimensions as $key=>$val){
                                $descriptionSave=array();
                                if(!empty($val)){
                                    $descriptionSave['final_dimensions']=$val;
                                    $descriptionSave['final_dimensions_french']=$final_dimensions_french[$key];

                                    $descriptionSave['template_description']=$template_description[$key];

                                    $descriptionSave['template_description_french']=$template_description_french[$key];
                                    $descriptionSave['template_file']=$template_file_old[$key];

                                    $descriptionSave['product_id']=$insert_id;
                                    $descriptionSave['created_at']=$created_at;
                                    $descriptionSave['updated_at']=$updated_at;

                                    $template_file_name=isset($template_file['name'][$key]) ? $template_file['name'][$key]:'';

                                    if(!empty($template_file_name)){
                                        $i=$key;
                                        $_FILES['file']['name']      = $template_file['name'][$i];
                                        $_FILES['file']['type']      = $template_file['type'][$i];
                                        $_FILES['file']['tmp_name']  = $template_file['tmp_name'][$i];
                                        $_FILES['file']['error']     = $template_file['error'][$i];
                                        $_FILES['file']['size']      = $template_file['size'][$i];

                                        #File upload configuration
                                        #$uploadPath = './uploads/products';

                                        $config['upload_path']   = TEMPLATE_FILE_BASE_PATH;
                                        $config['allowed_types'] = TEMPLATE_FILE_ALLOWED_TYPES;
                                        $config['max_size']= TEMPLATE_FILE_MAX_SIZE;

                                        #Load and initialize upload library
                                        $this->load->library('upload', $config);
                                        //pr($config);
                                        $this->upload->initialize($config);
                                        #Upload file to server
                                        if($this->upload->do_upload('file')){
                                        #Uploaded file data
                                        $fileData = $this->upload->data();
                                        //pr($fileData);
                                        $descriptionSave['template_file']= $fileData['file_name'];
                                        }
                                    }

                                    $data[]=$descriptionSave;
                                }
                            }

                            if($data){
                                //pr($data,1);
                                $this->Product_Model->saveProductTemplate($data,$insert_id);
                            }
                        }

                        $this->db->where('product_id', $insert_id);
                        $this->db->delete('product_category');
                        $this->db->where('product_id', $insert_id);
                        $this->db->delete('product_subcategory');
                        $categoty_post_array=$sub_categoty_post_array=array();
                        $i=1;
                        $fcategory_id=$fsub_category_id=0;
                        foreach($Categoty as $qkey=>$qval){
                            $category_id_name='category_id_'.$qval['id'];
                            $category_id_val= isset($_POST[$category_id_name]) ? $this->input->post($category_id_name):'';
                            $sub_categories=$qval['sub_categories'];

                            if(!empty($category_id_val)){
                                $categoty_post_array[]=$category_id_val;

                                $SubCategoryDataSave=array();
                                foreach($sub_categories as $key=>$val){
                                    $sub_category_id_name='sub_category_id_'.$category_id_val.'_'.$val['id'];

                                    $sub_category_id_val= isset($_POST[$sub_category_id_name]) ? $this->input->post($sub_category_id_name):'';
                                    $subCategorySave=array();
                                    if(!empty($sub_category_id_val)){
                                        $sub_categoty_post_array[$category_id_val][]=$sub_category_id_val;

                                        $subCategorySave['product_id']=$insert_id;
                                        $subCategorySave['category_id']=$category_id_val;
                                        $subCategorySave['sub_category_id']=$sub_category_id_val;
                                        $SubCategoryDataSave[]=$subCategorySave;
                                    }
                                }

                                $categorySaveData=array();
                                $categorySaveData['product_id']=$insert_id;

                                $categorySaveData['category_id']=$category_id_val;

                                $category_id_new=$this->Product_Model->saveProductCategory($categorySaveData);

                                if(!empty($SubCategoryDataSave) && count($category_id_new) > 0 ){
                                    $this->Product_Model->saveProductSubCategory($SubCategoryDataSave);

                                    if($i==1){
                                    $fcategory_id=$category_id_val;
                                    $fsub_category_id=$SubCategoryDataSave[0]['sub_category_id'];
                                    }
                                    $i++;
                                }
                            }
                        }
                        if($i > 1){
                            $postDataSave['id']=$insert_id;
                            $postDataSave['category_id']=$fcategory_id;
                            $postDataSave['sub_category_id']=$fsub_category_id;
                            $this->Product_Model->saveProduct($postDataSave);
                        }

                        $this->session->set_flashdata('message_success', "$page_title Successfully.");
                        redirect('admin/Products');
                    } else {
                        $this->session->set_flashdata('message_error', "$page_title Unsuccessfully.");
                    }
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        $menu_id = isset($postData['menu_id']) ? $postData['menu_id']:'';
        $category_id = isset($postData['category_id']) ? $postData['category_id']:'';
        $categoryList = $this->Category_Model->getCategoryDropDownList();

        $this->data['categoryList']  = $categoryList;

        $subCategoryList = [];
        if ($category_id) {
            $subCategoryList = $this->SubCategory_Model->getSubCategoryDropDownList(null, $category_id);
        }

        $this->data['tagList']=$this->Category_Model->getTasgList(1);

        $this->data['subCategoryList'] = $subCategoryList;
        $this->data['postData'] = $postData;
        $this->data['ProductDescriptions']=$ProductDescriptions;
        $this->data['ProductTemplates']=$ProductTemplates;
        $this->render($this->class_name.'add_edit');
    }
	#End Product List add/Edit Delete Inactive/Inactive

	/*public function SetMultipleAttributes($id = null)
    {
		        $this->load->helper('form');
				$this->data['page_title'] = $page_title = 'Set Multiple Attributes';
				if (empty($id)){
					redirect('admin/Products');
				}
				$this->data['main_page_url'] = '';
				$this->load->model('Product_Model');
				$postData = [];
				$postData = $this->Product_Model->getProductDataById($id);
				$ProductSizes=array();
				$this->data['ProductSizes']=$this->Product_Model->ProductQuantySizeAttributeDropDwon($id);

		        $this->data['postData'] = $postData;
	            $this->render($this->class_name.'product_multiple_attribute');
    }

	public function AddEditProductQuantity($product_id=null,$id=null){
		$this->load->helper('form');
		$this->load->model('Product_Model');
		$quantity=$this->Product_Model->getQuantityListDropDwon();
		$data['quantity']=$quantity;
		$data['BASE_URL']=base_url();
		$QualityData=array();
		$quantity_price=$quantity_id='';
		if($this->input->post()) {
			$quantity_id=$this->input->post('quantity_id');
			$quantity_price=$this->input->post('quantity_price');
			$product_id=$this->input->post('product_id');
			$id=$this->input->post('id');

			$ProductSizes=$this->Product_Model->ProductOnlyQuantityDropDwon($product_id);

			$QuantityIds=array_keys($ProductSizes);
			$quantity_price=!empty($quantity_price) ? $quantity_price:0;
			$SavedData['qty']        = $quantity_id;
			$SavedData['price']      = $quantity_price;
			$SavedData['product_id'] = $product_id;
			$saveQuantity=true;
			if($id){
			    $SavedData['id'] = $id;
			}
			if($id != $quantity_id && in_array($quantity_id,$QuantityIds)){
				$this->session->set_flashdata('message_error','This quantity already added to this product.');
				$saveQuantity=false;
			}

			if($saveQuantity){
				$insert_id=$this->Product_Model->saveProductQty($SavedData,$product_id);
				if($insert_id > 1){
					$success=1;
					if($id){
					   $this->session->set_flashdata('message_success','Updated Quantity Successfully.');
					}else{
						$this->session->set_flashdata('message_success','Added  Quantity Successfully.');
					}
				}else{
					$this->session->set_flashdata('message_error','Saved  Quantity Unsuccessfully.');
				}
		    }
		}else{
			$success='0';
			$ProductSizes=$this->Product_Model->ProductOnlyQuantityDropDwon($product_id);
			//pr($ProductSizes,1);
			$quantity_id=$id;
			$quantity_price=isset($ProductSizes[$quantity_id]['price']) ? $ProductSizes[$quantity_id]['price']:'';
		}
		$data['id']=$id;
		$data['product_id']=$product_id;
		$data['quantity_price']=$quantity_price;
		$data['quantity_id']=$quantity_id;
		$data['success']=$success;
		echo $this->load->view($this->class_name.'add_edit_product_quantity',$data,true);
		exit(0);
	}

	function deleteProductQuantity($product_id=null,$id=null){
		if(!empty($product_id) && !empty($id)){
			$page_title='Product Delete';
			$this->load->model('Product_Model');
			$this->Product_Model->deleteProductQty($product_id,$id);
		}
		exit(0);
	}

	public function AddEditProductSize($product_id=null,$quantity_id=null,$id=null){
		$this->load->helper('form');
		$this->load->model('Product_Model');
		$sizes=$this->Product_Model->getSizeListDropDwon();
		$data['sizes']=$sizes;
		$data['BASE_URL']=base_url();

		$size_price=$size_id='';
		if($this->input->post()) {
			//pr($_POST);
			$product_id=$this->input->post('product_id');
			$quantity_id=$this->input->post('quantity_id');
			$size_price=$this->input->post('size_price');
			$size_id=$this->input->post('size_id');
			$id=$this->input->post('id');

			$ProductSizes=$this->Product_Model->ProductOnlySizeDropDwon($product_id,$quantity_id);
			$SizesIds=array_keys($ProductSizes);

			$size_price=!empty($size_price) ? $size_price:0;
			$SavedData['product_id']      = $product_id;
			$SavedData['qty']             = $quantity_id;
			$SavedData['size_id']         = $size_id;
			$SavedData['extra_price']     = $size_price;
			$saveQuantity=true;

			if($id){
			    $SavedData['id'] = $id;
			}
			if($id != $size_id && in_array($size_id,$SizesIds)){
				$this->session->set_flashdata('message_error','This size already added to this product & Quantity');
				$saveQuantity=false;
			}
			if($saveQuantity){
				$insert_id=$this->Product_Model->saveProductSizeData($SavedData,$product_id);
				if($insert_id > 1){
					$success=1;
					if($id){
					   $this->session->set_flashdata('message_success','Updated Size Successfully.');
					}else{
						$this->session->set_flashdata('message_success','Added  Size Successfully.');
					}
				}else{
					$this->session->set_flashdata('message_error','Saved  Size Unsuccessfully.');
				}
		    }
		}else{
			$success='0';
			$ProductSizes=$this->Product_Model->ProductOnlySizeDropDwon($product_id,$quantity_id);

			$size_id=$id;
			$size_price=isset($ProductSizes[$size_id]['extra_price']) ? $ProductSizes[$size_id]['extra_price']:'';
		}
		$data['product_id']=$product_id;
		$data['quantity_id']=$quantity_id;
		$data['id']=$id;
		$data['size_price']=$size_price;
		$data['size_id']=$size_id;
		$data['success']=$success;
		echo $this->load->view($this->class_name.'add_edit_product_size',$data,true);
		exit(0);
	}

	public function AddEditProductAttribute($product_id=null,$quantity_id=null,$size_id=null){
		$this->load->helper('form');
		$this->load->model('Product_Model');
		$data['NCRNumberPartsList']=$this->Product_Model->getNCRNumberPartsList();
		$data['PaperList']=$this->Product_Model->getPaperList();
		$data['PaperQualityList']=$this->Product_Model->getPaperQualityList();
		$data['ColorList']=$this->Product_Model->getColorList();
		$data['StockList']=$this->Product_Model->getStockList();
		$data['DiameterList']=$this->Product_Model->getDiameterList();
		$data['ShapePaperList']=$this->Product_Model->getShapePaperList();
		$data['BundlingList']=$this->Product_Model->getBundlingList();
		$data['CoatingList']=$this->Product_Model->getCoatingList();
		$data['Grommets']=$this->Product_Model->getGrommetsList();
		$data['BASE_URL']=base_url();

		if($this->input->post()) {
	        //pr($_POST,1);
			$product_id=$this->input->post('product_id');
			$quantity_id=$this->input->post('quantity_id');
			$size_id=$this->input->post('size_id');
			$ncr_number_parts=$this->input->post('ncr_number_parts');
		    $ncr_number_part_price=$this->input->post('ncr_number_part_price');
			$stock=$this->input->post('stock');
			$stock_extra_price=$this->input->post('stock_extra_price');
			$paper_quality=$this->input->post('paper_quality');
			$paper_quality_extra_price=$this->input->post('paper_quality_extra_price');

			$color=$this->input->post('color');

		    $color_extra_price=$this->input->post('color_extra_price');

			$diameter=$this->input->post('diameter');

			$diameter_extra_price=$this->input->post('diameter_extra_price');

			$shape_paper=$this->input->post('shape_paper');

			$shape_paper_extra_price=$this->input->post('shape_paper_extra_price');

			$grommets=$this->input->post('grommets');

			$grommets_extra_price=$this->input->post('grommets_extra_price');

			$ncr_number_parts=!empty($ncr_number_parts) ? $ncr_number_parts:array();

			$ncr_number_part_price=isset($ncr_number_part_price) ? $ncr_number_part_price:array();

		$created_at=$updated_at=date('Y-m-d H:i:s');

		$this->db->where('product_id', $product_id);
		$this->db->where('qty', $quantity_id);
		$this->db->where('size_id', $size_id);
	    $this->db->delete('product_size');

		$datas=array();
		foreach($ncr_number_parts as $key1=>$val1){
		$descriptionSave=array();

		if((!empty($product_id) && !empty($quantity_id) && !empty($size_id))  || !empty($val1)  || !empty($stock[$key1]) || !empty($paper_quality[$key1]) || !empty($color[$key1])  || !empty($shape_paper[$key1]) || !empty($diameter[$key1]) || !empty($grommets[$key1])){
                $descriptionSave['qty']=$quantity_id;
				$descriptionSave['size_id']=$size_id;$descriptionSave['product_id']=$product_id;

                if(!empty($val1)){
					$ncr_number_parts_array=explode('@',$val1);
					$descriptionSave['ncr_number_parts']=$ncr_number_parts_array[0];
					$descriptionSave['ncr_number_parts_french']=$ncr_number_parts_array[1];
				}

				$descriptionSave['ncr_number_part_price']=$ncr_number_part_price[$key1];
				if(!empty($stock[$key1])){
					$stock_array=explode('@',$stock[$key1]);
					$descriptionSave['stock']=$stock_array[0];
					$descriptionSave['stock_french']=$stock_array[1];
				}

				$descriptionSave['stock_extra_price']=$stock_extra_price[$key1];

				if(!empty($paper_quality[$key1])){
					$paper_quality_array=explode('@',$paper_quality[$key1]);
					$descriptionSave['paper_quality']=$paper_quality_array[0];
					$descriptionSave['paper_quality_french']=$paper_quality_array[1];
				}

				$descriptionSave['paper_quality_extra_price']=$paper_quality_extra_price[$key1];
				$descriptionSave['color']=$color[$key1];
				if(!empty($color[$key1])){
					$color_array=explode('@',$color[$key1]);
					$descriptionSave['color']=$color_array[0];
					$descriptionSave['color_french']=$color_array[1];
				}

				$descriptionSave['color_extra_price']=$color_extra_price[$key1];

				if(!empty($grommets[$key1])){
					$grommets_array=explode('@',$grommets[$key1]);
					$descriptionSave['grommets']=$grommets_array[0];
					$descriptionSave['grommets_french']=$grommets_array[1];
				}
				$descriptionSave['grommets_extra_price']=$grommets_extra_price[$key1];

				if(!empty($shape_paper[$key1])){
					$shape_paper_array=explode('@',$shape_paper[$key1]);
					$descriptionSave['shape_paper']=$shape_paper_array[0];
					$descriptionSave['shape_paper_french']=$shape_paper_array[1];
				}

			    $descriptionSave['shape_paper_extra_price']=$shape_paper_extra_price[$key1];

				if(!empty($diameter[$key1])){
					$diameter_array=explode('@',$diameter[$key1]);
					$descriptionSave['diameter']=$diameter_array[0];
					$descriptionSave['diameter_french']=$diameter_array[1];
				}

			    $descriptionSave['diameter_extra_price']=$diameter_extra_price[$key1];
				$descriptionSave['created_at']=$created_at;
				$descriptionSave['updated_at']=$updated_at;
				$datas[]=$descriptionSave;
				}
		    }
			$success=1;
			if($datas){
		        $this->Product_Model->saveProductSize($datas,$insert_id);
			    $this->session->set_flashdata('message_success','Saved Size Attribute Successfully.');
				$attribute=$this->Product_Model->ProductOnlySizeAttributeDropDwon($product_id,$quantity_id,$size_id);
		    }else{
				$this->session->set_flashdata('message_success','Deleteed All Size Attribute successfully.');
			}
		}else{
			$success='0';
			$attribute=$this->Product_Model->ProductOnlySizeAttributeDropDwon($product_id,$quantity_id,$size_id);
		}
		//pr($attribute,1);
		$data['product_id']=$product_id;
		$data['quantity_id']=$quantity_id;
		$data['size_id']=$size_id;
		$data['attribute']=$attribute;
		$data['success']=$success;
		echo $this->load->view($this->class_name.'add_edit_product_size_attribute',$data,true);
		exit(0);
	}

	function deleteProductSize($product_id=null,$quantity_id=null,$id=null){
		if(!empty($product_id) && !empty($quantity_id) && !empty($id)){
			$page_title='Product Delete';
			$this->load->model('Product_Model');
			$this->Product_Model->deleteProductSize($product_id,$quantity_id,$id);
		}
		exit(0);
	}*/

	public function SetMultipleAttributes($id = null)
    {
		        $this->load->helper('form');
				$this->data['page_title'] = $page_title = 'Set Multiple Attributes';
				if (empty($id)){
					redirect('admin/Products');
				}
				$this->data['main_page_url'] = '';
				$this->load->model('Product_Model');
				$postData = [];
				$postData = $this->Product_Model->getProductDataById($id);
				$ProductSizes=array();
				$this->data['ProductSizes']=$this->Product_Model->ProductQuantySizeAttributeDropDwon($id);

				$this->data['MultipleAttributes']=$this->Product_Model->getMultipleAttributesDropDwon();

				//pr($this->data['ProductSizes'],1);

		        $this->data['postData'] = $postData;
	            $this->render($this->class_name.'product_multiple_attributes');
    }

	public function AddEditProductQuantity($product_id=null,$id=null){
		$this->load->helper('form');
		$this->load->model('Product_Model');
		$quantity=$this->Product_Model->getQuantityListDropDwon();
		$data['quantity']=$quantity;
		$data['BASE_URL']=base_url();
		$QualityData=array();
		$quantity_price=$quantity_id='';
		if($this->input->post()) {
			$quantity_id=$this->input->post('quantity_id');
			$quantity_price=$this->input->post('quantity_price');
			$product_id=$this->input->post('product_id');
			$id=$this->input->post('id');

			$ProductSizes=$this->Product_Model->ProductOnlyQuantityDropDwon($product_id);

			$QuantityIds=array_keys($ProductSizes);
			$quantity_price=!empty($quantity_price) ? $quantity_price:0;
			$SavedData['qty']        = $quantity_id;
			$SavedData['price']      = $quantity_price;
			$SavedData['product_id'] = $product_id;
			$saveQuantity=true;
			if($id){
			    $SavedData['id'] = $id;
			}
			if($id != $quantity_id && in_array($quantity_id,$QuantityIds)){
				$this->session->set_flashdata('message_error','This quantity already added to this product.');
				$saveQuantity=false;
			}

			if($saveQuantity){
				$insert_id=$this->Product_Model->saveProductQty($SavedData,$product_id);
				if($insert_id > 1){
					$success=1;
					if($id){
					   $this->session->set_flashdata('message_success','Updated Quantity Successfully.');
					}else{
						$this->session->set_flashdata('message_success','Added  Quantity Successfully.');
					}
				}else{
					$this->session->set_flashdata('message_error','Saved  Quantity Unsuccessfully.');
				}
		    }
		}else{
			$success='0';
			$ProductSizes=$this->Product_Model->ProductOnlyQuantityDropDwon($product_id);
			//pr($ProductSizes,1);
			$quantity_id=$id;
			$quantity_price=isset($ProductSizes[$quantity_id]['price']) ? $ProductSizes[$quantity_id]['price']:'';
		}
		$data['id']=$id;
		$data['product_id']=$product_id;
		$data['quantity_price']=$quantity_price;
		$data['quantity_id']=$quantity_id;
		$data['success']=$success;
		echo $this->load->view($this->class_name.'add_edit_product_quantity',$data,true);
		exit(0);
	}

	function deleteProductQuantity($product_id=null,$id=null){
		if(!empty($product_id) && !empty($id)){
			$page_title='Product Delete';
			$this->load->model('Product_Model');
			$this->Product_Model->deleteProductQty($product_id,$id);
		}
		exit(0);
	}

	public function AddEditProductSize($product_id=null,$quantity_id=null,$id=null){
		$this->load->helper('form');
		$this->load->model('Product_Model');
		$sizes=$this->Product_Model->getSizeListDropDwon();
		$data['sizes']=$sizes;
		$data['BASE_URL']=base_url();

		$size_price=$size_id='';
		if($this->input->post()) {
			//pr($_POST);
			$product_id=$this->input->post('product_id');
			$quantity_id=$this->input->post('quantity_id');
			$size_price=$this->input->post('size_price');
			$size_id=$this->input->post('size_id');
			$id=$this->input->post('id');

			$ProductSizes=$this->Product_Model->ProductOnlySizeDropDwon($product_id,$quantity_id);
			$SizesIds=array_keys($ProductSizes);

			$size_price=!empty($size_price) ? $size_price:0;
			$SavedData['product_id']      = $product_id;
			$SavedData['qty']             = $quantity_id;
			$SavedData['size_id']         = $size_id;
			$SavedData['extra_price']     = $size_price;
			$saveQuantity=true;

			if($id){
			    $SavedData['id'] = $id;
			}
			if($id != $size_id && in_array($size_id,$SizesIds)){
				$this->session->set_flashdata('message_error','This size already added to this product & Quantity');
				$saveQuantity=false;
			}
			if($saveQuantity){
				$insert_id=$this->Product_Model->saveProductSizeData($SavedData,$product_id);
				if($insert_id > 1){
					$success=1;
					if($id){
					   $this->session->set_flashdata('message_success','Updated Size Successfully.');
					}else{
						$this->session->set_flashdata('message_success','Added  Size Successfully.');
					}
				}else{
					$this->session->set_flashdata('message_error','Saved  Size Unsuccessfully.');
				}
		    }
		}else{
			$success='0';
			$ProductSizes=$this->Product_Model->ProductOnlySizeDropDwon($product_id,$quantity_id);

			$size_id=$id;
			$size_price=isset($ProductSizes[$size_id]['extra_price']) ? $ProductSizes[$size_id]['extra_price']:'';
		}
		$data['product_id']=$product_id;
		$data['quantity_id']=$quantity_id;
		$data['id']=$id;
		$data['size_price']=$size_price;
		$data['size_id']=$size_id;
		$data['success']=$success;
		echo $this->load->view($this->class_name.'add_edit_product_size',$data,true);
		exit(0);
	}

	public function AddEditProductAttribute($product_id=null,$quantity_id=null,$size_id=null,$attribute_id=null,$id=null){
		$this->load->helper('form');
		$this->load->model('Product_Model');
		$MultipleAttributes=$this->Product_Model->getMultipleAttributesDropDwon();
		$data['BASE_URL']=base_url();
		$attributeData=array();
		$attribute_item_id=$extra_price='';
		if($this->input->post()) {
			$product_id=$this->input->post('product_id');
			$quantity_id=$this->input->post('quantity_id');
			$size_id=$this->input->post('size_id');
			$attribute_id=$this->input->post('attribute_id');
			$attribute_item_id=$this->input->post('attribute_item_id');
			$id=$this->input->post('id');
			$extra_price=$this->input->post('extra_price');

			$ProductSizes=$this->Product_Model->ProductOnlySizeMultipleAttributesDropDwon($product_id,$quantity_id,$size_id,$attribute_id);
			$attributeItemsIds=array_keys($ProductSizes);

			$extra_price=!empty($extra_price) ? $extra_price : 0;
			$SavedData['product_id']      = $product_id;
			$SavedData['qty']             = $quantity_id;
			$SavedData['size_id']         = $size_id;
			$SavedData['attribute_id']         = $attribute_id;
			$SavedData['attribute_item_id']         = $attribute_item_id;
			$SavedData['extra_price'] = $extra_price;
			$saveQuantity=true;
			$attribute_item_id_old='';
			if($id){
				$SavedData['id'] = $id;
				$attributData=$this->Product_Model->ProductSizeMultipleAttributeBYId($id);
				$attribute_item_id_old=$attributData['attribute_item_id'];
			}

			if($attribute_item_id_old !=$attribute_item_id && in_array($attribute_item_id,$attributeItemsIds)){
				$this->session->set_flashdata('message_error','This attribute item already added to this product & Quantity & size');
				$saveQuantity=false;
			}

			if($saveQuantity){
				$insert_id=$this->Product_Model->saveSizeMultipleAttributesData($SavedData,$product_id);
				if($insert_id > 1){
					$success=1;
					if($id){
					   $this->session->set_flashdata('message_success','Updated attribute item  successfully.');
					}else{
						$this->session->set_flashdata('message_success','Added  attribute item Successfully.');
					}
				}else{
					$this->session->set_flashdata('message_error','Saved  attribute item Unsuccessfully.');
				}
		    }
		}else{
			if(!empty($id)){
				$attributData=$this->Product_Model->ProductSizeMultipleAttributeBYId($id);
			}

			$attribute_item_id=isset($attributData['attribute_item_id']) ? $attributData['attribute_item_id']:'';

			$extra_price=isset($attributData['extra_price']) ? $attributData['extra_price']:0;
		}

		$data['product_id']=$product_id;
		$data['quantity_id']=$quantity_id;
		$data['size_id']=$size_id;
		$data['attribute_id']=$attribute_id;
		$data['attribute_item_id']=$attribute_item_id;
		$data['extra_price']=$extra_price;
		$data['id']=$id;
		$data['MultipleAttributes']=$MultipleAttributes;
		$data['success']=$success;
		echo $this->load->view($this->class_name.'add_edit_product_multiple_attribute',$data,true);
		exit(0);
	}

	function deleteProductSize($product_id=null,$quantity_id=null,$id=null){
		if(!empty($product_id) && !empty($quantity_id) && !empty($id)){
			$page_title='Product Delete';
			$this->load->model('Product_Model');
			$this->Product_Model->deleteProductSize($product_id,$quantity_id,$id);
		}
		exit(0);
	}

	function deleteProductMultipalAttribute($id=null){
		if(!empty($id)){
			$page_title='Product Attribute';
			$this->load->model('Product_Model');
			$this->Product_Model->deleteProductMultipalAttribute($id);
		}
		exit(0);
	}

	public function SetSingleAttributes($id = null)
    {
				$this->load->helper('form');
				$this->data['page_title'] = $page_title = 'Set Single Attributes';
				if (empty($id)){
					redirect('admin/Products');
				}

				$this->data['main_page_url'] = '';
				$this->load->model('Product_Model');

				$postData = [];
				$postData = $this->Product_Model->getProductDataById($id);
				$AttributesList=$this->Product_Model->getAttributesListDropDwon();
				$this->data['AttributesList']=$AttributesList;
				$ProductAttributes=$this->Product_Model->getProductAttributesByItemId($id);
				$this->data['ProductAttributes']=$ProductAttributes;

				if($this->input->post()) {
					$postData['id']=$this->input->post('id');
					$saveData = true;

                    $insert_id=$this->Product_Model->saveProduct($postData);
					if ($insert_id > 0) {
							$attributes_data = array();
							$attributes_item_data = array();

						    foreach($AttributesList as $key=>$val){
								$attributes_sdata=array();
								$attribute_name='attribute_id_'.$key;
								$attribute_id=isset($_POST[$attribute_name]) ? $this->input->post($attribute_name):'';

								if(!empty($attribute_id)){
									$attributes_sdata['attribute_id']=$attribute_id;
									$attributes_sdata['show_order']= !empty($this->input->post('attribute_order_'.$attribute_id)) ? $this->input->post('attribute_order_'.$attribute_id) : 0;

									$attributes_sdata['created']=date('Y-m-d H:i:s');
									$attributes_sdata['updated']=date('Y-m-d H:i:s');
									$attributes_sdata['product_id']=$insert_id;

									$product_attribute_item_ids =!empty($this->input->post('attribute_item_id_'.$attribute_id)) ? $this->input->post('attribute_item_id_'.$attribute_id):array();

									$attribute_item_orders =!empty($this->input->post('attribute_item_order_'.$attribute_id)) ? $this->input->post('attribute_item_order_'.$attribute_id):array();

									$attribute_item_extra_prices =!empty($this->input->post('attribute_item_extra_price_'.$attribute_id)) ? $this->input->post('attribute_item_extra_price_'.$attribute_id):array();

									foreach($product_attribute_item_ids as $subkey=>$subval){
										$attributes_item_sdata=array();
										if(!empty($subval)){
											$attributes_item_sdata['attribute_id']=$attribute_id;
											$attributes_item_sdata['attribute_item_id']=$subval;
									        $attributes_item_sdata['show_order'] =$attribute_item_orders[$subkey];
											$attributes_item_sdata['extra_price']=$attribute_item_extra_prices[$subkey];
									        $attributes_item_sdata['created']=date('Y-m-d H:i:s');
									        $attributes_item_sdata['updated']=date('Y-m-d H:i:s');
									        $attributes_item_sdata['product_id']=$insert_id;
											$attributes_item_data[]=$attributes_item_sdata;
										}
									}
							      $attributes_data[]=$attributes_sdata;
								}
							}

							$this->Product_Model->saveProductAttributesData($attributes_data,$attributes_item_data,$insert_id);

				    $created_at=$updated_at=date('Y-m-d H:i:s');
				    $this->session->set_flashdata('message_success',$page_title.' Successfully.');
				    redirect('admin/Products');
			} else {
					$this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
					}
		}
		$this->data['postData'] = $postData;
		$this->data['ProductAttributes']=$ProductAttributes;
	    $this->render($this->class_name.'product_single_attribute');
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

	public function deleteAllProduct()
    {
        $product_ids=$this->input->post('product_ids');
		//pr($product_ids,1);

        if(!empty($product_ids)){
			    $delete=false;

				$page_title='Product Delete';
				$this->load->model('Product_Model');
				$this->load->model('ProductImage_Model');
			foreach($product_ids as $id){
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

					$delete=true;
				}
			}
            if($delete){
				$this->session->set_flashdata('message_success',$page_title.' Successfully.');
			}else{
				 $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
			}
		}else{
			$this->session->set_flashdata('message_error','Select at least one product for delete.');
	    }

		redirect('admin/Products');
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
	        $width=400;
		    $height=390;
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

	public function estimates()
	{
			$this->load->model('Estimate_Model');
			$this->data['page_title'] = 'Product Estimates';
            $this->data['sub_page_title'] = 'View Product Estimates';
			$this->data['sub_page_view_url'] = 'viewProductEstimates';
			$this->data['sub_page_delete_url'] = 'deleteProductEstimates';
			$estimates = $this->Estimate_Model->getAllEstimates();
			$this->load->model('Store_Model');
		    $StoreList=$this->Store_Model->getAllStoreList();
		    $this->data['StoreList']=$StoreList;

			$this->data['estimates'] = $estimates ;
			$this->render($this->class_name.'estimates');
	}

	 public function viewProductEstimates($id=null)
    {
		if(empty($id)){
			redirect('admin/estimates');
		}
		$this->load->model('Estimate_Model');
		$this->load->model('Address_Model');
		$this->data['page_title'] = 'Estimates Details';
		$this->data['main_page_url'] = 'estimates';
		$Product=$this->Estimate_Model->getEstimateDataById($id);
		$steate=$this->Address_Model->getStateById($Product['province']);
		$Product['province']=$steate['StateName'];
		$country=$this->Address_Model->getCountryById($Product['country']);
		$Product['country']=$country['CountryName'];
		$this->data['Product']=$Product;
		$this->load->model('Store_Model');
		$StoreList=$this->Store_Model->getAllStoreList();
		$this->data['StoreList']=$StoreList;

		$this->render($this->class_name.'view_esimates.php');
    }

	public function deleteProductEstimates($id=null)
    {
        if(!empty($id)){
				$page_title='Product Estimates Delete';
				$this->load->model('Estimate_Model');
				if ($this->Estimate_Model->deleteProductEstimates($id))
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

		redirect('admin/Products/estimates');
    }

	public function searchProduct()
    {
		$searchtext=$this->input->post('searchtext');
        if($searchtext !=''){
			$searchtext=trim($searchtext);
			$this->load->model('Product_Model');
		    $lists=$this->Product_Model->getProductSearchAdminList($searchtext);
			$search_reslut='';
			if(!empty($lists)){
				foreach($lists as $list){
				   //pr($list);
				   $name=ucfirst($list['name']);
				   $imageurl=getProductImage($list['product_image']);

				   $product_id=$list['id'];

				   $search_reslut.='<li><a href="'.base_url(). 'admin/Products/index/'.$product_id.'"><img src="'.$imageurl.'" width=50><span></i>'.$name.'</span></li></a>';
				}
			}else{
			   $search_reslut='<li><i class="fas fa-search"></i> <span>product not found </span></li>';
			}
		}else{
			echo $search_reslut='<li><i class="fas fa-search"></i><a href="javascript:void(0)">product not found</a></li>';
		}
       echo $search_reslut;
    }

	public function sizeOptions($type=null){
        $this->load->model('Product_Model');
		$page_title="Product ";
		$sub_page_title="Add New ";

		if($type=="paper_quality"){
			$page_title=$title."Paper Quality";
			$sub_page_title=$sub_page_title."Paper Quality";

			$lists=$this->Product_Model->sizeOptions($type);
		}else if($type=="ncr_parts"){
			$page_title=$title."NCR Number of Parts";
			$sub_page_title=$sub_page_title."NCR Number of Part";

			$lists=$this->Product_Model->sizeOptions($type);
		}else if($type=="colors"){
			$page_title=$title."Printed Color";
			$sub_page_title=$sub_page_title."Printed Color";

			$lists=$this->Product_Model->sizeOptions($type);
		}else if($type=="stocks"){
			$page_title=$title."Background";
			$sub_page_title=$sub_page_title."Background";

			$lists=$this->Product_Model->sizeOptions($type);
		}else if($type=="diameter"){
			$page_title=$title."Diameter";
			$sub_page_title=$sub_page_title."Diameter";

			$lists=$this->Product_Model->sizeOptions($type);
		}
		else if($type=="shapepaper"){
			$page_title=$title."
Coating";
			$sub_page_title=$sub_page_title."
Coating";

			$lists=$this->Product_Model->sizeOptions($type);
		}else if($type=="grommets"){
			$page_title=$title."Grommets";
			$sub_page_title=$sub_page_title."Grommets";
			$lists=$this->Product_Model->sizeOptions($type);
		}

		else if($type=="grommets"){
			$page_title=$title."Grommets";
			$sub_page_title=$sub_page_title."Grommets";
			$lists=$this->Product_Model->sizeOptions($type);
		}
		else if($type=="page_size"){
			$page_title=$title."Pages";
			$sub_page_title=$sub_page_title."Page";
			$lists=$this->Product_Model->sizeOptions($type);
		}
		else if($type=="page_quantity"){
			$page_title=$title."Quantity";
			$sub_page_title=$sub_page_title."Quantity";
			$lists=$this->Product_Model->sizeOptions($type);
		}
		else if($type=="sheets"){
			$page_title=$title."Sheets";
			$sub_page_title=$sub_page_title."Sheet";
			$lists=$this->Product_Model->sizeOptions($type);
		}

		$this->data['page_title'] =$page_title;
		$this->data['sub_page_title'] =$sub_page_title;
		$this->data['sub_page_url'] = 'addEditSizeOptions';
		$this->data['sub_page_view_url'] = '';
		$this->data['sub_page_delete_url'] = 'DeleteSizeOptions';
		$this->data['sub_page_url_active_inactive'] = 'activeInactiveSizeOptions';
		$this->data['lists']=$lists;
		$this->data['type']=$type;

		$this->render($this->class_name.'size_options');
	}

    public function addEditSizeOptions($id=null,$type=null)

    {
        $this->load->helper('form');
		$page_title='';
		$this->load->model('Product_Model');
		$postData=array();

		if($type=="paper_quality"){
			$page_title="Paper Quality";
		}else if($type=="ncr_parts"){
			$page_title="NCR Number of Part";
		}else if($type=="colors"){
			$page_title="Printed Color";
		}else if($type=="stocks"){
			$page_title="Background";
		}else if($type=="diameter"){
			$page_title="Diameter";
		}
		else if($type=="shapepaper"){
			$page_title="Coating";
		}else if($type=="grommets"){
			$page_title="Grommet";
		}else if($type=="page_size"){
			$page_title="Page";
		}else if($type=="page_quantity"){
			$page_title="Quantity";
		}else if($type=="sheets"){
			$page_title="Sheet";
		}

		if(!empty($id)){
		   $page_title="Edit ".$page_title;
		   $postData=$this->Product_Model->getDataById($type,$id);
		}else{
			$page_title="Add ".$page_title;
		}

		$this->data['page_title'] = $page_title;
		$this->data['main_page_url'] = 'sizeOptions/'.$type;
		if($this->input->post()){
			$this->load->library('form_validation');
			$set_rules=$this->Product_Model->configSizeOptions;
			$this->form_validation->set_rules($set_rules);
			$this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

			if(!empty($id)){
			   $postData['id']=$this->input->post('id');
			}

			$postData['name']=$this->input->post('name');
			$postData['name_french']=$this->input->post('name_french');

			if($type=='page_size'){
				$postData['total_page']=$this->input->post('total_page');
			}
			if($this->form_validation->run()===TRUE)
			{
			    $insert_id=$this->Product_Model->save($type,$postData);

				if ($insert_id > 0)
				{
					$this->session->set_flashdata('message_success',$page_title.' Successfully.');

					redirect('admin/Products/sizeOptions/'.$type);
				}
				else
				{
					$this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
			}else{
				$this->session->set_flashdata('message_error','Missing information.');
			}
		}

	    $this->data['postData']=$postData;
        $this->data['type']=$type;
	    $this->render($this->class_name.'add_edit_size_option');
    }

    public function activeInactiveSizeOptions($id=null,$status=null,$type=null)
    {
        if($type=="paper_quality"){
			$page_title="Paper Quality";
		}else if($type=="ncr_parts"){
			$page_title="NCR Number of Part";
		}else if($type=="colors"){
			$page_title="Printed Color";
		}else if($type=="stocks"){
			$page_title="Background";
		}else if($type=="diameter"){
			$page_title="Diameter";
		}
		else if($type=="shapepaper"){
			$page_title="Coating";
		}else if($type=="grommets"){
			$page_title="Grommet";
		}else if($type=="page_size"){
			$page_title="Page";
		}else if($type=="page_quantity"){
			$page_title="Quantity";
		}else if($type=="sheets"){
			$page_title="Sheet";
		}

        if(!empty($id) && ($status==1 || $status==0)){
			    $postData['id']=$id;
		        $postData['status']=$status;

				$this->load->model('Product_Model');
				if($status==0){
					$page_title=$page_title.' Inactive';
				}else{
					$page_title=$page_title.' Active';
				}

				if ($this->Product_Model->save($type,$postData))
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
		redirect('admin/Products/sizeOptions/'.$type);
    }

	public function DeleteSizeOptions($id=null,$type)
    {
        if(!empty($id)){
                if($type=="paper_quality"){
			        $page_title="Paper Quality";
				}else if($type=="ncr_parts"){
					$page_title="NCR Number of Part";
				}else if($type=="colors"){
					$page_title="Printed Color";
				}else if($type=="stocks"){
					$page_title="Background";
				}else if($type=="diameter"){
					$page_title="Diameter";
				}
				else if($type=="shapepaper"){
					$page_title="Coating";
				}else if($type=="grommets"){
			       $page_title="Grommet";
		        }else if($type=="page_size"){
			        $page_title="Page Size";
		        }else if($type=="page_quantity"){
					$page_title="Quantity";
				}else if($type=="sheets"){
					$page_title="Sheet";
				}
				$page_title=$page_title.' Delete';
				$this->load->model('Product_Model');
				if ($this->Product_Model->delete($type,$id))
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
		redirect('admin/Products/sizeOptions/'.$type);
    }

	public function exportCSV($category_id=13){
		$this->load->model('Product_Model');
		$lists = $this->Product_Model->getCSVProductList($category_id);
		$filename = 'product-'.date('d').'-'.date('m').'-'.date('Y').'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv;");
		// file creation
		$file = fopen('php://output', 'w');

		$header = array("Product Name","Code","Model");
		fputcsv($file, $header);
		foreach ($lists as $key=>$list){
			$data=array();
			$data['name']  = $list['name'];
			//$data['sub_category_name']  = $list['sub_category_name'];
			//$data['category_name']  = $list['category_name'];
			$data['code']  = $list['code'];
			$data['model'] = $list['model'];
		    fputcsv($file,$data);
		}

		fclose($file);
		exit;
	}

	function Cron(){
		set_time_limit(0);
		echo 'Cron Start...';
		$this->load->model('Product_Model');
		//$ProductList=$this->Product_Model->getProductList();
		$this->db->select(array('*'));
        $this->db->from('product_order_items');
        $query = $this->db->get();
		$ProductList=$query->result_array();
		//pr($ProductList,1);
		//$i=0;

		foreach($ProductList as $product){
			$saveProductData=array();
			$id=$product['id'];
			$saveProductData['id']=$id;
			$saveProductData['name_french']=!empty($product['name']) && empty($product['name_french']) ? FRCNew2($product['name']):'';

			//$saveProductData['image_french']=!empty($product['image']) ? $product['image']:'';

			/*$saveProductData['item_name_french']=!empty($product['name_french']) ? FRCNew2($product['name_french']):'';
			$saveProductData['product_attribute_id']=7;

			/*$saveProductData['paper_quality_french']=!empty($product['paper_quality']) ? FRCNew2($product['paper_quality']):'';

         	$saveProductData['color_french']=!empty($product['color']) ? FRCNew2($product['color']):'';

			$saveProductData['diameter_french']=!empty($product['diameter']) ? FRCNew2($product['diameter']):'';

			$saveProductData['shape_paper_french']=!empty($product['shape_paper']) ? FRCNew2($product['shape_paper']):'';

			$saveProductData['grommets_french']=!empty($product['grommets']) ? FRCNew2($product['grommets']):'';*/

			$this->db->where('id', $id);
			//$updated = $this->db->update('product_order_items', $saveProductData);

			//$updated = $this->db->insert('product_multiple_attribute_items', $saveProductData);

			//$updated=$this->Product_Model->saveProduct($saveProductData);

			if($updated > 0){
				$i++;
			}

			//}
		}
		echo $i.'updated';
	}

	function UpdatedQtyTable(){
		set_time_limit(0);
		echo 'Cron Start...';
		$this->load->model('Product_Model');
		$this->db->select(array('*'));
        $this->db->from('product_size');
		$this->db->group_by('product_id');
        $query = $this->db->get();
		$ProductList=$query->result_array();
		$i=0;
		foreach($ProductList as $product){
			$quantitydata=$this->Product_Model->ProductQuantityDropDwon($product['product_id']);
			foreach($quantitydata as $key=>$val){
				$saveProductQuantityData=array();
				$saveProductQuantityData['qty']=$key;
				$saveProductQuantityData['price']=$val['price'];
				$saveProductQuantityData['product_id']=$product['product_id'];
				$saveProductQuantityData['updated_at']=$saveProductQuantityData['created_at']=date('Y-m-d H:i:s');
				//$this->db->insert('product_Quantity', $saveProductQuantityData);
				$sizeData=$val['sizeData'];

				foreach($sizeData as $skey=>$sval){
					$saveProductSizeData=array();
					$saveProductSizeData['qty']=$key;
					$saveProductSizeData['size_id']=$skey;
					$saveProductSizeData['extra_price']=$sval['extra_price'];
					$saveProductSizeData['product_id']=$product['product_id'];
					$saveProductSizeData['updated_at']=$saveProductSizeData['created_at']=date('Y-m-d H:i:s');
					$attributeNew=array();
					$items=$sval['attribute'];
					foreach($items as $akey=>$aval){
						$addRow=false;
						if(!empty($aval['ncr_number_parts'])){
						   $addRow=true;
						}
						if(!empty($aval['stock'])){
							 $addRow=true;
						}
						if(!empty($aval['paper_quality'])){
							 $addRow=true;
						}
						if(!empty($aval['diameter'])){
							 $addRow=true;
						}
						if(!empty($aval['shape_paper'])){
							 $addRow=true;
						}
						if(!empty($aval['color'])){
							 $addRow=true;
						}
						if(!empty($aval['grommets'])){
							 $addRow=true;
						}
						if($addRow){
							$attributeNew[]=$aval;
							//$id=$aval['id'];
							//$this->db->where('id',$id);
                            //$query = $this->db->delete('product_size');
						}
					}

					//pr($attributeNew);

					//$this->db->insert('product_size_new', $saveProductSizeData);
				}
			}

			/*
			$saveProductData['qty']=$id;
			$saveProductData['product_id']=$product['id'];
			$updated = $this->db->insert('product_quantity', $saveProductData);
			if($updated > 0){
				$i++;
			}*/
		}
		echo $i.'updated';
	}

	function UpdatedTableData(){
		    set_time_limit(0);
		    echo 'Cron Start...';
		    $this->db->select(array('*'));
            $this->db->from('categories_images');
			$this->db->where('main_store_id',1);
            $query = $this->db->get();
		    $categoriesImages=$query->result_array();
			foreach($categoriesImages as $key=>$val){
				unset($val['id']);
			    $val['main_store_id']=3;
				#$query = $this->db->insert('categories_images',$val);
		    }
	}

	function updateCity(){
		$fileName=FILE_BASE_PATH.'csv/cities.csv';
		$file = fopen($fileName, "r");
		$i==1;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            if($i > 1){
				#pr($column);
				$id=$column['0'];
				$name=$column['1'];
				$saveProductQuantityData=array();
				$saveProductQuantityData['id']=$id;
				$saveProductQuantityData['name']=$name;
				$this->db->where('id', $id);
			    #$query = $this->db->update('cities', $saveProductQuantityData);
			}
			$i++;
        }
	}

	public function SetMultipleAttributesAuto($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Set Multiple Attributes (Automatic)';
        if (empty($id)) {
            redirect('admin/Products');
        }
        $this->data['main_page_url'] = '';
        $this->load->model('Product_Model');

        $this->data['product']                  = $this->Product_Model->getProductDataById($id);
        // $this->data['quantities']           = $this->Product_Model->quantities();
        // $this->data['sizes']                = $this->Product_Model->sizes();
        $this->data['productQuantities']        = $this->Product_Model->productQuantities($id);
        $this->data['productSizes']             = $this->Product_Model->productAutoSizes($id);
        $this->data['productAttributes']        = $this->Product_Model->productAutoAttributes($id);
        $this->data['productAttributeDetails']  = $this->Product_Model->productAutoAttributeDetails($id);

        $this->render($this->class_name.'product_multiple_attributes_auto');
    }

    public function AutoSizeAdd($product_id = null, $id = null) {
        $this->load->helper('form');
        $this->load->model('Product_Model');

        $data['BASE_URL'] = base_url();

        $sizes = $this->Product_Model->sizes();
        $data['sizes'] = $sizes;

        $extra_price = $size_id = '';
        if ($this->input->post()) {
            //pr($_POST);
            $id             = $this->input->post('id');
            $product_id     = $this->input->post('product_id');
            $size_id        = $this->input->post('size_id');
            $extra_price    = $this->input->post('extra_price');

            $productSizes   = $this->Product_Model->productAutoSizes($product_id);
            $sizeIds = array();
            foreach ($productSizes as $size)
                $sizeIds[] = $size['id'];

            $extra_price = !empty($extra_price) ? $extra_price : 0;
            $SavedData['product_id']    = $product_id;
            $SavedData['size_id']       = $size_id;
            $SavedData['extra_price']   = $extra_price;
            $saved = true;

            if ($id) {
                $SavedData['id'] = $id;
            }
            if ($id != $size_id && in_array($size_id, $sizeIds)) {
                $this->session->set_flashdata('message_error', 'This size already added to this product');
                $saved = false;
            }

            if ($saved) {
                $insert_id = $this->Product_Model->autoSizeAdd($SavedData);
                if ($insert_id > 0) {
                    $success = 1;
                    if ($id)
                        $this->session->set_flashdata('message_success', 'Updated Size Successfully.');
                    else
                        $this->session->set_flashdata('message_success', 'Added Size Successfully.');
                } else {
                    $this->session->set_flashdata('message_error', 'Saved Size Unsuccessfully.');
                }
            }
        } else {
            $success        = '0';
            $productSizes   = $this->Product_Model->productAutoSizes($product_id);
            $size_id        = $id;
            $extra_price    = 0;
            foreach ($productSizes as $size) {
                if ($size['id'] == $size_id)
                    $extra_price = $size['extra_price'];
            }
        }

        $data['id']             = $id;
        $data['product_id']     = $product_id;
        $data['size_id']        = $size_id;
        $data['extra_price']    = $extra_price;
        $data['success']        = $success;
        echo $this->load->view($this->class_name.'auto_size_add', $data, true);
        exit(0);
    }

    function autoSizeDelete($product_id, $size_id) {
        $this->load->model('Product_Model');
        if ($this->Product_Model->autoSizeDelete($product_id, $size_id))
            echo "1";
        else
            echo "0";
    }

    public function AutoAttributeAdd($product_id = null, $id = null) {
        $this->load->helper('form');
        $this->load->model('Product_Model');

        $data['BASE_URL'] = base_url();

        $attributes = $this->Product_Model->attributes();
        $data['attributes'] = $attributes;

        if ($this->input->post()) {
            $id             = $this->input->post('id');
            $product_id     = $this->input->post('product_id');
            $attribute_id   = $this->input->post('attribute_id');

            $productAttributes = $this->Product_Model->productAutoAttributes($product_id);
            $attributeIds = array();
            foreach ($productAttributes as $attribute)
                $attributeIds[] = $attribute['id'];

            $SavedData['product_id']    = $product_id;
            $SavedData['attribute_id']  = $attribute_id;
            $saved = true;

            if ($id) {
                $SavedData['id'] = $id;
            }
            if ($id != $attribute_id && in_array($attribute_id, $attributeIds)) {
                $this->session->set_flashdata('message_error', 'This attribute already added to this product');
                $saved = false;
            }

            if ($saved) {
                $insert_id = $this->Product_Model->autoAttributeAdd($SavedData);
                if ($insert_id > 0) {
                    $success = 1;
                    if ($id)
                        $this->session->set_flashdata('message_success', 'Updated Attribute Successfully.');
                    else
                        $this->session->set_flashdata('message_success', 'Added Attribute Successfully.');
                } else {
                    $this->session->set_flashdata('message_error', 'Saved Attribute Unsuccessfully.');
                }
            }
        } else {
            $success            = '0';
            $productAttributes  = $this->Product_Model->productAutoAttributes($product_id);
            $attribute_id       = $id;
        }

        $data['id']             = $id;
        $data['product_id']     = $product_id;
        $data['attribute_id']   = $attribute_id;
        $data['success']        = $success;
        echo $this->load->view($this->class_name.'auto_attribute_add', $data, true);
        exit(0);
    }

    function autoAttributeDelete($product_id, $attribute_id) {
        $this->load->model('Product_Model');
        if ($this->Product_Model->autoAttributeDelete($product_id, $attribute_id))
            echo "1";
        else
            echo "0";
    }

    public function autoAttributeItemAdd($product_id = null, $attribute_id = null, $id = null) {
        $this->load->helper('form');
        $this->load->model('Product_Model');

        $data['BASE_URL'] = base_url();

        $attributeItems = $this->Product_Model->attributeItems($attribute_id);
        $data['attributeItems'] = $attributeItems;

        $extra_price = $attribute_item_id = '';
        if ($this->input->post()) {
            $id                 = $this->input->post('id');
            $product_id         = $this->input->post('product_id');
            $attribute_id       = $this->input->post('attribute_id');
            $attribute_item_id  = $this->input->post('attribute_item_id');
            $extra_price        = $this->input->post('extra_price');

            $productAttributeItems = $this->Product_Model->productAutoAttributeItems($product_id, $attribute_id);
            $itemIds = array();
            foreach ($productAttributeItems as $item)
                $itemIds[] = $item['id'];

            $extra_price = !empty($extra_price) ? $extra_price : 0;
            $SavedData['product_id']        = $product_id;
            $SavedData['attribute_id']      = $attribute_id;
            $SavedData['attribute_item_id'] = $attribute_item_id;
            $SavedData['extra_price']       = $extra_price;
            $saved = true;

            if ($id) {
                $SavedData['id'] = $id;
            }
            if ($id != $attribute_item_id && in_array($attribute_item_id, $itemIds)) {
                $this->session->set_flashdata('message_error', 'This attribute item already added to this product');
                $saved = false;
            }

            if ($saved) {
                $insert_id = $this->Product_Model->autoAttributeItemAdd($SavedData);
                if ($insert_id > 0) {
                    $success = 1;
                    if ($id)
                        $this->session->set_flashdata('message_success', 'Updated Attribute Item Successfully.');
                    else
                        $this->session->set_flashdata('message_success', 'Added Attribute Item Successfully.');
                } else {
                    $this->session->set_flashdata('message_error', 'Saved Attribute Item Unsuccessfully.');
                }
            }
        } else {
            $success                = '0';
            $productAttributeItems  = $this->Product_Model->productAutoAttributeItems($product_id, $attribute_id);
            $attribute_item_id      = $id;
            $extra_price            = 0;
            foreach ($productAttributeItems as $item) {
                if ($item['id'] == $attribute_item_id)
                    $extra_price = $item['extra_price'];
            }
        }

        $data['id']                 = $id;
        $data['product_id']         = $product_id;
        $data['attribute_id']       = $attribute_id;
        $data['attribute_item_id']  = $attribute_item_id;
        $data['extra_price']        = $extra_price;
        $data['success']            = $success;
        echo $this->load->view($this->class_name.'auto_attribute_item_add', $data, true);
        exit(0);
    }

    function autoAttributeItemDelete($product_id, $attribute_id, $attribute_item_id) {
        $this->load->model('Product_Model');
        if ($this->Product_Model->autoAttributeItemDelete($product_id, $attribute_id, $attribute_item_id))
            echo "1";
        else
            echo "0";
    }

    function autoGenerateAttributes($product_id) {
        $this->load->model('Product_Model');
        if ($this->Product_Model->autoGenerateAttributes($product_id))
            echo "1";
        else
            echo "0";
    }

    function AutoExcelGen($product_id) {
        $this->load->model('Product_Model');
        $product = $this->Product_Model->getProductDataById($product_id);
        $data = $this->Product_Model->autoAttributesReportGenerate($product_id);

        $header = array(
            'Quantity'      => 'integer',
            'Size'          => 'string',
            'Attribute'     => 'string',
            'Item'          => 'string',
            'Extra Price'   => 'price',
        );
        // $header = array(
        //     'c1-text'=>'string',//text
        //     'c2-text'=>'@',//text
        //     'c3-integer'=>'integer',
        //     'c4-integer'=>'0',
        //     'c5-price'=>'price',
        //     'c6-price'=>'#,##0.00',//custom
        //     'c7-date'=>'date',
        //     'c8-date'=>'YYYY-MM-DD',
        //     );
        $writer = new XLSXWriter();

        $writer->writeSheetHeader('Sheet1', $header);
        foreach($data as $row)
            $writer->writeSheetRow('Sheet1', $row);

        //$writer->writeSheet($rows,'Sheet1', $header);//or write the whole sheet in 1 call

        //$writer->writeToFile('xlsx-simple.xlsx');
        //$writer->writeToStdOut();
        //echo $writer->writeToString();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $product['name'] . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }

    function AutoExcelGenCurrent($product_id) {
        $this->load->model('Product_Model');
        $product = $this->Product_Model->getProductDataById($product_id);
        $data = $this->Product_Model->autoAttributesReportGenerateCurrent($product_id);

        $header = array(
            'Quantity'      => 'integer',
            'Size'          => 'string',
            'Attribute'     => 'string',
            'Item'          => 'string',
            'Extra Price'   => 'price',
        );
        $writer = new XLSXWriter();

        $writer->writeSheetHeader('Sheet1', $header);
        foreach($data as $row)
            $writer->writeSheetRow('Sheet1', $row);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $product['name'] . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }

    function uploadAttributes($product_id) {
        $this->load->model('Product_Model');

        $file = $_FILES['file'];
        //$spreadsheet = IOFactory::load("c:\\Users\\Administrator\\Downloads\\notepads.xlsx");//$file['tmp_name']);
        $spreadsheet = IOFactory::load($file['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $result = $this->Product_Model->autoBatchAttribute($product_id, $sheetData);
        if ($result >= 0)
            echo json_encode(array('result' => 1, 'failed' => $result));
        else
            echo json_encode(array('result' => 0));

        exit();
    }

    function uploadFullPriceList($product_id) {
        $this->load->model('Product_Model');

        $file = $_FILES['file'];
        //$spreadsheet = IOFactory::load("d:\\work\\2021.12.04-Scrap-mefa(Ca)\\PP_pp_notepads_np-all.xlsx");//$file['tmp_name']);
        $spreadsheet = IOFactory::load($file['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $result = $this->Product_Model->autoBatchFullPriceList($product_id, $sheetData);
        if ($result >= 0)
            echo json_encode(array('result' => 1, 'failed' => $result));
        else
            echo json_encode(array('result' => 0));

        exit();
    }
}
