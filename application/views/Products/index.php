<div class="products-area universal-spacing universal-bg-white">
    <div class="container">
        <div class="products-area-inner">
            <div class="row">
                <div class="col-md-4 col-lg-3 col-xl-3">
                    <div class="shop-filter-area">
                        <div class="shop-filter-single">
                            <div class="universal-small-dark-title">
                                <span><?php
                                      if ($language_name == 'French'){ ?>
                                        Catégories
                                      <?php }else{ ?>
                                        Categories
                                      <?php
                                      }?></span>
                            </div>
                            <?php if ($categories['categories']) {
                              ?>
                              <div class="shop-filter-info">
                                  <?php
                                    $selected = isset($_GET['category_id']) ? base64_decode($_GET['category_id']) : 'selected';
                                    $sub_category_selected=isset($_GET['sub_category_id']) ? base64_decode($_GET['sub_category_id']) : 'selected';

                                  ?>
                                  <?php
                                  if($MainStoreData['show_all_categories']){
                                  ?>
                                  <a href="<?php echo $BASE_URL?>Products" class="<?php echo $selected?>">
                                  <?php
                                  if ($language_name == 'French'){
                                    echo 'Toutes catégories';
                                  }else{
                                    echo 'All categories';
                                  }
                                  ?>

                                    <span><?php echo $categories['all_categories_products']?></span>
                                  </a>
                                  <?php
                                }?>
                                  <?php
                                      foreach ($categories['categories'] as $key => $category) {
                                        ?>
                                        <div class="single-filter-tab">
                                            <a href="<?php echo $BASE_URL?>Products?category_id=<?php echo base64_encode($category['id'])?>" class="<?php echo $selected == $category['id'] ? 'selected' : ''?>">
                                              <?php
                                        if ($language_name == 'French'){
                                        echo ucfirst($category['name_french']);
                                        }else{
                                        echo ucfirst($category['name']);
                                        }	?>
                                              <span><?php echo $category['total_products'] ?></span>
                                            </a>

                                            <div class="single-filter-hover">
                                                <?php
                                            $sub_categories=$category['sub_categories'];
                                            if($sub_categories){
                                                foreach ($sub_categories as $skey => $subcategory) {
                                            ?>
                                                    <div class="single-filter-hover-inner">
                                                      <a href="<?php echo $BASE_URL?>Products?category_id=<?php echo base64_encode($category['id'])?>&sub_category_id=<?php echo base64_encode($subcategory['id'])?>" class="<?php echo $sub_category_selected == $subcategory['id'] ? 'selected' : ''?>">

                                                        <?php

                                                        if ($language_name == 'French'){
                                        echo $subcategory['name_french'];
                                                       }else{
                                       echo $subcategory['name'];
                                                        }?>

                                                        <span><?php echo $subcategory['sub_category_total_products'] ?></span>
                                                      </a>
                                                      <div class="single-filter-hover1">
                                                    <?php  $products=$subcategory['products'];

                                                      /*if($products){
                                                         foreach ($products as $pkey => $product) {
                                                     ?>

                                        <div class="single-filter-hover-inner">
                                                          <a href="<?php echo $BASE_URL?>Products/view/<?php echo base64_encode($product['id'])?>">
                                                            <?php echo $product['name'];
                                                            ?>
                                                          </a>

                                                      </div>
                                                        <?php }
                                                      }*/

                                                      ?>
                                                      </div>
                                                    </div>

                                                <?php }
                                            }?>
                                            </div>
                                        </div>
                                        <?php
                                      }
                                  ?>
                              </div>
                              <?php
                            } else {
                                ?>
                                <div class="shop-filter-info">
                                  <?php
                                  if ($language_name == 'French'){ ?>
                                    Aucune catégorie trouvée
                                  <?php }else{ ?>
                                    No Category Found
                                  <?php
                                  }?>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
                <?php
                  if ($lists) {
                    ?>
                    <div class="col-md-8 col-lg-9 col-xl-9">
                        <div class="sort-filter-area">
                            <div class="universal-dark-info cat-top-text">
                            <?php
                                $cat_title='';
                                $cat_des='';
                                //pr($sub_category_data);
                                //pr($category_data);
                                if(empty($sub_category_data) && !empty($category_data)){
                                                                                                               $cat_title=$category_data['name'];
                                                                                                            $cat_des=$category_data['category_dispersion'];
                                if ($language_name == 'French'){
                                             $cat_title=$category_data['name_french'];
                                             $cat_des=$category_data['category_dispersion_french'];
                                }
                                } else if(!empty($sub_category_data) && !empty($category_data)){
                                    $cat_title=$sub_category_data['name'];
                                    $cat_des=$sub_category_data['sub_category_dispersion'];
                                    if ($language_name == 'French'){
                                        $cat_title=$sub_category_data['name_french'];
                                        $cat_des=$sub_category_data['sub_category_dispersion_french'];
                                    }
                                }
                              ?>
                              <h6 style="text-align:center;"><?php echo $cat_title;?></h6>
                              <span><?php echo $cat_des;?></span>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-4 col-md-4">
                                    <div class="sort-left-filter">
                                        <ul class="nav nav-pills">
                                            <li><a class="active" data-toggle="pill" href="#tab-grid"><i class="las la-th"></i></a></li>
                                            <li><a class="" data-toggle="pill" href="#tab-list"><i class="las la-list"></i></a></li>
                                            <li>
                                                <!--<span>
                                                Show:
                                                <a href="#">9</a> /
                                                <a href="#">12</a> /
                                                <a href="#">18</a> /
                                                <a href="#">24</a>
                                                </span>-->

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8 col-md-8">
                                    <div class="sort-right-filter">
                                        <div class="sort-right-filter-inner">

                                            <form action="">
                                              <span>
                                                  <?php
                                                  if ($language_name == 'French'){ ?>
                                                    Trier par
                                                  <?php }else{ ?>
                                                    Sort by
                                                  <?php
                                                  }?>:
                                              </span>
                                               <input type="hidden" value="<?php echo base64_encode($category_id)?>" name="category_id">
                                              <input type="hidden" value="<?php echo base64_encode($sub_category_id)?>" name="sub_category_id">
                                              <select id="product-sorter-new" class="sorter-options" name="sort_by" onchange="this.form.submit()">
                                                <?php
                                                    $sortByOptions = getSortByDropdown();

                                                    foreach ($sortByOptions as $key => $sortByOption) {
                                                      $selected = '';
                                                      if ($key == $order) {
                                                        $selected = 'selected="selected"';
                                                      }
                                                    ?>
                                                <option value="<?php echo $sortByOption['order_by']?>" <?php echo $selected;?>>
                                                    <?php echo $language_name == 'French' ?  $sortByOption['label_french']:$sortByOption['label']?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                              </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="all-products-area">
                            <div class="tab-content">
                                <div id="tab-grid" class="tab-pane fade active show">
                                    <div class="row">
                                     <?php
                                      foreach ($lists as $key => $list) { ?>
                                        <div class="col-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="single-products">
                                                <div class="product-img">
                                                  <?php $imageurl = getProductImage($list['product_image'], 'medium'); ?>
                                                  <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id']);?>"><img src="<?php echo $imageurl?>"></a>
                                                </div>
                                                <div class="product-detail">
                                                    <div class="product-detail-inner">
                                                        <div class="product-name">
                                                            <span>
                                                              <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id']);?>">

                                                                <?php
                                                                if ($language_name == 'French'){
                                                                echo $list['name_french'];
                                                                }else{
                                                                echo $list['name'];
                                                                }
                                                                ?>
                                                              </a>
                                                            </span>
                                                        </div>
                                                        <?php
$category_id=isset($_GET['category_id']) ? base64_decode($_GET['category_id']) : '';														$productCategory  = $list['category'];
$multipalCategory = $list['multipalCategory'];
//pr($multipalCategory,1);

                                                        ?>
                                                        <div class="product-cat">
                                                            <span>
                                                              <a href="javascript:void(0)">
                                                                <?php

/*echo $productCategory['name'];*/
if ($language_name == 'French'){
echo empty($category_id) ? $productCategory['name_french']:$multipalCategory[$category_id]['name_french'];
}else{
echo empty($category_id) ? $productCategory['name']:$multipalCategory[$category_id]['name'];
}
?>
                                                              </a>
                                                            </span>
                                                        </div>
                                                        <div class="product-price-area">
                                                            <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id']);?>" class="cart-btn">
                                                              <i class="las la-search"></i>
                                                              <span><?php
                                                                    if ($language_name == 'French'){ ?>
                                                                      Aperçu rapide
                                                                    <?php }else{ ?>
                                                                      Quick View
                                                                    <?php
                                                                    }?></span>
                                                            </a>
                                                            <div class="product-price">
                                                                <span>

    <?php

        echo $product_price_currency_symbol.number_format($list[$product_price_currency],2);
    ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          <?php
                                        }
                                      ?>
                                    </div>
                                </div>
                                <div id="tab-list" class="tab-pane fade">
                                    <div class="row">
                                     <?php
                                      foreach ($lists as $key => $list) { ?>
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="single-products product-list-view">
                                                <div class="product-img">
                                                  <?php $imageurl = getProductImage($list['product_image'], 'medium'); ?>
                                                  <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id']);?>"><img src="<?php echo $imageurl?>"></a>
                                                </div>
                                                <div class="product-detail">
                                                    <div class="product-detail-inner">
                                                        <div class="product-name">
                                                            <span>
                                                              <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id']);?>">

                                                                <?php
                                                                if ($language_name == 'French'){
                                                                echo$list['name_french'];
                                                                }else{
                                                                    echo $list['name'];
                                                                } ?>

                                                              </a>
                                                            </span>
                                                        </div>
                                                        <?php
                                        //$productCategory = $list['category']; ?>
                                                        <div class="product-cat">
                                                            <span>

                                                              <a href="javascript:void(0)">
                                                                <?php

$category_id=isset($_GET['category_id']) ? base64_decode($_GET['category_id']) : '';
$productCategory  = $list['category'];
$multipalCategory = $list['multipalCategory'];
if ($language_name == 'French'){
echo empty($category_id) ? $productCategory['name_french']:$multipalCategory[$category_id]['name_french'];
}else{
echo empty($category_id) ? $productCategory['name']:$multipalCategory[$category_id]['name'];
}
?>
                                                              </a>
                                                              <!--<a href="javascript:void(0)">
                                                                <?php echo $productCategory['name'] ?>
                                                              </a>-->
                                                            </span>
                                                        </div>
                                                        <div class="product-price-area">
                                                            <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id']);?>" class="cart-btn">
                                                              <i class="las la-search"></i>
                                                              <span><?php
                                                                    if ($language_name == 'French'){ ?>
                                                                      Aperçu rapide
                                                                    <?php }else{ ?>
                                                                      Quick View
                                                                    <?php
                                                                    }?></span>
                                                            </a>
                                                            <div class="product-price">
                                                                <span><?php  echo $product_price_currency_symbol.number_format($list[$product_price_currency],2);?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          <?php
                                        }
                                      ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="universal-pagination">
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="text-left">
                                         <?php
                                           if(!empty($prevPage)){?>

                                            <a href="<?php echo $url;?>&pageno=<?php echo $prevPage;?>"><button type="button"><?php
                  if ($language_name == 'French'){ ?>
                    Précédent
                  <?php }else{ ?>
                    Previous
                  <?php
                  }?></button></a>
                                           <?php
                                           }?>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="text-right">
                                            <?php if(!empty($NextPage)){?>
                                             <a href="<?php echo $url;?>&pageno=<?php echo $NextPage;?>"><button type="button"><?php
                  if ($language_name == 'French'){ ?>
                    Prochain
                  <?php }else{ ?>
                    Next
                  <?php
                  }?></button></a>
                                           <?php
                                           }?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cat-bottom-img">

                          <?php

                            $src='';
                            if(empty($sub_category_data) && !empty($category_data)){
                                $categoryImages=$this->Category_Model->getCategoriesImagesDataBy($category_data['id']);
                                $categoryImage=$categoryImages[$website_store_id];
                                $src=geCategoryImage($categoryImage['image']);
                                if ($language_name == 'French'){
                                    $src=geCategoryImage($categoryImage['image_french']);
                                }
                                /*$src=geCategoryImage($category_data['image']);
                                if ($language_name == 'French'){
                                    $src=geCategoryImage($category_data['image_french']);
                                }*/
                            }
                            if(!empty($src)){
                           ?>

                          <img src="<?php echo $src;?>">
                           <?php }?>
                        </div>

                    </div>
                    <?php
                  } else {
                      ?>
                      <div class="col-md-9 text-center">
                          <h3><?php
                  if ($language_name == 'French'){ ?>
                    Aucun produit trouvé
                  <?php }else{ ?>
                    No Product Found
                  <?php
                  }?></h3>
                      </div>
                      <?php
                  } ?>
            </div>
        </div>
    </div>
</div>
