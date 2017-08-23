<?php
$CI = & get_instance();
$CI->load->model(FRONT_DIR . '/FrontCommon', 'common');
$siteDetails = $CI->common->getSiteDetails();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Preview Listing | PopIn</title>
        <link rel="shortcut icon" href="<?= ($siteDetails->favicon != '') ? base_url('uploads/site/' . $siteDetails->favicon) : base_url('uploads/site/default_favicon.ico'); ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
        <link href="<?php echo base_url('theme/front/assests/')?>css/owl.carousel.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/')?>css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/')?>css/nav.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/')?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/')?>css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/')?>css/main.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('theme/front/assests/')?>js/html5.js"></script>
        <link href="<?php echo base_url('theme/front/assests/')?>css/media.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    </head>
    <body>