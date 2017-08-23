<?php
$CI = & get_instance();
$CI->load->model(FRONT_DIR . '/FrontCommon', 'common');
$siteDetails = $CI->common->getSiteDetails();
$filters = $this->session->userdata('filters');
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= (isset($module_heading))?$module_heading:(($siteDetails->siteTitle != '') ? $siteDetails->siteTitle : SITE_DISPNAME); ?></title>
        <link rel="shortcut icon" href="<?= ($siteDetails->favicon != '') ? base_url('uploads/site/' . $siteDetails->favicon) : base_url('uploads/site/default_favicon.ico'); ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />

        <meta name="description" content="<?= $siteDetails->metaDescription; ?>">
        <meta name="author" content="<?= $siteDetails->metaAuthor; ?>">
        <meta name="keywords" content="<?= $siteDetails->metaKeyWords; ?>">

        <link href="<?php echo base_url('theme/front/assests/css/fileuploader.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/css/fileuploader-theme-thumbnails.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/css/jcarousel.responsive.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/css/owl.carousel.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/css/owl.theme.default.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/css/bxslider.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/css/bootstrap.css') ?>" rel="stylesheet" type="text/css" />
        <!--Initialize Jquery-->
        <script src="<?php echo base_url('theme/front/assests/js/jQuery.js') ?>" type="text/javascript"></script>
        <?php if(isset($search_nav) && $search_nav == 1){ ?>
<!--        <link href="<?php echo base_url('theme/admin/plugins/timepicker/bootstrap-timepicker.min.css') ?>" rel="stylesheet">-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('theme/front/assests/js/jquery.blockUI.js') ?>" type="text/javascript"></script>
        <?php }else{?>
        <link href="<?php echo base_url('theme/front/assests/css/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />        
        <?php }?>
        <link href="<?php echo base_url('theme/front/assests/css/nav.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/front/assests/css/main.css') ?>" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url('theme/front/assests/css/media.css') ?>" rel="stylesheet" type="text/css" />
        
        <!--Initialize Bootstrap-->
        <script src="<?php echo base_url('theme/front/assests/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        
        <script src="<?php echo base_url('theme/front/assests/js/html5.js') ?>"></script>
        <!--Initialize Jquery Validation with Additional Methods-->
        <script src="<?= base_url('theme/admin/assets/js/jquery.validate.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/assets/js/additional-methods.js'); ?>"></script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDx2JMX91vY411oEI6jv4T34fpWeUdBRAI&libraries=places"></script>
    </head>
    <body>
        <header class="head home-head" <?php if(isset($search_nav) && $search_nav == 1){ ?>style="box-shadow: none;"<?php }?>>
            <div class="header_top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="media">
                                <div class="media-left">
                                    <a href="<?= base_url(); ?>">
                                        <img class="media-object" src="<?= base_url('uploads/site/thumb/' . $siteDetails->logo); ?>" height="64" width="64" alt="<?= $siteDetails->siteTitle; ?>" />
                                    </a>
                                </div>
                                <?php if(isset($search_nav) && $search_nav == 1): ?>
                                <div class="media-body">
                                    <div class="col-xs-12">
                                        <form class="space-search-form" name="space_search_form" method="post" action="<?= site_url('spaces'); ?>">
                                            <input type="text" id="search-box" class="form-control header-search" name="destination" placeholder="Search" />
                                            <input type="hidden" id="latitude" name="latitude" value="<?= isset($filters['latitude'])?$filters['latitude']:'';?>" />
                                            <input type="hidden" id="longitude" name="longitude" value="<?= isset($filters['longitude'])?$filters['longitude']:'';?>" />
                                        </form>
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="media-body">
                                    <div class="anywhere-main clearfix">
                                        <form class="space-search-form" name="space_search_form" method="post" action="<?= site_url('spaces'); ?>">
                                            <ul class="clearfix">
                                                <li class="anywhere">
                                                    <input class="icon1" type="text" id="destination" name="destination" value="<?= isset($filters['destination'])?$filters['destination']:'';?>" placeholder="Anywhere" />
                                                    <input type="hidden" id="latitude" name="latitude" value="<?= isset($filters['latitude'])?$filters['latitude']:'';?>" />
                                                    <input type="hidden" id="longitude" name="longitude" value="<?= isset($filters['longitude'])?$filters['longitude']:'';?>" />
                                                </li>
                                                <li class="anytime">
                                                    <?php 
                                                        $checkInRange = "";
                                                        if(isset($filters['checkIn']) && !empty($filters['checkIn']) && isset($filters['checkOut']) && !empty($filters['checkOut'])){
                                                            $checkInRange = date("M-d", strtotime($filters['checkIn'])) . ' - ' . date("M-d", strtotime($filters['checkOut']));
                                                        }
                                                    ?>
                                                    <input class="icon1 icon2" type="text" id="demo-range" placeholder="Anytime" value="<?= $checkInRange; ?>" />
                                                    <input type="hidden" id="checkIn" name="checkIn" value="<?= isset($filters['checkIn'])?$filters['checkIn']:'';?>" /><input type="hidden" id="checkOut" name="checkOut" value="<?= isset($filters['checkOut'])?$filters['checkOut']:'';?>" />
                                                </li>
                                                <li class="guest">
                                                    <button id="guest_button" type="button">
                                                        <span><img src="<?= base_url('theme/front/img/head-guest-icon.png'); ?>" alt="" /></span>
                                                        <span><?= isset($filters['professionals'])?$filters['professionals']:1;?> professionals</span>
                                                    </button>
                                                    <div id="guest_open" class="bz_guest_box clearfix" style="display: none;">
                                                        <div class="feild">
                                                            <label>Professionals</label>
                                                            <span><input value="" class="qtyminus" field="professionals" type="button"> <input name="professionals" value="<?= isset($filters['professionals'])?$filters['professionals']:1;?>" class="qty" type="text" readonly> <input value="" class="qtyplus" field="professionals" type="button"></span>
                                                        </div>
                                                        <div class="pull-left"><a href="#" id="guest-cancel">Cancel</a></div>
                                                        <div class="pull-right"><a href="#" id="guest-apply">Apply</a></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?php
                            if ($this->session->userdata('user_id') != '') {
                                $avatar = ($userProfileInfo->avatar != '' && file_exists('uploads/user/thumb/' . $userProfileInfo->avatar)) ? $userProfileInfo->avatar : 'user_pic-225x225.png';
                                ?>
                                <div class="pro_img">
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" type="button" data-toggle="dropdown"><img height="32" width="32" src="<?= base_url('uploads/user/thumb/' . $avatar); ?>" alt="<?= $userProfileInfo->firstName . '&nbsp;' . $userProfileInfo->lastName; ?>"></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= base_url('wishlists'); ?>">My Wish Lists</a></li>
                                            <li><a href="<?= base_url('user/profile'); ?>">Edit Profile</a></li>
                                            <li><a href="<?= base_url('account'); ?>">Account Settings</a></li>
                                            <li><a href="<?= base_url('user/logout'); ?>">Logout</a></li>
                                        </ul>
                                    </div> 
                                </div>
                                <?php } ?>
                            <ul class="nav navbar-nav navbar-right navi">
                                <?php if ($this->session->userdata('session_login_id') != '') { ?>
                                <li class="dropdown">
                                    <?php $this->load->view('frontend/include/partner-tab'); ?>
                                </li>
                                <li class="dropdown trips">
                                    <?php $this->load->view('frontend/include/trips-window'); ?>
                                </li>
                                <li class="dropdown trips message">
                                <?php $this->load->view('frontend/include/message-window'); ?>
                                </li>   
                                <?php } else {
                                    ?>
                                <li><a href="javascript:void(0);" id="openBecomePartnerBox" title="Become a Partner">Become a Partner</a></li>
                                <?php } ?>
                                
                                <li><a href="#">Business</a></li>
                                <li><a class="enquireNow" hef="#">Help</a></li>
                                <?php if ($this->session->userdata('session_login_id') != '') { ?>
                                <?php } else { ?>
                                    <li><a href="javascript:void(0);" class="openSignInBox">Login</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="overLayEnqiry" style="display: none;">
                        <div class="popupAnimWrapper enqiryAnimWrapper" style="margin-left: 0px; opacity: 1;">
                            <i class="closeAnimPopupEnq"><img src="<?= base_url('theme/front/img/back-close-icon.png'); ?>" alt="" /></i>
                            <h3>Popin Help</h3>
                            <div class="ask-search">
                                <input class="textbox" type="text" placeholder="Ask a question or search by keyword" />
                            </div>
                            <div class="suggested-topics">
                                <h6>Suggested topics</h6>
                                <div id='cssmenu'>
                                    <ul>
                                        <li><a href='#'><span>Home</span></a></li>
                                        <li><a href='#'><span>Products</span></a>
                                            <ul>
                                                <li><a href='#'>Widgets</a></li>
                                                <li><a href='#'>Menus</a></li>
                                                <li><a href='#'>Products</a></li>
                                            </ul>
                                        </li>
                                        <li><a href='#'><span>Company</span></a>
                                            <ul>
                                                <li><a href='#'>About</a></li>
                                                <li><a href='#'>Location</a></li>
                                            </ul>
                                        </li>
                                        <li><a href='#'><span>Contact</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="help-center claerfix">
                                <div class="pull-left">
                                    <a href="#">Help Center</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#">Give feedback</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!isset($search_nav)): ?>
                <div class="head-tab">
                    <div class="container-fluid">
                        <div class="col-xs-12">
                            <ul>
                                <li><a href="<?= site_url(); ?>">Industries</a></li>
                                <li><a href="<?= site_url('spaces'); ?>">Spaces</a></li>
                                <li><a href="<?= site_url('workshops'); ?>">Workshops</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </header>
        <?php if(isset($static_nav) && $static_nav == 1): ?>
        <nav class="navigation">
            <div class="container">
                <div class="row">
                    <div id='cssmenu'>
                        <ul>
                           <li><a href='<?= base_url('page/about-us'); ?>'>About Us</a></li>
                           <li><a href='<?= base_url('page/contact-us'); ?>'>Contact Us</a></li>
                           <li><a href='<?= base_url('page/faq'); ?>'>FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <?php endif;?>
