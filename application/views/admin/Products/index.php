<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center" style="color:red">
                            <?= $this->session->flashdata('message_error') ?>
                        </div>
                        <div class="text-center" style="color:green">
                            <?= $this->session->flashdata('message_success') ?>
                        </div>

                        <div class="inner-head-section">
                            <div class="row align-items-end">
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xs-12 text-left">
                                    <div class="inner-title" style="margin-bottom: 20px;">
                                        <span><?= ucfirst($page_title) ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-7 col-xl-4 col-xs-12 text-left">
                                    <!----Serach Product Html-->
                                    <div class="search-box-area">
                                        <div class="search-sugg">
                                            <label class="span2">Search</label>
                                            <input class="form-control" type="text" placeholder="Search Product"
                                                onkeyup="searchProduct($(this).val())" id="searchSgedProductTextBox"
                                                name="searchSgedProductTextBox">
                                            <!--<button type="button"><i class="fas fa-search"></i></button>-->
                                        </div>
                                        <div class="search-result" id="searchDiv" style="display:none">
                                            <!-- Add "active" class to show -->
                                            <a href="javascript:void(0)" onclick="hidesearchDiv()"><i
                                                    class="fas fa-times"></i></a>
                                            <ul id="ProductListUl">

                                            </ul>
                                        </div>
                                    </div>
                                    <!----End Serach Product Html-->
                                </div>
                                <div class="col-md-12 col-lg-5 col-xl-4 col-xs-12 text-left">
                                    <div class="select-options">
                                        <form action="<?= $BASE_URL ?>admin/Products/index" method="post">
                                            <div>
                                                <label class="span2">Order By</label>
                                                <select class="form-control" onchange="this.form.submit()" name="order">
                                                    <option value="desc"
                                                        <?= $order == 'desc' ? 'selected="selected"' : '' ?>>
                                                        Latest Product</option>
                                                    <option value="asc"
                                                        <?= $order == 'asc' ? 'selected="selected"' : '' ?>>
                                                        Oldest Product</option>
                                                </select>
                                            </div>
                                            <div style="margin-left: 10px;">
                                                <a href="<?= $BASE_URL . $class_name ?>"><button
                                                        type="button">Reset</button></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-4 col-xs-12 text-right">
                                    <div class="all-vol-btn">
                                        <form action="<?= $BASE_URL ?>admin/Products/deleteAllProduct"
                                            method="post">
                                            <a href="<?= $BASE_URL . $class_name . $sub_page_url ?>"
                                                style="margin-right: 5px;">
                                                <button type="button"><i
                                                        class="fas fa-plus-circle"></i><?= $sub_page_title ?></button>
                                            </a>
                                            <button><i class="fas fa-trash fa-lg"></i>Delete All</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="custom-mini-table">
                                <table id="example3" class="table table-bordered table-striped dataTable no-footer"
                                    role="grid" aria-describedby="example3">
                                    <thead>
                                        <tr role="row">
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>Product Name</th>
                                            <th>Image</th>
                                            <th>List Price CAD</th>
                                            <!--<th>List Price EURO</th>
                                        <th>List Price GBP</th>
                                        <th>List Price USD</th>-->
                                            <th>Sub Category</th>
                                            <th>Category</th>
                                            <th>Stock</th>
                                            <th>Code</th>
                                            <th>Model</th>
                                            <th>Updated On</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (count($lists) > 0) {
                                            foreach ($lists as $key => $list) {
                                                ?>
                                                <tr>
                                                    <td><input type="checkbox" name="product_ids[]" class="product_ids"
                                                            value="<?= $list['id'] ?>">
                                                    </td>
                                                    <td>
                                                        <?= ucfirst($list['name']) ?>
                                                    </td>
                                                    <td>
                                                        <?php $imageurl = getProductImage($list['product_image']);?>
                                                        <img src="<?= $imageurl ?>" width="auto" height="80">
                                                    </td>
                                                    <td>
                                                        <?= number_format($list['price'], 2) ?>
                                                    </td>
                                                    <!--<td>
                                                        <?= number_format($list['price_euro'], 2) ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($list['price_gbp'], 2) ?>
                                                    </td>
                                                    <td>
                                                        <?= number_format($list['price_usd'], 2) ?>
                                                    </td>-->

                                                    <td>
                                                        <?= ucfirst($list['sub_category_name']) ?>
                                                    </td>
                                                    <td>
                                                        <?= ucfirst($list['category_name']) ?>
                                                    </td>
                                                    <td>
                                                        <?php if (empty($list['is_stock'])) {
                                                            echo 'In Stock';
                                                        } else {
                                                            echo 'Out of Stock';
                                                       } ?>
                                                    </td>
                                                    <td>
                                                        <?= $list['code'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $list['model'] ?>
                                                    </td>
                                                    <td>
                                                        <?= dateFormate($list['updated']) ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($list['status'] == 1) { ?>
                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_url_active_inactive ?>/<?php ?><?= $list['id'] ?>/0">
                                                                <button type="button" class="custon-active">Active</button>
                                                            </a>
                                                        <?php } else{ ?>
                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_url_active_inactive ?>/<?php ?><?= $list['id'] ?>/1">
                                                                <button type="button" class="custon-delete">Inactive</button>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_view_url ?>/<?= $list['id'] ?>"
                                                                style="color:#3c8dbc;padding: 5px;" title="view">
                                                                <i class="far fa-eye fa-lg"></i>
                                                            </a>
                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_url ?>/<?= $list['id'] ?>"
                                                                style="color:green;padding: 5px;" title="edit">
                                                                <i class="far fa-edit fa-lg"></i>
                                                            </a>

                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_delete_url ?>/<?= $list['id'] ?>"
                                                                style="color:#d71b23;padding: 5px;" title="delete"
                                                                onclick="return confirm('Are you sure you want to delete this product?');">
                                                                <i class="fa fa-trash fa-lg"></i>
                                                            </a>
                                                            <a href="<?= $BASE_URL . $class_name ?>SetMultipleAttributes/<?= $list['id'] ?>"
                                                                style="color:geen;padding: 5px;" title="Set Single Attribute">
                                                                <button type="button" class="custon-active">Multiple Attribute</button>
                                                            </a>
                                                            <a href="<?= $BASE_URL . $class_name ?>SetMultipleAttributesAuto/<?= $list['id'] ?>"
                                                                style="color:geen;padding: 5px;" title="Set Single Attribute">
                                                                <button type="button" class="custon-active">Multiple Attribute
                                                                    (Automatic)</button>
                                                            </a>
                                                            <a href="<?= $BASE_URL . $class_name ?>SetSingleAttributes/<?= $list['id'] ?>"
                                                                style="color:#geen;padding: 5px;" title="Set Single Attribute">
                                                                <button type="button" class="custon-active">Single Attribute</button>
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
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <p><?= $links ?></p>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    </form>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
</script>
<script>
/*$(document).ready(function() {
        $('#example1').DataTable({
            //"order": [[ 3, "asc" ]]
        });
    });*/

function searchProduct(searchtext) {
    if (searchtext != '') {
        $("#loader-img").show();
        var url = '<?= $BASE_URL ?>admin/Products/searchProduct';
        $("#searchDiv").show();
        $("#ProductListUl").html('');
        $.ajax({
            type: "POST",
            url: url,
            data: {
                'searchtext': searchtext
            }, // serializes the form's elements.
            success: function(data) {
                $("#loader-img").hide();
                $("#ProductListUl").html(data);
            },
            error: function(error) {}
        });
    } else {
        $("#searchDiv").hide();
        $("#ProductListUl").html('');
        $("#searchSgedProductTextBox").val('');
    }
}

function hidesearchDiv() {
    $("#searchDiv").hide();
    $("#ProductListUl").html('');
}

$("#select-all").click(function() {
    if ($(this).prop("checked") == true) {
        $(".product_ids").prop('checked', true);
    } else {
        $(".product_ids").prop('checked', false);
    }
});
</script>