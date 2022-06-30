<?php
    #Our Promise To You Section
    if ($language_name == 'French'){
       $background_image=$section_5['french_background_image'];
    }else{
      $background_image=$section_5['background_image'];
    }
    $imageUrl=$BASE_URL.'assets/images/parallax2-3.jpg';

    if(!empty($background_image)){
        $imageUrl=getSectionImage($background_image);
    }
?>
<div class="capability-section universal-spacing" style="background-image: url(<?php echo $imageUrl;?>)">
    <div class="container">
        <div class="tab-products-section-inner">
            <div class="universal-light-title">
              <span><?php
                if ($language_name == 'French'){
                     echo $section_5['name_france'] ?? '';
                    }else{
                      echo $section_5['name'] ?? '';
                    } ?></span>
            </div>
            <div class="universal-light-info">
              <span><?php if ($language_name == 'French'){
                     echo $section_5['description_france'] ?? '';
                    }else{
                      echo $section_5['description'] ?? '';
                    }?></span>
            </div>
            <div class="universal-light-info">
              <span><?php
                    if ($language_name == 'French'){
                        echo $section_5['content_france'] ?? '';
                    }else{
                        echo $section_5['content'] ?? '';
                    }
                    ?></span>
            </div>
        </div>
    </div>
</div>
