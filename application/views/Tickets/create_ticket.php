<div id="conntent">
            <?php if ($save_success) { ?>
                 <script>
                    location.reload();
                 </script>
            <?php } ?>
            <div class="new-ticket-section-fields">
                        <div class="text-center" style="color:red">
                        <?= $this->session->flashdata('message_error') ?>
                        </div>
                         <?= form_open_multipart('',array('class' => 'form-horizontal','id' => 'TicketCreateFrom')) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <span><font color="red">*</font> Your Name</span>
                                <input type="text" name="name" value="<?= isset($postData['name']) ? $postData['name'] : '' ?>">
                                <?= form_error('name') ?>
                            </div>
                            <div class="col-md-6">
                                <span><font color="red">*</font> Your Email</span>
                                <input type="email" name="email" value="<?= isset($postData['email']) ? $postData['email'] : '' ?>">
                                <?= form_error('email') ?>
                            </div>
                            <div class="col-md-12">
                                <span><font color="red">*</font> Your Contact no.</span>

                                <input type="number" name="contact_no" value="<?= isset($postData['contact_no']) ? $postData['contact_no'] : '' ?>">
                                <?= form_error('contact_no') ?>
                            </div>

                            <div class="col-md-12">
                                <span><font color="red">*</font>Subject</span>
                                <input type="text" name="subject" value="<?= isset($postData['subject']) ? $postData['subject'] : '' ?>">
                                <?= form_error('subject') ?>
                            </div>
                            <div class="col-md-12">
                                <span><font color="red">*</font> Your Message</span>
                                <textarea name="message" ><?= isset($postData['message']) ? $postData['message'] : '' ?></textarea>
                                <?= form_error('message') ?>

                            </div>
                            <div class="col-md-12">
                                <div class="new-ticket-button">
                                    <button type="submit" id="TicketCreateFromSubmit">Submit</button>
                                </div>
                            </div>
                        </div>
                         <?= form_close() ?>
                    </div>
<script>
  $('#TicketCreateFrom').submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var formsubmit=true;
        $('#TicketCreateFromSubmit').attr("disabled",true);

        if (formsubmit==true) {
            var url =BASE_URL+'Tickets/createTicket';
            $.ajax({
                   type: "POST",
                   url: url,
                   data: form.serialize(), // serializes the form's elements.
                   success: function(data)
                    {
                        $('#conntent').html(data);
                        /*$('#myModal').modal('hide');
                        $('#btnSubmit').attr("disabled",false);
                        var json = JSON.parse(data);
                        var res=json.status;
                        var msg=json.msg;
                        if (res==1) {
                        setTimeout(function() {
                                location.reload();
                              }, 2000
                        );
                        $('#MsgModal .modal-body').html('<span style="color:green">'+msg+'</span>');
                        $('#MsgModal').modal('show');
                        } else{
                            $('#MsgModal .modal-body').html('<span style="color:red">'+msg+'</span>');
                            $('#MsgModal').modal('show');
                        }*/
                    },
                    error: function (error) {
                      $('#TicketCreateFromSubmit').attr("disabled",false);
                   }
            });
        } else{
            $('#TicketCreateFromSubmit').attr("disabled",false);
        }
    });

</script>
</div>

