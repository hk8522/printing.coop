<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends Admin_Controller
{
  public $class_name='';
  function __construct()
  {
    parent::__construct();
	$this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';

  }

	public function index()
	{
		$this->load->model('User_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('Ticket_Model');
		$this->load->model('Product_Model');
		$totalUser=$this->User_Model->getCountUser();
		$userList=$this->User_Model->getListNewUser();
		$this->data['totalUser']=$totalUser;
		$this->data['userList']=$userList;
		$this->data['totalOrder']=$this->ProductOrder_Model->getCountOuder();
		$this->data['totalUnresolvedTicket']=$this->Ticket_Model->getCountTicket(0);

		$this->data['totalSubscribeEmail']=$this->Product_Model->getCountSubscribeEmail();
		$this->data['totalProducts']=$this->Product_Model->getCountProducts();
        $query = $this->db->query('SELECT count(id) as total_order FROM product_orders WHERE updated >= now() - INTERVAL 1 DAY AND status=6');

       $totalCancelOrder=$query->result_array();
	   $this->data['totalCancelOrder']=!empty($totalCancelOrder[0]['total_order']) ? $totalCancelOrder[0]['total_order']:0;

	   $query = $this->db->query('SELECT sum(total_amount) as total_sale FROM product_orders WHERE updated >= now() - INTERVAL 1 DAY AND status IN(2,3,4,5)');

       $totalSale=$query->result_array();
	   $this->data['totalSale']=!empty($totalSale[0]['total_sale']) ? $totalSale[0]['total_sale']:0;

	   /*$totalActiveUser=$this->User_Model->getCountUser('active');
		$totalIctiveUser=$this->User_Model->getCountUser('inactive');
	    $this->data['totalActiveUser']=$totalActiveUser;
		$this->data['totalIctiveUser']=$totalIctiveUser;	/*$this->data['totalNewOrder']=$this->ProductOrder_Model->getCountOuder(2);
		$this->data['totalDeliveredOrder']=$this->ProductOrder_Model->getCountOuder(5);
		$this->data['totalCancelledOrder']=$this->ProductOrder_Model->getCountOuder(6);*/

		if($this->adminLoginRole  !='admin'){

		    $this->render($this->class_name.'sub_admin');
		}else{
			$this->render($this->class_name.'index');

		}
	}
}
