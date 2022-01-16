<style>
       #login-password{
           -webkit-text-security:disc;
       }
</style>
<div class="login-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="login-section-inner">
            <div class="row">
                <div class="col-md-5">
                    <?php
                    if($language_name=='French'){ ?>
                        <div class="login-area">
                            <div class="universal-dark-title">
                                <span>Clients enregistrés</span>
                            </div>
                            <div class="universal-dark-info" id="login-msg">
                            </div>
                            <div class="text-center" style="color:green">
                                <?php echo $this->session->flashdata('message_success');?>
                            </div>
                            <div class="universal-dark-info">
                                <span>Si vous avez déjà un compte, veuillez vous identifier.</span>
                            </div>
                            <form id="login-form" method="post"  autocomplete="off">
                                <div class="shipping-form">
                                    <div class="single-review">
                                        <label>Adresse électronique <span class="text-danger"> * </span> </label>
                                        <input type="email" name="loginemail"  value="" >
                                    </div>
                                    <div class="single-review">
                                        <label>Mot de passe  <span class="text-danger"> * </span> </label>
                                        <input type="password" name="loginpassword" id="login-password"  value="">
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-5 col-md-6">
                                            <div class="login-btn">
                                                <button type="submit">S'identifier</button>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-6">
                                            <div class="forgot-password">
                                                <a href="<?php echo $BASE_URL?>Logins/forgotPassword">mot de passe oublié?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php }else{ ?>
                        <div class="login-area">
                            <div class="universal-dark-title">
                                <span>Registered Customers</span>
                            </div>
                            <div class="universal-dark-info" id="login-msg">
                            </div>
                            <div class="text-center" style="color:green">
                                <?php echo $this->session->flashdata('message_success');?>
                            </div>
                            <div class="universal-dark-info">
                                <span>If you have an account with us, please log in.</span>
                            </div>
                            <form id="login-form" method="post"  autocomplete="off">
                                <div class="shipping-form">
                                    <div class="single-review">
                                        <label>Email Address <span class="text-danger"> * </span> </label>
                                        <input type="email" name="loginemail"  value="" >
                                    </div>
                                    <div class="single-review">
                                        <label>Password  <span class="text-danger"> * </span> </label>
                                        <input type="password" name="loginpassword" id="login-password"  value="">
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-5 col-md-6">
                                            <div class="login-btn">
                                                <button type="submit">Login</button>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-6">
                                            <div class="forgot-password">
                                                <a href="<?php echo $BASE_URL?>Logins/forgotPassword">Forgot password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    }?>
                </div>
                <div class="col-md-7">
                    <div class="register-area">
                        <div class="universal-dark-title">
                            <span>
                            <?php
                            if($language_name=='French'){ ?>
                                Nouveaux clients
                            <?php }else{ ?>
                                New Customers
                            <?php
                            }?>
                            </span>
                        </div>
                        <div class="universal-dark-info">
                            <span>
                            <?php
                            if($language_name=='French'){ ?>
                                En créant un compte sur notre boutique, vous pourrez passer vos commandes plus rapidement, enregistrer plusieurs adresses de livraison, consulter et suivre vos commandes, et plein d'autres choses encore.
                            <?php }else{ ?>
                                By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.
                            <?php
                            }?> </span>
                        </div>
                        <div class="universal-dark-info" id="signup-msg">
                        </div>
                        <?php
                        if($language_name=='French'){ ?>
                            <form id="signup-form" method="post" autocomplete="off">
                                <div class="shipping-form">
                                    <div class="row">
                                        <div class="col-6 col-md-6">
                                            <div class="single-review">
                                                <label>Ton prénom  <span class="text-danger"> * </span> </label>
                                                <input type="text" name="fname">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="single-review">
                                                <label>Votre nom de famille  <span class="text-danger"> * </span> </label>
                                                <input type="text" name="lname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-review">
                                                <label>Votre adresse email  <span class="text-danger"> * </span> </label>
                                                <input type="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="single-review">
                                                <label>Choisissez un mot de passe  <span class="text-danger"> * </span> </label>
                                                <input type="password" name="password" id="signup-password">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="single-review">
                                                <label>Confirmez le mot de passe  <span class="text-danger"> * </span> </label>
                                                <input type="password" name="confirm_password" id="confirm-password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="login-btn">
                                        <button type="submit">S'inscrire maintenant</button>
                                    </div>
                                </div>
                            </form>
                        <?php }else{ ?>
                            <form id="signup-form" method="post" autocomplete="off">
                                <div class="shipping-form">
                                    <div class="row">
                                        <div class="col-6 col-md-6">
                                            <div class="single-review">
                                                <label>Your First Name  <span class="text-danger"> * </span> </label>
                                                <input type="text" name="fname">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="single-review">
                                                <label>Your Last Name  <span class="text-danger"> * </span> </label>
                                                <input type="text" name="lname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-review">
                                                <label>Your Email Address  <span class="text-danger"> * </span> </label>
                                                <input type="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="single-review">
                                                <label>Choose Password  <span class="text-danger"> * </span> </label>
                                                <input type="password" name="password" id="signup-password">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="single-review">
                                                <label>Confirm Password  <span class="text-danger"> * </span> </label>
                                                <input type="password" name="confirm_password" id="confirm-password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="login-btn">
                                        <button type="submit">Register Now</button>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

