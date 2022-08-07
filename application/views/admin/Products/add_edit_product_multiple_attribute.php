<div class="inner-content-area">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-center" style="color:red">
                <?= $this->session->flashdata('message_error') ?>
            </div>
            <div class="text-center" style="color:green">
                <?= $this->session->flashdata('message_success') ?>
            </div>
            <?= form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'AddEditProductAttribute')) ?>
            <input class="form-control" type="hidden" value="<?= $product_id ?>" id="product_id"
                name="product_id">
            <input class="form-control" type="hidden" value="<?= $quantity_id ?>" id="quantity_id"
                name="quantity_id">
            <input class="form-control" type="hidden" value="<?= $size_id ?>" id="size_id" name="size_id">
            <input class="form-control" type="hidden" value="<?= $attribute_id ?>" id="attribute_id"
                name="attribute_id">
            <input class="form-control" name="id" type="hidden" value="<?= $id ?>" id="id">
            <?php
            $MultipleAttribute = $MultipleAttributes[$attribute_id];
            //pr($MultipleAttribute,1);
            ?>
            <div class="form-role-area">
                <div class="control-group info">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label class="span2 " for="inputMame"><?= $MultipleAttribute['name'] ?></label>
                        </div>
                        <div class="col-md-8">
                            <div class="controls">
                                <select name="attribute_item_id" class="form-control" required>
                                    <option value="">Select <?= $MultipleAttribute['name'] ?></option>
                                    <?php
                                    foreach ($MultipleAttribute['items'] as $key => $val) {
                                        $selected = '';
                                        if ($attribute_item_id == $key) {
                                            $selected = 'selected="selected"';
                                        }
                                        ?>
                                        <option value="<?= $key ?>" <?= $selected ?>><?= $val ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group info">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label class="span2 " for="inputMame">Extra Price</label>
                        </div>
                        <div class="col-md-8">
                            <div class="controls">
                                <input type="text" value='<?= showValue($extra_price) ?>' name="extra_price"
                                    onkeypress="javascript:return isNumber(event)" placeholder="Extra Price"
                                    class="form-control">
                                <?= form_error('extra_price') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script src="<?= $BASE_URL ?>/assets/js/validation.js"></script>
<script>
success = '<?= $success ?>';
$('#AddEditProductAttribute').validate({
    rules: {
        attribute_item_id: {
            required: true,
        },
    },
    messages: {
        attribute_item_id: {
            required: 'Please select attribute item',
        },
    },
    submitHandler: function(form) {
        $("#loader-img").show();
        var url = '<?= $BASE_URL ?>admin/Products/AddEditProductAttribute';
        $.ajax({
            type: "POST",
            url: url,
            data: $(form).serialize(), // serializes the form's elements.
            beforeSend: function() {
                $('button[type=submit]').attr('disabled', true);
            },
            success: function(data) {
                $('button[type=submit]').attr('disabled', false);
                $("#loader-img").hide();
                $("#ItemModal .modal-body").html(data);
                if (success == 1) {
                    location.reload();
                }
            }
        });
    },
});
</script>