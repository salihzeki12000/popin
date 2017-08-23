<?php if ($message_notification = $this->session->flashdata('message_notification')) { ?>
    <!-- Message Notification Start -->
    <div id="message_notification">
        <div class="alert alert-<?= $this->session->flashdata('class'); ?>">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <center><strong><?= $this->session->flashdata('message_notification'); ?></strong></center>
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
                    <div class="panel-group">
                        <div class="panel panel-default social-connec change-pass country-residence">
                            <div class="panel-heading">Country of Residence</div>
                            <div class="panel-body">
                                <form name="accountSettings" id="accountSettings" method="post" action="<?= base_url('account/submit_settings'); ?>">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="col-md-5 text-right">
                                                <label for="countryResidence">Country of Residence</label>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="selectbox custom-select" id="countryResidence" name="countryResidence" onchange="autoSave(this.id,this.value)" >
                                                    <?php
                                                    $all_country = unserialize(ALL_COUNTRY);
                                                    foreach ($all_country as $k => $v) {
                                                        ?>
                                                        <option value="<?= $k; ?>" <?= ($userProfileInfo->countryResidence == $k) ? 'selected' : ''; ?>><?= $v; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <span>Click 'Save Country of Residence' to confirm. </span> -->
                                    </div>
                                    <!-- <div class="row">
                                        <div class="panel-footer">
                                            <div class="align-right">
                                                <button class="btn-red" type="submit" name='submit' id="submit">Save Country of Residence</button>
                                            </div>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                        <div class="panel panel-default social-connec change-pass country-residence">
                            <div class="panel-heading">Cancel Account</div>
                            <div class="panel-body">
                            <?php //echo sendMail(); ?>
                                <!--<button class="btn-red openCancelAccountBox">Cancel my account</button>-->
                                <button class="btn-red" id="btn-open-cancel">Cancel My Account</button>
                                <div class="cancel-acc" id="div-cancel" style="display: none;">
                                    <form name="cancel_account" id="cancel_account" method="post" action="<?= base_url('user/cancel_account'); ?>">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="space-2">
                                                    <label>
                                                        Are you sure, you want to cancel your account?
                                                    </label>
                                                    <label class="label-inline" for="reason_yes">
                                                        <input id="reason_yes" name="canCancel" value="Yes" type="radio"> Yes
                                                    </label>
                                                    <label class="label-inline" for="reason_no">
                                                        <input id="reason_no" name="canCancel" value="No" type="radio"> No
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
                                                    <button class="btn btn-default" id="btn-close-cancel" type="button">Don't cancel account</button>
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

        //$('#div-cancel').hide();
        $('#btn-open-cancel').click(function () {
            $('#div-cancel').show();
            $(this).hide();
        });
        $('#btn-close-cancel').click(function () {
            $('#div-cancel').hide();
            $('#btn-open-cancel').show();
        });

        $('.openCancelAccountBox').click(function () {
            $('#cancelAccountModel').modal('show');
        });

        $('#cancel_account').validate({
            rules: {
                canCancel: {required: true}
            },
            messages: {
                canCancel: {required: "Please confirm you choice to cancel your account."}
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent().parent());
            }
        });

    });
  function autoSave(fieldId,value)
    	{
    		var field = fieldId;
        // console.log(fieldId+'<br>'+value)
    		$.ajax({
    							url: '<?= base_url('account/submit_settings'); ?>',
    							type: 'POST',
    							dataType: "json",
    							data: {col:field,val:value},
    							beforeSend: function(){
    								$(".loader").show();
    							},
    							complete: function(){
    								$('.loader').hide();
    							},
    							success: function(response) {
                    //  console.log(response['class'])
    								// if(response =='true')
    								// {
    									$('#message_notification').html('<div class="alert alert-<?= A_FAIL; ?>"><button class="close" data-dismiss="alert" type="button">×</button><strong>'+response['message']+'</strong></div>');
    									//alert(response['message']);
    								// }
    								// else{
    								// 	//$('#message_notification').html('<div class="alert alert-<?= A_SUC; ?>"><button class="close" data-dismiss="alert" type="button">×</button><strong>'+response['message']+'</strong></div>');
    								// }
    							}
    						});
    	}
</script>
