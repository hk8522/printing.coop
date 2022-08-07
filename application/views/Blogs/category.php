<div class="blog-boxes-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="blog-boxes">
            <div class="row">
                <div class="col-md-8 col-lg-9 col-xl-9">
                    <div class="blog-boxes">
                        <div class="row">
                        <?php
                       if ($blogs) {
                       foreach ($blogs as $blog) {
                          $imageurl=getBlogImage($blog['image'],'large');

                      ?>
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="single-blog-box">
                                    <div class="single-blog-area">
                                        <div class="single-blog-img" style="background-image: url(<?= $imageurl ?>)"></div>
                                        <div class="single-blog-box-inner">
                                            <div class="single-blog-category">
                                               <a href="<?= $BASE_URL?>Blogs/category/<?= base64_encode($blog['category_id']) ?>"><span>
                                                <?php
                                        if ($this->language_name == 'French') {
                                             echo $blog['category_name_french'];
                                        } else{
                                             echo $blog['category_name'];
                                        }
                                     ?></span></a>
                                            </div>
                                            <div class="universal-small-dark-title">
                                                <span>
                                                    <a href="<?= $BASE_URL?>Blogs/singleview/<?= base64_encode($blog['id']) ?>">
                                                    <?php
                                                    if ($this->language_name == 'French') {
                                                        echo $blog['title_french'];
                                                    } else{
                                                        echo $blog['title'];
                                                    } ?>
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="single-blog-date">
                                                <span><?= date('F d Y',strtotime($blog['created'])) ?></span>
                                            </div>
                                            <div class="universal-dark-info less-content">
                                               <span><?php if ($this->language_name == 'French') {
                                           echo $blog['content_french'];
                                        } else{
                                            echo $blog['content'];
                                        } ?></span>
                                            </div>
                                            <div class="single-blog-more universal-dark-info ">
                                                <a href="<?= $BASE_URL?>Blogs/singleview/<?= base64_encode($blog['id'])?>"><button class="checkout-view" type="submit"><?= $this->language_name == 'French'? 'Lire la suite':'Read more' ?></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <?php
                       }
                      } else{?>
                        <div class="col-md-12 col-lg-12 col-xl-12 text-center">

                                  No blog found

                        </div>
                      <?php
                     } ?>
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
