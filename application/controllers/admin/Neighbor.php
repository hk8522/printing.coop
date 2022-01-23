<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'libraries/xlsxwriter.class.php');
require_once(APPPATH.'../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Neighbor extends Admin_Controller
{
    public $class_name = '';

    function __construct()
    {
        parent::__construct();
        $this->class_name='admin/' . ucfirst(strtolower($this->router->fetch_class())) . '/';
        $this->data['class_name'] = $this->class_name;

        $this->load->model('Product_Model');
        $this->load->model('Neighbor_Model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->config('pagination');

        // $this->session->set_flashdata('message_success', '');
        // $this->session->set_flashdata('message_error',   '');
    }

    public function index($neighbor_id = 0, $order = 'desc')
    {
        if ($this->input->post()) {
            $order=$_POST['order'];
            redirect("admin/Neighbor/index/$neighbor_id/$order");
        }

        $this->data['page_title'] = 'Neighbor';

        $config = $this->config->item('pagination_config');
        $config["base_url"] = base_url(). "admin/Neighbor/index/$neighbor_id/$order";
        $config["total_rows"] = $this->Neighbor_Model->getNeighborsCount($neighbor_id);
        //pr($this->uri,1);
        $config["per_page"] = 20;
        $config["uri_segment"] = 5;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
        $this->data["links"] = $this->pagination->create_links();
        $list = $this->Neighbor_Model->getNeighbors($neighbor_id, $config["per_page"], $page, $order);
        $this->data['list'] = $list;
        $this->data['order'] = $order;
        $this->render($this->class_name . 'index');
    }

    public function edit($neighbor_id = 0, $data_id = 0, $order = 'asc') {
        if ($this->input->post()) {
            $set_rules = $this->Neighbor_Model->config;

            $data = [
                'name' => $this->input->post('name'),
                'url'  => $this->input->post('url'),
            ];
            if ($neighbor_id)
                $data['id'] = $neighbor_id;

            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if ($this->form_validation->run() === TRUE) {
                $new_id = $this->Neighbor_Model->save($data);

                if ($new_id > 0) {
                    $attributesOrg = [];
                    $attributesNew = [];
                    $data_ids = $_POST['data_id'];
                    foreach ($data_ids as $index => $data_id) {
                        if ($_POST['attribute_id'][$index] == 0)
                            continue;
                        if ($_POST['neighbor_attribute'][$index] == null)
                            continue;
                        if ($data_id > 0)
                            $attributesOrg[] = array(
                                'id' => $data_id,
                                'neighbor_id' => $neighbor_id,
                                'attribute_id' => $_POST['attribute_id'][$index],
                                'name' => $_POST['neighbor_attribute'][$index]
                            );
                        else
                            $attributesNew[] = array(
                                'neighbor_id' => $neighbor_id,
                                'attribute_id' => $_POST['attribute_id'][$index],
                                'name' => $_POST['neighbor_attribute'][$index]
                            );
                    }
                    $this->Neighbor_Model->saveAttributes($attributesOrg, $attributesNew);

                    $itemsOrg = [];
                    $itemsNew = [];
                    $item_data_ids = $_POST['item_data_id'];
                    foreach ($item_data_ids as $index => $item_data_id) {
                        if ($_POST['neighbor_attribute_item'][$index] == null)
                            continue;
                        if ($item_data_id > 0)
                            $itemsOrg[] = array(
                                'id' => $item_data_id,
                                'neighbor_id' => $neighbor_id,
                                'attribute_id' => $_POST['item_attribute_id'][$index],
                                'attribute_item_id' => $_POST['attribute_item_id'][$index],
                                'name' => $_POST['neighbor_attribute_item'][$index]
                            );
                        else
                            $itemsNew[] = array(
                                'neighbor_id' => $neighbor_id,
                                'attribute_id' => $_POST['item_attribute_id'][$index],
                                'attribute_item_id' => $_POST['attribute_item_id'][$index],
                                'name' => $_POST['neighbor_attribute_item'][$index]
                            );
                    }
                    $this->Neighbor_Model->saveAttributeItems($itemsOrg, $itemsNew);

                    $this->session->set_flashdata('message_success', "Saved Successfully.");
                    redirect('admin/Neighbor');
                } else {
                    $this->session->set_flashdata('message_error', "Save Unsuccessful.");
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        if ($neighbor_id > 0) {
            $neighbor = $this->Neighbor_Model->getNeighbors($neighbor_id);
            if (count($neighbor) == 0)
                redirect("admin/Neighbor/index/$neighbor_id");
            else
                $neighbor = $neighbor[0];
        } else {
            $neighbor['name'] = '';
            $neighbor['url']  = '';
        }
        $this->data['neighbor'] = $neighbor;
        $this->data['neighbor_id'] = $neighbor_id;
        $this->data['order'] = $order;

        $this->data['attributes'] = $this->Neighbor_Model->attributes($neighbor_id);
        $this->data['attributeItems'] = $this->Neighbor_Model->attributeItemsForNeighbor($neighbor_id);

        $this->render($this->class_name . 'edit');
    }

    public function delete($neighbor_id)
    {
        if ($this->Neighbor_Model->delete($neighbor_id))
            $this->session->set_flashdata('message_success', 'Deleted Successfully.');
        else
            $this->session->set_flashdata('message_error', 'Delete Unsuccessful.');
        redirect('admin/Neighbor');
    }

    public function attributeSort($neighbor_id = 0, $order = 'desc')
    {
        if ($this->input->post()) {
            $order = $_POST['order'];
            redirect("admin/Neighbor/edit/$neighbor_id/$order");
        }
    }

    public function attributeEdit($neighbor_id, $data_id = 0, $order = 'asc') {
        if ($this->input->post()) {
            $set_rules = array(
                array(
                    'field' => 'attribute_id',
                    'label' => 'Multiple Attribute',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Enter Multiple Attribute',
                    ),
                ),
                array(
                    'field' => 'name',
                    'label' => 'Neighbor\'s Attribute',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Enter Neighbor\'s Attribute',
                    ),
                ),
            );

            $data = [
                'neighbor_id' => $neighbor_id,
                'attribute_id' => $this->input->post('attribute_id'),
                'name'  => $this->input->post('name'),
            ];
            $data['id'] = $data_id;

            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if ($this->form_validation->run() === TRUE) {
                $new_id = $this->Neighbor_Model->saveAttribute($data);

                if ($new_id > 0) {
                    $this->session->set_flashdata('message_success', "Saved Successfully.");
                    redirect("admin/Neighbor/edit/$neighbor_id");
                } else {
                    $this->session->set_flashdata('message_error', "Save Unsuccessful.");
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        if ($data_id > 0) {
            $attributeData = $this->Neighbor_Model->getAttributeData($neighbor_id, $data_id);
            if (count($attributeData) == 0)
                redirect("admin/Neighbor/attributeEdit/$neighbor_id");
            else
                $attributeData = $attributeData[0];
        } else {
            $neighbor['attribute_id'] = '';
            $neighbor['name']  = '';
        }
        $this->data['neighbor'] = $this->Neighbor_Model->getNeighbors($neighbor_id)[0];
        $this->data['attributeData'] = $attributeData;
        $this->data['data_id'] = $data_id;
        $this->data['order'] = $order;
        $this->render($this->class_name . 'attribute_edit');
    }

    public function attributeDelete($neighbor_id, $data_id)
    {
        if ($this->Neighbor_Model->deleteAttribute($neighbor_id, $data_id))
            $this->session->set_flashdata('message_success', 'Deleted Successfully.');
        else
            $this->session->set_flashdata('message_error', 'Delete Unsuccessful.');
        redirect("admin/Neighbor/attributeEdit/$neighbor_id");
    }
}
