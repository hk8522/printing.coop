<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends Admin_Controller
{
	public $class_name='';
	function __construct()
	{
		parent::__construct();
		$this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
		$this->data['class_name']= $this->class_name;
	}

    public function creatediscount()
    {
		$this->render($this->class_name.'creatediscount');
    }

    public function managediscount()
    {
		$this->render($this->class_name.'managediscount');
    }
}
