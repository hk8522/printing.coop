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
                                            <th>Service Image</th>
                                            <th>Service Name</th>
                                            <th>Website</th>
                                            <th>Created On</th>
                                            <th>Updated On</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($services) {
                                                foreach ($services as $key => $service) {
                                                    //pr($service);
                                                ?>
                                        <tr>
                                            <td>
                                              <?php $imageurl=getBannerImage($service['service_image'],'small');?>
                                              <img src="<?= $imageurl ?>" width="auto" height="80">
                                             </td>
                                            <td><?= ucfirst($service['name']) ?></td>
                                            <td><?= $MainStoreList[$service['main_store_id']] ?></td>
                                            <td>
                                                <?= dateFormate($service['created']) ?>
                                            </td>
                                            <td>
                                                <?= dateFormate($service['updated']) ?>
                                            </td>
                                            <td>
                                                <?php if ($service['status']==1) { ?>
                                                <a href="<?= $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?= $service['id'] ?>/0">
                                                <button type="submit" class="custon-active">Active
                                                </button>
                                                </a>
                                                <?php
                                                    } else{ ?>
                                                <a href="<?= $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?= $service['id'] ?>/1">
                                                <button type="submit" class="custon-delete">Inactive
                                                </button>
                                                </a>
                                                <?php
                                                   } ?>
                                            </td>
                                            <td>
                                                <a href="<?= $BASE_URL.$class_name.$sub_page_url?>/<?= $service['id'] ?>" style="color:green" title="edit">
                                                <i class="fa far fa-edit fa-lg"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable({
            "order": [[ 2, "asc" ]]
        });
    });
</script>
