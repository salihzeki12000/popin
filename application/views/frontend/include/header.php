<?php 
$CI =& get_instance();
$CI->load->model(FRONT_DIR.'/FrontCommon','common');
$siteDetails = $CI->common->getSiteDetails();

if(isset($module_heading) && $module_heading!='')
{
	$siteTitle = $module_heading.' | '.SITE_DISPNAME;
}
else if($siteDetails->siteTitle!='')
{
	$siteTitle = $siteDetails->siteTitle;
}
else{
	$siteTitle = SITE_DISPNAME;
}


?>

<!DOCTYPE html>
<html>
<head>
<title><?= $siteTitle; ?></title>
<link rel="shortcut icon" href="<?= ($siteDetails->favicon!='')?base_url('uploads/site/'.$siteDetails->favicon):base_url('uploads/site/default_favicon.ico'); ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<link href="<?php echo base_url('theme/front/assests/css/nav.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/bootstrap.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/main.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('theme/front/assests/css/chosen.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('theme/front/assests/js/html5.js')?>"></script>
<link href="<?php echo base_url('theme/front/assests/css/media.css')?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('theme/front/assests/js/jQuery.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/nav.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/chosen.js'); ?>"  type="text/javascript"></script>

<!--Initialize Jquery Validation with Additional Methods-->
<script src="<?= base_url('theme/admin/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('theme/admin/assets/js/additional-methods.js'); ?>"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
.error {
	color:red !important;
}
</style>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip('show');
    });
    
</script>
</head>
<body>
<header class="head">
    <div class="header_top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="media">
                        <div class="media-left">
                            <a href="<?php echo base_url(); ?>">
                                <img class="media-object" src="<?= base_url('uploads/site/thumb/'.$siteDetails->logo); ?>" alt="logo" />
                            </a>
                        </div>
                        <?php if(!isset($no_nav) || $no_nav != 1): ?>
                        <div class="media-body">
                           <div class="col-lg-8">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                       <button class="btn btn-default" type="button"><img src="<?php echo base_url('theme/front/assests/img/head-serach-icon.png')?>" alt="" /></button>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search" />
                                </div><!-- /input-group -->
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?php if($this->session->userdata('user_id')!='') { 
                        $avatar = ($userProfileInfo->avatar!='' && file_exists('uploads/user/thumb/' . $userProfileInfo->avatar))?$userProfileInfo->avatar:'user_pic-225x225.png';
                    ?>
                   <div class="pro_img">
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" type="button" data-toggle="dropdown"><img height="32" width="32" src="<?= base_url('uploads/user/thumb/'.$avatar); ?>" alt="<?= $userProfileInfo->firstName.'&nbsp;'.$userProfileInfo->lastName; ?>"></a>
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
                        <?php if($this->session->userdata('session_login_id')!='') {}else { ?>
                        <li><a href="javascript:void(0);" id="openBecomePartnerBox" title="Become a Partner">Become a Partner</a></li>
                       <?php } ?>
                        <li class="dropdown">
                            <?php $this->load->view('frontend/include/partner-tab'); ?>
                        </li>
                        <li class="dropdown trips">
                            <?php $this->load->view('frontend/include/trips-window'); ?>
                        </li>
                        <li class="dropdown trips message">
                            <?php $this->load->view('frontend/include/message-window'); ?>
                        </li>
                        <li><a href="#">Help</a></li>
                        <?php if($this->session->userdata('session_login_id')!='') { 
                        } else { ?>
                                <li><a href="javascript:void(0);" class="openSignInBox">Login</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<?php if(!isset($no_nav) || $no_nav != 1): ?>
<nav class="navigation">
    <div class="container">
        <div class="row">
            <div id='cssmenu'>
                <ul>
                   <li class='active'><a href='<?php echo base_url()?>Home/BecomeAPartner'>Dashboard</a></li>
                   <li><a href='#'>Products</a>
                      <!--<ul>
                         <li class=''><a href='#'>Product 1</a>
                            <ul>
                               <li><a href='#'>Sub Product</a></li>
                               <li><a href='#'>Sub Product</a></li>
                            </ul>
                         </li>
                         <li class=''><a href='#'>Product 2</a>
                            <ul>
                               <li><a href='#'>Sub Product</a></li>
                               <li><a href='#'>Sub Product</a></li>
                            </ul>
                         </li>
                      </ul>-->
                   </li>
                   <li><a href='<?php echo base_url()?>Home/Inbox'>Inbox</a></li>
                   <li><a href='<?php echo base_url()?>Listing/listing'>Listings</a></li>
                   <li><a href='<?php echo base_url()?>Home/Rental'>Rentals</a></li>
                   <li><a href='<?php echo base_url()?>Profile'>Profile</a></li>
                   <li><a href='<?php echo base_url()?>Account/Account'>Account</a></li>
                   <li><a href='#'>Credit</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<?php endif;?>