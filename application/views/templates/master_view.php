<?php defined('BASEPATH') or exit('No direct script access allowed');
    $this->load->view('templates/_parts/master_header_view');
    $this->load->view('elements/breadcrumb.php');
    echo $the_view_content;
    $this->load->view('templates/_parts/master_footer_view');