<div class="account-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="account-section-inner">
            <?php $this->load->view('elements/my-account-menu'); ?>
            <div class="account-area">
                <div class="universal-dark-title">
                    <span>Your Personal Details</span>
                    <?php if($postData['email_verification']==0){?>
                              <div class="verify">
                                         <span class="verify-email mt-5" style="color:red"><small>
                                       <?php
                                        if($language_name=='French'){ ?>
                                          Vérifiez votre e-mail
                                        <?php }else{ ?>
                                          Verify your email
                                        <?php
                                        }?></p></small>
                              </div>
                          <?php
                          }?>

                      </div>
                </div>
                    <div class="text-center" style="color:red">
                            <?php echo $this->session->flashdata('message_error');?>
                    </div>
                    <div class="text-center" style="color:green">
                            <?php echo $this->session->flashdata('message_success');?>
                    </div>
                <div class="shipping-form">
                  <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>
                                <?php
                                if($language_name=='French'){ ?>
                                  Votre nom *
                                <?php }else{ ?>
                                  Your Name *
                                <?php
                                }?></label>
                                <input type="text" name="fname" value="<?php echo isset($postData['fname']) ? $postData['fname']:'';?>">
                                <span class="text-danger"><?php echo form_error('fname');?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>
                                <?php
                                if($language_name=='French'){ ?>
                                  Votre nom de famille *
                                <?php }else{ ?>
                                  Your Last Name *
                                <?php
                                }?></label>
                                <input type="text" name="lname" value="<?php echo isset($postData['lname']) ? $postData['lname']:'';?>">
                                <span class="text-danger"><?php echo form_error('lname');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>
                                 <?php
                                if($language_name=='French'){ ?>
                                  Votre adresse email *
                                <?php }else{ ?>
                                  Your Email Address *
                                <?php
                                }?></label>
                                <input type="text" name="email" value="<?php echo isset($postData['email']) ? $postData['email']:'';?>">
                                <?php echo form_error('email');?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>
                                 <?php
                                if($language_name=='French'){ ?>
                                  Ton téléphone *
                                <?php }else{ ?>
                                  Your Phone *
                                <?php
                                }?></label>
                                <input type="text" name="mobile" value="<?php echo isset($postData['mobile']) ? $postData['mobile']:'';?>">
                                <?php echo form_error('mobile');?>
                            </div>
                        </div>
                    </div>
                    <div class="order-btn">
                        <button type="submit">
                         <?php
                        if($language_name=='French'){ ?>
                          sauver
                        <?php }else{ ?>
                          Save
                        <?php
                        }?></button>
                    </div>
                  <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
