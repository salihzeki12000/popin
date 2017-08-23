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
                    <div class="sidenav-list">
                        <?php $this->load->view(FRONT_DIR . '/user/account-sidebar'); ?>
                    </div>
                    <a class="btn btn-default btn-block" href="javascript:void(0);">Rental Credit</a>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default social-connec change-pass country-residence">
                            <div class="panel-heading">Country of Residence</div>
                            <div class="panel-body">
                                <form name="accountSettings" id="accountSettings" method="post" action="<?= base_url('account/submit_settings'); ?>">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="col-md-5 text-right">
                                                <label for="countryResidence">Country of Residence <i class="fa fa-question-circle" aria-hidden="true"></i></label>
                                            </div>
                                            <div class="col-md-7">
                                                <select id="countryResidence" name="countryResidence">
                                                    <?php
                                                    $all_country = unserialize(ALL_COUNTRY);
                                                    foreach ($all_country as $k => $v) {
                                                        ?>
                                                        <option value="<?= $k; ?>" <?= ($userProfileInfo->countryResidence == $k) ? 'selected' : ''; ?>><?= $v; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <span>Click 'Save Country of Residence' to confirm. </span>
                                    </div>
                                    <div class="row">
                                        <div class="panel-footer">
                                            <div class="align-right">
                                                <button class="btn-red" type="submit" name='submit' id="submit">Save Country of Residence</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel panel-default social-connec change-pass country-residence">
                            <div class="panel-heading">Cancel Account</div>
                            <div class="panel-body">
                                <!--<button class="btn-red openCancelAccountBox">Cancel my account</button>-->
                                <button class="btn-red" id="btn-open-cancel">Cancel My Account</button>
                                <div class="cancel-acc" id="div-cancel">
                                    <form name="cancel_account" id="cancel_account" method="post" action="<?= base_url('user/cancel_account/'); ?>">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h5>Tell us why you're leaving</h5>
                                                <div class="space-2">
                                                    <?php
                                                    $reasons = unserialize(CAN_REASON);
                                                    foreach ($reasons as $k => $v) {
                                                        ?>
                                                        <label for="reason_safety_concerns">
                                                            <input id="reason_safety_concerns" name="reason" value="<?= $k; ?>" type="radio">
                                                            <?= $v; ?>
                                                        </label>
                                                    <?php } ?>
                                                    <p class="reasonError"></p>
                                                </div>
                                                <div class="space-2">
                                                    <label for="detail">
                                                        Care to tell us more?
                                                    </label>
                                                    <textarea class="textarea input-block" id="detail" name="detail"></textarea>
                                                </div>
                                                <div class="space-2">
                                                    <label>
                                                        Can we contact you for more details?
                                                    </label>
                                                    <label class="label-inline" for="reason_yes">
                                                        <input id="canContact" name="canContact" value="Yes" type="radio" checked> Yes
                                                    </label>
                                                    <label class="label-inline" for="reason_no">
                                                        <input id="canContact" name="canContact" value="No" type="radio"> No
                                                    </label>
                                                </div>
                                                <h5>What's going to happen</h5>
                                                <ul class="space-4">
                                                    <li>
                                                        Your profile and any listings will disappear.
                                                    </li>
                                                    <li>
                                                        We'll miss you terribly.
                                                    </li>
                                                </ul>
                                                <div class="tow-btn">
                                                    <button class="btn-red" type="submit" name="submit">Cancel my account</button>
                                                    <button class="btn btn-default" id="btn-close-cancel">Don't cancel account</button>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <h5>Alternatives to canceling</h5>
                                                <div class="space-5">
                                                    <a href="#">Adjust my privacy settings</a>
                                                    <p>Turn off search indexing on your listing, preventing search engines such as Google and Bing from displaying your listing in their search results.</p>
                                                </div>
                                                <div class="space-5">
                                                    <a href="#">Change notification preferences</a>
                                                    <p>Are we sending you too much email? Change your notification preferences. </p>
                                                </div>
                                                <div class="space-5">
                                                    <a href="#">Hide my listings</a>
                                                    <p>Remove your listings from being viewed or found in search to stop hosting on PopIn.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<!--Cancel Account Model Start-->
<div id="cancelAccountModel" class="modal fade new-partner-model new-signup" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Please Enter Password To Cancel Your Account</h4>
            </div>
            <form name="cancelAccountForm" id="cancelAccountForm" method="post" action="<?= base_url('account/cancel_account'); ?>">
                <div class="modal-body">
                    <div class="felid">
                        <input placeholder="Password" id="cancel_password" name="cancel_password" value="" class="textbox" type="password" />
                    </div>
                    <input type="submit" class="btn-red btn-block" name="cancal_submit" id="cancel_submit" value="Cancel Account">
                </div>
            </form>
        </div>
    </div>
</div>
<!--Cancel Account Model End-->
<script type="text/javascript">
    $(document).ready(function () {

        $('#div-cancel').hide();
        $('#btn-open-cancel').click(function () {
            $('#div-cancel').show();
            $(this).hide();
        })
        $('#btn-close-cancel').click(function () {
            $('#div-cancel').hide();
            $('#btn-open-cancel').show();
        })

        $('.openCancelAccountBox').click(function () {
            $('#cancelAccountModel').modal('show');
        });

        $('#cancel_account').validate({
            rules: {
                reason: {required: true},
                detail: {required: true}
            },
            messages: {
                reason: {required: "Please Select One Reason To Cancel Your Account"},
                detail: {required: "Please Enter Details To Cancel Your Account"}
            },
            errorPlacement: function (error, element) {
                if (element.attr('name') == 'reason')
                {
                    error.appendTo('.reasonError');
                } else
                {
                    error.insertAfter(element);
                }
            }
        });

    });
</script>