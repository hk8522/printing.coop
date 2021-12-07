<?php 
    #OUR SERVICES Section
	if($language_name=='French'){
		
	   $background_image=$section_3['french_background_image'];
	}else{
		
	  $background_image=$section_3['background_image'];
	}
	$imageUrl=$BASE_URL.'assets/images/hm_service_bg_new.jpg';
	
	if(!empty($background_image)){
		
		$imageUrl=getSectionImage($background_image);
	}
?>
<div class="service-section universal-spacing" style="background-image: url(<?php echo $imageUrl;?>)">
    <div class="container">
        <div class="trend-section-inner">
            <div class="universal-light-title">
              <span><?php 
			    if($language_name=='French'){
					 
					    echo $section_3['name_france'] ?? '';
					 
					}else{
						
					    echo $section_3['name'] ?? '';
					  
					} ?></span>
            </div>
            <div class="universal-light-info">
              <span><?php if($language_name=='French'){
				  
					 echo $section_3['description_france'] ?? '';
					}else{
						
					  echo $section_3['description'] ?? '';
					  
					}?></span>
            </div>
			       <div class="universal-light-info">
              <span><?php
			        if($language_name=='French'){
				  
					    echo $section_3['content_france'] ?? '';
					}else{
						
					    echo $section_3['content'] ?? '';
					} 
					?></span>
            </div>
            <?php if($section_3) { ?>
              <div class="universal-row">
                  <div class="row">
                    <?php
                    foreach ($allServices as $key => $service) {
						#pr($allServices,1);
                      ?>
                          <div class="col-6 col-md-4 col-lg-2 col-xl-2">
                                <?php
								
							    $imageurl=getBannerImage($service['service_image'],'small');
							    if($language_name=='French'){
									
									$imageurl=getBannerImage($service['service_image_french'],'small');
									
								}
							    ?>
                              <div class="all-services-content" style="background-image: url(<?php echo $imageurl?>)">
                                  <div class="single-service-content-inner">
                                      <div class="universal-small-light-title">
                                          <span><a href="javascript:void(0)"><?php 
					if($language_name=='French'){
						
					    echo $service['name_french'] ?? '';
						
					}else{
						
					  echo $service['name'] ?? '';
					  
					} ?></a></span>
                                      </div>
                                      <!-- <div class="universal-dark-info">
                                          <span><?php echo $service['description']?></span>
                                      </div> -->
                                  </div>
                              </div>
                          </div>
                          <?php
                        }
                        ?>
                      </div>
              </div>
                <?php
            }?>
        </div>
    </div>
</div>
