<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $favicon_url = $BASE_URL . 'assets/images/favicon.png';
    $favicon = '';
    if ($language_name == 'French') {
        $favicon = $configrations['french_favicon'];
    } else {
        $favicon = $configrations['favicon'];
    }
    if (!empty($favicon)) {
        $favicon_url = getLogoImages($favicon);
    }

    if ($website_store_id == 3 || $website_store_id == 5) { #Show only PrintCoop & Franch
        $meta_description_content = '';
        $meta_keywords_content = '';
        $page_title = $MainStoreData['name'] . '-' . $page_title;
    } else {
        if (!empty($meta_page_title)) {
            $page_title = $meta_page_title;
        } else {
            $page_title = $MainStoreData['name'] . '-' . $page_title;
        }
    }
    ?>
    <title><?= $page_title ?></title>

    <?php if ($meta_description_content) { ?>
        <meta name="description" content="<?= $meta_description_content ?>">
    <?php } ?>
    <?php if ($meta_keywords_content) { ?>
        <meta name="keywords" content="<?= $meta_keywords_content ?>">
    <?php } ?>
    <?= $before_head?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= $favicon_url ?>">
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/bootstrap.css">
    <?php if ($website_store_id == 1) { ?>
        <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/style.css">
    <?php } else if ($website_store_id == 3) { ?>
        <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/clickimprimerie.style.css">
    <?php } else if ($website_store_id == 5) { ?>
        <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/ecoink.style.css">
    <?php } ?>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/customslider.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/provider.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>fancy-product-designer-jquery/source/css/FancyProductDesigner-all.min.css"/> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$BASE_URL?>assets/administration/kendo/styles/2022.2.802/kendo.default-main.min.css">

    <!-- Cloudflare Web Analytics -->
    <script defer src='https://static.cloudflareinsights.com/beacon.min.js'
        data-cf-beacon='{"token": "ec9dc85b92c741879c76713f0ada873b"}'></script><!-- End Cloudflare Web Analytics -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-183856793-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-183856793-1');
    </script>

    <?php if ($website_store_id == 1) { ?>
        <?php if ($language_name == 'French') { ?>
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-L7V7YLFS15"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());

                gtag('config', 'G-L7V7YLFS15');
            </script>
        <?php } else { ?>
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-S5JX3QGBRH"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());

                gtag('config', 'G-S5JX3QGBRH');
            </script>
        <?php } ?>
    <?php } else if ($website_store_id == 3) { ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-X71XTPM7CL"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-X71XTPM7CL');
        </script>
    <?php } else if ($website_store_id == 5) { ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-QHV7YWZEQ5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-QHV7YWZEQ5');
        </script>
    <?php } ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/kendo/scripts/2022.2.802/kendo.all.min.js"></script>
</head>

<body>
    <div class="announcements-bar">
        <div class="container">
            <span>
                <?= ($language_name == 'French') ?
                $configrations['announcement_french'] ?? 'Proudly involved in the community! 10% discount for Community organizations, co-operatives, not-for-profit organizations and print reselling companies will benefit.'
                :
                $configrations['announcement'] ?? 'Proudly involved in the community! 10% discount for Community organizations, co-operatives, not-for-profit organizations and print reselling companies will benefit.' ?>
            </span>
            <i class="la la-times"></i>
        </div>
    </div>

    <?php $this->load->view('elements/header-top-bar') ?>
    <?php $this->load->view('elements/header-mid-bar') ?>
    <?php $this->load->view('elements/header-menu-bar'); ?>

    <div class="addtocart-message">
    </div>

    <!-- add a "active" class to show -->
    <div class="addwishlist-message">
        <span><i class="la la-heart-o"></i> <?= ($language_name == 'French') ? '"Produit" a été ajouté à votre liste de souhaits.' : '"Product" has been added to your wishlist.' ?></span>
    </div>
    <div id="loader-img">
        <div id="loader-img-inner">
            <?php if ($website_store_id == 1) { ?>
                <img src="<?= $BASE_URL ?>assets/images/loder.gif" width="100">
            <?php } else if ($website_store_id == 3) { ?>
                <img src="<?= $BASE_URL ?>assets/images/loader-pink.gif" width="100">
            <?php } else if ($website_store_id == 5) { ?>
                <img src="<?= $BASE_URL ?>assets/images/loader-green.gif" width="100">
            <?php } ?>
        </div>
    </div>