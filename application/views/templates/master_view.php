<?php defined('BASEPATH') OR exit('No direct script access allowed');

  $this->load->view('templates/_parts/master_header_view'); ?>
  <?php $this->load->view('elements/breadcrumb.php')?>
  <?= $the_view_content ?>

<?php $this->load->view('templates/_parts/master_footer_view');?>
