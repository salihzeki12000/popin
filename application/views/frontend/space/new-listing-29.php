<?php $stepData = $this->session->userdata('stepData');//print_r($stepData); ?>
<section class="middle-container new-partner5 new-partner13 new-partner23 new-partner44">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-6 hi-cassiday">
                <h3>You’re ready to publish!</h3>
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
                <p>You’ll be able to welcome your first professional starting <?= $startDate; ?>. if you’d like to update your calender or space rules, you can easily do all that after you hit publish.</p>
                <div class="tow-btn">
                    <form method="post" action="<?php echo site_url('Space/publish-listing'); ?>">
                        <input type="hidden" value="<?= $stepData['id']; ?>" name="space_id">
                        <button class="green-btn" type="submit">Publish Listing</button> &nbsp;&nbsp;&nbsp;
                        <a href="<?php echo site_url('Space/become-a-partner/'.$stepData['id']); ?>">Edit Listing</a>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <div class="for-one">
        <div class="media">
            <div class="media-body media-middle">
                <h4 class="media-heading"><?= $stepData['step2']['page4']['spaceTitle']; ?></h4>
                <a target="_blank" href="<?php echo site_url('Space/preview-layout/'.$stepData['id']); ?>">Preview</a>
            </div>
            <div class="media-left">
                <a href="#">
                    <?php if(isset($stepData['step2']['gallery'])){ ?>
                        <img class="media-object" src="<?php echo base_url('uploads/user/gallery/'.$stepData['step2']['gallery'][0])?>" width="110" alt="...">
                    <?php }?>
                </a>
            </div>
        </div>
    </div>
</section>