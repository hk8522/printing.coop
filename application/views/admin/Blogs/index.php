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
                            <a href="<?php echo $BASE_URL.$class_name.$sub_page_url?>"><button>
                            <i class="fas fa-plus-circle"></i><?php echo $sub_page_title ?></button>
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
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Blog Category</th>
                                    <th>Populer</th>
                                    <th>Created On</th>
                                    <th>Updated On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                if(count($blogs) > 0){
                                    foreach($blogs as $key=>$blog){
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo ucfirst($blog['title']);?>
                                            </td>
                                             <td>
                                              <?php
                                              $imageurl=getBlogImage($blog['image']);

                                              ?>
                                              <img src="<?php echo $imageurl?>" width="100" height="80">
                                             </td>

                                            <td>
                                <?php echo ucfirst($blog['category_name']);?>
                                             </td>
                                            <td>

                                               <?php echo isset($blog['populer'])  && $blog['populer'] ==1 ? 'Yes':'No';
                                               ?>

                                             </td>
                                            <td>
                                      <?php echo dateFormate($blog['created']);?>
                                            </td>

                                            <td>
                                      <?php echo dateFormate($blog['updated']);?>
                                            </td>
                                            <td>
                                            <?php if($blog['status']==1){?>
                                            <a href="<?php echo $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?php echo $blog['id']?>/0">
                                             <button type="submit" class="custon-active">Active
                                             </button>
                                            </a>
                                            <?php
                                            }else{?>
                                               <a href="<?php echo $BASE_URL.$class_name.$sub_page_url_active_inactive?>/<?php ?><?php echo $blog['id']?>/1">
                                                 <button type="submit" class="custon-delete">Inactive
                                                  </button>
                                               </a>
                                            <?php
                                            }?>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                   <a href="<?php echo $BASE_URL.$class_name.$sub_page_url?>/<?php echo $blog['id'];?>" style="color:green;padding: 5px;" title="edit">
                                                        <i class="far fa-edit fa-lg"></i>
                                                   </a>
                                               <a href="<?php echo $BASE_URL.$class_name.$sub_page_view_url?>/<?php echo $blog['id'];?>" style="color:#3c8dbc;padding: 5px;" title="view">
                                                    <i class="far fa-eye fa-lg"></i>
                                               </a>
                                               <a href="<?php echo $BASE_URL.$class_name.$sub_page_delete_url?>/<?php echo $blog['id'];?>" style="color:#d71b23;padding: 5px;" title="delete" onclick="return confirm('Are you sure you want to delete this blog?');">
                                                     <i class="fa fa-trash fa-lg"></i>
                                               </a>
                                               </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }else{?>
                                    <tr>
                                    <td colspan="10" class="text-center">List Empty.</td>
                                    </tr>
                                <?php
                                }?>
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
$(document).ready(function(){
    $('#example1').DataTable({
        "order": [[ 2, "desc" ]]
    });
});
</script>
