<section class="middle-container new-partner5 new-partner13">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-6 hi-cassiday">
                <h3>Great progress, <?php echo $hostProfileInfo->firstName; ?>!</h3>
                <p>Now let’s get some details about your business so you can publish your listing.</p>
                <div class="step">
                    <strong>STEP 1</strong>
                    <h5>Workspaces, bathrooms, amenities and more</h5>
                    <a href="<?php echo site_url('Space/establishment'); ?>">Change</a>
                </div>
                <div class="step step2">
                    <strong>STEP 2</strong>
                    <h3>Establish Esthetic</h3>
                    <p>Photos, short description, title</p>
                    <a href="<?php echo site_url('Space/photos'); ?>" class="btn-red">Continue</a>
                </div>
                <div class="step step3">
                    <strong>STEP 3</strong>
                    <h3>Get ready for professionals</h3>
                    <p>Rent settings, calendar, price</p>
                </div>
            </div>
        </div>
    </div>
    <div class="for-one">
        <img src="<?php echo base_url('theme/front/assests/img/blub.png')?>" alt="" />
        <p>For one week in Fullerton you could earn:</p>
        <div class="price">$180</div>
        
    </div>
</section>
<style type="text/css">
    .new-partner13 .step2 h3 {
        font-size: 22px;
        line-height: 18px;
        margin-bottom: 10px;
    }
</style>
</body>
</html>