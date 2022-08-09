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
                    <div class="row">
                        <div class="col-md-6 col-xs-12 text-left">
                            <div class="inner-title">
                                <span><?= ucfirst($page_title).' List' ?></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 text-right">
                            <div class="all-vol-btn">
                            <!--<a href="<?= $BASE_URL.$class_name.$sub_page_url ?>"><button>
                            <i class="fa fas fa-plus-circle"></i><?= $sub_page_title ?></button>
                            </a>-->

                            </div>
                        </div>
                    </div>
                </div>

                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="col-sm-12 col-md-12 custom-mini-table">
                        <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
                            <thead>
                                <tr role="row">
                                    <!--<th width="10%">Sn</th>-->
                                    <th width="30%">Subscribe Email</th>
                                    <th width="20%">Website</th>
                                    <th width="15%">Created On</th>
                                    <th width="15%">Updated On</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (count($lists) > 0) {
                                    $i=1;
                                    foreach ($lists as $key => $list) {
                                    ?>
                                        <tr>
                                            <!--<td><?= $i; $i++ ?></td>-->

                                            <td class="text-left"><?= $list['email'] ?></td>
                                            <td><?= $StoreList[$list['store_id']]['name'] ?></td>
                                            <td>
                                              <?= dateFormate($list['created']) ?>
                                            </td>
                                            <td>
                                              <?= dateFormate($list['updated']) ?>
                                            </td>
                                            <td>
                                               <a href="<?= $BASE_URL.$class_name.$sub_page_delete_url?>/<?= $list['id'] ?>" style="color:#d71b23;padding: 5px;" title="delete" onclick="return confirm('Are you sure you want to delete this email?');">
                                                     <i class="fa fa-trash fa-lg"></i>
                                               </a>

                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else{ ?>
                                    <tr>
                                    <td colspan="6" class="text-center">List Empty.</td>
                                    </tr>
                                <?php
                               } ?>
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
        "order": [[ 2, "desc" ]]
    });
});
</script>
