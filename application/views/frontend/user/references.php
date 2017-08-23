<section class="middle-container account-section profile-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <?php $this->load->view('frontend/include/profile-sidebar'); ?>
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
                                        <p><strong><?= SITE_DISPNAME; ?> is built on trust and reputation.</strong> You can request references from your personal network, and the references will appear publicly on your <?= SITE_DISPNAME; ?> profile to help other members get to know you.</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="2">
                            <div class="panel-group">
                                <div class="panel panel-default reviews">
                                    <div class="panel-heading">Pending Approval</div>
                                    <div class="panel-body">
                                        <p>When you accept a reference it will appear on your public profile. If you ignore a reference it will not appear in your profile, and the other person will not be notified.</p>
                                        <p class="font12">No pending references</p>
                                    </div>
                                </div>
                                <div class="panel panel-default reviews">
                                    <div class="panel-heading">Past References Written About You</div>
                                    <div class="panel-body">
                                        <p>References require profile photos. A reference will only display in your public profile if the member who wrote it has a profile picture.</p>
                                        <p class="font12">No one has written you a reference yet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="3">
                            <div class="panel-group">
                                <div class="panel panel-default reviews">
                                    <div class="panel-heading">Reference Requests</div>
                                    <div class="panel-body">
                                        <p>Write references only for people you know well enough to recommend to the <?= SITE_DISPNAME; ?> Community. If you ignore a request the other person will not be notified.</p>
                                        <p class="font12">No reference requests</p>
                                    </div>
                                </div>
                                <div class="panel panel-default reviews">
                                    <div class="panel-heading">Past References You've Written</div>
                                    <div class="panel-body">
                                        <p class="font12">You have not written a reference for anyone yet</p>
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