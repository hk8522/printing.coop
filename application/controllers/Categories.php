<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends Admin_Controller
{
        public $class_name='';

        function __construct()
        {
                parent::__construct();
                $this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
                $this->data['class_name']= $this->class_name;
        }

    public function index()
    {
                $this->load->model('Category_Model');
                $this->data['page_title'] = 'Category';
                $this->data['sub_page_title'] = 'Add New Category';
                $this->data['sub_page_url'] = 'addEdit';
                $this->data['sub_page_delete_url'] = 'deleteCategory';
                $this->data['sub_page_url_active_inactive'] = 'activeInactive';
                $lists = $this->Category_Model->getCategoryList();
                $this->data['lists'] = $lists;
                $this->render($this->class_name.'index');
    }

    public function addEdit($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Category';
        if ($id) {
         $this->data['page_title'] = $page_title = 'Edit Category';
        }
        $this->data['main_page_url'] = '';
        $this->load->model('Category_Model');
        $this->load->model('Store_Model');
        $postData = [];

        $postData = $this->Category_Model->getCategoryDataById($id);
        $CategoriesImageData= $this->Category_Model->getCategoriesImagesDataBy($id);
        $MainStoreList=$this->Store_Model->MainStoreList();
        $this->data['MainStoreList']=$MainStoreList;

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $set_rules = $this->Category_Model->config;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if ($id) {
               $postData['id'] = $this->input->post('id');
            }

            $postData['name'] = $this->input->post('name');
            $postData['name_french'] = $this->input->post('name_french');
            $postData['category_order'] = $this->input->post('category_order');
            $postData['category_dispersion'] = $this->input->post('category_dispersion');

            $postData['category_dispersion_french'] = $this->input->post('category_dispersion_french');

            $postData['show_main_menu'] = !empty($this->input->post('show_main_menu')) ? $this->input->post('show_main_menu'):0;
            $postData['show_our_printed_product'] = !empty($this->input->post('show_our_printed_product')) ? $this->input->post('show_our_printed_product'):0;

            $postData['show_footer_menu'] = !empty($this->input->post('show_footer_menu')) ? $this->input->post('show_footer_menu'):0;

            if ($this->form_validation->run()===TRUE) {
            $saveData=true;
            $saveCategoryImageData=array();
            #pr($_POST);
            //pr($_FILES,1);

            foreach($MainStoreList as $key => $val){
                $FilenameInadex=$key.'files';
                $oldImageInadex=$key.'old_image';
                $ImageIdInadex=$key.'category_image_id';
                $Filename = isset($_FILES[$FilenameInadex]['name']) ? $_FILES[$FilenameInadex]['name']:'';

                $saveCategoryImageData[$key]['image']= !empty($this->input->post($oldImageInadex)) ?
                $this->input->post($oldImageInadex) : '';

                $saveCategoryImageData[$key]['main_store_id']=$key;
                $saveCategoryImageData[$key]['id']= !empty($this->input->post($ImageIdInadex)) ?
                $this->input->post($ImageIdInadex) : '';
                #pr($_FILES[$FilenameInadex]);
                $uploadData = array();
                if (!empty($Filename)) {
                        $_FILES['file']['name']     = time().$_FILES[$FilenameInadex]['name'];
                        $_FILES['file']['type']     = $_FILES[$FilenameInadex]['type'];
                        $_FILES['file']['tmp_name'] = $_FILES[$FilenameInadex]['tmp_name'];
                        $_FILES['file']['error']    = $_FILES[$FilenameInadex]['error'];
                        $_FILES['file']['size']     = $_FILES[$FilenameInadex]['size'];

                        $config['upload_path'] =CATEGORY_IMAGE_BASE_PATH;
                        $config['allowed_types'] = FILE_ALLOWED_TYPES;
                        //$config['max_size']= FILE_MAX_SIZE;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('file')){
                           $uploadData = $this->upload->data();
                           $this->resizeImage($uploadData['file_name']);
                           $saveCategoryImageData[$key]['image']=$uploadData['file_name'];
                           #pr($uploadData);
                        } else {
                            #$errors = $this->upload->display_errors();
                            #pr($errors);
                            /*$this->session->set_flashdata('$keyfile_message_error','maximum category image size allowed on only 1Mb');
                            $saveData=false;*/
                        }
                }

                $uploadDatafrench = array();
                $FilenameFrenchInadex=$key.'files_french';
                $oldImageFrenchInadex=$key.'old_image_french';
                $FileNamefrench = isset($_FILES[$FilenameFrenchInadex]['name']) ? $_FILES[$FilenameFrenchInadex]['name']:'';
                $saveCategoryImageData[$key]['image_french'] = !empty($this->input->post($oldImageFrenchInadex)) ?
                $this->input->post($oldImageFrenchInadex) : '';

                if (!empty($FileNamefrench)) {
                        $_FILES['file']['name']     = time().$_FILES[$FilenameFrenchInadex]['name'];
                        $_FILES['file']['type']     = $_FILES[$FilenameFrenchInadex]['type'];
                        $_FILES['file']['tmp_name'] = $_FILES[$FilenameFrenchInadex]['tmp_name'];
                        $_FILES['file']['error']    = $_FILES[$FilenameFrenchInadex]['error'];
                        $_FILES['file']['size']     = $_FILES[$FilenameFrenchInadex]['size'];

                        $config['upload_path'] =CATEGORY_IMAGE_BASE_PATH;
                        $config['allowed_types'] = FILE_ALLOWED_TYPES;
                        //$config['max_size']= FILE_MAX_SIZE;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('file')){
                           $uploadDatafrench = $this->upload->data();
                           $this->resizeImage($uploadDatafrench['file_name']);
                           $saveCategoryImageData[$key]['image_french'] =$uploadDatafrench['file_name'];
                        } else {
                            /*$this->session->set_flashdata("$keyfile_message_error_french",'maximum category image size allowed on only 1Mb');
                            $saveData=false;*/
                        }
                }
            }

            if ($saveData){
                    $insert_id=$this->Category_Model->saveCategory($postData);
                    if ($insert_id) {
                        #pr($saveCategoryImageData,1);
                        foreach($saveCategoryImageData as $key => $val){
                            $CategoryImage=array();
                            $CategoryImage=$val;
                            $CategoryImage['category_id']=$insert_id;

                            $this->Category_Model->saveCategoryImage($CategoryImage);
                        }

                        $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                        redirect('admin/Categories');
                    } else {
                        $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                    }
                }
            } else {
                    $this->session->set_flashdata('errors', $this->form_validation->error_array());
                    $this->session->set_flashdata('old_values', $postData);
                    $this->session->set_flashdata('message_error','Missing information.');
                    if ($id) {
                        redirect('admin/Categories/addEdit/'.$id);
                    }
                    redirect('admin/Categories/addEdit');
            }
    }

    $this->data['postData']=$postData;
    $this->data['MainStoreList']=$MainStoreList;
    $this->data['CategoriesImageData']=$CategoriesImageData;
    $this->render($this->class_name.'add_edit');
    }

    /*public function addEdit($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Category';
        if ($id) {
         $this->data['page_title'] = $page_title = 'Edit Category';
        }
        $this->data['main_page_url'] = '';
        $this->load->model('Category_Model');
        $this->load->model('Store_Model');
        $postData = [];

        $postData = $this->Category_Model->getCategoryDataById($id);
        $CategoriesImageData= $this->Category_Model->getCategoriesImagesDataBy($id);
        $MainStoreList=$this->Store_Model->MainStoreList();
        $this->data['MainStoreList']=$MainStoreList;

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $set_rules = $this->Category_Model->config;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if ($id) {
               $postData['id'] = $this->input->post('id');
            }

            $postData['name'] = $this->input->post('name');
            $postData['name_french'] = $this->input->post('name_french');
            $postData['category_order'] = $this->input->post('category_order');
            $postData['category_dispersion'] = $this->input->post('category_dispersion');

            $postData['category_dispersion_french'] = $this->input->post('category_dispersion_french');

            $postData['show_main_menu'] = !empty($this->input->post('show_main_menu')) ? $this->input->post('show_main_menu'):0;
            $postData['show_our_printed_product'] = !empty($this->input->post('show_our_printed_product')) ? $this->input->post('show_our_printed_product'):0;

            $postData['show_footer_menu'] = !empty($this->input->post('show_footer_menu')) ? $this->input->post('show_footer_menu'):0;

            if ($this->form_validation->run()===TRUE) {
                $saveData=true;
                $Filename = $_FILES['files']['name'];
                $uploadData = array();

                if (!empty($Filename)) {
                        $_FILES['file']['name']     = $_FILES['files']['name'];
                        $_FILES['file']['type']     = $_FILES['files']['type'];
                        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
                        $_FILES['file']['error']    = $_FILES['files']['error'];
                        $_FILES['file']['size']     = $_FILES['files']['size'];

                        $config['upload_path'] =CATEGORY_IMAGE_BASE_PATH;
                        $config['allowed_types'] = FILE_ALLOWED_TYPES;
                        //$config['max_size']= FILE_MAX_SIZE;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('file')){
                           $uploadData = $this->upload->data();
                           $this->resizeImage($uploadData['file_name']);
                        } else {
                             $this->session->set_flashdata('file_message_error','maximum category image size allowed on only 1Mb');
                             $saveData=false;
                        }
                }

                $FileNamefrench = $_FILES['files_french']['name'];
                $uploadDatafrench = array();
                if (!empty($FileNamefrench)) {
                        $_FILES['file']['name']     = $_FILES['files_french']['name'];
                        $_FILES['file']['type']     = $_FILES['files_french']['type'];
                        $_FILES['file']['tmp_name'] = $_FILES['files_french']['tmp_name'];
                        $_FILES['file']['error']    = $_FILES['files_french']['error'];
                        $_FILES['file']['size']     = $_FILES['files_french']['size'];

                        $config['upload_path'] =CATEGORY_IMAGE_BASE_PATH;
                        $config['allowed_types'] = FILE_ALLOWED_TYPES;
                        //$config['max_size']= FILE_MAX_SIZE;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('file')){
                           $uploadDatafrench = $this->upload->data();
                           //pr($uploadDatafrench,1);
                           $this->resizeImage($uploadDatafrench['file_name']);
                        } else {
                             $this->session->set_flashdata('file_message_error_french','maximum category image size allowed on only 1Mb');
                             $saveData=false;
                        }
                }

                if ($saveData) {
                    $old_image_french= !empty($this->input->post('old_image_french')) ?
                    $this->input->post('old_image_french') : '';

                    if(!empty($FileNamefrench)){
                        $postData['image_french']=$uploadDatafrench['file_name'];
                    }

                    $old_image= !empty($this->input->post('old_image_')) ?
                    $this->input->post('old_image') : '';
                    if(!empty($Filename)){
                        $postData['image']=$uploadData['file_name'];
                    }

                    $insert_id=$this->Category_Model->saveCategory($postData);

                    if ($insert_id) {
                        if(!empty($Filename) && !empty($old_image)){
                            $imageName=$old_image;
                        }

                        if(!empty($FileNamefrench) && !empty($old_image_french)){
                            $imageName=$old_image_french;
                        }

                        $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                        redirect('admin/Categories');
                    } else {
                        $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                    }
                }
            } else {
                    $this->session->set_flashdata('errors', $this->form_validation->error_array());
                    $this->session->set_flashdata('old_values', $postData);
                    $this->session->set_flashdata('message_error','Missing information.');
                    if ($id) {
                        redirect('admin/Categories/addEdit/'.$id);
                    }
                    redirect('admin/Categories/addEdit');
            }
    }

    $this->data['postData']=$postData;
    $this->data['MainStoreList']=$MainStoreList;
    $this->data['CategoriesImageData']=$CategoriesImageData;

    $this->render($this->class_name.'add_edit');
    }*/

    public function activeInactive($id=null,$status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
                $postData['id']=$id;
                $postData['status']=$status;
                $page_title='Category Active';
                $this->load->model('Category_Model');
                if($status==0){
                    $page_title='Category Inactive';
                }
                if ($this->Category_Model->saveCategory($postData))
                {
                    $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                    redirect('admin/Categories');
                }
                else
                {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }
    }

    public function SubCategories()
    {
                $this->load->model('SubCategory_Model');
                $this->data['page_title'] = 'Sub Category';
                $this->data['sub_page_title'] = 'Add New Sub Category';
                $this->data['sub_page_url'] = 'addEditSubCategory';
                $this->data['sub_page_url_active_inactive'] = 'activeInactiveSubCategorry';
                $lists = $this->SubCategory_Model->getSubCategoryList();
                $this->data['lists'] = $lists;
                $this->render($this->class_name.'sub_categories');
    }

    public function addEditSubCategory($id=null)
    {
                $this->load->helper('form');
                $this->data['page_title'] = $page_title = 'Add New Sub Category';

                if ($id) {
                   $this->data['page_title'] = $page_title = 'Edit Sub Category';
                 }

                $this->data['main_page_url'] = '';
                $this->load->model('Category_Model');
                $this->load->model('SubCategory_Model');
                $postData = [];
                $postData = $this->SubCategory_Model->getSubCategoryDataById($id);
                //pr($postData,1);

                if ($this->input->post()) {
                    $this->load->library('form_validation');
                    $set_rules=$this->SubCategory_Model->config;
                    $this->form_validation->set_rules($set_rules);
                    $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

                    if ($id) {
                       $postData['id']=$this->input->post('id');
                    }

                    $postData['name'] = $this->input->post('name');

                    $postData['name_french'] = $this->input->post('name_french');

                    $postData['menu_id'] = $this->input->post('menu_id');
                    $postData['category_id'] = $this->input->post('category_id');
                    $postData['sub_category_order'] = $this->input->post('sub_category_order');
                    $postData['category_id'] = $this->input->post('category_id');
                    $postData['sub_category_dispersion'] = $this->input->post('sub_category_dispersion');

                    $postData['sub_category_dispersion_french'] =
                    $this->input->post('sub_category_dispersion_french');

                    $postData['show_main_menu'] = $this->input->post('show_main_menu');
                    if ($this->form_validation->run()===TRUE) {
                        if ($this->SubCategory_Model->saveSubCategory($postData)) {
                                $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                                redirect('admin/Categories/SubCategories');
                        } else {
                            $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                        }
                    } else {
                            $this->session->set_flashdata('errors', $this->form_validation->error_array());
                            $this->session->set_flashdata('old_values', $postData);
                            $this->session->set_flashdata('message_error','Missing information.');

                            if ($id) {
                                redirect('admin/Categories/addEditSubCategory/'.$id);
                            }
                            redirect('admin/Categories/addEditSubCategory');
                    }
                }

                $menu_id = isset($postData['menu_id']) ? $postData['menu_id']:'';
                $categoryList = $this->Category_Model->getCategoryDropDownList();
                $this->data['categoryList'] = $categoryList;
                $this->data['postData'] = $postData;
                $this->render($this->class_name.'add_edit_sub_category');
    }

    public function activeInactiveSubCategorry($id=null,$status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
                $postData['id']=$id;
                $postData['status']=$status;
                $page_title='Category Active';
                $this->load->model('SubCategory_Model');
                if($status==0){
                    $page_title='Sub Category Inactive';
                }
                if ($this->SubCategory_Model->saveSubCategory($postData))
                {
                    $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                    redirect('admin/Categories/SubCategories');
                }
                else
                {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }
    }

    public function deleteCategory($id)
    {
        $this->load->model('Category_Model');

        if ($id) {
            $page_title = 'Delete Category';
            if ($this->Category_Model->deleteCategory($id)) {
                    $this->session->set_flashdata('message_success',$page_title.' Successfully.');
            } else {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error','Missing information.');
        }

        redirect('admin/Categories');
    }

    public function Tags()
    {
                $this->load->model('Category_Model');
                $this->data['page_title'] = 'Tags';
                $this->data['sub_page_title'] = 'Add New Tag';
                $this->data['sub_page_url'] = 'addEditTag';
                $this->data['sub_page_delete_url'] = 'deleteTag';
                $this->data['sub_page_url_active_inactive'] = 'activeInactiveTag';
                $lists = $this->Category_Model->getTasgList();
                $this->data['lists'] = $lists;
                $this->render($this->class_name.'tag');
    }

    public function addEditTag($id=null)
    {
                $this->load->helper('form');
                $this->data['page_title'] = $page_title = 'Add New Tag';

                if($id){
                      $this->data['page_title'] = $page_title = 'Edit Tag';
                 }

                $this->data['main_page_url'] = '';
                $this->load->model('Category_Model');

                $postData = [];
                $postData = $this->Category_Model->getTagDataById($id);

                if ($this->input->post()) {
                    $this->load->library('form_validation');
                    $set_rules=$this->Category_Model->config_tags;
                    $this->form_validation->set_rules($set_rules);
                    $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

                    if ($id) {
                       $postData['id']=$this->input->post('id');
                    }

                    $postData['name'] = $this->input->post('name');
                    $postData['name_french'] = $this->input->post('name_french');
                    $postData['tag_order'] = $this->input->post('tag_order');
                    $postData['font_class'] = $this->input->post('font_class');

                    $postData['proudly_display_your_brand'] = !empty($this->input->post('proudly_display_your_brand')) ? $this->input->post('proudly_display_your_brand'):0;
                    $postData['montreal_book_printing'] = !empty($this->input->post('montreal_book_printing')) ? $this->input->post('montreal_book_printing'):0;
                    $postData['footer'] = !empty($this->input->post('footer')) ? $this->input->post('footer'):0;

                    if ($this->form_validation->run()===TRUE) {
                        $saveData=true;
                          $Filename = $_FILES['files']['name'];
                          $uploadData = array();

                          if (!empty($Filename)) {
                                $_FILES['file']['name']     = $_FILES['files']['name'];
                                $_FILES['file']['type']     = $_FILES['files']['type'];
                                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
                                $_FILES['file']['error']     = $_FILES['files']['error'];
                                $_FILES['file']['size']     = $_FILES['files']['size'];

                                $config['upload_path'] =CATEGORY_IMAGE_BASE_PATH;
                                $config['allowed_types'] = FILE_ALLOWED_TYPES;
                                //$config['max_size']= FILE_MAX_SIZE;

                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);

                                if ($this->upload->do_upload('file')){
                                   $uploadData = $this->upload->data();
                                   $this->resizeImage($uploadData['file_name']);
                                } else {
                                     $this->session->set_flashdata('file_message_error','maximum product image size allowed on only 1Mb');
                                     $saveData=false;
                                }
                        }

                    $FileNamefrench = $_FILES['files_french']['name'];
                    $uploadDatafrench = array();

                    if (!empty($FileNamefrench)) {
                        $_FILES['file']['name']     = $_FILES['files_french']['name'];
                        $_FILES['file']['type']     = $_FILES['files_french']['type'];
                        $_FILES['file']['tmp_name'] = $_FILES['files_french']['tmp_name'];
                        $_FILES['file']['error']    = $_FILES['files_french']['error'];
                        $_FILES['file']['size']     = $_FILES['files_french']['size'];

                        $config['upload_path'] =CATEGORY_IMAGE_BASE_PATH;
                        $config['allowed_types'] = FILE_ALLOWED_TYPES;
                        //$config['max_size']= FILE_MAX_SIZE;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('file')){
                           $uploadDatafrench = $this->upload->data();
                           //pr($uploadDatafrench,1);
                           $this->resizeImage($uploadDatafrench['file_name']);
                        } else {
                             $this->session->set_flashdata('file_message_error_french','maximum category image size allowed on only 1Mb');
                             $saveData=false;
                        }
                    }

                        if ($saveData) {
                            $old_image_french= !empty($this->input->post('old_image_french')) ?
                            $this->input->post('old_image_french') : '';
                            if(!empty($FileNamefrench)){
                                $postData['image_french']=$uploadDatafrench['file_name'];
                            }

                            $old_image= !empty($this->input->post('old_image')) ?
                            $this->input->post('old_image') : '';
                            if(!empty($Filename)){
                                $postData['image']=$uploadData['file_name'];
                            }
                            $insert_id=$this->Category_Model->saveTags($postData);

                            if ($insert_id) {
                                if(!empty($Filename) && !empty($old_image)){
                                    $imageName=$old_image;

                                    if(file_exists(CATEGORY_IMAGE_LARGE_BASE_PATH.$imageName))
                                        unlink(CATEGORY_IMAGE_LARGE_BASE_PATH.$imageName);

                                    if(file_exists(CATEGORY_IMAGE_BASE_PATH.$imageName))
                                        unlink(CATEGORY_IMAGE_BASE_PATH.$imageName);
                                }

                                $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                                redirect('admin/Categories/Tags');
                            } else {
                                $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('message_error','Missing information.');
                    }
                }

                $this->data['postData'] = $postData;
                $this->render($this->class_name.'add_edit_tag');
    }
    public function deleteTag($id)
    {
        $this->load->model('Category_Model');

        if ($id) {
            $page_title = 'Delete Tag';
            if ($this->Category_Model->deleteTags($id)) {
                    $this->session->set_flashdata('message_success',$page_title.' Successfully.');
            } else {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error','Missing information.');
        }
        redirect('admin/Categories/Tags');
    }

    public function activeInactiveTag($id=null,$status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
                $postData['id']=$id;
                $postData['status']=$status;
                $page_title='Tag Active';
                $this->load->model('Category_Model');
                if($status==0){
                    $page_title='Tag Inactive';
                }
                if ($this->Category_Model->saveTags($postData))
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
        redirect('admin/Categories/Tags');
    }

    public function resizeImage($filename,$width=200,$height=200) {
        $source_path = CATEGORY_IMAGE_BASE_PATH. $filename;
        $target_path = CATEGORY_IMAGE_BASE_PATH.'large/'.$filename;
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
        $this->load->library('image_lib');
        $this->image_lib->initialize($config_manip);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
    }
}
