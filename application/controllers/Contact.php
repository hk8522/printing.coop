<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends Public_Controller
{
    public $class_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->class_name = ucfirst(strtolower($this->router->fetch_class())) . '/';
    }

    public function index()
    {
        $this->data['page_title'] = 'Contact Us';
        $this->render($this->class_name . 'index');
    }
}
