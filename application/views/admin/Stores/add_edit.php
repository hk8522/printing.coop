<script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center" style="color:red">
                                        <?= $this->session->flashdata('message_error') ?>
                                    </div>
                                    <?= form_open_multipart('',array('class' => 'form-horizontal')) ?>
                                    <input class="form-control" name="id" type="hidden"  value="<?= isset($postData['id']) ? $postData['id'] : '' ?>" id="id">
                                    <div class="form-role-area">
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
  <input class="form-control" name="name" id="name" type="text" placeholder="Name" value="<?= isset($postData['name']) ? $postData['name'] : '' ?>" >
                                              <?= form_error('name') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Phone</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="phone" id="phone" type="text" placeholder="Phone" value="<?= isset($postData['phone']) ? $postData['phone'] : '' ?>" >
                                                        <?= form_error('phone') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Email</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="email" id="email" type="email" placeholder="Email" value="<?= isset($postData['email']) ? $postData['email'] : '' ?>" >
                                                        <?= form_error('email') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Url</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="url" id="url" type="url" placeholder="Url" value="<?= isset($postData['url']) ? $postData['url'] : '' ?>" >
                                                        <?= form_error('url') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">
                                                    Store Langue
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">

                                                        <select class="form-control" name="langue_id">
                                <option value="">
                                                        Select Category
                                </option>
                                                        <?php
            $langue_id= isset($postData['langue_id']) ? $postData['langue_id'] :0;

                                                           foreach ($language as $key => $val) {
                                                               $selected='';
                                                               if ($key==$langue_id) {
                                                                   $selected='selected="selected"';
                                                               }
                                                        ?>
                                                           <option value="<?= $key ?>" <?= $selected ?>>
                                                          <?= $val ?>
                                                        </option>
                                                          <?php
                                                         } ?>
                                                        </select>
                                                        <?= form_error('langue_id') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">
                                                    Store Currency
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">

                                                        <?php
        $currency_id= isset($postData['currency_id']) ? explode(',',$postData['currency_id']) : array();

                                                           foreach ($currency as $key => $val) {
                                                               $selected='';
                                                               if (in_array($key,$currency_id)) {
                                                                   $selected='checked';
                                                               }
                                                        ?>
                            <input type="checkbox" value="<?= $key ?>" <?= $selected ?> name="currency_id[]">&nbsp;
                                                          <?php echo $val['currency_name'];
                                                          ?>

                                                          <?php
                                                         } ?>
                                                        <?= form_error('currency_id[]') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Address</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
       <textarea name="address" id="address"><?= isset($postData['address']) ? $postData['address'] : '' ?></textarea>
                                                        <?php
                                                          echo form_error('address');
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Order Id Prefix</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="order_id_prefix" id="order_id_prefix" type="text" placeholder="Email" value="<?= isset($postData['order_id_prefix']) ? $postData['order_id_prefix'] : '' ?>">
                                                        <?= form_error('order_id_prefix') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Show Language Translation</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <select name="show_language_translation" class="form-control">
                                                        <option value="1" <?= $postData['show_language_translation']==1 ? 'selected':'' ?>>Yes</option>
                                                        <option value="0" <?= $postData['show_language_translation']==0 ? 'selected':'' ?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Show All Categories</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <select name="show_all_categories" class="form-control">
                                                        <option value="1" <?= $postData['show_all_categories']==1 ? 'selected':'' ?>>Yes</option>
                                                        <option value="0" <?= $postData['show_all_categories']==0 ? 'selected':'' ?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store From Email</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="from_email" id="from_email" type="email" placeholder="Email" value="<?= isset($postData['from_email']) ? $postData['from_email'] : '' ?>" >
                                                        <?= form_error('from_email') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Admin Email-1</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="admin_email1" id="admin_email1" type="email" placeholder="Email" value="<?= isset($postData['admin_email1']) ? $postData['admin_email1'] : '' ?>" >
                                                        <?= form_error('admin_email1') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Admin Email-2</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="admin_email2" id="admin_email2" type="email" placeholder="Email" value="<?= isset($postData['admin_email2']) ? $postData['admin_email2'] : '' ?>" >
                                                        <?= form_error('admin_email2') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Admin Email-3</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="admin_email3" id="admin_email3" type="email" placeholder="Email" value="<?= isset($postData['admin_email3']) ? $postData['admin_email3'] : '' ?>" >
                                                        <?= form_error('admin_email3') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- CLOVER POS -->
                                            <div class="control-group info">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <label class="span2" for="inputMame">Clover Payment Mode</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls">
                                                            <select name="clover_mode" class="form-control">
                                                                <option value="0" <?= $postData['clover_mode']==0 ? 'selected':'' ?>>Sandbox</option>
                                                                <option value="1" <?= $postData['clover_mode']==1 ? 'selected':'' ?>>Live</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group info">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <label class="span2" for="inputMame">Clover Sandbox Payment Api Key</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls">
                                                            <input class="form-control" name="clover_sandbox_api_key" id="clover_sandbox_api_key" type="text" value="<?= isset($postData['clover_sandbox_api_key']) ? $postData['clover_sandbox_api_key'] : '' ?>" >
                                                            <?= form_error('clover_sandbox_api_key') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group info">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <label class="span2" for="inputMame">Clover Sandbox Payment Secret</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls">
                                                            <input class="form-control" name="clover_sandbox_secret" id="clover_sandbox_secret" type="text" value="<?= isset($postData['clover_sandbox_secret']) ? $postData['clover_sandbox_secret'] : '' ?>" >
                                                            <?= form_error('clover_sandbox_secret') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group info">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <label class="span2" for="inputMame">Clover Live Payment Api Key</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls">
                                                            <input class="form-control" name="clover_api_key" id="clover_api_key" type="text" value="<?= isset($postData['clover_api_key']) ? $postData['clover_api_key'] : '' ?>" >
                                                            <?= form_error('clover_api_key') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group info">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <label class="span2" for="inputMame">Clover Live Payment Secret</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="controls">
                                                            <input class="form-control" name="clover_secret" id="clover_secret" type="text" value="<?= isset($postData['clover_secret']) ? $postData['clover_secret'] : '' ?>" >
                                                            <?= form_error('clover_secret') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- CLOVER POS END -->
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Paypal Payment Mode</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <select name="paypal_payment_mode" class="form-control">
                                                        <option value="sandbox" <?= $postData['paypal_payment_mode']=='sandbox' ? 'selected':'' ?>>Sandbox</option>
                                                        <option value="live" <?= $postData['paypal_payment_mode']=='live' ? 'selected':'' ?>>Live</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Sandbox Payment Paypal Business Email</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="paypal_sandbox_business_email" id="paypal_sandbox_business_email" type="email" placeholder="Email" value="<?= isset($postData['paypal_sandbox_business_email']) ? $postData['paypal_sandbox_business_email'] : '' ?>" >
                                                        <?= form_error('paypal_sandbox_business_email') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Live Payment Paypal Business Email</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <input class="form-control" name="paypal_business_email" id="paypal_business_email" type="email" placeholder="Email" value="<?= isset($postData['paypal_business_email']) ? $postData['paypal_business_email'] : '' ?>" >
                                                        <?= form_error('paypal_business_email') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Show Flagship</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <select name="flag_ship" class="form-control">
                                                        <option value="no" <?= $postData['flag_ship']=='no' ? 'selected':'' ?>>No</option>
    <option value="yes" <?= $postData['flag_ship']=='yes' ? 'selected':'' ?>>Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Email Footer Line</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <textarea name="email_footer_line" id="content"><?= isset($postData['email_footer_line']) ? $postData['email_footer_line'] : '' ?></textarea>
                                                        <?= form_error('email_footer_line') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2">Store Email Template Logo</label>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="controls">
                                                                              <div class="col-xs-3" style="margin-bottom:15px;">
                                                                                 <?php $old_image =isset($postData['email_template_logo']) ? $postData['email_template_logo'] : '';
                                                                                 ?>

                                                                                 <?php
                                                                                 if ($old_image !='') {
                                                                                     $imageurl = getLogoImages($old_image);?>
                                                           <?php
                                                           if ($imageurl) {
                                                             ?>
                                                             <img src="<?= $imageurl ?>" width="100" height="80">
                                                             <?php
                                                          } ?>
                                                                                 <?php
                                                                                   }
                                                                                 ?>
                                                                                  <input name="old_image" value="<?= $old_image ?>" type="hidden">
                                                                              </div>
                                                                        </div>
                                                  <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
                                                      <input class="btn btn-primary" name="logo_image" type="file" accept="image/x-png,image/gif,image/jpeg" id="fileUpload-1">
                                                      &nbsp;&nbsp;
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Company Details For Invoice Pdf</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <textarea name="invoice_pdf_company" id="content1"><?= isset($postData['invoice_pdf_company']) ? $postData['invoice_pdf_company'] : '' ?></textarea>
                                                        <?= form_error('invoice_pdf_company') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2" for="inputMame">Store Company Details For Order Pdf</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <textarea name="order_pdf_company" id="content2"><?= isset($postData['order_pdf_company']) ? $postData['order_pdf_company'] : '' ?></textarea>
                                                        <?= form_error('order_pdf_company') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2">Store Pdf Logo</label>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="controls">
                                                                              <div class="col-xs-3" style="margin-bottom:15px;">
                                                                                 <?php
                                    $old_image =isset($postData['pdf_template_logo']) ? $postData['pdf_template_logo'] : '';
                                                                                 ?>

                                                                                 <?php
                                                                                 if ($old_image !='') {
                                                                                     $imageurl = getLogoImages($old_image);?>
                                                           <?php
                                                           if ($imageurl) {
                                                             ?>
                                                             <img src="<?= $imageurl ?>" width="100" height="80">
                                                             <?php
                                                          } ?>
                                                                                 <?php
                                                                                   }
                                                                                 ?>
                                                                                  <input name="old_pdf_template_logo" value="<?= $old_image ?>" type="hidden">
                                                                              </div>
                                                                        </div>
                                                  <div class="entry input-group col-xs-12" style="margin-bottom:15px;">
                                                      <input class="btn btn-primary" name="pdf_template_logo" type="file" accept="image/x-png,image/gif,image/jpeg" id="fileUpload-2">
                                                      &nbsp;&nbsp;
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                          <button type="submit" class="btn btn-success" id="submitBtn" >Submit</button>
                                          <a href="<?= $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
                                        </div>

                                         <?= form_close() ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<script>
 CKEDITOR.replace('content', {
    height: 300,
    filebrowserUploadUrl: "upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;

 CKEDITOR.replace('content1', {
    height: 300,
    filebrowserUploadUrl: "upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;
 CKEDITOR.replace('content2', {
    height: 300,
    filebrowserUploadUrl: "upload.php",
    allowedContent:true,
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}',
 });
 CKEDITOR.dtd.$removeEmpty.i = 0;
</script>

