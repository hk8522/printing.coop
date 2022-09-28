<?php //pr($postData);?>
<div class="content-wrapper" style="min-height: 687px;">
  <section class="content">
    <div class="row" style="display: flex;justify-content: center;align-items: center;">
      <div class="col-md-12 col-xs-12">
        <div class="box box-success box-solid">
          <div class="box-body">
            <div class="inner-head-section">
              <div class="inner-title">
                <span>Create Discount</span>
              </div>
            </div>
            <div class="inner-content-area">
              <div class="row justify-content-center">
                <div class="col-md-7">
                  <div class="text-center" style="color:red ;margin-bottom:10px;">
                    <?= $this->session->flashdata('message_error') ?>
                  </div>
                  <?= form_open('',array('class' => 'form-horizontal')) ?>
                  <input class="form-control" name="id" type="hidden"
                    value="<?= isset($postData['id']) ? $postData['id'] : '' ?>">

                  <div class="form-role-area">
                    <div class="control-group info">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <label class="span2" for="code">Generate Code</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <input class="form-control" type="text" name="code"
                              value="<?= isset($postData['code']) ? $postData['code'] : '' ?>"
                              maxlength="50">
                            <?= form_error('code') ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="show-discount-percent">Discount Type</label>
                        </div>
                        <div class="col-md-8">
                          <div class="row">
                            <div class="col-md-6">
                              <label class="span2" id="show-discount-percent">
                                <input type="radio" name="discount_type"
                                  value="discount_percent" checked="">Discount
                                Percent</label>
                            </div>
                            <div class="col-md-6">
                              <label class="span2" id="show-discount-amount">
                                <input type="radio" name="discount_type"
                                  value="discount_amount">Discount Amount</label>
                            </div>

                            <div class="col-md-12">
                              <div>
                                <input class="form-control" name="discount"
                                  value="<?= isset($postData['discount']) ? $postData['discount'] : '' ?>">

                                <label
                                  class="form-inner-label discount-percent">Discount
                                  In Percentage</label>

                                <label class="form-inner-label discount-amount"
                                  style="display:none">Discount In Amount
                                </label>
                                <?= form_error('discount') ?>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <label class="span2" for="discount_valid_from">Discount Valid From</label>
                        </div>
                        <div class="col-md-8 ">
                          <div class="controls calender-icon">
                            <input class="form-control" type="text" id="discount_valid_from"
                              readonly name="discount_valid_from"
                              value="<?= isset($postData['discount_valid_from']) ? $postData['discount_valid_from']:date('Y/m/d H:i') ?>">
                            <i class="fa fas fa-calendar-week"></i>
                            <?= form_error('discount_valid_from') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <label class="span2" for="discount_valid_to">Discount Valid Till</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls calender-icon">
                            <input class="form-control" type="text" id="discount_valid_to"
                              name="discount_valid_to" readonly
                              value="<?= isset($postData['discount_valid_to']) ? $postData['discount_valid_to']:date('Y/m/d H:i') ?>">
                            <i class="fa fas fa-calendar-week"></i>
                            <?= form_error('discount_valid_to') ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col-->
    </div><!-- ./row -->
  </section><!-- /.content -->
</div>

<script src="<?= $BASE_URL ?>assets/admin/js/jquery.datetimepicker.full.js"></script>
<script>
$(document).ready(function() {
  $('#show-discount-percent').click(function() {
    $('.discount-percent').show();
    $('.discount-amount').hide();
  });
  $('#show-discount-amount').click(function() {
    $('.discount-percent').hide();
    $('.discount-amount').show();
  });

  $('#discount_valid_to,#discount_valid_from').datetimepicker({
    minDate: new Date()
  });
});
</script>