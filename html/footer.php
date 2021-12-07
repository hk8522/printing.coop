<div class="newsletter-section universal-spacing">
    <div class="container">
        <div class="newsletter-section-inner">
            <i class="las la-comments"></i>
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="newsletter-single-inner">
                        <div class="newsletter-icon">
                            <i class="title30 white la la-question"></i>
                        </div>
                        <div class="newsletter-content">
                            <div class="universal-light-title">
                                <span>Newsletter</span>
                            </div>
                            <div class="universal-light-info">
                                <span>Stay in Touch</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="newsletter-fields">
                        <input type="text" placeholder="Enter your email address">
                        <button type="submit">Subscribe</button>
                    </div>
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
                            <span>NAVIGATION</span>
                        </div>
                        <div class="universal-dark-info">
                            <span><a href="index.php">Home</a></span>
                            <span><a href="#">Our Cooperative</a></span>
                            <span><a href="products.php">Products</a></span>
                            <span><a href="#">Become a Member</a></span>
                            <span><a href="#">Newsletter</a></span>
                            <span><a href="#">Contact</a></span>
                            <span><a href="#">FAQ</a></span>
                            <span><a href="#">Blog</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fotter-single">
                        <div class="universal-small-dark-title">
                            <span>Our Printed Products</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="universal-dark-info">
                                    <span><a href="#">Business cards</a></span>
                                    <span><a href="#">Impressions-grand-format</a></span>
                                    <span><a href="#">Printed envelopes</a></span>
                                    <span><a href="#">Memo Pads</a></span>
                                    <span><a href="#">Booklet and Catalog</a></span>
                                    <span><a href="#">Placemats</a></span>
                                    <span><a href="#">Office supplies</a></span>
                                    <span><a href="#">Presentation Folders</a></span>                                    
                                    <span><a href="#">Bookmarks</a></span>
                                    <span><a href="#">Magnets</a></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="universal-dark-info">
                                    <span><a href="#">Labels - Stickers</a></span>
                                    <span><a href="#">Business forms</a></span>
                                    <span><a href="#">Books</a></span>
                                    <span><a href="#">Flyer - Brochures</a></span>
                                    <span><a href="#">Digital-printing-copies</a></span>
                                    <span><a href="#">Annonces</a></span>
                                    <span><a href="#">Gift certificate</a></span>
                                    <span><a href="#">Check</a></span>                                    
                                    <span><a href="#">Tickets</a></span>
                                    <span><a href="#">View All</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="fotter-single">
                        <div class="universal-small-dark-title">
                            <span>GET IN TOUCH</span>
                        </div>
                        <div class="universal-dark-info">
                            <span><a href="#">Home</a></span>
                            <span><a href="#">Our Cooperative</a></span>
                            <span><a href="#">Products</a></span>
                            <span><a href="#">Become a Member</a></span>
                            <span><a href="#">Newsletter</a></span>
                            <span><a href="#">Contact</a></span>
                            <span><a href="#">FAQ</a></span>
                            <span><a href="#">Blog</a></span>
                        </div>
                    </div>
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
                            <span>Copyright © 2018 printing.coop. All rights reserved</span>
                        </div>
                        <div class="bottom-links">
                            <a href="#">Terms & Condition</a>
                            <a href="#">Privacy</a>
                            <a href="#">Sitemap</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="payment-types">
                        <div class="universal-small-dark-title">
                            <span>Payment</span>
                        </div>
                        <div class="payment-types-inner">
                            <img src="images/payment_method_logo.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/bootstrap.js"></script> 
<script src="js/customslider.js"></script>

<script>
$(document).ready(function(){
    $(window).scroll(function(){
        if ($(window).scrollTop() > 50){
            $('.main-header').addClass('scrolled');
        } else {
            $('.main-header').removeClass('scrolled');
        }
    });
    $(".wishlist-area").click(function() {
        $(this).toggleClass("active");
        $(".addwishlist-message").addClass("active");
    });
    $(".cart-adder").click(function() {
        $(".after-click").show();
        $(".before-click").hide();
        $(".addtocart-message").addClass("active");
    });
    $("#account-change-pswd").click(function() { 
        $(".change-pswd-field-show").show();
    });
    $("#show-adress-field").click(function() { 
        $(".edit-address").show();
        $(".add-address-field").hide();
    });
    $("#cancel-address").click(function() { 
        $(".edit-address").hide();
        $(".add-address-field").show();
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
});
</script>

<script>
function myFunction(x) {
    if (x.matches) { // If media query matches
        var swiper = new Swiper('.swiper-container', {
          slidesPerView: 3,
          spaceBetween: 0,
          pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
          autoplay: {
            delay: 10000,
          },
        });
    } else {
          var swiper = new Swiper('.swiper-container', {
          slidesPerView: 5,
          spaceBetween: 15,
          pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
          autoplay: {
            delay: 10000,
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
document.getElementById("defaultOpen").click();
</script>

</body>
</html>