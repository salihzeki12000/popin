<?php $stepData = $this->session->userdata('stepData');//print_r($stepData); ?>
<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
        100% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner25 new-partner30 new-partner41">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Based on your settings, here’s what you could expect</h3>
                    <div class="pro-find">
                        <img src="<?php echo base_url('theme/front/img/40img1.png')?>" alt="" />
                        <?php
                        $todayDate = date("Y-m-d");
                        if(isset($stepData['step3']['calendar'])){
                            if(isset($stepData['step3']['calendar']['available_dates']) && !empty($stepData['step3']['calendar']['available_dates'])){
                                $startDate = date("F d, Y", strtotime($stepData['step3']['calendar']['available_dates'][0]));
                            }else{
                                $startDate = date("F d, Y", strtotime($todayDate));
                            }
                        }else{
                            $startDate = date("F d, Y", strtotime($todayDate));
                        }
                        ?>
                        <p><strong>You’re available to rent starting <?= $startDate; ?>.</strong></p>
                        <p>Finley is planning her work day and thinks your workspace is perfect.</p>
                    </div>
                    <div class="pro-find">
                        <img src="<?php echo base_url('theme/front/img/40img2.png')?>" alt="" />
                        <p><strong>Professionals who meet PopIn requirements can instantly rent.</strong></p>
                        <p>In addition to meeting professional requirements, Finley agrees to your Space Rules.</p>
                    </div>
                    <div class="pro-find">
                        <img src="<?php echo base_url('theme/front/img/40img3.png')?>" alt="" />
                        <p><strong>Professionals send a message with their rental confirmation.</strong></p>
                        <p>Finley says she’ll be working for 4 hours and would love to rent your workspace.</p>
                    </div>
                    <div class="pro-find">
                        <img src="<?php echo base_url('theme/front/img/40img4.png')?>" alt="" />
                        <p><strong>Welcome professionals to your space!.</strong></p>
                        <p>Before Finley arrives coordinate details like check-in time and clean up procedures.</p>
                    </div>
                    <div class="next-prevs clearfix">
                        <div class="pull-left">
                            <a class="gost-btn" href="<?php echo site_url('Space/additional-pricing'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="pull-right">
                            <a class="green-btn" href="<?php echo site_url('Space/local-laws'); ?>">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
</body>
</html>