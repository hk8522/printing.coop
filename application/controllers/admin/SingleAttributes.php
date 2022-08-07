<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SingleAttributes extends Admin_Controller
{
    public $class_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->class_name = 'admin/' . $this->router->fetch_class() . '/';
        $this->data['class_name'] = $this->class_name;
    }

    public function index()
    {
        $this->load->model('Product_Model');
        $this->data['page_title'] = 'Product Attributes';
        $this->data['sub_page_title'] = 'Add New Attribute';
        $this->data['sub_page_url'] = 'addEditAttribute';
        $this->data['sub_page_view_url'] = 'viewAttribute';
        $this->data['sub_page_delete_url'] = 'deleteAttribute';
        $this->data['sub_page_url_active_inactive'] = 'activeInactiveAttribute';
        $lists = $this->Product_Model->getAttributesList();
        $this->data['lists'] = $lists;
        $this->render($this->class_name . 'index');
    }

    public function addEditAttribute($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Attributes';
        if (!empty($id)) {
            $this->data['page_title'] = $page_title = 'Edit Attributes';
        }
        $this->data['main_page_url'] = '';
        $this->load->model('Product_Model');
        $postData = array();
        $postData = $this->Product_Model->getAttributesDataById($id);
        $productItemData = $this->Product_Model->getAttributesItemDataById($id);
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $set_rules = $this->Product_Model->configAttributes;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if (!empty($id)) {
                $postData['id'] = $this->input->post('id');
            }

            $postData['name'] = $this->input->post('name');
            $postData['name_french'] = $this->input->post('name_french');

            $attribute_item_name = $this->input->post('attribute_item_name');

            $item_name_french = $this->input->post('item_name_french');
            $attribute_item_id = $this->input->post('attribute_item_id');
            #pr($attribute_item_name);
            #pr($attribute_item_id);

            if ($this->form_validation->run() === true) {
                $saveData = true;

                if ($saveData) {
                    $insert_id = $this->Product_Model->saveAttributes($postData);

                    if ($insert_id > 0) {
                        $data = array();

                        foreach ($attribute_item_name as $k => $v) {
                            $sdata = array();
                            $sdata['id'] = $attribute_item_id[$k];

                            $sdata['item_name'] = $v;
                            $sdata['item_name_french'] = $item_name_french[$k];
                            $sdata['created'] = date('Y-m-d H:i:s');
                            $sdata['updated'] = date('Y-m-d H:i:s');
                            $sdata['product_attribute_id'] = $insert_id;
                            $data[] = $sdata;
                        }
                        #pr($data,1);

                        $this->Product_Model->saveAttributeItem($data, $insert_id);
                        $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                        redirect('admin/SingleAttributes');
                    } else {
                        $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
                    }
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }
        $this->data['postData'] = $postData;
        $this->data['productItemData'] = $productItemData;
        $this->render($this->class_name . 'add_edit_attribute');
    }
    public function activeInactiveAttribute($id = null, $status = null)
    {
        if (!empty($id) && ($status == 1 || $status == 0)) {
            $postData['id'] = $id;
            $postData['status'] = $status;
            $page_title = 'Attributes Active';
            $this->load->model('Product_Model');
            if ($status == 0) {
                $page_title = 'Attributes Inactive';
            }
            if ($this->Product_Model->saveAttributes($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
        redirect('admin/SingleAttributes');
    }

    public function deleteAttribute($id = null)
    {
        if (!empty($id)) {
            $page_title = 'Attributes Delete';
            $this->load->model('Product_Model');
            if ($this->Product_Model->deleteAttributes($id)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
        redirect('admin/SingleAttributes');
    }
}
