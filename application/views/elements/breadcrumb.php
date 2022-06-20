<?php
if (!in_array($page_title,array('Home','Product Details','Accueil'))) { ?>
<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="<?php echo $BASE_URL;?>"><?php
                if($this->language_name=='French'){
                     echo 'Accueil';
                }else{
                    echo 'Home';
                }?></a>
                /
                <span class="current"><?php echo $page_title ?></span>
            </div>
        </div>
    </div>
</div>
<?php }?>
