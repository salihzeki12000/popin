<?php $stepData = $this->session->userdata('stepData'); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner24">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Review <?= SITE_DISPNAME; ?>’s professional requirements</h3>
                    <p>All <?= SITE_DISPNAME; ?> professionals must submit the following to rent:</p>
                    <ul>
                        <li>Profile photo</li>
                        <li>Confirmed email</li>
                        <li>Confirmed phone number</li>
                        <li>Payment information</li>
                    </ul>
                    <p>Professionals must also do the following before they can rent:</p>
                    <ul>
                        <li>Agree to your Space Rules</li>
                        <li>Send you a message about their business</li>
                        <li>Tell you how many people are using workspaces</li>
                        <li>Confirm their pop-in time if they're coming the following day</li>
                        <li>Proof of liability insurance</li>
                        <li>Confirm their pop-in time if they're coming the following day or sooner</li>
                    </ul>
                    <p>Add more professional requirements</p>
                    <form class="listing-form" action="<?php echo site_url('Space/professional_requirements'); ?>" method="post">
                        <?php $spaces = unserialize(REQUIREMENTS); 
                        foreach($spaces as $k=>$v){ ?>
                        <div class="feild">
                            <label for="requirement_<?= $k; ?>">
                                <input id="requirement_<?= $k; ?>" type="checkbox" name="requirements[]" value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page1']['requirements']) && !empty($stepData['step3']['page1']['requirements']) && in_array($k, $stepData['step3']['page1']['requirements']))? 'checked' : ''?>> <?= $v; ?>
                            </label>
                        </div>
                        <?php } ?>
                        <p>More requirements can mean fewer rentals</p>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/become-a-partner/'.$stepData['id']); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit" name="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <h5>You need to feel confident with every reservation. That’s why we require certain information from every professional before they can rent.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $("form.listing-form").submit(function(e){
        e.preventDefault();
        $(this).find('button').text('Please wait...');
        $.post($(this).attr('action'), $(this).serialize(), function(){
            $('form.listing-form button').text('Next');
            window.location.href = "<?= site_url('Space/rules'); ?>";
        });
    });
</script>
</body>
</html>