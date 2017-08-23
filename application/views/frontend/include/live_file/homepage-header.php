<!DOCTYPE html>
<html>
<head>
<title>Popln</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<link href="<?php echo base_url('theme/front/assests/css/jcarousel.responsive.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/owl.carousel.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/owl.theme.default.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/bootstrap.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/daterangepicker.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/main.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('theme/front/assests/js/html5.js')?>"></script>
<link href="<?php echo base_url('theme/front/assests/css/media.css')?>" rel="stylesheet" type="text/css" />
</head>
<body>
<header class="head home-head">
    <div class="header_top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="media">
                        <div class="media-left">
                            <a href="<?php echo base_url()?>Home/index">
                                <img class="media-object" src="<?php echo base_url('theme/front/assests/img/logo.png')?>" alt="logo" />
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="anywhere-main clearfix">
                                <ul class="clearfix">
                                    <li class="anywhere">
                                        <input class="icon1" type="text" placeholder="Anywhere" />
                                    </li>
                                    <li class="anytime">
                                        <input class="icon1 icon2" type="text" id="demo-range" placeholder="Anytime" />
                                    </li>
                                    <li class="guest">
                                        <button id="guest_button">
                                            <span><img src="<?php echo base_url('theme/front/assests/img/head-guest-icon.png');?>" alt="" /></span>
                                            <span>1 guest</span>
                                        </button>
                                        <div id="guest_open" class="bz_guest_box clearfix" style="display: none;">
                                            <div class="feild">
                                                <label>Adults</label>
                                                <span><input value="" class="qtyminus" field="adult" type="button"> <input name="adult" value="0" class="qty" type="text"> <input value="" class="qtyplus" field="adult" type="button"></span>
                                            </div>
                                            <div class="feild">
                                                <label>Children<br/> <span class="age">Ages 2 - 12</span></label>
                                                <span><input value="" class="qtyminus" field="children" type="button"> <input name="children" value="0" class="qty" type="text"> <input value="" class="qtyplus" field="children" type="button"></span>
                                            </div>
                                            <div class="feild">
                                                <label>Infants<br/> <span class="age">Under 2</span></label>
                                                <span><input value="" class="qtyminus" field="infant" type="button"> <input name="infant" value="0" class="qty" type="text"> <input value="" class="qtyplus" field="infant" type="button"></span>
                                            </div>
                                            <div class="pull-left"><a href="#">Cancel</a></div>
                                            <div class="pull-right"><a href="#">Apply</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pro_img">
                        <img src="<?php echo base_url('theme/front/assests/img/profile-pic.png');?>" alt="" />
                    </div>
                    <ul class="nav navbar-nav navbar-right navi">
                       <?php /*?> <li><a href="<?php echo base_url()?>Home/BecomeAPartner">Become a Partner</a></li><?php */?>
					    <li><a href="#">Become a Partner</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rentals <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Messages</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="head-tab">
            <div class="container-fluid">
                <div class="col-xs-12">
                    <ul>
                        <li><a class="active" href="<?php echo base_url()?>Home/index">Industry</a></li>
                        <li><a href="<?php echo base_url()?>Home/spaces_view">Spaces</a></li>
                        <li><a href="<?php echo base_url()?>Home/workshop_view">Workshops</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>