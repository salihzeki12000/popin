<?php $stepData = $this->session->userdata('stepData'); //echo "<pre>"; print_r($stepData); echo "</pre>";?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
        40% Complete 
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner24 new-partner29">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Review your professional requirements</h3>
                    <div class="popln-pro">
                        <p><?= SITE_DISPNAME; ?>’s professional requirements</p>
                        <ul>
                            <li>Profile photo</li>
                            <li>Confirmed email</li>
                            <li>Confirmed phone number</li>
                            <li>Payment information</li>
                            <li>A message about the professional’s rental</li>
                            <li>Check-in time for last minute rentals</li>
                        </ul>
                        <a class="btn btn-defalut" href="<?= site_url('Space/professional-requirements'); ?>">Review</a>
                    </div>
                    <div class="popln-pro">
                        <p class="grey-color">Your additional requirements</p>
                        <?php if(isset($stepData['step3']['page1']['requirements']) && empty($stepData['step3']['page1']['requirements'])){ ?>
                        <p class="mr0">No additional requirements</p>
                        <?php }else{ ?>
                        <ul>
                        <?php $spaces = unserialize(REQUIREMENTS); 
                        foreach($spaces as $k=>$v){ if(in_array($k, $stepData['step3']['page1']['requirements'])){ ?>
                            <li><?= $v; ?></li>
                        <?php }} ?>
                        </ul>
                        <?php } ?>
                        <a class="btn btn-defalut" href="<?= site_url('Space/professional-requirements'); ?>">Edit</a>
                    </div>
                    <div class="popln-pro">
                        <p>Your Space Rules</p>
                        <ul>
                        <?php if(isset($stepData['step3']['page2']['ageRequirements']) && $stepData['step3']['page2']['ageRequirements'] == "No"){ ?>
                            <li>No age requirement for professionals</li>
                        <?php }elseif(isset($stepData['step3']['page2']['ageLimit']) && !empty($stepData['step3']['page2']['ageLimit'])){ ?>
                            <li>Minimum age requirement for professionals is <?= $stepData['step3']['page2']['ageLimit']; ?></li>
                        <?php } ?>

                        <?php if(isset($stepData['step3']['page2']['displayLicence']) && $stepData['step3']['page2']['displayLicence'] == "Yes"){ ?>
                            <li>Display License or Certificate in workspace</li>
                        <?php }else{ ?>
                            <li>Don't display License or Certificate in workspace</li>
                        <?php } ?>

                        <?php if(isset($stepData['step3']['page2']['suitablePets']) && $stepData['step3']['page2']['suitablePets'] == "Yes"){ ?>
                            <li>Suitable for pets</li>
                        <?php }else{ ?>
                            <li>Not suitable for pets</li>
                        <?php } ?>

                        <?php if(isset($stepData['step3']['page2']['eventPartiesAllowed']) && $stepData['step3']['page2']['eventPartiesAllowed'] == "Yes"){ ?>
                            <li>Events or parties are allowed</li>
                        <?php }else{ ?>
                            <li>Events or parties are not allowed</li>
                        <?php } ?>
                        </ul>
                        
                        <?php if(isset($stepData['step3']['page2']['additionalRules']) && !empty($stepData['step3']['page2']['additionalRules'])){ ?>
                        <p class="grey-color">Your additional space rules</p>
                        <ul>
                        <?php  foreach($stepData['step3']['page2']['additionalRules'] as $additionalRules){ ?>
                            <li><?php echo $additionalRules; ?></li>
                        <?php } ?>
                        </ul>
                        <?php } ?>
                        <a class="btn btn-defalut" href="<?= site_url('Space/rules'); ?>">Edit</a>
                    </div>
                    <?php if(isset($stepData['step3']['page3']['cleanUpProcedures']) && !empty($stepData['step3']['page3']['cleanUpProcedures'])){ ?>
                    <div class="popln-pro">
                        <p>Clean up procedures</p>
                        <ul>
                        <?php  foreach($stepData['step3']['page3']['cleanUpProcedures'] as $cleanUpProcedures){ ?>
                            <li><?php echo $cleanUpProcedures; ?></li>
                        <?php } ?>
                        </ul>                        
                    </div>
                    <?php } ?>
                    <div class="next-prevs clearfix">
                        <div class="pull-left">
                            <a class="gost-btn" href="<?= site_url('Space/cleanup-procedures'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="pull-right">
                            <a class="green-btn" href="<?= site_url('Space/review-how-professional-book'); ?>">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
</body>
</html>