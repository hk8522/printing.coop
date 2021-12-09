<link href="/html/css/admin.css" rel="stylesheet" type="text/css">

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
    <div class="form-role-area">
        <div class="control-group info">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="controls small-controls">
                    <div class="attribute-single-info-inner">
                        <div class="all-vol-btn">
                            <button type="button" onclick="addQuantity('')"><i class="fa fa-plus"></i> Add Quantity</button>
                        </div>
                    </div>

                    <?php /* Quantity */ ?>
                    <div class="attribute-single">
                    <?php
                        foreach ($productQuantities as $quantity) {
                            $id = $quantity['id'];
                    ?>
                        <div class="attribute-single-title" id="quantity-container-<?=$id?>">
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
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-role-area">
        <hr>
        <div class="control-group info">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="controls small-controls">
                    <div class="attribute-single-info-inner">
                        <div class="all-vol-btn">
                            <button type="button" onclick="addSize('')"><i class="fa fa-plus"></i> Add Size</button>
                        </div>
                    </div>

                    <?php /* Size */ ?>
                    <div class="attribute-single">
                    <?php
                        foreach ($productSizes as $size) {
                            $id = $size['id'];
                    ?>
                        <div class="attribute-single-title" id="size-container-<?=$id?>">
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
                    <?php } ?>
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
var product_id='<?=$product_id?>'; 

function addQuantity(quantity_id) {
    $("#QualityModal .modal-title").html('Add Quantity');
    if (quantity_id !=''){
        $("#QualityModal .modal-title").html('Edit Quantity');
    }
    $("#QualityModal").modal('show');

    $.post('<?=$BASE_URL?>admin/Products/AddEditProductQuantity/<?=$product_id?>/' + quantity_id,
        function(data) {
            $("#QualityModal .modal-body").html(data);
        }
    );
}

function deleteQuantity(quantity_id) {
    if (quantity_id == '')
        return;
    if (!confirm("Are you sure you want to remove Quantity from this product ?"))
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
    $("#QualityModal .modal-title").html('Add Size');
    if (size_id !=''){
        $("#QualityModal .modal-title").html('Edit Size');
    }
    $("#QualityModal").modal('show');

    $.post('<?=$BASE_URL?>admin/Products/AutoSizeAdd/<?=$product_id?>/' + size_id,
        function(data) {
            $("#QualityModal .modal-body").html(data);
        }
    );
}

function deleteSize(size_id) {
    if (size_id == '')
        return;
    if (!confirm("Are you sure you want to remove Size from this product ?"))
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
</script>
