<?php $this->view('elements/slider.php');?>
<?php
    if($website_store_id !=5){
		$this->view('elements/HomeSections/our_printed_products.php');
	}else{
		$this->view('elements/HomeSections/our_ink_printed_products.php');
		$this->view('elements/HomeSections/ecoink_search.php');
	}
?>
<?php $this->view('elements/HomeSections/section_1.php');   #ABOUT US Section?>
<?php $this->view('elements/HomeSections/section_2.php');   #Proudly Display Your Brand  Section?>
<?php $this->view('elements/HomeSections/section_3.php'); #OUR SERVICES Section ?>
<?php
	if($website_store_id !=5){
		$this->view('elements/HomeSections/section_4.php'); #Montreal book printing Section
	}
?>
<?php $this->view('elements/HomeSections/section_5.php'); #Our Promise To You Section?>
<?php $this->view('elements/HomeSections/section_6.php'); #Main Services  Section?>
<?php $this->view('elements/HomeSections/section_7.php'); #REGISTER FOR FREE!  Section?>
<?php //$this->view('elements/HomeSections/covind19-msg.php'); #covind19 message?>

