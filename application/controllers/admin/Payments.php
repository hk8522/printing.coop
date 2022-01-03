<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends Admin_Controller
{
	public $class_name='';
	function __construct()
	{
		parent::__construct();
		$this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
		$this->data['class_name']= $this->class_name;
	}


    public function authorize()
    {


		$this->render($this->class_name.'authorize');


    }

    public function paypal()
    {


		$this->render($this->class_name.'paypal');


    }

    public function stripe()
    {


		$this->render($this->class_name.'stripe');


    }

    public function pageslist()
    {


		$this->render($this->class_name.'pageslist');


    }


}
