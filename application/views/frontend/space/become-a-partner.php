<?php $stepData = $this->session->userdata('stepData'); ?>
<section class="middle-container new-partner5 new-partner13">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-6 hi-cassiday">
                <h2>Hi, <?php echo $hostProfileInfo->firstName; ?>! Let’s get your <br/>listing ready to start renting <br/>your space.</h2>
                <div class="step step1">
                    <strong>STEP 1</strong>
                    <h5>Establishment, workspaces, amenities and more</h5>
                    <a href="<?php echo site_url('Space/establishment'); ?>">Change</a>
                </div>
                <div class="step step2">
                    <strong>STEP 2</strong>
                    <h3>Establish Esthetic</h3>
                    <p>Photos, short description, title</p>
                </div>
                <div class="step step3">
                    <strong>STEP 3</strong>
                    <h3>Get ready for professionals</h3>
                    <p>Rent settings, calendar, price</p>
                </div>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
    .new-partner13 .step2 h3 {
        font-size: 22px;
        line-height: 18px;
        margin-bottom: 10px;
        color: #b7b7b7;
    }
</style>
</body>
</html>