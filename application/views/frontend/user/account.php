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
<section class="middle-container account-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <?php $this->load->view(FRONT_DIR . '/include/account-sidebar');?>
                </aside>
                <article class="col-lg-9 main-right">
                    <form name="accountNotifications" id="accountNotifications" method="post" enctype="multipart/form-data" action="<?= base_url('account/submit_notifications'); ?>">
                        <div class="panel-group">
                            <div class="panel panel-default push-noti">
                                <div class="panel-heading">Text Message Settings</div>
                                <div class="panel-body">
                                    <div class="media">
                                        <div class="media-left">
                                            <p>Receive mobile updates by regular SMS text message.</p>
                                            <p><strong>Note:</strong> For more information, text HELP to 247262. To cancel mobile notifications, reply STOP to 247262. Message and Data rates may apply.</p>
                                        </div>
                                        <div class="media-body">
                                            <div class="receive-sms">
                                                <ul>
                                                    <li>Receive SMS notifications to: <br /></li>
                                                    <li>
                                                        <input type="text" name="notificationNumber" id="notificationNumber" onchange="autoSave(this.id, this.value)" onblur="autoSave(this.id, this.value)" value="<?= $userProfileInfo->notificationNumber != ""?$userProfileInfo->notificationNumber:$userProfileInfo->phone; ?>" class="textbox">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="checkbox-him">
                                                <div class="row">
                                                    <label class="col-sm-1">
                                                        <input id="numberNotification" onchange="autoSave(this.id, this.value, this.checked)" name="numberNotification" type="checkbox" value="Yes" <?= ($userProfileInfo->numberNotification == 'Yes') ? 'checked' : ''; ?>>
                                                    </label>
                                                    <label for="numberNotification" class="col-sm-11">
                                                        <strong>Messages</strong>
                                                        <p>From partners and professionals</p>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="checkbox-him">
                                                <div class="row">
                                                    <label class="col-sm-1" for="rentalUpdates">
                                                        <input id="rentalUpdates" name="rentalUpdates" onchange="autoSave(this.id, this.value, this.checked)" value="Yes" type="checkbox" <?= ($userProfileInfo->rentalUpdates == 'Yes') ? 'checked' : ''; ?>>
                                                    </label>
                                                    <label for="rentalUpdates" class="col-sm-11">
                                                        <strong>Rental Updates</strong>
                                                        <p>Requests, confirmations, changes and more</p>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="checkbox-him">
                                                <div class="row">
                                                    <label class="col-sm-1" for="otherUpdates">
                                                        <input id="otherUpdates" type="checkbox" onchange="autoSave(this.id, this.value, this.checked)" name="otherUpdates" value="Yes" <?= ($userProfileInfo->otherUpdates == 'Yes') ? 'checked' : ''; ?>>
                                                    </label>
                                                    <label for="otherUpdates" class="col-sm-11">
                                                        <strong>Other</strong>
                                                        <p>Feature updates and more</p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default push-noti">
                                <div class="panel-heading">Email Settings</div>
                                <div class="panel-body">
                                    <div class="media">
                                        <div class="media-left">
                                            <p><strong>I want to receive:</strong></p>
                                            <p>You can disable these at any time.</p>
                                        </div>
                                        <div class="media-body">
                                            <div class="checkbox-him">
                                                <div class="row">
                                                    <label class="col-sm-1">
                                                        <input id="generalPromotionalEmail" name="generalPromotionalEmail" type="checkbox" onchange="autoSave(this.id, this.value, this.checked)" value="Yes" <?= ($userProfileInfo->generalPromotionalEmail == 'Yes') ? 'checked' : ''; ?>>
                                                    </label>
                                                    <label for="generalPromotionalEmail" class="col-sm-11">
                                                        <strong>General and promotional emails</strong>
                                                        <p>General promotions, updates, news about <?= SITE_DISPNAME; ?> or general promotions for partner campaigns and services, user surveys, inspiration, and love from <?= SITE_DISPNAME; ?>. </p>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="checkbox-him">
                                                <div class="row">
                                                    <label class="col-sm-1">
                                                        <input id="rentalReviewReminders" name="rentalReviewReminders" onchange="autoSave(this.id, this.value, this.checked)" value="Yes" type="checkbox" <?= ($userProfileInfo->rentalReviewReminders == 'Yes') ? 'checked' : ''; ?>>
                                                    </label>
                                                    <label for="rentalReviewReminders" class="col-sm-11">
                                                        <strong>Rental and review reminders</strong>
                                                        <p>Notifications about upcoming trips and review periods.</p>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="checkbox-him">
                                                <div class="row">
                                                    <label class="col-sm-1">
                                                        <input id="accountActivity" name="accountActivity" onchange="autoSave(this.id, this.value, this.checked)" value="Yes" type="checkbox" <?= ($userProfileInfo->accountActivity == 'Yes') ? 'checked' : ''; ?>>
                                                    </label>
                                                    <label for="accountActivity" class="col-sm-11">
                                                        <strong>Account activity </strong>
                                                        <p>Payment notices, Rental confirmations, review activity, and security alerts. These are required to service your account. You may not opt out of these notices.</p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default push-noti">
                                <div class="panel-heading">Phone Preferences</div>
                                <div class="panel-body">
                                    <div class="media">
                                        <div class="media-left">
                                            <p><strong>I want to receive:</strong></p>
                                            <p>You can disable these at any time.</p>
                                        </div>
                                        <div class="media-body">
                                            <div class="checkbox-him">
                                                <div class="row">
                                                    <label class="col-sm-1">
                                                        <input id="reciveCalls" name="reciveCalls" onchange="autoSave(this.id, this.value, this.checked)" value="Yes" type="checkbox" <?= ($userProfileInfo->reciveCalls == 'Yes') ? 'checked' : ''; ?>>
                                                    </label>
                                                    <label for="reciveCalls" class="col-sm-11">
                                                        <strong>Calls about my account, listings, rentals, or the <?= SITE_DISPNAME; ?> community</strong>
                                                        <p>If you opt out, we may still call you about your account if it’s urgent or if previous emails didn’t reach you.</p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="align-right">
                                <input type="submit" name="submit" value="Save" class="btn-red" id="submit">
                            </div>-->
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </div>
</section>
<script>
    function autoSave(fieldId, value, checked)
    {
        if(!checked){
            value = "No";
        }
        var field = fieldId;
        $.ajax({
            url: '<?= base_url('user/ajax_submit_basic'); ?>',
            type: 'POST',
            dataType: "json",
            data: {col: field, val: value},
            beforeSend: function () {
                $(".loader").show();
            },
            complete: function () {
                $('.loader').hide();
            },
            success: function (response) {
                if (response['class'] == '<?= A_FAIL ?>')
                {
                    $('#message_notification').html('<div class="alert alert-<?= A_FAIL; ?>"><button class="close" data-dismiss="alert" type="button">×</button><strong>' + response['message'] + '</strong></div>');
                    //alert(response['message']);
                } else {
                    //$('#message_notification').html('<div class="alert alert-<?= A_SUC; ?>"><button class="close" data-dismiss="alert" type="button">×</button><strong>'+response['message']+'</strong></div>');
                }
            }
        });
    }
</script>