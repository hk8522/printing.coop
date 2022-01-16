<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supports extends Admin_Controller
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
		$this->load->model('Ticket_Model');
		$this->data['page_title'] = 'Supports';
		$this->data['sub_page_title'] = '';
		$this->data['sub_page_url'] = '';
	    $this->data['sub_page_view_url'] = 'view';
		$this->data['sub_page_delete_url'] = 'delete';
		$this->data['sub_page_url_active_inactive'] = '';
		$this->data['SupportQuery']=$this->Ticket_Model->getSupportQuery();
		$this->load->model('Store_Model');
		$StoreList=$this->Store_Model->getAllStoreList();
		$this->data['StoreList']=$StoreList;

		$this->render($this->class_name.'index');
    }

	 public function view($id=null)
    {
		if(empty($id)){
			redirect('admin/Supports');
		}
		$this->load->model('Ticket_Model');
		$this->data['page_title'] = 'Query Details';
		$this->data['main_page_url'] = '';
		$data=$this->Ticket_Model->getSupportQuery($id);
		$this->data['data']=$data;
		$this->load->model('Store_Model');
		$StoreList=$this->Store_Model->getAllStoreList();
		$this->data['StoreList']=$StoreList;
		$this->render($this->class_name.'view');
    }

	public function delete($id=null)
    {
        if(!empty($id)){
				$page_title='Query';
				$this->load->model('Ticket_Model');
				if ($this->Ticket_Model->deleteQuery($id))
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
		redirect('admin/Supports');
    }
}
