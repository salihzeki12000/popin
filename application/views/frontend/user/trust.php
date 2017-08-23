<?php
include_once APPPATH . "libraries/google-api-php-client/Google_Client.php";
include_once APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

// Google Project API Credentials
$clientId = '962031527806-lgqqsh28c4cn3g15c758i7pcasct4g33.apps.googleusercontent.com';
$clientSecret = '5rrDAy51MKP6M0kYZY86XbZt';
$redirectUrl = base_url() . 'user/google_verification';

// Google Client Configuration
$gClient = new Google_Client();
$gClient->setApplicationName(SITE_DISPNAME);
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);
$google_oauthV2 = new Google_Oauth2Service($gClient);

if (isset($_REQUEST['code'])) {
    $gClient->authenticate();
    $this->session->set_userdata('token', $gClient->getAccessToken());
    redirect($redirectUrl);
}

$token = $this->session->userdata('token');
if (!empty($token)) {
    $gClient->setAccessToken($token);
}
$authUrl = $gClient->createAuthUrl();

$phoneVerified = strtolower($userProfileInfo->phone_verify);
$googleVerified = strtolower($userProfileInfo->googleVerified);

$establishmentLicenceLink = trim($userProfileInfo->establishmentLicence);
if ($userProfileInfo->establishmentLicence != '') {
    $establishmentLicenceLink = base_url('uploads/user/document/' . $userProfileInfo->establishmentLicence);
}
$establishmentLicenseVerified = strtolower($userProfileInfo->establishmentLicenseVerified);

$liabilityInsuranceLink = trim($userProfileInfo->liabilityInsurance);
if ($userProfileInfo->liabilityInsurance != '') {
    $liabilityInsuranceLink = base_url('uploads/user/document/' . $userProfileInfo->liabilityInsurance);
}
$liabilityInsuranceVerified = strtolower($userProfileInfo->liabilityInsuranceVerified);

$licenceLink = trim($userProfileInfo->licenceCopy);
if ($userProfileInfo->licenceCopy != '') {
    $licenceLink = base_url('uploads/user/document/' . $userProfileInfo->licenceCopy);
}
$licenceCopyVerified = strtolower($userProfileInfo->licenceCopyVerified);

$message_notification = $this->session->flashdata('message_notification')
?>

<!-- Message Notification Start -->
<div id="message_notification">
    <?php if ($message_notification) { ?>
    <div class="alert alert-<?= $this->session->flashdata('class'); ?>">
        <button class="close" data-dismiss="alert" type="button">×</button>
        <center><strong><?= $message_notification; ?></strong></center>
    </div>
    <?php } ?>
</div>
<!-- Message Notification End -->

<div class="loader" style="display:none;"></div>
<section class="middle-container account-section profile-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <?php $this->load->view('frontend/include/profile-sidebar'); ?>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
<!--                            <div class="panel panel-default profile-photo mr20">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <strong>Be ready to book</strong>
                                        You’ll need to provide identification before you book, so get a head start by doing it now. Learn more
                                    </div>
                                    <div class="col-md-5 align-center">
                                        <a href="javascript:void(0);" class="btn-red">Provide ID</a>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="panel panel-default verified-info">
                            <div class="panel-heading">Your verified info</div>
                            <div class="panel-body">
                                <h4 class="mr5">Email address</h4>
                                <p>You have confirmed your email: <b><?= $userProfileInfo->email; ?></b>.<br/>A confirmed email is important to allow us to securely communicate with you.</p>
                                <?php if ($phoneVerified == 'yes'){ ?>
                                <h4 class="mt15 mr5">Phone number</h4>
                                <p>You have verified your phone number: <b><?= $userProfileInfo->phone; ?></b>
                                <p>Your number is only shared with another <?= SITE_DISPNAME; ?> member once you have a confirmed booking.</p>
                                <?php } if ($googleVerified == 'yes') { ?>
                                <h4 class="mt15 mr5">Google</h4>
                                <p>Your <?= SITE_DISPNAME; ?> account is Connected with Google account.</p>
                                <?php } if ($establishmentLicenseVerified == 'yes' && !empty($establishmentLicenceLink)) { ?>
                                <h4 class="mt15 mr5">Establishment license <small>(SUBMITTED)</small></h4>

                                <?php } if ($liabilityInsuranceVerified == 'yes' && !empty($liabilityInsuranceLink)) { ?>
                                <h4 class="mt15 mr5">Liability insurance <small>(SUBMITTED)</small></h4>

                                <?php } if ($licenceCopyVerified == 'yes' && !empty($licenceLink)) { ?>
                                <h4 class="mt15 mr5">Government Issued License/Certificate <small>(SUBMITTED)</small></h4>

                                <?php } ?>
                            </div>
                        </div>

                        <div class="panel panel-default mr20">
                            <div class="panel-heading">Documents</div>
                            <div class="panel-body">
                                <div class="main-input">
                                    <div class="row mr15">
                                        <label class="align-left col-sm-4 mt10">Establishment License Number</label>
                                        <div class="col-sm-5">
                                            <input class="textbox" value="<?= $userProfileInfo->establishmentLicenceNumber; ?>" onchange="autoSave(this.id, this.value)" name="establishmentLicenceNumber" id="establishmentLicenceNumber" type="text" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <form name="trustProfile" id="trustProfile" method="post" action="<?= base_url('user/submit_trust'); ?>" enctype="multipart/form-data">
                                    <div class="row mr15">
                                        <div class="col-md-9">
                                            <h4>Establishment license</h4>
                                            <p>If you are listing your space, verify ownership by providing us with your license.</p>
                                            <p class="establishmentLicenceError"></p>
                                        </div>
                                        <div class="col-md-3 align-center">
                                            <input type="file" name="establishmentLicence" id="establishmentLicence">
                                        </div>
                                        <div class="add-payment col-xs-12 mt10">
                                            <ul>
                                                <?php foreach ($userDocuments['establishment'] as $k => $v) { ?>
                                                    <li class="clearfix mr10">
                                                        <p><a target="_blank" href="<?php echo base_url('uploads/user/document/' . $v['doc_name']); ?>" title="View Licence"><?= $v['doc_name']; ?></a></p>
                                                        <div class="wrap">
                                                            <div class="pull-left">
                                                                <?php if ($v['doc_name'] == trim($userProfileInfo->establishmentLicence)) { ?>
                                                                    Default
                                                                <?php } else { ?>
                                                                    <a href="javascript:void(0);" onclick="setDefault('<?= $v['id']; ?>', 'Establishment license')">Set Default</a>
                                                                    <a href="javascript:void(0);" onclick="removeDoc('<?= $v['id']; ?>')">Remove</a>
                                                                <?php } ?>                                                                
                                                            </div>
                                                            <div class="pull-right">
                                                                <?php
                                                                $docInfo  = explode(".",$v['doc_name']);
                                                                $docExt = end($docInfo);
                                                                if ($docExt == 'pdf') { ?>
                                                                    <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i>
                                                                <?php }else if ($docExt == 'doc' || $docExt == 'docx') { ?>
                                                                    <i class="fa fa-file-word-o fa-3x" aria-hidden="true"></i>
                                                                <?php  }else{ ?>
                                                                    <i class="fa fa-file-image-o fa-3x" aria-hidden="true"></i>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div> 
                                    </div>
                                    <div class="row mr15">
                                        <div class="col-md-9">
                                            <h4>Liability insurance</h4>
                                            <p>Upload a copy of your liability insurance.</p>
                                            <p class="liabilityInsuranceError"></p>
                                        </div>
                                        <div class="col-md-3 align-center">
                                            <input type="file" name="liabilityInsurance" id="liabilityInsurance">
                                        </div>
                                        <div class="add-payment col-xs-12 mt10">
                                            <ul>
                                                <?php foreach ($userDocuments['liability'] as $k => $v) { ?>
                                                    <li class="clearfix mr10">
                                                        <p><a target="_blank" href="<?php echo base_url('uploads/user/document/' . $v['doc_name']); ?>" title="View Licence"><?= $v['doc_name']; ?></a></p>
                                                        <div class="wrap">
                                                            <div class="pull-left">
                                                                <?php if ($v['doc_name'] == trim($userProfileInfo->liabilityInsurance)) { ?>
                                                                    Default
                                                                <?php } else { ?>
                                                                    <a href="javascript:void(0);" onclick="setDefault('<?= $v['id']; ?>', 'Liability insurance')">Set Default</a>
                                                                    <a href="javascript:void(0);" onclick="removeDoc('<?= $v['id']; ?>')">Remove</a>
                                                                <?php } ?>                                                                
                                                            </div>
                                                            <div class="pull-right">
                                                                <?php
                                                                $docInfo  = explode(".",$v['doc_name']);
                                                                $docExt = end($docInfo);
                                                                if ($docExt == 'pdf') { ?>
                                                                    <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i>
                                                                <?php }else if ($docExt == 'doc' || $docExt == 'docx') { ?>
                                                                    <i class="fa fa-file-word-o fa-3x" aria-hidden="true"></i>
                                                                <?php  }else{ ?>
                                                                    <i class="fa fa-file-image-o fa-3x" aria-hidden="true"></i>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div> 
                                    </div>
                                    <div class="row mr15">
                                        <div class="col-md-9">                                            
                                            <h4>Government Issued License/Certificate</h4>
                                            <p class="mr10">Upload a copy of your license or certificate to avoid the hassle later.</p>
                                            <p class="licenceCopyError"></p>
                                        </div>
                                        <div class="col-md-3 align-center">
                                            <input  type="file" name="licenceCopy" id="licenceCopy">
                                        </div>
                                        <div class="add-payment col-xs-12 mt10">
                                            <ul>
                                                <?php foreach ($userDocuments['certificate'] as $k => $v) { ?>
                                                    <li class="clearfix mr10">
                                                        <p><a target="_blank" href="<?php echo base_url('uploads/user/document/' . $v['doc_name']); ?>" title="View Licence"><?= $v['doc_name']; ?></a></p>
                                                        <div class="wrap">
                                                            <div class="pull-left">
                                                                <?php if ($v['doc_name'] == trim($userProfileInfo->licenceCopy)) { ?>
                                                                <?php } else { ?>
                                                                    <a href="javascript:void(0);" onclick="removeDoc('<?= $v['id']; ?>')">Remove</a>
                                                                <?php } ?>                                                                
                                                            </div>
                                                            <div class="pull-right">
                                                                <?php
                                                                $docInfo  = explode(".",$v['doc_name']);
                                                                $docExt = end($docInfo);
                                                                if ($docExt == 'pdf') { ?>
                                                                    <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i>
                                                                <?php }else if ($docExt == 'doc' || $docExt == 'docx') { ?>
                                                                    <i class="fa fa-file-word-o fa-3x" aria-hidden="true"></i>
                                                                <?php  }else{ ?>
                                                                    <i class="fa fa-file-image-o fa-3x" aria-hidden="true"></i>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div> 
                                    </div>
                                    <input type="hidden" name="OldEstablishmentLicence" id="OldEstablishmentLicence" value="">
                                    <input type="hidden" name="OldLiabilityInsurance" id="OldLiabilityInsurance" value="">
                                    <input type="hidden" name="OldLicenceCopy" id="OldLicenceCopy" value="">
                                    <input type="submit" name="submit" id="submit" class="btn green-btn pull-right" value="Upload">
                                </form>
                            </div>
                        </div>
                        <?php if ($googleVerified != 'yes' || $phoneVerified != 'yes') { ?>
                        <div class="panel panel-default profile-photo verified-info">
                            <div class="panel-heading">Not Yet Verified</div>
                            <div class="panel-body">
                                <div class="row mr15">
                                    <?php if ($phoneVerified != 'yes') { ?>
                                    <div class="col-md-12 mr20">
                                        <h4 class="mr5">Phone number</h4>
                                        <p>Your number is only shared with another <?php SITE_DISPNAME;  ?> member once you have a confirmed booking.</p>
                                     </div>
                                    <?php }?>

                                    <?php if ($googleVerified != 'yes') { ?>
                                    <div class="col-md-8">
                                        <h4 class="mr5">Google</h4>
                                        Connect your <?= SITE_DISPNAME; ?> account to your Goole account for simplicity and ease.
                                    </div>
                                    <div class="col-md-4 align-center">
                                        <a class="btn btn-default btn-file" href="<?php echo $authUrl; ?>"> Connect with Google </a>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php if (!empty($userPhones)) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">Other verified info</div>
                            <div class="panel-body">
                                <h4 class="mr5">Phone number verified in the Listings</h4>
                                    <p>You have verified these other phone numbers: 
                                        <b>
                                            <?php $otherPhones = ""; foreach($userPhones as $phones){
                                                $otherPhones .= $phones['mobileNumber'] . ", ";
                                            } echo rtrim($otherPhones, ", "); ?>
                                        </b>  
                                    </p>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<script>
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
    function setDefault(id, type)
    {
        if (confirm('Are you sure, you want to set this document as your default '+ type +' ?')) {
            window.location.href = "<?= base_url('account/set_default_document/') ?>" + id;

        } else {
            return false;
        }
    }

    function removeDoc(id)
    {
        if (confirm('Are you sure, you want to remove this document ?')) {
            window.location.href = "<?= base_url('account/remove_document/') ?>" + id;
        } else {
            return false;
        }
    }
    $(document).ready(function (e) {
        $('#trustProfile').validate({
            rules: {
                phone: {required: true},
                licenceCopy: {
                    extension: "jpg|png|jpeg|gif|doc|pdf|docx"
                },
                establishmentLicence: {
                    extension: "jpg|png|jpeg|gif|doc|pdf|docx"
                },
                liabilityInsurance: {
                    extension: "jpg|png|jpeg|gif|doc|pdf|docx"
                }
            },
            messages: {
                phone: {required: "Please Enter Phone Number"},
                licenceCopy: {
                    extension: "Allowed File Types Are JPG, PNG, JPEG, GIF, Doc, Pdf, Docx"
                },
                establishmentLicence: {
                    extension: "Allowed File Types Are JPG, PNG, JPEG, GIF, Doc, Pdf, Docx"
                },
                liabilityInsurance: {
                    extension: "Allowed File Types Are JPG, PNG, JPEG, GIF, Doc, Pdf, Docx"
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") === 'licenceCopy') {
                    error.appendTo('.licenceCopyError');
                } else if (element.attr("name") === 'establishmentLicence')
                {
                    error.appendTo('.establishmentLicenceError');
                } else if (element.attr("name") === 'liabilityInsurance')
                {
                    error.appendTo('.liabilityInsuranceError');
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>