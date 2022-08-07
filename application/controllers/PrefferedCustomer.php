<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrefferedCustomer extends Public_Controller
{
    public $class_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->class_name = 'PrefferedCustomer/';
    }

    public function index()
    {
        $this->data['page_title'] = 'Preffered Customer';
        $this->render($this->class_name . 'index');
    }
}
