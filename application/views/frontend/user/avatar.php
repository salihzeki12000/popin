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
<section class="middle-container account-section profile-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
<?php $this->load->view('frontend/include/profile-sidebar'); ?>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default profile-photo">
                            <div class="panel-heading">Profile Photo</div>
                            <form name="avatarProfile" id="avatarProfile" method="post" action="<?= base_url('user/submit_avatar'); ?>" enctype="multipart/form-data">
                                <div class="panel-body">
                                    <div class="media">
                                        <div class="media-left pdr0">
                                            <?php
                                            if ($userProfileInfo->avatar == '') {
                                                $avatar = 'user_pic-225x225.png';
                                            } else {
                                                $avatar = $userProfileInfo->avatar;
                                            }
                                            ?>

                                            <img class="media-object" id='userAvatar' src="<?php echo base_url('uploads/user/' . $avatar) ?>" height="150" width="150" alt="<?= $userProfileInfo->firstName; ?>">
                                        
                                            <div class="mt5 mr5 text-center">
                                                Rotate : <a href="#" class="rotate_img" value_id="Anti clockwise" data-rel="<?php echo $avatar; ?>"><i class="fa fa-undo" aria-hidden="true"></i></a> | <a href="#" class="rotate_img" value_id="Clockwise" data-rel="<?php echo $avatar; ?>"><i class="fa fa-repeat" aria-hidden="true"></i></a>                                               
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p>Clear frontal face photos are an important way for Professionals and Partners to learn about each other. It’s not much fun to Partners a landscape! Please upload a photo that clearly shows your face.</p>
                                            <input type="file" name='avatar' id="avatar"  onchange="readURL(this);">

                                        </div>
                                        <input type="hidden" name="oldAvatar" id="oldAvatar" value="<?= $userProfileInfo->avatar; ?>">
                                        <div class="pull-right"><input type="submit" name="submit" id="submit" class="green-btn" value="Replace Photo"></div>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?= site_url('assets/js/exif.js');?>"></script>
<script type="text/javascript">
    var imageElement = document.getElementById("userAvatar");
    EXIF.getData(imageElement, function() {
        alert(EXIF.pretty(this));
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#userAvatar').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function(e) {
        $(".rotate_img").click(function(event){
            event.preventDefault();
            rotate_value = $(this).attr("value_id");
            image_file = $(this).attr("data-rel");

            img_url = $("#userAvatar").attr("src");
            img_url_arr = img_url.split("?");
            
            $.ajax({
                url:"<?= site_url('profile/rotate_pic'); ?>",
                type:"post",
                data:{image_file:image_file, rotate_value:rotate_value},
                success:function(result){
                    d = new Date();				  

                    $("#userAvatar").attr("src", img_url_arr['0']+"?"+d.getTime());

                    img_url = $(".pro_img img").attr("src");
                    img_url_arr = img_url.split("?");
                    $(".pro_img img").attr("src", img_url_arr['0']+"?"+d.getTime());
                }
            });
        });
        $('#avatarProfile').validate({
            rules: {
                avatar	: 	{
                    <?php if ($userProfileInfo->avatar == '') { ?>
                    required: true,
                    <?php } ?>
                    accept	:	"jpg|png|jpeg|gif",
                }
            },
            messages : {
                avatar : {
                    <?php if ($userProfileInfo->avatar == '') { ?>
                    required: "Please Uplaod Your Avatar",
                    <?php } ?>
                    accept : "Allowed Image Types Are JPG, PNG, JPEG, GIF"
                }
            }
        });
    });
</script>