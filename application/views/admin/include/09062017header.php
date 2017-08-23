<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url('theme/admin/assets/images/favicon.ico'); ?>">
        <!-- App title -->
        <title><?= $module_heading.' | '.SITE_DISPNAME; ?></title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="<?= base_url('theme/admin/plugins/morris/morris.css'); ?>">

        <!-- App css -->
        <link href="<?= base_url('theme/admin/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('theme/admin/assets/css/core.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('theme/admin/assets/css/components.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('theme/admin/assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('theme/admin/assets/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('theme/admin/assets/css/menu.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('theme/admin/assets/css/custom.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('theme/admin/assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?= base_url('theme/admin/plugins/switchery/switchery.min.css'); ?>">
        <link href="<?= base_url('theme/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">


       <!--Initialize Jquery-->
       <script src="<?= base_url('theme/admin/assets/js/jquery.min.js'); ?>"></script>

       <!--Initialize Bootstrap-->
       <script src="<?= base_url('theme/admin/assets/js/bootstrap.min.js'); ?>"></script>

       <!--Initialize Jquery Validation with Additional Methods-->
       <script src="<?= base_url('theme/admin/assets/js/jquery.validate.js'); ?>"></script>
       <script src="<?= base_url('theme/admin/assets/js/additional-methods.js'); ?>"></script>

         <!-- BEGIN DATATABLE PLUGINS -->
        <link href="<?= base_url('theme/admin/plugins/datatables/datatables.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('theme/admin/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END DATATABLE PLUGINS -->

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?= base_url('theme/admin/assets/js/modernizr.min.js'); ?>"></script>

         <!--Wysiwig js-->
        <script src="<?= base_url('theme/admin/plugins/tinymce/tinymce.min.js'); ?>"></script>

        <style>
			.error {
				color: #f5707a;
			}
		</style>

        <script>
        $(document).ready(function(e) {
            jQuery.validator.addMethod("fileSize", function (val, element) {
		 if(typeof element.files[0]=== "undefined")
		 {
			 return true;
		 }
		 else
		 {
          	var size = element.files[0].size;
            console.log(size);
			if (size > 2048576)// checks the file more than 1 MB
			   {
					return false;
			   } else {
				   return true;
			   }
		 }

      }, "Maximum 2MB Image Size Allowed");

    $('.history-back').click(function(){
			window.history.back();
		});

	    });



        </script>

    </head>
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="<?= base_url(ADMIN_DIR); ?>" class="logo"><span><?= SITE_DISPNAME; ?></span><i class="mdi mdi-layers"></i></a>
                    <!-- Image logo -->
                    <!--<a href="index.html" class="logo">-->
                        <!--<span>-->
                            <!--<img src="assets/images/logo.png" alt="" height="30">-->
                        <!--</span>-->
                        <!--<i>-->
                            <!--<img src="assets/images/logo_sm.png" alt="" height="28">-->
                        <!--</i>-->
                    <!--</a>-->
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">


                        <!-- Right(Notification) -->
                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown user-box">
                                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                                    <img src="<?= base_url('uploads/admin/'.$adminProfileInfo->avatar); ?>" alt="<?= $adminProfileInfo->name; ?>" title="<?= $adminProfileInfo->name; ?>" class="img-circle user-img">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li>
                                        <h5>Hi, <?= $adminProfileInfo->name; ?></h5>
                                    </li>
                                    <li><a href="<?= base_url(ADMIN_DIR.'/profile'); ?>"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <li><a href="<?= base_url(ADMIN_DIR.'/settings'); ?>"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                    <li><a href="<?= base_url(ADMIN_DIR.'/logout'); ?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul> <!-- end navbar-right -->

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->
