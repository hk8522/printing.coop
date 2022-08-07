<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stores extends Admin_Controller
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
        $this->load->helper('form');
        $this->data['page_title'] = 'Stores';
        $this->data['sub_page_title'] = 'Add New Store';
        $this->data['sub_page_view_url'] = '';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $this->data['sub_page_delete_url'] = 'delete';
        $this->data['lists'] = $this->Store_Model->getList();
        $this->data['language'] = $this->Store_Model->getLanguageList();
        $this->data['currency'] = $this->Store_Model->getCurrencyList();
        $this->render($this->class_name . 'index');
    }

    public function addEdit($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Store';

        if (!empty($id)) {
            $this->data['page_title'] = $page_title = 'Edit Store';
        }

        $this->data['main_page_url'] = '';
        $this->load->model('Store_Model');
        $this->data['lists'] = $this->Store_Model->getList();
        $this->data['language'] = $this->Store_Model->getLanguageList();
        $this->data['currency'] = $this->Store_Model->getCurrencyList();

        $postData = array();
        if ($id) {
            $postData = $this->Store_Model->getDataById($id);
        }
        #pr($postData,1);
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $rules = $this->Store_Model->config;
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
            if (!empty($id)) {
                $postData['id'] = $this->input->post('id');
            }

            $postData['name'] = $this->input->post('name');
            $postData['email'] = $this->input->post('email');
            $postData['phone'] = $this->input->post('phone');
            $postData['url'] = $this->input->post('url');
            $postData['address'] = $this->input->post('address');
            $postData['langue_id'] = $this->input->post('langue_id');
            $postData['order_id_prefix'] = $this->input->post('order_id_prefix');
            $postData['show_language_translation'] = $this->input->post('show_language_translation');
            $postData['show_all_categories'] = $this->input->post('show_all_categories');
            $postData['from_email'] = $this->input->post('from_email');
            $postData['admin_email1'] = $this->input->post('admin_email1');
            $postData['admin_email2'] = $this->input->post('admin_email2');
            $postData['admin_email3'] = $this->input->post('admin_email3');
            $postData['email_footer_line'] = $this->input->post('email_footer_line');

            $postData['paypal_payment_mode'] = $this->input->post('paypal_payment_mode');
            $postData['paypal_sandbox_business_email'] = $this->input->post('paypal_sandbox_business_email');
            $postData['paypal_business_email'] = $this->input->post('paypal_business_email');

            //Clover Fields
            $postData['clover_mode'] = $this->input->post('clover_mode');
            $postData['clover_sandbox_api_key'] = $this->input->post('clover_sandbox_api_key');
            $postData['clover_sandbox_secret'] = $this->input->post('clover_sandbox_secret');
            $postData['clover_api_key'] = $this->input->post('clover_api_key');
            $postData['clover_secret'] = $this->input->post('clover_secret');
            //Clover Fields End

            $postData['invoice_pdf_company'] = $this->input->post('invoice_pdf_company');
            $postData['order_pdf_company'] = $this->input->post('order_pdf_company');

            $postData['flag_ship'] = $this->input->post('flag_ship');

            //$currency_id =$this->input->post('currency_id');
            //$postData['currency_id']='';
            /*if(!empty($currency_id)){
            $postData['currency_id']=implode(',',$currency_id);
            $postData['default_currency_id']=$currency_id[0];
            }*/

            if ($this->form_validation->run() === true) {
                $saveData = true;
                if (isset($_FILES['logo_image'])) {
                    $Filename = $_FILES['logo_image']['name'];
                    if (!empty($Filename)) {
                        $config['upload_path'] = LOGO_IMAGE_BASE_PATH;
                        $config['allowed_types'] = FILE_ALLOWED_TYPES;
                        $config['max_size'] = FILE_MAX_SIZE;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        $old_image = !empty($this->input->post('old_image')) ? $this->input->post('old_image') : '';

                        if ($this->upload->do_upload('logo_image')) {
                            $uploadData = $this->upload->data();
                            $postData['email_template_logo'] = $uploadData['file_name'];
                        } else {
                            #$this->session->set_flashdata('message_error','maximum logo image size allowed on only 1Mb');
                        }
                    }
                }

                if (isset($_FILES['pdf_template_logo'])) {
                    $Filename = $_FILES['pdf_template_logo']['name'];
                    if (!empty($Filename)) {
                        $config['upload_path'] = LOGO_IMAGE_BASE_PATH;
                        $config['allowed_types'] = FILE_ALLOWED_TYPES;
                        $config['max_size'] = FILE_MAX_SIZE;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        $old_pdf_template_logo = !empty($this->input->post('old_pdf_template_logo')) ? $this->input->post('old_pdf_template_logo') : '';

                        if ($this->upload->do_upload('pdf_template_logo')) {
                            $uploadData = $this->upload->data();
                            $postData['pdf_template_logo'] = $uploadData['file_name'];
                        } else {
                            #$this->session->set_flashdata('message_error','maximum logo image size allowed on only 1Mb');
                        }
                    }
                }
                if ($saveData) {
                    $insert_id = $this->Store_Model->save($postData);

                    if ($insert_id > 0) {
                        $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                        redirect('admin/Stores');
                    } else {
                        $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
                    }
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }
        $this->data['postData'] = $postData;
        $this->render($this->class_name . 'add_edit');
    }
}
