<div class="product-title-section">
    <div class="product-title-section-img">
        <img src="<?= $BASE_URL ?>assets/images/FncwAQkcU.jpg">
    </div>
    <!--<div class="product-title-section-info">-->
    <!--    <div class="product-title-section-info-inner">-->
    <!--        <div class="today-deal-title">-->
    <!--            <span><?= $page_title ?></span>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--</div>-->
</div>
<div class="product-pagination">
    <span><a href="<?= $BASE_URL?>">Home</a> > <a href="javascript:void(0)"><?= $page_title ?></a></span>
</div>
<div class="container-fluid all-products-section">
    <div class="container p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product-section">
                    <div class="main-single-section">
            <!--            <div class="chat-module-section">-->
                        <!--	<div class="message-section">-->
                     <!-- 			<div class="message-chat-field">-->
                     <!--     			<div class="message-chat-title">-->
                     <!--     				<span>Support</span>-->
                     <!--     			</div>-->
                     <!--     			<div class="message-chat-box">-->
                     <!--     				<div class="message-list">-->
                     <!--     					<ul>-->
                     <!--     						<li class="message-date">05 August 2019</li>-->
                     <!--     						<li class="send-message">-->
                     <!--             					<div class="send-message-detail">-->
                     <!--             						<span>Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you</span>-->
                     <!--             					</div>-->
                     <!--     						</li>-->
                     <!--     						<li class="recieve-message">-->
                     <!--             					<div class="recieve-message-detail">-->
                     <!--             						<span>Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you</span>-->
                     <!--             					</div>-->
                     <!--     						</li>-->
                     <!--     					</ul>-->
                     <!--     				</div>-->
                     <!--     				<div class="enter-message">-->
                     <!-- 						<input type="text" placeholder="Enter message...">-->
                     <!-- 						<button>Send</button>-->
                     <!-- 					</div>-->
                     <!--         		</div>-->
                     <!--         	</div>-->
                     <!--     	</div>-->
                        <!--</div>-->
                        <div class="ticket-top-section">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="ticket-title">
                                        <span>Your Tickets</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="new-ticket-btn">
                                        <button data-toggle="modal" data-target="#newTicketModal"><i class="fas fa-plus-circle"></i> Create New Ticket</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ticket-listing-section">
                            <div class="ticket-listing-inner shopping-product-display">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Ticket no.</th>
                                            <th>Ticket Created on</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>123456789</td>
                                            <td>26 Aug 2019 15:18:45</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="#" class="comments-counts" style="color:green; padding: 5px;" title="Message" data-toggle="modal" data-target="#message-view-modal">
                                                        <i class="fas fa-comment-dots fa-lg"></i>
                                                        <span>10</span>
                                                       </a>
                                                   </div>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                       <a href="#" style="color:#d71b23; padding: 5px;" title="delete">
                                                         <i class="fa fa-trash fa-lg"></i>
                                                       </a>
                                               </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>123456789</td>
                                            <td>26 Aug 2019 15:18:45</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="#" class="comments-counts" style="color:green; padding: 5px;" title="Message" data-toggle="modal" data-target="#message-view-modal">
                                                        <i class="fas fa-comment-dots fa-lg"></i>
                                                        <span>10</span>
                                                       </a>
                                                   </div>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                       <a href="#" style="color:#d71b23; padding: 5px;" title="delete">
                                                         <i class="fa fa-trash fa-lg"></i>
                                                       </a>
                                               </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                              <div class="message-chat-box">
                                  <div class="message-list">
                                      <ul>
                                          <li class="message-date">05 August 2019</li>
                                          <li class="send-message">
                                              <div class="sender-name">
                                                  <span>User name</span>
                                              </div>
                                              <div class="send-message-detail">
                                                  <span>Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you</span>
                                              </div>
                                          </li>
                                          <li class="recieve-message">
                                              <div class="reciever-name">
                                                  <span>Support</span>
                                              </div>
                                              <div class="recieve-message-detail">
                                                  <span>Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you Hi, How are you</span>
                                              </div>
                                          </li>
                                      </ul>
                                  </div>
                                  <div class="enter-message">
                                      <input type="text" placeholder="Enter message...">
                                      <button>Send</button>
                                  </div>
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
                    <div class="new-ticket-section-fields">
                        <div class="row">
                            <div class="col-md-4">
                                <span><font color="red">*</font> Your Name</span>
                                <input type="text">
                            </div>
                            <div class="col-md-4">
                                <span><font color="red">*</font> Your Email</span>
                                <input type="text">
                            </div>
                            <div class="col-md-4">
                                <span><font color="red">*</font> Your Contact no.</span>
                                <input type="text">
                            </div>
                            <div class="col-md-12">
                                <span><font color="red">*</font> Your Message</span>
                                <textarea type="text"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="new-ticket-button">
                                    <button type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
