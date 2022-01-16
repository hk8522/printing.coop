<div class="main-slider-section">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
	    <?php
		foreach($Branrers as $key=>$list) {
		?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key?>" class="<?php echo $key==0 ? 'active':''?>">
			</li>
		<?php
		}?>

        <!--<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>-->

      </ol>
        <div class="carousel-inner">
          <?php
              $showIndicators = false;
              if ($Branrers) {
                if(count($Branrers) > 1) {
                  $showIndicators = true;
                }
                foreach($Branrers as $key=>$list) {
                  $class = "";
				  $imageurl = getBannerImage($list['banner_image'],'large');
				  if($language_name=='French'){
                     $imageurl = getBannerImage($list['banner_image_french'],'large');
				  }
                  if ($key == 0) {
                     $class = "active";
                  }
                  ?>
                  <div class="carousel-item <?php echo $class;?>">
                      <img src="<?php echo $imageurl;?>">
                  </div>
                  <?php
              }
          } else {
            ?>
      			    <div class="carousel-item active">
      						<a href="javascript:void(0)"><img src="<?php echo BANNER_DEFAULT_IMAGE_URL ?>"></a>
      			    </div>
      			<?php
          }
        ?>
      </div>
      <?php
        if ($showIndicators) {
          ?>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <i class="las la-angle-left"></i>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <i class="las la-angle-right"></i>
          </a>
          <?php
        }
      ?>
    </div>
</div>
