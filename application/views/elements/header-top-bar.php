<div class="header-top-bar">
    <div class="top-inner-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">

                    <div class="top-bar-menu left-menu">
                        <ul>
                            <li><span>
                                <?= ($language_name == 'French') ? 'Appelez-nous' : 'Call Us'?>: <strong>
                                <?php
                                   if ($language_name == 'French') {
                                    echo !empty($configrations['contact_no_french']) ? $configrations['contact_no_french']:'1-877-384-8043';
                                   } else {
                                    echo !empty($configrations['contact_no']) ? $configrations['contact_no']:'1-877-384-8043';
                                   }
                                ?></strong></span></li>
                            <li><span><?php
                            if ($language_name == 'French') {
                                echo $configrations['office_timing_french'] ?? 'Du lundi au vendredi: <strong>9:00-18:00</strong>';
                            } else {
                                echo $configrations['office_timing'] ?? 'Monday-Friday: <strong>9:00-18:00</strong>';
                            }
                            ?></span></li>
                        </ul>
                    </div>
                </div>
                <?php

                //pr($_SERVER);
                ?>
                <div class="col-md-7">
                    <div class="top-bar-menu right-menu">
                        <ul>
                        <?php if ($MainStoreData['show_language_translation']) { ?>
                            <li>
                                <div class="language-selector">
                                    <div class="language-selector-box">
                                        <a href="javascript:void(0)"><?= $MainStoreData['language_name'] ?><i class="las la-angle-down"></i>
                                        </a>
                                        <div class="language-selector-content">
                                            <div class="upward-arrow">
                                                <div></div>
                                            </div>
                                            <?php
                                foreach ($StoreListData as $key => $language) {
                                                  ?>
                               <a href="<?= $language['url'] ?>"><?= $language['language_name'] ?>
                                                    </a>
                                                  <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                       } ?>
                            <!--<li>

                                <div class="language-selector">
                                    <div class="language-selector-box">
                                        <a><?php echo$DefaultcurrencyData['currency_name'];?> <i class="las la-angle-down"></i></a>
                                        <div class="language-selector-content">
                                            <div class="upward-arrow">
                                                <div></div>
                                            </div>
                                            <?php

                        foreach ($CurrencyList as $key => $val) {
                                                        ?>
                        <a href="<?= $BASE_URL?>?currency_id=<?= $key ?>&REDIRECT_URL=<?= $_SERVER['REQUEST_URI'] ?>">               <?= $val['currency_name'] ?>
                        </a>

                                                  <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>-->

                            <?php $totalWishListCount = 0;?>
                            <?php if (!empty($loginId)) {
                                $totalWishListCount=$this->User_Model->geWishlistCount($loginId);
                              }
                            ?>
                            <li><a href="<?= $BASE_URL ?>Wishlists">
                                <?= ($language_name == 'French') ? 'Ma liste d\'envies' : 'My Wish List'?> (<strong id="WishlistsCount"><?= $totalWishListCount ?></strong>)</a></li>

                            <?php if (!$loginId) { ?>
                              <li><a href="<?= $BASE_URL ?>Logins">
                              <?= ($language_name == 'French') ? 'S\'identifier S\'enregistrer' : 'Login/Register'?></a></li>
                              <?php
                            } else{ ?>
                               <li><a href="<?= $BASE_URL ?>MyAccounts/logout">
                               <?= ($language_name == 'French') ? 'Se déconnecter' : 'Logout'?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
