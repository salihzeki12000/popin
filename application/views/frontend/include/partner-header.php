<!DOCTYPE html>
<html>
<head>
<title>Popln</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<link href="<?php echo base_url('theme/front/assests/css/nav.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/bootstrap.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/main.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('theme/front/assests/js/html5.js')?>"></script>
<link href="<?php echo base_url('theme/front/assests/css/media.css')?>" rel="stylesheet" type="text/css" />
</head>
<body>
<header class="head">
    <div class="header_top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="media">
                        <div class="media-left">
                          <a href="<?php echo base_url()?>Home">
                                <img class="media-object" src="<?php echo base_url('theme/front/assests/img/logo.png')?>" alt="logo" />
                            </a>
                        </div>
                        <div class="media-body">
                           <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                       <button class="btn btn-default" type="button"><img src="<?php echo base_url()?>assests/img/head-serach-icon.png" alt="" /></button>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search" />
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pro_img">
                        <img src="<?php echo base_url('theme/front/assests/img/profile-pic.png')?>" alt="" />
                    </div>
                    <ul class="nav navbar-nav navbar-right navi">
                        <li><a href="<?php echo base_url()?>Home/BecomeAPartner">Become a Partner</a></li>
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
    </div>
</header>
