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
<div class="content-wrapper dd" style="min-height: 687px;">
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
                                        <?php echo $this->session->flashdata('message_error');
                                        $product_id=$postData['id'];
                                        ?>
                                    </div>
                                    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                   <input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>" id="product_id">
 <div class="form-role-area">
<div class="control-group info">
    <div class="row">
        <!--<div class="col-md-12 col-lg-12 col-xl-12" style="">
            <label class="span2 " for="inputMame">Product Multiple Extra Attributes</label>
        </div>-->
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="controls small-controls">
            <div class="attribute-info-inner">
                <div class="all-vol-btn">
                    <button type="button" onclick="addQuantity('')"><i class="fa fa-plus"></i> Add Quantity</button>
                </div>
            </div>

<?php
    foreach($ProductSizes as $key=>$val){
        //pr($ProductSizes,1);

        $sizeData=isset($val['sizeData']) ? $val['sizeData']:'';

?>
<div class="attribute">
    <div class="attribute-title">
        <div class="row align-items-center">
            <div class="col-6 col-md-6">
                <label class="span2">
                    <?php //pr($quantity);?>
                    <input type="checkbox" value="<?php echo $key?>" name="quantity[]" id="quantity_attribute_id_<?php echo $key?>"  onchange="addActiveQuantitySizeClass('<?php echo $key?>')" checked>
                    <?php echo $val['qty_name'];?>
                </label>
            </div>
            <div class="col-3 col-md-4">
                <div class="attribute-inner">
                    <input type="text" value='<?php echo showValue($val['price']);?>' name="quantity_extra_price[]?>"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" class="form-control" readonly>
                    <label class="form-inner-label">Extra Price</label>
                 </div>
               </div>
            <div class="col-3 col-md-2">
                <div class="attribute-inner action-btns">
                     <button class="btn btn-success" type="button" onclick="addQuantity('<?php echo $key;?>')"><i class="far fa-edit fa-lg"></i></button>&nbsp;
                    <button class="btn btn-danger" type="button" onclick="deleteQuantity('<?php echo $key;?>')"><i class="fa fa-trash fa-lg"></i></button>
                 </div>
               </div>
        </div>
    </div>
    <?php
    ?>
    <div class="attribute" id="quantity_attribute_id_div_<?php echo $key?>" style="display:; padding: 10px 10px 10px 25px; background: #f5f5f5;">
           <div class="controls small-controls">
            <div class="attribute-info-inner">
                <div class="cus-inner-btn">
                    <button type="button" onclick="addSize('<?php echo $key;?>','')">Add Size</button>
                </div>
            </div>

            <?php
            if(!empty($sizeData)){
            foreach($sizeData as $skey=>$sval){
                $size_extra_price='';
                $size_extra_price=isset($sval['extra_price']) ? $sval['extra_price']:'';
              ?>

            <div class="attribute active" id="size_attribute_id_div_<?php echo $key?>_<?php echo $skey?>">
                <div class="attribute-title">
                   <div class="row align-items-center">
                       <div class="col-6 col-md-6">
                           <label class="span2">
                               <input type="checkbox" value="<?php echo $skey?>" name="size_attribute_id_<?php echo $key?>[]"  id="size_attribute_id_<?php echo $key?>_<?php echo $skey?>" onchange="addActiveSizeClass('<?php echo $key?>_<?php echo $skey?>')" checked>
                               <?php echo $sval['size_name'];?>
                            </label>
                        </div>
                        <div class="col-3 col-md-4">
                            <div class="attribute-inner">
                                <input type="text"  name="size_extra_price_<?php echo $skey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" class="form-control" value="<?php echo showValue($size_extra_price)?>" readonly>
                                <label class="form-inner-label">Extra Price</label>
                            </div>
                        </div>
                        <div class="col-3 col-md-2">
                            <div class="attribute-inner action-btns">
                                 <button class="btn btn-success" type="button" onclick="addSize('<?php echo $key;?>','<?php echo $skey;?>')"><i class="far fa-edit fa-lg"></i></button>&nbsp;
                                <button class="btn btn-danger" type="button" onclick="deleteProductSize('<?php echo $key;?>','<?php echo $skey;?>')"><i class="fa fa-trash fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $items=isset($sval['attribute']) ? $sval['attribute']:array();
                    $action= count($items) > 0 ? 'Edit':'Add';
                ?>
                <div class="for-att-multi attribute-row <?php echo $key.'_'.$skey?>">
                    <div class="controls small-controls">
                        <div class="attribute-info-inner">
                            <div class="cus-inner-btn">
                                <button type="button" onclick="addAttribute('<?php echo $key;?>','<?php echo $skey;?>','<?php echo $action?>')"><?php echo $action;?> Size Attribute</button>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(!empty($items)){
                        foreach($items as $subkey=>$subval){
                        //pr($subval);
                    ?>
                    <div class="row <?php echo $key.'_'.$skey?>">
                        <?php
                        if($subval['paper_quality']){
                        ?>
                        <div class="col-md-6">
                            <div class="attribute-info">
                                <div class="row align-items-center">
                                    <div class="col-8 col-md-6">
                                        <label class="form-inner-label">Paper Quality</label>
                                    </div>
                                    <div class="col-4 col-md-6">
                                        <div class="attribute-info-inner">
                                            <input type="text"  name="paper_quality_extra_price_<?php echo $key?>_<?php echo $skey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control" value='<?php echo showValue($subval['paper_quality_extra_price'])?>' readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="attribute-info-inner">
                                           <label>
                                           <?php
                                           echo $subval['paper_quality'];
                                           ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }?>
                        <?php
                        if($subval['ncr_number_parts']){
                        ?>
                        <div class="col-md-6">
                            <div class="attribute-info">
                                <div class="row align-items-center">
                                    <div class="col-8 col-md-6">
                                        <label class="form-inner-label">NCR Number of Parts</label>
                                    </div>
                                    <div class="col-4 col-md-6">
                                        <div class="attribute-info-inner">
                                            <input type="text"  name="ncr_number_part_price_<?php echo $key?>_<?php echo $skey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" value='<?php echo showValue($subval['ncr_number_part_price'])?>'  class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="attribute-info-inner">
                                           <label>
                                           <?php
                                           echo $subval['ncr_number_parts'];
                                           ?>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }?>
                        <?php
                        if($subval['stock']){
                        ?>
                        <div class="col-md-6">
                            <div class="attribute-info">
                                <div class="row align-items-center">
                                    <div class="col-8 col-md-6">
                                        <label class="form-inner-label">Background</label>
                                    </div>
                                    <div class="col-4 col-md-6">
                                        <div class="attribute-info-inner">
                                        <input type="text" value='<?php echo showValue($subval['stock_extra_price'])?>' name="stock_extra_price_<?php echo $key?>_<?php echo $skey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="attribute-info-inner">
                                           <label>
                                           <?php
                                           echo $subval['stock'];
                                           ?>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }?>
                        <?php
                        if($subval['color']){
                        ?>
                        <div class="col-md-6">
                            <div class="attribute-info">
                                <div class="row align-items-center">
                                    <div class="col-8 col-md-6">
                                        <label class="form-inner-label">Printed Color</label>
                                    </div>
                                    <div class="col-4 col-md-6">
                                        <div class="attribute-info-inner">
                                            <input type="text" value='<?php echo showValue($subval['color_extra_price'])?>' name="color_extra_price_<?php echo $key?>_<?php echo $skey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="attribute-info-inner">
                                            <label>
                                           <?php
                                           echo $subval['color'];
                                           ?>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }?>
                        <?php
                        if($subval['diameter']){
                        ?>
                        <div class="col-md-6">
                            <div class="attribute-info">
                                <div class="row align-items-center">
                                    <div class="col-8 col-md-6">
                                        <label class="form-inner-label">Diameter</label>
                                    </div>
                                    <div class="col-4 col-md-6">
                                        <div class="attribute-info-inner">
                                            <input type="text" value='<?php echo showValue($subval['diameter_extra_price'])?>' name="diameter_extra_price_<?php echo $key?>_<?php echo $skey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="attribute-info-inner">
                                           <label>
                                           <?php
                                           echo $subval['diameter'];
                                           ?>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }?>
                        <?php
                        if($subval['shape_paper']){
                        ?>
                        <div class="col-md-6">
                            <div class="attribute-info">
                                <div class="row align-items-center">
                                    <div class="col-8 col-md-6">
                                        <label class="form-inner-label">Coating</label>
                                    </div>
                                    <div class="col-4 col-md-6">
                                        <div class="attribute-info-inner">
                                            <input type="text" value='<?php echo showValue($subval['shape_paper_extra_price'])?>' name="shape_paper_extra_price_<?php echo $key?>_<?php echo $skey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="attribute-info-inner">
                                           <label>
                                           <?php
                                           echo $subval['shape_paper'];
                                           ?>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }?>
                        <?php
                        if($subval['grommets']){
                        ?>
                        <div class="col-md-6">
                            <div class="attribute-info">
                                <div class="row align-items-center">
                                    <div class="col-8 col-md-6">
                                        <label class="form-inner-label">Grommets</label>
                                    </div>
                                    <div class="col-4 col-md-6">
                                        <div class="attribute-info-inner">
                                            <input type="text" value='<?php echo showValue($subval['grommets_extra_price'])?>' name="grommets_extra_price_<?php echo $key?>_<?php echo $skey?>[]"  onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"  class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="attribute-info-inner">
                                           <label>
                                           <?php
                                           echo $subval['grommets'];
                                           ?>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }?>
                    </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>

            <?php }
            }
            ?>
        </div>
    </div>
</div>
<?php
}?>

            </div>

        </div>
    </div>
</div>
  <div class="product-actions-btn text-right">
                                            <!--<button type="submit" class="btn btn-success" id="submitBtn">Submit</button>-->
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
<div class="modal" tabindex="-1" role="dialog" id="QualityModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Quantity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>loading... please wait</p>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="ItemModal">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Quantity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>loading... please wait</p>
      </div>
    </div>
  </div>
</div>
<script>
    function bntInActive(id){
    $("#"+id).attr("disabled", true);
    }

</script>
<script>
    product_id='<?php echo $product_id?>';
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

    function addQuantity(quantity_id){
            $("#QualityModal .modal-title").html('Add Quantity');
            if(quantity_id !=''){
                $("#QualityModal .modal-title").html('Edit Quantity');
            }
            $("#QualityModal").modal('show');

            //$("#loader-img").show();
            var url ='<?php echo $BASE_URL ?>admin/Products/AddEditProductQuantity/'+product_id+'/'+quantity_id;
            $.ajax({
                   type: "GET",
                   url: url,
                    success: function(data)
                    {
                        $("#QualityModal .modal-body").html(data);
                    }
            });
    }

    function deleteQuantity(quantity_id){
        var result = confirm("Are you sure you want to remove Quantity from this product ?");

        if(result==true && quantity_id !=''){
            $("#loader-img").show();
            var url ='<?php echo $BASE_URL ?>admin/Products/deleteProductQuantity/'+product_id+'/'+quantity_id;
            $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data)
                    {
                        location.reload();
                    }
            });
        }
    }

    function addSize(quantity_id,size_id){
            $("#QualityModal .modal-title").html('Add Size');
            if(size_id !=''){
                $("#QualityModal .modal-title").html('Edit Size');
            }
            $("#QualityModal").modal('show');
            //$("#loader-img").show();
            var url ='<?php echo $BASE_URL ?>admin/Products/AddEditProductSize/'+product_id+'/'+quantity_id+'/'+size_id;
            $.ajax({
                   type: "GET",
                   url: url,
                    success: function(data)
                    {
                        $("#QualityModal .modal-body").html(data);
                    }
            });
    }

    function addAttribute(quantity_id,size_id,action){
            $("#ItemModal .modal-title").html('Add Size Attribute');
            if(action !=''){
                $("#ItemModal .modal-title").html('Edit Size Attribute');
            }
            $("#ItemModal").modal('show');
            var url ='<?php echo $BASE_URL ?>admin/Products/AddEditProductAttribute/'+product_id+'/'+quantity_id+'/'+size_id;
            $.ajax({
                   type: "GET",
                   url: url,
                    success: function(data)
                    {
                        $("#ItemModal .modal-body").html(data);
                    }
            });
    }

    function deleteQuantity(quantity_id){
        var result = confirm("Are you sure you want to remove Quantity from this product ?");

        if(result==true && quantity_id !=''){
            $("#loader-img").show();
            var url ='<?php echo $BASE_URL ?>admin/Products/deleteProductQuantity/'+product_id+'/'+quantity_id;
            $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data)
                    {
                        location.reload();
                    }
            });
        }
    }

    function deleteQuantity(quantity_id){
        var result = confirm("Are you sure you want to remove Quantity from this product ?");

        if(result==true && quantity_id !=''){
            $("#loader-img").show();
            var url ='<?php echo $BASE_URL ?>admin/Products/deleteProductQuantity/'+product_id+'/'+quantity_id;
            $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data)
                    {
                        location.reload();
                    }
            });
        }
    }
    function deleteProductSize(quantity_id,size_id){
        var result = confirm("Are you sure you want to remove size from this product & quantity ?");

        if(result==true && quantity_id !=''){
            $("#loader-img").show();
            var url ='<?php echo $BASE_URL ?>admin/Products/deleteProductSize/'+product_id+'/'+quantity_id+'/'+size_id;
            $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data)
                    {
                        location.reload();
                    }
            });
        }
    }
</script>
