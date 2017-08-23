<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <?php $message_notification = $this->session->flashdata('message_notification'); if ($message_notification) { ?>
                            <!-- Message Notification Start -->
                            <div id="message_notification">
                                <div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <strong>
                                        <?= $message_notification; ?> 
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
                <div class="col-sm-12">
                    <div class="card-box">
                        <form class="form-horizontal" role="form" method="post" action="<?= base_url(ADMIN_DIR . '/settings/add_promo_code_submit'); ?>" autocomplete="off">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Promo Code</label>
                                <div class="col-sm-9">
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Code" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Discount</label>
                                <div class="col-sm-9">
                                    <input type="text" name="value" id="value" class="form-control" placeholder="Discount in %" required>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light" id="submit" name="submit">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->