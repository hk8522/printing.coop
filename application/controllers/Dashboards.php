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
        //$this->load->model('ProductOrder_Model');
        $totalUser=$this->User_Model->getCountUser();
        $totalActiveUser=$this->User_Model->getCountUser('active');
        $totalIctiveUser=$this->User_Model->getCountUser('inactive');
        $this->data['totalUser']=$totalUser;
        $this->data['totalActiveUser']=$totalActiveUser;
        $this->data['totalIctiveUser']=$totalIctiveUser;

        /*$this->data['totalNewOrder']=$this->ProductOrder_Model->getCountOuder(2);
        $this->data['totalDeliveredOrder']=$this->ProductOrder_Model->getCountOuder(5);
        $this->data['totalCancelledOrder']=$this->ProductOrder_Model->getCountOuder(6);
        */

        if($this->$this->adminLoginRole='admin'){
          $this->render($this->class_name.'index');
        }else{
            $this->render($this->class_name.'sub_admin');
        }
    }
}
