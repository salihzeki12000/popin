<?php
    $adminProfileInfo = $this->adminProfileInfo;
    $CI =& get_instance();
    $CI->load->model(ADMIN_DIR . '/adminUsers', 'user');
    
    $unverifiedUsers = $CI->user->getUnverifiedUsers();
    //print_array($unverifiedUsers);
?>
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
        <title><?= $module_heading . ' | ' . SITE_DISPNAME; ?></title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?= base_url('theme/admin/plugins/morris/morris.css'); ?>">
        
        <!-- Summernote css -->
        <link href="<?= base_url('theme/admin/plugins/summernote/summernote.css'); ?>" rel="stylesheet" />

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
        <!-- Sweet Alert -->
        <link href="<?= base_url('theme/admin/plugins/bootstrap-sweetalert/sweet-alert.css'); ?>" rel="stylesheet" type="text/css">

        <link href="<?= base_url('theme/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
        
<!--        <link href="<?= base_url('theme/front/assests/css/chosen.css'); ?>" rel="stylesheet">-->
        <link href="<?= base_url('theme/admin/plugins/select2/css/select2.min.css'); ?>" rel="stylesheet">

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
        
<!--        <script src="<?= base_url('theme/front/assests/js/chosen.js'); ?>"></script>-->
        <script src="<?= base_url('theme/admin/plugins/select2/js/select2.min.js'); ?>"></script>

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
            $(document).ready(function (e) {
                jQuery.validator.addMethod("fileSize", function (val, element) {
                    if (typeof element.files[0] === "undefined")
                    {
                        return true;
                    } else
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

                $('.history-back').click(function () {
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

                        <!-- Navbar-left -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>
                        <!-- Right(Notification) -->
                        <ul class="nav navbar-nav navbar-right">
<!--                            <li>
                                <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <span class="badge up bg-success">4</span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                                    <li>
                                        <h5>Notifications</h5>
                                    </li>
                                    <li>
                                        <a href="#" class="user-list-item">
                                            <div class="icon bg-info">
                                                <i class="mdi mdi-account"></i>
                                            </div>
                                            <div class="user-desc">
                                                <span class="name">New Signup</span>
                                                <span class="time">5 hours ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-list-item">
                                            <div class="icon bg-danger">
                                                <i class="mdi mdi-comment"></i>
                                            </div>
                                            <div class="user-desc">
                                                <span class="name">New Message received</span>
                                                <span class="time">1 day ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-list-item">
                                            <div class="icon bg-warning">
                                                <i class="mdi mdi-settings"></i>
                                            </div>
                                            <div class="user-desc">
                                                <span class="name">Settings</span>
                                                <span class="time">1 day ago</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
                            <li>
                                <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                                    <i class="mdi mdi-email"></i>
                                    <?php if(count($unverifiedUsers)){?><span class="badge up bg-danger"><?= count($unverifiedUsers); ?></span><?php }?>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                                    <li>
                                        <h5>Messages</h5>
                                    </li>
                                    <?php 
                                    foreach($unverifiedUsers as $userProfileInfo):
                                        $avatar = ($userProfileInfo->avatar != '' && file_exists('uploads/user/thumb/' . $userProfileInfo->avatar)) ? $userProfileInfo->avatar : 'user_pic-225x225.png';
                                    ?>
                                    <li>
                                        <a href="<?= site_url('admin/users/edit/' . $userProfileInfo->id); ?>" class="user-list-item">
                                            <div class="avatar">
                                                <img src="<?= base_url('uploads/user/thumb/' . $avatar); ?>" alt="<?= $userProfileInfo->firstName; ?>">
                                            </div>
                                            <div class="user-desc">
                                                <span class="name"><?= $userProfileInfo->firstName . '&nbsp;' . $userProfileInfo->lastName; ?></span>
                                                <span class="desc">Verify documents</span>
<!--                                                <span class="time">2 hours ago</span>-->
                                            </div>
                                        </a>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                            <li class="dropdown user-box">
                                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                                    <img src="<?= base_url('uploads/admin/' . $adminProfileInfo->avatar); ?>" alt="<?= $adminProfileInfo->name; ?>" title="<?= $adminProfileInfo->name; ?>" class="img-circle user-img">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li>
                                        <h5>Hi, <?= $adminProfileInfo->name; ?></h5>
                                    </li>
                                    <li><a href="<?= base_url(ADMIN_DIR . '/profile'); ?>"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <li><a href="<?= base_url(ADMIN_DIR . '/settings'); ?>"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                    <li><a href="<?= base_url(ADMIN_DIR . '/logout'); ?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul> <!-- end navbar-right -->

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->