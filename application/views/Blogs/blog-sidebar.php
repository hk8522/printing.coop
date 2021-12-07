<div class="blog-sidebar">
    <div class="blog-search-bar">
	    <form action="<?php echo $BASE_URL?>Blogs/search">
            <input type="text" placeholder="<?php echo $this->language_name=='French' ? 'Rechercher dans le blog ici ...':'Search blog here ...'?>" name="search" required value="<?php echo isset($_GET['search']) ? $_GET['search']:''?>">
            <button><i class="las la-search"></i></button>
		</form>		
    </div>
    <div class="blog-sidebar-posts">
        <ul class="nav nav-pills">
            <li><a class="active" data-toggle="pill" href="#Popular"><?php echo $this->language_name=='French'? 'Populaire':'Popular'?></a></li>
            <li><a class="" data-toggle="pill" href="#Latest"><?php echo $this->language_name=='French'? 'dernière':'Latest'?></a></li>
        </ul>
        <div class="tab-content">
            <div id="Popular" class="tab-pane fade active show">
			   <?php foreach($popularblogs as $pblog){
				  
					$imageurl=getBlogImage($pblog['image'],'large');
				 ?>
                <div class="blog-sidebar-single-post">
                    <a href="<?php echo $BASE_URL?>Blogs/singleview/<?php echo base64_encode($pblog['id'])?>">
                        <div class="blog-sidebar-single-post-img" style="background-image: url(<?php echo $imageurl?>)"></div>
                        <div class="blog-sidebar-single-detail">
                            <div class="single-blog-title">
                                <span> <?php if($this->language_name=='French'){
												
														echo $pblog['title_french'];
													}else{
														echo $pblog['title'];
													} 
								?></span>
                            </div>
                            <div class="single-blog-date">
                                <span><?php echo date('F d Y',strtotime($pblog['created']));?></span>
                            </div>
                        </div>
                    </a>
                </div>
			   <?php 
			   }?>
            </div>
            <div id="Latest" class="tab-pane fade">
			<?php foreach($latestblogs as $lblog){
				  
					$imageurl=getBlogImage($lblog['image'],'large');
				 ?>
                <div class="blog-sidebar-single-post">
                    <a href="<?php echo $BASE_URL?>Blogs/singleview/<?php echo base64_encode($lblog['id'])?>">
                        <div class="blog-sidebar-single-post-img" style="background-image: url(<?php echo $imageurl?>)"></div>
                        <div class="blog-sidebar-single-detail">
                            <div class="single-blog-title">
                                <span><?php if($this->language_name=='French'){
												
														echo $lblog['title_french'];
													}else{
														echo $lblog['title'];
													} 
								?></span>
                            </div>
                            <div class="single-blog-date">
                                <span><?php echo date('F d Y',strtotime($lblog['created']));?></span>
                            </div>
                        </div>
                    </a>
                </div>
			      <?php 
			    }?>
            </div>
        </div>
    </div>
    <div class="blog-category-sidebar">
        <div class="universal-dark-title">
            <span><?php echo $this->language_name=='French'? 'Catégories':'Categories'?></span>
        </div>
        <div class="blog-category-list">
		    <?php foreach($category as $cat){
			?>  
            <a href="<?php echo $BASE_URL?>Blogs/category/<?php echo base64_encode($cat['id'])?>"><i class="las la-folder-open"></i><?php 
			if($this->language_name=='French'){
				
				echo $cat['category_name_french'];
			}else{
					echo $cat['category_name'];
			} ?>
			</a>
			<?php 
			}?>
        </div>
    </div>
    <!--<div class="blog-category-sidebar">
        <div class="universal-dark-title">
            <span>Monthly Archive</span>
        </div>
        <div class="blog-category-list">
		     <?php 
			  
			 ?>
            <a href="/Blogs/month10_2018">
			<i class="las la-calendar"></i> October, 2018 (5)
			</a>
        </div>
    </div>-->
	
</div>