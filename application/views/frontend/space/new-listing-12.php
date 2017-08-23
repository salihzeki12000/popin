<?php $stepData = $this->session->userdata('stepData'); ?>
<?php if(isset($stepData['step2']['fileuploader'])){ $percentage = 60; $percentageText = $percentage."% Complete"; ?>
<?php }else{ $percentage = 20; $percentageText = $percentage."% Complete"; }?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage; ?>%">
        <?= $percentageText; ?>
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner18">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Name your space</h3>
                    <form method="post" action="<?php echo site_url('space/title_submit'); ?>" autocomplete="off">
                        <div class="feild">
                            <input type="text" name="page4[spaceTitle]" class="textbox" placeholder="Listing Title" value="<?= isset($stepData['step2']['page4']['spaceTitle'])? $stepData['step2']['page4']['spaceTitle']:''; ?>" />
                        </div>
                        <div class="feild">
                            <input type="text" name="page4[businessName]" class="textbox" placeholder="Business Name" value="<?= (isset($stepData['step2']['page4']['businessName']) && !empty($stepData['step2']['page4']['businessName']))? $stepData['step2']['page4']['businessName']:$hostProfileInfo->businessName; ?>" />
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/space-description'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <h5>You can simply use your business name or make your own name for each workspace you are listing. We recommend haying unique names for each workspace to make it easier to manage Some examples include naming them alphabetically or using street names.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $('form').validate({
        rules: {
            'page4[spaceTitle]' :{ required:true},'page4[businessName]' :{ required:true}
        },
        submitHandler: function(form) {
            $('form button').text('Please wait...');
            $.post(form.action, $(form).serialize(), function(){
                $('form button').text('Next');
                window.location.href = "<?= site_url('Space/profile-photo'); ?>";
            });
        }
    });
</script>
</body>
</html>