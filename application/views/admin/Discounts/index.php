<?php $DiscountTypeArray=getDiscountType();?>
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
                            <a href="<?= $BASE_URL.$class_name.$sub_page_url ?>"><button>
                            <i class="fa fas fa-plus-circle"></i><?= $sub_page_title ?></button>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="custom-mini-table">
                        <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
                            <thead>
                                <tr role="row">
                                    <th>Discount Code</th>
                                    <th>Discount</th>
                                    <th>Discount Valid From</th>
                                    <th>Discount Valid Till</th>
                                    <!--<th>Discount Requirement Quantity</th>
                                    <th>Discount Limit Quantity</th>-->

                                    <th>Created On</th>
                                    <th>Updated On</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (count($lists) > 0) {
                                    foreach ($lists as $key => $list) {
                                        $discount_valid_to_str_time=strtotime($list['discount_valid_to']);

                                        $cr_date=date("Y-m-d H:i:s");
                                        $cr_date_str=strtotime($cr_date);
                                        if ($type=="current" && $cr_date_str <=$discount_valid_to_str_time) {
                                    ?>
                                        <tr>
                                            <td><?= $list['code'] ?></td>
                                            <td>
                                            <?php

                                            if ($list['discount_type']=='discount_percent') {
                                                echo number_format($list['discount'],2)."%";
                                            } else {
                                                echo "$".number_format($list['discount'],2);
                                            }
                                            ?>
                                            </td>
                                            <td>
                                              <?= dateFormate($list['discount_valid_from']) ?>
                                            </td>

                                             <td>
                                              <?= dateFormate($list['discount_valid_to']) ?>
                                            </td>

                                            <!--<td>
                                    <?php echo $list['discount_requirement_quantity'];
                                                ?>
                                            </td>
                                            <td>
                                <?php echo $list['discount_code_limit'];
                                                ?>
                                            </td>-->

                                            <td>
                                              <?= dateFormate($list['created']) ?>
                                            </td>

                                            <td>
                                              <?= dateFormate($list['updated']) ?>
                                            </td>

                                            <td>
                                            <?php if ($list['status']==1) { ?>
                                            <a href="<?= $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?= $list['id'] ?>/0">
                                             <button type="submit" class="custon-active">Active
                                             </button>
                                            </a>
                                            <?php
                                            } else{ ?>
                                               <a href="<?= $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?= $list['id'] ?>/1">
                                                 <button type="submit" class="custon-delete">Inactive
                                                  </button>
                                               </a>
                                            <?php
                                           } ?>
                                            </td>
                                            <td>
                                            <div class="action-btns">
                                             <a class="view-btn" href="<?= $BASE_URL?>admin/Products/index/<?= $list['id'] ?>" style="color:#3c8dbc" title="view">

                                                    <i class="fa far fa-eye fa-lg"></i> View Products

                                                </a>

                                               <a href="<?= $BASE_URL.$class_name.$sub_page_url?>/<?= $list['id'] ?>" style="color:green" title="edit">
                                                    <i class="fa far fa-edit fa-lg"></i>
                                               </a>
                                                &nbsp;&nbsp;
                                               <a href="<?= $BASE_URL.$class_name.$sub_page_delete_url?>/<?= $list['id'] ?>" style="color:red" title="delete" onclick="return confirm('Are you sure you want to delete this discount code?');">
                                                  <i class="fa fa-trash fa-lg"></i>
                                               </a>
                                               </div>

                                            </td>
                                        </tr>
                                <?php   } else if ($type=="expired" && $cr_date_str > $discount_valid_to_str_time) { ?>

                                           <tr>
                                            <td><?= $list['code'] ?></td>
                                            <td>
                                            <?php

                                            if ($list['discount_type']=='discount_percent') {
                                                echo number_format($list['discount'],2)."%";
                                            } else {
                                                echo "$".number_format($list['discount'],2);
                                            }
                                            ?>
                                            </td>
                                            <td>
                                              <?= dateFormate($list['discount_valid_from']) ?>
                                            </td>

                                             <td>
                                              <?= dateFormate($list['discount_valid_to']) ?>
                                            </td>

                                            <!--<td>
                                           <?php echo $list['discount_requirement_quantity'];
                                                ?>
                                            </td>
                                            <td>
                                          <?php echo $list['discount_code_limit'];
                                                ?>
                                            </td>-->

                                            <td>
                                              <?= dateFormate($list['created']) ?>
                                            </td>

                                            <td>
                                              <?= dateFormate($list['updated']) ?>
                                            </td>

                                            <td>
                                            <?php if ($list['status']==1) { ?>
                                            <a href="<?= $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?= $list['id'] ?>/0">
                                             <button type="submit" class="custon-active">Active
                                             </button>
                                            </a>
                                            <?php
                                            } else{ ?>
                                               <a href="<?= $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?= $list['id'] ?>/1">
                                                 <button type="submit" class="custon-delete">Inactive
                                                  </button>
                                               </a>
                                            <?php
                                           } ?>
                                            </td>
                                            <td>
                                            <div class="action-btns">
                                             <!--<a class="view-btn" href="<?= $BASE_URL?>admin/Products/index/<?= $list['id'] ?>" style="color:#3c8dbc" title="view">

                                                    <i class="fa far fa-eye fa-lg"></i> View Products

                                                </a>-->

                                               <a href="<?= $BASE_URL.$class_name.$sub_page_url?>/<?= $list['id'] ?>" style="color:green" title="edit">
                                                    <i class="fa far fa-edit fa-lg"></i>
                                               </a>
                                                &nbsp;&nbsp;
                                               <a href="<?= $BASE_URL.$class_name.$sub_page_delete_url?>/<?= $list['id'] ?>" style="color:red" title="delete" onclick="return confirm('Are you sure you want to delete this discount code?');">
                                                  <i class="fa fa-trash fa-lg"></i>
                                               </a>
                                               </div>

                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                } else{ ?>
                                    <tr>
                                    <td colspan="7" class="text-center">List Empty.</td>
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
        "order": [[ 2, "asc" ]]
    });
});
</script>
