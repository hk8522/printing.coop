<div class="container-fluid header-menu-bar">
    <div class="header-menu-bar-inner">
        <ul class="all-menu">
            <li>
                <a href="<?= $BASE_URL ?>">
                <?= ($language_name == 'French') ? 'Accueil' : 'Home'?></a>
            </li>
            <li>
                <a href="<?= $BASE_URL ?>Products" id="products">
                <?= ($language_name == 'French') ? 'Des produits' : 'Products'?></a>
                <div class="product-dropdown">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-lg-3 col-xl-3" style="border-right: 1px solid #ccc;">
                                <div class="menus-section">
                                  <div class="all-menus">
                                    <?php
                                    //pr($categories);
                                    foreach ($categories['categories'] as $key => $category) {
                                          $count=count($category['sub_categories']);
                                        $url=$BASE_URL.'Products?category_id='.base64_encode($category['id']);
                                        $data_toggle='';
                                        if (!empty($count)) {
                                                     $url="Cat".$category['id'];
                                    $data_toggle='tab';
                                        }
                                        $urlmain=$BASE_URL.'Products?category_id='.base64_encode($category['id']);

                                      ?>
                                      <?php  if (!empty($count)) { ?>
                                      <a href="<?= $urlmain ?>">
                                        <button class="drop-cat tablinks" onmouseover="openCity(event, '<?= $url ?>')">
                                            <?= ($language_name == 'French') ? ucfirst($category['name_french']) : ucfirst($category['name'])?>
                                          <i class="las la-angle-right"></i>
                                        </button>
                                     </a>
                                      <?php
                                      } else {
                                    ?>
                                       <a href="<?= $urlmain ?>">
                                        <button class="drop-cat tablinks" type="button" onmouseover="openCity(event, '<?= $url ?>')">
                                            <?= ($language_name == 'French') ? ucfirst($category['name_french']) : ucfirst($category['name'])?>
                                          <i class="las la-angle-right"></i>
                                        </button>
                                        </a>
                                      <?php } ?>
                                      <?php
                                      }
                                    ?>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9 col-xl-9">
                                      <?php
                                        foreach ($categories['categories'] as $key => $category) {
                                          ?>
                                          <div id="Cat<?= $category['id'] ?>" class="tabcontent" style="display: none;">
                                            <div class="row">
                                            <?php foreach ($category['sub_categories'] as $key => $subCategory) {
                               $url=$BASE_URL.'Products?category_id='.base64_encode($category['id']).'&sub_category_id='.base64_encode($subCategory['id']);
                                                ?>
                                                <div class="col-md-6 col-lg-4 col-xl-4">
                                                    <div class="menus-section">
                                                        <div class="menus-title">
                                                            <span><a href="<?= $url ?>">
                                                            <?= ($language_name == 'French') ? ucfirst($subCategory['name_french']) : ucfirst($subCategory['name'])?></a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                          ?>
                                            </div>
                                          </div>
                                          <?php
                                        }
                                      ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php
                $pages = $this->Page_Model->getPageList(true,1,0,0,$website_store_id);
                $pageSlugArray = pageSlug();
            ?>
            <?php
                  foreach ($pages as $key => $page) {
                  $slug = $page['slug'];
                  $url = $BASE_URL.'Page/'.$slug;
                  $datatoggle = $datatarget='';
                    if (array_key_exists($slug,$pageSlugArray)) {
                      $dataUrl = $pageSlugArray[$slug];
                      $url = $BASE_URL.$dataUrl['class'].'/'.$dataUrl['action'];
                    }
               ?>
              <li>
                <a href="<?= $url ?>" >
                  <?= ($language_name == 'French') ? ucfirst($page['title_france']) : ucfirst($page['title'])?>
                </a>
              </li>
              <?php
              }
               ?>
        </ul>
    </div>
</div>

<div id="mySidenav" class="sidenav">
  <div class="sidebar-menu-field text-left">
    <div class="head">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav01()"><i class="la la-times"></i></a>
    </div>
    <div class="mobile-menu-area">
      <ul class="mobile-menu">
        <li>
          <a href="<?= $BASE_URL ?>">
            <?= ($language_name == 'French') ? 'Accueil' : 'Home'?>
          </a>
        </li>
        <li class="mobile-drop">
          <a href="<?= $BASE_URL ?>Products" id="products">
            <?= ($language_name == 'French') ? 'Des produits' : 'Products'?>
          </a>
          <span class="mob-drop-icon"><i class="las la-angle-down"></i></span>
          <div class="mob-drop-cat" style="display: none;">
            <div class="shop-filter-single">
              <?php if ($categories['categories']) { ?>
                <div class="shop-filter-info">
                  <?php
                    $selected = isset($_GET['category_id']) ? base64_decode($_GET['category_id']) : 'selected';
                    $sub_category_selected=isset($_GET['sub_category_id']) ? base64_decode($_GET['sub_category_id']) : 'selected';
                  ?>
                  <a href="<?= $BASE_URL?>Products" class="<?= $selected ?>">
                    <?= ($language_name == 'French') ? 'Toutes catégories' : 'All categories'?>
                  </a>
                  <?php foreach ($categories['categories'] as $key => $category) { ?>
                    <div class="single-filter-tab">
                      <a href="<?= $BASE_URL?>Products?category_id=<?= base64_encode($category['id'])?>" class="<?= $selected == $category['id'] ? 'selected' : '' ?>">
                        <?= ($language_name == 'French') ? ucfirst($category['name_french']) : ucfirst($category['name'])?>
                      </a>
                      <div class="single-filter-hover">
                        <?php $sub_categories=$category['sub_categories'];
                          if ($sub_categories) { foreach ($sub_categories as $skey => $subcategory) { ?>
                          <div class="single-filter-hover-inner">
                            <a href="<?= $BASE_URL?>Products?category_id=<?= base64_encode($category['id'])?>&sub_category_id=<?= base64_encode($subcategory['id'])?>" class="<?= $sub_category_selected == $subcategory['id'] ? 'selected' : '' ?>">
                              <?= ($language_name == 'French') ? $subcategory['name_french'] : $subcategory['name']?>
                            </a>
                          </div>
                        <?php }
                       } ?>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              <?php } else { ?>
              <div class="shop-filter-info">
                <?= ($language_name == 'French') ? 'Aucune catégorie trouvée' : 'No Category Found'?>
              </div>
              <?php
              } ?>
            </div>
          </div>
        </li>
        <?php
                $pages = $this->Page_Model->getPageList(true,1,0,0,$website_store_id);
                $pageSlugArray = pageSlug();
            ?>
            <?php
                  foreach ($pages as $key => $page) {
                  $slug = $page['slug'];
                  $url = $BASE_URL.'Page/'.$slug;
                  $datatoggle = $datatarget='';
                    if (array_key_exists($slug,$pageSlugArray)) {
                      $dataUrl = $pageSlugArray[$slug];
                      $url = $BASE_URL.$dataUrl['class'].'/'.$dataUrl['action'];
                    }
               ?>
              <li>
                <a href="<?= $url ?>" >
                  <?= ($language_name == 'French') ? ucfirst($page['title_france']) : ucfirst($page['title'])?>
                </a>
              </li>
              <?php
              }
               ?>
      </ul>
    </div>
  </div>
</div>
