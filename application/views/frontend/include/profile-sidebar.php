<div class="sidenav-list">
    <ul>
        <li><a href="<?php echo base_url('user/profile')?>">Edit Profile</a></li>
        <li><a href="<?php echo base_url('user/photo');?>">Photos</a></li>
<!--        <li><a href="<?php echo base_url('user/upload-documents')?>">Establishment License</a></li>-->
        <li><a href="<?php echo base_url('user/trust')?>">Trust and Verification</a></li>
        <li><a href="<?php echo base_url('user/reviews')?>">Reviews</a></li>
        <li><a href="<?php echo base_url('user/references')?>">References</a></li>
    </ul>
</div>
<a class="btn btn-default btn-block" href="<?php echo base_url('home/viewProfile/'.$userProfileInfo->id)?>">View Profile</a>