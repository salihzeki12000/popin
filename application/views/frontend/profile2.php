<?php
	$this->load->view('frontend/include/header');
?>

<section class="middle-container account-section profile-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <div class="sidenav-list">
											<ul>
													<li ><a href="<?php echo base_url()?>Profile">Edit Profile</a></li>
													<li class="active"><a href="<?php echo base_url()?>Profile/Profile2">Photos and Video</a></li>
													<li><a href="<?php echo base_url()?>Profile/Profile3">Trust and Verification</a></li>
													<li><a href="<?php echo base_url()?>Profile/Profile4">Reviews</a></li>
													<li><a href="<?php echo base_url()?>Profile/Profile5">References</a></li>
											</ul>
                    </div>
                    <a class="btn btn-default btn-block" href="#">View Profile</a>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default profile-photo">
                            <div class="panel-heading">Profile Photo</div>
                            <div class="panel-body">
                                <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="<?php echo base_url('theme/front/assests/img/user_pic-225x225.png')?>" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p>Clear frontal face photos are an important way for hosts and guests to learn about each other. It’s not much fun to host a landscape! Please upload a photo that clearly shows your face.</p>
                                    <label class="btn btn-default btn-file"> Upload a file <input type="file" style="display: none;"></label>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<?php
	$this->load->view('frontend/include-partner/footer');
?>
<script type="text/javascript">
$(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});
</script>
</body>
</html>
