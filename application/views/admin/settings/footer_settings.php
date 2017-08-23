<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <?php if ($message_notification = $this->session->flashdata('message_notification')) { ?>
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
                        <h4 class="page-title"><?= $module_heading; ?></h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">

                <div class="card-box">

                    <?php $all_footer_sections = unserialize(FOOTER_SECTION); ?>

                    <?php
                    foreach ($all_footer_sections as $k => $v) {
                        $CI = & get_instance();
                        $CI->load->model(ADMIN_DIR . '/AdminSettings', 'settings');
                        $pages = $CI->settings->getAllFooterPages($k);
                        //print_array($pages);
                        $footer_pages = explode(',', $pages->page);
                        ?>
                        <form class="form-horizontal" role="form"  name="general_settings" id="general_settings" method="post" action="<?= base_url(ADMIN_DIR . '/settings/footer_settings/'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="pages_<?= $k; ?>" class="col-sm-3 control-label">Page List for <?= $v; ?></label>
                                <div class="col-sm-9">
                                    <?php foreach ($allStaticPages as $page) { ?>
                                        <div class="checkbox checkbox-primary">
                                            <input id="<?= $page->id; ?>" name="pages[]" type="checkbox" <?= in_array($page->id, $footer_pages) ? 'checked' : ''; ?> value="<?= $page->id; ?>">
                                            <label>
                                            <?= $page->pageName; ?>
                                            </label>
                                        </div>
                                    <?php } ?> 
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="hidden" name="section"  value="<?= $k; ?>">
                                    <button type="submit" class="btn btn-info waves-effect waves-light" id="submit" name="submit">Update</button>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
