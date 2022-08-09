<div class="content-wrapper" style="min-height: 687px;">
<section class="content">
    <div class="row" style="display: flex;justify-content: center;align-items: center;">
        <div class="col-md-12 col-xs-12">
            <div class="box box-success box-solid">
                <div class="box-body">
                    <div class="inner-head-section">
                        <div class="inner-title">
                            <span>Edit Neighbor Attribute</span>
                        </div>
                    </div>
                    <div class="inner-content-area">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-role-area">
                                    <div class="control-group info">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label class="span2" for="inputMame">Neighbor Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="controls">
                                                    <label class="span2" for="inputMame"><?= $neighbor['name']?></label>
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
                                                    <label class="span2" for="inputMame"><?= $neighbor['url']?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>

                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center" style="color:red">
                                    <?= $this->session->flashdata('message_error')?>
                                </div>
                                <?= form_open_multipart('', array('class' => 'form-horizontal'))?>
                                <input class="form-control" name="id" type="hidden"  value="<?= isset($attributeData['id']) ? $attributeData['id'] : ''?>" id="data_id">
                                <div class="form-role-area">
                                    <div class="control-group info">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label class="span2" for="inputMame">Our Attribte</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="controls">
                                                    <input class="form-control" name="attribute_id" id="attribute_id" type="text" placeholder="Neighbor Name" value="<?= isset($attributeData['attribute_id']) ? $attributeData['attribute_id'] : ''?>" required>
                                                    <?= form_error('attribute_id')?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group info">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label class="span2" for="inputMame">Neighbor's Attribute</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="controls">
                                                    <input class="form-control" name="url" id="url" type="text" placeholder="Neighbor's Attribute" value="<?= isset($attributeData['name']) ? $attributeData['name'] : ''?>" required>
                                                    <?= form_error('name')?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-actions-btn text-right">
                                        <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                        <a href="<?= $BASE_URL.$class_name. 'edit/' . $neighbor['id'] ?>" class="btn btn-success">Back</a>
                                    </div>
                                    <?= form_close()?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col-->
    </div><!-- ./row -->
</section><!-- /.content -->
</div>
<script>
function searchAttribute(searchtext) {
    if (searchtext !='') {
        $('#loader-img').show();
        var url ='<?= $BASE_URL?>admin/Neighbor/searchAttribute/<?= $neighbor_id?>';
        $("#searchDiv").show();
        $("#AttributeListUl").html('');
        $.ajax({
            type: "POST",
            url: url,
            data:{'searchtext':searchtext}, // serializes the form's elements.
                success: function(data)
                {   $('#loader-img').hide();
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

function hidesearchDiv() {
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
