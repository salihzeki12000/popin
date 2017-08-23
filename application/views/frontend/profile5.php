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
													<li><a href="<?php echo base_url()?>Profile">Edit Profile</a></li>
													<li><a href="<?php echo base_url()?>Profile/Profile2">Photos and Video</a></li>
													<li><a href="<?php echo base_url()?>Profile/Profile3">Trust and Verification</a></li>
													<li><a href="<?php echo base_url()?>Profile/Profile4">Reviews</a></li>
													<li  class="active"><a href="<?php echo base_url()?>Profile/Profile5">References</a></li>
											</ul>
                    </div>
                    <a class="btn btn-default btn-block" href="#">View Profile</a>
                </aside>
                <article class="col-lg-9 main-right">
                    <div id="exTab2">
                        <ul class="nav nav-tabs mr20">
                            <li class="active"><a href="#1" data-toggle="tab">Request References</a></li>
                            <li><a href="#2" data-toggle="tab">References About You</a></li>
                            <li><a href="#3" data-toggle="tab">References By You</a></li>
                        </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="1">
                            <div class="panel-group">
                                <div class="panel panel-default reviews">
                                    <div class="panel-body">
                                        <p>Popln is built on trust and reputation. You can request references from your personal network, and the references will appear publicly on your Airbnb profile to help other members get to know you.</p>
                                        <p>You should only request references from people who know you well.</p>
                                    </div>
                                </div>
                                <div class="panel panel-default reviews popln-friends">
                                    <div class="panel-heading">Popln Friends (NOT NECESSARY YET)</div>
                                    <div class="panel-body">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                  <img class="media-object" src="<?php echo base_url('theme/front/assests/img/face-book.jpg')?>" alt="facebook">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <p>Connect your Facebook account to see which of your friends are on Popln. You will be able to request references from them here.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="2">
                            <div class="panel-group">
                                <div class="panel panel-default reviews">
                                    <div class="panel-body">
                                        <p>Popln is built on trust and reputation. You can request references from your personal network, and the references will appear publicly on your Airbnb profile to help other members get to know you.</p>
                                        <p>You should only request references from people who know you well.</p>
                                    </div>
                                </div>
                                <div class="panel panel-default reviews popln-friends">
                                    <div class="panel-heading">Popln Friends (NOT NECESSARY YET)</div>
                                    <div class="panel-body">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                  <img class="media-object" src="<?php echo base_url('theme/front/assests/img/face-book.jpg')?>" alt="facebook">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <p>Connect your Facebook account to see which of your friends are on Popln. You will be able to request references from them here.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="3">
                            <div class="panel-group">
                                <div class="panel panel-default reviews">
                                    <div class="panel-body">
                                        <p>Popln is built on trust and reputation. You can request references from your personal network, and the references will appear publicly on your Airbnb profile to help other members get to know you.</p>
                                        <p>You should only request references from people who know you well.</p>
                                    </div>
                                </div>
                                <div class="panel panel-default reviews popln-friends">
                                    <div class="panel-heading">Popln Friends (NOT NECESSARY YET)</div>
                                    <div class="panel-body">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                  <img class="media-object" src="<?php echo base_url('theme/front/assests/img/face-book.jpg')?>" alt="facebook">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <p>Connect your Facebook account to see which of your friends are on Popln. You will be able to request references from them here.</p>
                                            </div>
                                        </div>
                                    </div>
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
