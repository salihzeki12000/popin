<?php
$getAmount = getSingleRecord('settings', 'id', '1');
$getUserInfo = getSingleRecord('user', 'referalLink', $referralID);
if (!empty($getUserInfo)) {
    $user_profile_photo = base_url('uploads/user/' . $getUserInfo->avatar);
} else {
    $user_profile_photo = base_url('uploads/user/user_pic-225x225.png');
}
?>
<div class="referrals-app">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 text-center">
                <img class="profile-photo image-round" src="<?php echo $user_profile_photo; ?>" alt="avatar" />
                <h2><?= ucfirst($getUserInfo->firstName); ?> gave you ₹<?= number_format($getAmount->join_amount); ?> to rent</h2>
                <p>PopIn is the best way to rent unique, local accommodations on any rental budget. Get ₹<?= number_format($getAmount->join_amount); ?> off your first rental of ₹<?= number_format($getAmount->referral_credit_amount); ?> or more. <a href="<?= site_url('page/terms'); ?>">Read the terms</a></p>
            </div>
        </div>
        <!-- <div class="signup-btn-container" data-reactid="23"> -->

        <!-- </div> -->
        <br><br><br>
        <button class="btn btn-red btn-lg openSignUpBox" type="button">Sign up to claim your credit</button>
    </div>
    <hr>
</div>
<style type="text/css">
    .referrals-app .container {
        position: relative;
        padding-bottom: 40px;
    }
</style>
<!--User Signup Modal Box Start-->
<div id="signUpModel" class="modal fade new-partner-model new-signup" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="col-md-12 text-center">
                    <img class="profile-photo image-round" src="<?php echo $user_profile_photo; ?>" height="150" width="150" alt="avatar" />
                    <h4 class="mr10"><?= ucfirst($getUserInfo->firstName . ' ' . $getUserInfo->lastName); ?> gave you ₹<?= number_format($getAmount->join_amount); ?> to travel</h4>
                    <p>PopIn is the best way to rent unique, local accommodations on any travel budget. Get ₹<?= number_format($getAmount->join_amount); ?> off your first trip of ₹<?= number_format($getAmount->referral_credit_amount); ?> or more. Read the terms</p>
                </div>
            </div>
            <form name="signUpFormRefer" id="signUpFormRefer" method="post" action="<?= base_url('user/submit_referral_register'); ?>" autocomplete="off">
                <div class="modal-body mt10">
                    <div class="felid">
                        <input placeholder="First name" value="" id="reg_firstName" name="reg_firstName" class="textbox" type="text" />
                        <input type="hidden" name="userID" value="<?= $getUserInfo->id; ?>" >
                        <input type="hidden" name="userAmount" value="<?= $getAmount->referral_credit_amount; ?>" >
                        <input type="hidden" name="joinUserAmount" value="<?= $getAmount->join_amount; ?>" >
                        <input type="hidden" name="referralID" value="<?= $referralID; ?>" >
                    </div>
                    <div class="felid">
                        <input placeholder="Last name" value="" id="reg_lastName" name="reg_lastName" class="textbox" type="text" />
                    </div>
                    <div class="felid">
                        <input placeholder="Email address" value="" name="reg_email" id="reg_email" class="icon3 textbox" onkeyup="return forceLower(this);" />
                    </div>
                    <div class="felid">
                        <input placeholder="Password" value="" name="reg_password" id="reg_password" class="icon4 textbox" type="password" />
                    </div>
                    <div class="felid barthday">
                        <label><b>Birthday</b></label>
                        <p></p>
                        <div class="row">
                            <div class="col-md-4">
                                <select class="selectbox custom-select" name="reg_dobMonth" id="reg_dobMonth">
                                    <?php $all_months = unserialize(MONTHS);
                                    foreach ($all_months as $k => $v) {
                                        ?>
                                        <option value="<?= $k; ?>"><?= $v; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="selectbox custom-select" name="reg_dobDay" id="reg_dobDay">
                                    <option value="">Day</option>
                                    <?php for ($i = 1; $i <= 31; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="selectbox custom-select" name="reg_dobYear" id="reg_dobYear">
                                    <option value="">Year</option>
                                    <?php for ($i = date('Y') - 18; $i >= (date('Y') - 100); $i--) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="check-right">
                        <label>
                            <input class="mt0" id="newsLetter" name="newsLetter" value="Yes" type="checkbox" checked>
                            <span for="newsLetter">I need updates via email about Popln</span>
                        </label>
                    </div>
                    <button class="btn-red btn-block" type="submit">Sign up with Email</button>
                    <span class="trams">By singing up, I agree to Popln’s Terms of Service, <a target="_blank" href="<?= site_url(); ?>">Non-discrimination Policy</a>, <a target="_blank" href="<?= site_url(); ?>">Payment Terms of Services</a>, <a target="_blank" href="<?= site_url(); ?>">Privacy Policy</a>, <a target="_blank" href="<?= site_url(); ?>">Professional Refund Policy</a>, <a target="_blank" href="<?= site_url(); ?>">Owner Guarantee Terms</a>.</span>
<!--                    <div class="modal-footer clearfix">
                        <div class="pull-left">Already have a Popln account?</div>
                        <button type="button" class="btn btn-red openSignInBox">Log In</button>
                    </div>-->
                </div>
            </form>
        </div>
    </div>
</div>
<!--User Signup Modal Box End-->
<script>
    $(document).ready(function (e) {
        $('#signUpFormRefer').validate({
            rules: {
                reg_firstName: {required: true},
                reg_lastName: {required: true},
                reg_email: {required: true, email: true, remote: {
                        url: "<?= base_url('user/check_exist_email'); ?>",
                        type: "post"
                    }},
                reg_password: {required: true},
                reg_dobMonth: {required: true},
                reg_dobDay: {required: true},
                reg_dobYear: {required: true}
            },
            messages: {
                reg_firstName: {required: "Please Enter First Name"},
                reg_lastName: {required: "Please Enter Last Name"},
                reg_email: {required: "Please Enter Email Address", email: "Please Enter Valid Email Address", remote: "This Email Address Is Already Exist, Please Use Another Email Address"},
                reg_password: {required: "Please Enter Password"},
                reg_dobMonth: {required: "Please Select Month"},
                reg_dobDay: {required: "Please Select Day"},
                reg_dobYear: {required: "Please Select Year"}
            }
        });
    });
</script>