<div class="inner-content-area">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-center" style="color:red">
                <?php echo $this->session->flashdata('message_error');?>
            </div>
            <div class="text-center" style="color:green">
                <?php
                echo $this->session->flashdata('message_success');
                ?>
            </div>
            <?php echo form_open_multipart('', array('class'=>'form-horizontal', 'id'=>'auto_size_add_form'));?>
            <input class="form-control" name="id" type="hidden"  value="<?php echo $id?>" id="id">
            <input class="form-control" type="hidden"
            value="<?php echo $product_id?>" id="product_id" name="product_id">
            <div class="form-role-area">
                <div class="control-group info">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label class="span2 " for="inputMame">Sizes</label>
                        </div>
                        <div class="col-md-8">
                            <div class="controls">
                                <select name="size_id" class="form-control" required>
                                    <option value="">Select Size</option>
                                    <?php
                                    foreach ($sizes as $size) {
                                        $selected = '';
                                        if ($size['id'] == $size_id) {
                                            $selected = 'selected="selected"';
                                        }
                                    ?>
                                        <option value="<?=$size['id']?>" <?=$selected?>><?=$size['size_name']?></option>
                                    <?php
                                    }?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group info">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label class="span2" for="inputMame">Extra Price</label>
                        </div>
                        <div class="col-md-8">
                            <div class="controls">
                                <input type="text" value='<?php echo showValue($extra_price);?>' name="extra_price" onkeypress="javascript:return isNumber(event)" placeholder="Extra Price" class="form-control">
                            <?php echo form_error('extra_price');?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<script src="<?php echo $BASE_URL?>/assets/js/validation.js"></script>
<script>
success='<?php echo $success?>';
$('#auto_size_add_form').validate({
        rules: {
            size_id: {
            required: true,
            },
        },
        messages: {
            size_id: {
            required: 'Please select size',
            },
        },
        submitHandler: function(form) {
            $("#loder-img").show();
            $.ajax({
            type: "POST",
            url: '<?=$BASE_URL?>admin/Products/AutoSizeAdd',
            data: $(form).serialize(),
            beforeSend: function() {
                $('button[type=submit]').attr('disabled', true);
            },
            success: function(data) {
                $('button[type=submit]').attr('disabled', false);
                $("#loder-img").hide();
                $("#ItemModal .modal-body").html(data);
                if (success == 1) {
                    location.reload();
                }
            }
            });
        },
    });
</script>