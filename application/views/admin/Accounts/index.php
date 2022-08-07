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
                            <div class="row align-items-center">
                                <div class="col-md-6 col-xs-12 text-left">
                                    <div class="inner-title">
                                        <span><?= ucfirst($page_title) . ' List' ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 text-right">
                                    <div class="all-vol-btn">
                                        <a href="<?= $BASE_URL . $class_name . $sub_page_url ?>">
                                            <button><i class="fas fa-plus-circle"></i><?= $sub_page_title ?></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="custom-mini-table">
                                <table id="example1" class="table table-bordered table-striped dataTable no-footer"
                                    role="grid" aria-describedby="example1">
                                    <thead>
                                        <tr role="row">
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Store Name</th>
                                            <th>Username</th>
                                            <th>Password</th>

                                            <th>Created On</th>
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
                                                    <td><?= ucfirst($list['name']) ?></td>

                                                    <td><?= $list['email'] ?></td>
                                                    <td><?= ucfirst($list['mobile']) ?></td>
                                                    <td>
                                                        <?php $store_ids = explode(',', $list['store_ids']);
                                                        foreach ($store_ids as $val) {
                                                            echo $stores[$val] . "<br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?= $list['username'] ?>
                                                    </td>

                                                    <td>*****</td>
                                                    <td>
                                                        <?= dateFormate($list['created']) ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($list['status'] == 1) { ?>
                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_url_active_inactive ?>/<?php ?><?= $list['id'] ?>/0/<?= $page_status ?>">
                                                                <button type="submit" class="custon-active">Active</button>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_url_active_inactive ?>/<?php ?><?= $list['id'] ?>/1/<?= $page_status ?>">
                                                                <button type="submit" class="custon-delete">Inactive</button>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="action-btns">
                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_url ?>/<?= $list['id'] ?>"
                                                                style="color:green;padding: 5px;" title="edit">
                                                                <i class="far fa-edit fa-lg"></i>
                                                            </a>
                                                            <a href="<?= $BASE_URL . $class_name . $sub_page_delete_url ?>/<?= $list['id'] ?>/<?= $page_status ?>"
                                                                style="color:#d71b23" title="delete"
                                                                onclick="return confirm('Are you sure you want to delete this sub admin?');">
                                                                <i class="fa fa-trash fa-lg"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                        <tr>
                                            <td colspan="11	" class="text-center">List Empty.</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
$(document).ready(function() {
    $('#example1').DataTable({
        "order": [
            [3, "asc"]
        ]
    });
});
</script>