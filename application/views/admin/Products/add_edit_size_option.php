<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span><?php echo $page_title?></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                    <div class="text-center" style="color:red">
                                        <?php echo $this->session->flashdata('message_error');?>
                                    </div>
                                    <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                                     <input class="form-control" name="id" type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>" id="id">
                                     <div class="form-role-area">
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Name" value='<?php echo isset($postData['name']) ? $postData['name']:'';?>' maxlength="50">
                                                    <?php echo form_error('name');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">French Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="name_french" id="name_french" type="text" placeholder="French Name" value='<?php echo isset($postData['name_french']) ? $postData['name_french']:'';?>' maxlength="50">
                                                    <?php echo form_error('name_french');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-role-area">
                                        <?php if($type=='page_size'){?>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Total Page</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input type="number" class="form-control" name="total_page" id="total_page" type="text" placeholder="Total Page" value='<?php echo isset($postData['total_page']) ? $postData['total_page']:''?>' required>
                                                    <?php echo form_error('total_page');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }?>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success" id="submitBtn" >Submit</button>
                                            <a href="<?php echo $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
                                        </div>
                                    </div>
                                     <?php echo form_close();?>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
 </div>
 <script>

    //$("#submitBtn").attr("disabled", false);

    $('#menu_id').on('change', function (e) {
        var menu_id=$(this).val();
        $("#category_id").html('<option value="">Select Category</option>');
        $("#sub_category_id").html('<option value="">Select Sub Category</option>');
        $("#product_id").html('<option value="">Select Product Name </option>');

        $.ajax({
                type: 'GET',
                dataType: 'html',
                url: '<?php echo $BASE_URL ?>admin/Ajax/getCategoryDropDownListByAjax/'+menu_id,
                //data:{'menu_id':menu_id},
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#category_id").html(data);
                }
        });
    });

    $('#category_id').on('change', function (e) {
        $("#sub_category_id").html('<option value="">Select Sub Category</option>');

        $("#product_id").html('<option value="">Select Product Name </option>');

        var menu_id=$("#menu_id").val();
        var category_id=$(this).val();
        $("#sub_category_id").html('<option value="">Select Sub Category</option>');
        $.ajax({
                type: 'GET',
                dataType: 'html',
                url: '<?php echo $BASE_URL ?>admin/Ajax/getSubCategoryDropDownListByAjax/'+category_id,
                //data:{'menu_id':menu_id},
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#sub_category_id").html(data);
                }
        });
    });

    $('#sub_category_id').on('change', function (e) {
        $("#product_id").html('<option value="">Select Product Name </option>');

        var menu_id=$("#menu_id").val();
        var category_id=$("#category_id").val();
        var sub_category_id=$(this).val();
        $.ajax({
                type: 'GET',
                dataType: 'html',
                url: '<?php echo $BASE_URL ?>admin/Ajax/getProductDropDownListByAjax/'+menu_id+'/'+category_id+'/'+sub_category_id,
                //data:{'menu_id':menu_id},
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#product_id").html(data);
                }
        });
    });

 </script>
