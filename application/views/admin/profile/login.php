<!DOCTYPE html>
<html>
    <head>
       <title><?= $module_heading.' | '.SITE_DISPNAME; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="<?php echo (isset($meta_description))?$meta_description:ADMIN_META_DESCRIPTION; ?>" name="description" />
        <meta content="<?php echo (isset($meta_author))?$meta_author:ADMIN_META_AUTHOR; ?>" name="author" />
        <meta content="<?php echo (isset($meta_keywords))?$meta_keywords:ADMIN_META_KEYWORDS; ?>" name="keywords" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url()?>backend-assets/assets/images/favicon.ico">
        <!-- App title -->
        <title>PopIn Admin Login</title>

        <!-- App css -->
        <link href="<?php echo base_url('theme/admin/assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/admin/assets/css/core.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/admin/assets/css/components.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/admin/assets/css/icons.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/admin/assets/css/pages.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/admin/assets/css/menu.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('theme/admin/assets/css/responsive.css')?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url('theme/admin/assets/js/modernizr.min.js')?>"></script>

    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">
						<?php if($message_notification = $this->session->flashdata('message_notification')) { ?>
									<!-- Message Notification Start -->
									<div id="message_notification">
									<div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
										<button class="close" data-dismiss="alert" type="button">×</button>
										<strong>
											<?= $this->session->flashdata('message_notification'); ?> 
										</strong>
									</div>
									</div>
									<!-- Message Notification End -->
						<?php } ?>
                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <h2 class="text-uppercase">
                                        <a href="index.html" class="text-success">
                                            <span><?= $module_heading; ?></span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="<?= base_url(ADMIN_DIR.'/login/login'); ?>" method="post" name="admin-login-form" id="admin-login-form">

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="text" required="" placeholder="Username" id="adminUserName" name="adminUserName">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="password" required="" placeholder="Password" name="adminPassword" id="adminPassword">
                                            </div>
                                        </div>

                                       

                                       
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login" id="login">Log In</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->


                            
                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url('theme/admin/assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('theme/admin/assets/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('theme/admin/assets/js/detect.js')?>"></script>
        <script src="<?php echo base_url('theme/admin/assets/js/fastclick.js')?>"></script>
        <script src="<?php echo base_url('theme/admin/assets/js/jquery.blockUI.js')?>"></script>
        <script src="<?php echo base_url('theme/admin/assets/js/waves.js')?>"></script>
        <script src="<?php echo base_url('theme/admin/assets/js/jquery.slimscroll.js')?>"></script>
        <script src="<?php echo base_url('theme/admin/assets/js/jquery.scrollTo.min.js')?>"></script>

        <!-- App js -->
        <script src="<?php echo base_url('theme/admin/assets/js/jquery.core.js')?>"></script>
        <script src="<?php echo base_url('theme/admin/assets/js/jquery.app.js')?>"></script>

    </body>
</html>
