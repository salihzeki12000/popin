<?php
include_once APPPATH . "libraries/google-api-php-client/user_register.php";
$google_notification = $this->session->flashdata('google_notification');
?>

<!--User Initial Modal Box Start-->
<div id="becomePartner" class="modal fade new-partner-model" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Become a Partner</h4>
            </div>
            <div class="modal-body">
                <a class="btn2 google-btn btn-block" href="<?php echo $userAuthUrl; ?>">Sign up with Google</a>
                <div class="signup-or-separator">
                    <span class="separator-text">or</span>
                    <hr>
                </div>
                <button class="btn-red btn-block openSignUpBox">Sign up with Email</button>
                <span class="trams">By signing up, I agree to Popln’s Terms of Service, <a href="#">Nondiscrimination Policy</a>, <a href="#">Payment Terms of Services</a>, <a href="#">Privacy Policy</a>, <a href="#">Professional Refund Policy</a>, <a href="#">Owner Gurantee Terms</a>.</span>
                <div class="modal-footer clearfix">
                    <div class="pull-left">
                        Alerady have a <?= SITE_DISPNAME; ?> account?
                    </div>
                    <button type="button" class="btn2 openSignInBox">Log In</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!--User Initial Modal Box End-->



<!--User Signup Modal Box Start-->
<div id="signUpModel" class="modal fade new-partner-model new-signup" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
<!--                <h4 class="modal-title">Become a Partner</h4>-->
            </div>
            
            <div class="modal-body">
                <?php if(empty($google_notification)):?>
                <a class="btn2 google-btn btn-block" href="<?php echo $userAuthUrl; ?>">Sign up with Google</a>
                <div class="signup-or-separator">
                    <span class="separator-text">or</span>
                    <hr>
                </div>
                <?php else: $googleProfile = $this->session->userdata('googleProfile'); if(isset($googleProfile['picture']) && !empty($googleProfile['picture'])){ ?>
                <div class="col-md-12 text-center">
                    <img class="profile-photo image-round image-border" src="<?php echo $googleProfile['picture']; ?>" height="150" width="150" alt="avatar" />
                </div>
                <?php } endif;?>
                <form name="signUpForm" id="signUpForm" method="post" action="<?= base_url('user/submit_register'); ?>" autocomplete="off">
                    <div class="felid">
                        <input placeholder="First name" value="<?php echo isset($googleProfile['given_name'])?$googleProfile['given_name']:''; ?>" id="firstName" name="firstName" class="textbox" type="text" />
                    </div>
                    <div class="felid">
                        <input placeholder="Last name" value="<?php echo isset($googleProfile['family_name'])?$googleProfile['family_name']:''; ?>" id="lastName" name="lastName" class="textbox" type="text" />
                    </div>
                    <div class="felid">
                        <input placeholder="Email address" value="<?php echo isset($googleProfile['email'])?$googleProfile['email']:''; ?>" name="email" id="email" class="icon3 textbox" onkeyup="return forceLower(this);" />
                    </div>
                    <div class="felid">
                        <input placeholder="Password" value="" name="password" id="password" class="icon4 textbox" type="password" />
                    </div>
                    <div class="felid barthday">
                        <label><b>Birthday</b></label>
                        <p></p>
<!--                        <p>To sign up, you must be 18 or older. Other people won’t see your birthday.</p>-->
                        <div class="row">
                            <div class="col-md-5 pdr0">
                                <select class="selectbox custom-select" name="dobMonth" id="dobMonth">
                                    <?php $all_months = unserialize(MONTHS);
                                    foreach ($all_months as $k => $v) {
                                        ?>
                                        <option value="<?= $k; ?>"><?= $v; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3 pdr0">
                                <select class="selectbox custom-select" name="dobDay" id="dobDay">
                                    <option value="">Day</option>
                                    <?php for ($i = 1; $i <= 31; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="selectbox custom-select" name="dobYear" id="dobYear">
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
                            <span for="newsLetter">I would like to receive updates from PopIn</span>
                        </label>
                    </div>
                    <?php if(isset($googleProfile) && !empty($googleProfile)):?>
                    <input type="hidden" name="googleVerified" value="Yes">
                    <input type="hidden" name="googleId" value="<?php echo $googleProfile['id']; ?>">
                    <input type="hidden" name="gender" value="<?php echo ucfirst($googleProfile['gender']); ?>">
                    <input type="hidden" name="picture" value="<?php echo $googleProfile['picture']; ?>">
                    <input type="hidden" name="googleEmail" value="<?php echo $googleProfile['email']; ?>">
                    <input type="hidden" name="language" value="<?php echo $googleProfile['locale']; ?>">
                    <?php endif;?>
                    <button class="btn-red btn-block" type="submit" style="margin-bottom: 5px;"><?= empty($google_notification)?'Sign up with Email':'Sign Up'; ?></button>
                </form>
                <span class="trams">By singing up, I agree to Popln’s Terms of Service, <a target="_blank" href="<?= site_url(); ?>">Non-discrimination Policy</a>, <a target="_blank" href="<?= site_url(); ?>">Payment Terms of Services</a>, <a target="_blank" href="<?= site_url(); ?>">Privacy Policy</a>, <a target="_blank" href="<?= site_url(); ?>">Professional Refund Policy</a>, <a target="_blank" href="<?= site_url(); ?>">Owner Guarantee Terms</a>.</span>
                <div class="modal-footer clearfix">
                    <div class="pull-left">Already have a <?= SITE_DISPNAME; ?> account?</div>
                    <button type="button" class="btn2 openSignInBox">Log In</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--User Signup Modal Box End-->


<!--User Sign In Model Start-->
<div id="signInModel" class="modal fade new-partner-model new-signup" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
<!--                <h4 class="modal-title">Login</h4>-->
            </div>            
            <div class="modal-body">
                <a class="btn2 google-btn btn-block" href="<?php echo $userAuthUrl; ?>">Log in with Google</a>
                <div class="signup-or-separator">
                    <span class="separator-text">or</span>
                    <hr>
                </div>
                <?php if ($this->session->flashdata('message_notification')) { ?>
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
                <form name="signInForm" id="signInForm" method="post" action="<?= base_url('user/submit_login'); ?>">
                    <div class="felid">
                        <input placeholder="Email Address" id="login_email" name="login_email" value="" class="icon3 textbox" type="text" />
                    </div>
                    <div class="felid">
                        <input placeholder="Password" value="" id="login_password" name="login_password" class="icon4 textbox" type="password" />
                    </div>
                    <div class="felid">
                        <a href="javascript:void(0);" class="pull-right openForgotPasswordBox" >Forgot Password ?</a>
                    </div><br><br>
                    <input type="submit" class="btn-red btn-block" name="login_submit" id="login_submit" value="Log in">
                    <div class="modal-footer clearfix">
                        <div class="pull-left">Don't have a <?= SITE_DISPNAME; ?> account?</div>
                        <button type="button" class="btn2 openSignUpBox">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--User Sign In Modal End-->


<!--Forgot Password Modal Box Start-->
<div id="forgotPasswordModel" class="modal fade new-partner-model new-signup" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Forgot Password</h4>
            </div>
            
            <div class="modal-body">
                <form name="forgotPasswordForm" id="forgotPasswordForm" method="post" action="<?= base_url('user/forgot_password'); ?>">
                    <div class="form-group felid">
                        <p>Enter the email address associated with your account, and we’ll email you a link to reset your password.</p>
                    </div>

                    <div class="form-group felid">
                        <input placeholder="Email Address" id="forgot_email" name="forgot_email" value="" class="icon3 textbox" type="text" />
                    </div>
                    <input type="submit" class="btn-red btn-block" name="forgot_submit" id="forgot_submit" value="Send Reset Link">
                </form>
                <div class="modal-footer clearfix">
                    <button type="button" class="btn2 btn-block openSignInBox">&lt; Back to Log in</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Forgot Password Modal Box End-->


<script type="text/javascript">
    function forceLower(strInput) {
        strInput.value = strInput.value.toLowerCase();
    }
    $(document).ready(function () {
<?php $message_notification = $this->session->flashdata('message_notification');
if (!empty($message_notification)) { ?>
            $('#signInModel').modal('show');
<?php } ?>
<?php if (!empty($google_notification)) { ?>
            $('#signUpModel').modal('show');
<?php } ?>
        $('#openBecomePartnerBox').click(function () {
            $('#signUpForm').data('validator').resetForm();
            $('#forgotPasswordModel').modal('hide');
            $('#signInModel').modal('hide');
            $('#becomePartner').modal('show');
        });

        $('.openSignUpBox').click(function () {
            $('#signUpForm').data('validator').resetForm();
            $('#forgotPasswordModel').modal('hide');
            $('#becomePartner').modal('hide');
            $('#signInModel').modal('hide');
            $('#signUpModel').modal('show');
        });

        $('.openSignInBox').click(function () {
            $('#signUpForm').data('validator').resetForm();
            $('#forgotPasswordModel').modal('hide');
            $('#becomePartner').modal('hide');
            $('#signUpModel').modal('hide');
            $('#signInModel').modal('show');
        });
        $('.openForgotPasswordBox').click(function () {
            $('#signUpForm').data('validator').resetForm();
            $('#becomePartner').modal('hide');
            $('#signUpModel').modal('hide');
            $('#signInModel').modal('hide');
            $('#forgotPasswordModel').modal('show');
        });

    });
</script>
<script>
    $(document).ready(function (e) {
        $('#signUpForm').validate({
            rules: {
                firstName: {required: true},
                lastName: {required: true},
                email: {required: true, email: true, remote: {
                        url: "<?= base_url('user/check_exist_email'); ?>",
                        type: "post"
                    }},
                password: {required: true},
                dobMonth: {required: true},
                dobDay: {required: true},
                dobYear: {required: true}
            },
            messages: {
                firstName: {required: "Please Enter First Name"},
                lastName: {required: "Please Enter Last Name"},
                email: {required: "Please Enter Email Address", email: "Please Enter Valid Email Address", remote: "This Email Address Is Already Exist, Please Use Another Email Address"},
                password: {required: "Please Enter Password"},
                dobMonth: {required: "Please Select Month"},
                dobDay: {required: "Please Select Day"},
                dobYear: {required: "Please Select Year"}
            }
        });


        $('#signInForm').validate({
            rules: {
                login_email: {required: true, email: true},
                login_password: {required: true},
            },
            messages: {
                login_email: {required: "Please Enter Email Address", email: "Please Enter Valid Email Address"},
                login_password: {required: "Please Enter Password"},
            }
        });
        $('#forgotPasswordForm').validate({
            rules: {
                forgot_email: {required: true, email: true}
            },
            messages: {
                forgot_email: {required: "Please Enter Email Address", email: "Please Enter Valid Email Address"}
            }
        });
    });
</script>