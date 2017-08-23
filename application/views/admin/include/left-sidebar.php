<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Navigation</li>
                <li class="has_sub">
                    <a href="<?= base_url('admin'); ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                </li>
                <li class="has_sub">
                    <a href="<?= base_url('admin/settings'); ?>" class="waves-effect"><i class="fa fa-gears"></i> <span> Settings </span> </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-invert-colors"></i> <span> Front </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url(ADMIN_DIR . '/banner/lists'); ?>"><i class="fa fa-image"></i>Home Banner</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/pages/lists'); ?>"><i class="fa fa-clone"></i>CMS Page</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/faq_category/lists'); ?>"><i class="fa fa-info"></i>FAQ Category</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/faq/lists'); ?>"><i class="fa fa-question"></i>FAQ</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/contact_request/lists'); ?>"><i class="fa fa-envelope"></i>Contact Req.</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/email_template/lists'); ?>"><i class="fa fa-envelope-o"></i>Email Templates</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/settings/footer'); ?>"><i class="fa fa-gear"></i>Footer Settings</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/settings/industry_list'); ?>"><i class="fa fa-industry" aria-hidden="true"></i>Manage Industry</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/settings/establishment_list'); ?>"><i class="fa fa-info"></i>Establishment Type</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/settings/amenities_list'); ?>"><i class="fa fa-bookmark-o" aria-hidden="true"></i>Manage Amenities</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/Settings/spaceList'); ?>"><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i>Space Type</a></li>
                        <li><a href="<?= base_url(ADMIN_DIR . '/settings/facilities'); ?>"><i class="fa fa-magnet" aria-hidden="true"></i>Manage Facilities</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('admin/users'); ?>" class="waves-effect"><i class="fa fa-users"></i><span> Manage Users </span></a>
                </li>
                <li>
                    <a href="<?= base_url(ADMIN_DIR . '/PosteList/messageListing'); ?>" class="waves-effect"><i class="fa fa-envelope-o"></i><span> Manage user messages </span></a>
                </li>
                <li>
                    <a href="<?= base_url(ADMIN_DIR . '/PosteList/index'); ?>" class="waves-effect"><i class="fa fa-list-alt"></i><span> Manage Posted listings </span></a>
                </li>                
                <li>
                    <a href="<?= base_url(ADMIN_DIR . '/manage_subscriptions'); ?>" class="waves-effect"><i class="fa fa-list"></i><span>  Manage Subscriptions</span></a>
                </li>
                <li>
                    <a href="<?= base_url(ADMIN_DIR . '/transactions'); ?>" class="waves-effect"><i class="fa fa-file-o"></i><span>  Transactional Reports </span></a>
                </li>
                <li>
                    <a href="<?= base_url(ADMIN_DIR . '/manage_subscription_plans'); ?>" class="waves-effect"><i class="mdi mdi-calendar"></i><span>  Manage Subscription Plans </span></a>
                </li>
                <li>
                    <a href="<?= base_url(ADMIN_DIR . '/settings/promo_codes'); ?>" class="waves-effect"><i class="mdi mdi-calendar"></i><span>  Manage Promo Codes </span></a>
                </li>
<!--                <li>
                    <a href="#" class="waves-effect"><i class="mdi mdi-calendar"></i><span>  Referral bonus and rules </span></a>
                </li>-->
<!--                <li>
                    <a href="<?= base_url(ADMIN_DIR . '/newsletter_subscriber/lists'); ?>" class="waves-effect" title="Newsletter Subscriber"><i class="fa fa-envelope"></i><span> Newsletter Subscriptions </span></a>
                </li>-->
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>



    </div>
    <!-- Sidebar -left -->

</div>
