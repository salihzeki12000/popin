<?php $stepData = $this->session->userdata('stepData'); ?>
<section class="middle-container new-partner5 new-partner13 new-partner23">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-6 hi-cassiday">
                <h3>Last step!</h3>
                <p>Let’s set up your pricing and figure out your renting calender.</p>
                <div class="step">
                    <strong>STEP 1</strong>
                    <h5>Establishment, workspaces, amenities and more</h5>
                    <a href="<?php echo site_url('Space/establishment'); ?>">Change</a>
                </div>
                <div class="step">
                    <strong>STEP 2</strong>
                    <h5>Photos, short description, title</h5>
                    <a href="<?php echo site_url('Space/photos'); ?>">Change</a>
                </div>
                <div class="step">
                    <strong>STEP 3</strong>
                    <h5>Rent settings, calendar, price</h5>
                    <a href="<?php echo site_url('Space/professional-requirements'); ?>">Change</a>
                </div>
                <?php if(isset($stepData['status']) && strtolower($stepData['status']) == "pending"): ?>
                <div class="step step2" style="border-bottom: none;">
                    <a href="<?php echo site_url('Space/publish-listing'); ?>" class="green-btn">Continue</a>
                </div>
                <?php endif; ?>
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
<script type="text/javascript">
    
</script>
</body>
</html>