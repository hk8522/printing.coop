<div class="content-wrapper" style="min-height: 687px;">
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="text-center" style="color:red">
                        <?= $this->session->flashdata('message_error')?>
                    </div>
                    <div class="text-center" style="color:green">
                        <?= $this->session->flashdata('message_success')?>
                    </div>

                    <div class="inner-head-section">
                        <div class="row align-items-end">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xs-12 text-left">
                                <div class="inner-title" style="margin-bottom: 20px;">
                                    <span><?= ucfirst($page_title)?></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-7 col-xl-4 col-xs-12 text-left">
                                <!----Serach Neighbor Html-->
                                <div class="search-box-area">
                                    <div class="search-sugg">
                                        <label class="span2">Search</label>
                                        <input class="form-control" type="text" placeholder="Search Neighbor"  onkeyup="searchNeighbor($(this).val())" id="searchSgedNeighborTextBox" name="searchSgedNeighborTextBox">
                                    </div>
                                    <div class="search-result" id="searchDiv" style="display:none"><!-- Add "active" class to show -->
                                        <a href="javascript:void(0)" onclick="hidesearchDiv()"><i class="fas fa-times" ></i></a>
                                        <ul id="NeighborListUl"></ul>
                                    </div>
                                </div>
                                <!----End Serach Neighbor Html-->
                            </div>
                            <div class="col-md-12 col-lg-5 col-xl-4 col-xs-12 text-left">
                                <div class="select-options">
                                    <form action="<?= $BASE_URL?>admin/Neighbor/index" method="post">
                                        <div>
                                            <label class="span2">Order By</label>
                                            <select class="form-control" onchange="this.form.submit()" name="order">
                                                <option value="desc" <?= $order=='desc' ? 'selected="selected"' : ''?>>Latest Neighbor</option>
                                                <option value="asc" <?= $order=='asc' ? 'selected="selected"' : ''?>>Oldest Neighbor</option>
                                            </select>
                                        </div>
                                        <div style="margin-left: 10px;">
                                            <a href="<?= $BASE_URL.$class_name?>"><button type="button">Reset</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-4 col-xs-12 text-right">
                                <div class="all-vol-btn">
            <form action="<?= $BASE_URL?>admin/Neighbor/deleteAll" method="post">
                                    <a href="<?= $BASE_URL . $class_name?>edit" style="margin-right: 5px;">
                                        <button type="button"><i class="fas fa-plus-circle"></i> Add New Neighbor</button>
                                    </a>
                                    <button><i class="fas fa-trash fa-lg"></i> Delete All</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="custom-mini-table">
                            <table id="example3" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example3">
                                <thead>
                                    <tr role="row">
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>Name</th>
                                        <th>URL</th>
                                        <th>Updated On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($list) > 0) {
                                        foreach ($list as $key => $item) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="neighbor_ids[]" class="neighbor_ids" value="<?= $iem['id']?>"></td>
                                            <td><?= ucfirst($item['name'])?></td>
                                            <td><a target="_blank" href="<?= $item['url']?>"><?= $item['url']?></a></td>
                                            <td><?= dateFormate($item['updated_at'])?></td>
                                            <td>
                                                <div class="action-btns">
                                                    <!-- <a href="<?= $BASE_URL.$class_name?>view/<?= $item['id']?>" style="color:#3c8dbc;padding: 5px;" title="view">
                                                        <i class="far fa-eye fa-lg"></i>
                                                    </a> -->
                                                    <a href="<?= $BASE_URL.$class_name?>edit/<?= $item['id']?>" style="color:green;padding: 5px;" title="edit">
                                                        <i class="far fa-edit fa-lg"></i>
                                                    </a>
                                                    <a href="<?= $BASE_URL.$class_name?>delete/<?= $item['id']?>" style="color:#d71b23;padding: 5px;" title="delete" onclick="return confirm('Are you sure you want to delete this neighbor?');">
                                                        <i class="fa fa-trash fa-lg"></i>
                                                    </a>
                                            </div>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } else{ ?>
                                        <tr>
                                        <td colspan="10" class="text-center">List Empty.</td>
                                        </tr>
                                    <?php
                                   } ?>
                                </tbody>
                            </table>
                            <p><?= $links?></p>
            </form>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
</script>
<script>
function searchNeighbor(searchtext) {
    if (searchtext !='') {
        $('#loader-img').show();
        var url ='<?= $BASE_URL?>admin/Neighbor/search';
        $('#searchDiv').show();
        $('#NeighborListUl').html('');
        $.ajax({
            type: "POST",
            url: url,
            data:{'searchtext':searchtext}, // serializes the form's elements.
                success: function(data)
                {   $('#loader-img').hide();
                    $('#NeighborListUl').html(data);
                },
                error: function (error) {
                }
        });
    } else {
        $('#searchDiv').hide();
        $('#NeighborListUl').html('');
        $('#searchSgedNeighborTextBox').val('');
    }
}

function hidesearchDiv() {
    $('#searchDiv').hide();
    $('#NeighborListUl').html('');
}

$('#select-all').click(function () {
    if ($(this).prop('checked') == true) {
        $('.neighbor_ids').prop('checked', true);
    } else {
        $('.neighbor_ids').prop('checked', false);
    }
});
</script>
