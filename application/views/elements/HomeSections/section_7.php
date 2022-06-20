<?Php
#REGISTER FOR FREE!  Section
?>
<div class="member-section mainservice-section">
    <div class="container">
        <div class="mainservice-section-inner">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="member-section-content">
                        <div class="universal-dark-title" style="text-align: left;">
                            <span><?php  if($language_name=='French'){
                     echo $section_7['name_france'] ?? '';
                    }else{
                      echo $section_7['name'] ?? '';
                    }?></span>
                        </div>
                        <div class="universal-dark-info" style="text-align: left;">
                            <span><?php if($language_name=='French'){
                     echo $section_7['description_france'] ?? '';
                    }else{
                      echo $section_7['description'] ?? '';
                    } ?></span><br>
                            <a href="<?php echo $BASE_URL?>Logins"><button type="text" class="checkout-view">
                            <?php
                              if($language_name=='French'){ ?>
                               Rejoignez nous maintenant
                            <?php }else{ ?>
                              Join Us Now
                            <?php
                            }?></button></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img1">
                        <div class="join_us_center_curve"></div>
                        <?php
            if($language_name=='French'){
                        echo $section_7['content_france'] ?? '';
        }else{
        echo $section_7['content'] ?? '';
    }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
