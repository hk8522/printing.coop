<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span><?= $page_title ?></span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red">
                                        <?= $this->session->flashdata('message_error') ?>
                                    </div>
                                    <?= form_open_multipart('',array('class' => 'form-horizontal')) ?>
                                     <input class="form-control" name="id" type="hidden"  value="<?= isset($postData['id']) ? $postData['id']:'' ?>" id="id">
                                     <div class="form-role-area">
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">Attribute Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="name" id="name" type="text" placeholder="Attribute Name" value='<?= isset($postData['name']) ? $postData['name']:'' ?>'  required>
                                                        <?= form_error('name') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <label class="span2" for="inputMame">French Attribute Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls">
                                                        <input class="form-control" name="name_french" id="name_french" type="text" placeholder="French Attribute Name" value='<?= isset($postData['name_french']) ? $postData['name_french']:'' ?>'  required>
                                                        <?= form_error('name_french') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-3" style="">
                                                    <label class="span2" for="inputMame">Attribute Items Add</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="controls file-data">
                                                        <?php
                                                        if (!empty($productItemData)) {
                                                            $last=count($productItemData)-1;

                                                            foreach ($productItemData as $key => $val) { //pr($val);?>
                                                                <div class="att-single">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                              <label>Attribute Item Name</label>
                                                                              <input class="form-control" name="attribute_item_name[]" id="attribute_item_name" type="text" placeholder="Attribute Item"  required value='<?= $val['item_name'] ?>'>
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                              <label>French Attribute Item Name</label>
                                                                              <input class="form-control" name="item_name_french[]" id="item_name_french" type="text" placeholder="French Attribute Item"  required value='<?= $val['item_name_french'] ?>'>
                                                                              <input class="form-control" name="attribute_item_id[]" id="attribute_item_id" type="hidden" maxlength="50" value="<?= $val['id'] ?>">
                                                                          </div>
                                                                      </div>
                                                                    <div class="add-new-btn">
                                                                        <?php
                                                                        $displayplusnbtn='none';
                                                                           $displayminusbtn='';
                                                                        if ($last==0) {
                                                                            $displayplusnbtn='';
                                                                            $displayminusbtn='none';
                                                                        } else if ($last==$key) {
                                                                           $displayplusnbtn='';
                                                                           $displayminusbtn='';
                                                                        }
                                                                        ?>
                                                                        <button class="btn-danger btn-remove" type="button" title="remove" style="display:<?= $displayminusbtn ?>">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                        <button class="btn-success btn-add" type="button" style="display:<?= $displayplusnbtn ?>">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                          }
                                                        } else{?>
                                                        <div class="att-single">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Attribute Item Name</label>
                                                                    <input class="form-control" name="attribute_item_name[]" id="attribute_item_name" type="text" placeholder="Attribute Item"  required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>French Attribute Item Name</label>
                                                                    <input class="form-control" name="item_name_french[]" id="item_name_french" type="text" placeholder="French Attribute Item"  required>
                                                                    <input class="form-control" name="attribute_item_id[]" id="attribute_item_id" type="hidden" maxlength="50" value="">
                                                                </div>
                                                            </div>
                                                            <div class="add-new-btn">
                                                         <button class="btn-danger btn-remove" type="button"style="display:none">
                                                                       <i class="fa fa-minus"></i>
                                                                   </button>
                                    <button class="btn-success btn-add" type="button">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <?php
                                                       } ?>
                                                        <div style="color:red">
                                                            <?= $this->session->flashdata('file_message_error') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success" id="submitBtn" >Submit</button>
                                            <a href="<?= $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
                                        </div>
                                    </div>
                                     <?= form_close() ?>
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

     $(function() {
        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            var controlForm = $('.file-data:first'),
            currentEntry = $(this).parents('.att-single:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
            newEntry.find('input').val('');
            var timestamp = new Date().getUTCMilliseconds();
            newEntry.find('input').attr('id',timestamp);
            newEntry.find('.btn-remove').show();
            controlForm.find('.btn-remove').show();
            controlForm.find('.btn-add').hide();
            newEntry.find('.btn-add').show();
        }).on('click', '.btn-remove', function(e)
        {
            $(this).parents('.att-single:first').remove();
            e.preventDefault();
            var numItems = $('.file-data .att-single').length;

            if (numItems==1) {
            var controlForm = $('.file-data .att-single').last();
            controlForm.find('.btn-remove').hide();
            controlForm.find('.btn-add').show();
            } else{
                var controlForm = $('.file-data .att-single').last();
                controlForm.find('.btn-remove').show();
                controlForm.find('.btn-add').show();
            }

            return false;
        });
    });
 </script>
