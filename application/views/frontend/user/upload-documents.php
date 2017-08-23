<?php
$message_notification = $this->session->flashdata('message_notification');

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
?>
<?php if ($message_notification) { ?>
    <!-- Message Notification Start -->
    <div id="message_notification">
        <div class="alert alert-<?= $this->session->flashdata('class'); ?>">
            <button class="close" data-dismiss="alert" type="button">×</button>
            <center><strong><?= $message_notification; ?></strong></center>
        </div>
    </div>
    <!-- Message Notification End -->
<?php } ?>
<section class="middle-container account-section profile-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <?php $this->load->view('frontend/include/profile-sidebar'); ?>
                </aside>
                <form name="trustProfile" id="trustProfile" method="post" action="<?= base_url('user/submit_trust'); ?>" enctype="multipart/form-data">
                    <article class="col-lg-9 main-right">
                        <div class="panel-group">
                            <div class="panel panel-default profile-photo verified-info">
                                <div class="panel-heading">Documents</div>
                                <div class="panel-body">                                    
                                    <div class="row mr15">
                                        <div class="col-md-9">
                                            <h4>Establishment license <small>(<?= ($establishmentLicenceLink !="" && $establishmentLicenseVerified =='yes')?'Verified':(($establishmentLicenceLink !="" && $establishmentLicenseVerified =='no')?'Pending Verification':'Not Uploaded'); ?>)</small></h4>
                                            <?php
                                            if (!empty($establishmentLicenceLink)) {
                                            $licenceCopy  = explode(".",$establishmentLicenceLink);
                                            if ($licenceCopy[1] == 'pdf') { ?>
                                                <a target="_blank" href="<?php echo $establishmentLicenceLink; ?>" title="View Licence"><i style="font-size: 100px;" class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                            <?php }else if ($licenceCopy[1] == 'doc' || $licenceCopy[1] == 'docx') { ?>
                                                <a target="_blank" href="<?php echo $establishmentLicenceLink; ?>" title="View Licence"><i style="font-size: 100px;" class="fa fa-file-word-o" aria-hidden="true"></i></a>
                                            <?php  }else{ ?>
                                                <a target="_blank" href="<?php echo $establishmentLicenceLink; ?>" title="View Licence"><img title="View Licence" src="<?php echo $establishmentLicenceLink; ?>" style="height:100px;" ></a>
                                            <?php  }}else{ ?>
                                            If you are listing your space, verify ownership by providing us with your license.
                                            <?php }?>
                                            <p class="establishmentLicenceError"></p>
                                        </div>
                                        <div class="col-md-3 align-center">
                                            <input type="file" name="establishmentLicence" id="establishmentLicence">
                                        </div>
                                    </div>
                                    <div class="row mr15">
                                        <div class="col-md-9">
                                            <h4>Liability insurance <small>(<?= ($liabilityInsuranceLink !="" && $liabilityInsuranceVerified =='yes')?'Verified':(($liabilityInsuranceLink !="" && $liabilityInsuranceVerified =='no')?'Pending Verification':'Not Uploaded'); ?>)</small></h4>
                                            <?php
                                            if (!empty($liabilityInsuranceLink)) {
                                            $licenceCopy  = explode(".",$liabilityInsuranceLink);
                                            if ($licenceCopy[1] == 'pdf') { ?>
                                                <a target="_blank" href="<?php echo $liabilityInsuranceLink; ?>" title="View Licence"><i style="font-size: 100px;" class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                            <?php }else if ($licenceCopy[1] == 'doc' || $licenceCopy[1] == 'docx') { ?>
                                                <a target="_blank" href="<?php echo $liabilityInsuranceLink; ?>" title="View Licence"><i style="font-size: 100px;" class="fa fa-file-word-o" aria-hidden="true"></i></a>
                                            <?php  }else{ ?>
                                                <a target="_blank" href="<?php echo $liabilityInsuranceLink; ?>" title="View Licence"><img title="View Licence" src="<?php echo $liabilityInsuranceLink; ?>" style="height:100px;" ></a>
                                            <?php  }}else{ ?>
                                            Upload a copy of your liability insurance.
                                            <?php }?>
                                            <p class="liabilityInsuranceError"></p>
                                        </div>
                                        <div class="col-md-3 align-center">
                                            <input type="file" name="liabilityInsurance" id="liabilityInsurance">
                                        </div>
                                    </div>
                                    <div class="row mr15">
                                        <div class="col-md-9">                                            
                                            <h4>License / Certificate Copy <small>(<?= ($licenceLink !="" && $licenceCopyVerified =='yes')?'Verified':(($licenceLink !="" && $licenceCopyVerified =='no')?'Pending Verification':'Not Uploaded'); ?>)</small></h4>
                                            <?php
                                            if (!empty($licenceLink)) {
                                            $licenceCopy  = explode(".",$licenceLink);
                                            if ($licenceCopy[1] == 'pdf') { ?>
                                                <a target="_blank" href="<?php echo $licenceLink; ?>" title="View Licence"><i style="font-size: 100px;" class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                            <?php }else if ($licenceCopy[1] == 'doc' || $licenceCopy[1] == 'docx') { ?>
                                                <a target="_blank" href="<?php echo $licenceLink; ?>" title="View Licence"><i style="font-size: 100px;" class="fa fa-file-word-o" aria-hidden="true"></i></a>
                                            <?php  }else{ ?>
                                               <a target="_blank" href="<?php echo $licenceLink; ?>" title="View Licence"><img title="View Licence" src="<?php echo $licenceLink; ?>" style="height:100px;" ></a>
                                            <?php  }}else{ ?>
                                            Upload a copy of your license or certificate to avoid the hassle later.
                                            <?php }?>
                                            <p class="licenceCopyError"></p>
                                        </div>
                                        <div class="col-md-3 align-center">
                                            <input  type="file" name="licenceCopy" id="licenceCopy">
                                        </div>
                                    </div>
                                    <input type="hidden" name="OldEstablishmentLicence" id="OldEstablishmentLicence" value="<?= $userProfileInfo->establishmentLicence; ?>">
                                    <input type="hidden" name="OldLiabilityInsurance" id="OldLiabilityInsurance" value="<?= $userProfileInfo->liabilityInsurance; ?>">
                                    <input type="hidden" name="OldLicenceCopy" id="OldLicenceCopy" value="<?= $userProfileInfo->licenceCopy; ?>">
                                    <input type="submit" name="submit" id="submit" class="btn btn-red pull-right" value="Upload">
                                </div>
                            </div>
                        </div>
                    </article>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
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
