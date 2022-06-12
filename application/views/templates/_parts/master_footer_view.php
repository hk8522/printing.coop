<div class="newsletter-section universal-spacing">
    <div class="container">
        <div class="newsletter-section-inner">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="newsletter-single-inner">
                        <div class="newsletter-content">
                            <div class="universal-light-title">
                                <span><?php
                                      if($language_name=='French'){ ?>
                                        Bulletin
                                      <?php }else{ ?>
                                        Newsletter
                                      <?php
                                      }?></span>
                            </div>
                            <div class="universal-light-info">
                                <span><?php
                                      if($language_name=='French'){ ?>
                                        Reste en contact
                                      <?php }else{ ?>
                                        Stay in Touch
                                      <?php
                                      }?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                  <form id="email-subscribe" method="post">
                    <div id="subscribe-message">
                    </div>
                    <div class="newsletter-fields">
                        <input type="email" placeholder="<?php echo $language_name=='French' ? 'Entrez votre adresse email':'Enter your email address'?>" name="email" id="subscribe-email">
                        <button type="submit"><?php
                                      if($language_name=='French'){ ?>
                                        Souscrire
                                      <?php }else{ ?>
                                        Subscribe
                                      <?php
                                      }?></button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fotter-main-section universal-spacing universal-bg-grey">
    <div class="container">
        <div class="fotter-main-section-inner">
            <div class="row">
                <div class="col-md-3">
                    <div class="fotter-single">
                        <div class="universal-small-dark-title">
                            <span><?php
                                      if($language_name=='French'){ ?>
                                        Souscrire
                                      <?php }else{ ?>
                                        NAVIGATION
                                      <?php
                                      }?></span>
                        </div>
                        <div class="universal-dark-info">
                            <span><a href="<?php echo $BASE_URL?>"><?php
                                      if($language_name=='French'){ ?>
                                        Accueil
                                      <?php }else{ ?>
                                        Home
                                      <?php
                                      }?></a></span>
                            <span><a href="<?php echo $BASE_URL?>Products"><?php
                                      if($language_name=='French'){ ?>
                                        Des produits
                                      <?php }else{ ?>
                                        Products
                                      <?php
                                      }?></a></span>

                            <?php

                                $pages = $this->Page_Model->getPageList(true,'',1,0,$website_store_id);
                                $pageSlugArray = pageSlug();
                            ?>
                            <?php foreach ($pages as $key => $page) {
                                  $slug = $page['slug'];
                                  $url = $BASE_URL.'Page/'.$slug;
                                  $datatoggle = $datatarget='';
                                    if (array_key_exists($slug,$pageSlugArray)) {
                                      $dataUrl = $pageSlugArray[$slug];
                                      $url = $BASE_URL.$dataUrl['class'].'/'.$dataUrl['action'];
                                  }
                               ?>
                              <span>
                                <a href="<?php echo $url;?>" >
                                  <?php
								    if($language_name=='French'){
										echo ucfirst($page['title_france']);
									}else{
										echo ucfirst($page['title']);
									}

								  ?>
                                </a>
                              </span>
                              <?php
                              }
                               ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="fotter-single">
                        <div class="universal-small-dark-title">
                            <span><?php
                                      if($language_name=='French'){ ?>
                                        Catégorie
                                      <?php }else{ ?>
                                        Category
                                      <?php
                                      }?></span>
                        </div>
                        <?php
						if($website_store_id==1 || $website_store_id==3){?>
							<div class="universal-dark-info">
							  <div class="row">

								<?php
								foreach($footerCategory as $Category){
								?>

								  <div class="col-6 col-md-6">
										<span>
										  <a href="<?php echo $BASE_URL;?>Products?category_id=<?php echo base64_encode($Category['id']);?>">
											<?php
											if($language_name=='French'){
											  echo ucfirst($Category['name_french']);
											}else{
												echo ucfirst($Category['name'] );
											}

											?>
										  </a>
										</span>
								  </div>
							  <?php } ?>
							</div>
						   </div>
						<?php
						}
						if($website_store_id==5){
						?>
						<div class="universal-dark-info">
							  <div class="row">

								<?php
								#pr($categories,1);

								foreach($categories['categories'] as $Category){
								?>

								  <div class="col-6 col-md-6">
										<span>
										  <a href="<?php echo $BASE_URL;?>Products?category_id=<?php echo base64_encode($Category['id']);?>">
											<?php
											if($language_name=='French'){
											  echo ucfirst($Category['name_french']);
											}else{
												echo ucfirst($Category['name'] );
											}

											?>
										  </a>
										</span>

									<?php
									foreach($Category['sub_categories'] as $subCategory){
									?>
										<span style="margin-left: 20px;">
										  <a href="<?php echo $BASE_URL;?>Products?category_id=<?php echo base64_encode($Category['id']);?>&sub_category_id<?php echo base64_encode($subCategory['id']);?>">
											<?php
											if($language_name=='French'){
											  echo ucfirst($subCategory['name_french']);
											}else{
												echo ucfirst($subCategory['name'] );
											}

											?>
										  </a>
										</span>
									<?php
									}?>
								  </div>
							  <?php } ?>
							</div>
						   </div>
						<?php
						}?>
                </div>
              </div>

                <div class="col-md-3">
                    <div class="fotter-single">
                        <div class="universal-small-dark-title">
                            <span><?php
                                      if($language_name=='French'){ ?>
                                        ENTRER EN CONTACT
                                      <?php }else{ ?>
                                        GET IN TOUCH
                                      <?php
                                      }?></span>
                        </div>
						<?php
						if($language_name=='French'){
						echo $configrations['address_one_french'];
						}else{
							echo $configrations['address_one'];
						}
						?>

                    </div>
                    <?php
					#
					if($main_store_id==1){?>

                          <div class="social-icons">
                            <div>
                              <a href="https://www.facebook.com/imprimeriecoop/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                              </a>
                              <a href="https://www.instagram.com/printing.coop/" target="_blank">
                                <i class="fab fa-instagram"></i>
                              </a>
                              <a href="https://twitter.com/PrintingCoop" target="_blank">
                                <i class="fab fa-twitter"></i>
                              </a>
                              <a href="https://www.linkedin.com/company/printingcoop" target="_blank">
                                <i class="fab fa-linkedin"></i>
                              </a>
                              <a href="https://pinterest.com/imprimeurcoop" target="_blank">
                                <i class="fab fa-pinterest"></i>
                              </a>
                              <a href="https://www.youtube.com/channel/UC0UzU22tH8SRUaTuLeNGc_g" target="_blank">
                                <i class="fab fa-youtube"></i>
                              </a>
                            </div>
                          </div>
                        <?php
					}?>
					<?php if($main_store_id==2){?>

                          <div class="social-icons">
                            <div>
                              <a href="https://www.facebook.com/imprimeriecoop/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                              </a>
                              <a href="https://www.instagram.com/imprimeurcoop/" target="_blank">
                                <i class="fab fa-instagram"></i>
                              </a>
                              <a href="https://twitter.com/PrintingCoop" target="_blank">
                                <i class="fab fa-twitter"></i>
                              </a>
                              <a href="https://www.linkedin.com/company/printingcoop" target="_blank">
                                <i class="fab fa-linkedin"></i>
                              </a>
                              <a href="https://pinterest.com/imprimeurcoop" target="_blank">
                                <i class="fab fa-pinterest"></i>
                              </a>
                              <a href="https://www.youtube.com/channel/UC0UzU22tH8SRUaTuLeNGc_g" target="_blank">
                                <i class="fab fa-youtube"></i>
                              </a>
                            </div>
                          </div>
                        <?php
					}?>
					<?php if($main_store_id==3){?>

                          <div class="social-icons">
                            <div>
                              <a href="https://www.facebook.com/imprimeriecoop/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                              </a>
                              <a href="https://www.instagram.com/imprimeurcoop/" target="_blank">
                                <i class="fab fa-instagram"></i>
                              </a>
                              <a href="https://twitter.com/PrintingCoop" target="_blank">
                                <i class="fab fa-twitter"></i>
                              </a>
                              <a href="https://www.linkedin.com/company/printingcoop" target="_blank">
                                <i class="fab fa-linkedin"></i>
                              </a>
                              <a href="https://pinterest.com/imprimeurcoop" target="_blank">
                                <i class="fab fa-pinterest"></i>
                              </a>
                              <a href="https://www.youtube.com/channel/UC0UzU22tH8SRUaTuLeNGc_g" target="_blank">
                                <i class="fab fa-youtube"></i>
                              </a>
                            </div>
                          </div>
                        <?php
					}?>
					<?php if($main_store_id==4){?>

                          <div class="social-icons">
                            <div>
                              <a href="https://www.facebook.com/imprimeriecoop/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                              </a>
                              <a href="https://www.instagram.com/imprimeurcoop/" target="_blank">
                                <i class="fab fa-instagram"></i>
                              </a>
                              <a href="https://twitter.com/PrintingCoop" target="_blank">
                                <i class="fab fa-twitter"></i>
                              </a>
                              <a href="https://www.linkedin.com/company/printingcoop" target="_blank">
                                <i class="fab fa-linkedin"></i>
                              </a>
                              <a href="https://pinterest.com/imprimeurcoop" target="_blank">
                                <i class="fab fa-pinterest"></i>
                              </a>
                              <a href="https://www.youtube.com/channel/UC0UzU22tH8SRUaTuLeNGc_g" target="_blank">
                                <i class="fab fa-youtube"></i>
                              </a>
                            </div>
                          </div>
                        <?php
					}?>
					<?php if($main_store_id==5){?>

                          <div class="social-icons">
                            <div>
                              <a href="https://www.facebook.com/imprimeriecoop/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                              </a>
                              <a href="https://www.instagram.com/imprimeurcoop/" target="_blank">
                                <i class="fab fa-instagram"></i>
                              </a>
                              <a href="https://twitter.com/PrintingCoop" target="_blank">
                                <i class="fab fa-twitter"></i>
                              </a>
                              <a href="https://www.linkedin.com/company/printingcoop" target="_blank">
                                <i class="fab fa-linkedin"></i>
                              </a>
                              <a href="https://pinterest.com/imprimeurcoop" target="_blank">
                                <i class="fab fa-pinterest"></i>
                              </a>
                              <a href="https://www.youtube.com/channel/UC0UzU22tH8SRUaTuLeNGc_g" target="_blank">
                                <i class="fab fa-youtube"></i>
                              </a>
                            </div>
                          </div>
                        <?php
					}?>
					<?php if($main_store_id==6){?>

                          <div class="social-icons">
                            <div>
                              <a href="https://www.facebook.com/imprimeriecoop/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                              </a>
                              <a href="https://www.instagram.com/imprimeurcoop/" target="_blank">
                                <i class="fab fa-instagram"></i>
                              </a>
                              <a href="https://twitter.com/PrintingCoop" target="_blank">
                                <i class="fab fa-twitter"></i>
                              </a>
                              <a href="https://www.linkedin.com/company/printingcoop" target="_blank">
                                <i class="fab fa-linkedin"></i>
                              </a>
                              <a href="https://pinterest.com/imprimeurcoop" target="_blank">
                                <i class="fab fa-pinterest"></i>
                              </a>
                              <a href="https://www.youtube.com/channel/UC0UzU22tH8SRUaTuLeNGc_g" target="_blank">
                                <i class="fab fa-youtube"></i>
                              </a>
                            </div>
                          </div>
                        <?php
					}?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bootom-footer universal-half-spacing">
    <div class="container">
        <div class="bottom-footer-inner">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="bootom-footer-single">
                        <div class="copywrite-text">
                          <span>Copyright © <?php echo date('Y')?> <?php echo $language_name=='French' ? $configrations['copy_right_french']:$configrations['copy_right']; ?></span>
                        </div>
                        <div class="bottom-links">
						   <?php

                                $pages = $this->Page_Model->getPageList(true,'','',1,$website_store_id);
                                $pageSlugArray = pageSlug();
								foreach ($pages as $key => $page) {
                                  $slug = $page['slug'];
                                  $url = $BASE_URL.'Page/'.$slug;
                                  $datatoggle = $datatarget='';
                                    if (array_key_exists($slug,$pageSlugArray)) {
                                      $dataUrl = $pageSlugArray[$slug];
                                      $url = $BASE_URL.$dataUrl['class'].'/'.$dataUrl['action'];
                                  }
                               ?>

                                 <a href="<?php echo $url?>">
								 <?php if($language_name=='French'){
										echo ucfirst($page['title_france']);
									}else{
										echo ucfirst($page['title']);
									}
									?></a>
							<?php
							}?>

							<!--<a href="<?php echo $BASE_URL?>Privacy">Privacy</a>
                            <a href="#">Sitemap</a>-->

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="payment-types">
                        <!--<div class="universal-small-dark-title">-->
                        <!--    <span>Payment</span>-->
                        <!--</div>-->
                        <div class="payment-types-inner">
                            <img src="<?php echo $BASE_URL?>/assets/images/payment_method_logo.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="floating-icon" id="back-top" style="display: none;">
            <span><i class="fas fa-arrow-up"></i></span>
        </div>
    </div>
</div>
<?php $this->load->view('elements/msg-modal.php')?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo $BASE_URL?>/assets/js/bootstrap.js"></script>
<!-- <script src="//cdn.rawgit.com/tonystar/bootstrap-hover-tabs/v3.1.1/bootstrap-hover-tabs.js"></script> -->
<script src="<?php echo $BASE_URL?>/assets/js/customslider.js"></script>
<script src="<?php echo $BASE_URL?>/assets/js/validation.js"></script>
<script src="<?php echo $BASE_URL?>/assets/js/jquery.mask.min.js"></script>
<script>
$(document).ready(function(){
  $("#back-top").hide();
  $(function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $('#back-top').fadeIn();
      } else {
        $('#back-top').fadeOut();
      }
    });

    // scroll body to 0px on click
    $('#back-top span').click(function () {
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });
  });
});
</script>

<?php if($language_name=='French'){ ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-L7V7YLFS15"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-L7V7YLFS15');
  </script>
<?php }else{ ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-S5JX3QGBRH"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-S5JX3QGBRH');
  </script>
<?php }?>

<script>
language_name ='<?php echo $language_name;?>';

$(document).ready(function() {
    $(window).scroll(function(){
        if ($(window).scrollTop() > 50){
            $('.main-header').addClass('scrolled');
        } else {
            $('.main-header').removeClass('scrolled');
        }
    });
    /*$(".wishlist-area").click(function() {
        $(this).toggleClass("active");
        $(".addwishlist-message").addClass("active");
    });*/

    $("#show-adress-field").click(function() {
        $(".edit-address").show();
        $(".add-address-field").hide();
    });
    $("#cancel-address").click(function() {
        $(".edit-address").hide();
        $(".add-address-field").show();
        $("#checkout-new-address").hide();
    });
    $("#new-address").click(function() {
        $("#checkout-new-address").show();
    });
    $("#exsiting-address").click(function() {
        $("#checkout-new-address").hide();
    });
    $("#login-signup").click(function() {
        $("#login-signup-show").show();
    });
    $("#guest-signup").click(function() {
        $("#login-signup-show").hide();
    });

    $(".nav-pills a:first").tab('show');

    $(".all-menu li").hover(function() {
        $(".nav-pills a:first").tab('show');
    });

    $(".announcements-bar i").click(function() {
        $(".announcements-bar").slideToggle();
    });
    $('.account-icon').click(function(){
        $(".account-single-points").toggleClass("active");
    });
    $('.mob-drop-icon').click(function(){
        $(".mobile-drop").toggleClass("active");
        $(".mob-drop-cat").slideToggle();
    });
});
</script>

<script>
function openNav01(slow) {
    var e = document.getElementById("mySidenav");
    if (e.style.width == '100%')
    {
        e.style.width = '0px';
    }
    else
    {
        e.style.width = '100%';
    }
}

function closeNav01() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
<script>
function myFunction(x) {
    if (x.matches) { // If media query matches
        var galleryThumbs = new Swiper('.swiper-container-gallery-thumbs', {
        spaceBetween: 15,
        slidesPerView: 3,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
      });
      var galleryTop = new Swiper('.swiper-container-gallery-top', {
        spaceBetween: 15,
        thumbs: {
          swiper: galleryThumbs
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
      });
    } else {
      var galleryThumbs = new Swiper('.swiper-container-gallery-thumbs', {
        spaceBetween: 15,
        slidesPerView: 5,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
      });
      var galleryTop = new Swiper('.swiper-container-gallery-top', {
        spaceBetween: 15,
        thumbs: {
          swiper: galleryThumbs
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
      });
    }
}

var x = window.matchMedia("(max-width: 768px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes
</script>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
//document.getElementById("defaultOpen").click();
</script>

<script>
    if(language_name=='French'){
		/*login code start*/
		$('#login-form').validate({
			rules: {
			 loginemail: {
				required: true,
				email: true
			  },
			  loginpassword: {
				required: true,
			  }
			},
			messages: {
				loginemail: {
					required: 'Veuillez saisir un e-mail',
					email:"S'il vous plaît, mettez une adresse email valide",
				},
				 loginpassword: {
					required: 'Veuillez entrer le mot de passe',
				},
			},
			submitHandler: function(form) {
			  $("#loder-img").show();
			  var url ='<?php echo $BASE_URL ?>Logins/checkLoginByAjax';
			  $("#login-msg").html('');
			  $.ajax({
				type: "POST",
				url: url,
				data: $(form).serialize(), // serializes the form's elements.
				beforeSend:function() {
				   $('button[type=submit]').attr('disabled', true);
				},
				success: function(data) {
				  $("#loder-img").hide();
				  $('button[type=submit]').attr('disabled', false);
				   let response = JSON.parse(data);
				   let errors = response.errors;
				   let msg = response.msg;
				   let status = response.status;
				   $("#login-password").val('');
				   if (errors && Object.keys(errors).length) {
					 var validator = $(form).validate();
					 $.each(response.errors, function(key, value) {
						 validator.showErrors({[key] : value });
					 });
				   } else if (status === 'success') {
						let url=response.url;
						location.assign(url);
						//location.assign("<?php echo $BASE_URL ?>MyOrders");
				   } else {
					   $("#login-msg").html('<span><label style="color:red">'+msg+'</label></span>');
				   }
				},
				error: function (error) {
				   $('button[type=submit]').attr('disabled', false);
				   $("#login-msg").html('<span><label style="color:red">'+msg+'</label></span>');
				},
			  });
			},
		});
	}else{
		$('#login-form').validate({
			rules: {
			 loginemail: {
				required: true,
				email: true
			  },
			  loginpassword: {
				required: true,
			  }
			},
			messages: {
				loginemail: {
					required: 'Please Enter Email',
				},
				 loginpassword: {
					required: 'Please Enter Password',
				},
			},
			submitHandler: function(form) {
			  $("#loder-img").show();
			  var url ='<?php echo $BASE_URL ?>Logins/checkLoginByAjax';
			  $("#login-msg").html('');
			  $.ajax({
				type: "POST",
				url: url,
				data: $(form).serialize(), // serializes the form's elements.
				beforeSend:function() {
				   $('button[type=submit]').attr('disabled', true);
				},
				success: function(data) {
				  $("#loder-img").hide();
				  $('button[type=submit]').attr('disabled', false);
				   let response = JSON.parse(data);
				   let errors = response.errors;
				   let msg = response.msg;
				   let status = response.status;
				   $("#login-password").val('');
				   if (errors && Object.keys(errors).length) {
					 var validator = $(form).validate();
					 $.each(response.errors, function(key, value) {
						 validator.showErrors({[key] : value });
					 });
				   } else if (status === 'success') {
						location.assign("<?php echo $BASE_URL ?>MyOrders");
				   } else {
					   $("#login-msg").html('<span><label style="color:red">'+msg+'</label></span>');
				   }
				},
				error: function (error) {
				   $('button[type=submit]').attr('disabled', false);
				   $("#login-msg").html('<span><label style="color:red">'+msg+'</label></span>');
				},
			  });
			},
		});
	}
	/*login code end*/

	/*signup code start*/
	if(language_name=='French'){
		$('#signup-form').validate({
			rules: {
			  fname: {
				required: true,
			  },
			  lname: {
				required: true,
			  },
			  email: {
				required: true,
				email: true,
			  },
			  password: {
				required: true,
				minlength: 8,
				maxlength: 20,
			  },
			  confirm_password: {
				required: true,
				minlength: 8,
				maxlength: 20,
				equalTo : '#signup-password',
			  },
			},
			messages: {
				fname: {
					required: 'Veuillez entrer le prénom',
				},
				lname: {
					required: 'Veuillez saisir votre nom',
				},
				email: {
					required: 'Veuillez saisir un e-mail',
					email:"S'il vous plaît, mettez une adresse email valide",
				},
				password: {
					required: 'Veuillez entrer le mot de passe',
					minlength:'Veuillez saisir au moins 8 caractères.',
					maxlength:'Veuillez ne pas saisir plus de 20 caractères'
				},
				confirm_password: {
					required: 'Veuillez saisir le mot de passe',
					equalTo: 'Le champ Confirmer le mot de passe ne correspond pas au champ Mot de passe',
					minlength:'Veuillez saisir au moins 8 caractères.',
					maxlength:'Veuillez ne pas saisir plus de 20 caractères'
				},
			},

			submitHandler: function(form) {
			  $("#loder-img").show();
			  var url ='<?php echo $BASE_URL ?>Logins/signup';
			  $("#signup-msg").html('');
			  $.ajax({
				   type: "POST",
				   url: url,
				   data: $(form).serialize(), // serializes the form's elements.
				   beforeSend:function() {
					  $('button[type=submit]').attr('disabled', true);
				   },
				   success: function(data) {
					  $("#loder-img").hide();
					  $('button[type=submit]').attr('disabled', false);
					  let response = JSON.parse(data);
					  let errors = response.errors;
					  let msg = response.msg;
					  let status = response.status;
					  $("#signup-password").val('');
					  $("#confirm-password").val('');
					  if (errors && Object.keys(errors).length) {
						var validator = $(form).validate();
						$.each(response.errors, function(key, value) {
							validator.showErrors({[key] : value });
						});
					  } else if (status === 'success') {
						  $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
						  $("#msg-modal").modal('show');
						  setTimeout(function(){ location.reload(); }, 2000);
					  } else {
						  $("#signup-msg").html('<span><label style="color:red">'+msg+'</label></span>');
					  }
				   },
				   error: function (error) {
					  $('button[type=submit]').attr('disabled', false);
					  $("#signup-msg").html('<span><label style="color:red">'+msg+'</label></span>');
				   },
			  });
			},
		});
	}else{
		$('#signup-form').validate({
			rules: {
			  fname: {
				required: true,
			  },
			  lname: {
				required: true,
			  },
			  email: {
				required: true,
				email: true,
			  },
			  password: {
				required: true,
				minlength: 8,
				maxlength: 20,
			  },
			  confirm_password: {
				required: true,
				minlength: 8,
				maxlength: 20,
				equalTo : '#signup-password',
			  },
			},
			messages: {
				fname: {
					required: 'Please Enter First Name',
				},
				lname: {
					required: 'Please Enter Last Name',
				},
				email: {
					required: 'Please Enter Email',
				},
				password: {
					required: 'Please Enter Password',
				},
				confirm_password: {
					required: 'Please Enter Confirm Password',
					equalTo: 'Confirm Password Field Does Not Match The Password Field'
				},
			},
			submitHandler: function(form) {
			  $("#loder-img").show();
			  var url ='<?php echo $BASE_URL ?>Logins/signup';
			  $("#signup-msg").html('');
			  $.ajax({
				   type: "POST",
				   url: url,
				   data: $(form).serialize(), // serializes the form's elements.
				   beforeSend:function() {
					  $('button[type=submit]').attr('disabled', true);
				   },
				   success: function(data) {
					  $("#loder-img").hide();
					  $('button[type=submit]').attr('disabled', false);
					  let response = JSON.parse(data);
					  let errors = response.errors;
					  let msg = response.msg;
					  let status = response.status;
					  $("#signup-password").val('');
					  $("#confirm-password").val('');
					  if (errors && Object.keys(errors).length) {
						var validator = $(form).validate();
						$.each(response.errors, function(key, value) {
							validator.showErrors({[key] : value });
						});
					  } else if (status === 'success') {
						  $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
						  $("#msg-modal").modal('show');
						  setTimeout(function(){ location.reload(); }, 2000);
					  } else {
						  $("#signup-msg").html('<span><label style="color:red">'+msg+'</label></span>');
					  }
				   },
				   error: function (error) {
					  $('button[type=submit]').attr('disabled', false);
					  $("#signup-msg").html('<span><label style="color:red">'+msg+'</label></span>');
				   },
			  });
			},
		});
	}

	/*signup code end*/

	/*Preferred code start*/
	if(language_name=='French'){
		$('#Preferred-Customer').validate({
        rules: {
          fname: {
            required: true,
          },
          lname: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 8,
            maxlength: 20,
          },
          /*confirm_password: {
            required: true,
            minlength: 8,
            maxlength: 20,
            equalTo : '#signup-password',
          },*/
        },
        messages: {
            fname: {
                required: 'Veuillez entrer le prénom',
            },
            lname: {
                required: 'Veuillez saisir votre nom',
            },
            email: {
                required: 'Veuillez saisir un e-mail',
				email:"S'il vous plaît, mettez une adresse email valide."
            },
            password: {
                required: 'Veuillez entrer le mot de passe',
				minlength:'Veuillez saisir au moins 8 caractères',
				maxlength:'Veuillez ne pas saisir plus de 20 caractères.'
            },
			company_name:{
				 required: "veuillez entrer le nom de l'entreprise",
			},
			responsible_name:{
				 required: "veuillez entrer le nom du responsable",
			},
			cp:{
				 required: "veuillez entrer cp",
			},
			active_area:{
				 required: "veuillez entrer dans la zone active",
			},
			address:{
				required: "veuillez entrer l'adresse",
			},
			mobile:{
				required: "veuillez entrer mobile",
			},
			country:{
				required: "choisissez le pays",
			},
			region:{
				required: "choisissez une région",
			},
			city:{
				required: "entrer dans la ville",
			},
			zip_code:{
				required: "entrer le code postal",
			},
			request:{
				required: "entrer la demande",
			}

            /*confirm_password: {
                required: 'Please Enter Confirm Password',
                equalTo: 'Confirm Password Field Does Not Match The Password Field'
            },*/
        },
        submitHandler: function(form) {
		   $("#loder-img").show();
          var url ='<?php echo $BASE_URL ?>Logins/preferred_customer_signup';
          $("#signup-msg").html('');

          $.ajax({
               type: "POST",
               url: url,
               data: $(form).serialize(), // serializes the form's elements.
               beforeSend:function() {
                  $('button[type=submit]').attr('disabled', true);
               },
               success: function(data) {
				 $("#loder-img").hide();
                 $('button[type=submit]').attr('disabled', false);
                  var response = JSON.parse(data);
                  var errors = response.errors;
                  var msg = response.msg;
                  var status = response.status;
                  $("#signup-password").val('');
				  //console.log(response);
				  if (status == 'success') {
                      $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
                      $("#msg-modal").modal('show');
                      setTimeout(function(){ location.reload(); }, 2000);
                  } else {
                      $("#signup-msg").html('<span><label style="color:red">'+msg+'</label></span>');
                  }
               },
               error: function (error) {
                  $('button[type=submit]').attr('disabled', false)
               },
          });
        },
    });
	}else{
		$('#Preferred-Customer').validate({
        rules: {
          fname: {
            required: true,
          },
          lname: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 8,
            maxlength: 20,
          },
          /*confirm_password: {
            required: true,
            minlength: 8,
            maxlength: 20,
            equalTo : '#signup-password',
          },*/
        },
        messages: {
            fname: {
                required: 'Please Enter First Name',
            },
            lname: {
                required: 'Please Enter Last Name',
            },
            email: {
                required: 'Please Enter Email',
            },
            password: {
                required: 'Please Enter Password',
            },
            /*confirm_password: {
                required: 'Please Enter Confirm Password',
                equalTo: 'Confirm Password Field Does Not Match The Password Field'
            },*/
        },
        submitHandler: function(form) {
		   $("#loder-img").show();
          var url ='<?php echo $BASE_URL ?>Logins/preferred_customer_signup';
          $("#signup-msg").html('');

          $.ajax({
               type: "POST",
               url: url,
               data: $(form).serialize(), // serializes the form's elements.
               beforeSend:function() {
                  $('button[type=submit]').attr('disabled', true);
               },
               success: function(data) {
				 $("#loder-img").hide();
                 $('button[type=submit]').attr('disabled', false);
                  var response = JSON.parse(data);
                  var errors = response.errors;
                  var msg = response.msg;
                  var status = response.status;
                  $("#signup-password").val('');
				  //console.log(response);
				  if (status == 'success') {
                      $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
                      $("#msg-modal").modal('show');
                      setTimeout(function(){ location.reload(); }, 2000);
                  } else {
                      $("#signup-msg").html('<span><label style="color:red">'+msg+'</label></span>');
                  }
               },
               error: function (error) {
                  $('button[type=submit]').attr('disabled', false)
               },
          });
        },
    });
	}
	/*Preferred code end*/
	if(language_name=='French'){
	   $('#email-subscribe').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
        },
        messages: {
            email: {
                required: 'Veuillez saisir un e-mail',
				email:"S'il vous plaît, mettez une adresse email valide."
            },
        },
        submitHandler: function(form) {
          var url ='<?php echo $BASE_URL ?>Products/emailSubscribe';
          $.ajax({
               type: "POST",
               url: url,
               data: $(form).serialize(), // serializes the form's elements.
               beforeSend:function() {
                  $('button[type=submit]').attr('disabled', true);
               },
               success: function(data) {
                 $('button[type=submit]').attr('disabled', false);
                  let response = JSON.parse(data);
                  let errors = response.errors;
                  let msg = response.msg;
                  let status = response.status;
                  $("#subscribe-email").val('');
                  if (errors && Object.keys(errors).length) {
                    var validator = $(form).validate();
                    $.each(response.errors, function(key, value) {
                        validator.showErrors({[key] : value });
                    });
                  } else if (status === 'success') {
                      $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
                      $("#msg-modal").modal('show');
                  } else {
                      $("#subscribe-message").html('<span class="text-light"><label class="mt-2">'+msg+'</label></span>');
                  }
               },
               error: function (error) {
                  $('button[type=submit]').attr('disabled', false);
                  $("#subscribe-message").html('<span class="text-light"><label class="mt-2">'+msg+'</label></span>');
               },
          });
        },
    });
	}else{
		$('#email-subscribe').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
        },
        messages: {
            email: {
                required: 'Please Enter Email',
            },
        },
        submitHandler: function(form) {
          var url ='<?php echo $BASE_URL ?>Products/emailSubscribe';
          $.ajax({
               type: "POST",
               url: url,
               data: $(form).serialize(), // serializes the form's elements.
               beforeSend:function() {
                  $('button[type=submit]').attr('disabled', true);
               },
               success: function(data) {
                 $('button[type=submit]').attr('disabled', false);
                  let response = JSON.parse(data);
                  let errors = response.errors;
                  let msg = response.msg;
                  let status = response.status;
                  $("#subscribe-email").val('');
                  if (errors && Object.keys(errors).length) {
                    var validator = $(form).validate();
                    $.each(response.errors, function(key, value) {
                        validator.showErrors({[key] : value });
                    });
                  } else if (status === 'success') {
                      $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
                      $("#msg-modal").modal('show');
                  } else {
                      $("#subscribe-message").html('<span class="text-light"><label class="mt-2">'+msg+'</label></span>');
                  }
               },
               error: function (error) {
                  $('button[type=submit]').attr('disabled', false);
                  $("#subscribe-message").html('<span class="text-light"><label class="mt-2">'+msg+'</label></span>');
               },
          });
        },
    });
	}

    $('#product-sorter').change(function() {
        this.form.submit();
    });

    $('#ratting-form').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          name: {
            required: true,
          },
          review: {
            required: true,
          },
        },
        messages: {
            email: {
                required: 'Please Enter Email',
            },
            name: {
                required: 'Please Enter Name',
            },
            review: {
                required: 'Please Enter Review',
            },
        },
        submitHandler: function(form) {
          var url ='<?php echo $BASE_URL ?>Products/addRating';
          $.ajax({
               type: "POST",
               url: url,
               data: $(form).serialize(), // serializes the form's elements.
               beforeSend:function() {
                  $('button[type=submit]').attr('disabled', true);
               },
               success: function(data) {
                 $('button[type=submit]').attr('disabled', false);
                  let response = JSON.parse(data);
                  let errors = response.errors;
                  let msg = response.msg;
                  let status = response.status;
                  $("#review").val('');
                  $('input[name="rate"]').prop('checked', false);
                  if (errors && Object.keys(errors).length) {
                    var validator = $(form).validate();
                    $.each(response.errors, function(key, value) {
                        validator.showErrors({[key] : value });
                    });
                  } else if (status === 'success') {
                      $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
                      $("#msg-modal").modal('show');
                      setTimeout(function(){
                          location.reload();
                      }, 2000);
                  } else {
                    $("#msg-modal .modal-body").html('<span style="color:red">'+msg+'</span>');
                    $("#msg-modal").modal('show');
                  }
               },
               error: function (error) {
                  $('button[type=submit]').attr('disabled', false);
                  $("#msg-modal .modal-body").html('<span style="color:red">'+msg+'</span>');
                  $("#msg-modal").modal('show');
               },
          });
        },
    });

  function updateCardItem(product_id, rowId, quantity) {
	  if(rowId !='' && quantity !='') {
             var url ='<?php echo $BASE_URL ?>ShoppingCarts/updateCardItem';
			$.ajax({
				   type: "POST",
				   url: url,
				   data:{'product_id': product_id, 'rowId':rowId,'quantity':quantity}, // serializes the form's elements.
				   success: function(data) {
						var json = JSON.parse(data);
						var status=json.status;
						var msg=json.msg;
            if (json.total_item == 0) {
                $('#shoping-cart-container').html('<div class="text-center"><h4 class="lead">Shopping Cart Is Empty</h4></div>');
                $('#shop-cart-table').html('');
            }
			if (status ==1 ) {
              $(".cart-contents-count").html(json.total_item);
              $(".cart-sub-total").html(json.sub_total);
              $("."+rowId+"-product-row-sub-total").html(json.row_sub_total);
              getCardItem();
              //$(".after-click").show();
              //$(".before-click").hide();
			    $('.addtocart-message').html('<span><i class="la la-cart-plus"></i>'+msg+'.</span>').addClass("active");
				 setTimeout(function() {
					 $('.addtocart-message').removeClass("active");
				 }, 2000);
			      } else {
                             $('.addtocart-message').html('<span><i class="la la-cart-plus"></i>'+msg+'.</span>').addClass("active");
				         setTimeout(function() {
					       $('.addtocart-message').removeClass("active");
				          }, 2000);
						}
					},
					error: function (error) {
					}
			});
		}
  }

  function getCardItem() {
      var url ='<?php echo $BASE_URL ?>ShoppingCarts/getCardItemByAjax';
      $.ajax({
            type: "GET",
            url: url,
            success: function(data)
            {
            $(".cart-items-table").html(data);
          },
          error: function (error) {
          }
      });
   }

   $("#checkoutForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var ck_moblie_number=$("#ck_moblie_number").val();
    $("#ck_moblie_number_error").html('');
    var formsubmit = true;
    $("#checkoutContinue").attr("disabled",true);

    if (ck_moblie_number =='') {
       $("#ck_moblie_number_error").html("Please enter email id.");
       formsubmit = false;
     } else if (ValidateEmail(ck_moblie_number)) {
       $("#ck_moblie_number_error").html("Please enter valied email id.");
       formsubmit = false;
     }
    if (formsubmit == true) {
	   $("#loder-img").show();
      var url ='<?php echo $BASE_URL ?>Logins/checkMobileByAjax';
      $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data) {
			   $("#loder-img").hide();
             $("#checkoutContinue").attr("disabled",true);
             var json = JSON.parse(data);
             var status=json.status;
             var msg=json.msg;
             if (status==1) {
              if (json.login == 1) {
                  $("#checkoutFormPenal").hide();
                  $("#LoginFormPenal").show();
                  $("#ck_login_mobile").val(ck_moblie_number);
               } else if (json.login == 2) {
                  $("#ck_signup_mobile").val(ck_moblie_number);
                  if (json.otp !='') {
                    $("#checkoutFormPenal").hide();
                    $("#signupFormPanel").show();
                    $("#ck_signupOtp").val(json.otp);
                    $("#ck_signupOtpMobile").val(ck_moblie_number);
                    $("#ck_signup_mobile_error").html('<label style="color:green">'+json.msg+'</label>');
                  } else {
                    $("#ck_moblie_number_error").html('<label style="color:red">'+json.msg+'</label>');
                  }
               }
            } else {
                $("#checkoutContinue").attr("disabled",false);
            }
           },
           error: function (error) {
              $("#checkoutContinue").attr("disabled",false);
           }
      });
    } else {
        $("#checkoutContinue").attr("disabled",false);
    }
   });

   function removeCardItem(rowId,product_id) {
	  if(language_name == 'French'){
		 var result = confirm("Voulez-vous vraiment supprimer l'article du panier ?");
	  }else{
		  var result = confirm("Are you sure you want to delete cart item ?");
	  }
      if(rowId !='' && result==true){
      var url ='<?php echo $BASE_URL ?>ShoppingCarts/removeCardItem';
      $.ajax({
          type: "POST",
          url: url,
          data:{'rowId': rowId}, // serializes the form's elements.
          success: function(data) {
           var json = JSON.parse(data);
           var status=json.status;
           var msg = json.msg;
           if (status == 1){
             if(json.total_item == 0) {
			   if(language_name == 'French'){
			       $('#shoping-cart-container').html("<div class='text-center'><h4 class='lead'>Le panier d'achat est vide</h4></div>");
			   }else{
				   $('#shoping-cart-container').html('<div class="text-center"><h4 class="lead">Shopping Cart Is Empty</h4></div>');
			   }

               $('#shop-cart-table').html('');
             }
             $(".cart-contents-count").html(json.total_item);
             $(".cart-sub-total").html(json.sub_total);
             $("."+rowId).remove();
             getCardItem();
             $(".after-click").show();
             $(".before-click").hide();
             $('.addtocart-message').html('<span><i class="la la-cart-plus"></i>'+msg+'.</span>').addClass("active");
             setTimeout(function() {
                 $('.addtocart-message').removeClass("active");
             }, 2000);
           } else {
             $('.addtocart-message').html('<span><i class="la la-cart-plus"></i>'+msg+'.</span>').addClass("active");
             setTimeout(function() {
                 $('.addtocart-message').removeClass("active");
             }, 2000);
           }
         },
         error: function (error) {
         }
     });
 		}
  }
  function ValidateEmail(email) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        return false;
    } else {
       return true;
    }
  }

  $("#CkLoginForm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var ck_login_mobile = $("#ck_login_mobile").val();
    var ck_login_password = $("#ck_login_password").val();
    $("#ck_login_mobile_error,#ck_login_password_error").html('');
    var formsubmit = true;
    $("#ckloginSubmit").attr("disabled", true);

    if (ck_login_mobile == '') {
        $("#ck_login_mobile_error").html("Please enter email id.");
        formsubmit=false;
    }

    if (ck_login_password == ''){
        $("#ck_login_password_error").html("Please enter password.");
        formsubmit=false;
    }

    if (formsubmit==true) {
	  $("#loder-img").show();
      var url ='<?php echo $BASE_URL ?>Logins/checkLoginByAjax';
      $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data) {
           var response = JSON.parse(data);
           var status = response.status;
           var msg    = response.msg;
           var errors = response.errors;
            $("#ck_login_password").val('');
            if (errors && Object.keys(errors).length) {
			  $("#loder-img").hide();
              $("#ck_login_mobile_error").html(errors.loginemail);
              $("#ck_login_password_error").html(errors.loginpassword);
              $("#ckloginSubmit").attr("disabled",false);
              $("#ck_login_msg").html('');
            } else if (status === 'success') {
               location.reload();
            }  else {
			   $("#loder-img").hide();
               $("#ck_login_msg").html('<label style="color:red;padding:0px;">'+msg+'</label>');
               $("#ckloginSubmit").attr("disabled",false);
            }
           },
           error: function (error) {
              $("#ckloginSubmit").attr("disabled",false);
           }
      });
    } else {
       $("#ckloginSubmit").attr("disabled",false);
    }
  });

  $("#CksignupForm").submit(function(e) {
     e.preventDefault(); // avoid to execute the actual submit of the form.
     var form = $(this);
       $('#ck_signup_mobile_error,#ck_singup_inputOtp_error,#ck_signup_fname_error,#ck_signup_lname_error,#ck_signup_password_error,#ck_signup_email_error').html('');

     var mobile = $("#ck_signup_mobile").val();
     var inputOtp = $("#ck_singup_inputOtp").val();
     var signupOtp = $("#ck_signupOtp").val();
     var signupOtpMobile = $("#ck_signupOtpMobile").val();
     var fname = $("#ck_fname").val();
     var lname = $("#ck_lname").val();
     //var email=$("#ck_signup_email").val();
     var signup_password=$("#ck_signup_password").val();
     $("#cksignupSubmit").attr("disabled",true);
     formsubmit = true;

     if (mobile == ''){
         $("#ck_signup_email_error").html("Please enter email number.");
         formsubmit = false;
     } else if(ValidateEmail(mobile)){
         $("#ck_signup_email_error").html("Please enter valied email id.");
         formsubmit = false;
     }

     if (fname == '') {
         $("#ck_signup_fname_error").html("Please enter first name.");
         formsubmit = false;
     }

     if (inputOtp =='') {
         $("#ck_singup_inputOtp_error").html("Please enter code.");
         formsubmit = false;
     } else if(signupOtp =='' || signupOtp !=inputOtp || signupOtpMobile!=mobile) {
         $("#ck_singup_inputOtp_error").html("Invalid  code.");
         formsubmit = false;
     }

     if (signup_password =='') {
         $("#ck_signup_password_error").html("Please enter Password.");
         formsubmit = false;
     } else if (signup_password.length < 8) {
         $("#ck_signup_password_error").html("Password length must be exactly 8 characters");
         formsubmit = false;
     }

     if(formsubmit == true) {
	   $("#loder-img").show();
       var url ='<?php echo $BASE_URL ?>Logins/signup';
       $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
			 $("#loder-img").hide();
             $("#cksignupSubmit").attr("disabled",false);
             $("#signup_password").val('');
             var response = JSON.parse(data);
             var status = response.status;
             var msg    = response.msg;
             var errors = response.errors;
             $("#ck_signup_confirm_password").val('');
             if (errors && Object.keys(errors).length) {
               $.each(errors, function(id, message) {
                   $("#ck_signup_"+id+"_error").html(message);
               });
             } else if (status === 'success') {
               var url ='<?php echo $BASE_URL ?>Logins/checkLoginByAjax';
               $.ajax({
                  type: "POST",
                  url: url,
                  data: {'loginemail': mobile,'loginpassword': signup_password}, // serializes the form's elements.
                  success: function(data) {
                    var response = JSON.parse(data);
                    var status = response.status;
                    var msg    = response.msg;
                    var errors = response.errors;
                    $("#ck_signup_password").val('');
                    $("#ck_signup_mobile_error").val('');
                    if (errors && Object.keys(errors).length) {
                      $("#cksignupSubmit").attr("disabled",false);
                      $("#ck_login_mobile_error").html(errors.loginemail);
                      $("#ck_login_password_error").html(errors.loginpassword);
                    } else if (status === 'success') {
                        setTimeout(function(){ location.reload(); }, 2000);
                    } else {
                        $("#ck_signup_msg").html('<label style="color:red">'+msg+'</label>');
                        $("#cksignupSubmit").attr("disabled",false);
                    }
                  },
                  error: function (error) {
                  }
                 });
               } else {
                 $("#ck_signup_msg").html('<label style="color:red">'+msg+'</label>');
             }
            },
            error: function (error) {
               $("#cksignupSubmit").attr("disabled",false);
            }
       });
     } else {
        $("#cksignupSubmit").attr("disabled",false);
     }
  });

    function sendOptToEmail() {
      $("#account-change-pswd").attr("disabled",true);
      $("#send-otp").val('');
      $("#account-email-error,#input-otp-error,#new-password-error,#g-recaptcha-error").html('');

      var accountEmail = $("#account-email").val();
	  var g_recaptcha_response= $("#g-recaptcha-response").val();
      formsubmit = true;

      if (accountEmail == '') {
		        $("#account-email-error").html("Please enter email id.");
		    if(language_name=='French'){
			    $("#account-email-error").html("Veuillez saisir votre adresse e-mail.");
		    }

          formsubmit = false;
      } else if (ValidateEmail(accountEmail)) {
           $("#account-email-error").html("Please enter valied email id.");
		    if(language_name=='French'){
			    $("#account-email-error").html("Veuillez saisir une adresse e-mail valide.");
		    }
          formsubmit = false;
      }
	  if (g_recaptcha_response =='') {
          $("#g-recaptcha-error").html("Please select recaptcha");
		  if(language_name=='French'){
			    $("#g-recaptcha-error").html("Veuillez sélectionner recaptcha.");
		    }
          formsubmit = false;
      }

      if (formsubmit == true) {
		$("#loder-img").show();
        var url ='<?php echo $BASE_URL ?>MyAccounts/sendOtp';
        $.ajax({
             type: "POST",
             url: url,
             data: {'account_email': accountEmail, 'type':'Reset Password' }, // serializes the form's elements.
             success: function(data) {
			  $("#loder-img").hide();
              $("#login_password").val('');
              var response = JSON.parse(data);
              var status = response.status;
              var msg = response.msg;
              var errors = response.errors;
              $("#account-change-pswd").attr("disabled",false);
              if (errors && Object.keys(errors).length) {
                  $('#account-email-error').html(errors['account-email-error']);
              } else if (status) {
				    $('.g-recaptcha').hide();
                    $("#account-email-error").html('<label style="color:green">'+msg+'</label>');
                    $("#send-otp").val(response.otp);
                    $("#otp-container").show();
                    $("#account-change-pswd").text('Resend');
                } else {
                  $("#account-email-error").html('<label style="color:red">'+msg+'</label>');
               }
              },
              error: function (error) {
                $("#account-change-pswd").attr("disabled",false);
              }
        });
      } else {
         $("#account-change-pswd").attr("disabled",false);
      }
    }

    //For password-form Code
	if(language_name=='French'){
	  $("#password-form").submit(function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var form = $(this);
      $("#account-email-error, #input-otp-error, #new-password-error").html('');
      var email = $("#account-email").val();
      var inputOtp = $("#input-otp").val();
      var sendOtp = $("#send-otp").val();
      var newPassword = $("#new-password").val();

      $("#Fsubmit").attr("disabled",true);
      formsubmit = true;

      if (email =='') {
          $("#account-email-error").html("Veuillez saisir votre adresse e-mail.");
          formsubmit = false;
      } else if (ValidateEmail(email)) {
          $("#account-email-error").html("Veuillez saisir une adresse e-mail valide.");
          formsubmit = false;
      }

      if (inputOtp == '') {
          $("#input-otp-error").html("Veuillez entrer le code Otp.");
          formsubmit = false;
      } else if(sendOtp =='' || sendOtp != inputOtp) {
          $("#input-otp-error").html("Code invalide.");
          formsubmit = false;
      }

      if (newPassword == '') {
          $("#new-password-error").html("Veuillez entrer le mot de passe.");
          formsubmit = false;
      } else if (newPassword.length < 8) {
          $("#new-password-error").html("La longueur du mot de passe doit contenir exactement 8 caractères");
          formsubmit = false;
      }

    if(formsubmit==true) {
		  $("#loder-img").show();
          var url ='<?php echo $BASE_URL ?>MyAccounts/saveChangePassword';
          $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data) {
                  $("#Fsubmit").attr("disabled",false);
                  $("#new-password").val('');
                  var response = JSON.parse(data);
                  var status = response.status;
                  var msg = response.msg;
                  var errors = response.errors;

                  $.each(errors, function(id, message) {
                      $("#"+id).html(message);
                  });

                  if (status == 1) {
					 $("#loder-img").hide();
                     $("#forgot_msg").html('<label style="color:green">'+msg+'</label>');
                     if (loginId !='') {
                         setTimeout(function(){ window.location.href='<?php echo $BASE_URL?>MyAccounts/logout'}, 2000);
                     } else{
                         setTimeout(function(){ window.location.href='<?php echo $BASE_URL?>/Logins' }, 2000);
                     }
                  } else {
                      $("#forgot_msg").html('<label style="color:red">'+msg+'</label>');
                  }
              },
              error: function (error) {
                $("#Fsubmit").attr("disabled", false);
              }
          });
      } else {
        $("#Fsubmit").attr("disabled", false);
      }
    });
	}else{
	  $("#password-form").submit(function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var form = $(this);
      $("#account-email-error, #input-otp-error, #new-password-error").html('');
      var email = $("#account-email").val();
      var inputOtp = $("#input-otp").val();
      var sendOtp = $("#send-otp").val();
      var newPassword = $("#new-password").val();

      $("#Fsubmit").attr("disabled",true);
      formsubmit = true;

      if (email =='') {
          $("#account-email-error").html("Please enter email id.");
          formsubmit = false;
      } else if (ValidateEmail(email)) {
          $("#account-email-error").html("Please enter valied email id.");
          formsubmit = false;
      }

      if (inputOtp == '') {
          $("#input-otp-error").html("Please Enter Otp code.");
          formsubmit = false;
      } else if(sendOtp =='' || sendOtp != inputOtp) {
          $("#input-otp-error").html("Invalid  code.");
          formsubmit = false;
      }

      if (newPassword == '') {
          $("#new-password-error").html("Please enter Password.");
          formsubmit = false;
      } else if (newPassword.length < 8) {
          $("#new-password-error").html("Password length must be exactly 8 characters");
          formsubmit = false;
      }

      if (formsubmit==true) {
		  $("#loder-img").show();
          var url ='<?php echo $BASE_URL ?>MyAccounts/saveChangePassword';
          $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data) {
                  $("#Fsubmit").attr("disabled",false);
                  $("#new-password").val('');
                  var response = JSON.parse(data);
                  var status = response.status;
                  var msg = response.msg;
                  var errors = response.errors;

                  $.each(errors, function(id, message) {
                      $("#"+id).html(message);
                  });

                  if (status == 1) {
					 $("#loder-img").hide();
                     $("#forgot_msg").html('<label style="color:green">'+msg+'</label>');
                     if (loginId !='') {
                         setTimeout(function(){ window.location.href='<?php echo $BASE_URL?>MyAccounts/logout'}, 2000);
                     } else{
                         setTimeout(function(){ window.location.href='<?php echo $BASE_URL?>/Logins' }, 2000);
                     }
                  } else {
                      $("#forgot_msg").html('<label style="color:red">'+msg+'</label>');
                  }
              },
              error: function (error) {
                $("#Fsubmit").attr("disabled", false);
              }
          });
      } else {
        $("#Fsubmit").attr("disabled", false);
      }
    });
	}
    //For password-form Code end

  function cksendOptSignupMobile() {
    $("#ck-signup-continue").attr("disabled",true);
    $("ck_signupOtp").val('');

    var mobile=$("#ck_signup_mobile").val();
    formsubmit = true;

    if (mobile =='') {
        $("#ck_signup_email_error").html("Please enter email id.");
        formsubmit=false;
    } else if (ValidateEmail(mobile)) {
      $("#ck_signup_email_error").html("Please enter valied email id.");
      formsubmit = false;
    }

    if (formsubmit==true) {
	  $("#loder-img").show();
      var url ='<?php echo $BASE_URL ?>Logins/sendOtpSingup/';
      $.ajax({
           type: "POST",
           url: url,
           data:{'mobile':mobile,'type':'Signup'}, // serializes the form's elements.
           success: function(data) {
			$("#loder-img").hide();
            $("#ck-signup-continue").attr("disabled",false);
            var json = JSON.parse(data);
            var status=json.status;
            var msg=json.msg;

              if (status == 1 ) {
                var status=
                $("#ck_signup_email_error").html('<label style="color:green">'+msg+'</label>');
                $("#ck_signupOtp").val(json.otp);
                $("#ck_signupOtpMobile").val(mobile);
                } else {
                  $("#ck_signup_email_error").html('<label style="color:red">'+msg+'</label>');
              }
           },
           error: function (error) {
               $("#ck-signup-continue").attr("disabled",false);
           }
      });
    } else {
       $("#ck-signup-continue").attr("disabled",false);
    }
  }

  $('#checkout-address').validate({
      rules: {
        first_name: {
          required: true,
        },
        last_name: {
          required: true,
        },
        mobile: {
          required: true,
          //number: true,
          maxlength: 14,
          minlength: 6,
        },
        address: {
          required: true,
        },
        country: {
          required: true,
        },
        city: {
          required: true,
        },
        state: {
          required: true,
        },
        pin_code: {
          required: true,
          //maxlength: 6,
          //minlength: 6,
        },
      },
      messages: {
          first_name: {
              required: 'Please Enter First Name',
          },
          last_name: {
              required: 'Please Enter Last Name',
          },
          mobile: {
              required: 'Please Enter Phone Number',
          },
          address: {
              required: 'Please Enter Address',
          },
          country: {
             required: 'Please Enter Country',
          },
          city: {
              required: 'Please Enter City',
          },
          state: {
              required: 'Please Select State',
          },
          pin_code: {
              required: 'Please Enter Pincode',
          },
      },
      submitHandler: function(form) {
		 $("#loder-img").show();
        var url  = '<?php echo $BASE_URL ?>MyAccounts/addEditAddress';
        $.ajax({
          type: "POST",
          url: url,
          data: $(form).serialize(), // serializes the form's elements.
          beforeSend:function() {
             $('button[type=submit]').attr('disabled', true);
          },

          success: function(data) {
            $('button[type=submit]').attr('disabled', false);
             let response = JSON.parse(data);
             let errors = response.errors;
             let msg = response.msg;
             let status = response.status;
             $("#login-password").val('');
			  $("#loder-img").hide();
             if (errors && Object.keys(errors).length) {
               var validator = $(form).validate();
               $.each(response.errors, function(key, value) {
                   validator.showErrors({[key] : value });
               });
             } else if (status === 'success') {
				$('#checkout-address')[0].reset();
                $('#address-list').append(response.data);
				$('#Save-and-Deliver-here').show();
				$('#checkout-new-address').hide();
				location.reload();
             } else {
                 $("#login-msg").html('<span><label style="color:red">'+msg+'</label></span>');
             }
          },
          error: function (error) {
             $('button[type=submit]').attr('disabled', false);
             $("#login-msg").html('<span><label style="color:red">'+msg+'</label></span>');
          },
        });
      },
  });

  $('#add-new-address').validate({
      rules: {
        first_name: {
          required: true,
        },
        last_name: {
          required: true,
        },
        mobile: {
          required: true,
          //number: true,
          maxlength: 14,
          minlength: 6,
        },
        address: {
          required: true,
        },
        country: {
          required: true,
        },
        city: {
          required: true,
        },
        state: {
          required: true,
        },
        pin_code: {
          required: true,
          //maxlength: 6,
          //minlength: 6,
        },
      },
      messages: {
          first_name: {
              required: 'Please Enter First Name',
          },
          last_name: {
              required: 'Please Enter Last Name',
          },
          mobile: {
              required: 'Please Enter Phone Number',
          },
          address: {
              required: 'Please Enter Address',
          },
          country: {
             required: 'Please Enter Country',
          },
          city: {
              required: 'Please Enter City',
          },
          state: {
              required: 'Please Select State',
          },
          pin_code: {
              required: 'Please Enter Pincode',
          },
      },
      submitHandler: function(form) {
		 $("#loder-img").show();
        var url  = '<?php echo $BASE_URL ?>MyAccounts/addEditAddress';
        $.ajax({
          type: "POST",
          url: url,
          data: $(form).serialize(), // serializes the form's elements.
          beforeSend:function() {
             $('button[type=submit]').attr('disabled', true);
          },

          success: function(data) {
            $('button[type=submit]').attr('disabled', false);
             let response = JSON.parse(data);
             let errors = response.errors;
             let msg = response.msg;
             let status = response.status;
             $("#login-password").val('');
			  $("#loder-img").hide();
             if (errors && Object.keys(errors).length) {
               var validator = $(form).validate();
               $.each(response.errors, function(key, value) {
                   validator.showErrors({[key] : value });
               });
             } else if (status === 'success') {
				$('#add-new-address')[0].reset();
                $('#address-list').append(response.data);
				$('#Save-and-Deliver-here').show();
				$('#checkout-new-address').hide();
				url='<?php echo $BASE_URL ?>MyAccounts/manageAddress';
				location.assign(url);

				/*if(response.updated=="1"){
					url='<?php echo $BASE_URL ?>MyAccounts/manageAddress';
					location.assign(url);
				}*/
             } else {
                 $("#login-msg").html('<span><label style="color:red">'+msg+'</label></span>');
             }
          },
          error: function (error) {
             $('button[type=submit]').attr('disabled', false);
             $("#login-msg").html('<span><label style="color:red">'+msg+'</label></span>');
          },
        });
      },
  });

  //contact code start
  if(language_name=='French'){
  $('#contact-us').validate({
      rules: {
        name: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        phone: {
          required: true,
          number: true,
          maxlength: 10,
          minlength: 10,
        },
        comment: {
          required: true,
        },
      },
	   messages: {
          name: {
              required: 'Veuillez entrer le nom',
          },
          email: {
              required: 'Veuillez saisir un e-mail',
			        email:"S'il vous plaît, mettez une adresse email valide."
          },
          phone: {
              required: 'Veuillez entrer le numéro de téléphone',
          },
          comment: {
              required: 'Veuillez entrer un commentaire',
          },
      },
      submitHandler: function(form) {
		 $("#loder-img").show();
        var url  = '<?php echo $BASE_URL ?>Pages/saveContactUs';
        $.ajax({
          type: "POST",
          url: url,
          data: $(form).serialize(), // serializes the form's elements.
          beforeSend:function() {
             $('button[type=submit]').attr('disabled', true);
          },
          success: function(data) {
			      $("#loder-img").hide();
            $('button[type=submit]').attr('disabled', false);
             let response = JSON.parse(data);
             let errors = response.errors;
             let msg = response.msg;
             let status = response.status;
             if (errors && Object.keys(errors).length) {
               var validator = $(form).validate();
               $.each(response.errors, function(key, value) {
                     if(key=='captcha'){
                        $("#recaptcha-error").show();
                      }else{
                        validator.showErrors({[key] : value });
                      }
               });
             } else if (status === 'success') {
                 $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
                 $("#msg-modal").modal('show');
				         setTimeout(function(){ location.reload() }, 2000);
                 $("#contact-us")[0].reset();
             } else {
                 $("#contact-us-message").html('<span class="text-danger"><label class="mt-2">'+msg+'</label></span>');
             }
          },
          error: function (error) {
             $("#contact-us-message").html('<span class="text-danger"><label class="mt-2">'+msg+'</label></span>');
             $('button[type=submit]').attr('disabled', false);
          },
        });
      },
  });
  }else{
	  $('#contact-us').validate({
      rules: {
        name: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        phone: {
          required: true,
          number: true,
          maxlength: 10,
          minlength: 10,
        },
        comment: {
          required: true,
        },
      },
      messages: {
          name: {
              required: 'Please Enter Name',
          },
          email: {
              required: 'Please Enter Email',
          },
          phone: {
              required: 'Please Enter Phone Number',
          },
          comment: {
              required: 'Please Enter Comment',
          },
      },
      submitHandler: function(form) {
		  $("#loder-img").show();
       var url  = '<?php echo $BASE_URL ?>Pages/saveContactUs';

       $.ajax({
          type: "POST",
          url: url,
          data: $(form).serialize(), // serializes the form's elements.
          beforeSend:function() {
             $('button[type=submit]').attr('disabled', true);
          },
          success: function(data) {
			       $("#loder-img").hide();
            $('button[type=submit]').attr('disabled', false);
                let response = JSON.parse(data);
                let errors = response.errors;
                let msg = response.msg;
                let status = response.status;
                if (errors && Object.keys(errors).length) {
                  var validator = $(form).validate();
                  $.each(response.errors, function(key, value) {
                      if(key=='captcha'){
                        $("#recaptcha-error").show();
                      }else{
                        validator.showErrors({[key] : value });
                      }
                  });
                } else if (status === 'success') {
                    $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
                    $("#msg-modal").modal('show');
                    $("#contact-us")[0].reset();
                  setTimeout(function(){ location.reload() }, 2000);
                } else {
                    $("#contact-us-message").html('<span class="text-danger"><label class="mt-2">'+msg+'</label></span>');
                }
          },
          error: function (error) {
             $("#contact-us-message").html('<span class="text-danger"><label class="mt-2">'+msg+'</label></span>');
             $('button[type=submit]').attr('disabled', false);
          },
        });
      },
    });
  }

function contactus_recaptcha(){
  $("#submit-contact-us-btn").removeAttr('disabled');
}
//contact code end
  //estimate code Start
 if(language_name=='French'){
		$('#estimate-form').validate({
			  rules: {
				contact_name: {
				  required: true,
				},
				company_name: {
				  required: true,
				},
				email: {
				  required: true,
				  email: true,
				},
				phone_number: {
				  required: true,
				  number: true,
				  maxlength: 10,
				  minlength: 10,
				},
				street: {
				  required: true,
				},
				city: {
				  required: true,
				},
				country: {
				  required: true,
				},
				postal_code: {
				  required: true,				  
				  maxlength: 10,
				  minlength: 6,
				},
				flat_size: {
				  required: true,
				},
				finish_size: {
				  required: true,
				},
			  },
			  messages: {
				  contact_name: {
					  required: 'Veuillez saisir le nom du contact',
				  },
				  company_name: {
					  required: "Veuillez saisir le nom de l'entreprise",
				  },
				  email: {
					  required: 'Veuillez saisir un e-mail',
					  email:'Veuillez saisir une adresse email valide.'
				  },
				  phone_number: {
					  required: 'Veuillez entrer le numéro de téléphone',
				  },
				  street: {
					  required: 'Veuillez entrer la rue',
				  },
				  city: {
					  required: 'Veuillez entrer la ville',
				  },
				  country: {
					  required: 'Veuillez entrer le pays',
				  },
				  postal_code: {
					  required: 'Veuillez entrer le code postal',
				  },
				  flat_size: {
					  required: 'Veuillez saisir la taille à plat',
				  },
				  finish_size: {
					  required: 'Veuillez saisir la taille finie',
				  },
			  },

			  submitHandler: function(form) {
				 $("#loder-img").show();
				var url  = '<?php echo $BASE_URL ?>Products/saveEstimate';
				$.ajax({
				  type: "POST",
				  url: url,
				  data: $(form).serialize(), // serializes the form's elements.
				  beforeSend:function() {
					 $('button[type=submit]').attr('disabled', true);
				  },
				  success: function(data) {
					 $("#loder-img").hide();
					$('button[type=submit]').attr('disabled', false);
					 let response = JSON.parse(data);
					 let errors = response.errors;
					 let msg = response.msg;
					 let status = response.status;
					 if (errors && Object.keys(errors).length) {
					   var validator = $(form).validate();
					   $.each(response.errors, function(key, value) {
						   validator.showErrors({[key] : value });
					   });
					 } else if (status === 'success') {
						$("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
						$("#msg-modal").modal('show');
						setTimeout(function(){ location.reload() }, 2000);
					 } else {
						 $("#estimate-message").html('<span class="text-danger mb-5"><label class="mt-2">'+msg+'</label></span>');
					 }
					 $("#estimate-form")[0].reset();
				  },
				  error: function (error) {
					 $("#estimate-message").html('<span class="text-danger mb-5"><label class="mt-2">'+msg+'</label></span>');
					 $('button[type=submit]').attr('disabled', false);
				  },
				});
			  },
		  });
    }else{
	    $('#estimate-form').validate({
			  rules: {
				contact_name: {
				  required: true,
				},
				company_name: {
				  required: true,
				},
				email: {
				  required: true,
				  email: true,
				},
				phone_number: {
				  required: true,
				  number: true,
				  maxlength: 10,
				  minlength: 10,
				},
				street: {
				  required: true,
				},
				city: {
				  required: true,
				},
				country: {
				  required: true,
				},
				postal_code: {
				  required: true,				  
				  maxlength: 10,
				  minlength: 6,
				},
				flat_size: {
				  required: true,
				},
				finish_size: {
				  required: true,
				},
			  },
			  messages: {
				  contact_name: {
					  required: 'Please Enter Contact Name',
				  },
				  company_name: {
					  required: 'Please Enter Company Name',
				  },
				  email: {
					  required: 'Please Enter Email',
				  },
				  phone_number: {
					  required: 'Please Enter Phone Number',
				  },
				  street: {
					  required: 'Please Enter Street',
				  },
				  city: {
					  required: 'Please Enter City',
				  },
				  country: {
					  required: 'Please Enter Country',
				  },
				  postal_code: {
					  required: 'Please Enter Postal Code',
				  },
				  flat_size: {
					  required: 'Please Enter Flat Size',
				  },
				  finish_size: {
					  required: 'Please Enter Finished Size',
				  },
			  },
			  submitHandler: function(form) {
				 $("#loder-img").show();
				var url  = '<?php echo $BASE_URL ?>Products/saveEstimate';
				$.ajax({
				  type: "POST",
				  url: url,
				  data: $(form).serialize(), // serializes the form's elements.
				  beforeSend:function() {
					 $('button[type=submit]').attr('disabled', true);
				  },
				  success: function(data) {
					 $("#loder-img").hide();
					$('button[type=submit]').attr('disabled', false);
					 let response = JSON.parse(data);
					 let errors = response.errors;
					 let msg = response.msg;
					 let status = response.status;
					 if (errors && Object.keys(errors).length) {
					   var validator = $(form).validate();
					   $.each(response.errors, function(key, value) {
						   validator.showErrors({[key] : value });
					   });
					 } else if (status === 'success') {
						 $("#msg-modal .modal-body").html('<span style="color:green">'+msg+'</span>');
						 $("#msg-modal").modal('show');
						 setTimeout(function(){ location.reload() }, 2000);
					 } else {
						 $("#estimate-message").html('<span class="text-danger mb-5"><label class="mt-2">'+msg+'</label></span>');
					 }
					 $("#estimate-form")[0].reset();
				  },
				  error: function (error) {
					 $("#estimate-message").html('<span class="text-danger mb-5"><label class="mt-2">'+msg+'</label></span>');
					 $('button[type=submit]').attr('disabled', false);
				  },
				});
			  },
		  });
    }

  //estimate code end

  var loginId='<?php echo $loginId?>';
  function addProductWishList(product_id){
		if(loginId ==''){
			  var url  = '<?php echo $BASE_URL ?>Logins';
			  location.assign(url);
			  return false;
		}
		if(loginId !='' && product_id !=''){
			$("#loder-img").show();
			var url ='<?php echo $BASE_URL ?>Wishlists/addByAjax';
			$.ajax({
				   type: "POST",
				   url: url,
				   data:{'product_id':product_id}, // serializes the form's elements.
				   success: function(data) {
					   $("#loder-img").hide();
						var json = JSON.parse(data);
						var status =  json.status;
						var msg = json.msg;
						if (status == 1){
							$("#WishlistsCount").html(json.count);
							$("#msg-modal .modal-body").html('<label><i class="fas fa-check-circle"></i><span class="msg-modal-text">'+msg+'</span></label><div class="text-center msg-btn"><a href="<?php echo $BASE_URL ?>Products"><button class="btn btn-sm btn-success continue-shopping-btn">Continue Shopping</button></a>&nbsp;&nbsp;<a href="<?php echo $BASE_URL ?>Wishlists"><button class="btn btn-sm btn-success msg-cart-btn-clr">Go To Wishlist</button></div></a>');
							$("#msg-modal").modal('show');
						} else{
							$("#msg-modal .modal-body").html('<span style="color:red">'+msg+'</span>');
							$("#msg-modal").modal('show');
						}
					},
					error: function (error) {
					}
			});
		}
	}
  function deleteWishlist(wishlist_id,type){
		var result=true;
		if (type==1){
		  var result = confirm("Are you sure you want to delete wishlist item ?");
		}
		if(wishlist_id !='' && result==true){
			var url ='<?php echo $BASE_URL ?>Wishlists/deleteWishlist';
			$.ajax({
				   type: "POST",
				   url: url,
				   data:{'wishlist_id':wishlist_id}, // serializes the form's elements.
				   success: function(data)
				   {
						var json = JSON.parse(data);
						var status=json.status;
						var msg=json.msg;

						if(status ==1 ){
							$("#"+wishlist_id).remove();
							$("#WishlistsCount").html(json.count);
							if(json.count==0){
								$("#tableWishList").html('<tr><td colspan="5" class="text-center">Wishlist empty</td></tr>');
							}
							location.reload();
						}else{
							$("#msg-modal .modal-body").html('<span style="color:red">'+msg+'</span>');
							$("#msg-modal").modal('show');
						}
					},
					error: function (error) {
					}
			});
	    }
	}

	function getState(country_id){
		$("#stateiD").val('');
		$("#cityId").val('');
		$("#stateiD").html('<option value="">Loding..</option>');
		if(country_id !=''){
			var url ='<?php echo $BASE_URL ?>MyAccounts/getStateDropDownListByAjax/'+country_id;
			$.ajax({
				   type: "GET",
				   url: url,
				   contentType:"html",
				   //data:{'country_id':country_id}, // serializes the form's elements.
				   success: function(data)
				   {
					   $("#stateiD").html(data);
				   }
			});
	    }
	}

	function getCity(state_id){
		$("#cityId").val('');
		$("#cityId").html('<option value="">Loding..</option>');
		if(state_id !=''){
			var url ='<?php echo $BASE_URL ?>MyAccounts/getCityDropDownListByAjax/'+state_id;
			$.ajax({
				   type: "GET",
				   url: url,
				   contentType:"html",
				   //data:{'country_id':country_id}, // serializes the form's elements.
				   success: function(data)
				   {
					   $("#cityId").html(data);
				   }
			});
	    }
	}

	function changeOrderStatus(order_id,status) {
			var mobileMsg='';
			$("#mobileMsg").html(mobileMsg);
			$("#cl_order_id").val(order_id);
		    $("#cl_status").val(status);
			$("#myModal").modal('show');
	}

	$("#changeOrderStatusForm").submit(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.
		var form = $(this);
		var formsubmit=true;
		$("#btnSubmit").attr("disabled",true);
		var order_id =$("#cl_order_id").val();
		var status =$("#cl_status").val();
		if(formsubmit==true){
			var url ='<?php echo $BASE_URL ?>MyOrders/changeOrderStatus';
			$.ajax({
				   type: "POST",
				   url: url,
				   data: form.serialize(), // serializes the form's elements.

				   success: function(data)
				   {
				        $("#myModal").modal('hide');
				        $("#btnSubmit").attr("disabled",false);
						var json = JSON.parse(data);
				        var res=json.status;
					    var msg=json.msg;
						if(res==1){
						setTimeout(function(){
							    location.reload();
							  }, 2000
						);
						$("#MsgModal .modal-body").html('<span style="color:green">'+msg+'</span>');
						$("#MsgModal").modal('show');
						}else{
							$("#MsgModal .modal-body").html('<span style="color:red">'+msg+'</span>');
							$("#MsgModal").modal('show');
						}
				   },
				   error: function (error) {
					  $("#btnSubmit").attr("disabled",false);
				   }
			});
		}else{
			$("#btnSubmit").attr("disabled",false);
		}
    });

	function searchProduct(searchtext){
		$("#ProductListUl").html('');
	  	if(searchtext !=''){
			$("#searchDiv").show();
			$("#coming-res-data").show();

			var url ='<?php echo $BASE_URL ?>Products/searchProduct';
			$("#searchDiv").show();
			$.ajax({
				   type: "POST",
				   url: url,
				   data:{'searchtext':searchtext}, // serializes the form's elements.
				    success: function(data)
				    {
					    $("#coming-res-data").hide();
					    $("#ProductListUl").html(data);
					},
					error: function (error) {
					}
			});
		}else{
			$("#searchDiv").hide();
			$("#coming-res-data").hide();
		}
    }

    function removeSerchProduct(){
		$("#ToSeachBox").val('');
		$("#ProductListUl").html('');
        $("#searchDiv").hide();
 	}

	$(document).mouseup(function(e)
	{
		var container = $(".mid-search-bar");
		// if the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0)
		{
			removeSerchProduct();
		}
	});
	<?php if($showCOVID19MSG){ ?>
	    $("#WarningModal").modal('show');
	<?php
	}?>

	function COVIDMSGClose(){
		$("#loder-img").show();
		var url ='<?php echo $BASE_URL ?>Homes/COVIDMSGClose';
		$.ajax({
			   type: "GET",
			   url: url,
				success: function(data)
				{
                   $("#loder-img").hide();
				   $("#WarningModal").modal('hide');
				},
				error: function (error) {
				}
		});
    }
	if(language_name=='French'){
	function PrinterSeries(printer_brand){
		//alert(printer_brand);
		$("#printer_series").html("<option value=''>Sélectionnez une série d'imprimantes</option>");
		$("#printer_models").html("<option value=''>Sélectionnez un modèle d'imprimante</option>");

		if(printer_brand !=''){
			$("#printer_series").html('<option value="">Hébergement ..</option>');
		   //$("#printer_models").html('<option value="">Loding..</option>');
			var url ='<?php echo $BASE_URL ?>Products/PrinterSeries/'+printer_brand;
			$.ajax({
				   type: "GET",
				   url: url,
				   contentType:"html",
				   success: function(data)
				   {
					   $("#printer_series").html(data);
				   }
			});
	    }
	}

	function PrinterModel(printer_series){
		var printer_brand= $("#printer_brand").val();
		$("#printer_models").html("<option value=''>Sélectionnez un modèle d'imprimante</option>");

		if(printer_series !=''){
			$("#printer_models").html('<option value="">Hébergement ..</option>');
			var url ='<?php echo $BASE_URL ?>Products/PrinterModel/'+printer_brand+'/'+printer_series;
			$.ajax({
				   type: "GET",
				   url: url,
				   contentType:"html",
				   //data:{'country_id':country_id}, // serializes the form's elements.
				   success: function(data)
				   {
					   $("#printer_models").html(data);
				   }
			});
	    }
	}
	}else{
		function PrinterSeries(printer_brand){
			//alert(printer_brand);
			$("#printer_series").html('<option value="">Select a Printer Series</option>');
			$("#printer_models").html('<option value="">Select a Printer Model</option>');

			if(printer_brand !=''){
				$("#printer_series").html('<option value="">Loding..</option>');
			   //$("#printer_models").html('<option value="">Loding..</option>');
				var url ='<?php echo $BASE_URL ?>Products/PrinterSeries/'+printer_brand;
				$.ajax({
					   type: "GET",
					   url: url,
					   contentType:"html",
					   success: function(data)
					   {
						   $("#printer_series").html(data);
					   }
				});
			}
		}

		function PrinterModel(printer_series){
			var printer_brand= $("#printer_brand").val();
			$("#printer_models").html('<option value="">Select a Printer Model</option>');

			if(printer_series !=''){
				$("#printer_models").html('<option value="">Loding..</option>');
				var url ='<?php echo $BASE_URL ?>Products/PrinterModel/'+printer_brand+'/'+printer_series;
				$.ajax({
					   type: "GET",
					   url: url,
					   contentType:"html",
					   //data:{'country_id':country_id}, // serializes the form's elements.
					   success: function(data)
					   {
						   $("#printer_models").html(data);
					   }
				});
			}
		}
	}

  function expiryMask() {
      var inputChar = String.fromCharCode(event.keyCode);
      var code = event.keyCode;
      var allowedKeys = [8];
      if (allowedKeys.indexOf(code) !== -1) {
          return false;
      }else
      {
          if($("#ExpDate").val().length > 7)
          {
              return false;
          }else
          {
                  const key = event.keyCode;
                  if (typeof key ==  "undefined" || key === 46) {
                      var id = event.target.value;
                      var lastChar = id.substr(id.length - 1);
                      if(typeof lastChar != "undefined" && lastChar=='/')
                      {
                          event.target.value=event.target.value.replace("/","");
                          return true;
                      }else
                      {
                          event.target.value = event.target.value.replace(
                              /^([1-9]\/|[2-9])$/g, '0$1/'
                          ).replace(
                              /^(0[1-9]|1[0-2])$/g, '$1/'
                          ).replace(
                              /^([0-1])([3-9])$/g, '0$1/$2'
                          ).replace(
                              /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2'
                          ).replace(
                              /^([0]+)\/|[0]+$/g, '0'
                          ).replace(
                              /[^\d\/]|^[\/]*$/g, ''
                          ).replace(
                              /\/\//g, '/'
                          );
                          splitDate($('#ExpDate').val())
                          cardFormValidate()
                          return true;
                      }
                  }else
                  {
                      event.target.value = event.target.value.replace(
                          /^([1-9]\/|[2-9])$/g, '0$1/'
                      ).replace(
                          /^(0[1-9]|1[0-2])$/g, '$1/'
                      ).replace(
                          /^([0-1])([3-9])$/g, '0$1/$2'
                      ).replace(
                          /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2'
                      ).replace(
                          /^([0]+)\/|[0]+$/g, '0'
                      ).replace(
                          /[^\d\/]|^[\/]*$/g, ''
                      ).replace(
                          /\/\//g, '/'
                      );
                      splitDate($('#ExpDate').val())
                      cardFormValidate()
                      return true;
                  }
          }
      }
  }

	function cardFormValidate(){
    var cardValid = 1;
    if($('#CardNumber').val().length < 14 || $('#CardNumber').val().length > 20 )
    {
      $("#CardNumber").addClass('is-invalid');
      cardValid = 0;
    }else
    {
      $("#CardNumber").removeClass('is-invalid');
      cardValid = 1;
    }
    //card details validation
    var expMonth = $("#ExpMonth").val();
    var ExpDate = $("#ExpDate").val();
    var ExpYear = $("#ExpYear").val();
    var cvv = $("#cvv").val();
    var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var regYear = new RegExp("/^"+generateOfYears()+"$/");
    var regcvv = /^[0-9]{3,3}$/;
    if (!regMonth.test(expMonth) || !expMonth.length || !ExpDate.length) {
        $("#ExpDate").addClass('is-invalid');
        cardValid = 0;
    }else
    {
        var date = new Date();
        var month = parseInt(date.getMonth())+1
        var year = date.getFullYear()
        if(ExpYear.length && ExpYear == year && expMonth < month)
        {
            $("#ExpDate").addClass('is-invalid');
            cardValid = 0;
        }else
        {
            $("#ExpDate").removeClass('is-invalid');
        }
    }
    var y = new Date().getFullYear();
    if (!ExpDate.length || !ExpYear.length || !regYear.test(ExpYear)) {
        if(y == ExpYear)
        {
            $("#ExpDate").removeClass('is-invalid');
        }else
        {
            $("#ExpDate").addClass('is-invalid');
            cardValid = 0;
        }
    }else
    {
        $("#ExpDate").removeClass('is-invalid');
    }
    if (!regcvv.test(cvv) || !cvv.length) {
        $("#cvv").addClass('is-invalid');
        cardValid = 0;
    }else
    {
        $("#cvv").removeClass('is-invalid');
    }
    if(cardValid==1)
    {
      return true;
    }else
    {
      return false;
    }
  }
  function splitDate(value) {
      var regExp = /(1[0-2]|0[1-9]|\d)\/(20\d{2}|19\d{2}|0(?!0)\d|[1-9]\d)/;
      var matches = regExp.exec(value);
      if(matches != null)
      {
          $('#ExpMonth').val(matches[1]);
          $('#ExpYear').val("20"+matches[2]);
      }
  }
  function generateOfYears() {
    var year = new Date().getFullYear()
    var years = ''
    for (var i = year; i < year + 10; i++) {
        years = years+i+'|';
    }
    years = years.substring(0, years.length - 1);
    return years
  }
	$(document).ready(function() {
		if(language_name=='French'){
			$("#printer_brand").val('');
			$("#printer_series").html("<option value=''>Sélectionnez une série d'imprimantes</option>");
		  $("#printer_models").html("<option value=''>Sélectionnez un modèle d'imprimante</option>");
		}else{
      $("#printer_brand").val('');
      $("#printer_series").html('<option value="">Select a Printer Series</option>');
      $("#printer_models").html('<option value="">Select a Printer Model</option>');
		}
    $('#CardNumber').mask('0000 0000 0000 0000');
    $(".pos input").keyup(function(){ cardFormValidate() })
    $("#place-order-form").submit(function(e){
      e.preventDefault()
      if($('#4payment').is(":checked") && cardFormValidate() == true)
      {
        $("#place-order-form")[0].submit()
      }else{
        $("#place-order-form")[0].submit()
      }
    })
    $(document).on('keyup change input paste','#ExpDate', function(){
        if(expiryMask()){
          var $this = $(this);
          var val = $this.val();
          var valLength = val.length;
          if(valLength>5){
            $this.val($this.val().substring(0,5));
          }
        };
    });
  });
</script>

</body>
</html>
