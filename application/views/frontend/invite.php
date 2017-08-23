<?php
if(!empty($userProfileInfo->avatar)){
    $user_profile_photo = base_url('uploads/user/'.$userProfileInfo->avatar);
}else{
    $user_profile_photo = base_url('uploads/user/user_pic-225x225.png');
}
$getAmount = getSingleRecord('settings','id','1');
?>
<script type="text/javascript">
$(document).ready(function(){
   $("#message_notification").fadeOut(4000);
});
</script>
<div class="referrals-app">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 text-center">
                <img class="profile-photo image-round" src="<?php echo $user_profile_photo; ?>" alt="avatar" />
                <h2>Join the 2 million people who have earned referral credit on Popln</h2>
                <p>When a colleague rents on Popln, you get <?= getCurrency_symbol($userProfileInfo->currency); ?><?= number_format($getAmount->join_amount);?> in rental credit. When they welcome their first professional, you get <?= getCurrency_symbol($userProfileInfo->currency); ?><?= number_format($getAmount->referral_credit_amount);?> in rental credit.</p>
            </div>
        </div>
    </div>
</div>
<section class="middle-container">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10 share-box">
   <?php if ($this->session->flashdata('message_notification')) { ?>
    <!-- Message Notification Start -->
    <div id="message_notification">
        <div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
            <button class="close" data-dismiss="alert" type="button">×</button>
            <center><strong><?= $this->session->flashdata('message_notification'); ?></strong></center>
        </div>
    </div>
    <!-- Message Notification End -->
   <?php } ?>
                <form  method="post" action="<?php echo site_url('dashboard/send_invitation'); ?>">
                    <span id="errorMessage" style="color:red;"></span>
                    <div class="input-group">
                        <input type="text" class="form-control" name="contacts" placeholder="*Enter multiple email addresses seperated by commas." >
                        <input type="hidden" name="link" value="<?= site_url('referral/'.$userProfileInfo->referalLink); ?>">
                        <span class="input-group-btn">
                          <button class="btn btn-default" id="sendInvitation" type="sumbit">Send Invites</button>
                        </span>
                    </div><!-- /input-group -->
                </form>
                <div class="or-separator"><span class="or-separator--text"><span>or</span></span><hr></div>
                <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <label class="float-row-item input-large" for="share-link" data-reactid="92"><span data-reactid="93">Share Your Link:</span></label>
                        <div class="input-group">
                            <input type="text" id="share-link" class="form-control" value="<?= site_url('referral/'.$userProfileInfo->referalLink); ?>" readonly="">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="copy" type="button" onclick="copyToClipboard(this.id, '#share-link')">Copy</button>
                            </span>
                        </div><!-- /input-group -->
                </div>
            </div>
        </div>
    </div>    
</section>
<div class="container">
<h3 style="text-align: center;" >You'v got <span><?php echo getCurrency_symbol($userProfileInfo->currency).number_format((!empty($userProfileInfo->referalAmount)?$userProfileInfo->referalAmount:'000')); ?></span> in rental credit to spend !</h3><br>
<?php 
   $getResult = getMultiRecord('join_account_master','provide_link_userID',$userProfileInfo->id);
   
   if (!empty($getResult)) {
       foreach ($getResult as $key => $value) {
           $user = getSingleRecord('user','id',$value['activate_link_userID']);
      // print_r($user->firstName);       
            ?>
        <table class="table">
            <tbody>
              <tr>
                <td align="left" style="width:10%;"><img style="width: 55px;" class="profile-photo image-round" src="<?php echo base_url().'uploads/user/'.(!empty($user->avatar)?$user->avatar:'user_pic-225x225.png'); ?>" alt="avatar" /></td>
                <td align="left" style="width:70%;" ><?php echo $user->firstName.' '.$user->lastName;?></td>
                <td align="right" style="width:20%;" ><?= getCurrency_symbol($userProfileInfo->currency).number_format($getAmount->join_amount).'  '.$user->status; ?></td>
              </tr>
            </tbody>
        </table>
   <?php    }
   }
 ?>
</div>
<script>
function copyToClipboard(id, element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).val()).select();
  document.execCommand("copy");
  $temp.remove();
  $("#"+id).text("Copied!");
}
$('#sendInvitation').click(function(){
    var email = $('input[name="contacts"]').val();
    if (email == '') {
        $('#errorMessage').text('Email cannot be empty');
        return false;
    }
});
$('input[name="contacts"]').keyup(function(){
    $('#errorMessage').text(' ');
})
</script>