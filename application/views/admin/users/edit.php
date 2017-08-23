<div class="content-page">
    <div class="content">
        <div class="container">

            <!-- BEGIN PAGE BASE CONTENT -->

            <!--Module Title-->    
            <div class="row">
                <div class="col-md-12">
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
                        <h4 class="page-title"><?= $module_heading." ".$profileDetail['firstName']." ".$profileDetail['lastName']; ?></h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <form id="user-profile" method="post" action="<?= site_url('admin/users/update_profile');?>" enctype="multipart/form-data" novalidate>
            <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Basic Profile Details</h4><hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Avatar</label>
                                <p class="text-muted m-b-15 font-13 avatarBlock"><?= $profileDetail['avatar']; ?></p>
                                <input type="file" name='avatar' id="avatar"  onchange="readURL(this);">
                                <input type="hidden" name="user" value="<?= $profileDetail['id'];?>">
                                <input type="hidden" name="avatar" value="<?= $profileDetail['picture'];?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">First Name<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 firstNameBlock"><input type="text" class="form-control" name="firstName" value="<?= $profileDetail['firstName'];?>" placeholder="First Name" required></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Last Name<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 lastNameBlock"><input type="text" class="form-control" name="lastName" value="<?= $profileDetail['lastName'];?>" placeholder="Last Name" required></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Email Address<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 emailBlock"><input type="email" class="form-control" name="email" value="<?= $profileDetail['email'];?>" placeholder="Email Address" required></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Phone Number<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 phoneBlock"><input type="text" class="form-control" name="phone" value="<?= $profileDetail['phone'];?>" placeholder="placeholder" required></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Gender<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 genderBlock">
                                    <select class="form-control" name="gender" id="gender" required>
                                        <option value="">Gender</option>
                                        <option value="Male" <?= ($profileDetail['gender']=='Male')?'selected':''; ?>>Male</option>
                                        <option value="Female" <?= ($profileDetail['gender']=='Female')?'selected':''; ?>>Female</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Date of Birth<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 dobBlock">
                                    <select class="selectbox" name="dobMonth" id="dobMonth" required>
                                        <?php $all_months = unserialize(MONTHS); 
                                        foreach($all_months as $k=>$v){ ?>
                                        <option value="<?= $k; ?>" <?= ($k==$profileDetail['dobMonth'])?'selected':''; ?>><?= $v; ?></option>
                                        <?php } ?>
                                    </select>
                                    <select class="selectbox" name="dobDay" id="dobDay" required>
                                        <option value="">Day</option>
                                        <?php for($i=1;$i<=31;$i++) { ?>
                                        <option value="<?php echo $i; ?>" <?= ($profileDetail['dobDay']==$i)?'selected':''; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                    <select class="selectbox" name="dobYear" id="dobYear" required>
                                        <option value="">Year</option>
                                        <?php for($i=date('Y')-18;$i>=(date('Y')-100);$i--) { ?>
                                        <option value="<?php echo $i; ?>" <?= ($profileDetail['dobYear']==$i)?'selected':''; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Preferred Language<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 languageBlock">
                                    <select class="form-control" name="language" id="language" required>
                                        <?php $all_languages = unserialize(LANGUAGES); 
                                        foreach($all_languages as $k=>$v)
                                        { ?>
                                                <option value="<?= $k; ?>" <?= ($profileDetail['language']==$k)?'selected':''; ?>><?= $v; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Preferred Currency<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 currencyBlock">
                                    <select class="form-control" name="currency" id="currency" required>
                                    <?php $all_currency = unserialize(CURRENCIES);
                                    foreach($all_currency as $k=>$v) { ?>
                                    <option value="<?= $v; ?>" <?= ($profileDetail['currency']==$k)?'selected':''; ?>><?= $v; ?></option>
                                    <?php } ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Where You Live ?</label>
                                <p class="text-muted m-b-15 font-13 addressBlock"><input type="text" class="form-control" name="address" value="<?= $profileDetail['address'];?>" placeholder="Where You Live ?"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Describe Yourself</label>
                                <p class="text-muted m-b-15 font-13 aboutYouBlock"><textarea class="form-control" rows="5" name="aboutYou" placeholder="Describe Yourself"><?= $profileDetail['aboutYou'];?></textarea></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Business Name<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 businessNameBlock"><input type="text" class="form-control" name="businessName" value="<?= $profileDetail['businessName'];?>" placeholder="Business Name" required></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Business Number</label>
                                <p class="text-muted m-b-15 font-13 businessNumberBlock"><input type="text" class="form-control" name="businessNumber" value="<?= $profileDetail['businessNumber'];?>" placeholder="Business Number"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Establishment License Number<span class="text-danger">*</span></label>
                                <p class="text-muted m-b-15 font-13 establishmentLicenceNumberBlock"><input type="text" class="form-control" name="establishmentLicenceNumber" value="<?= $profileDetail['establishmentLicenceNumber'];?>" placeholder="Establishment License Number"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Additional Profile Details</h4><hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">School/Institution Attended</label>
                                <p class="text-muted m-b-15 font-13 schoolInstitutionBlock"><input type="text" class="form-control" name="schoolInstitution" value="<?= $profileDetail['schoolInstitution'];?>" placeholder="School/Institution Attended"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">License/Certificate Received</label>
                                <p class="text-muted m-b-15 font-13 licenceCertificateBlock"><input type="text" class="form-control" name="licenceCertificate" value="<?= $profileDetail['licenceCertificate'];?>" placeholder="License/Certificate Received"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Time Zone</label>
                                <p class="text-muted m-b-15 font-13 timeZoneBlock">
                                    <select class="form-control" name="timeZone" id="timeZone">
                                    <?php 
                                    $all_timezone = unserialize(TIMEZONE);
                                    foreach($all_timezone as $k=>$v) { ?>
                                           <option value="<?= $k; ?>" <?= ($profileDetail['timeZone']==$k)?'selected':''; ?>><?= $v; ?></option>
                                    <?php } ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Languages</label>
                                <p class="text-muted m-b-15 font-13 languagesBlock">
                                    <select data-placeholder="Please Select Languages" name="languages[]" id="languages"  multiple class="select2 form-control select2-multiple" tabindex="8">
                                        <?php $language_arr = explode(',',$profileDetail['languages']);
                                        foreach($all_languages as $k=>$v)
                                        { ?>
                                                <option value="<?= $k; ?>" <?= (in_array($k,$language_arr)==true and $language_arr[0]!='')?'selected':''; ?>><?= $v; ?></option>
                                       <?php }
                                        ?>
                                      </select>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Emergency Contact</label>
                                <p class="text-muted m-b-15 font-13 emergencyContactBlock"><input type="text" class="form-control" name="emergencyContacts" value="<?= $profileDetail['emergencyContacts'];?>" placeholder="Emergency Contact"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Shipping Address</label>
                                <p class="text-muted m-b-15 font-13 shippingAddressBlock"><textarea class="form-control" rows="5" name="shippingAddress" placeholder="Shipping Address"><?= $profileDetail['shippingAddress'];?></textarea></p>
                            </div>
                        </div>
                    </div>	
                </div>

                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Trust & Verification</h4><hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Establishment License</label>
                                <p class="text-muted m-b-15 font-13 establishmentLicenseVerifiedBlock"><?= $profileDetail['establishmentLicence'];?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Liability Insurance</label>
                                <p class="text-muted m-b-15 font-13 liabilityInsuranceVerifiedBlock"><?= $profileDetail['liabilityInsurance'];?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Government Issued License/Certificate</label>
                                <p class="text-muted m-b-15 font-13 licenceCopyVerifiedBlock"><?= $profileDetail['licenceCopy'];?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Google Verified</label>
                                <p class="text-muted m-b-15 font-13 googleVerifiedBlock"><?= $profileDetail['googleVerified'];?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Google Email</label>
                                <p class="text-muted m-b-15 font-13 googleEmailBlock"><?= $profileDetail['googleEmail'];?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Account Notification Details</h4><hr>
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Text Message Settings</h4><hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">SMS Notification Number<br></label>
                                    <p class="text-muted m-b-15 font-13 numberNotificationBlock"><input type="text" name="notificationNumber" id="notificationNumber" value="<?= $profileDetail['notificationNumber'] != ""?$profileDetail['notificationNumber']:''; ?>" class="form-control"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary numberNotification">
                                        <input id="numberNotification" name="numberNotification" type="checkbox" value="Yes" <?= ($profileDetail['numberNotification'] == 'Yes') ? 'checked' : ''; ?>>
                                        <label for="numberNotification">Messages <br>(From Parnters and Users)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary rentalUpdatesBlock">
                                        <input id="rentalUpdates" name="rentalUpdates" type="checkbox" value="Yes" <?= ($profileDetail['rentalUpdates'] == 'Yes') ? 'checked' : ''; ?>>
                                        <label for="rentalUpdates">Rentals Update <br>(Requests, confirmations, changes and more)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary otherUpdatesBlock">
                                        <input id="otherUpdates" name="otherUpdates" type="checkbox" value="Yes" <?= ($profileDetail['otherUpdates'] == 'Yes') ? 'checked' : ''; ?>>
                                        <label for="otherUpdates">Other <br>(Feature updates and more)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Email Settings</h4><hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary generalPromotionalEmailBlock">
                                        <input id="generalPromotionalEmail" name="generalPromotionalEmail" type="checkbox" value="Yes" <?= ($profileDetail['generalPromotionalEmail'] == 'Yes') ? 'checked' : ''; ?>>
                                        <label for="generalPromotionalEmail">General and Promotional Emails</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary rentalReviewRemindersBlock">
                                        <input id="rentalReviewReminders" name="rentalReviewReminders" type="checkbox" value="Yes" <?= ($profileDetail['rentalReviewReminders'] == 'Yes') ? 'checked' : ''; ?>>
                                        <label for="rentalReviewReminders">Rentals and Review Reminders</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary accountActivityBlock">
                                        <input id="accountActivity" name="accountActivity" type="checkbox" value="Yes" <?= ($profileDetail['accountActivity'] == 'Yes') ? 'checked' : ''; ?>>
                                        <label for="accountActivity">Account Activity</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Phone Preferences</h4><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary reciveCallsBlock">
                                        <input id="reciveCalls" name="reciveCalls" type="checkbox" value="Yes" <?= ($profileDetail['reciveCalls'] == 'Yes') ? 'checked' : ''; ?>>
                                        <label for="reciveCalls">Calls about my account, listings, Rentals, or the Popln community</label>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Payment Methods</h4><hr>
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Paypal Email Address</h4><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="text-muted m-b-15 font-13 paypalEmailBlock"><input type="text" class="form-control" name="paypalEmail" id="paypalEmail" value="<?= $profileDetail['paypalEmail']; ?>" /></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Credit and Debit Cards</h4><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="text-muted m-b-15 font-13 cardsBlock">
                                        <?php if(!empty($profileDetail['cards'])): 
                                            foreach($profileDetail['cards'] as $card):
                                            ?>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card-box widget-box-two widget-two-default">
                                                <div class="wigdet-two-content">                                                    
                                                    <div class="row">
                                                        <p class="m-0 font-600 font-secondary"><b>Card Number:</b> <?= $card->cardNumber;?></p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="m-0 font-600 font-secondary">Expiration : <?= $card->expirationMonth . ' / ' . $card->expirationYear; ?> </p>
                                                    </div>
                                                    <div class="row"><p class="m-0 font-600 font-secondary"><b>Card Type:</b> <?= $card->cardType; ?></p></div>
                                                    <div class="row">
                                                        <div class="pull-left"><p class="m-0 font-600 font-secondary"><b>Default:</b> <?= $card->isPrimary; ?></p></div>
                                                        <div class="pull-right"><i class="fa fa-cc-<?= strtolower($card->cardType); ?> fa-3x"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach;endif;?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Country Residence</h4><hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="text-muted m-b-15 font-13 countryResidenceBlock">
                                    <select class="form-control" id="countryResidence" name="countryResidence">
                                        <?php
                                        $all_country = unserialize(ALL_COUNTRY);
                                        foreach ($all_country as $k => $v) {
                                            ?>
                                            <option value="<?= $k; ?>" <?= ($profileDetail['countryResidence'] == $k) ? 'selected' : ''; ?>><?= $v; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
            <!-- END PAGE BASE CONTENT -->
        </div>
    </div>
</div>
<!-- Sweet-Alert  -->
<script src="<?= base_url('theme/admin/plugins/bootstrap-sweetalert/sweet-alert.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('theme/admin/plugins/parsleyjs/parsley.min.js');?>"></script>
<script>
    $(document).ready(function(e){	
	//$('.chosen-select').chosen();
        $('.select2').select2();
        $('form').parsley();
        $('.doc-verification').click(function () {
            var $this = $(this),
                doc_type = $(this).attr("data-doc-type"),
                doc_name = $(this).attr("data-doc-name"),
                user_id = $(this).attr("data-user-id");
            swal({
                title: "Are you sure?",
                text: "You want to set this verified!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-default btn-md waves-effect',
                confirmButtonClass: 'btn-success btn-md waves-effect waves-light',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, verify it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                //closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '<?= base_url('admin/users/verifyDoc'); ?>',
                        type: 'POST',
                        dataType: "json",
                        data: {column: doc_type, user: user_id},
                        success: function (response) {
                            if (response.class === '<?= A_SUC; ?>')
                            {
                                $this.remove();
                                $(document).find("." + doc_type + "Block").append('&nbsp;&nbsp;&nbsp;<span class="label label-success">Verified</span>');
                                swal("Verified!", doc_name + " is verified successfully.", "success");
                            } else {
                                swal("Failed!", response.message, "error");
                            }
                        }
                    });
                    
                } else {
                    //swal("Cancelled", "", "error");
                }
            });
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#userAvatar')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>