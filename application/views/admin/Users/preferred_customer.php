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
                    <div class="inner-title">
                        <span><?= ucfirst($page_title).' List' ?></span>
                    </div>
                </div>

                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="custom-mini-table">
                        <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
                            <thead>
                                <tr role="row">
                                    <th>Customer Code</th>
                                    <th>Website</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Company Name</th>
                                    <th>Responsible Name</th>
                                    <th>cp</th>
                                    <th>Active Area</th>
                                    <th>Address</th>
                                    <th>Country</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Zip Code</th>
                                    <th>Request</th>

                                    <th>Last Login</th>
                                    <th>Last Login IP</th>
                                    <th>Created On</th>
                                    <th>Updated On</th>
                                    <th>Verify</th>
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
                                            <td><?= CUSTOMER_ID_PREFIX.$list['id'] ?></td>
                                            <td><?= $StoreList[$list['store_id']]['name'] ?></td>
                                            <td><?= ucfirst($list['name']) ?></td>
                                            <td>
                                            <?= ucfirst($list['mobile']) ?></td>
                                            <td><?= ucfirst($list['email']) ?></td>
                                            <!--<td>Username</td>-->
                                            <td>*****</td>
                                            <td><?= ucfirst($list['company_name']) ?></td>
                                            <td><?= ucfirst($list['responsible_name']) ?></td>
                                            <td><?= ucfirst($list['cp']) ?></td>
                                            <td><?= ucfirst($list['active_area']) ?></td>
                                            <td><?= ucfirst($list['address']) ?></td>
                                            <td>
                                            <?php

                                            $country=$this->Address_Model->getCountryById($list['country']);
                                            echo $country['CountryName'];

                                            ?></td>
                                            <td><?php
                                            $steate=$this->Address_Model->getStateById($list['region']);
                                            echo $steate['StateName'];

                                            ?></td>
                                            <td><?= ucfirst($list['city']) ?></td>
                                            <td><?= ucfirst($list['zip_code']) ?></td>
                                            <td><?= ucfirst($list['request']) ?></td>
                                            <td>
                                                  <?= dateFormate($list['last_login']) ?>
                                            </td>
                                            <td>

                                                  <?= $list['last_login_ip'] ?>
                                            </td>
                                            <td>
                                                  <?= dateFormate($list['created']) ?>
                                            </td>
                                            <td>
                                                  <?= dateFormate($list['updated']) ?>
                                            </td>
                                            <td>
                                                <?php if ($list['preferred_status']==1) { ?>
                                                    <a href="<?= $BASE_URL.$class_name.'activeInactiveUserType'?>/<?php ?><?= $list['id']?>/0/<?= $page_status ?>">
                                                         <button type="submit" class="custon-active">Verified</button>
                                                    </a>
                                                <?php
                                                } else {
                                                    ?>
                                                       <a href="<?= $BASE_URL.$class_name.'activeInactiveUserType'?>/<?php ?><?= $list['id']?>/1/<?= $page_status ?>">
                                                         <button type="submit" class="custon-delete">Unverified</button>
                                                       </a>
                                                <?php
                                               } ?>
                                            </td>
                                            <td>
                                                <?php if ($list['status']==1) { ?>
                                                    <a href="<?= $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?= $list['id']?>/0/<?= $page_status ?>">
                                                         <button type="submit" class="custon-active">Active</button>
                                                    </a>
                                                <?php
                                                } else{ ?>
                                                       <a href="<?= $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?= $list['id']?>/1/<?= $page_status ?>">
                                                         <button type="submit" class="custon-delete">Inactive</button>
                                                       </a>
                                                <?php
                                               } ?>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    <!-- need a same popup view coming in All Orders(view button) -->
                                                    <a class="view-btn" href="<?= $BASE_URL?>admin/Orders/index/all/<?= $list['id'] ?>" style="color:#3c8dbc" title="View orders">
                                                         <i class="fa far fa-eye fa-lg"></i> View orders
                                                       </a>

                                                    <!--<a class="view-btn" href="<?= $BASE_URL?>admin/Users/wishlists/<?= $list['id']?>/<?= $page_status ?>" style="color:#3c8dbc" title="View Wishlists">
                                                         <i class="fa far fa-eye fa-lg"></i> View Wishlists
                                                       </a>-->
                                                       <!-- <a href="<?= $BASE_URL.$class_name.$sub_page_url?>/<?= $list['id'] ?>/<?= $page_status ?>" style="color:green" title="edit">
                                                        <i class="fa far fa-edit fa-lg"></i>
                                                       </a> -->
                                                    <a class="view-btn" href="<?= $BASE_URL?>admin/Users/changePassword/<?= $list['id'] ?>/all/preferred-customer" style="color:#3c8dbc" title="View orders">
                                                         <i class="fa far fa-eye fa-lg"></i> Change Password
                                                       </a>
                                                       <a href="<?= $BASE_URL.$class_name.$sub_page_delete_url?>/<?= $list['id'] ?>/<?= $page_status ?>" style="color:#d71b23" title="delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                                        <i class="fa fa-trash fa-lg"></i>
                                                       </a>
                                                   </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else{ ?>
                                    <tr>
                                    <td colspan="11	" class="text-center">List Empty.</td>
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
        "order": [[ 0, "desc" ]]
    });
});
</script>
