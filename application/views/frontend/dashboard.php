<?php
	$this->load->view('frontend/include/user-header');
?>
<section class="middle-container list-progress profile-section">
    <div class="container">
        <div class="alert alert-info fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt=""></a>
            <div class="media">
                <div class="media-left">
                    <i class="fa fa-<?= empty($userProfileInfo->currency)?'usd':strtolower($userProfileInfo->currency); ?> fa-alert-icon" aria-hidden="true"></i>
<!--                    <img class="media-object" src="<?= base_url('theme/front/assests/img/doller-icon.png'); ?>" alt="">-->
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Earn <?= getCurrency_symbol($userProfileInfo->currency).number_format($settings->referral_credit_amount); ?> rental credit</h4>
                    <p>Give your colleagues <?= getCurrency_symbol($userProfileInfo->currency).number_format($settings->join_amount); ?> off their first rental on Popln and you’ll get up to <?= getCurrency_symbol($userProfileInfo->currency).number_format($settings->referral_credit_amount);?> rental credit.</p>
                    <a href="<?= site_url('invite'); ?>"><button class="btn2">Invite Colleagues</button></a>
<!--                    <button class="btn btn-default" data-dismiss="alert" aria-label="close">Later</button>-->
                </div>
            </div>
        </div>        
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-sm-3 left-sidebar">
                    <div class="profile">
                        <div class="pro-img" style="text-align: center;">
                            <?php
                                $avatar = ($userProfileInfo->avatar!='' && file_exists('uploads/user/thumb/' . $userProfileInfo->avatar))?$userProfileInfo->avatar:'user_pic-225x225.png';
                            ?>
                            <img src="<?= base_url('uploads/user/thumb/'.$avatar); ?>" alt="">
                        </div>
                        <div class="pro-content">
                            <h3><?= ucfirst($userProfileInfo->firstName); ?></h3>
                            <a href="<?= base_url('home/viewProfile/'.$userProfileInfo->id); ?>">View Profile</a>
                            <a href="<?= base_url('user/profile'); ?>">Edit Profile</a>
                        </div>
                    </div>
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">Verified info</div>
                            <div class="panel-body">
                                <ul>
                                    <li class="clearfix"><span class="pull-left">Personal info</span> <span class="pull-right"><img src="<?= base_url('theme/front/assests/img/right-singh.png'); ?>" alt=""></span></li>
                                    <li class="clearfix"><span class="pull-left">Email address</span> <span class="pull-right"><img src="<?= base_url('theme/front/assests/img/right-singh.png'); ?>" alt=""></span></li>
                                    <li class="clearfix"><span class="pull-left">Phone number</span> <?php if(strtolower($userProfileInfo->phone_verify) == 'yes'){ ?><span class="pull-right"><img src="<?= base_url('theme/front/assests/img/right-singh.png'); ?>" alt=""></span><?php }?></li>
                                    <li class="clearfix"><a href="<?= site_url('user/trust'); ?>">Verify more info</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Connected accounts</div>
                            <div class="panel-body">
                                <ul>
                                    <li class="clearfix"><span class="pull-left">Google</span> <?php if(strtolower($userProfileInfo->googleVerified) == 'yes'){ ?><span class="pull-right"><img src="<?= base_url('theme/front/assests/img/right-singh.png'); ?>" alt=""></span><?php }?></li>
                                    <li class="clearfix"><a href="<?= site_url('user/trust'); ?>">Verify more info</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Quick Links</div>
                            <div class="panel-body">
                                <ul>
                                    <li><a href="<?= site_url('rentals'); ?>">Upcoming Rentals</a></li>
                                    <li><a href="#">Listing on PopIn</a></li>
                                    <li><a href="#">Renting on PopIn</a></li>
                                    <li><a href="#">Help Center</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                <article class="col-sm-9 main-right listings-section">
                    <div class="panel-group">                        
                        <?php if(!empty($inprogress)){ ?>
                        <div class="panel panel-default your-reservations">
                            <div class="panel-heading">Listings in progress</div>
                            <div class="panel-body">
                                <?php foreach($inprogress as $listing){
                                $spaceType = $this->space->getDropdownDataRow('space_types', $listing['spaceType']);
                                if(!empty($spaceType)){
                                    $listing['spaceType'] = $spaceType['name'];
                                }
                                $total_percentage = $listing['step_1_percentage'] + $listing['step_2_percentage'] + $listing['step_3_percentage'];
                                
                                $spaceGallery = $this->db->select('image')->order_by('position', 'asc')->limit('1')->get_where('space_gallery', array('space' => $listing['id']))->row_array();
                                if(!empty($spaceGallery)){                                    
                                    $listingImage = base_url('uploads/user/gallery/'.$spaceGallery['image']);
                                }else{
                                    if($listing['step_1_percentage'] == 100 && $listing['step_3_percentage'] > 0){
                                        $total_percentage = $listing['step_1_percentage'] + ($listing['step_2_percentage'] - 40) + $listing['step_3_percentage'];
                                    }
                                    
                                    $listingImage = base_url("theme/front/assests/img/cam-pic.jpg");
                                }
                                $listComplete = round($total_percentage/3);
                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <div class="inner">
                                            <img src="<?= $listingImage; ?>" alt="" />
                                        </div>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?= $listComplete;?>"
                                            aria-valuemin="0" aria-valuemax="100" style="width:<?= $listComplete; ?>%">
                                            </div>
                                        </div>
                                        <div class="pro-status"><p>You’re <?= $listComplete; ?>% done with your listing.</p></div>
                                        <h4><?= $listing['spaceTitle']; ?></h4>
                                        <h4><?= $listing['spaceType']; ?> in <?= $listing['city'].', '.$listing['state']; ?></h4>
                                        <p>Last updated on <?= date("d F, Y",$listing['updatedDate']); ?></p>
                                        <div class="three-btn">
                                            <a href="<?= site_url('Space/become-a-partner/'. $listing['id']); ?>" class="green-btn">Finish the Listing</a>
                                            <a target="_blank" href="<?= site_url('preview-listing/'.$listing['id']); ?>"><button class="btn">Preview</button></a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="panel panel-default notification">
                            <div class="panel-heading">Notifications</div>
                            <div class="panel-body">
                                <ul>
                                    <li class="clearfix"><a href="<?= site_url('spaces'); ?>"><?= ucfirst($userProfileInfo->firstName); ?>, new spaces have arrived! Book now before they run out.</a><!--<span class="pull-right"><a href="#"><img src="<?php //echo base_url('theme/front/assests/img/close-icon.png'); ?>" alt=""></a></span>--></li>
                                    <li class="clearfix"><a href="<?= site_url('spaces'); ?>">Book workspaces led by experienced business owners. Now over 51 to choose form.</a></li>
                                    <li class="clearfix"><a href="<?= site_url('invite'); ?>">Invite your colleague to join Popln and you’ll get <?= getCurrency_symbol($userProfileInfo->currency).number_format($settings->referral_credit_amount); ?> after their first rental.</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel panel-default notification messages">
                            <div class="panel-heading">Messages (<?php echo $userMessages['newCount']; ?> New)</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed message-table">
                                        <tbody>
                                            <?php if(!empty($userMessages['messages'])):
                                                foreach($userMessages['messages'] as $messages):?>
                                            <tr>
                                                <td width="80"><center><img class="user-pic" src="<?= base_url('uploads/user/thumb/'.$messages['userInfo']['picture']); ?>" alt="" width="50" height="50"></center></td>
                                                <td width="100"><span class="dark-gery"><?= $messages['userInfo']['fname']; ?> <br/><?= date("d/m/Y",$messages['createdDate']); ?></span></td>
                                                <td width="450"><?php if(isset($messages['spaceInfo'])):?><?= $messages['spaceInfo']['title'].", ".$messages['spaceInfo']['country']; ?> <br/><?php endif;?><?= word_limiter(nl2br($messages['message']),20); ?></td>
                                                <?php if($messages['booking']): ?>
                                                <td width="150">
                                                    <h4><?= $messages['bookingInfo']['partnerStatus']; ?></h4>
                                                </td>
                                                <?php endif;?>
                                            </tr>
                                            <?php endforeach;endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if(!empty($userMessages['messages'])): ?>
                                <a class="link" href="<?= site_url('inbox'); ?>">All messages</a>
                                <?php else: ?>
                                <p class="link">When you message partners or send rental requests, you’ll see their responses here.</p>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php
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
                        <!-- Display upload document file -->
                        <div class="panel panel-default profile-photo verified-info">
                            <div class="panel-heading">Documents</div>
                            <div class="panel-body">
                                <div class="row mr15">
                                    <div class="col-md-9">
                                        <h4>Establishment license <small><?= ($establishmentLicenceLink !="" && $establishmentLicenseVerified =='yes')?'(SUBMITTED)':(($establishmentLicenceLink !="" && $establishmentLicenseVerified =='no')?'(Pending Verification)':'<a href="'.base_url('user/trust').'">Upload</a>'); ?></small></h4>
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
                                    </div>
                                </div>
                                <div class="row mr15">
                                    <div class="col-md-9">
                                        <h4>Liability insurance <small><?= ($liabilityInsuranceLink !="" && $liabilityInsuranceVerified =='yes')?'(SUBMITTED)':(($liabilityInsuranceLink !="" && $liabilityInsuranceVerified =='no')?'(Pending Verification)':'<a href="'.base_url('user/trust').'">Upload</a>'); ?></small></h4>
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
                                    </div>
                                </div>
                                <div class="row mr15">
                                    <div class="col-md-9">
                                        <h4>Government Issued License/Certificate <small><?= ($licenceLink !="" && $licenceCopyVerified =='yes')?'(SUBMITTED)':(($licenceLink !="" && $licenceCopyVerified =='no')?'(Pending Verification)':'<a href="'.base_url('user/trust').'">Upload</a>'); ?></small></h4>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- close here -->
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<?php
	$this->load->view('frontend/include/user-footer');
?>
