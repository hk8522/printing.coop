<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sections extends Admin_Controller
{
    public $class_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->class_name = 'admin/' . ucfirst(strtolower($this->router->fetch_class())) . '/';
        $this->data['class_name'] = $this->class_name;
    }
    public function index()
    {
        $this->load->model('Store_Model');
        $this->load->model('Section_Model');
        $this->load->helper('form');
        $this->data['page_title'] = 'Sections';
        $this->data['sub_page_title'] = 'Add New Section';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $this->data['sub_page_delete_url'] = 'deletePage';
        $MainStoreList = $this->Store_Model->MainStoreList();
        $this->data['MainStoreList'] = $MainStoreList;
        $this->data['sections'] = $this->Section_Model->getAllSections();

        $this->render($this->class_name . 'index');
    }

    public function addEdit($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Section';

        if ($id) {
            $this->data['page_title'] = $page_title = 'Edit Section';
        }

        $this->data['main_page_url'] = '';
        $this->load->model('Section_Model');
        $this->load->model('Store_Model');
        $MainStoreList = $this->Store_Model->MainStoreList();
        $this->data['MainStoreList'] = $MainStoreList;
        $postData = [];
        $postData = $this->Section_Model->getSectionById($id);
        $this->data['page_title'] = 'Edit Section ' . $MainStoreList[$postData['main_store_id']];
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $rules = $this->Section_Model->rules;
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if (!empty($id)) {
                $postData['id'] = $this->input->post('id');
            }

            $postData['name'] = $this->input->post('name');
            $postData['description'] = $this->input->post('description');
            $postData['content'] = $this->input->post('content');

            $postData['name_french'] = $this->input->post('name_french');
            $postData['description_french'] = $this->input->post('description_french');
            $postData['content_french'] = $this->input->post('content_french');

            #$postData['main_store_id']=$this->input->post('main_store_id');

            if ($this->form_validation->run() === true) {
                $Filename = $_FILES['background_image']['name'];
                $uploadData = array();
                if (!empty($Filename)) {
                    $_FILES['file']['name'] = time() . $_FILES['background_image']['name'];
                    $_FILES['file']['type'] = $_FILES['background_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['background_image']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['background_image']['error'];
                    $_FILES['file']['size'] = $_FILES['background_image']['size'];

                    $config['upload_path'] = SECTION_IMAGE_BASE_PATH;
                    $config['allowed_types'] = FILE_ALLOWED_TYPES;
                    $config['max_size'] = FILE_MAX_SIZE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $postData['background_image'] = $uploadData['file_name'];
                    }
                }

                $Filename = $_FILES['french_background_image']['name'];
                $uploadData = array();
                if (!empty($Filename)) {
                    $_FILES['file']['name'] = time() . $_FILES['french_background_image']['name'];
                    $_FILES['file']['type'] = $_FILES['french_background_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['french_background_image']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['french_background_image']['error'];
                    $_FILES['file']['size'] = $_FILES['french_background_image']['size'];

                    $config['upload_path'] = SECTION_IMAGE_BASE_PATH;
                    $config['allowed_types'] = FILE_ALLOWED_TYPES;
                    $config['max_size'] = FILE_MAX_SIZE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $postData['french_background_image'] = $uploadData['file_name'];
                    }
                }

                if ($this->Section_Model->saveSection($postData)) {
                    $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                    redirect('admin/Sections');
                } else {
                    $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        $this->data['postData'] = $postData;
        $this->render($this->class_name . 'add_edit');
    }

    public function activeInactive($id = null, $status = null)
    {
        if (!empty($id) && ($status == 1 || $status == 0)) {
            $postData['id'] = $id;
            $postData['status'] = $status;
            $page_title = 'Section Active';
            $this->load->model('Section_Model');

            if (!$status) {
                $page_title = 'Section Inactive';
            }

            if ($this->Section_Model->saveSection($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                redirect('admin/Sections');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
    }
}
