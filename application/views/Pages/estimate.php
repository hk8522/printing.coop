<div class="estimate-section universal-spacing universal-bg-white">
    <div class="container ">
	<?php
	if($language_name=='French'){
	echo $pageData['description_france'];
	}else{
	echo $pageData['description'];
	}
	?>
      <div class="text-center" id="estimate-message"></div>
         <div class="estimate-section-inner">
          <?php
            if($language_name=='French'){ ?>
            <form method="post" id="estimate-form">
              <div class="contact-form">
                  <div class="estimate-inner1">
                      <div class="row">
                          <div class="col-md-3">
                              <div class="single-review">
                                  <label>Nom du contact <span class="text-danger">*</span></label>
                                  <input type="text" name="contact_name">
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="single-review">
                                  <label>Nom de la compagnie <span class="text-danger">*</span></label>
                                  <input type="text" name="company_name">
                              </div>
                          </div>
                          <div class="col-md-3">
                            <div class="single-review">
                              <label>Email <span class="text-danger">*</span></label>
                              <input type="email" name="email">
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="single-review">
                                  <label>Numéro de téléphone <span class="text-danger">*</span></label>
                                  <input type="text" name="phone_number">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="single-review">
                                  <label>rue <span class="text-danger">*</span></label>
                                  <input type="text" name="street">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Ville <span class="text-danger">*</span></label>
                                  <input type="text" name="city">
                              </div>
                          </div>
						              <div class="col-md-2">
                              <div class="single-review">
                                  <label>Pays <span class="text-danger">*</span></label>
                								  <select name="country" onchange="getState($(this).val())">
                									  <option value="">-- Choisissez le pays --</option>
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
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Etat</label>
                								  <select name="province" id="stateiD">
                                      <option value="">-- Sélectionnez l'état --</option>
                                      <?php foreach($states as $state){
                								      $selected='';
                  									  $post_state= isset($postData['state']) ? $postData['state']:'';

                  									  if($state['StateID'] == $post_state){
                  										    $selected='selected="selected"';
                  									  }
                  								    ?>
              								        <option value="<?php echo $state['StateID']?>" <?php echo $selected;?>><?php echo $state['StateName'];?></option>
                								      <?php }?>
            								      </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>code postal <span class="text-danger">*</span></label>
                                  <input type="text" name="postal_code">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner2">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label>Veuillez saisir les spécifications de vos produits ci-dessous:</label>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label><input type="checkbox" id="upload-option-btn" name="has_quote_form"> J'ai mon propre formulaire de soumission de devis à télécharger</label>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner3">
                      <div class="row">
                          <div class="col-md-4">
                               <div class="single-review">
                                   <label>Type de produit (cartes postales, livrets)</label>
                                   <select name="product_type">
                                      <option value="Top Sellers">Meilleures ventes</option>
                                      <option value="Large Format">Grand format</option>
                                      <option value="Print Products">Produits d'impression</option>
                                      <option value="Holiday Printing">Impression de vacances</option>
                                      <option value="Stationery">Papeterie</option>
                                      <option value="Labels / Stickers">Étiquettes / autocollants</option>
                                      <option value="Direct Mail">Courrier direct</option>
                                      <option value="Promotional">Promotionnel</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                               <div class="single-review">
                                   <label></label>
                                   <select name="product_name">
                                      <option value="Business Cards">Cartes de visite</option>
                                      <option value="Postcards">Cartes postales</option>
                                      <option value="Flyers">Flyers</option>
                                      <option value="Brochures">Brochures</option>
                                      <option value="Bookmarks">Favoris</option>
                                      <option value="Presentation Folders">Dossiers de présentation</option>
                                      <option value="Booklets">Livrets</option>
                                      <option value="Magnets">Aimants</option>
                                      <option value="Greeting Cards">Cartes de voeux</option>
                                      <option value="Numbered Tickets">Billets numérotés</option>
                                      <option value="Wall Calendars">Billets numérotés</option>
                                      <option value="Variable Printing">Impression variable</option>
                                   </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                               <div class="single-review">
                                   <label>Avez-vous déjà demandé le même devis?</label>
                                   <select name="same_quote_request">
                                      <option value="0">Non</option>
                                      <option value="1">Oui</option>
                                   </select>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner4">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="single-review">
                                  <label>Qté1</label>
                                  <input type="text" name="qty_1">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Qté2</label>
                                  <input type="text" name="qty_2">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Qté3</label>
                                  <input type="text" name="qty_3">
                              </div>
                          </div>
                         <div class="col-md-4">
                              <div class="single-review">
                                  <label>Plus de quantité:</label>
                                  <input type="text" name="more_qty">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label>Taille à plat (pouces) <span class="text-danger">*</span></label>
                                  <input type="text" name="flat_size">
                                  <span>Format plat: la taille du travail lorsqu'il n'est pas plié.</span>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label>Taille finie (pouces) <span class="text-danger">*</span></label>
                                  <input type="text" name="finish_size">
                                  <span>Taille finie: la taille du travail une fois qu'il est complètement plié.</span>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="single-review">
                                  <label>Papier / Stock</label>
                                  <select name="paper_stock">
                                      <option value="8pt C2S COVER">8pt C2S COVER</option>
                                      <option value="8pt C2S GLOSS">8pt C2S GLOSS</option>
                                      <option value="8pt COVER C2S">8pt COVER C2S</option>
                                      <option value="12pt C2S GLOSS">12pt C2S GLOSS</option>
                                      <option value="13pt ENVIRO COVER">13pt ENVIRO COVER</option>
                                      <option value="14pt MATT">14pt MATT (coated)</option>
                                      <option value="14pt C2S GLOSS">14pt C2S GLOSS</option>
                                      <option value="14pt C2S GLOSS UV">14pt C2S GLOSS UV</option>
                                      <option value="16pt C2S GLOSS">16pt C2S GLOSS</option>
                                      <option value="60lb OFFSET TEXT">60lb OFFSET TEXT</option>
                                      <option value="70lb GLOSS TEXT">70lb GLOSS TEXT</option>
                                      <option value="70lb OFFSET TEXT">70lb OFFSET TEXT</option>
                                      <option value="80lb ENVIRO TEXT">80lb ENVIRO TEXT</option>
                                      <option value="80lb GLOSS TEXT">80lb GLOSS TEXT</option>
                                      <option value="80lb OFFSET TEXT">80lb OFFSET TEXT</option>
                                      <option value="80lb SILK TEXT">80lb SILK TEXT</option>
                                      <option value="100lb GLOSS TEXT">100lb GLOSS TEXT</option>
                                      <option value="100lb GLOSS COVER">100lb GLOSS COVER</option>
                                      <option value="100lb MATTE TEXT (COATED)">100lb MATTE TEXT (COATED)</option>
                                      <option value="4mm FOAM BOARD">4mm FOAM BOARD</option>
                                      <option value="4mm Coroplast">4mm Coroplast</option>
                                      <option value="6mm Coroplast">6mm Coroplast</option>
                                      <option value="8mm Coroplast">8mm Coroplast</option>
                                      <option value="CANVAS ROLL">CANVAS ROLL</option>
                                      <option value="ENVELOPE">ENVELOPE</option>
                                      <option value="LABEL">LABEL</option>
                                      <option value="LARGE POSTER">LARGE POSTER</option>
                                      <option value="13pt LINEN UNCOATED CARD">13pt LINEN UNCOATED CARD</option>
                                      <option value="70lb LINEN UNCOATED TEXT">70lb LINEN UNCOATED TEXT</option>
                                      <option value="MAGNET (14pt)">MAGNET (14pt)</option>
                                      <option value="OPAQUE CLING">OPAQUE CLING</option>
                                      <option value="Plastic">Plastic</option>
                                      <option value="POP STAND">POP STAND</option>
                                      <option value="STYRENE">STYRENE</option>
                                      <option value="TRANSPARENT CLING">TRANSPARENT CLING</option>
                                      <option value="Vinyl Gloss">Vinyl Gloss</option>
                                      <option value="Vinyl Matte">Vinyl Matte</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="single-review">
                                  <label>Nombre de côtés</label>
                                  <div class="row">
                                      <div class="col-md-2">
                                          <label><input class="radio" name="no_of_sides" value="1" type="radio" checked=""> 1 face (pouces)</label>
                                      </div>
                                       <div class="col-md-10">
                                          <label><input class="radio" name="no_of_sides" value="2" type="radio"> Format plat (2 faces)</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="single-review">
                                  <label>Pliant</label>
                                  <select name="folding">
                                      <option value="No Fold">No Fold </option>
                                      <option value="Half Fold">Half Fold </option>
                                      <option value="3 Pannel Z Fold">3 Pannel Z Fold </option>
                                      <option value="3 Pannel Roll Fold">3 Pannel Roll Fold </option>
                                      <option value="Double Parallel Fold">Double Parallel Fold </option>
                                      <option value="Gate Fold">Gate Fold</option>
                                      <option value="Double Gate Fold">Double Gate Fold</option>
                                      <option value="Four Pannel Accordian Fold">Four Pannel Accordian Fold</option>
                                      <option value="8 Pg Fold">8 Pg Fold </option>
                                      <option value="12 Pg Fold">12 Pg Fold </option>
                                      <option value="Other">Other </option>
                                 </select>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner5">
                      <div class="expand-blog">
                          <div class="universal-small-dark-title">
                              <span>Finition:</span>
                          </div>
                          <!-- <div class="order-btn">
                               <button id="expand-form-btn" type="button"><i class="las la-plus"></i><i class="las la-minus"></i> Expand</button>
                          </div> -->
                      </div>
                      <div class="expand-blog-inner" id="expand-form" style="display: none;">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Découpe</label>
                                      <input type="text" name="contact-name">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Coin arrondi </label>
                                      <select>
                                          <option value=""> Veuillez sélectionner ...</option>
                                          <option value="1 Corner"> 1 Corner</option>
                                          <option value="2 Corners"> 2 Corners</option>
                                          <option value="3 Corners"> 3 Corners</option>
                                          <option value="4 Corners">4 Corners</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Collationner </label>
                                      <input type="text">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Forage</label>
                                      <select>
                                          <option value="">Veuillez sélectionner ...</option>
                                          <option value="1 Hole">1 Hole1 Hole</option>
                                          <option value="2 Holes">1 Holes2 Holes</option>
                                          <option value="3 Holes">1 Holes3 Holes</option>
                                          <option value="Automotive">Automotive</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Regroupement </label>
                                      <select>
                                          <option value="">Veuillez sélectionner ...</option>
                                          <option value="Single Band - 25s">Single Band - 25s</option>
                                          <option value="Single Band - 50s">Single Band - 50s</option>
                                          <option value="Single Band - 100s">Single Band - 100s</option>
                                          <option value="Double Band - 25s">Double band - 25s</option>
                                          <option value="Double Band - 50s">Double band - 50s</option>
                                          <option value="Double Band - 100s">Double band - 100s</option>
                                          <option value="Shrink Wrap - 25s">Shrink Wrap - 25s</option>
                                          <option value="Shrink Wrap - 50s">Shrink Wrap - 50s</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Numérotage</label>
                                        <div class="row">
                                          <div class="col-md-2">
                                              <label><input class="radio" name="numbering" value="numberingNO" type="radio" checked=""> Non</label>
                                          </div>
                                          <div class="col-md-10">
                                              <label><input class="radio" name="numbering" value="numberingYES" type="radio"> Oui</label>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Notation </label>
                                      <select>
                                          <option value="">Veuillez sélectionner ...</option>
                                          <option value="1 Score">1 Les scores</option>
                                          <option value="2 Scores">2 Les scores</option>
                                          <option value="3 Scores">3 Les scores</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Perforation</label>
                                      <select>
                                          <option value="">Veuillez sélectionner ...</option>
                                          <option value="1 Perf">1 performances</option>
                                          <option value="2 Perfs">2 performances</option>
                                          <option value="3 Perfs">3 performances</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Spécial</label>
                                      <select>
                                          <option value="">Veuillez sélectionner ...</option>
                                          <option value="Emboss">Gaufrer</option>
                                          <option value="Foil">Déjouer</option>
                                          <option value="Deboss">Deboss</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Autre</label>
                                     <input type="text">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner6">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label>Combien de versions souhaitez-vous? <span class="text-danger">*</span></label>
                                  <select name="total_versions">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                  </select>
                                  <span>Combien de versions souhaitez-vous? Nombre de fichiers graphiques différents à soumettre. Par exemple, si vous avez 2 cartes postales différentes à commander, sélectionnez «2»</span>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="single-review" id="upload-option-hide">
                                  <label>Shipping Method</label>
                                  <select name="shipping_methods">
                                      <option value="Pick up at COOP">Ramasser / expédier à mon adresse</option>
                                      <option value="Ship for me">Expédiez pour moi</option>
                                  </select>
                                  <span>Notes supplémentaires Veuillez fournir toute information supplémentaire sur votre demande de devis (p. Ex. Piquage à cheval, bobine, reliure parfaite).</span>
                              </div>
                              <div class="single-review" id="upload-option-open" style="display: none;">
                                  <label>Téléchargez votre soumission de devis</label>
                                  <input type="file">
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="single-review">
                                  <textarea type="text" name="notes"></textarea>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner7">
                      <div class="single-review">
                          <div class="order-btn">
                              <button type="submit">Soumettre une demande de devis</button>
                          </div>
                          <span>Veuillez noter que printing.coop Free Local Delivery ne s'applique pas aux commandes personnalisées.printing.coop n'est plus certifié FSC et ne peut plus fournir de services certifiés FSC</span>
                      </div>
                  </div>
              </div>
            </form>
            <?php }else{ ?>
            <form method="post" id="estimate-form">
              <div class="contact-form">
                  <div class="estimate-inner1">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="single-review">
                                  <label>Contact Name <span class="text-danger">*</span></label>
                                  <input type="text" name="contact_name">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Company Name <span class="text-danger">*</span></label>
                                  <input type="text" name="company_name">
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="single-review">
                              <label>Email <span class="text-danger">*</span></label>
                              <input type="email" name="email">
                            </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Phone Number <span class="text-danger">*</span></label>
                                  <input type="text" name="phone_number">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="single-review">
                                  <label>Street <span class="text-danger">*</span></label>
                                  <input type="text" name="street">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>City <span class="text-danger">*</span></label>
                                  <input type="text" name="city">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Country <span class="text-danger">*</span></label>
                                  <select name="country" onchange="getState($(this).val())">
                                    <option value="">-- Select Country --</option>
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
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>State</label>
                                  <select name="province" id="stateiD">
                                      <option value="">-- Select State --</option>
                                      <?php foreach($states as $state){
                                      $selected='';
                                      $post_state= isset($postData['state']) ? $postData['state']:'';

                                      if($state['StateID'] == $post_state){
                                          $selected='selected="selected"';
                                      }
                                      ?>
                                      <option value="<?php echo $state['StateID']?>" <?php echo $selected;?>><?php echo $state['StateName'];?></option>
                                      <?php }?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Postal Code <span class="text-danger">*</span></label>
                                  <input type="text" name="postal_code">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner2">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label>Please enter your products specifications below:</label>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label><input type="checkbox" id="upload-option-btn" name="has_quote_form"> I have my own quote submission form to upload</label>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner3">
                      <div class="row">
                          <div class="col-md-4">
                               <div class="single-review">
                                   <label>Product Type ( i.e. Postcards, Booklets )</label>
                                   <select name="product_type">
                                      <option value="Top Sellers">Top Sellers</option>
                                      <option value="Large Format">Large Format</option>
                                      <option value="Print Products">Print Products</option>
                                      <option value="Holiday Printing">Holiday Printing</option>
                                      <option value="Stationery">Stationery</option>
                                      <option value="Labels / Stickers">Labels / Stickers</option>
                                      <option value="Direct Mail">Direct Mail</option>
                                      <option value="Promotional">Promotional</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                               <div class="single-review">
                                   <label></label>
                                   <select name="product_name">
                                      <option value="Business Cards">Business Cards</option>
                                      <option value="Postcards">Postcards</option>
                                      <option value="Flyers">Flyers</option>
                                      <option value="Brochures">Brochures</option>
                                      <option value="Bookmarks">Bookmarks</option>
                                      <option value="Presentation Folders">Presentation Folders</option>
                                      <option value="Booklets">Booklets</option>
                                      <option value="Magnets">Magnets</option>
                                      <option value="Greeting Cards">Greeting Cards</option>
                                      <option value="Numbered Tickets">Numbered Tickets</option>
                                      <option value="Wall Calendars">Wall Calendars</option>
                                      <option value="Variable Printing">Variable Printing</option>
                                   </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                               <div class="single-review">
                                   <label>Have you requested the same quote before?</label>
                                   <select name="same_quote_request">
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                   </select>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner4">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="single-review">
                                  <label>Qty1</label>
                                  <input type="text" name="qty_1">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Qty2</label>
                                  <input type="text" name="qty_2">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <div class="single-review">
                                  <label>Qty3</label>
                                  <input type="text" name="qty_3">
                              </div>
                          </div>
                         <div class="col-md-4">
                              <div class="single-review">
                                  <label>More Qty:</label>
                                  <input type="text" name="more_qty">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label>Flat Size ( inches ) <span class="text-danger">*</span></label>
                                  <input type="text" name="flat_size">
                                  <span>Flat Size: the size of the job when it is not folded.</span>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label>Finished Size ( inches ) <span class="text-danger">*</span></label>
                                  <input type="text" name="finish_size">
                                  <span>Finished Size: the size of the job after it is completely folded.</span>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="single-review">
                                  <label>Paper/Stock</label>
                                  <select name="paper_stock">
                                      <option value="8pt C2S COVER">8pt C2S COVER</option>
                                      <option value="8pt C2S GLOSS">8pt C2S GLOSS</option>
                                      <option value="8pt COVER C2S">8pt COVER C2S</option>
                                      <option value="12pt C2S GLOSS">12pt C2S GLOSS</option>
                                      <option value="13pt ENVIRO COVER">13pt ENVIRO COVER</option>
                                      <option value="14pt MATT">14pt MATT (coated)</option>
                                      <option value="14pt C2S GLOSS">14pt C2S GLOSS</option>
                                      <option value="14pt C2S GLOSS UV">14pt C2S GLOSS UV</option>
                                      <option value="16pt C2S GLOSS">16pt C2S GLOSS</option>
                                      <option value="60lb OFFSET TEXT">60lb OFFSET TEXT</option>
                                      <option value="70lb GLOSS TEXT">70lb GLOSS TEXT</option>
                                      <option value="70lb OFFSET TEXT">70lb OFFSET TEXT</option>
                                      <option value="80lb ENVIRO TEXT">80lb ENVIRO TEXT</option>
                                      <option value="80lb GLOSS TEXT">80lb GLOSS TEXT</option>
                                      <option value="80lb OFFSET TEXT">80lb OFFSET TEXT</option>
                                      <option value="80lb SILK TEXT">80lb SILK TEXT</option>
                                      <option value="100lb GLOSS TEXT">100lb GLOSS TEXT</option>
                                      <option value="100lb GLOSS COVER">100lb GLOSS COVER</option>
                                      <option value="100lb MATTE TEXT (COATED)">100lb MATTE TEXT (COATED)</option>
                                      <option value="4mm FOAM BOARD">4mm FOAM BOARD</option>
                                      <option value="4mm Coroplast">4mm Coroplast</option>
                                      <option value="6mm Coroplast">6mm Coroplast</option>
                                      <option value="8mm Coroplast">8mm Coroplast</option>
                                      <option value="CANVAS ROLL">CANVAS ROLL</option>
                                      <option value="ENVELOPE">ENVELOPE</option>
                                      <option value="LABEL">LABEL</option>
                                      <option value="LARGE POSTER">LARGE POSTER</option>
                                      <option value="13pt LINEN UNCOATED CARD">13pt LINEN UNCOATED CARD</option>
                                      <option value="70lb LINEN UNCOATED TEXT">70lb LINEN UNCOATED TEXT</option>
                                      <option value="MAGNET (14pt)">MAGNET (14pt)</option>
                                      <option value="OPAQUE CLING">OPAQUE CLING</option>
                                      <option value="Plastic">Plastic</option>
                                      <option value="POP STAND">POP STAND</option>
                                      <option value="STYRENE">STYRENE</option>
                                      <option value="TRANSPARENT CLING">TRANSPARENT CLING</option>
                                      <option value="Vinyl Gloss">Vinyl Gloss</option>
                                      <option value="Vinyl Matte">Vinyl Matte</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="single-review">
                                  <label>Number of Sides</label>
                                  <div class="row">
                                      <div class="col-md-2">
                                          <label><input class="radio" name="no_of_sides" value="1" type="radio" checked=""> 1 Sided ( inches)</label>
                                      </div>
                                       <div class="col-md-10">
                                          <label><input class="radio" name="no_of_sides" value="2" type="radio"> Flat Size ( 2 Sided)</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="single-review">
                                  <label>Folding</label>
                                  <select name="folding">
                                      <option value="No Fold">No Fold </option>
                                      <option value="Half Fold">Half Fold </option>
                                      <option value="3 Pannel Z Fold">3 Pannel Z Fold </option>
                                      <option value="3 Pannel Roll Fold">3 Pannel Roll Fold </option>
                                      <option value="Double Parallel Fold">Double Parallel Fold </option>
                                      <option value="Gate Fold">Gate Fold</option>
                                      <option value="Double Gate Fold">Double Gate Fold</option>
                                      <option value="Four Pannel Accordian Fold">Four Pannel Accordian Fold</option>
                                      <option value="8 Pg Fold">8 Pg Fold </option>
                                      <option value="12 Pg Fold">12 Pg Fold </option>
                                      <option value="Other">Other </option>
                                 </select>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner5">
                      <div class="expand-blog">
                          <div class="universal-small-dark-title">
                              <span>Finishing:</span>
                          </div>
                          <!-- <div class="order-btn">
                               <button id="expand-form-btn" type="button"><i class="las la-plus"></i><i class="las la-minus"></i> Expand</button>
                          </div> -->
                      </div>
                      <div class="expand-blog-inner" id="expand-form" style="display: none;">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Die-cutting</label>
                                      <input type="text" name="contact-name">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Rounded Corner </label>
                                      <select>
                                          <option value=""> Please select ...</option>
                                          <option value="1 Corner"> 1 Corner</option>
                                          <option value="2 Corners"> 2 Corners</option>
                                          <option value="3 Corners"> 3 Corners</option>
                                          <option value="4 Corners">4 Corners</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Collate </label>
                                      <input type="text">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Drilling</label>
                                      <select>
                                          <option value="">Please select ...</option>
                                          <option value="1 Hole">1 Hole1 Hole</option>
                                          <option value="2 Holes">1 Holes2 Holes</option>
                                          <option value="3 Holes">1 Holes3 Holes</option>
                                          <option value="Automotive">AutomotiveAutomotive</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Bundling </label>
                                      <select>
                                          <option value="">Please select ...</option>
                                          <option value="Single Band - 25s">Single Band - 25s</option>
                                          <option value="Single Band - 50s">Single Band - 50s</option>
                                          <option value="Single Band - 100s">Single Band - 100s</option>
                                          <option value="Double Band - 25s">Double band - 25s</option>
                                          <option value="Double Band - 50s">Double band - 50s</option>
                                          <option value="Double Band - 100s">Double band - 100s</option>
                                          <option value="Shrink Wrap - 25s">Shrink Wrap - 25s</option>
                                          <option value="Shrink Wrap - 50s">Shrink Wrap - 50s</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Numbering</label>
                                        <div class="row">
                                          <div class="col-md-2">
                                              <label><input class="radio" name="numbering" value="numberingNO" type="radio" checked=""> No</label>
                                          </div>
                                          <div class="col-md-10">
                                              <label><input class="radio" name="numbering" value="numberingYES" type="radio"> Yes</label>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Scoring </label>
                                      <select>
                                          <option value="">Please select ...</option>
                                          <option value="1 Score">1 Score</option>
                                          <option value="2 Scores">2 Scores</option>
                                          <option value="3 Scores">3 Scores</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Perforation</label>
                                      <select>
                                          <option value="">Please select ...</option>
                                          <option value="1 Perf">1 Perf</option>
                                          <option value="2 Perfs">2 Perfs</option>
                                          <option value="3 Perfs">3 Perfs</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Special</label>
                                      <select>
                                          <option value="">Please select ...</option>
                                          <option value="Emboss">Emboss</option>
                                          <option value="Foil">Foil</option>
                                          <option value="Deboss">Deboss</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="single-review">
                                      <label>Other</label>
                                     <input type="text">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner6">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="single-review">
                                  <label>How many versions would you like? <span class="text-danger">*</span></label>
                                  <select name="total_versions">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                  </select>
                                  <span>How many versions would you like?Number of different artwork files to be submitted. For example, if you have 2 different postcards to be ordered, then select “2”</span>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="single-review" id="upload-option-hide">
                                  <label>Shipping Method</label>
                                  <select name="shipping_methods">
                                      <option value="Pick up at COOP">Pick Up / Shipped to My Address</option>
                                      <option value="Ship for me">Ship for me</option>
                                  </select>
                                  <span>Additional Notes Please provide any additional information about your quote request (ie. saddle stitched, coil, perfect bound).</span>
                              </div>
                              <div class="single-review" id="upload-option-open" style="display: none;">
                                  <label>Upload your quote submission</label>
                                  <input type="file">
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="single-review">
                                  <textarea type="text" name="notes"></textarea>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="estimate-inner7">
                      <div class="single-review">
                          <div class="order-btn">
                              <button type="submit">Submit Quote Request</button>
                          </div>
                          <span>Please note that printing.coop Free Local Delivery does not apply for custom orders.printing.coop is no longer FSC certified anymore and cannot provide FSC certified services</span>
                      </div>
                  </div>
              </div>
            </form>
            <?php
            }?>
         </div>
    </div>
</div>
