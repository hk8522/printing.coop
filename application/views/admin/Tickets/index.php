
<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">
            <div class="col-md-12 col-xs-12">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="row">
                                <div class="col-md-6 col-xs-12 text-left">
                                    <div class="inner-title">
                                        <span><?php echo ucfirst($page_title).' List'; ?></span>
                                    </div>
                                </div>

                               <div class="col-md-6 col-xs-12 text-right">
                                    <div class="all-vol-btn">

                                            <?php if($status_ticket==0){
                                            $url=$BASE_URL.'admin/Tickets/index/'.base64_encode(1);
                                            $text='Resolved Ticket';
                                        }else{
                                            $url=$BASE_URL.'admin/Tickets/index/';
                                            $text='Unresolved Ticket';
                                        }?>
                                            <div class="upload-area">
                                               <a href="<?php echo $url;?>"><button><?php echo $text;?></button>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="custom-mini-table" id="TicketData">
                                <h6 class="text-center">Please wait loading...</h6>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
 </div>

<div class="modal fade message-view-modal" id="message-view-modal" role="dialog" aria-labelledby="message-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="chat-module-section">
                    <div class="message-section">
                          <div class="message-chat-field">
                              <div class="message-chat-title">
                                  <span>Support</span>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                              </div>
                              <div class="message-chat-box" id="TicketChatData">
                                                                                           <h6 class="text-center">Please wait loading...</h6>

                              </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="new-ticket-modal modal fade" id="newTicketModal" role="dialog" aria-labelledby="newTicketModal" style="padding-right: 0px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="new-ticket-main-section">
                    <div class="new-ticket-main-title">
                        <span>Create new ticket</span>
                        <div data-dismiss="modal" aria-label="Close" class="close-btn-icon" style="transform: matrix(1, 0, 0, 1, 0, 0);">
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                    <div class="new-ticket-section-fields" id="createTicketFromData">
                       <h6 class="text-center">Please wait loading...<h6>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var BASE_URL='<?php echo $BASE_URL_ADMIN;?>';
var status_ticket='<?php echo isset($status_ticket) ? base64_encode($status_ticket):base64_encode(0);?>';
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
 </script>
<script src="<?php echo $BASE_URL;?>assets/admin/js/tickets.js"></script>

