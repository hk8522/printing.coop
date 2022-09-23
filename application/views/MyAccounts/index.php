<div class="account-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="account-section-inner">
            <?php $this->load->view('elements/my-account-menu'); ?>
            <div class="account-area">
                <div class="universal-dark-title">
                    <span>
                    <?php
                    if ($language_name == 'French') { ?>
                      Vos informations personnelles
                    <?php } else{ ?>
                      Your Personal Details
                    <?php
                   } ?></span>
                    <?php if ($postData['email_verification']==0) { ?>
                              <div class="verify">
                                         <span class="verify-email mt-5" style="color:red"><small>
                                       <?php
                                        if ($language_name == 'French') { ?>
                                          Vérifiez votre e-mail
                                        <?php } else{ ?>
                                          Verify your email
                                        <?php
                                       } ?></p></small>
                              </div>
                          <?php
                         } ?>
                        <?php if ($postData['user_type']==2) { ?>
                        <div class="verify">
                               <span class="verify-email mt-5" style="color:green"><small>
                             <?php
                            if ($language_name == 'French') { ?>
                              Custome préféré
                            <?php } else{ ?>
                              Preferred Custome
                            <?php
                           } ?>r</p></small>
                        </div>
                    <?php
                   } ?>
                      </div>
                </div>
                    <div class="text-center" style="color:red">
                            <?= $this->session->flashdata('message_error') ?>
                    </div>
                    <div class="text-center" style="color:green">
                            <?= $this->session->flashdata('message_success') ?>
                    </div><br>
                <div class="shipping-form">
                  <?= form_open_multipart('',array('class' => 'form-horizontal')) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>
                                <?php
                                if ($language_name == 'French') { ?>
                                  Code client
                                <?php } else{ ?>
                                  Customer Code
                                <?php
                               } ?></label>
                                <input type="text" name="fname" value="<?= isset($postData['id']) ? CUSTOMER_ID_PREFIX.$postData['id'] : '' ?>" readonly>
                                <span class="text-danger"><?= form_error('fname') ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>
                                <?php
                                if ($language_name == 'French') { ?>
                                  votre nom
                                <?php } else{ ?>
                                  Your Name
                                <?php
                               } ?> *</label>
                                <input type="text" name="fname" value="<?= isset($postData['fname']) ? $postData['fname'] : '' ?>" readonly>
                                <span class="text-danger"><?= form_error('fname') ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-review">
                                <label>
                                <?php
                                if ($language_name == 'French') { ?>
                                  Votre nom de famille
                                <?php } else{ ?>
                                  Your Last Name
                                <?php
                               } ?> *</label>
                                <input type="text" name="lname" value="<?= isset($postData['lname']) ? $postData['lname'] : '' ?>" readonly>
                                <span class="text-danger"><?= form_error('lname') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>
                                <?php
                                if ($language_name == 'French') { ?>
                                  Votre adresse email
                                <?php } else{ ?>
                                  Your Email Address
                                <?php
                               } ?> *</label>
                                <input type="text" name="email" value="<?= isset($postData['email']) ? $postData['email'] : '' ?>" readonly>
                                <?= form_error('email') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>
                                <?php
                                if ($language_name == 'French') { ?>
                                  Ton téléphone
                                <?php } else{ ?>
                                  Your Phone
                                <?php
                               } ?> *</label>
                                <input type="text" name="mobile" value="<?= isset($postData['mobile']) ? $postData['mobile'] : '' ?>" readonly>
                                <?= form_error('mobile') ?>
                            </div>
                        </div>
                    </div>
                    <div class="order-btn">
                       <a href="<?= $BASE_URL ?>MyAccounts/EditAccount"><button type="button">
                       <?php
                        if ($language_name == 'French') { ?>
                          Éditer
                        <?php } else{ ?>
                          Edit
                        <?php
                       } ?></button></a>
                    </div>
                  <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
