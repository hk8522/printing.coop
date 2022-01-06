<script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
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
.attribute-inner label, .attribute-info-inner label {
	margin: 0px !important;
	padding-right: 5px;
}
.attribute-inner input, .attribute-info-inner input {
	height: 30px;
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
.attribute-info {
	padding: 0px;
	background: #f9f9f9;
	height: 0px;
	overflow: hidden;
	margin-bottom: 0px;
}
.attribute.active .attribute-info {
	padding: 10px 10px 10px 25px;
	background: #f9f9f9;
	height: auto;
	margin-bottom: 10px;
}
.attribute-info {
	background: #fff;
	padding: 10px 10px;
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
									       <!--<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Store</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">
                                                        <div class="row">


                            <?php
                            $store_id = isset($postData['store_id']) ? explode(',',$postData['store_id']):'';
																																																						foreach ($StoreList as $key=>$val){
																																																							$selected = '';
																																																	if (in_array($val['id'],$store_id)){
																																																									$selected='checked';
																																																							}
																									?>
												        <div class="col-md-3">
                                                            <label class="span2"><input type="checkbox" value="<?php echo $val['id'];?>" <?php echo $selected;?> name="store_id[]"> <?php echo $val['name']; ?> </label>
                                                        </div>

																	<?php
                                                                        }
                                                                        ?>

                                 <?php echo form_error('store_id[]');?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Select Fields</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="category_id" id="category_id" required>
                                                                    <option value="">Select Category</option>
                                                                    <?php
                                                                        $category_id = isset($postData['category_id']) ? $postData['category_id']:'';
																																																						foreach ($categoryList as $key=>$val){
																																																							$selected = '';
																																																							if ($key==$category_id){
																																																									$selected='selected="selected"';
																																																							}
																																																						?>
																																																			          <option value="<?php echo $key?>" <?php echo $selected ?>><?php echo $val;?></option>
                                                                    <?php
                                                                        }
                                                                        ?>
                                                                </select>
                                                                <label class="form-inner-label">Select Category</label>
                                                                <?php echo form_error('category_id');?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="sub_category_id" id="sub_category_id">
                                                                    <option value="">Select Sub Category</option>
                                                                    <?php
                                                                        $sub_category_id=isset($postData['sub_category_id']) ? $postData['sub_category_id']:'';
	                                                                      foreach ($subCategoryList as $key=>$val){
																																					$selected = '';
																																					if ($key == $sub_category_id){
																																						$selected='selected="selected"';
																																					}
                                                                        ?>
                                                                    <option value="<?php echo $key?>" <?php echo $selected ?>><?php echo $val;?></option>
                                                                    <?php
                                                                        }
                                                                        ?>
                                                                </select>
                                                                <label class="form-inner-label">Select Sub Category</label>
                                                                <?php echo form_error('sub_category_id');?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame"> Product Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Product Name" value="<?php echo isset($postData['name']) ? $postData['name']:'';?>" required>
                                                        <?php echo form_error('name');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">Product Short Description</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="short_description" id="short_description" type="text" placeholder="short description" value="<?php echo isset($postData['short_description']) ? $postData['short_description']:'';?>">
                                                        <?php echo form_error('short_description');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Product Full Description</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <textarea class="form-control" name="full_description" id="content" maxlength="100"><?php echo isset($postData['full_description'])? $postData['full_description']:'';?></textarea>
                                                        <?php echo form_error('full_description');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
				                        <div class="control-group info">
											<div class="row">
												<div class="col-md-3">
											 		<label class="span2 " for="inputMame">Extra Product Full Description</label>
												</div>
									           <div class="col-md-9 DescriptionData">
                                        <?php

                                            if(!empty($ProductDescriptions)){

    $last=count($ProductDescriptions);
    $last=$last-1;

                                            foreach($ProductDescriptions as $key=>$val){
                                                //echo $key;
                                            ?>

                                            <div class="controls description-class ddata">
                                                <div class="discription-single">
                                        <?php
																								$displayplusnbtn='none';
																								   $displayminusbtn='';
									if($last==0){
										$displayplusnbtn='';
										$displayminusbtn='none';

									}else if($last==$key){

									   $displayplusnbtn='';
									   $displayminusbtn='';

									}
									?>
                                        <div class="add-new-btn">

											<button class="btn-danger dbtn-remove" type="button" style="display:<?php echo $displayminusbtn;?>"><i class="fa fa-minus"></i></button>

											<button class="btn-success dbtn-add" type="button" style="display:<?php echo $displayplusnbtn;?>"><i class="fa fa-plus"></i>
											</button>

                                        </div>

                                                    <input type="text" class="form-control" placeholder="Discription Title" name="title[]" value="<?php echo $val['title'];?>">
                                                    <textarea class="form-control ckeditor" name="description[]" placeholder="Full Description" ><?php echo $val['description'];?></textarea>
                                                </div>
                                            </div>

                                        <?php }
                                        }else{?>
                                        <div class="controls description-class ddata">
                                        <div class="discription-single">
                                        <div class="add-new-btn">

											<button class="btn-danger dbtn-remove" type="button" style="display:none"><i class="fa fa-minus"></i></button>

											<button class="btn-success dbtn-add" type="button"><i class="fa fa-plus"></i>
											</button>

                                        </div>

                                        <input type="text" class="form-control" placeholder="Discription Title" name="title[]">
                                        <textarea class="form-control ckeditor" name="description[]" placeholder="Full Description"></textarea>



                                        </div>
                                        </div>

                                        <?php }?>


												</div>
											</div>
										</div>
                                        <div class="control-group info">
											<div class="row">
												<div class="col-md-3">
											 		<label class="span2 " for="inputMame">Product Templates</label>
												</div>
									           <div class="col-md-9 TempalteDiscription">
                                        <?php
                                            //pr($ProductTemplates);
                                            if(!empty($ProductTemplates)){

                                            $last=count($ProductTemplates);
                                            $last=$last-1;

                                            foreach($ProductTemplates as $key=>$val){

                                            ?>

                                            <div class="controls description-class tmds">
                                                <div class="discription-single">

												<?php
																								$displayplusnbtn='none';
																								   $displayminusbtn='';
									if($last==0){
										$displayplusnbtn='';
										$displayminusbtn='none';

									}else if($last==$key){

									   $displayplusnbtn='';
									   $displayminusbtn='';

									}
									?>
                                        <div class="add-new-btn">

											<button class="btn-danger tdtn-remove" type="button" style="display:<?php echo $displayminusbtn;?>"><i class="fa fa-minus"></i></button>

											<button class="btn-success tdtn-add" type="button" style="display:<?php echo $displayplusnbtn;?>"><i class="fa fa-plus"></i>
											</button>

                                        </div>


                                                    <input type="text" class="form-control" placeholder="Final Dimensions" name="final_dimensions[]" value='<?php echo $val['final_dimensions'];?>'>
                                                    <textarea class="form-control" name="template_description[]" placeholder="Template Description" ><?php echo $val['template_description'];?></textarea>

													<input class="btn btn-primary" name="template_file_old[]" type="hidden" value="<?php echo $val['template_file'];?>"/>
													<?php if($val['template_file']){

													   $link=$BASE_URL."admin/Orders/download/".urlencode(TEMPLATE_FILE_BASE_PATH.$val['template_file'])."/".urlencode($val['template_file']);
													?>

													<label class="file_name">File Name:<?php echo $val['template_file'] ?><a href="<?php echo $link?>">
								                       <i class="fa fa-download" aria-hidden="true"></i></a></label>
													<?php }?><br>
                                                    <input class="btn btn-primary" name="template_file[]" type="file"  style="background-color:#3c8dbc !important;"/>
                                                </div>
                                            </div>

                                        <?php }
                                        }else{?>
                                        <div class="controls description-class tmds">
                                        <div class="discription-single">
										<div class="add-new-btn">

											<button class="btn-danger tdtn-remove" type="button" style="display:none"><i class="fa fa-minus"></i></button>

											<button class="btn-success tdtn-add" type="button"><i class="fa fa-plus"></i>
											</button>

                                        </div>



                                        <input type="text" class="form-control" placeholder="Final Dimensions" name="final_dimensions[]">
                                        <textarea class="form-control" name="template_description[]" placeholder="Template Description"></textarea>
										<br>
										<input class="btn btn-primary" name="template_file_old[]" type="hidden"/>
                                        <input class="btn btn-primary" name="template_file[]" type="file" style="background-color:#3c8dbc !important;"/>
                                        </div>
                                        </div>

                                        <?php }?>


												</div>
											</div>
										</div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Product Price</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <div class="row align-items-center">

                                                            <div class="col-md-3">
                                                                <input class="form-control" name="price" id="price" type="text" placeholder="List Price CAD" value="<?php echo isset($postData['price']) ? $postData['price']:'';?>" required>
                                                                <label class="form-inner-label">List Price CAD</label>
                                                                <?php echo form_error('price');?>
                                                            </div>

															 <div class="col-md-3">
                                                                <input class="form-control" name="price_euro" id="price_euro" type="text" placeholder="List Price EURO" value="<?php echo isset($postData['price_euro']) ? $postData['price_euro']:'';?>">
                                                                <label class="form-inner-label">List Price EURO</label>
                                                                <?php echo form_error('price_euro');?>
                                                            </div>

															 <div class="col-md-3">
                                                                <input class="form-control" name="price_gbp" id="price_gbp" type="text" placeholder="Product Price" value="<?php echo isset($postData['price_gbp']) ? $postData['price_gbp']:'';?>">
                                                                <label class="form-inner-label">List Price GBP</label>
                                                                <?php echo form_error('price_gbp');?>
                                                            </div>
															 <div class="col-md-3">
                                                                <input class="form-control" name="price_usd" id="price_usd" type="text" placeholder="Product Price" value="<?php echo isset($postData['price_usd']) ? $postData['price_usd']:'';?>">
                                                                <label class="form-inner-label">List Price USD</label>
                                                                <?php echo form_error('price_usd');?>
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Product Attributes</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                        <div class="row">
														    <div class="col-md-4">
                                                                <input class="form-control" name="code" id="code" type="text" placeholder="Product Code" value="<?php echo isset($postData['code']) ? $postData['code']:'';?>">
                                                                <label class="form-inner-label">Code</label>
                                                                <?php echo form_error('code');?>
                                                            </div>

                                                            <!--<div class="col-md-4">
                                                                <input class="form-control" name="total_stock" id="total_stock " type="text" placeholder="Product Stock" value="<?php echo isset($postData['total_stock']) ? $postData['total_stock']:'';?>">
                                                                <label class="form-inner-label">Total Stock</label>
                                                                <?php echo form_error('total_stock');?>
                                                            </div>-->

															<div class="col-md-4">
                                                                <?php
                                                                    $is_stock=isset($postData['is_stock']) ? $postData['is_stock']:'';
                                                                    $cehecked='';
                                                                    if ($is_stock == 1){
                                                                    	 $cehecked = 'checked';
                                                                    }
                                                                    ?>
                                                                <label class="span2"><input name="is_stock" id="is_stock" type="checkbox" value="1" <?php echo $cehecked;?>> Show Out of Stock</label>
                                                                <?php echo form_error('is_stock');?>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Product Tags</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">

                                        <div class="row">
										<?php
										$product_tags=isset($postData['product_tag']) ? explode(',',$postData['product_tag']):array();
					foreach($tagList as $key=>$val){
						$tag_id=$val['id'];
						$tag_name=$val['name'];
										?>
                                            <div class="col-md-4">
                                                  <?php

																																		          $cehecked='';
        if (in_array($tag_id,$product_tags)) {                $cehecked='checked';
        }
        ?>                                                             <label class="span2"><input name="product_tag[]" type="checkbox" value="<?php echo $tag_id;?>" <?php echo $cehecked;?>> <?php echo $tag_name;?>
		</label>
        <?php echo form_error('product_tag[]');?>
        </div>

		<?php }?>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Product Custom Add Length And Width</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">

                                        <div class="row">


                                            <div class="col-md-12">
                                                  <?php

																																		        $cehecked='';
        if ($postData['add_length_width']==1) {
		   $cehecked='checked';
        }
        ?>                                                            <label class="span2"><input name="add_length_width" type="checkbox" value="1" <?php echo $cehecked;?>>
		</label>
        <?php echo form_error('add_length_width');?>
        </div>




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
											<div class="row">
												<div class="col-md-3" style="">
												    <label class="span2 " for="inputMame">Product Size Quantity Attributes</label>
												</div>
												<div class="col-md-9">
                                                    <div class="controls small-controls">
        												<?php //pr($sizes); ?>
        												<?php foreach($sizes as $key=>$val){  //pr($AttributesList); die('OK');?>

        												    <div class="attribute <?php if(array_key_exists($key,$ProductSizes)) echo "active"?>" id="size_attribute_id_div_<?php echo $key?>">
															<!-- Toggle "active" class when clicked on input(checkbox) below -->
	     													    <div class="attribute-title">
        													        <div class="row align-items-center">
        													            <div class="col-md-12">
    														                <label class="span2">
    														           <input type="checkbox" value="<?php echo $key?>" name="size_attribute_id_<?php echo $key?>"  id="size_attribute_id_<?php echo $key?>"  <?php if(array_key_exists($key,$ProductSizes)) echo "checked"?> onchange="addActiveSizeClass('<?php echo $key;?>')">
    														                    <?php echo $val;?>
														                    </label>
        													            </div>
        													   	   </div>
        													    </div>
        													    <div class="attribute-info <?php echo $key?>SizeQuantity">
        													       <?php
																$items=isset($ProductSizes[$key]) ? $ProductSizes[$key]:array();
	//pr($ProductSizes);
		if(!empty($items)){


		$last=count($items)-1;

		foreach($items as $subkey=>$subval){
               												       ?>
    	 <div class="row <?php echo $key?>sqddata">
		     <div class="col-md-12">
                															    <div class="attribute-info">
                															        <div class="row">

            				<div class="col-md-4">
            															                    <div class="attribute-info-inner">

	<label class="form-inner-label">Quantity </label>
								<input type="text" value="<?php echo $subval['qty']?>" name="size_attribute_item_quantity_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Size Quantity">

            															                    </div>
        															                    </div>											                <div class="col-md-4">
            															                    <div class="attribute-info-inner">

			<label class="form-inner-label">Extra Price</label>													<input type="text" value="<?php echo $subval['price']?>" name="size_attribute_item_extra_price_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price">

            															                    </div>
        															                    </div>
																						 <div class="col-md-4">
            			<?php
																					     $displayplusnbtn='none';
																				        $displayminusbtn='';
					if($last==0){
						$displayplusnbtn='';
						$displayminusbtn='none';

					}else if($last==$subkey){

					   $displayplusnbtn='';
					   $displayminusbtn='';

					}
			?>													                  <div class="attribute-info-inner">
                	    <span class="input-group-btn">

  <button class="btn btn-danger <?php echo $key?>sqbtn-remove" type="button" style="display:<?php echo $displayminusbtn;?>" onclick="RemoveRow($(this),'<?php echo $key?>')"><span class="fa fa-minus"></span></button>                                                              <button class="btn btn-success <?php echo $key?>sqbtn-add" type="button" onclick="AddRow($(this),'<?php echo $key?>')" style="display:<?php echo $displayplusnbtn;?>">
                                                                    <span class="fa fa-plus"></span>
            															                    </div>
        															                    </div>
            															                												            </div>
                															    </div>
            															    </div>
		</div>
		<?php }
		}else{?>

		    <div class="row <?php echo $key?>sqddata">
		     <div class="col-md-12">
                															    <div class="attribute-info">
                															        <div class="row">

            				<div class="col-md-4">
            															                    <div class="attribute-info-inner">

	                         <label class="form-inner-label">Quantity </label>
				<input type="text" name="size_attribute_item_quantity_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Size qty">

            															                    </div>
        															                    </div>											                <div class="col-md-4">
            															                    <div class="attribute-info-inner">

			<label class="form-inner-label">Extra Price</label>													<input type="text" value="" name="size_attribute_item_extra_price_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price">

            															                    </div>
        															                    </div>
																						 <div class="col-md-4">
            															                  <div class="attribute-info-inner">
                				<span class="input-group-btn">

  <button class="btn btn-danger <?php echo $key?>sqbtn-remove" type="button" style="display:none" onclick="RemoveRow($(this),'<?php echo $key?>')"><span class="fa fa-minus"></span></button>                                                              <button class="btn btn-success <?php echo $key?>sqbtn-add" type="button" onclick="AddRow($(this),'<?php echo $key?>')">
                                                                    <span class="fa fa-plus"></span>
                                                                </button>
                                                            </span>
            															                    </div>
        															                    </div>
            															                												            </div>
                															    </div>
            															    </div>
		</div>
		<?php
		}?>

        													    </div>
        												    </div>

        												<?php }?>
												    </div>
											    </div>
											</div>
										</div>

										<div class="control-group info">
											<div class="row">
												<div class="col-md-3" style="">
												    <label class="span2 " for="inputMame">Product Extra Attributes</label>
												</div>
												<div class="col-md-9">
                                                    <div class="controls small-controls">
        												<?php //pr($ProductAttributes); ?>
        												<?php foreach($AttributesList as $key=>$val){  //pr($AttributesList); die('OK');?>

        												    <div class="attribute <?php if(array_key_exists($key,$ProductAttributes)) echo "active"?>" id="attribute_id_div_<?php echo $key?>"> <!-- Toggle "active" class when clicked on input(checkbox) below -->
        													    <div class="attribute-title">
        													        <div class="row align-items-center">
        													            <div class="col-md-8">
    														                <label class="span2">
    														                    <input type="checkbox" value="<?php echo $key?>" name="attribute_id_<?php echo $key?>"  id="attribute_id_<?php echo $key?>"  <?php if(array_key_exists($key,$ProductAttributes)) echo "checked"?> onchange="addActiveClass('<?php echo $key;?>')">
    														                    <?php echo $val['name'];?>
														                    </label>
        													            </div>
        													            <div class="col-md-4">
        													                <div class="attribute-inner">
        													                    <input type="text" value="<?php if(array_key_exists($key,$ProductAttributes)) echo $ProductAttributes[$key]['data']['show_order']?>" name="attribute_order_<?php echo $key?>" onkeypress="javascript:return isNumber(event)"  placeholder="set Order">
        														                <label class="form-inner-label">set order</label>
        														            </div>
        													            </div>
        													        </div>
        													    </div>
        													    <div class="attribute-info">
        													        <div class="row">
                												        <?php
            														        foreach($val['items'] as $subkey=>$subval){ ?>
    													                    <div class="col-md-6">
                															    <div class="attribute-info">
                															        <div class="row">
                															            <div class="col-md-12">
                															                <label class="span2">
                    														                    <input type="checkbox" value="<?php echo $subkey?>" name="attribute_item_id_<?php echo $key?>[]" <?php if(isset($ProductAttributes[$key]['items']) && array_key_exists($subkey,$ProductAttributes[$key]['items'])) echo "checked"?>>
                    															                <?php echo $subval?>
                														                    </label>
            															                </div>
            															                <div class="col-md-6">
            															                    <div class="attribute-info-inner">
                															                    <input type="text" value="<?php if(isset($ProductAttributes[$key]['items']) && array_key_exists($subkey,$ProductAttributes[$key]['items'])) echo $ProductAttributes[$key]['items'][$subkey]['extra_price']?>" name="attribute_item_extra_price_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price">
            															                        <label class="form-inner-label">Extra Price</label>
            															                    </div>
        															                    </div>
            															                <div class="col-md-6">
            															                    <div class="attribute-info-inner">
                    															                <input type="text" value="<?php if(isset($ProductAttributes[$key]['items']) && array_key_exists($subkey,$ProductAttributes[$key]['items'])) echo $ProductAttributes[$key]['items'][$subkey]['show_order']?>" name="attribute_item_order_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)"  placeholder="set Order">
        															                            <label class="form-inner-label">set Order</label>
    															                            </div>
                															            </div>
                															        </div>
                															    </div>
            															    </div>
                													    <?php }?>
        													        </div>
        													    </div>
        												    </div>

        												<?php }?>
												    </div>
											    </div>
											</div>
										</div>


										<div class="control-group info">
											<div class="row">
												<div class="col-md-3" style="">
												    <label class="span2 " for="inputMame">Upload Product Image</label>
												</div>
												<div class="col-md-9">
												    <div class="controls">
												        <?php foreach($ProductImages as $key=>$list){ ?>
                                                            <div class="col-xs-4" style="margin-bottom:15px;" id="img_<?php echo $list['id']?>">
                                                                <?php $imageurl=getProductImage($list['image']);?>
                                                                <img src="<?php echo $imageurl?>" width="100" height="80">
                                                                <input name="old_image[]" value="<?php echo $list['image'];?>" type="hidden">
                                                                &nbsp;&nbsp;
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-danger" type="button" title="remove image" onclick="remove_image('<?php echo $list['id']?>','<?php echo $list['image']?>')" id="img_remove_btn">
                                                                        <span class="fa fa-minus"></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        <?php }?>
												    </div>
												    <div class="controls file-data">
                                                        <div class="image-info col-xs-12" style="margin-bottom: 10px;">
                                                            <span>
                                                            Allowed image type  : <b> (jpg, png, gif)</b>
                                                            </span><br>
                                                            <!--<span>
                                                            Allowed image size maximum  : <b> (1Mb)</b>
                                                            </span>
                                                            <br>
                                                            <!--<span>
                                                            Allowed image in only square : <b> (minimum image dimensions 800pxX800px and maximum mindimensions 1500pxX1500px)</b>
                                                            </span>-->
                                                        </div>
                                                        <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
        <img id="fileUpload-1-Image" src="<?php echo $BASE_URL?>/assets/images/no-image.png" alt="preview image" width="100" height="80"/>
        <input class="btn btn-primary" name="files[]" type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="fileUpload-1" onchange="return Upload('fileUpload-1')"/>
                                                            &nbsp;&nbsp;
                                                            <span class="input-group-btn">

  <button class="btn btn-danger btn-remove" type="button"style="display:none"><span class="fa fa-minus"></span></button>                                                              <button class="btn btn-success btn-add" type="button">
                                                                    <span class="fa fa-plus"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                        <div style="color:red">
                                                            <?php echo $this->session->flashdata('file_message_error');?>
                                                        </div>
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

    var default_url_image='<?php echo $BASE_URL?>/assets/images/no-image.png';


    $('#menu_id').on('change', function (e) {

    var menu_id=$(this).val();
    $("#category_id").html('<option value="">Select Category</option>');
    $("#sub_category_id").html('<option value="">Select Sub Category</option>');
    $.ajax({
    type: 'GET',
    dataType: 'html',
    url: '<?php echo $BASE_URL ?>admin/Ajax/getCategoryDropDownListByAjax/'+menu_id,
    //data:{'menu_id':menu_id},
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
    	$("#category_id").html(data);
    }
    });
    });

    $('#category_id').on('change', function (e) {

    $("#sub_category_id").html('<option value="">Select Sub Category</option>');

    var menu_id=$("#menu_id").val();
    var category_id=$(this).val();
    $("#sub_category_id").html('<option value="">Select Sub Category</option>');
    $.ajax({
    type: 'GET',
    dataType: 'html',
    url: '<?php echo $BASE_URL ?>admin/Ajax/getSubCategoryDropDownListByAjax/'+category_id,
    //data:{'menu_id':menu_id},
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
    	$("#sub_category_id").html(data);
    }
    });
    });

    $(function(){

		$(document).on('click', '.btn-add', function(e){
			e.preventDefault();

			var controlForm = $('.file-data:first'),
			currentEntry = $(this).parents('.entry:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);
			newEntry.find('input').val('');
			newEntry.find('img').attr('src',default_url_image);
			var timestamp = new Date().getUTCMilliseconds();
					newEntry.find('input').attr('id',timestamp);
					newEntry.find('img').attr('id',timestamp+"-Image");
			var str='return Upload('+timestamp+')';
			newEntry.find('input').attr('onchange',str);

			newEntry.find('.btn-remove').show();
			controlForm.find('.btn-remove').show();
			controlForm.find('.btn-add').hide();
			newEntry.find('.btn-add').show();

			/*controlForm.find('.entry:not(:last) .btn-add')
			.removeClass('btn-add').addClass('btn-remove')
			.removeClass('btn-success').addClass('btn-danger')
			.html('<span class="fa fa-minus"></span>');*/


		}).on('click', '.btn-remove', function(e)
		{
			$(this).parents('.entry:first').remove();
			e.preventDefault();
			var numItems = $('.file-data .entry').length;


			if(numItems==1){

			var controlForm = $('.file-data .entry').last();
			controlForm.find('.btn-remove').hide();
			controlForm.find('.btn-add').show();
			}else{
		        var controlForm = $('.file-data .entry').last();
			    controlForm.find('.btn-remove').show();
			    controlForm.find('.btn-add').show();
			}
			return false;
		});
    });

    function remove_image(id,image_name){

    $("#submitBtn").attr("disabled", true);
    $("#img_remove_btn").attr("disabled",true);
    var product_id=$("#product_id").val();
    $.ajax({
    type: 'GET',
    dataType: 'html',
    url: '<?php echo $BASE_URL ?>admin/Ajax/removeProductImage/'+product_id+'/'+id+'/'+image_name,
    //data:{'menu_id':menu_id},
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
    	if(data==1){

    	    $("#img_"+id).remove();
			$("#img_remove_btn").attr("disabled",false);
    	}else{

    		$("#img_remove_btn").attr("disabled",false);
    	}

    	$("#submitBtn").attr("disabled", false);
    },
    error: function (error) {
      $("img_remove_btn").attr("disabled", false);
      $("#submitBtn").attr("disabled", false);

    }
    });

    }

    function bntInActive(id){

    $("#"+id).attr("disabled", true);

    }
</script>
<script>
    function Upload(imageId) {

       //alert(imageId);
       var fileUpload = document.getElementById(imageId);
       //Check whether the file is valid Image.
       var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|jpge|.png|.gif)$");
       if (regex.test(fileUpload.value.toLowerCase())) {
           if (typeof (fileUpload.files) != "undefined") {

               //Initiate the FileReader object.
               var reader = new FileReader();
               //Read the contents of Image File.
               reader.readAsDataURL(fileUpload.files[0]);
               reader.onload = function (e) {
               //Initiate the JavaScript Image object.
               var image = new Image();

               //Set the Base64 string return from FileReader as source.
               image.src = e.target.result;
			   //alert(e.target.result);
			   $("#"+imageId+"-Image").attr('src', e.target.result);
               //Validate the File Height and Width.
               image.onload = function () {

                    var height = this.height;
                    var width = this.width;
    				var imagesize=fileUpload.files[0].size;
    				var FILE_MAX_SIZE_JS='<?php echo FILE_MAX_SIZE_JS ?>';

    				//alert(imagesize);
    				/*if(FILE_MAX_SIZE_JS < imagesize){

    					$("#MsgModal .modal-body").html('<span style="color:red">Allowed image size maximum  :1Mb</b></span>');
    				    $("#MsgModal").modal('show');
                           return false;


    				}
					else if (height != width || height < 800 || width <800  || height > 1500 || width > 1500) {

    					document.getElementById(imageId).value='';
    					$("#MsgModal .modal-body").html('<span style="color:red"> Allowed image in only square :minimum image dimensions 800pxX800px and maximum mindimensions 1500pxX1500px</b></span>');
    				    $("#MsgModal").modal('show');
                           return false;
                    }*/

                   };

               }
           }
       }
    }
</script>
<script>
    $(document).ready(function(){

        $("#show-shipping-amount").click(function(){
            $(".shipping-amount-area").show();
        });
        $("#hide-shipping-amount").click(function(){
            $(".shipping-amount-area").hide();
        });

    });

	$(document).on('click', '.dbtn-add', function(e){
			//alert('OK');
			e.preventDefault();
			var controlForm = $('.DescriptionData:first'),
			currentEntry = $(this).parents('.ddata:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);

			newEntry.find('input').val('');
			newEntry.find('textarea').val('');
			newEntry.find('.cke_reset').remove();


			var timestamp = new Date().getUTCMilliseconds();
            newEntry.find('textarea').attr('id',"editor"+timestamp);

			newEntry.find('input').attr('id',timestamp);
			CKEDITOR.replace("editor"+timestamp,{
			height: 300,
			filebrowserUploadUrl: "upload.php",
			allowedContent:true,
			extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
		    });
		    CKEDITOR.dtd.$removeEmpty.i = 0;


			newEntry.find('.dbtn-remove').show();
			controlForm.find('.dbtn-remove').show();
			controlForm.find('.dbtn-add').hide();
			newEntry.find('.dbtn-add').show();

			//console.log(controlForm.find('.ddata:not(:last).dbtn-add'));
			//controlForm.find('.ddata:not(:last) .dbtn-add').removeClass('dbtn-add').addClass('dbtn-remove').removeClass('btn-success').addClass('btn-danger').html('<span class="fa fa-minus"></span>');



		}).on('click', '.dbtn-remove', function(e)
		{
			$(this).parents('.ddata:first').remove();
			e.preventDefault();

			var numItems = $('.DescriptionData .ddata').length;

			var controlForm = $('.DescriptionData .ddata').last();

			if(numItems==1){

			controlForm.find('.dbtn-remove').hide();
			controlForm.find('.dbtn-add').show();
			}else{
			    controlForm.find('.dbtn-remove').show();
			    controlForm.find('.dbtn-add').show();
			}
			return false;

	});


	function AddRow(cr,id){

		    var controlForm = $('.'+id+'SizeQuantity:first'),
			currentEntry = cr.parents('.'+id+'sqddata:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);

			newEntry.find('input').val('');
			newEntry.find('textarea').val('');

			var timestamp = new Date().getUTCMilliseconds();



			newEntry.find('.'+id+'sqbtn-remove').show();
			controlForm.find('.'+id+'sqbtn-remove').show();
			controlForm.find('.'+id+'sqbtn-add').hide();
			newEntry.find('.'+id+'sqbtn-add').show();



	}

	function RemoveRow(cr,id){

		    cr.parents('.'+id+'sqddata:first').remove();

			var numItems = $('.'+id+'SizeQuantity .'+id+'sqddata').length;

			var controlForm = $('.'+id+'SizeQuantity .'+id+'sqddata').last();

			if(numItems==1){

			controlForm.find('.'+id+'sqbtn-remove').hide();
			controlForm.find('.'+id+'sqbtn-add').show();
			}else{
			    controlForm.find('.'+id+'sqbtn-remove').show();
			    controlForm.find('.'+id+'sqbtn-add').show();
			}
			return false;



	}
	/*$(document).on('click', '.sqbtn-add', function(e){
			//alert('OK');
			e.preventDefault();
			var controlForm = $('.SizeQuantity:first'),
			currentEntry = $(this).parents('.sqddata:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);

			newEntry.find('input').val('');
			newEntry.find('textarea').val('');

			var timestamp = new Date().getUTCMilliseconds();
			newEntry.find('input').attr('id',timestamp);

			newEntry.find('.sqbtn-remove').show();
			controlForm.find('.sqbtn-remove').show();
			controlForm.find('.sqbtn-add').hide();
			newEntry.find('.sqbtn-add').show();

			//console.log(controlForm.find('.ddata:not(:last).dbtn-add'));
			//controlForm.find('.ddata:not(:last) .dbtn-add').removeClass('dbtn-add').addClass('dbtn-remove').removeClass('btn-success').addClass('btn-danger').html('<span class="fa fa-minus"></span>');




		}).on('click', '.sqbtn-remove', function(e)
		{
			$(this).parents('.sqddata:first').remove();
			e.preventDefault();

			var numItems = $('.SizeQuantity .sqddata').length;

			var controlForm = $('.SizeQuantity .sqddata').last();

			if(numItems==1){

			controlForm.find('.sqbtn-remove').hide();
			controlForm.find('.sqbtn-add').show();
			}else{
			    controlForm.find('.sqbtn-remove').show();
			    controlForm.find('.sqbtn-add').show();
			}
			return false;

	});*/


	$(document).on('click', '.tdtn-add', function(e){

			//alert('OK');
			e.preventDefault();
			var controlForm = $('.TempalteDiscription:first'),
			currentEntry = $(this).parents('.tmds:first'),
			newEntry = $(currentEntry.clone()).appendTo(controlForm);

			newEntry.find('input').val('');
			newEntry.find('textarea').val('');
            newEntry.find('.file_name').remove();

			var timestamp = new Date().getUTCMilliseconds();
			newEntry.find('input').attr('id',timestamp);

			newEntry.find('.tdtn-remove').show();
			controlForm.find('.tdtn-remove').show();
			controlForm.find('.tdtn-add').hide();
			newEntry.find('.tdtn-add').show();
			//console.log(controlForm.find('.tmds:not(:last).dbtn-add'));
			//controlForm.find('.tmds:not(:last) .tdtn-add').removeClass('tdtn-add').addClass('tdtn-remove').removeClass('btn-success').addClass('btn-danger').html('<span class="fa fa-minus"></span>');



		}).on('click', '.tdtn-remove', function(e)
		{
			$(this).parents('.tmds:first').remove();
			e.preventDefault();

			var numItems = $('.TempalteDiscription .tmds').length;

			var controlForm = $('.TempalteDiscription .tmds').last();

			if(numItems==1){

			controlForm.find('.tdtn-remove').hide();
			controlForm.find('.tdtn-add').show();
			}else{
			    controlForm.find('.tdtn-remove').show();
			    controlForm.find('.tdtn-add').show();
			}
			return false;
	});
	function isNumber(evt) {

        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }

	function addActiveClass(id){



		if($("#attribute_id_"+id).prop("checked") == true){


			$("#attribute_id_div_"+id).addClass('active');
		}else{

			$("#attribute_id_div_"+id).removeClass('active');
		}

	}

	function addActiveSizeClass(id){



		if($("#size_attribute_id_"+id).prop("checked") == true){


			$("#size_attribute_id_div_"+id).addClass('active');
		}else{

			$("#size_attribute_id_div_"+id).removeClass('active');
		}

	}

	    /*function readURL(input,id) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+id).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }*/

</script>
<script>
 CKEDITOR.replace('content', {
    height: 300,
    filebrowserUploadUrl: "upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;

</script>
