<div class="contact-section universal-spacing universal-bg-white">
        <div class="container">
            <div class="contact-section-inner">
                <div class="contact-row">
				   <?php  if($language_name=='French'){
					   
				       echo $pageData['description_france'];
					   
				   }else{
					   
				       echo $pageData['description'];
				   }
				   ?> 
                </div>
            </div>
            <div class="contact-form">
                <?php 
                if($language_name=='French'){ ?>
                <form method="post" id="contact-us">
                  <div id="contact-us-message">
                  </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>votre nom*</label>
                                <input type="text" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>Ton téléphone*</label>
                                <input type="text" name="phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-review">
                                <label>Votre Email*</label>
                                <input type="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-review">
                                <label>Votre commentaire*</label>
                                <textarea type="text" name="comment"></textarea>
                            </div>
                        </div>
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="form-group captcha-container">
                      
                            <div class="g-recaptcha" id="rcaptcha" data-callback="contactus_recaptcha"  data-sitekey="6LepWXUdAAAAAPD3k1KAu0Hko9bCGHoKN9YKVT1Y" ></div>
                            <span id="recaptcha-error"  style="display:none; color:red" >Captcha is required. </span>
                        </div>
                        <div class="col-md-12">
                            <div class="order-btn">
                                <button type="submit" disabled="disabled" id="submit-contact-us-btn" >Soumettre</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php }else{ ?>
                <form method="post" id="contact-us">
                  <div id="contact-us-message">
                  </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>Your Name*</label>
                                <input type="text" name="name" id="contact-us-name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-review">
                                <label>Your Phone*</label>
                                <input type="text" name="phone" id="contact-us-phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-review">
                                <label>Your Email*</label>
                                <input type="email" name="email" id="contact-us-email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-review">
                                <label>Your Comment*</label>
                                <textarea type="text" name="comment" id="contact-us-comment"></textarea>
                            </div>
                        </div>
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="form-group captcha-container">
                      
                            <div class="g-recaptcha" id="rcaptcha" data-callback="contactus_recaptcha"  data-sitekey="6LepWXUdAAAAAPD3k1KAu0Hko9bCGHoKN9YKVT1Y" ></div>
                            <span id="recaptcha-error"  style="display:none; color:red" >Captcha is required. </span>
                        </div>
                      
                        <div class="col-md-12">
                            <div class="order-btn">
                                <button type="submit" disabled="disabled" id="submit-contact-us-btn"> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php 
                }?> 
            </div>
        </div>
    </div>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2794.0783157450146!2d-73.64850264942343!3d45.54875007899941!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc918c2d6330ef7%3A0xb5938ad134624b6c!2s9166+Rue+Lajeunesse%2C+Montr%C3%A9al%2C+QC+H2M+1S2%2C+Canada!5e0!3m2!1sen!2sin!4v1530706367854" style="border:0;" allowfullscreen="" class="contact_us_map" frameborder="0"></iframe>
