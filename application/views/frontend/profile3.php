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
													<li><a href="<?php echo base_url()?>Profile/Profile2">Photos and Video</a></li>
													<li class="active"><a href="<?php echo base_url()?>Profile/Profile3">Trust and Verification</a></li>
													<li><a href="<?php echo base_url()?>Profile/Profile4">Reviews</a></li>
													<li><a href="<?php echo base_url()?>Profile/Profile5">References</a></li>
											</ul>
                    </div>
                    <a class="btn btn-default btn-block" href="#">View Profile</a>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default profile-photo mr20">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <strong>Be ready to book</strong>
                                        You’ll need to provide identification before you book, so get a head start by doing it now. Learn more
                                    </div>
                                    <div class="col-md-5 align-center">
                                        <button class="btn-red">Provide ID</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default verified-info">
                            <div class="panel-heading">Your verified info</div>
                            <div class="panel-body">
                                <h4>Email address</h4>
                                <p>You have confirmed your email: abc@gmail.com. A confirmed email is important to allow us to securely communicate with you.</p>
                            </div>
                        </div>
                        <div class="panel panel-default profile-photo verified-info">
                            <div class="panel-heading">Not yet verified</div>
                            <div class="panel-body">
                                <div class="row mr15">
                                    <div class="col-md-7">
                                        <h4>License / Certificate Copy</h4>
                                        Upload a copy of your license or certificate to avoid the hassle later.
                                    </div>
                                    <div class="col-md-5 align-center">
                                        <label class="btn btn-default btn-file"> Upload file <input style="display: none;" type="file"></label>
                                    </div>
                                </div>
                                <div class="row mr15">
                                    <div class="col-md-7">
                                        <h4>Establishment license</h4>
                                        If you are listing your space, verify ownership by providing us with your license
                                    </div>
                                    <div class="col-md-5 align-center">
                                        <label class="btn btn-default btn-file"> Upload file <input style="display: none;" type="file"></label>
                                    </div>
                                </div>
                                <div class="row mr15">
                                    <div class="col-md-7">
                                        <h4>Liabilty insurance</h4>
                                        Upload a copy of your liability insurance.
                                    </div>
                                    <div class="col-md-5 align-center">
                                        <label class="btn btn-default btn-file"> Upload file <input style="display: none;" type="file"></label>
                                    </div>
                                </div>
                                <h4>Phone number</h4>
                                <p>Make it easier to communicate with a verified phone number. We’ll send you a code by SMS or read it to you over the phone. Enter the code below to confirm that you’re the person on the other end.</p>
                                <p>Your number is only shared with another Airbnb member once you have a confirmed booking.</p>
                                <p>No phone number entered</p>
                                <p><a href="#">+ Add a phone number</a></p>
                                <div class="row mr15">
                                    <div class="col-md-7">
                                        <h4>Facebook</h4>
                                        Connect your Popln account to your Goole account for simplicity and ease.
                                    </div>
                                    <div class="col-md-5 align-center">
                                        <label class="btn btn-default btn-file"> Upload file <input style="display: none;" type="file"></label>
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
$(document).ready(function(){

});
</script>
</body>
</html>
