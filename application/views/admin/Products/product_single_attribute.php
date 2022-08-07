<style type="text/css">
.controls.small-control {
    position: relative;
}

.entrynew.input-group .form-control {
    width: 100px;
}

.attribute-inner,
.attribute-info-inner {
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

.attribute-inner label,
.attribute-info-inner label {
    margin: 0px !important;
    padding-right: 5px;
}

.control-group .attribute-inner input,
.control-group .attribute-info-inner input {
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
                                <span><?= $page_title ?></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red">
                                        <?= $this->session->flashdata('message_error') ?>
                                    </div>
                                    <?= form_open_multipart('', array('class' => 'form-horizontal')) ?>
                                    <input class="form-control" name="id" type="hidden"
                                        value="<?= isset($postData['id']) ? $postData['id'] : '' ?>"
                                        id="product_id">
                                    <div class="form-role-area">

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-xl-3" style="">
                                                    <label class="span2 " for="inputMame">Product Single Extra
                                                        Attributes</label>
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xl-9">
                                                    <div class="controls small-controls">
                                                        <?php //pr($ProductAttributes); ?>
                                                        <?php foreach ($AttributesList as $key => $val) { //pr($AttributesList); die('OK');?>

                                                        <div class="attribute <?php if (array_key_exists($key, $ProductAttributes)) { echo "active"; } ?>" id="attribute_id_div_<?= $key ?>">
                                                            <!-- Toggle "active" class when clicked on input(checkbox) below -->
                                                            <div class="attribute-title">
                                                                <div class="row align-items-center">
                                                                    <div class="col-7 col-md-8">
                                                                        <label class="span2">
                                                                            <input type="checkbox"
                                                                                value="<?= $key ?>"
                                                                                name="attribute_id_<?= $key ?>"
                                                                                id="attribute_id_<?= $key ?>" <?php if (array_key_exists($key, $ProductAttributes)) { echo "checked"; } ?> onchange="addActiveClass('<?= $key ?>')">
                                                                            <?= $val['name'] ?>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-5 col-md-4">
                                                                        <div class="attribute-inner">
                                                                            <input type="text" value="<?php if (array_key_exists($key, $ProductAttributes)) { echo $ProductAttributes[$key]['data']['show_order']; } ?>" name="attribute_order_<?= $key ?>" onkeypress="javascript:return isNumber(event)"
                                                                                placeholder="set Order">
                                                                            <label class="form-inner-label">set order</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="attribute-row">
                                                                <div class="row">
                                                                    <?php
                                                                    $k = 1;
                                                                    foreach ($val['items'] as $subkey => $subval) { ?>
                                                                        <div class="col-md-6">
                                                                            <div class="attribute-info">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label class="span2">
                                                                                            <input type="checkbox"
                                                                                                value="<?= $subkey ?>" <?php if (isset($ProductAttributes[$key]['items']) && array_key_exists($subkey, $ProductAttributes[$key]['items'])) { echo "checked"; } ?> id="attribute_item_id_<?= $key . "_" . $k ?>" onchange="setAttributesetItemId('attribute_item_id_<?= $key . "_" . $k ?>')">
                                                                                            <input type="hidden" value="<?php if (isset($ProductAttributes[$key]['items']) && array_key_exists($subkey, $ProductAttributes[$key]['items'])) { echo $ProductAttributes[$key]['items'][$subkey]['attribute_item_id']; } ?>" name="attribute_item_id_<?= $key ?>[]" id="hidden_attribute_item_id_<?= $key . "_" . $k ?>">
                                                                                            <?= $subval ?>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-6 col-md-6">
                                                                                        <div class="attribute-info-inner">
                                                                                            <input type="text" value="<?php if (isset($ProductAttributes[$key]['items']) && array_key_exists($subkey, $ProductAttributes[$key]['items'])) { echo showValue($ProductAttributes[$key]['items'][$subkey]['extra_price']); } ?>" name="attribute_item_extra_price_<?= $key ?>[]" onkeypress="javascript:return isNumber(event)" placeholder="Extra Price">
                                                                                            <label class="form-inner-label">Extra Price</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6 col-md-6">
                                                                                        <div class="attribute-info-inner">
                                                                                            <input type="text" value="<?php if (isset($ProductAttributes[$key]['items']) && array_key_exists($subkey, $ProductAttributes[$key]['items'])) { echo $ProductAttributes[$key]['items'][$subkey]['show_order']; } ?>" name="attribute_item_order_<?= $key ?>[]" onkeypress="javascript:return isNumber(event)" placeholder="set Order">
                                                                                            <label class="form-inner-label">set Order</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                        $k++;
                                                                   } ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-actions-btn text-right">
                                            <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                            <a href="<?= $BASE_URL . $class_name . $main_page_url ?>"
                                                class="btn btn-success">Back</a>
                                        </div>
                                        <?= form_close() ?>
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
function bntInActive(id) {
    $("#" + id).attr("disabled", true);
}
</script>
<script>
function AddRow(cr, id) {
    var controlForm = $('.' + id + 'SizeQuantity:first'),
        currentEntry = cr.parents('.' + id + 'sqddata:first'),
        newEntry = $(currentEntry.clone()).appendTo(controlForm);

    newEntry.find('input').val('');
    newEntry.find('textarea').val('');
    newEntry.find('select').val('');

    var timestamp = new Date().getUTCMilliseconds();
    newEntry.find('input').attr('id', timestamp);

    newEntry.find('.' + id + 'sqbtn-remove').show();
    controlForm.find('.' + id + 'sqbtn-remove').show();
    controlForm.find('.' + id + 'sqbtn-add').hide();
    newEntry.find('.' + id + 'sqbtn-add').show();
}

function RemoveRow(cr, id) {
    cr.parents('.' + id + 'sqddata:first').remove();
    var numItems = $('.' + id + 'SizeQuantity .' + id + 'sqddata').length;
    var controlForm = $('.' + id + 'SizeQuantity .' + id + 'sqddata').last();
    if (numItems == 1) {
        controlForm.find('.' + id + 'sqbtn-remove').hide();
        controlForm.find('.' + id + 'sqbtn-add').show();
    } else {
        controlForm.find('.' + id + 'sqbtn-remove').show();
        controlForm.find('.' + id + 'sqbtn-add').show();
    }
    return false;
}

function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}

function addActiveClass(id) {
    if ($("#attribute_id_" + id).prop("checked") == true) {
        $("#attribute_id_div_" + id).addClass('active');
    } else {
        $("#attribute_id_div_" + id).removeClass('active');
    }
}

function setAttributesetItemId(id) {
    //alert(id);

    if ($("#" + id).prop("checked") == true) {
        $("#hidden_" + id).val($("#" + id).val());
    } else {
        $("#hidden_" + id).val('');
    }
}

function addActiveSizeClass(id) {
    if ($("#size_attribute_id_" + id).prop("checked") == true) {
        $("#size_attribute_id_div_" + id).addClass('active');
    } else {
        $("#size_attribute_id_div_" + id).removeClass('active');
    }
}

function addActiveQuantitySizeClass(id) {
    if ($("#quantity_attribute_id_" + id).prop("checked") == true) {
        $("#quantity_attribute_id_div_" + id).show();
    } else {
        $("#quantity_attribute_id_div_" + id).hide();
    }
}
$(document).on('change', '.make_a_default', function(e) {
    e.preventDefault();
    if ($(this).prop("checked") == true) {
        $('.make_a_default').prop("checked", false);
        $(this).prop("checked", true);
    } else {
        $('.make_a_default').prop("checked", false);
    }
});
</script>