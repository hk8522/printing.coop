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
.control-group .attribute-inner input[type="checkbox"], .control-group .attribute-info-inner input[type="checkbox"] {
    width: auto;
    height: auto !important;
}
.control-group .controls.small-controls .attribute-info-inner label.span2 {
    margin: 0px !important;
    display: flex;
    justify-content: flex-end;
    width: 100%;
    height: auto !important;
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
                                    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));
									?>
                                    <input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>" id="product_id">
                                    <div class="form-role-area">

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
                                                    <label class="span2 " for="inputMame"> French Product Name </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
      <input class="form-control" name="name_french" id="name_french" type="text" placeholder="French Product Name" value="<?php echo isset($postData['name_french']) ? $postData['name_french']:'';?>" required>
        <?php echo form_error('name_french');?>
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
                                                        <!---<input class="form-control" name="short_description" id="short_description" type="text" placeholder="short description" value="<?php echo isset($postData['short_description']) ? $postData['short_description']:'';?>">
                                                        <?php echo form_error('short_description');?>-->
														 <textarea class="form-control" name="short_description"><?php echo isset($postData['short_description'])? $postData['short_description']:'';?></textarea>
                                                        <?php echo form_error('short_description');?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                              <label class="span2" for="inputMame">French Product Short Description</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <!--<input class="form-control" name="short_description_french" id="short_description_french" type="text" placeholder="French short description" value="<?php echo isset($postData['short_description_french']) ? $postData['short_description_french']:'';?>">
                                                        <?php echo form_error('short_description_french');?>-->

														 <textarea class="form-control" name="short_description_french"><?php echo isset($postData['short_description_french'])? $postData['short_description_french']:'';?></textarea>
                                                        <?php echo form_error('short_description_french');?>
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
                                                    <label class="span2 " for="inputMame">French Product Full Description</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
  <textarea class="form-control" name="full_description_french" id="content1" maxlength="100"><?php echo isset($postData['full_description_french'])? $postData['full_description_french']:'';?></textarea>
     <?php echo form_error('full_description_french');?>
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
                                            $DescriptionsIds=1;
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
                                                <label>Description Title</label>
                                                    <input type="text" class="form-control" placeholder="Description Title" name="title[]" value="<?php echo $val['title'];?>">

													<label>French Description Title</label>

													<input type="text" class="form-control" placeholder="Title french" name="title_french[]" value="<?php echo $val['title_french'];?>">


													<label>Description </label>

                                                    <textarea class="form-control Discription ckeditor" name="description[]" placeholder="Full Description" id="editor<?php echo $DescriptionsIds?>"><?php echo $val['description'];?></textarea>
													<label>French Description </label>
													<textarea class="form-control DiscriptionF ckeditor" name="description_french[]" placeholder="Description French" id="editorf<?php echo $DescriptionsIds?>"><?php echo $val['description_french'];?></textarea>
                                                </div>
                                            </div>

                                        <?php
										    $DescriptionsIds++;

										}
                                        }else{?>
                                        <div class="controls description-class ddata">
                                        <div class="discription-single">
                                        <div class="add-new-btn">

											<button class="btn-danger dbtn-remove" type="button" style="display:none"><i class="fa fa-minus"></i></button>

											<button class="btn-success dbtn-add" type="button"><i class="fa fa-plus"></i>
											</button>

                                        </div>
                                        <label>Description Title</label>
                                        <input type="text" class="form-control" placeholder="Description Title" name="title[]">
										<label>French Description Title</label>

										<input type="text" class="form-control" placeholder="Title french" name="title_french[]">
										<label>Description </label>
                                        <textarea class="form-control Discription ckeditor" name="description[]" placeholder="Full Description" id="editor">
										</textarea>
										<label>French Description </label>
									   <textarea class="form-control ckeditor DiscriptionF" name="description_french[]" placeholder="Description French" id="editorf"></textarea>


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

                                                    <label>Final Dimensions</label>
                                                    <input type="text" class="form-control" placeholder="Final Dimensions" name="final_dimensions[]" value='<?php echo $val['final_dimensions'];?>'>

													<label>French Final Dimensions</label>
                                                    <input type="text" class="form-control" placeholder="Final Dimensions French" name="final_dimensions_french[]" value='<?php echo $val['final_dimensions_french'];?>'>

													<label>Template Description</label>
                                                    <textarea class="form-control" name="template_description[]" placeholder="Template Description" ><?php echo $val['template_description'];?></textarea>

													<label>French Template Description</label>
                                                    <textarea class="form-control" name="template_description_french[]" placeholder="French Template Description" ><?php echo $val['template_description_french'];?></textarea>

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
                                        <label>Final Dimensions</label>
                                        <input type="text" class="form-control" placeholder="Final Dimensions" name="final_dimensions[]" >

										<label>French Final Dimensions</label>
                                        <input type="text" class="form-control" placeholder="Final Dimensions French" name="final_dimensions_french[]">
                                        <label>Template Description</label>
										<textarea class="form-control" name="template_description[]" placeholder="Template Description"></textarea>
										<label>French Template Description</label>
                                                    <textarea class="form-control" name="template_description_french[]" placeholder="French Template Description" ></textarea>

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

                                                            <div class="col-md-6">
                                                                <input class="form-control" name="price" id="price" type="text" placeholder="List Price CAD" value="<?php echo isset($postData['price']) ? showValue($postData['price']):'';?>" required>
                                                                <label class="form-inner-label">List Price CAD</label>
                                                                <?php echo form_error('price');?>
                                                            </div>

															<!--<div class="col-md-3">
                                                                <input class="form-control" name="price_euro" id="price_euro" type="text" placeholder="List Price EURO" value="<?php echo isset($postData['price_euro']) ? showValue($postData['price_euro']):'';?>">
                                                                <label class="form-inner-label">List Price EURO</label>
                                                                <?php echo form_error('price_euro');?>
                                                            </div>

															 <div class="col-md-3">
                                                                <input class="form-control" name="price_gbp" id="price_gbp" type="text" placeholder="Product Price" value="<?php echo isset($postData['price_gbp']) ? showValue($postData['price_gbp']):'';?>">
                                                                <label class="form-inner-label">List Price GBP</label>
                                                                <?php echo form_error('price_gbp');?>
                                                            </div>
															 <div class="col-md-3">
                                                                <input class="form-control" name="price_usd" id="price_usd" type="text" placeholder="Product Price" value="<?php echo isset($postData['price_usd']) ? showValue($postData['price_usd']):'';?>">
                                                                <label class="form-inner-label">List Price USD</label>
                                                                <?php echo form_error('price_usd');?>
                                                            </div>-->



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
														    <div class="col-md-6">
                                                                <input class="form-control" name="code" id="code" type="text" placeholder="Product Code" value="<?php echo isset($postData['code']) ? $postData['code']:'';?>">
                                                                <label class="form-inner-label">Code</label>
                                                                <?php echo form_error('code');?>
                                                            </div>
															 <div class="col-md-6">
                                                                <input class="form-control" name="code_french" id="code_french" type="text" placeholder="Product Code" value="<?php echo isset($postData['code_french']) ? $postData['code_french']:'';?>">
                                                                <label class="form-inner-label">French Code</label>
                                                                <?php echo form_error('code_french');?>
                                                            </div>





															<div class="col-md-6">
                                                                <input class="form-control" name="model" id="model" type="text" placeholder="Product Model" value="<?php echo isset($postData['model']) ? $postData['model']:'';?>">
                                                                <label class="form-inner-label">Models</label>
                                                                <?php echo form_error('model');?>
                                                            </div>
															<div class="col-md-6">
                                                                <input class="form-control" name="model_french" id="model_french" type="text" placeholder="Product model french" value="<?php echo isset($postData['model_french']) ? $postData['model_french']:'';?>">
                                                                <label class="form-inner-label">French Models</label>
                                                                <?php echo form_error('model_french');?>
                                                            </div>

															<div class="col-md-6">
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
                                                    <label class="span2 " for="inputMame">Your TEXT - Votre TEXT</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">

                                        <div class="row">


                                            <div class="col-md-12">
                                                  <?php

																																		$cehecked='';
        if ($postData['votre_text']==1) {

		   $cehecked='checked';
        }
        ?>                                                        <label class="span2"><input name="votre_text" type="checkbox" value="1" <?php echo $cehecked;?>> Add
		</label>
        <?php echo form_error('votre_text');?>
        </div>






                   </div>


                    </div>
                </div>
            </div>
        </div>
		<div class="control-group info">
		<div class="row">
                                    <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Recto/Verso</label>
                                    </div>
                             <div class="col-md-9">
                                 <div class="controls small-controls">

                                        <div class="row">


                                            <div class="col-md-12">
                                                  <?php

																														$cehecked='';
        if ($postData['recto_verso']==1) {

		   $cehecked='checked';
        }
        ?>                                                        <label class="span2"><input name="recto_verso" type="checkbox" value="1" <?php echo $cehecked;?> onchange="RectoVersoSection(recto_verso)" id="recto_verso"> Add
		</label>
        <?php echo form_error('votre_text');?>
        </div>
                   </div>

				    </div>
                		<div class="attribute-row field-area" style="display:<?php echo $cehecked=='checked' ? '':'none';?>" id="RectoVersoSection">
                	       <div class="row">
                				<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label"> Recto/Verso Percentage </label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['recto_verso_price'])?>" name="recto_verso_price" onkeypress="javascript:return isNumber(event)" placeholder="Percentage"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        		</div>

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
        ?>                                                 <label class="span2"><input name="add_length_width" type="checkbox" value="1" <?php echo $cehecked;?> onchange="showWidthAndLength(add_length_width)" id="add_length_width"> Add
		</label>
        <?php echo form_error('add_length_width');?>
        </div>






                                                        </div>
                		<div class="attribute-row field-area" style="display:<?php echo $cehecked=='checked' ? '':'none';?>" id="WidthAndLengthSection">
                	       <div class="row">
                				<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Length</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['min_length'])?>" name="min_length" onkeypress="javascript:return isNumber(event)" placeholder="Minimum"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                                <div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Length</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['max_length'])?>" name="max_length" onkeypress="javascript:return isNumber(event)" placeholder="Maximum"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                				<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Width</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['min_width'])?>" name="min_width" onkeypress="javascript:return isNumber(event)" placeholder="Minimum"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Width</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['max_width'])?>" name="max_width" onkeypress="javascript:return isNumber(event)" placeholder="Maximum"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                				<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Length X Width Price</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['min_length_min_width_price'])?>" name="min_length_min_width_price" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Unit Price Color</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['length_width_price_color'])?>" name="length_width_price_color" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Unit Price Black</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['length_width_unit_price_black'])?>" name="length_width_unit_price_black" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php
								$id=isset($postData['id']) ? $postData['id']:'';
								$cehecked='';
								if ($postData['length_width_color_show']==1){
									$cehecked='checked';
								}
                                ?>
								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Show Colors</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
												<input name="length_width_color_show" type="checkbox" value="1" <?php echo $cehecked;?> id="length_width_color_show">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

				<select  class="form-control" name="length_width_pages_type">

			<option value="input" <?php echo $postData['length_width_pages_type']=='input' ? 'selected':''?>>
					Input
			</option>
			<!--<option value="dropdown" <?php echo $postData['length_width_pages_type']=='dropdown' ? 'selected':''?>>
					Dropdown
			</option>-->



											</select>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Quantity Show</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

		<?php
        $id=isset($postData['id']) ? $postData['id']:'';
		$cehecked='';
        if ($postData['length_width_quantity_show']==1){

		$cehecked='checked';
        }else if(empty($id)){

			$cehecked='checked';
		}
        ?>                                                 <label class="span2"><input name="length_width_quantity_show" type="checkbox" value="1" <?php echo $cehecked;?> id="length_width_quantity_show">
		</label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['length_width_min_quantity'])?>" name="length_width_min_quantity" onkeypress="javascript:return isNumber(event)" placeholder="Minimum Quantity"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['length_width_max_quantity'])?>" name="length_width_max_quantity" onkeypress="javascript:return isNumber(event)" placeholder="Maximum Quantity"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Page Size Length And Width</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">

                                        <div class="row">


                                            <div class="col-md-12">
                                                  <?php

																														$cehecked='';
        if ($postData['page_add_length_width']==1) {

		   $cehecked='checked';
        }
        ?>                                                         <label class="span2"><input name="page_add_length_width" type="checkbox" value="1" <?php echo $cehecked;?> onchange="pageShowWidthAndLength(page_add_length_width)" id="page_add_length_width"> Add
		</label>
        <?php echo form_error('page_add_length_width');?>
        </div>

				                                                 </div>
                		<div class="attribute-row field-area" style="display:<?php echo $cehecked=='checked' ? '':'none';?>" id="PageWidthAndLengthSection">
                	       <div class="row">
                				<div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Length</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_min_length'])?>" name="page_min_length" onkeypress="javascript:return isNumber(event)" placeholder="Minimum"  class="form-control PageLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Length</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_max_length'])?>" name="page_max_length" onkeypress="javascript:return isNumber(event)" placeholder="Maximum"  class="form-control PageLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Width</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_min_width'])?>" name="page_min_width" onkeypress="javascript:return isNumber(event)" placeholder="Minimum"  class="form-control PageLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Width</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_max_width'])?>" name="page_max_width" onkeypress="javascript:return isNumber(event)" placeholder="Maximum"  class="form-control PageLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Length X Width Price</label>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_min_length_min_width_price'])?>" name="page_min_length_min_width_price" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control PageLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Unit Price Color</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_length_width_price_color'])?>" name="page_length_width_price_color" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Unit Price Black</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_length_width_price_black'])?>" name="page_length_width_price_black" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php
								$cehecked='';
								if ($postData['page_length_width_color_show']==1){
									$cehecked='checked';
								}
                                ?>
								<div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Show Colors</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
												<input name="page_length_width_color_show" type="checkbox" value="1" <?php echo $cehecked;?> id="page_length_width_color_show">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Pages Type</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

				<select  class="form-control" name="page_length_width_pages_type">

			<!--<option value="dropdown" <?php echo $postData['page_length_width_pages_type']=='dropdown' ? 'selected':''?>>
											  Dropdown
											</option>-->

		<option value="input" <?php echo $postData['page_length_width_pages_type']=='input' ? 'selected':''?>>
											  Input
											</option>

											</select>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Pages Show</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

		<?php
        $id=isset($postData['id']) ? $postData['id']:'';
		$cehecked='';
        if ($postData['page_length_width_pages_show']==1){

		   $cehecked='checked';
        }else if(empty($id)){

			$cehecked='checked';
		}
        ?>                                                 <label class="span2">
		<input name="page_length_width_pages_show" type="checkbox" value="1" <?php echo $cehecked;?> id="page_length_width_pages_show">
		</label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Sheets Type</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

				<select  class="form-control" name="page_length_width_sheets_type">

			<option value="dropdown" <?php echo $postData['page_length_width_sheets_type']=='dropdown' ? 'selected':''?>>
											  Dropdown
											</option>
		<option value="input" <?php echo $postData['page_length_width_sheets_type']=='input' ? 'selected':''?>>
											  Input
											</option>

											</select>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Sheets Show</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

		<?php
        $id=isset($postData['id']) ? $postData['id']:'';
		$cehecked='';
        if ($postData['page_length_width_sheets_show']==1){

		   $cehecked='checked';
        }
        ?>                                                 <label class="span2">
		<input name="page_length_width_sheets_show" type="checkbox" value="1" <?php echo $cehecked;?> id="page_length_width_sheets_show">
		</label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

				<select  class="form-control" name="page_length_width_quantity_type">

			<option value="input" <?php echo $postData['page_length_width_quantity_type']=='input' ? 'selected':''?>>
					Input
			</option>
			<option value="dropdown" <?php echo $postData['page_length_width_quantity_type']=='dropdown' ? 'selected':''?>>
					Dropdown
			</option>



											</select>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

		                         <div class="col-md-6">


                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Quantity Show</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

		<?php
        $id=isset($postData['id']) ? $postData['id']:'';
		$cehecked='';
        if ($postData['page_length_width_quantity_show']==1){

		$cehecked='checked';
        }else if(empty($id)){

			$cehecked='checked';
		}
        ?>                                                 <label class="span2"><input name="page_length_width_quantity_show" type="checkbox" value="1" <?php echo $cehecked;?> id="page_length_width_quantity_show">
		</label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_length_width_min_quantity'])?>" name="page_length_width_min_quantity" onkeypress="javascript:return isNumber(event)" placeholder="Minimum Quantity"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['page_length_width_max_quantity'])?>" name="page_length_width_max_quantity" onkeypress="javascript:return isNumber(event)" placeholder="Maximum Quantity"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Add Length X Width X Depth</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">

                                        <div class="row">


                                            <div class="col-md-12">
                                                  <?php

																														      $cehecked='';
        if ($postData['depth_add_length_width']==1) {

		   $cehecked='checked';
        }
        ?>                                                 <label class="span2"><input name="depth_add_length_width" type="checkbox" value="1" <?php echo $cehecked;?> onchange="showDepthWidthAndLength(depth_add_length_width)" id="depth_add_length_width"> Add
		</label>
        <?php echo form_error('depth_add_length_width');?>
        </div>






                                                        </div>
                		<div class="attribute-row field-area" style="display:<?php echo $cehecked=='checked' ? '':'none';?>" id="DepthWidthAndLengthSection">
                	       <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Length</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_min_length'])?>" name="depth_min_length" onkeypress="javascript:return isNumber(event)" placeholder="Minimum Length"  class="form-control DepthLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Length</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_max_length'])?>" name="depth_max_length" onkeypress="javascript:return isNumber(event)" placeholder="Maximum"  class="form-control DepthLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Width</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_min_width'])?>" name="depth_min_width" onkeypress="javascript:return isNumber(event)" placeholder="Minimum"  class="form-control DepthLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Width</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_max_width'])?>" name="depth_max_width" onkeypress="javascript:return isNumber(event)" placeholder="Maximum"  class="form-control DepthLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Depth</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['min_depth'])?>" name="min_depth" onkeypress="javascript:return isNumber(event)" placeholder="Minimum"  class="form-control DepthLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Depth</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['max_depth'])?>" name="max_depth" onkeypress="javascript:return isNumber(event)" placeholder="Maximum"  class="form-control DepthLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Length X Width X Depth Price</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_width_length_price'])?>" name="depth_width_length_price" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control DepthLengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6 col-lg-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Unit Price Color</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_price_color'])?>" name="depth_price_color" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6 col-md-6 col-lg-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Unit Price Black</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_unit_price_black'])?>" name="depth_unit_price_black" onkeypress="javascript:return isNumber(event)" placeholder="Price"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                <?php
								$cehecked='';
								if ($postData['depth_color_show']==1){
									$cehecked='checked';
								}
                                ?>
								<div class="col-md-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Show Colors</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
												<input name="depth_color_show" type="checkbox" value="1" <?php echo $cehecked;?> id="depth_color_show">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

				<select  class="form-control" name="depth_width_length_type">

			 <option value="input" <?php echo $postData['depth_width_length_type']=='input' ? 'selected':''?>>
				    Input
			</option>
			<!--<option value="dropdown" <?php echo $postData['depth_width_length_type']=='dropdown' ? 'selected':''?>>
					Dropdown
			</option>-->



											</select>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Quantity Show</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">

		<?php
        $id=isset($postData['id']) ? $postData['id']:'';
		$cehecked='';
        if ($postData['depth_width_length_quantity_show']==1){

		$cehecked='checked';
        }else if(empty($id)){

			$cehecked='checked';
		}
        ?>                                                 <label class="span2"><input name="depth_width_length_quantity_show" type="checkbox" value="1" <?php echo $cehecked;?> id="depth_width_length_quantity_show">
		</label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Minimum Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_min_quantity'])?>" name="depth_min_quantity" onkeypress="javascript:return isNumber(event)" placeholder="Minimum Quantity"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Maximum Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['depth_max_quantity'])?>" name="depth_max_quantity" onkeypress="javascript:return isNumber(event)" placeholder="Maximum Quantity"  class="form-control LengthWidth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Call</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">

                                        <div class="row">


                                            <div class="col-md-12">
                                                  <?php

																														$cehecked='';
        if ($postData['call']==1) {

		   $cehecked='checked';
        }
        ?>                                                     <label class="span2"><input name="call" type="checkbox" value="1" <?php echo $cehecked;?> onchange="pageShowCall(product_call)" id="product_call"> Add
		</label>
        <?php echo form_error('call');?>
        </div>

				                                                 </div>
                		<div class="attribute-row field-area" style="display:<?php echo $cehecked=='checked' ? '':'none';?>" id="PagePhoneSection">
                	       <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Phone Number</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo isset($postData['phone_number']) ? $postData['phone_number']:'1-877-384-8043';?>" name="phone_number" maxlength="15" style="width:100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="span2 " for="inputMame">Shipping Box Size</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls small-controls">

                                        <div class="row">
                         </div>
                		<div class="attribute-row field-area">
                	       <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Box Length (Inch)</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['shipping_box_length'])?>" name="shipping_box_length" onkeypress="javascript:return isNumber(event)" placeholder="Length"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Box Width (Inch)</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['shipping_box_width'])?>" name="shipping_box_width" onkeypress="javascript:return isNumber(event)" placeholder="Width"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Box Height (Inch)</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['shipping_box_height'])?>" name="shipping_box_height" onkeypress="javascript:return isNumber(event)" placeholder="Height"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="attribute-info">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-inner-label">Box Weight (LB)</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="attribute-info-inner">
                                                    <input type="text" value="<?php echo showValue($postData['shipping_box_weight'])?>" name="shipping_box_weight" onkeypress="javascript:return isNumber(event)" placeholder="Weight"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    <input type="checkbox" value="<?php echo $category_id?>" name="category_id_<?php echo $category_id?>" id="category_id_<?php echo $category_id?>" <?php if(array_key_exists($category_id,$ProductCategory)) echo "checked"?> onchange="addActiveCategory('<?php echo $category_id?>')" class="Category-Ids">
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

		var numItems = $('.file-data .entry').length;


		if(numItems==1){

			//$(this).parents('.entry:first').remove();
			//e.preventDefault();

			var controlForm = $('.file-data .entry').last();
			controlForm.find('input').val('');
			controlForm.find('img').attr('src',default_url_image);
			controlForm.find('.btn-remove').hide();
			controlForm.find('.btn-add').show();



		}else{
				$(this).parents('.entry:first').remove();
			    e.preventDefault();
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
    type: 'POST',
    dataType: 'html',
    //url: '<?php echo $BASE_URL ?>admin/Ajax/removeProductImage/'+product_id+'/'+id+'/'+image_name,
	url: '<?php echo $BASE_URL ?>admin/Ajax/removeProductImage/',
    data:{'product_id':product_id,'id':id,'image_name':image_name},
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
       //var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|jpge|.png|.gif)$");
	   //alert(fileUpload.value.toLowerCase());
       //if (regex.test(fileUpload.value.toLowerCase())) {
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
       //}
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

			var timestamp = new Date().getUTCMilliseconds();
			newEntry.find('input').attr('id',timestamp);
			newEntry.find('.Discription').attr('id',"editor"+timestamp);
			newEntry.find('.DiscriptionF').attr('id',"editorf"+timestamp);
			newEntry.find('.cke_reset').remove();
			newEntry.find('input').attr('id',timestamp);

			CKEDITOR.replace("editor"+timestamp,{
			height: 300,
			filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
			allowedContent:true,
			extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
		    });
		    CKEDITOR.dtd.$removeEmpty.i = 0;

			CKEDITOR.replace("editorf"+timestamp,{
			height: 300,
			filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
			allowedContent:true,
			extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
		    });
		    CKEDITOR.dtd.$removeEmpty.i = 0;

			newEntry.find('.dbtn-remove').show();
			controlForm.find('.dbtn-remove').show();
			controlForm.find('.dbtn-add').hide();
			newEntry.find('.dbtn-add').show();





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
			newEntry.find('select').val('');

			var timestamp = new Date().getUTCMilliseconds();
			newEntry.find('input').attr('id',timestamp);

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

	function showWidthAndLength(id){

		if($(id).prop("checked") == true){


			$("#WidthAndLengthSection").show();
			//$(".LengthWidth").attr("required", true);
		}else{
			//$(".LengthWidth").attr("required", false);
			$("#WidthAndLengthSection").hide();
		}

	}
	function showDepthWidthAndLength(id){

		if($(id).prop("checked") == true){


			$("#DepthWidthAndLengthSection").show();
			//$(".LengthWidth").attr("required", true);
		}else{
			//$(".LengthWidth").attr("required", false);
			$("#DepthWidthAndLengthSection").hide();
		}

	}

	function pageShowWidthAndLength(id){

		if($(id).prop("checked") == true){


			$("#PageWidthAndLengthSection").show();
			//$(".PageLengthWidth").attr("required", true);
		}else{

			//$(".PageLengthWidth").attr("required", false);
			$("#PageWidthAndLengthSection").hide();
		}

	}
	function pageShowCall(id){

		if($(id).prop("checked") == true){
			$("#PagePhoneSection").show();

		}else{
			$("#PagePhoneSection").hide();
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

	function RectoVersoSection(id){

		if($(id).prop("checked") == true){


			$("#RectoVersoSection").show();

		}else{
			$("#RectoVersoSection").hide();
		}

	}

	function addActiveCategory(id){
		if($("#category_id_"+id).prop("checked") == true){
			$("#quantity_attribute_id_div_"+id).show();
		}else{
			$("#quantity_attribute_id_div_"+id).hide();
		}

	}
	$("form.form-horizontal").submit(function(e) {

		var numberOfChecked = $('.Category-Ids:checked').length;
		if(numberOfChecked==0){
			alert('Please selected at least one product category');
			return false;
		}
    });
</script>
<script>
 CKEDITOR.replace('content', {
    height: 300,
    filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;

 CKEDITOR.replace('content1', {
    height: 300,
    filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;

 <?php
    for($i=1; $i<=$DescriptionsIds; $i++){
 ?>
 CKEDITOR.replace('editor<?php echo $i;?>', {
    height: 300,
    filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;

 CKEDITOR.replace('editorf<?php echo $i;?>', {
    height: 300,
    filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;

<?php
}?>
CKEDITOR.replace('editor', {
    height: 300,
    filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;
 CKEDITOR.replace('editorf', {
    height: 300,
    filebrowserUploadUrl: "<?php echo $BASE_URL;?>upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;
</script>
