<link href="/assets/admin/css/product.css" rel="stylesheet" type="text/css">

<div class="content-wrapper dd" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span><?=$page_title?> for <span title="<?=$product['short_description']?>"><b>"<?=$product['name']?>"</b></span></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red">
                                        <?php echo $this->session->flashdata('message_error');
										$product_id = $product['id'];
										?>
                                    </div>
                                    <?php echo form_open_multipart('', array('class'=>'form-horizontal'));?>
                                    <input class="form-control" name="id" type="hidden"  value="<?php echo isset($product['id']) ? $product['id']:'';?>" id="product_id">
    <div class="form-role-area"><div class="control-group info"><div class="row"><div class="col-md-12 col-lg-12 col-xl-12">
        <div class="controls small-controls">
            <div class="attribute-single-info-inner">
                <div class="all-vol-btn">
                    <button type="button" onclick="addQuantity('')"><i class="fa fa-plus"></i>Add Quantity</button>
                </div>
            </div>

            <?php /* Quantity */ ?>
            <div class="attribute-single">
            <?php
                foreach ($productQuantities as $quantity) {
                    $id = $quantity['id'];
            ?>
                <div class="attribute-single-items" id="quantity-container-<?=$id?>">
                    <div class="attribute-single-title">
                        <div class="row align-items-center">
                            <div class="col-6 col-md-6">
                                <label class="span2">
                                    <input type="checkbox" value="<?=$id?>" name="quantity[]" id="quantity_attribute_id_<?=$id?>" onclick="return false;" checked>
                                    <?php echo $quantity['name'];?>
                                </label>
                            </div>
                            <div class="col-3 col-md-4">
                                <div class="attribute-single-inner">
                                    <input type="text" value='<?php echo showValue($quantity['price']);?>' name="quantity_extra_price[]?>" placeholder="Extra Price" class="form-control" readonly>
                                    <label class="form-inner-label">Extra Price</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <div class="attribute-single-inner action-btns">
                                    <button class="btn btn-success" type="button" onclick="addQuantity('<?=$id?>')"><i class="far fa-edit fa-lg"></i></button>&nbsp;
                                    <button class="btn btn-danger" type="button" onclick="deleteQuantity('<?=$id?>')"><i class="fa fa-trash fa-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div></div></div></div>

    <div class="form-role-area"><hr><div class="control-group info"><div class="row"><div class="col-md-12 col-lg-12 col-xl-12">
        <div class="controls small-controls">
            <div class="attribute-single-info-inner">
                <div class="all-vol-btn">
                    <button type="button" onclick="addSize('')"><i class="fa fa-plus"></i>Add Size</button>
                </div>
            </div>

            <?php /* Size */ ?>
            <div class="attribute-single">
            <?php
                foreach ($productSizes as $size) {
                    $id = $size['id'];
            ?>
                <div class="attribute-single-items" id="size-container-<?=$id?>">
                    <div class="attribute-single-title">
                        <div class="row align-items-center">
                            <div class="col-6 col-md-6">
                                <label class="span2">
                                    <input type="checkbox" value="<?=$id?>" name="size[]" id="size_attribute_id_<?=$id?>" onclick="return false;" checked>
                                    <?php echo $size['size_name'];?>
                                </label>
                            </div>
                            <div class="col-3 col-md-4">
                                <div class="attribute-single-inner">
                                    <input type="text" value='<?php echo showValue($size['extra_price']);?>' name="size_extra_price[]?>" placeholder="Extra Price" class="form-control" readonly>
                                    <label class="form-inner-label">Extra Price</label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <div class="attribute-single-inner action-btns">
                                    <button class="btn btn-success" type="button" onclick="addSize('<?=$id?>')"><i class="far fa-edit fa-lg"></i></button>&nbsp;
                                    <button class="btn btn-danger" type="button" onclick="deleteSize('<?=$id?>')"><i class="fa fa-trash fa-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div></div></div></div>

    <div class="form-role-area"><hr><div class="control-group info"><div class="row"><div class="col-md-12 col-lg-12 col-xl-12">
        <div class="controls small-controls">
            <div class="attribute-single-info-inner">
                <div class="all-vol-btn">
                    <button type="button" onclick="addAttribute('')"><i class="fa fa-plus"></i>Add Attributes</button>
                </div>
            </div>

            <?php /* Attributes */ ?>
            <div class="attribute-single">
            <?php foreach($productAttributes as $attribute) {
                $attribute_id = $attribute['id'];
                ?>
                <div class="attribute-single-items" id="attribute-container-<?=$attribute_id?>">
                    <div class="attribute-single-title">
                        <div class="row align-items-center">
                            <div class="col-8 col-md-8">
                                <label class="span2">
                                    <input type="checkbox" value="<?=attribute_id?>" name="attribute_id_<?=$attribute_id?>[]" id="attribute_id_<?=$attribute_id?>" onclick="return false;" checked>
                                    <?php echo $attribute['name'];?>
                                </label>
                            </div>
                            <div class="col-4 col-md-4">
                                <div class="attribute-single-inner action-btns">
                                    <div class="cus-inner-btn">
                                        <button type="button" onclick="addAttributeItem('<?=$attribute_id?>', '')">Add <?=$attribute['name']?> Item</button>
                                    </div>&nbsp;
                                    <button class="btn btn-success" type="button" onclick="addAttribute('<?=$attribute_id?>')"><i class="far fa-edit fa-lg"></i></button>&nbsp;
                                    <button class="btn btn-danger" type="button" onclick="deleteAttribute('<?=$attribute_id?>')"><i class="fa fa-trash fa-lg"></i></button>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (!empty($productAttributeDetails[$attribute_id])){
                            $attributeItems = $productAttributeDetails[$attribute_id];
                        ?> 
                        <div class="row" id="attribute-item-container<?="$product_id-$attribute_id"?>" style="display:; padding: 10px 10px 10px 25px; background: #f5f5f5;">
                        <?php foreach($attributeItems as $item) {
                            $attribute_item_id = $item['id'];
                            ?>
                            <div class="col-md-6">
                                <div class="attribute-single-info">
                                    <div class="row align-items-center">
                                        <div class="col-8 col-md-8">
                                            <label class="form-inner-label"><?=$item['item_name']?></label>
                                        </div>
                                        <div class="col-2 col-md-2">
                                            <div class="attribute-single-info-inner">
                                                <input type="text" name="extra_price_<?=$product_id?>_<?=$attribute_id?>_<?=$attribute_item_id?>[]" onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" class="form-control" value='<?=showValue($item['extra_price'])?>' readonly>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-2">
                                            <div class="attribute-single-inner action-btns">
                                            <button class="btn btn-success" type="button" onclick="addAttributeItem('<?=$attribute_id?>', '<?=$attribute_item_id?>')"><i class="far fa-edit fa-lg"></i></button>&nbsp;
                                            <button class="btn btn-danger" type="button" onclick="deleteAttributeItem('<?=$attribute_id?>', '<?=$attribute_item_id?>')"><i class="fa fa-trash fa-lg"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        }?>
                        </div>
                        <?php
                        }?>
                        
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div></div></div></div>


    <div class="form-role-area"><hr><div class="control-group info"><div class="row">
        <div class="col-md-6">
            <div class="controls small-controls">
                <div class="single-for-verify">
                    <button type="button" onclick="generateAttributes()">Generate Multiple Attributes <i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="controls small-controls">
                <div class="single-for-verify">
                    <a href="<?=$BASE_URL.$class_name?>SetMultipleAttributes/<?=$product_id?>"><button type="button">Show attributes <i class="fa fa-arrow-right"></i></button></a>
                </div>
            </div>
        </div>
    </div></div></div>

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

<div class="modal" tabindex="-1" role="dialog" id="ItemModal">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
var product_id='<?=$product_id?>'; 

function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;
    return true;
}

function addQuantity(quantity_id) {
    $("#ItemModal .modal-title").html('Add Quantity');
    if (quantity_id !='') {
        $("#ItemModal .modal-title").html('Edit Quantity');
    }
    $("#ItemModal").modal('show');

    $.get('<?=$BASE_URL?>admin/Products/AddEditProductQuantity/<?=$product_id?>/' + quantity_id,
        function(data) {
            $("#ItemModal .modal-body").html(data);
        }
    );
}

function deleteQuantity(quantity_id) {
    if (quantity_id == '')
        return;
    if (!confirm("Are you sure you want to remove Quantity from this product?"))
        return;

    $("#loder-img").show();
    $.get('<?=$BASE_URL?>admin/Products/deleteProductQuantity/<?=$product_id?>/' + quantity_id,
        function(data) {
            $('#quantity-container-' + quantity_id).remove();
            $("#loder-img").hide();
        }
    );
}

function addSize(size_id) {
    $("#ItemModal .modal-title").html('Add Size');
    if (size_id != '') {
        $("#ItemModal .modal-title").html('Edit Size');
    }
    $("#ItemModal").modal('show');

    $.get('<?=$BASE_URL?>admin/Products/AutoSizeAdd/<?=$product_id?>/' + size_id,
        function(data) {
            $("#ItemModal .modal-body").html(data);
        }
    );
}

function deleteSize(size_id) {
    if (size_id == '')
        return;
    if (!confirm("Are you sure you want to remove Size from this product?"))
        return;

    $("#loder-img").show();
    $.post('<?=$BASE_URL?>admin/Products/autoSizeDelete/<?=$product_id?>/' + size_id,
        function(data) {
            if (data == 1)
                $('#size-container-' + size_id).remove();
            $("#loder-img").hide();
        }
    );
}

function addAttribute(attribute_id) {
    $("#ItemModal .modal-title").html('Add Attribute');
    if (attribute_id != '') {
        $("#ItemModal .modal-title").html('Edit Attribute');
    }
    $("#ItemModal").modal('show');

    $.get('<?=$BASE_URL?>admin/Products/AutoAttributeAdd/<?=$product_id?>/' + attribute_id,
        function(data) {
            $("#ItemModal .modal-body").html(data);
        }
    );
}

function deleteAttribute(attribute_id) {
    if (attribute_id == '')
        return;
    if (!confirm("Are you sure you want to remove Attribute from this product?"))
        return;

    $("#loder-img").show();
    $.post('<?=$BASE_URL?>admin/Products/autoAttributeDelete/<?=$product_id?>/' + attribute_id,
        function(data) {
            if (data == 1)
                $('#attribute-container-' + attribute_id).remove();
            $("#loder-img").hide();
        }
    );
}

function addAttributeItem(attribute_id, attribute_item_id) {
    $("#ItemModal .modal-title").html('Add Attribute Item');
    if (attribute_item_id !='') {
        $("#ItemModal .modal-title").html('Edit Attribute Item');
    }
    $("#ItemModal").modal('show');

    $.get('<?=$BASE_URL?>admin/Products/AutoAttributeItemAdd/<?=$product_id?>/' + attribute_id + '/' + attribute_item_id,
        function(data) {
            $("#ItemModal .modal-body").html(data);
        }
    );
}

function deleteAttributeItem(attribute_id, attribute_item_id) {
    if (!confirm("Are you sure you want to remove Attribute Item from this product?"))
        return;

    $("#loder-img").show();
    $.post('<?=$BASE_URL?>admin/Products/autoAttributeItemDelete/<?=$product_id?>/' + attribute_id + '/' + attribute_item_id,
        function(data) {
            if (data == 1)
                $('#attribute-item-container-' + attribute_id + '-' + attribute_item_id).remove();
            $("#loder-img").hide();
        }
    );
}

function generateAttributes() {
    if (!confirm("Have you prepared all your settings?"))
        return;

    $("#loder-img").show();
    $.post('<?=$BASE_URL?>admin/Products/autoGenerateAttributes/<?=$product_id?>',
        function(data) {
            if (data == 1) {
                $("#ItemModal .modal-title").html('Multiple Attributes Generated');
                $("#ItemModal .modal-body").html('<div class="inner-content-area"><div class="row justify-content-center"><div class="col-md-12 center"><button class="btn btn-success" id="submitBtn" onclick="$(\'#ItemModal\').modal(\'hide\');">Ok</button></div></div>');
                $("#ItemModal").modal('show');
            }
            $("#loder-img").hide();
        }
    );
}
</script>
