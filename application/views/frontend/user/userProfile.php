<?php
$notVerified = TRUE;

if(strtolower($userProfileInfo->phone_verify) == 'yes' && 
    $userProfileInfo->establishmentLicence != '' && 
    strtolower($userProfileInfo->establishmentLicenseVerified) == 'yes' &&
    $userProfileInfo->liabilityInsurance != '' && 
    strtolower($userProfileInfo->liabilityInsuranceVerified) == 'yes'){
    $notVerified = FALSE;
}
?>

<section class="middle-container account-section profile-section user-sh">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <div class="profile-pic">
                        <img src="<?php echo base_url('uploads/user/').(!empty($userProfileInfo->avatar)?$userProfileInfo->avatar:'user_pic-225x225.png');?>" alt="" />
                    </div>
                    <div class="panel-group">
                        <div class="panel panel-default verified-info">
                            <div class="panel-heading">Verified info</div>
                            <div class="panel-body clearfix">
                                <ul>
                                    <li class="clearfix">
                                        <div class="pull-left">
                                            <p title="Verified info" >Email address</p>
                                        </div>
                                        <div class="pull-right">
                                            <img title="Verified info" src="<?php echo base_url('theme/front/img'); ?>/right-singh.png" alt="" />
                                            <!-- <span class="screen-reader-only">Verified</span> -->
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="pull-left">
                                            <p>Phone number</p>
                                        </div>
                                        <?php if(strtolower($userProfileInfo->phone_verify) == 'yes'){ ?>
                                        <div class="pull-right">
                                            <img src="<?php echo base_url('theme/front/img'); ?>/right-singh.png" alt="" />
                                        </div>
                                        <?php }?>
                                    </li>
                                    <?php if (!empty($checkProfile)) {?>
                                    <li><a href="<?= base_url()?>user/profile">Learn more >></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <?php if(!empty($userProfileInfo->schoolInstitution)&&!empty($userProfileInfo->businessName)&&!empty($userProfileInfo->language)&&!empty($userProfileInfo->languages)): ?>
                        <?php $languagesList = unserialize(LANGUAGES); ?>
                        <div class="panel panel-default verified-info">
                            <div class="panel-heading">About me</div>
                            <div class="panel-body clearfix">
                                <ul>
                                    <?php if(!empty($userProfileInfo->schoolInstitution)): ?>
                                    <li class="clearfix">
                                        <div class="pull-left">
                                            <strong>School/Institution</strong>
                                            <p><?= $userProfileInfo->schoolInstitution; ?></p>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(!empty($userProfileInfo->businessName)): ?>
                                    <li class="clearfix">
                                        <div class="pull-left">
                                            <strong>Business Name</strong>
                                            <p><?= $userProfileInfo->businessName; ?></p>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(!empty($userProfileInfo->language)): ?>
                                    <li class="clearfix">
                                        <div class="pull-left">
                                            <strong>Preferred Language</strong>
                                            <p><?php
                                            foreach ($languagesList as $k => $v) {
                                                if ($k == $userProfileInfo->language){
                                                    echo $v;
                                                }
                                            }
                                            ?></p>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(!empty($userProfileInfo->languages)): ?>
                                    <li class="clearfix">
                                        <div class="pull-left">
                                            <strong>Languages</strong>
                                             <p>
                                            <?php
                                            $language = explode(",",$userProfileInfo->languages);
                                            $count = 1;
                                                
                                                foreach ($languagesList as $k => $v) {
                                                    if (in_array($k, $language)){
                                                         echo $v;
                                                           if (count($language) != $count) {
                                                                echo ', ';
                                                                $count++;
                                                           }
                                                      }
                                                  }
                                             ?>
                                           </p>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($spaceList)) { ?>
                    <div class="listin-g">
                        <h3>Listings <small>(<?= count($spaceList);?>)</small></h3>
                        <?php
                         $count = 0;
                          foreach ($spaceList as $key => $space) {
                                if ($count == 3) {
                                    break;
                                }
                                $image = getSingleRecord('space_gallery','space',$space->id);
                            echo '<div class="box">
                                 <img src="'.base_url('uploads/user/gallery').'/'.(!empty($image->image)?$image->image:'').'" alt="" />
                                    <div class="text"><b>'.$space->spaceTitle.'<span>'.$space->establishmentName.'/'.$space->spaceName.'</spna></b></div>
                                 </div>';     
                                $count++;
                          }
                          if (!empty($checkProfile)) {
                        ?>
                        <a href="<?= base_url()?>listing" class="view_all">View all listings&nbsp;»</a>
                    </div><?php } } ?>
                </aside>
                <article class="col-lg-9 main-right wish-lists profile-wish-lists">
                    <div class="pro-con">
                        <h2>Hey, I’m <?= $userProfileInfo->firstName; ?></h2>
                        <p><strong><?= strtoupper((!empty($userProfileInfo->countryResidence)?$userProfileInfo->countryResidence:''));?> • Joined in <?= date('M,Y',$userProfileInfo->createdDate);?></strong></p>
                        <p><?= $userProfileInfo->aboutYou; ?></p>
                        <?php $reviewsList = getMultiRecord('space_ratings','reviewOnId',$userProfileInfo->id);?>
                        <ul class="superhost">
                            <li><span><div class="badgePill_186vx4j"><span><?= count($reviewsList); ?></span></div></span>&nbsp;&nbsp;Reviews</li>
                            <li><span><div class="badgePill_186vx4j"><span><?php echo 0 ?></span></div></span>&nbsp;&nbsp;References</li>
                            <?php if(!$notVerified): ?><li><span><img src="<?php echo base_url('theme/front/img'); ?>/ver.png" alt="" /></span>&nbsp;&nbsp;Verified</li><?php endif;?>
                            <?php if (empty($checkProfile) && $this->session->has_userdata('user_id')) { ?>
                                <li class="address-book">
                                    <?php if (isset($addressBook) && in_array($customerID, $addressBook)) { ?>
                                    <span><img src="<?php echo base_url('theme/front/img'); ?>/ver.png" alt="" /></span>&nbsp;&nbsp;Added in address book
                                    <?php }else{ ?>
                                    <a href="javascript:;" onclick="add_to_address_book(<?= $customerID; ?>);"> + Add to my address book</a>
                                    <?php }?>
                                </li>
                            <?php }?>
                        </ul>
                        <?php if(count($userWishLists) > 0): ?>
                        <div class="wishlist-list">
                            <h2>Wish Lists <small>(<?= count($userWishLists); ?>)</small><?php if (!empty($checkProfile)) {?><a href="<?= site_url('wishlists');?>" class="view_all pull-right font12">View all &nbsp;»</a><?php }?></h2>
                            <ul class="clearfix">
                                <?php $wishCount = 1; foreach($userWishLists as $wishlists): if (!empty($checkProfile) && $wishCount == 4) break; ?>
                                <li<?php if(isset($wishlists['userLists'])){ ?> style="background-image: url(<?= $wishlists['userLists'][0]['image'];?>);"<?php }?>>
                                    <div class="content">
                                        <h4><?= $wishlists['name']; ?></h4>
                                        <?php if(isset($wishlists['userLists'])){ ?><a href="<?= site_url('wishlists/'.$wishlists['id']); ?>" class="
                                           btn2"><?= count($wishlists['userLists']);?> Listings</a><?php }?>
                                    </div>
                                </li>
                                <?php $wishCount++; endforeach; ?>
                            </ul>
                        </div>
                        <?php endif;?>
                        <?php if (!empty($reviewsList)) { ?>                        
                        <div class="review-sec mt15">
                            <h3>Reviews <span>(<?= count($reviewsList)?>)</span></h3>
                            <h4>Reviews From Professional</h4>
                            <?php foreach ($reviewsList as $key => $value) {
                            $userList = getSingleRecord('user','id',$value['reviewerId']);
                            if ($value['reviewBy'] == 'Professional') { ?>
                            <div class="media">
                                <div class="media-left">
                                    <div class="inner">
                                        <a href="<?= site_url('home/viewProfile/'.$userList->id); ?>">
                                            <img style="width:58%;" src="<?php echo base_url('uploads/user/thumb/').(!empty($userList->avatar)?$userList->avatar:'user_pic-225x225.png');?>" class="media-object img-circle" />
                                            <p><?= $userList->firstName?></p>
                                        </a>                                        
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p><?= $value['review'];?></p>
                                    <footer class="clearfix">
                                        <div class="pull-left">
                                            <span>Review date • <?= date('M,Y',$value['createdDate']);?></span>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                            <?php }}?>
                            <?php foreach ($reviewsList as $key => $value) {
                            $userList = getSingleRecord('user','id',$value['reviewerId']); 
                            if ($value['reviewBy'] == 'Partner') { ?>
                            <h4>Reviews Form Partner</h4>
                            <div class="media">
                                <div class="media-left">
                                    <div class="inner">
                                        <a href="<?= site_url('home/viewProfile/'.$userList->id); ?>">
                                            <img style="width:58%;" src="<?php echo base_url('uploads/user/thumb/').(!empty($userList->avatar)?$userList->avatar:'user_pic-225x225.png');?>" class="media-object img-circle" />
                                            <p><?= $userList->firstName;?></p>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p><?= $value['review'];?></p>
                                    <footer class="clearfix">
                                        <div class="pull-left">
                                            <span>Review date • <?= date('M,Y',$value['createdDate']);?></span>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                            <?php }}?>
                        </div>                        
                        <?php }?>
                       <!--  <div class="review-sec">
                            <h3>References <span>(2)</span></h3>
                            <div class="media">
                                <div class="media-left">
                                    <div class="inner">
                                        <img src="<?php echo base_url('theme/front/img'); ?>/avatar-pic.png" class="media-object img-circle" />
                                        <p>Nishi</p>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <footer class="clearfix">
                                        <p>June 2012</p>
                                        <div class="align-right">
                                            <p>Anna is a Friend</p>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<script>
function add_to_address_book(contactUserID){
    $.ajax({
        url: "<?php echo base_url('home/addContact'); ?>",
        type: "post",
        data: 'contactUserID='+contactUserID ,
        success: function (response) {
            if (response == 1) {
                $("body").find('li.address-book').html('<span><img src="<?php echo base_url('theme/front/img'); ?>/ver.png" alt="" /></span> Added in address book');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}
</script>