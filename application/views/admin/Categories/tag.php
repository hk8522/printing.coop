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
                                        <span>Tags</span>
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
                                           <th class="hidden"></th>
                                            <th>Name</th>
                                            <th>Tag Order</th>
                                            <th>Status</th>
                                            <th>Created On</th>
                                            <th>Updated On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($lists) {
                                            foreach ($lists as $key => $list) {
                                            ?>
                                        <tr>
                                            <td class="hidden"></td>
                                            <td><?= $list['name'] ?></td>
                                            <td><?= $list['tag_order'] ?></td>
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
                                                <?= dateFormate($list['created']) ?>
                                            </td>
                                            <td>
                                                <?= dateFormate($list['updated']) ?>
                                            </td>
                                            <td>
                                                <a href="<?= $BASE_URL.$class_name.$sub_page_url?>/<?= $list['id'] ?>" style="color:green" title="edit">
                                                <i class="fa far fa-edit fa-lg"></i>
                                                </a>
                                                &nbsp;&nbsp;
                                                <a href="<?= $BASE_URL.$class_name.$sub_page_delete_url?>/<?= $list['id'] ?>" style="color:#d71b23" title="delete" onclick="return confirm('Are you sure you want to delete this tag?');">
                                                  <i class="fa fa-trash fa-lg"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                            } else{ ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Tag Empty.</td>
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
