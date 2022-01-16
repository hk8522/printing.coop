<style type="text/css">
.attribute-items:nth-child(even) {
    background: #f1f1f1;
    padding: 3px 10px;
}
.attribute-items:nth-child(odd) {
    background: #e8e8e8;
    padding: 3px 10px;
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
                            <span>Edit Neighbor</span>
                        </div>
                    </div>
                    <?= form_open_multipart('', array('class'=>'form-horizontal'))?>
                    <div class="inner-content-area">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center" style="color:red">
                                    <?= $this->session->flashdata('message_error')?>
                                </div>
                                <input type="hidden" name="id" value="<?= isset($neighbor['id']) ? $neighbor['id'] : ''?>" id="neighbor_id">
                                <div class="form-role-area">
                                    <div class="control-group info">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label class="span2" for="inputMame">Neighbor Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="controls">
                                                    <input class="form-control" name="name" id="name" type="text" placeholder="Neighbor Name" value="<?= isset($neighbor['name']) ? $neighbor['name'] : ''?>" required>
                                                    <?= form_error('name')?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group info">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label class="span2" for="inputMame">URL</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="controls">
                                                    <input class="form-control" name="url" id="url" type="text" placeholder="URL" value="<?= isset($neighbor['url']) ? $neighbor['url'] : ''?>" required>
                                                    <?= form_error('url')?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if ($neighbor_id > 0) {?>
                        <hr/>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red"><?= $this->session->flashdata('message_error')?></div>
    <div class="form-role-area"><div class="control-group info"><div class="row"><div class="col-md-12 col-lg-12 col-xl-12">
        <div class="controls small-controls">
            <!-- <div class="attribute-info-inner">
                <div class="all-vol-btn">
                    <button type="button" onclick="addAttribute('')"><i class="fa fa-plus"></i>Add Attribute</button>
                </div>
            </div> -->

            <?php /* Quantity */ ?>
            <div class="attribute">
                <div class="attribute-items" id="attribute-container-<?=$id?>">
                    <div class="attribute-title">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-12">
                                <label class="span2">
                                    <input type="checkbox" class="show-attributes-toggle">
                                    <span>Show Only Used</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            <?php
                foreach ($attributes as $attribute) {
                    $id = $attribute['id'];
            ?>
                <div class="attribute-items" id="attribute-container-<?=$id?>">
                    <div class="attribute-title">
                        <div class="row align-items-center">
                            <div class="col-6 col-md-6">
                                <label class="span2">
                                    <input type="hidden" name="data_id[]" value="<?= $id?>" id="data_id">
                                    <input type="hidden" name="attribute_id[]" value="<?= $attribute['attribute_id']?>" id="attribute_id">
                                    <input type="checkbox" onclick="return false;" checked>
                                    <span name="attribute_name" class="copy-source"><?= $attribute['attribute_name']?></span>
                                    <button type="button" class="btn bg-transparent right select-attribute" onclick="return false;" <?= $attribute['attribute_id'] == 0 ? 'disabled' : ''?>><i class="fa fa-arrow-right"></i></button>
                                </label>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="input-group has-clear">
                                    <input type="text" name="neighbor_attribute[]" class="form-control copy-dest" placeholder="<?= $attribute['attribute_name']?>" value="<?= $attribute['name']?>" <?= $attribute['attribute_id'] == 0 ? 'readonly' : ''?>>
                                    <button type="button" class="btn bg-transparent form-control-clear <?= strlen($attribute['name']) > 0 ? 'hidden' : ''?>" style="margin-left: -40px; z-index: 100;" <?= $attribute['attribute_id'] == 0 ? 'disabled' : ''?>>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    //pr($attributeItems[$id]);
                    foreach ($attributeItems[$attribute['attribute_id']] as $item) {
                        $item_id = $item['id'];
                ?>
                    <div class="attribute-items" id="attribute-container-<?=$item_id?>" style="margin-left: 25px;">
                        <div class="attribute-title">
                            <div class="row align-items-center">
                                <div class="col-6 col-md-6">
                                    <label class="span2">
                                        <input type="hidden" name="item_data_id[]" value="<?= $item_id?>" id="item_data_id">
                                        <input type="hidden" name="item_attribute_id[]" value="<?= $attribute['attribute_id']?>" id="item_attribute_id">
                                        <input type="hidden" name="attribute_item_id[]" value="<?= $item['attribute_item_id']?>" id="attribute_item_id">
                                        <input type="checkbox" onclick="return false;" checked>
                                        <span name="attribute_item_name" class="copy-source"><?= $item['attribute_item_name']?></span>
                                        <button type="button" class="btn bg-transparent right select-attribute-item" onclick="return false;"><i class="fa fa-arrow-right"></i></button>
                                    </label>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="input-group has-clear">
                                        <input type="text" name="neighbor_attribute_item[]" class="form-control copy-dest" placeholder="<?= htmlspecialchars($item['attribute_item_name'])?>" value="<?= $item['name']?>">
                                        <button type="button" class="btn bg-transparent form-control-clear <?= strlen($item['name']) > 0 ? 'hidden' : ''?>" style="margin-left: -40px; z-index: 100;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            </div>
            <div class="product-actions-btn text-right">
                <button type="submit" class="btn btn-success" id="submitBtn">Save</button>
                <a href="<?= $BASE_URL.$class_name ?>" class="btn btn-success">Back</a>
            </div>
        </div>
    </div></div></div></div>
                        <?php } else { ?>
                        <div class="product-actions-btn text-right">
                            <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                            <a href="<?= $BASE_URL.$class_name ?>" class="btn btn-success">Back</a>
                        </div>
                        <?php } ?>
                    </div>
                    <?= form_close()?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col-->
    </div><!-- ./row -->
</section><!-- /.content -->
</div>
<script>
$('.show-attributes-toggle').click(function() {
    var isChecked = this.checked;
    $('.attribute-items').each(function(index, element) {
        if (isChecked) {
            if ($(element).find('[type="text"]').val() == "") {
                $(element).addClass('hide');
            }
        }
        else
        $(element).removeClass('hide');
    });
});

$('button.right').click(function() {
    var index = $('button.right').index($(this));
    $($('.copy-dest')[index]).val($('.copy-source')[index].innerText);
    $($('.copy-dest')[index]).trigger('propertychange');
    // $($('[name="neighbor_attribute[]"]')[index]).val($('[name="attribute_name"]')[index].innerText);
    // $($('[name="neighbor_attribute[]"]')[index]).trigger('propertychange');
}).trigger('propertychange');

function searchAttribute(searchtext) {
    if(searchtext !=''){
        $("#loder-img").show();
        var url ='<?= $BASE_URL?>admin/Neighbor/searchAttribute/<?= $neighbor_id?>';
        $("#searchDiv").show();
        $("#AttributeListUl").html('');
        $.ajax({
            type: "POST",
            url: url,
            data:{'searchtext':searchtext}, // serializes the form's elements.
                success: function(data)
                {   $("#loder-img").hide();
                    $("#AttributeListUl").html(data);
                },
                error: function (error) {
                }
        });
    } else {
        $("#searchDiv").hide();
        $("#AttributeListUl").html('');
        $("#searchSgedAttributeTextBox").val('');
    }
}

function hidesearchDiv(){
    $("#searchDiv").hide();
    $("#AttributeListUl").html('');
}

$("#select-all").click(function () {
    if ($(this).prop("checked") == true) {
        $(".attribute_ids").prop('checked', true);
    } else {
        $(".attribute_ids").prop('checked', false);
    }
});
</script>
