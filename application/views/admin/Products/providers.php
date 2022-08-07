<?php
$tabname = 'provider-view';
?>
<link rel="stylesheet" type="text/css" href="/assets/css/provider.css"/>
<div class="content-wrapper dd">
    <?php $this->load->view('admin/shared/tabscript', ['tabname' => $tabname, 'position' => 'top']); ?>
    <div id="<?= $tabname?>" style="display:none">
        <ul>
            <?php
                $tabs = ['Providers'];
                $tabs[] = 'Products';
                $tabs[] = 'Options';
                $_SESSION["$tabname-tab"] = 1;
            ?>
            <?php
            foreach ($tabs as $i => $tab) { ?>
                <li <?= $_SESSION["$tabname-tab"] == $i ? 'class="k-state-active"' : ''?>><?= $tab?></li>
            <?php } ?>
        </ul>

        <div tab-index="0">
            <?php $this->load->view('admin/Products/provider_list'); ?>
        </div>
        <div tab-index="1">
            <?php $this->load->view('admin/Products/provider_products'); ?>
        </div>
        <div tab-index="2">
            <?php $this->load->view('admin/Products/provider_options'); ?>
        </div>
    </div>
</div>

