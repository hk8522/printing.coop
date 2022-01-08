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
		<div class="col-md-12 col-lg-12 col-xl-3" style="">
		    <label class="span2 " for="inputMame">Product Multiple Extra Attributes</label>
		</div>
        <div class="col-md-12 col-lg-12 col-xl-9">
           <div class="controls small-controls">
<?php
//pr($ProductSizes);
foreach($quantity as $qkey=>$qval){

	$ProductSizesByQTY=isset($ProductSizes[$qkey]) ? $ProductSizes[$qkey]:array();
	$qty_extra_price=isset($ProductSizesByQTY['price']) ? $ProductSizesByQTY['price']:'';
	$sizeData=isset($ProductSizesByQTY['sizeData']) ? $ProductSizesByQTY['sizeData']:'';
?>
<div class="attribute">
    <div class="attribute-title">
        <div class="row align-items-center">
            <div class="col-7 col-md-8">
                <label class="span2">
                    <input type="checkbox" value="<?php echo $qkey?>" name="quantity[]" id="quantity_attribute_id_<?php echo $qkey?>" <?php if(array_key_exists($qkey,$ProductSizes)) echo "checked"?> onchange="addActiveQuantitySizeClass('<?php echo $qkey?>')">
	                <?php echo $qval;?>
                </label>
            </div>
            <div class="col-5 col-md-4">
                <div class="attribute-inner">
                    <input type="text" value='<?php echo showValue($qty_extra_price);?>' name="quantity_extra_price[]?>"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" class="form-control">
                    <label class="form-inner-label">Extra Price</label>
 				</div>
   	        </div>
	    </div>
    </div>

	<div class="attribute" id="quantity_attribute_id_div_<?php echo $qkey?>" style="display:<?php echo array_key_exists($qkey,$ProductSizes) ? '' :'none'?>; padding: 10px 10px 10px 25px; background: #f5f5f5;">
        <?php foreach($sizes as $key=>$val){
            $items=isset($ProductSizes[$key]) ? $ProductSizes[$key]:array();
            $size_extra_price='';
            $size_extra_price=isset($items['extra_price']) ? $items['extra_price']:'';
          ?>

        <div class="attribute <?php if(array_key_exists($key,$ProductSizesByQTY)) echo "active"?>" id="size_attribute_id_div_<?php echo $qkey?>_<?php echo $key?>">
		    <!-- Toggle "active" class when clicked on input(checkbox) below -->
		    <div class="attribute-title">
	           <div class="row align-items-center">
	               <div class="col-7 col-md-8">
	                   <label class="span2">
	                       <input type="checkbox" value="<?php echo $key?>" name="size_attribute_id_<?php echo $qkey?>[]"  id="size_attribute_id_<?php echo $qkey?>_<?php echo $key?>"  <?php if(array_key_exists($key,$ProductSizesByQTY)) echo "checked"?> onchange="addActiveSizeClass('<?php echo $qkey?>_<?php echo $key?>')">
	                       <?php echo $val;?>
                        </label>
                    </div>
                    <div class="col-5 col-md-4">
                        <div class="attribute-inner">
                            <input type="text"  name="size_extra_price_<?php echo $qkey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" class="form-control" value="<?php echo showValue($size_extra_price)?>">
							<label class="form-inner-label">Extra Price</label>
                        </div>
                    </div>
                </div>
            </div>
		    <div class="for-att-multi attribute-row <?php echo $qkey.'_'.$key?>SizeQuantity">
                <?php
				/*$items=isset($ProductSizesByQTY[$key]) ? $ProductSizesByQTY[$key]:array();*/

    				if(!empty($items)){
                    $last=count($items)-1;
    		        foreach($items as $subkey=>$subval){ #pr($subval);
		        ?>
                <div class="row <?php echo $qkey.'_'.$key?>sqddata">
            		<div class="col-md-12">
            			<?php
							$displayplusnbtn='none';
						    $displayminusbtn='';
            				if($last==0){
        						$displayplusnbtn='';
        						$displayminusbtn='none';
        					}
                            else if($last==$subkey){
        				        $displayplusnbtn='';
            				    $displayminusbtn='';
            				}
                        ?>
                        <div class="attribute-info-inner">
                    	    <span class="input-group-btn">
                                <button class="btn btn-danger <?php echo $qkey.'_'.$key?>sqbtn-remove" type="button" style="display:<?php echo $displayminusbtn;?>" onclick="RemoveRow($(this),'<?php echo $qkey.'_'.$key?>')"><span class="fa fa-minus"></span></button>
                                <button class="btn btn-success <?php echo $qkey.'_'.$key?>sqbtn-add" type="button" onclick="AddRow($(this),'<?php echo $qkey.'_'.$key?>')" style="display:<?php echo $displayplusnbtn;?>"><span class="fa fa-plus"></span></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Paper Quality</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text"  name="paper_quality_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control" value='<?php echo showValue($subval['paper_quality_extra_price'])?>'>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
									    <select name="paper_quality_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
        									<option value="">--Select--</option>
        									<?php
            									foreach($PaperQualityList as $list){
            										$selected='';
            									    if($list['name']==$subval['paper_quality']){
            										$selected='selected="selected"';
    									        }
        									?>
        									<option value='<?php echo $list['name']?>' <?php  echo $selected?>><?php echo $list['name']?></option>
        									<?php }?>
    									</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">NCR Number of Parts</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text"  name="ncr_number_part_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" value='<?php echo showValue($subval['ncr_number_part_price'])?>'  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
                                        <select name="ncr_number_parts_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
        									<option value="">
        									--Select--
        									</option>
        									<?php
        									foreach($NCRNumberPartsList as $NCRPart){
                        							$selected='';
                        							if($subval['ncr_number_parts']==$NCRPart['name']){
        											$selected='selected="selected"';
        										}
        									?>
        									<option value='<?php echo $NCRPart['name']?>' <?php echo $selected?>><?php echo $NCRPart['name']?>
        									</option>
    									<?php }?>
    									</select>
                                    </div>
                                </div>
                            </div>
                        </div>
    				</div>
				<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Background</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value='<?php echo showValue($subval['stock_extra_price'])?>' name="stock_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
    									<select name="stock_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
        									<option value="">
        									 --Select--
        									</option>
        									<?php
        									foreach($StockList as $list){

        									   $selected='';
        									   if($list['name']==$subval['stock']){
        										$selected='selected="selected"';
        									   }
        									?>
        									<option value='<?php echo $list['name']?>'  <?php echo $selected?>><?php echo $list['name']?>
        									</option>
    									<?php }?>
    									</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Printed Color</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value='<?php echo showValue($subval['color_extra_price'])?>' name="color_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
    									<select name="color_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
        									<option value="">
        									 --Select--
        									</option>
        									<?php
        									foreach($ColorList as $list){

        										$selected='';
        									   if($list['name']==$subval['color']){
        										$selected='selected="selected"';
        									   }
        									?>
        									<option value='<?php echo $list['name']?>'  <?php echo $selected?>><?php echo $list['name']?></option>
        									<?php }?>
    									</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Diameter</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value='<?php echo showValue($subval['diameter_extra_price'])?>' name="diameter_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
    									<select name="diameter_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
        									<option value="">
        									 --Select--
        									</option>
        									<?php
        									foreach($DiameterList as $list){
        									   $selected='';
        									   if($list['name']==$subval['diameter']){
        										$selected='selected="selected"';
        									   }
        									?>
        									<option value='<?php echo $list['name']?>'  <?php echo $selected?>><?php echo $list['name']?>
        									</option>
        									<?php }?>
    									</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Coating</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value='<?php echo showValue($subval['shape_paper_extra_price'])?>' name="shape_paper_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
    									<select name="shape_paper_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
        									<option value="">
        									 --Select--
        									</option>
        									<?php
                        						foreach($ShapePaperList as $list){
                        								$selected='';
                        								if($list['name']== $subval['shape_paper']){
        										$selected='selected="selected"';
        									   }
        									?>
        									<option value='<?php echo $list['name']?>'  <?php echo $selected?>><?php echo $list['name']?>
        									</option>
        									<?php }?>
    									</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Grommets</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value='<?php echo showValue($subval['grommets_extra_price'])?>' name="grommets_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
    									<select name="grommets_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
        									<option value="">
        									 --Select--
        									</option>
        									<?php
                        						foreach($Grommets as $list){
                        								$selected='';
                        								if($list['name']== $subval['grommets']){
        										$selected='selected="selected"';
        									   }
        									?>
        									<option value='<?php echo $list['name']?>'  <?php echo $selected?>><?php echo $list['name']?>
        									</option>
        									<?php }?>
    									</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>


				</div>

        		<?php }
        		}else{?>

                <div class="row <?php echo $qkey.'_'.$key?>sqddata">
                    <div class="col-md-12">
            			<div class="attribute-info-inner">
                			<span class="input-group-btn">
                                <button class="btn btn-danger <?php echo $qkey.'_'.$key?>sqbtn-remove" type="button" style="display:none" onclick="RemoveRow($(this),'<?php echo $qkey.'_'.$key?>')"><span class="fa fa-minus"></span></button>
                                <button class="btn btn-success <?php echo $qkey.'_'.$key?>sqbtn-add" type="button" onclick="AddRow($(this),'<?php echo $qkey.'_'.$key?>')"><span class="fa fa-plus"></span></button>
                            </span>
	                    </div>
                    </div>
    				<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Paper Quality</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value="" name="paper_quality_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
									<select name="paper_quality_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
									<option value="">
									 --Select--
									</option>
									<?php
									foreach($PaperQualityList as $list){
									?>
									<option value='<?php echo $list['name']?>'><?php echo $list['name']?>
									</option>
									<?php }?>
									</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">NCR Number of Parts</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value="" name="ncr_number_part_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
                                        <select name="ncr_number_parts_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
										<option value="">
										--Select--
										</option>
										<?php
										foreach($NCRNumberPartsList as $NCRPart){
										?>
										<option value='<?php echo $NCRPart['name']?>'><?php echo $NCRPart['name']?>
										</option>
										<?php }?>
										</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Background</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value="" name="stock_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
										<select name="stock_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
										<option value="">
										 --Select--
										</option>
										<?php
										foreach($StockList as $list){
										?>
										<option value='<?php echo $list['name']?>'><?php echo $list['name']?>
										</option>
										<?php }?>
										</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Printed Color</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value="" name="color_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
										<select name="color_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
										<option value="">
										 --Select--
										</option>
										<?php
										foreach($ColorList as $list){
										?>
										<option value='<?php echo $list['name']?>'><?php echo $list['name']?>
										</option>
										<?php }?>
										</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Diameter</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value="" name="diameter_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
										<select name="diameter_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
										<option value="">
										 --Select--
										</option>
										<?php
										foreach($DiameterList as $list){
										?>
										<option value='<?php echo $list['name']?>'><?php echo $list['name']?>
										</option>
										<?php }?>
										</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Coating</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value="" name="shape_paper_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
										<select name="shape_paper_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
										<option value="">
										 --Select--
										</option>
										<?php
										foreach($ShapePaperList as $list){
										?>
										<option value='<?php echo $list['name']?>'><?php echo $list['name']?>
										</option>
										<?php }?>
										</select>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="attribute-info">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-6">
                                    <label class="form-inner-label">Grommets</label>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="attribute-info-inner">
                                        <input type="text" value="" name="grommets_extra_price_<?php echo $qkey?>_<?php echo $key?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="attribute-info-inner">
										<select name="grommets_<?php echo $qkey?>_<?php echo $key?>[]" class="form-control">
										<option value="">
										 --Select--
										</option>
										<?php
										foreach($Grommets as $list){
										?>
										<option value='<?php echo $list['name']?>'><?php echo $list['name']?>
										</option>
										<?php }?>
										</select>
                                    </div>
                                </div>
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

    function bntInActive(id){
    $("#"+id).attr("disabled", true);
    }
</script>
<script>

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



		if($("#quantity_attribute_id_"+id).prop("checked") == true){


			$("#quantity_attribute_id_div_"+id).show();

		}else{

			$("#quantity_attribute_id_div_"+id).hide();
		}

	}
</script>
