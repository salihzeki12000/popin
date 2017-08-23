<?php $stepData = $this->session->userdata('stepData'); ?>
<?php if(isset($stepData['step2']['fileuploader'])){ $percentage = 80; $percentageText = $percentage."% Complete"; $barClass="success"; ?>
<?php }else{ $percentage = 40; $percentageText = $percentage."% Complete"; $barClass="warning"; }?>
<div class="progress">
    <div class="progress-bar progress-bar-<?= $barClass; ?> progress-bar-striped" role="progressbar" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage; ?>%">
        <?= $percentageText; ?>
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner19">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Add your photo</h3>
                    <form action="<?php echo site_url('Space/profile_photo_submit'); ?>" method="post" enctype="multipart/form-data">
                        <div class="media">                        
                            <div id="without-avatar" <?php if(!empty($hostProfileInfo->avatar)){ echo "style='display: none;'"; }?>>
                                <div class="media-left">
                                    <a href="#"><img class="media-object" id="profile-pic" src="<?php echo base_url('theme/front/assests/img/user_pic-225x225.png')?>" alt="" /></a>
                                </div>
                                <div class="media-body">
                                    <input type="hidden" name="oldAvatar" value="<?= $hostProfileInfo->avatar; ?>">
                                    <label class="btn btn-default btn-file">
                                        <i class="fa fa-cloud-upload" aria-hidden="true"></i> 
                                        <input type="file" style="display: none;" name="avatar" onchange="readImageURL(this, 'profile-pic');"> Upload Photo
                                    </label>
                                </div>
                            </div>

                            <div id="with-avatar" <?php if(empty($hostProfileInfo->avatar)){ echo "style='display: none;'"; }?>>
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="<?php echo base_url('uploads/user/'.$hostProfileInfo->avatar)?>" alt="" />
                                    </a>
                                </div>
                                <div class="media-body media-middle">
                                    <p>Looking Good!</p>
                                    <a href="#" id="change-photo">Change photo</a>
                                </div>
                            </div>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?= site_url('Space/title'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <h5>Everyone on Pop In has a profile photo, including professionals. this way you know who's coming, and professionals know that they're dealing with a real person too.</h5>
                    <h5>Make sure the photo clearly shows your face.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $("a#change-photo").click(function(e){
        e.preventDefault();
        $("#without-avatar").show();
        $("#with-avatar").hide();
    }); 
    $("form").submit(function(e){
        e.preventDefault();
        $(this).find('button').text('Please wait...');

        $.ajax({
              url: $(this).attr('action'),
              type: "POST",
              data: new FormData(this),
              cache: false,
              processData: false,  // tell jQuery not to process the data
              contentType: false,   // tell jQuery not to set contentType
              success: function(response) {
                    $('form button').text('Next');
                    if(response != "")
                        alert(response);
                    else
                        window.location.href = "<?= site_url('Space/verify-phone'); ?>";
                }
        });
    });
    function readImageURL(input, target_id) {
        if (input.files && input.files[0] && (typeof FileReader !== "undefined")) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#' + target_id)
                    .attr('src', e.target.result)
                    .fadeIn('slow');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>