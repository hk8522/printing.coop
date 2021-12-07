<div class="product-title-section">
    <div class="product-title-section-img">
        <img src="<?php echo $BASE_URL;?>assets/images/FncwAQkcU.jpg">
    </div>
    <!--<div class="product-title-section-info">-->
    <!--    <div class="product-title-section-info-inner">-->
    <!--        <div class="today-deal-title">-->
    <!--            <span><?php echo $page_title; ?></span>-->
    <!--        </div>-->
            
    <!--    </div>-->
    <!--</div>-->
</div>
<div class="product-pagination">
    <span><a href="<?php echo $BASE_URL?>">Home</a> > <a href="javascript:void(0)"><?php echo $page_title; ?></a></span>
</div>
<div class="container-fluid all-products-section">
    <div class="container p-0">
        <div class="row">
            <div class="col-md-9">
                <div class="latest-product-section">
                    <div class="main-single-section">
        				<div class="ticket-top-section">
        				    <div class="row align-items-center">
							    <div class="col-md-12 text-center" style="color:green" >
								    
						           <?php echo $this->session->flashdata('message_success');?>
							    </div>
        				        <div class="col-md-6">
        				            <div class="ticket-title">
        				                <span><?php echo $page_title; ?></span>
        				            </div>
        				        </div>
        				        <div class="col-md-6">
        				            <div class="new-ticket-btn">
										<a href="javascript:void(0)" id="newTicketFromOpen"><button><i class="fas fa-plus-circle"></i> Create New Ticket</button>
										</a>
        				            </div>
									
									<div class="new-ticket-btn">
										<?php if($status_ticket==0){
											$url=$BASE_URL.'Tickets/index/'.base64_encode(1);
											$text='Resolved Ticket';
										}else{
											$url=$BASE_URL.'Tickets/index/';
											$text='Unresolved Ticket';
										}?>
										<a href="<?php echo $url;?>">
										<button>
										
										 <?php echo $text;?>
										</button>
										</a>
        				            </div>
        				        </div>
        				    </div>
        				</div>
        				<div class="ticket-listing-section">
        				    <div class="ticket-listing-inner shopping-product-display" id="TicketData">
							
							<h6 class="text-center">Please wait loading...</h6>
        				        
								
        				    </div>
        				</div>
                    </div>
                </div>
            </div>
			<div class="col-md-3 desktop-account">
                    <?php $this->load->view('elements/my-account-menu');?>
            </div>
        </div>
    </div>
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

