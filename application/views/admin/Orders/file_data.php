    <div class="uploaded-file-single" id="teb-<?php echo $return_arr['skey']?>">
        <div class="uploaded-file-single-inner">
            <div class="uploaded-file-img" style="background-image: url(<?php echo $return_arr['src']?>)"></div>
            <div class="uploaded-file-info">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="uploaded-file-name"><span><?php echo $return_arr['name']?></span></div>
                    </div>
                    <div class="col-md-5">
                        <div class="upload-action-btn">
                            <button type="button" onclick="update_cumment('<?php echo $return_arr['skey']?>','<?php echo $return_arr['product_id']?>','<?php echo $return_arr['product_id_key']?>')" id="smc-<?php echo $return_arr['skey']?>">Update Note</button>
                            <button type="button" title="Delete" onclick="delete_image('<?php echo $return_arr['skey']?>','<?php echo $return_arr['product_id']?>','<?php echo $return_arr['product_id_key']?>')"  id="smd-<?php echo $return_arr['skey']?>"><i class="fas fa-trash"></i>
							</button>
							<input type="hidden" value="<?php echo $return_arr['location'];?>" id="location-<?php echo $return_arr['skey']?>">
                        </div>
                    </div>
                </div>
                <div class="upload-field">
                    <textarea id="cumment-<?php echo $return_arr['skey']?>"><?php echo $return_arr['cumment']?></textarea>
                </div>
            </div>
        </div>
    </div>