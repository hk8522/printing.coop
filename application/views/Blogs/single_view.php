<?php #pr($blog);?>
<div class="blog-boxes-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="blog-boxes">
            <div class="row">
                <div class="col-md-8 col-lg-9 col-xl-9">
                    <div class="single-inner-blog-box">
                        <div class="single-blog-area">
                            <div class="universal-dark-title">
                                <span><?php  
								        if($this->language_name=='French'){
									       echo $blog['title_french'];
									    }else{
											echo $blog['title'];
										} ?></span>
                            </div>
							<?php 
							  $imageurl=getBlogImage($blog['image'],'large');
							?>
                            <div class="single-blog-img">
                                <img src="<?php echo $imageurl;?>">
                            </div>
                            <div class="single-blog-box-inner">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-blog-category">
                                           <a href="<?php echo $BASE_URL?>Blogs/category/<?php echo base64_encode($blog['category_id'])?>"><span>
									       <?php  if($this->language_name=='French'){ 
									       echo $blog['category_name_french'];
									    }else{
											 echo $blog['category_name'];
										}  ?></span>
										   </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-blog-date">
                                            <span><?php echo date('F d Y',strtotime($blog['created']));?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-blog-inner-content">
                                    <?php if($this->language_name=='French'){
											
									       echo $blog['content_french'];
									    }else{
											echo $blog['content'];
										} ?>
                                    <div class="universal-small-dark-title">
                                        <span><?php echo $this->language_name=='French' ? 'Articles Liés:':'Related Articles:'?></span>
                                    </div>                      
                                    <div class="universal-dark-info">
                                        <span>
										<?php 
										   foreach($releted_blog as $val){
											   if($val['id'] !=$blog['id']){
										   ?>
                                            <a href="<?php echo $BASE_URL?>Blogs/singleview/<?php echo base64_encode($val['id'])?>"><?php 
											if($this->language_name=='French'){
									       echo $val['title_french'];
									    }else{
											echo $val['title'];
										};?></a>
                                            <br>
										   <?php 
											   
											  }
											}?>
                                           
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-share-section">
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5983d393d9a9b2c9" async="async"></script>
                                <div class="blog-share-section-inner">
                                    <div class="row align-items-center">
                                        <div class="col-md-5">
                                            <div class="blog-share-title">
                                                <span><?php echo $this->language_name=='French' ? 'Partager cette publication':'Share this post'?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="post-sharing-button">
                                                <div class="addthis_inline_share_toolbox"></div>
                                                <!--<div class="addthis_sharing_toolbox"></div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3">
                    <?php include("blog-sidebar.php"); ?>
                </div>
            </div>
        </div>
    </div>
</div>