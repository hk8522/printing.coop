<div class="inner-content-area">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="text-center" style="color:red">
        <?= $this->session->flashdata('message_error') ?>
      </div>
      <div class="text-center" style="color:green">
        <?= $this->session->flashdata('message_success') ?>
      </div>
      <?= form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'auto_attribute_add_form')) ?>
      <input class="form-control" name="id" type="hidden" value="<?= $id ?>" id="id">
      <input class="form-control" type="hidden" value="<?= $product_id ?>" id="product_id"
        name="product_id">
      <div class="form-role-area">
        <div class="control-group info">
          <div class="row align-items-center">
            <div class="col-md-4">
              <label class="span2" for="attribute_id">Attributes</label>
            </div>
            <div class="col-md-8">
              <div class="controls">
                <select name="attribute_id" class="form-control" required>
                  <option value="">Select Attribute</option>
                  <?php
                  foreach ($attributes as $attribute) {
                    $selected = '';
                    if ($attribute['id'] == $attribute_id) {
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option value="<?= $attribute['id']?>" <?= $selected?>><?= $attribute['name']?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
        </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<script src="<?= $BASE_URL ?>/assets/js/validation.js"></script>
<script>
success = '<?= $success ?>';
$('#auto_attribute_add_form').validate({
  rules: {
    attribute_id: {
      required: true,
    },
  },
  messages: {
    attribute_id: {
      required: 'Please select attribute',
    },
  },
  submitHandler: function(form) {
    $('#loader-img').show();
    $.ajax({
      type: "POST",
      url: '<?= $BASE_URL?>admin/Products/AutoAttributeAdd',
      data: $(form).serialize(),
      beforeSend: function() {
        $('button[type=submit]').attr('disabled', true);
      },
      success: function(data) {
        $('button[type=submit]').attr('disabled', false);
        $('#loader-img').hide();
        $('#ItemModal .modal-body').html(data);
        if (success == 1) {
          location.reload();
        }
      }
    });
  },
});
</script>