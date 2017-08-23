<link href="<?php echo base_url('theme/front/assests/css/btnswitch.css')?>" rel="stylesheet" type="text/css" />
<?php $stepData = $this->session->userdata('stepData'); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
        40% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner25 new-partner30">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Here’s how professionals will rent with you</h3>
                    <div class="pro-find">
                        <p>1. Professionals find your listing in search.</p>
                        <img src="<?php echo base_url('theme/front/assests/img/30img1.png')?>" alt="" />
                    </div>
                    <div class="pro-find">
                        <p>2. Professionals who meet your requirements can book available time without requirement approval.</p>
                        <img src="<?php echo base_url('theme/front/assests/img/30img2.png')?>" alt="" />
                    </div>
                    <div class="pro-find">
                        <p>3. You’ll get a message from professional about their rental, along with the reservation confirmation, how many clients they are meeting, and check-in time.</p>
                        <img src="<?php echo base_url('theme/front/assests/img/30img3.png')?>" alt="" />
                    </div>
                    <form class="listing-form" action="<?php echo site_url('Space/review_how_professional_book'); ?>" method="post">
                        <ul>
                            <li class="clearfix">
                                <div class="pull-left">
                                    <p>Require rental requests</p>
                                </div>
                                <div class="pull-right">
                                    <div class="demo1" id="a"></div>
                                    <input type="hidden" name="rentalRequests" id="rentalRequests" value="<?= isset($stepData['step3']['page4']['rentalRequests'])?$stepData['step3']['page4']['rentalRequests']:'No';?>">
                                </div>
                            </li>
                        </ul>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?= site_url('Space/review-professional-requirements'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</section>
<script src="<?php echo base_url('theme/front/assests/js/jquery-3.1.1.slim.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/btnswitch.js')?>" type="text/javascript"></script>
<script type="text/javascript">
    $('.demo1').btnSwitch({
        OnValue: "Yes",
        OffValue: "No",
        ToggleState: $("#rentalRequests").val(),
        HiddenInputId: "rentalRequests"
    });
</script>
</body>
</html>