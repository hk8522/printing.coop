    <div class="uploaded-file-single" id="teb-<?= $return_arr['skey'] ?>">
        <div class="uploaded-file-single-inner">
            <div class="uploaded-file-img" style="background-image: url(<?= $return_arr['src'] ?>)"></div>
            <div class="uploaded-file-info">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="uploaded-file-name"><span><?= $return_arr['name'] ?></span></div>
                    </div>
                    <div class="col-md-5">
                        <div class="upload-action-btn">
                            <button type="button" onclick="update_cumment('<?= $return_arr['skey']?>','<?= $return_arr['product_id']?>','<?= $return_arr['product_id_key']?>')" id="smc-<?= $return_arr['skey'] ?>">Update Note</button>
                            <button type="button" title="Delete" onclick="delete_image('<?= $return_arr['skey']?>','<?= $return_arr['product_id']?>','<?= $return_arr['product_id_key']?>')"  id="smd-<?= $return_arr['skey'] ?>"><i class="fas fa-trash"></i>
                            </button>
                            <input type="hidden" value="<?= $return_arr['location'] ?>" id="location-<?= $return_arr['skey'] ?>">
                        </div>
                    </div>
                </div>
                <div class="upload-field">
                    <textarea id="cumment-<?= $return_arr['skey']?>"><?= $return_arr['cumment'] ?></textarea>
                </div>
            </div>
        </div>
    </div>
