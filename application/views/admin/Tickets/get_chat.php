

                                                                                                      <div class="message-list" id="messages">
                                    <ul id="ChatList">
                                          <!--<li class="message-date">05 August 2019</li>-->
                                        <?php foreach ($lists as $list) {
                                          $send_message_detail='send-message-detail';
                                           $send_message='send-message';
                                            $sender_name='sender-name';
                                           $Username=$loginName;

                                           if ($list['comment_author'] !=0) {
                                                $send_message_detail='recieve-message-detail';
                                                $send_message='recieve-message';
                                                 $sender_name='reciever-name';
                                                $Username=$list['name'];
                                           }
                                        ?>
                                          <li class="<?=  $send_message ?>">
                                              <div class="<?= $sender_name ?>">
                                                  <span><?php  echo $Username?></span>
                                              </div>
                                              <div class="<?= $send_message_detail ?>">
                                                  <span><?= $list['message'] ?></span>
                                                <br>
                                                <span><?= dateFormate($list['created']) ?></span>
                                              </div>
                                          </li>
                                        <?php
                                       } ?>

                                      </ul>

                                    </div>
                                    <?= form_open_multipart('',array('class' => 'form-horizontal','id' => 'SendMessageFrom')) ?>
                                  <div class="enter-message">
                                    <input type="hidden" required name="ticket_id" value="<?= $ticket_id ?>">

                                      <input type="text" placeholder="Enter message..." required name="message" id="messageText">
                                      <button type="submit">
                                    Send
                                    </button>
                                  </div>
                                <?= form_close() ?>

<script>
var $chatWindow = $('#messages');
var $container = $('<ul>');
$("#SendMessageFrom").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var formsubmit=true;
        $("#SendMessageFromSubmit").attr("disabled",true);
        if (formsubmit==true) {
            var url =BASE_URL+'Tickets/getChat/'+'<?= base64_encode($ticket_id) ?>';
            $.ajax({
                   type: "POST",
                   url: url,
                   data: form.serialize(), // serializes the form's elements.
                   success: function(data)
                    {
                      $("#messageText").val('');
                      //$("#ChatList").append(data);
                      $container.append(data);
                      $chatWindow.append($container);
                      $chatWindow.scrollTop($chatWindow[0].scrollHeight);
                    },
                    error: function (error) {
                      $("#SendMessageFromSubmit").attr("disabled",false);
                   }
            });
        } else{
            $("#SendMessageFromSubmit").attr("disabled",false);
        }
    });

    setInterval(getLetestChat, 1000);
    function getLetestChat() {
        var url =BASE_URL+'Tickets/getLetestChat/'+'<?= base64_encode($ticket_id) ?>';

        $.ajax({
               type: "GET",
               url: url,
               success: function(data)
                {
                  //$("#ChatList").append(data);
                      $container.append(data);
                      $chatWindow.append($container);
                      $chatWindow.scrollTop($chatWindow[0].scrollHeight);
                },
                error: function (error) {
               }
        });
    }
</script>

