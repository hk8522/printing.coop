<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configrations extends Admin_Controller
{
      public $class_name = '';

      function __construct()
      {
            parent::__construct();
            $this->class_name = 'admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
            $this->data['class_name'] = $this->class_name;
      }

    public function index()
    {
        $this->load->model('Configration_Model');
        $this->load->model('Store_Model');
        $this->load->helper('form');
        $this->data['page_title'] = 'Site Configrations';
        $this->data['main_page_url'] = '';
        $this->data['sub_page_title'] = 'Add New Page';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $this->data['sub_page_delete_url'] = 'deletePage';
        $this->data['lists'] = $this->Configration_Model->getConfigrationsList();
        #pr($this->data['lists'],1);
        $MainStoreList=$this->Store_Model->MainStoreList();
        $this->data['MainStoreList']=$MainStoreList;
        $this->render($this->class_name.'index');
    }

    public function addEdit($id=null)
    {
                $this->load->model('Configration_Model');
                $this->load->model('Store_Model');
                $this->load->helper('form');
                $this->data['main_page_url'] = '';
                $this->data['configrations'] = $configrations=$this->Configration_Model->getConfigrationsDataById($id);
                $MainStoreList=$this->Store_Model->MainStoreList();
                $this->data['page_title'] ='Configrations '.$MainStoreList[$configrations['main_store_id']];
                $this->data['MainStoreList']=$MainStoreList;
                $this->render($this->class_name.'add_edit');
    }

    public function saveConfigrations()
    {
                $this->load->model('Configration_Model');
                /*$postData['languages'] = implode(",", $this->input->post('languages') ?? []);
                $postData['currencies'] = implode(",", $this->input->post('currencies') ?? []);*/
                $id=$postData['id']=$this->input->post('id');
                $postData['contact_no'] = $this->input->post('contact_no');
                $postData['office_timing'] = $this->input->post('office_timing');
                $postData['announcement'] = $this->input->post('announcement');

                $postData['copy_right'] = $this->input->post('copy_right');
                $postData['address_one'] = $this->input->post('address_one');

                $postData['contact_no_french'] = $this->input->post('contact_no_french');
                $postData['office_timing_french'] = $this->input->post('office_timing_french');
                $postData['announcement_french'] = $this->input->post('announcement_french');

                $postData['copy_right_french'] = $this->input->post('copy_right_french');
                $postData['address_one_french'] = $this->input->post('address_one_french');

                $postData['log_alt_teg']        = $this->input->post('log_alt_teg');
                $postData['log_alt_teg_french'] = $this->input->post('log_alt_teg_french');

                if(isset($_FILES['logo_image'])) {
                        $Filename = $_FILES['logo_image']['name'];
                        if (!empty($Filename)) {
                            $config['upload_path'] = LOGO_IMAGE_BASE_PATH;
                            $config['allowed_types'] = FILE_ALLOWED_TYPES;
                            $config['max_size'] = FILE_MAX_SIZE;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $old_image= !empty($this->input->post('old_image')) ? $this->input->post('old_image') : '';
                            if ($this->upload->do_upload('logo_image')) {
                                if(!empty($Filename) && !empty($old_image)){
                                    $imageName = $old_image;
                                    if (file_exists(LOGO_IMAGE_BASE_PATH.$imageName)) {
                                        //unlink(LOGO_IMAGE_BASE_URL.$imageName);
                                    }
                                }
                                $uploadData = $this->upload->data();
                                $postData['logo_image'] = $uploadData['file_name'];
                            } else {
                                 $this->session->set_flashdata('message_error','maximum logo image size allowed on only 1Mb');
                            }
                        }
                }

                if (isset($_FILES['logo_image_french'])) {
                        $Filename = $_FILES['logo_image_french']['name'];
                        if (!empty($Filename)) {
                            $config['upload_path'] = LOGO_IMAGE_BASE_PATH;
                            $config['allowed_types'] = FILE_ALLOWED_TYPES;
                            $config['max_size'] = FILE_MAX_SIZE;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $old_image= !empty($this->input->post('old_image_french')) ? $this->input->post('old_image_french') : '';
                            if ($this->upload->do_upload('logo_image_french')) {
                                if(!empty($Filename) && !empty($old_image)){
                                    $imageName = $old_image;
                                    if (file_exists(LOGO_IMAGE_BASE_PATH.$imageName)) {
                                        //unlink(LOGO_IMAGE_BASE_URL.$imageName);
                                    }
                                }
                                 $uploadData = $this->upload->data();
                                 $postData['logo_image_french'] = $uploadData['file_name'];
                            }
                        }
                }
                if (isset($_FILES['favicon'])) {
                        $Filename = $_FILES['favicon']['name'];
                        if (!empty($Filename)) {
                            $config['upload_path'] = LOGO_IMAGE_BASE_PATH;
                            $config['allowed_types'] = FILE_ALLOWED_TYPES;
                            $config['max_size'] = FILE_MAX_SIZE;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $old_image= !empty($this->input->post('old_favicon')) ? $this->input->post('old_favicon') : '';
                            if ($this->upload->do_upload('favicon')) {
                                if(!empty($Filename) && !empty($old_image)){
                                    $imageName = $old_image;
                                    if (file_exists(LOGO_IMAGE_BASE_PATH.$imageName)) {
                                        //unlink(LOGO_IMAGE_BASE_URL.$imageName);
                                    }
                                }
                                 $uploadData = $this->upload->data();
                                 $postData['favicon'] = $uploadData['file_name'];
                            }
                        }
                }
                if (isset($_FILES['french_favicon'])) {
                        $Filename = $_FILES['french_favicon']['name'];
                        if (!empty($Filename)) {
                            $config['upload_path'] = LOGO_IMAGE_BASE_PATH;
                            $config['allowed_types'] = FILE_ALLOWED_TYPES;
                            $config['max_size'] = FILE_MAX_SIZE;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $old_image= !empty($this->input->post('old_french_favicon')) ? $this->input->post('old_french_favicon') : '';
                            if ($this->upload->do_upload('french_favicon')) {
                                if(!empty($Filename) && !empty($old_image)){
                                    $imageName = $old_image;
                                    if (file_exists(LOGO_IMAGE_BASE_PATH.$imageName)) {
                                        //unlink(LOGO_IMAGE_BASE_URL.$imageName);
                                    }
                                }
                                 $uploadData = $this->upload->data();
                                 $postData['french_favicon'] = $uploadData['file_name'];
                            }
                        }
                }
                $insert =  $this->Configration_Model->saveData($postData);
                if ($insert) {
                        $this->session->set_flashdata('message_success',' Configrations Updated Successfully.');
                        redirect('admin/Configrations');
                }else{
                    $this->session->set_flashdata('message_success',' Configrations Updated Unsuccessfully.');
                    redirect('admin/Configrations/addEdit/'.$id);
                }
        }
    }
