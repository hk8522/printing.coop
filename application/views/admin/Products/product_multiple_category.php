<style type="text/css">
  .controls.small-control {
    position: relative;
    }
.entrynew.input-group .form-control {
	width: 100px;
}
.attribute-inner, .attribute-info-inner {
	text-align: center;
	display: flex;
	align-items: center;
	justify-content: flex-end;
}
.attribute-info .row .col-md-6:nth-child(2) .attribute-info-inner {
    justify-content: flex-start;
}
#WidthAndLengthSection .attribute-info .row .col-md-6:nth-child(2) .attribute-info-inner {
    justify-content: flex-end;
}
.for-att-multi .attribute-info .row .col-md-6:nth-child(2) .attribute-info-inner {
    justify-content: flex-end;
}
.for-att-multi .attribute-info .row .col-md-12 .attribute-info-inner {
    padding-left: 0px;
    margin-top: 5px;
}
.attribute-inner label, .attribute-info-inner label {
	margin: 0px !important;
	padding-right: 5px;
}
.control-group .attribute-inner input, .control-group .attribute-info-inner input {
    height: 30px !important;
    padding: 5px 5px !important;
    color: #000;
    background-color: rgb(255, 255, 255);
    background-image: none;
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
    font-size: 13px;
    width: 80px;
    text-align: center;
}
.control-group .attribute-info-inner select {
    height: 30px !important;
    padding: 5px 5px !important;
    color: #000;
    background-color: rgb(255, 255, 255);
    background-image: none;
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
    font-size: 13px;
    width: 100%;
    text-align: left;
}
.attribute-row {
	padding: 0px;
	background: #f9f9f9;
	height: 0px;
	overflow: hidden;
	margin-bottom: 0px;
}
.attribute-row.field-area {
    padding: 10px 10px 10px 10px;
    background: #f9f9f9;
    height: auto;
}
.attribute.active .attribute-row {
	padding: 10px 10px 10px 25px;
	background: #f9f9f9;
	height: auto;
	margin-bottom: 10px;
}
.attribute-info {
    background: #fff;
    padding: 5px 5px;
    margin-bottom: 10px;
}
.attribute-info-inner {
	padding: 0px 0px 0px 20px;
}
.attribute-title {
	background: #f1f1f1;
	padding: 5px 10px;
}
.attribute {
	padding-bottom: 10px;
}
.controls.small-controls .attribute:last-child {
	margin: 0px;
	padding: 0px;
}
.control-group .controls.small-controls .attribute-title .span2 {
	margin-bottom: 0px !important;
}
</style>
<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span><?php echo $page_title?></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red">
                                        <?php echo $this->session->flashdata('message_error');?>
                                    </div>
                                    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                   <input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>" id="product_id">
 <div class="form-role-area">
<div class="control-group info">
	<div class="row">
		<div class="col-md-3" style="">
		    <label class="span2 " for="inputMame">Select Product Multiple Category</label>
		</div>

        <div class="col-md-9">
           <div class="controls small-controls">
<?php
#pr($ProductCategory);
foreach($Categoty as $qkey=>$qval){
$category_id=$qval['id'];
$category_name=$qval['name'];
$sub_categories=$qval['sub_categories'];
$ProductSubCategory=isset($ProductCategory[$category_id]) ?$ProductCategory[$category_id]:array();
?>
<div class="attribute">
    <div class="attribute-title">
        <div class="row align-items-center">
            <div class="col-md-12">
                <label class="span2">
                    <input type="checkbox" value="<?php echo $category_id?>" name="category_id_<?php echo $category_id?>" id="category_id_<?php echo $category_id?>" <?php if(array_key_exists($category_id,$ProductCategory)) echo "checked"?> onchange="addActiveQuantitySizeClass('<?php echo $category_id?>')">
	                <?php echo $category_name;?>
                </label>
            </div>
	    </div>
    </div>
	<div class="attribute" id="quantity_attribute_id_div_<?php echo $category_id ?>" style="display:<?php echo array_key_exists($category_id,$ProductCategory) ? '' :'none'?>; padding: 10px 10px 10px 25px; background: #f5f5f5;">
        <?php
		foreach($sub_categories as $key=>$val){

			$sub_category_id=$val['id'];
            $sub_category_name=$val['name'];
        ?>
        <div class="attribute">

		    <div class="attribute-title">
	           <div class="row align-items-center">
	               <div class="col-md-12">
	                   <label class="span2">
	                       <input type="checkbox" value="<?php echo $sub_category_id?>" name="sub_category_id_<?php echo $category_id?>_<?php echo $sub_category_id?>"  id="sub_category_id_<?php echo $category_id?>_<?php echo $sub_category_id?>"  <?php if(in_array($sub_category_id,$ProductSubCategory)) echo "checked"?>>
	                       <?php echo $sub_category_name;?>
                        </label>
                    </div>
                </div>
            </div>
	    </div>
        <?php }?>
    </div>
</div>

<?php }?>
		    </div>
	    </div>
	</div>
</div>

  <div class="product-actions-btn text-right">
                                            <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                            <a href="<?php echo $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
                                        </div>
                  <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<script>

	function addActiveClass(id){

		if($("#attribute_id_"+id).prop("checked") == true){
			$("#attribute_id_div_"+id).addClass('active');
		}else{
			$("#attribute_id_div_"+id).removeClass('active');
		}
	}

	function setAttributesetItemId(id){
		//alert(id);

		if($("#"+id).prop("checked") == true){

			$("#hidden_"+id).val($("#"+id).val());
		}else{

			$("#hidden_"+id).val('');
		}

	}

	function addActiveSizeClass(id){

		if($("#size_attribute_id_"+id).prop("checked") == true){

			$("#size_attribute_id_div_"+id).addClass('active');
		}else{

			$("#size_attribute_id_div_"+id).removeClass('active');
		}

	}
	function addActiveQuantitySizeClass(id){

		if($("#category_id_"+id).prop("checked") == true){


			$("#quantity_attribute_id_div_"+id).show();

		}else{

			$("#quantity_attribute_id_div_"+id).hide();
		}

	}

</script>
