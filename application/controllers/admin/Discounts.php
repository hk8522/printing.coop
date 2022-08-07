<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discounts extends Admin_Controller
{
    public $class_name = '';
    public function __construct()
    {
        parent::__construct();
        $this->class_name = 'admin/' . ucfirst(strtolower($this->router->fetch_class())) . '/';
        $this->data['class_name'] = $this->class_name;
    }

    public function index($type = "current")
    {
        $this->load->model('Discount_Model');
        $this->data['page_title'] = 'Discount Code';
        $this->data['sub_page_title'] = 'Add New Discount Code';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $this->data['sub_page_delete_url'] = 'deleteDiscount';
        $lists = $this->Discount_Model->getDiscountsList();
        $this->data['lists'] = $lists;
        $this->data['type'] = $type;
        $this->render($this->class_name . 'index');
    }

    public function addEdit($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Discount Code';
        if (!empty($id)) {
            $this->data['page_title'] = $page_title = 'Edit Discount Code';
        }
        $this->data['main_page_url'] = '';
        $this->load->model('Discount_Model');
        $postData = array();
        $postData = $this->Discount_Model->getDiscountDataById($id);
        //pr($postData,1);

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $set_rules = $this->Discount_Model->config;

            if (!empty($id)) {
                $set_rules[0]['rules'] = 'required';
            }
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            $postData['code'] = $this->input->post('code');
            $postData['discount_type'] = $this->input->post('discount_type');
            $postData['discount'] = $this->input->post('discount');
            $postData['discount_valid_from'] = $this->input->post('discount_valid_from');
            $postData['discount_valid_from'] = $this->input->post('discount_valid_from');
            $postData['discount_valid_to'] = $this->input->post('discount_valid_to');
            //$postData['discount_requirement_quantity']=$this->input->post('discount_requirement_quantity');
            //$postData['discount_code_limit']=$this->input->post('discount_code_limit');

            if ($this->form_validation->run() === true) {
                if (!empty($id)) {
                    $postData['id'] = $this->input->post('id');
                }
                if ($this->Discount_Model->saveDiscount($postData)) {
                    $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                    redirect('admin/Discounts');
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
            $page_title = 'Discount Code Active';
            $this->load->model('Discount_Model');
            if ($status == 0) {
                $page_title = 'Discount Code Inactive';
            }
            if ($this->Discount_Model->saveDiscount($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                redirect('admin/Discounts');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
    }

    public function deleteDiscount($id = null)
    {
        if (!empty($id)) {
            $page_title = 'Discount Code Delete';
            $this->load->model('Discount_Model');
            if ($this->Discount_Model->deleteDiscount($id)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }

        redirect('admin/Discounts');
    }
}
