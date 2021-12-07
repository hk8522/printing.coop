<div class="account-points">
    <div class="mobile-navigation">
        <div class="row align-items-row">
            <div class="col-8 col-md-8">
                <div class="universal-light-info">
                    <span>
                    <?php 
                    if($language_name=='French'){ ?>
                      La navigation
                    <?php }else{ ?>
                      Navigation
                    <?php 
                    }?></span>
                </div>
            </div>
            <div class="col-4 col-md-4 text-right">
                <div class="account-icon">
                    <i class="las la-bars"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="account-single-points">
        <ul>
		    <li><a href="<?php echo $BASE_URL;?>MyOrders">
            <?php 
            if($language_name=='French'){ ?>
              Historique des commandes
            <?php }else{ ?>
              Order History
            <?php 
            }?></a></li>
            <li><a href="<?php echo $BASE_URL;?>MyAccounts">
            <?php 
            if($language_name=='French'){ ?>
              Modifier le compte
            <?php }else{ ?>
              Edit Account
            <?php 
            }?></a></li>
            <li><a href="<?php echo $BASE_URL;?>MyAccounts/changePassword">
            <?php 
            if($language_name=='French'){ ?>
              Changer le mot de passe
            <?php }else{ ?>
              Change Password
            <?php 
            }?></a></li>
            <li><a href="<?php echo $BASE_URL;?>MyAccounts/manageAddress">
            <?php 
            if($language_name=='French'){ ?>
              Gérer les adresses
            <?php }else{ ?>
              Manage Addresses
            <?php 
            }?></a></li>
            <!-- <li><a href="<?php echo $BASE_URL;?>Wishlists">Wishlist</a></li>  -->
           
            <!-- <li><a href="<?php echo $BASE_URL;?>Tickets/index/">Support</a></li> -->
            <!-- <li><a href="<?php echo $BASE_URL;?>MyAccounts/notification">Notifications</a></li> -->
            <li><a href="<?php echo $BASE_URL;?>MyAccounts/logout">
            <?php 
            if($language_name=='French'){ ?>
              Se déconnecter
            <?php }else{ ?>
              Logout
            <?php 
            }?></a></li>
        </ul>
    </div>
</div>
