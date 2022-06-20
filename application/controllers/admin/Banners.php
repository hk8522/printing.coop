<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends Admin_Controller
{
    public $class_name = '';

    function __construct()
    {
        parent::__construct();
        $this->class_name         = 'admin/' . ucfirst(strtolower($this->router->fetch_class())) . '/';
        $this->data['class_name'] = $this->class_name;
    }

    public function index()
    {
        $this->load->model('Banner_Model');
        $this->load->model('Store_Model');
        $this->data['page_title']                   = 'Banners';
        $this->data['sub_page_title']               = 'Add New Banner';
        $this->data['sub_page_url']                 = 'addEditBanner';
        $this->data['sub_page_view_url']            = 'viewBanner';
        $this->data['sub_page_delete_url']          = 'deleteBanner';
        $this->data['sub_page_url_active_inactive'] = 'activeInactiveBanner';
        $lists                                      = $this->Banner_Model->getBannerList();
        $MainStoreList=$this->Store_Model->MainStoreList();
        $this->data['MainStoreList']=$MainStoreList;
        $this->data['lists']                        = $lists;
        $this->render($this->class_name . 'index');
    }

    public function addEditBanner($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Banner';

        if (!empty($id)) {
            $this->data['page_title'] = $page_title = 'Edit Banner';
        }

        $this->data['main_page_url'] = 'banners';
        $this->load->model('Menu_Model');
        $this->load->model('Banner_Model');
        $this->load->model('Store_Model');
        $MainStoreList=$this->Store_Model->MainStoreList();
        $this->data['MainStoreList']=$MainStoreList;
        $postData = array();
        if ($id) {
            $postData = $this->Banner_Model->getBannerDataById($id);
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $rules = $this->Banner_Model->rules;
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if (!empty($id)) {
                $postData['id'] = $this->input->post('id');
            }

            $postData['name']              = $this->input->post('name');
            $postData['short_description'] = $this->input->post('short_description');
            $postData['full_description']  = $this->input->post('full_description');

           $postData['name_french']          = $this->input->post('name_french');
            $postData['short_description_french'] = $this->input->post('short_description_french');
            $postData['full_description_french']  = $this->input->post('full_description_french');

            $postData['main_store_id']=$this->input->post('main_store_id');

            if ($this->form_validation->run() === TRUE) {
                $saveData   = true;
                $Filename   = $_FILES['files']['name'];
                $FileNamefrench   = $_FILES['files_french']['name'];
                $uploadData = array();
                $uploadDatafrench = array();

                if (!empty($Filename)) {
                    $_FILES['file']['name']     = $_FILES['files']['name'];
                    $_FILES['file']['type']     = $_FILES['files']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
                    $_FILES['file']['error']    = $_FILES['files']['error'];
                    $_FILES['file']['size']     = $_FILES['files']['size'];

                    $config['upload_path']   = BANNER_IMAGE_BASE_PATH;
                    $config['allowed_types'] = FILE_ALLOWED_TYPES;
                    $config['max_size']      = FILE_MAX_SIZE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $this->resizeImage($uploadData['file_name'], 'small', '', '', 'banner');
                        $this->resizeImage($uploadData['file_name'], 'medium', '', '', 'banner');
                        $this->resizeImage($uploadData['file_name'], 'large', 1920, 428, 'banner');
                    } else {
                        $this->session->set_flashdata('file_message_error', 'maximum banner image size allowed on only 1Mb');
                        $saveData = false;
                    }
                } else if(!empty($FileNamefrench)){
                    $_FILES['file']['name']     = $_FILES['files_french']['name'];
                    $_FILES['file']['type']     = $_FILES['files_french']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['files_french']['tmp_name'];
                    $_FILES['file']['error']    = $_FILES['files_french']['error'];
                    $_FILES['file']['size']     = $_FILES['files_french']['size'];

                    $config['upload_path']   = BANNER_IMAGE_BASE_PATH;
                    $config['allowed_types'] = FILE_ALLOWED_TYPES;
                    $config['max_size']      = FILE_MAX_SIZE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploadDatafrench = $this->upload->data();
                        $this->resizeImage($uploadDatafrench['file_name'], 'small', '', '', 'banner');
                        $this->resizeImage($uploadDatafrench['file_name'], 'medium', '', '', 'banner');
                        $this->resizeImage($uploadDatafrench['file_name'], 'large', 1920, 428, 'banner');
                    } else {
                        $this->session->set_flashdata('file_message_error_french', 'maximum banner image size allowed on only 1Mb');
                        $saveData = false;
                    }
                }else {
                    if (empty($id)) {
                        $this->session->set_flashdata('file_message_error', 'Select  images of banner');
                        $saveData = false;
                    }
                }

                if ($saveData) {
                    $old_image_french= !empty($this->input->post('old_image_french')) ?
                    $this->input->post('old_image_french') : '';

                    if(!empty($FileNamefrench)){
                        $postData['banner_image_french']=$uploadDatafrench['file_name'];
                    }

                    $old_image = !empty($this->input->post('old_image')) ? $this->input->post('old_image') : '';

                    if (!empty($Filename)) {
                        $postData['banner_image'] = $uploadData['file_name'];
                    }

                    $insert_id = $this->Banner_Model->saveBanner($postData);

                    if ($insert_id > 0) {
                        $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                        /*if (!empty($Filename) && !empty($old_image)) {
                            $imageName = $old_image;

                            if (file_exists(BANNER_IMAGE_SMALL_BASE_PATH . $imageName))
                                unlink(BANNER_IMAGE_SMALL_BASE_PATH . $imageName);
                            if (file_exists(BANNER_IMAGE_MEDIUM_BASE_PATH . $imageName))
                                unlink(BANNER_IMAGE_MEDIUM_BASE_PATH . $imageName);

                            if (file_exists(BANNER_IMAGE_LARGE_BASE_PATH . $imageName))
                                unlink(BANNER_IMAGE_LARGE_BASE_PATH . $imageName);

                            if (file_exists(BANNER_IMAGE_BASE_PATH . $imageName))
                                unlink(BANNER_IMAGE_BASE_PATH . $imageName);
                        }*/
                        redirect('admin/Banners');
                    } else {
                        $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
                    }
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }
        $this->data['postData'] = $postData;
        $this->render($this->class_name . 'add_edit_banner');
    }

    public function deleteBanner($id = null, $imageName = null)
    {
        if (!empty($id)) {
            $page_title = 'Banner Delete';
            $this->load->model('Banner_Model');
            $data      = $this->Banner_Model->getBannerDataById($id);
            $imageName = $data['banner_image'];
            if ($this->Banner_Model->deleteBanner($id)) {
                if (file_exists(BANNER_IMAGE_SMALL_BASE_PATH . $imageName))
                    unlink(BANNER_IMAGE_SMALL_BASE_PATH . $imageName);
                if (file_exists(BANNER_IMAGE_MEDIUM_BASE_PATH . $imageName))
                    unlink(BANNER_IMAGE_MEDIUM_BASE_PATH . $imageName);

                if (file_exists(BANNER_IMAGE_LARGE_BASE_PATH . $imageName))
                    unlink(BANNER_IMAGE_LARGE_BASE_PATH . $imageName);

                if (file_exists(BANNER_IMAGE_BASE_PATH . $imageName))
                    unlink(BANNER_IMAGE_BASE_PATH . $imageName);
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }

        redirect('admin/Banners');
    }

    public function activeInactiveBanner($id = null, $status = null)
    {
        if (!empty($id) && ($status == 1 || $status == 0)) {
            $postData['id']     = $id;
            $postData['status'] = $status;
            $page_title         = 'Banner Active';
            $this->load->model('Banner_Model');
            if ($status == 0) {
                $page_title = 'Banner Inactive';
            }

            if ($this->Banner_Model->saveBanner($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }

        redirect('admin/Banners');
    }

    public function resizeImage($filename, $type = 'small', $widthlarge = 800, $heightlarge = 800, $section = 'product')
    {
        $source_path = PRODUCT_IMAGE_BASE_PATH . $filename;
        $target_path = PRODUCT_IMAGE_BASE_PATH . $type . '/' . $filename;
        if ($section == 'banner') {
            $source_path = BANNER_IMAGE_BASE_PATH . $filename;
            $target_path = BANNER_IMAGE_BASE_PATH . $type . '/' . $filename;
        }

        if ($section == 'brand') {
            $source_path = BRAND_IMAGE_BASE_PATH . $filename;
            $target_path = BRAND_IMAGE_BASE_PATH . $type . '/' . $filename;
        }

        if ($type == 'medium') {
            $width  = 400;
            $height = 390;
        } else if ($type == 'large') {
            $width  = $widthlarge;
            $height = $heightlarge;
        } else {
            $width  = 200;
            $height = 200;
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
}
?>
