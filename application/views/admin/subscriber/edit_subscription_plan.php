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
                        <form class="form-horizontal" role="form" method="post" action="<?= base_url(ADMIN_DIR . '/subscriptions/update_subscription_submit/'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Subscription Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="<?= $subscription->name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="caption" class="col-sm-3 control-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" name="amount" class="form-control" value="<?= $subscription->amount; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="caption" class="col-sm-3 control-label">Subscription Details</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control summernote" name="details" ><?= $subscription->details; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input type="hidden" name="id" value="<?= $subscription->id; ?>">
                                    <button type="submit" class="btn btn-info waves-effect waves-light" id="submit" name="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->