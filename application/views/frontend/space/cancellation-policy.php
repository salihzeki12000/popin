<?php $stepData = $this->session->userdata('stepData');//print_r($stepData); ?>
<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%">
        90% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner39">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Cancellation policy</h3>
                    <p>Choose a policy below: </p>
                    <form class="listing-form" action="<?php echo site_url('Space/cancellation_policy'); ?>" method="post" autocomplete="off">
                        <div class="feild">
                            <select class="selectbox custom-select" name="cancellation_term">
                                <option value="" disabled=""  <?php echo (!isset($stepData['step3']['cancellation_term']) || $stepData['step3']['cancellation_term'] == 0)? 'selected' : ''?>>- Select -</option>
                                <?php
                                 foreach($cancellation_policies as $cancellation_policy) { ?>
                                 <option value="<?= $cancellation_policy['id']; ?>" <?php echo (isset($stepData['step3']['cancellation_term']) && $stepData['step3']['cancellation_term'] == $cancellation_policy['id'])? 'selected' : ''?>><?= $cancellation_policy['term']; ?> (<?= $cancellation_policy['description']; ?>)</option>
                                 <?php } ?>
                            </select>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/price-settings'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <h5>Cancellation policies</h5>
                    <p><?= SITE_DISPNAME; ?> allows partners to choose a cancellation policy that fits their situation while also protecting professionals and partners from rental cancellations.</p>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $('form.listing-form').validate({
        rules: {
            cancellation_term :{ required:true}
        },
        submitHandler: function(form) {  
            $('form button').text('Please wait...');
            $.post(form.action, $(form).serialize(), function(){
                $(form).find('button').text('Next');
                window.location.href = "<?= site_url('Space/additional-pricing'); ?>";
            });
        }
    });
</script>
</body>
</html>