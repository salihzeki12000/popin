<?php $message_notification = $this->session->flashdata('message_notification');
if ($message_notification) { ?>
    <!-- Message Notification Start -->
    <div id="message_notification">
        <div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
            <button class="close" data-dismiss="alert" type="button">×</button>
            <center><strong><?= $message_notification; ?></strong></center>
        </div>
    </div>
    <!-- Message Notification End -->
<?php } ?>
<div id="message_notification">
</div>
<div class="loader" style="display:none;"></div>
<section class="middle-container account-section profile-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                <?php $this->load->view('frontend/include/profile-sidebar'); ?>
                </aside>
                <form name="editBasicProfile" id="editBasicProfile" method="post" action="<?= base_url('user/submit_basic'); ?>">
                    <article class="col-lg-9 main-right">
                        <div class="panel-group">
                            <div class="panel panel-default required">
                                <div class="panel-heading">Required</div>
                                <div class="panel-body">
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">First Name</label>
                                            <div class="col-sm-9"><input onchange="autoSave(this.id, this.value)" name="firstName" id="firstName" class="textbox" type="text" value="<?= $userProfileInfo->firstName; ?>"/></div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Last Name</label>
                                            <div class="col-sm-9">
                                                <input class="textbox" name="lastName" id="lastName" onchange="autoSave(this.id, this.value)" value="<?= $userProfileInfo->lastName; ?>" type="text" />
                                                <p>Your public profile only shows your first name. When you request a booking, Our partner will see your first and last name.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Gender <i class="fa fa-lock" aria-hidden="true"></i></label>
                                            <div class="col-sm-9">
                                                <select class="selectbox custom-select" name="gender" id="gender" onchange="autoSave(this.id, this.value)">
                                                    <option value="" selected disabled>Gender</option>
                                                    <option value="Male" <?= ($userProfileInfo->gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                    <option value="Female" <?= ($userProfileInfo->gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                </select>
                                                <p class="genderError"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Date of Birth <i class="fa fa-lock" aria-hidden="true"></i></label>
                                            <div class="col-sm-9">
                                                <select class="selectbox custom-select" name="dobMonth" id="dobMonth" onchange="autoSave(this.id, this.value)">
                                                    <?php $all_months = unserialize(MONTHS);
                                                    foreach ($all_months as $k => $v) {
                                                        ?>
                                                        <option value="<?= $k; ?>" <?= ($k == $userProfileInfo->dobMonth) ? 'selected' : ''; ?>><?= $v; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <select class="selectbox custom-select" name="dobDay" id="dobDay" onchange="autoSave(this.id, this.value)">
                                                    <option value="">Day</option>
                                                    <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                        <option value="<?php echo $i; ?>" <?= ($userProfileInfo->dobDay == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <select class="selectbox custom-select" name="dobYear" id="dobYear" onchange="autoSave(this.id, this.value)">
                                                    <option value="">Year</option>
                                                    <?php for ($i = date('Y')-18; $i >= (date('Y') - 100); $i--) { ?>
                                                        <option value="<?php echo $i; ?>" <?= ($userProfileInfo->dobYear == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <p class="birthError"></p>
                                                <p>We use this data for analysis and never share it with other users.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Email Address <i class="fa fa-lock" aria-hidden="true"></i></label>
                                            <div class="col-sm-9">
                                                <input class="textbox" type="text" readonly placeholder="abc@gmail.com" name="email" id="email" value="<?= $userProfileInfo->email; ?>" />
                                                <p>We won’t share your personal email address with other Pooln users.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Phone Number <i class="fa fa-lock" aria-hidden="true"></i></label>
                                            <div class="col-sm-9 number-add">
                                                <span id="showBox">
                                                    <?php if (empty($userProfileInfo->phone)) { ?>
                                                        <u><p style="cursor:pointer;" data-toggle="modal" data-target="#myModal" >+ Add Phone Number</p></u>
                                                    <?php
                                                    } else {
                                                        $number = explode("-", $userProfileInfo->phone);
                                                        ?>
                                                        <input class="textbox" type="text" placeholder="(+1)123-456-789" name="phone" id="phone" value="<?= $number[0] . '' . $number[1]; ?>" readonly />
<?php }
if ($userProfileInfo->phone_verify != 'yes' && !empty($userProfileInfo->phone)) {
    ?>
                                                        <input type="hidden" name="numberCode" value="<?= (!empty($number[0]) ? $number[0] : ''); ?>" >
                                                        <input type="hidden" name="number" value="<?= (!empty($number[1]) ? $number[1] : ''); ?>" >
                                                        <u id="ErrorMessage"><p style="cursor:pointer;" data-toggle="modal" data-target="#myModal" >Not verified, Click here to verify Phone Number</p></u>
                                                    <?php
                                                    }
                                                    if ($userProfileInfo->phone_verify == 'yes') {
                                                        echo '<u><p>Verified<span class="pull-right"><img src="' . base_url('theme/front/assests/img/right-singh.png') . '" alt=""></span></p></u>';
                                                    }
                                                    ?>
                                                </span>
                                                <p>This is only shared once you have a confirmed booking with another <?= SITE_DISPNAME; ?> user. This is how we can all get in touch.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Preferred Language</label>
                                            <div class="col-sm-9">
                                                <select class="selectbox custom-select" name="language" id="language" onchange="autoSave(this.id, this.value)">
                                                    <?php
                                                    $all_languages = unserialize(LANGUAGES);
                                                    foreach ($all_languages as $k => $v) {
                                                        ?>
                                                        <option value="<?= $k; ?>" <?= ($userProfileInfo->language == $k) ? 'selected' : ''; ?>><?= $v; ?></option>
<?php }
?>
                                                </select>
                                                <p class="languageError"></p>
                                                <p>We'll send you messages in this language.</p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Preferred Currency</label>
                                            <div class="col-sm-9">
                                                <select class="selectbox custom-select" name="currency" id="currency" onchange="autoSave(this.id, this.value)">
                                                <?php $all_currency = unserialize(CURRENCIES);
                                                foreach ($all_currency as $k => $v) {
                                                    ?>
                                                    <option value="<?= $v; ?>" <?= ($userProfileInfo->currency == $k) ? 'selected' : ''; ?>><?= $v; ?></option>
                                                <?php } ?>
                                                </select>
                                                <p class="currencyError"></p>
                                                <p>We’ll show you prices in this currency.</p>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="panel panel-default required optional">
                                <div class="panel-heading">Optional</div>
                                <div class="panel-body">
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Business Name</label>
                                            <div class="col-sm-9">
                                                <input class="textbox" value="<?= $userProfileInfo->businessName; ?>" onchange="autoSave(this.id, this.value)" name="businessName" id="businessName" type="text" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Business Phone Number</label>
                                            <div class="col-sm-9">
                                                <input class="textbox" value="<?= $userProfileInfo->businessNumber ?>" onchange="autoSave(this.id, this.value)" name="businessNumber" id="businessNumber" type="text" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Where You Live</label>
                                            <div class="col-sm-9">
                                                <input class="textbox" value="<?= $userProfileInfo->address ?>" onchange="autoSave(this.id, this.value)" name="address" id="address" type="text" placeholder="" />
                                                <p>We won’t share your personal address with other <?= SITE_DISPNAME; ?> users.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Describe Yourself</label>
                                            <div class="col-sm-9 number-add">
                                                <textarea class="textarea" name="aboutYou" onchange="autoSave(this.id, this.value)" id="aboutYou"><?= $userProfileInfo->aboutYou; ?></textarea>
                                                <p>Help other people get to know you.</p>
                                                <p>Tell them what it’s like to have you as a renter or partner: <br/>What’s your style of doing business? <br/>how long have you been in the industry? <br/>What are your specialties?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">School/Institution Attended</label>
                                            <div class="col-sm-9">
                                                <input class="textbox" name="schoolInstitution" id="schoolInstitution" onchange="autoSave(this.id, this.value)" value="<?= $userProfileInfo->schoolInstitution; ?>" type="text" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">License/Certificate Received</label>
                                            <div class="col-sm-9">
                                                <input class="textbox" type="text" name="licenceCertificate" id="licenceCertificate" onchange="autoSave(this.id, this.value)" value="<?= $userProfileInfo->licenceCertificate; ?>" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Time Zone</label>
                                            <div class="col-sm-9">
                                                <select class="selectbox custom-select" name="timeZone" id="timeZone" onchange="autoSave(this.id, this.value)">
<?php
$all_timezone = unserialize(TIMEZONE);
foreach ($all_timezone as $k => $v) {
    ?>
                                                        <option value="<?= $k; ?>" <?= ($userProfileInfo->timeZone == $k) ? 'selected' : ''; ?>><?= $v; ?></option>
<?php } ?>
                                                </select>
                                                <p>Your home time zone.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Languages</label>
                                            <div class="col-sm-9 number-add">
                                                <select data-placeholder="Please Select Languages" name="languages[]" id="languages" onChange="getSelectedOptions(this)"  multiple class="selectbox chosen-select" tabindex="8">
<?php
$language_arr = explode(',', $userProfileInfo->languages);
foreach ($all_languages as $k => $v) {
    ?>
                                                        <option value="<?= $k; ?>" <?= (in_array($k, $language_arr) == true and $language_arr[0] != '') ? 'selected' : ''; ?>><?= $v; ?></option>
<?php } ?>
                                                </select>
                                                <p>Add any languages that others can use to speak with you on <?= SITE_DISPNAME; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Emergency contact <i class="fa fa-lock" aria-hidden="true"></i></label>
                                            <div class="col-sm-9 number-add">
                                                <input class="textbox" name="emergencyContacts" id="emergencyContacts" onchange="autoSave(this.id, this.value)" value="<?= $userProfileInfo->emergencyContacts; ?>" type="text" placeholder="" />
                                                <p>Give our Customer Experience team a trusted contact we can alert in an urgent situation.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-input">
                                        <div class="row">
                                            <label class="align-right col-sm-3">Shipping Address <i class="fa fa-lock" aria-hidden="true"></i></label>
                                            <div class="col-sm-9 number-add">
                                                <textarea class="textarea" name="shippingAddress" id="shippingAddress" onchange="autoSave(this.id, this.value)"><?= $userProfileInfo->shippingAddress; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <button class="btn-red">Save</button>-->
                        </div>
                    </article>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function getSelectedOptions(sel) {
        var opts = [],
                opt;
        var len = sel.options.length;
        // alert(len+1);
        for (var i = 0; i < len; i++) {
            opt = sel.options[i];

            if (opt.selected) {
                opts.push(opt.value);
                // alert(opt.value);
            }
        }
        autoSave('languages', opts);
    }
    function autoSave(fieldId, value)
    {
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
    $(document).ready(function (e) {



        $('.chosen-select').chosen();

        $('#editBasicProfile').validate({
            rules: {
                firstName: {required: true},
                lastName: {required: true},
                gender: {required: true},
                dobMonth: {required: true},
                dobDay: {required: true},
                dobYear: {required: true},
                phone: {required: true},
                language: {required: true},
                currency: {required: true},
                businessName: {required: true},
                //aboutYou : {required:true}
            },
            groups: {
                DateOfBirth: "dobMonth dobDay dobYear"
            },
            messages: {
                firstName: {required: "Please Enter First Name"},
                lastName: {required: "Please Enter Last Name"},
                gender: {required: "Please Select Gender"},
                dobMonth: {required: "Please Select Month"},
                dobDay: {required: "Please Select Day"},
                dobYear: {required: "Please Select Year"},
                phone: {required: "Please Enter Your Phone Number"},
                language: {required: "Please Select Your Language"},
                currency: {required: "Please Select Your Currency"},
                businessName: {required: "Please Enter Your Business Name"}
                //aboutYou : {required:"Please Enter About You"}
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "dobMonth" || element.attr("name") == "dobDay" || element.attr("name") == "dobYear")
                {
                    error.appendTo(".birthError");
                } else if (element.attr("name") == "language")
                {
                    error.appendTo('.languageError');
                } else if (element.attr('name') == 'currency')
                {
                    error.appendTo('.currencyError');
                } else if (element.attr('name') == 'gender')
                {
                    error.appendTo('.genderError');
                } else
                {
                    error.insertAfter(element);
                }
            }
        });
    });

</script>
<style type="text/css">
    .modal-header {
        padding: 15px;
        background-color: #bdc1c3;
        color: rgba(216, 27, 16, 0.98);
    }
    input.form-control.addCountry {
        width: 85px;
        padding-top: 20px;
        padding-bottom: 20px;
        position: relative;
        left: 11px;
        font-size: 20px;
    }
    input.form-control.number {
        padding-top: 20px;
        padding-bottom: 20px;
        /*padding-right: 125px;*/
        font-size: 20px;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="closeBtn" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Add Phone Number</h3>
            </div>
            <div class="modal-body">
                <form id="numberVerify" class="form-inline">
                    <div class="form-group" style="margin-left: 10px;margin-bottom:10px;">
                        <center> <label for="email">Change country:</label>
                            <select class="form-control" name="countryName" onchange="onchangeCountry()" >
                                <?php
                                $all_countries = unserialize(MOBILECODES);
                                $setCountry = (!empty($userProfileInfo->countryResidence) ? $userProfileInfo->countryResidence : 'US');
                                foreach ($all_countries as $k => $v) {
                                    ?>
                                    <option value="<?= $v['code']; ?>" <?= ($setCountry == $k ? 'selected' : ''); ?> ><?= ucfirst(strtolower($v['name'])); ?></option>
<?php } ?>
                            </select>
                    </div> 
                    <div class="form-group">
                        <label for="email">Phone Number:</label>
                        <input type="text" class="form-control addCountry" name="code" readonly="">
                        <input type="text"  class="form-control number numeric" id="phone" name="phoneNumber"> 
                    </div>
                    </center>
            </div>
            <div class="modal-footer">
                <button style="font-size: 21px;" onclick="verifyAccount()" type="button" class="btn btn-danger">Verify</button>
                </form>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        onchangeCountry();
    });
    function onchangeCountry() {
        var countryCode = '+' + $('select[name="countryName"]').val();
        $('input[name="code"]').val(countryCode);
    }
    var numberCode = $('input[name="numberCode"]').val();
    var number = $('input[name="number"]').val();
    $('input[name="code"]').val(numberCode);
    $('input[name="phoneNumber"]').val(number);
    var code = numberCode.slice(1);
    $('select[name="countryName"]').val(code);
    function verifyAccount() {
        var numberCode = $('input[name="code"]').val();
        var number = $('input[name="phoneNumber"]').val();
        var fullphone = numberCode + '' + number;
        $.ajax({
            url: '<?= base_url('user/ajax_verify_phoneNumber'); ?>',
            type: 'POST',
            dataType: "json",
            data: {phone: number, code: numberCode},
            beforeSend: function () {
                $(".loader").show();
            },
            complete: function () {
                $('.loader').hide();
            },
            success: function (response) {
                $('#myModal').modal('hide');
                $("#verifyBtn").trigger("click");
                $('input[name="verifuMobileNumberr"]').val(fullphone);
            }
        });
    }
</script>
<button type="button" style="display: none;" id="verifyBtn" data-toggle="modal" data-target="#verifyAccount" ></button>
<div class="modal fade" id="verifyAccount" role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Verification</h3>
            </div>
            <div class="modal-body">
                <form id="numberVerify" class="form-inline">
                    <div class="form-group">
                        <label for="email">Verification Code:</label>
                        <input type="text"  class="form-control number numeric" id="verifyCode" name="verifyCodeNumber" placeholder="Enter verify code"> 
                        <input type="hidden" name="verifuMobileNumberr">
                        <span id="errmsg"></span>
                    </div>
                    </center>
            </div>
            <div class="modal-footer">
                <button disabled="true" id="submitVerifyBtn" style="font-size: 21px;" onclick="submitVerifyCode()"  type="button" class="btn btn-danger">Verify</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('input[name="verifyCodeNumber"]').keyup(function () {
        var enterValue = this.value;
        $.ajax({
            url: '<?= base_url('user/checkSessionVerifyCode'); ?>',
            type: 'POST',
            dataType: "json",
            data: {enterValue: enterValue},
            success: function (response) {
                if (response == true) {
                    console.log(response);
                    $("#submitVerifyBtn").prop("disabled", false);
                } else {
                    $("#submitVerifyBtn").prop("disabled", true);
                }
            }
        });
    })
    function submitVerifyCode() {
        var enterCode = $('input[name="verifyCodeNumber"]').val();
        var number = $('input[name="verifuMobileNumberr"]').val();
        $.ajax({
            url: '<?= base_url('user/ajax_verifyCode'); ?>',
            type: 'POST',
            dataType: "json",
            data: {enterCode: enterCode},
            beforeSend: function () {
                $(".loader").show();
            },
            complete: function () {
                $('.loader').hide();
            },
            success: function (response) {
                if (response == 1) {
                    $('#verifyAccount').modal('hide');
                    $('#showBox').html('<input class="textbox" type="text" placeholder="(+1)123-456-789" name="phone" id="phone" value="' + number + '" readonly /><p>Verified<span class="pull-right"><img src="<?= base_url('theme/front/assests/img/right-singh.png') ?>" alt=""></span></p>');
                } else {
                    $('#errmsg').html('<p style="color:red;" >Worng Verification code</p>');
                }
            }
        });
    }
    $(".numeric").keypress(function (e) {
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
</script>