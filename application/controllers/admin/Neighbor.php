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

        // $this->session->set_flashdata('message_success', '');
        // $this->session->set_flashdata('message_error',   '');
    }

    public function index($neighbor_id = 0, $order = 'desc')
    {
        if ($this->input->post()) {
            $order=$_POST['order'];
            redirect("admin/Neighbor/index/$neighbor_id/$order");
        }

        $this->load->model('Neighbor_Model');
        $this->data['page_title'] = 'Neighbor';

        $this->load->library('pagination');
        $this->load->config('pagination');	
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

    public function edit($neighbor_id = null, $order = 'asc') {
		$this->load->model('Neighbor_Model');
        $this->load->helper('form');

        if ($this->input->post()) {
            $this->load->library('form_validation');
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
                    $this->session->set_flashdata('message_success', "Saved Successfully.");
                    redirect('admin/Neighbor');
                } else {
                    $this->session->set_flashdata('message_error', "Save Unsuccessful.");
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        if ($neighbor_id == null) {
            $neighbor['name'] = '';
            $neighbor['url']  = '';
        } else {
            $neighbor = $this->Neighbor_Model->getNeighbors($neighbor_id);
            if (count($neighbor) == 0)
                redirect("admin/Neighbor/index/$neighbor_id");
            else
                $neighbor = $neighbor[0];
        }
        $this->data['main_page_url'] = '';
        $this->data['neighbor'] = $neighbor;
        $this->data['neighbor_id'] = $neighbor_id;
        $this->data['order'] = $order;
        $this->render($this->class_name . 'edit');
    }

    public function delete($neighbor_id)
    {
        $this->load->model('Neighbor_Model');
        if ($this->Neighbor_Model->delete($neighbor_id))
            $this->session->set_flashdata('message_success', 'Deleted Successfully.');
        else
            $this->session->set_flashdata('message_error', 'Delete Unsuccessful.');
        redirect('admin/Neighbor');
    }

    public function attributeSort($neighbor_id = 0, $order = 'desc')
    {
        if ($this->input->post()) {
            $order=$_POST['order'];
            redirect("admin/Neighbor/edit/$neighbor_id/$order");
        }
    }
}
