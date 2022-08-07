<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MultipleAttributes extends Admin_Controller
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
        $this->data['page_title'] = 'Product Multiple Attributes';
        $this->data['sub_page_title'] = 'Add New Attribute';
        $this->data['sub_page_url'] = 'addEditAttribute';
        $this->data['sub_page_view_url'] = 'viewAttribute';
        $this->data['sub_page_delete_url'] = 'deleteAttribute';
        $this->data['sub_page_url_active_inactive'] = 'activeInactiveAttribute';
        $lists = $this->Product_Model->getMultipleAttributes();
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
        $postData = $this->Product_Model->getMultipleAttribute($id);
        $productItemData = $this->Product_Model->getMultipleAttributeItems($id);

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $set_rules = $this->Product_Model->configMultipleAttributes;
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

            if ($this->form_validation->run() === true) {
                $saveData = true;

                if ($saveData) {
                    $insert_id = $this->Product_Model->saveMultipleAttributes($postData);

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

                        $this->Product_Model->saveMultipleAttributeItem($data, $insert_id);
                        $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                        redirect('admin/MultipleAttributes');
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
            if ($this->Product_Model->saveMultipleAttributes($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
        redirect('admin/MultipleAttributes');
    }

    public function deleteAttribute($id = null)
    {
        if (!empty($id)) {
            $page_title = 'Attributes Delete';
            $this->load->model('Product_Model');
            if ($this->Product_Model->deleteMultipleAttributes($id)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
        redirect('admin/MultipleAttributes');
    }
    public function sizes()
    {
        $this->load->model('Product_Model');
        $this->data['page_title'] = 'Product Sizes';
        $this->data['sub_page_title'] = 'Add New Size';
        $this->data['sub_page_url'] = 'addEditSize';
        $this->data['sub_page_view_url'] = '';
        $this->data['sub_page_delete_url'] = 'deleteSize';
        $this->data['sub_page_url_active_inactive'] = 'activeInactiveSize';
        $lists = $this->Product_Model->getSizeList();
        $this->data['lists'] = $lists;
        $this->render($this->class_name . 'sizes');
    }

    public function addEditSize($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Size';
        if (!empty($id)) {
            $this->data['page_title'] = $page_title = 'Edit Size';
        }

        $this->data['main_page_url'] = 'sizes';
        $this->load->model('Product_Model');
        $postData = array();
        $postData = $this->Product_Model->getSizeDataById($id);

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $set_rules = $this->Product_Model->configSizes;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if (!empty($id)) {
                $postData['id'] = $this->input->post('id');
            }

            $postData['set_order'] = $this->input->post('set_order');

            $postData['size_name'] = $this->input->post('size_name');
            $postData['size_name_french'] = $this->input->post('size_name_french');

            if ($this->form_validation->run() === true) {
                $insert_id = $this->Product_Model->saveSize($postData);

                if ($insert_id > 0) {
                    $this->session->set_flashdata('message_success', $page_title . ' Successfully.');

                    redirect('admin/MultipleAttributes/sizes');
                } else {
                    $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        $this->data['postData'] = $postData;

        $this->render($this->class_name . 'add_edit_size');
    }

    public function activeInactiveSize($id = null, $status = null)
    {
        if (!empty($id) && ($status == 1 || $status == 0)) {
            $postData['id'] = $id;
            $postData['status'] = $status;
            $page_title = 'Size Active';
            $this->load->model('Product_Model');
            if ($status == 0) {
                $page_title = 'Size Inactive';
            }

            if ($this->Product_Model->saveSize($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
        redirect('admin/MultipleAttributes/sizes');
    }
    public function deleteSize($id = null)
    {
        if (!empty($id)) {
            $page_title = 'Size Delete';
            $this->load->model('Product_Model');
            if ($this->Product_Model->deleteSize($id)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
        redirect('admin/MultipleAttributes/sizes');
    }
    public function quantity()
    {
        $this->load->model('Product_Model');
        $this->data['page_title'] = 'Product Quantity';
        $this->data['sub_page_title'] = 'Add New Quantity';
        $this->data['sub_page_url'] = 'addEditQuantity';
        $this->data['sub_page_view_url'] = '';
        $this->data['sub_page_delete_url'] = 'deleteQuantity';
        $this->data['sub_page_url_active_inactive'] = 'activeInactiveQuantity';
        $lists = $this->Product_Model->getQuantityList();
        $this->data['lists'] = $lists;
        $this->render($this->class_name . 'quantity');
    }

    public function addEditQuantity($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Quantity';
        if (!empty($id)) {
            $this->data['page_title'] = $page_title = 'Edit Quantity';
        }

        $this->data['main_page_url'] = 'quantity';
        $this->load->model('Product_Model');
        $postData = array();
        $postData = $this->Product_Model->getQtyById($id);

        if ($this->input->post()) {
            $this->load->library('form_validation');
            if (!empty($id)) {
                $postData['id'] = $this->input->post('id');
                $set_rules = $this->Product_Model->configQuantityEdit;
            } else {
                $set_rules = $this->Product_Model->configQuantity;
            }
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            $postData['name'] = $this->input->post('name');
            $postData['name_french'] = $this->input->post('name_french');
            if ($this->form_validation->run() === true) {
                $insert_id = $this->Product_Model->saveQuantity($postData);

                if ($insert_id > 0) {
                    $this->session->set_flashdata('message_success', $page_title . ' Successfully.');

                    redirect('admin/MultipleAttributes/quantity');
                } else {
                    $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        $this->data['postData'] = $postData;

        $this->render($this->class_name . 'add_edit_quantity');
    }

    public function activeInactiveQuantity($id = null, $status = null)
    {
        if (!empty($id) && ($status == 1 || $status == 0)) {
            $postData['id'] = $id;
            $postData['status'] = $status;
            $page_title = 'Quantity Active';
            $this->load->model('Product_Model');
            if ($status == 0) {
                $page_title = 'Quantity Inactive';
            }

            if ($this->Product_Model->saveQuantity($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
        redirect('admin/MultipleAttributes/quantity');
    }

    public function deleteQuantity($id = null)
    {
        if (!empty($id)) {
            $page_title = 'Quantity Delete';
            $this->load->model('Product_Model');
            if ($this->Product_Model->deleteQuantity($id)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
        redirect('admin/MultipleAttributes/quantity');
    }
}
