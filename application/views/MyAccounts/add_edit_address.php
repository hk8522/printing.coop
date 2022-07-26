<div class="account-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="account-section-inner">
            <?php $this->load->view('elements/my-account-menu') ?>
            <div class="account-area">
                <div class="universal-dark-title">
                    <span><?php echo $page_title;?></span>
                </div>
                <div class="account-address-area">
                    <div class="edit-address" style="display:blok">
                        <div class="edit-heading">
                            <label id="edit"><?php echo $page_title;?></label>
                        </div>
                         <form method="post" id="add-new-address">
                        <div class="delivery-fileds">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-review">
                                       <input class="form-control" name="id"  type="hidden"  value="<?php echo isset($postData['id']) ? $postData['id']:'';?>" maxlength="50">

                                       <input class="form-control" name="first_name" id="first_name" type="text" placeholder="First Name *" value="<?php echo isset($postData['first_name']) ? $postData['first_name']:'';?>" maxlength="50">
                                       <?php echo form_error('first_name');?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <input class="form-control" name="last_name" id="last_name" type="text" placeholder="Last Name *" value="<?php echo isset($postData['last_name']) ? $postData['last_name']:'';?>" maxlength="50">
                                       <?php echo form_error('last_name');?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-review">
                                       <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Mobile Number*" value="<?php echo isset($postData['mobile']) ? $postData['mobile']:'';?>" maxlength="10">
                                        <?php echo form_error('mobile');?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-review">
                                        <input type="text" class="form-control" name="company_name" id="company_name" type="text" placeholder="company Name *" value="<?php echo isset($postData['company_name']) ? $postData['company_name']:'';?>" maxlength="50">
                                       <?php echo form_error('company_name');?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="single-review">

                                        <textarea style="height:150px;" name="address" placeholder="Address (area &amp; street)*">"<?php echo isset($postData['address']) ? $postData['address']:'';?></textarea>
                                       <?php echo form_error('address');?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-review">
                                      <select name="country" onchange="getState($(this).val())">
                                          <?php
                                        if ($language_name == 'French'){ ?>
                                          <option value="">-- Choisissez le pays --</option>
                                        <?php }else{ ?>
                                         <option value="">-- Select Country --</option>
                                        <?php
                                        }?>

                                      <?php foreach ($countries as $country) {
                                          $selected = '';
                                          $post_country = isset($postData['country']) ? $postData['country']:'';
                                          if ($country['id'] == $post_country){
                                              $selected='selected="selected"';
                                          }
                                          ?>
                                      <option value="<?php echo $country['id']?>" <?php echo $selected;?>><?php echo $country['name'];?></option>
                                      <?php }?>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-review">
                                      <select name="state" id="stateiD"  onchange="getCity($(this).val())">
                                          <?php
                                        if ($language_name == 'French'){ ?>
                                          <option value="">-- Sélectionnez l'état --</option>
                                        <?php }else{ ?>
                                         <option value="">-- Select State --</option>
                                        <?php
                                        }?>

                                      <?php foreach($states as $state){
                                      $selected='';
                                      $post_state= isset($postData['state']) ? $postData['state']:'';

                                      if($state['id'] == $post_state){
                                            $selected='selected="selected"';
                                      }
                                    ?>
                                       <option value="<?php echo $state['id']?>" <?php echo $selected;?>><?php echo $state['name'];?>
                                      </option>
                                <?php }?>
                                </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-review">
                                      <select name="city" id="cityId">
                                          <?php
                                        if ($language_name == 'French'){ ?>
                                          <option value="">-- Sélectionnez une ville --</option>
                                        <?php }else{ ?>
                                         <option value="">-- Select City --</option>
                                        <?php
                                        }?>

                                      <?php foreach ($citys as $city) {
                                          $selected ='';
                                          $post_city = isset($postData['city']) ?     $postData['city']:'';

                                            if ($city['id'] == $post_city){
                                              $selected='selected="selected"';
                                            }
                                          ?>
                                      <option value="<?php echo $city['id']?>" <?php echo $selected;?>><?php echo $city['name'];?></option>
                                      <?php }?>
                                    </select>
                                     <?php echo form_error('city');?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-review">
                                         <input class="form-control" name="pin_code" id="pin_code" type="text" placeholder="Pin Code*" value="<?php echo isset($postData['pin_code']) ? $postData['pin_code']:'';?>" maxlength="10">
                                        <?php echo form_error('pin_code');?>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="address-type">
                            <div class="single-review">
                                <label>
                                <?php
                                if ($language_name == 'French'){ ?>
                                  Type d'adresse
                                <?php }else{ ?>
                                 Address Type
                                <?php
                                }?></label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                        $address_type=isset($postData['address_type']) ? $postData['address_type']:'';

                                    ?>
                                    <label id="home"><input name="address_type" value="home" for="home" type="radio"

                                    <?php if($address_type==''){echo 'checked';} else if($address_type=='home'){ echo 'checked';}?>>
                                        <?php
                                        if ($language_name == 'French'){ ?>
                                          Accueil (livraison toute la journée
                                        <?php }else{ ?>
                                         Home (All day delivery
                                        <?php
                                        }?>)</label>
                                </div>
                                <div class="col-md-6">
                                    <label id="work"><input name="address_type" value="work" for="work" type="radio"  <?php if($address_type=='work'){ echo 'checked';}?>>
                                    <?php
                                        if ($language_name == 'French'){ ?>
                                          Travail (livraison entre 10h et 17h)
                                        <?php }else{ ?>
                                         Work (Delivery between 10AM - 5PM)
                                        <?php
                                        }?></label>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                                $default_delivery_address=isset($postData['default_delivery_address']) ? $postData['default_delivery_address']:'';
                                                $cehecked='';
                                                if($default_delivery_address==1){
                                                    $cehecked='checked';
                                                }
                                    ?>
                                    <label id="default_delivery_address">
                                    <input name="default_delivery_address" value="1" for="default_delivery_address" type="checkbox"
                                    <?php echo $cehecked;?> style="width: auto;">
                                        <?php
                                        if ($language_name == 'French'){ ?>
                                          Créer une adresse de livraison par défaut
                                        <?php }else{ ?>
                                         Make a Default Delivery Address
                                        <?php
                                        }?></label>
                                </div>
                            </div>
                        </div>
                        <div class="save-btn">
                            <button class="save">Save</button>
                            <a href="<?php echo $BASE_URL;?>MyAccounts/manageAddress">
                            <?php
                            if ($language_name == 'French'){ ?>
                              Annuler
                            <?php }else{ ?>
                             Cancel
                            <?php
                            }?></a>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

