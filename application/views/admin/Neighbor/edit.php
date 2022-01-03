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
                    <div class="inner-content-area">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="text-center" style="color:red">
                                    <?= $this->session->flashdata('message_error')?>
                                </div>
                                <?= form_open_multipart('', array('class'=>'form-horizontal'))?>
                                <input class="form-control" name="id" type="hidden"  value="<?= isset($neighbor['id']) ? $neighbor['id'] : ''?>" id="product_id">
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
                                    <div class="product-actions-btn text-right">
                                        <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                        <a href="<?= $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
                                    </div>
                                    <?= form_close()?>
                                </div>
                            </div>
                        </div>

                        <?php if ($neighbor_id > 0) {?>
                        <hr>
                        <div class="row align-items-end">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xs-12 text-left">
                                <div class="inner-title" style="margin-bottom: 20px;">
                                    <span><?= ucfirst($page_title)?></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-7 col-xl-4 col-xs-12 text-left">
                                <!----Serach Attribute Html-->
                                <div class="search-box-area">
                                    <div class="search-sugg">
                                        <label class="span2">Search</label>
                                        <input class="form-control" type="text" placeholder="Search Attribute"  onkeyup="searchAttribute($(this).val())" id="searchSgedAttributeTextBox" name="searchSgedAttributeTextBox">
                                    </div>
                                    <div class="search-result" id="searchDiv" style="display:none"> <!-- Add "active" class to show -->
                                        <a href="javascript:void(0)" onclick="hidesearchDiv()"><i class="fas fa-times" ></i></a>
                                        <ul id="AttributeListUl"></ul>
                                    </div>
                                </div>
                                <!----End Serach Attribute Html-->
                            </div>
                            <div class="col-md-12 col-lg-5 col-xl-4 col-xs-12 text-left">
                                <div class="select-options">
                                    <form action="<?= $BASE_URL?>admin/Neighbor/attributeSort/<?= $neighbor_id?>" method="post">
                                        <div>
                                            <label class="span2">Order By</label>
                                            <select class="form-control" onchange="this.form.submit()" name="order">
                                                <option value="asc" <?= $order=='asc' ? 'selected="selected"' : ''?>>A-Z</option>
                                                <option value="desc" <?= $order=='desc' ? 'selected="selected"' : ''?>>Z-A</option>
                                            </select>
                                        </div>
                                        <div style="margin-left: 10px;">
                                            <a href="<?= $BASE_URL.$class_name?>edit/<?= $neighbor_id?>"><button type="button">Reset</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-4 col-xs-12 text-right">
                                <div class="all-vol-btn">
            <form action="<?= $BASE_URL?>admin/Neighbor/attributesDeleteAll/<?= $neighbor_id?>" method="post">
                                    <a href="<?= $BASE_URL . $class_name ?>attributeEdit/<?= $neighbor_id?>" style="margin-right: 5px;">
                                        <button type="button"><i class="fas fa-plus-circle"></i> Add New Attribute</button>
                                    </a>
                                    <button><i class="fas fa-trash fa-lg"></i> Delete All</button>
                                </div>
                            </div>
                        </div>

                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="custom-mini-table">
                                <table id="example3" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example3">
                                    <thead>
                                        <tr role="row">
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>Ours</th>
                                            <th>Others</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($attributes) > 0){
                                            foreach($attributes as $key => $item){
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="attribute_ids[]" class="attribute_ids" value="<?= $iem['id']?>"></td>
                                                <td><?= $item['ours']?></td>
                                                <td><?= $item['others']?></td>
                                                <td>
                                                    <div class="action-btns">
                                                        <!-- <a href="<?= $BASE_URL.$class_name?>view/<?= $neighbor_id?>/<?= $item['id']?>" style="color:#3c8dbc;padding: 5px;" title="view">
                                                            <i class="far fa-eye fa-lg"></i>
                                                        </a> -->
                                                        <a href="<?= $BASE_URL.$class_name?>attributeEdit/<?= $neighbor_id?>/<?= $item['id']?>" style="color:green;padding: 5px;" title="edit">
                                                            <i class="far fa-edit fa-lg"></i>
                                                        </a>
                                                        <a href="<?= $BASE_URL.$class_name?>attributeDelete/<?= $neighbor_id?>/<?= $item['id']?>" style="color:#d71b23;padding: 5px;" title="delete" onclick="return confirm('Are you sure you want to delete this attribute?');">
                                                            <i class="fa fa-trash fa-lg"></i>
                                                        </a>
                                                </div>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        } else {?>
                                            <tr>
                                            <td colspan="10" class="text-center">List Empty.</td>
                                            </tr>
                                        <?php
                                        }?>
                                    </tbody>
                                </table>
                                <p><?= $links?></p>
            </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col-->
    </div><!-- ./row -->
</section><!-- /.content -->
</div>
<script>
function searchAttribute(searchtext){
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
