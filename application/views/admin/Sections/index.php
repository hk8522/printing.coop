<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center" style="color:red">
                            <?php echo $this->session->flashdata('message_error');?>
                        </div>
                        <div class="text-center" style="color:green">
                            <?php echo $this->session->flashdata('message_success');?>
                        </div>
                        <div class="inner-head-section">
                            <div class="row">
                                <div class="col-md-6 col-xs-12 text-left">
                                    <div class="inner-title">
                                        <span><?php echo ucfirst($page_title).' List'; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 text-right">
                                    <div class="all-vol-btn">
                                        <!--<a href="<?php echo $BASE_URL.$class_name.$sub_page_url?>"><button>
                                        <i class="fas fa-plus-circle"></i><?php echo $sub_page_title ?></button>
                                        </a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="custom-mini-table">
                                <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
                                    <thead>
                                        <tr role="row">
                                            <th>Section Name</th>
                                            <th>Website</th>
                                            <th>Created On</th>
                                            <th>Updated On</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($sections){
                                                foreach($sections as $key=>$sections){
                                                ?>
                                        <tr>
                                            <td><?php echo ucfirst($sections['name']);?></td>
                                            <td>
                                               <?php echo $MainStoreList[$sections['main_store_id']]?>
                                            </td>
                                            <td>
                                                <?php echo dateFormate($sections['created']);?>
                                            </td>
                                            <td>
                                                <?php echo dateFormate($sections['updated']);?>
                                            </td>
                                            <td>
                                                <?php if($sections['status']==1){?>
                                                <a href="<?php echo $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?php echo $sections['id']?>/0">
                                                <button type="submit" class="custon-active">Active
                                                </button>
                                                </a>
                                                <?php
                                                    }else{?>
                                                <a href="<?php echo $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?php echo $sections['id']?>/1">
                                                <button type="submit" class="custon-delete">Inactive
                                                </button>
                                                </a>
                                                <?php
                                                    }?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $BASE_URL.$class_name.$sub_page_url?>/<?php echo $sections['id'];?>" style="color:green" title="edit">
                                                <i class="far fa-edit fa-lg"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                            }else{?>
                                        <tr>
                                            <td colspan="7" class="text-center">List Empty.</td>
                                        </tr>
                                        <?php
                                            }?>
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
    $(document).ready(function(){
        $('#example1').DataTable({
            "order": [[ 0, "asc" ]]
        });
    });
</script>
