<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Public_Controller
{
	  public $class_name = '';

  	function __construct()
  	{
  		  parent::__construct();
  		  $this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
  	}

    public function index()
    {
        $this->data['page_title'] = 'FAQ';
        $this->render($this->class_name.'index');
    }
}
?>
