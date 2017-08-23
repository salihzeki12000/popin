<?php $stepData = $this->session->userdata('stepData');//print_r($stepData); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
        50% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner32">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Let’s get started with a couple questions</h3>
                    <form class="listing-form" action="<?php echo site_url('Space/availability_questions'); ?>" method="post">
                        <div class="feild">
                            <p>Have you rented out your space before?</p>
                            <select class="selectbox custom-select" name="page5[everRented]">
                                <option selected="selected" disabled>Select one</option>
                                <option value="Yes" <?php echo (isset($stepData['step3']['page5']['everRented']) && $stepData['step3']['page5']['everRented'] == 'Yes')? 'selected' : ''?>>Yes</option>
                                <option value="No" <?php echo (isset($stepData['step3']['page5']['everRented']) && $stepData['step3']['page5']['everRented'] == 'No')? 'selected' : ''?>>No</option>
                            </select>
                        </div>
                        <div class="feild">
                            <p>How often do you want to have professionals?</p>
                            <select class="selectbox custom-select" name="page5[haveProffesionals]">
                                <option selected="selected" disabled>Select one</option>
                                <option value="Not sure yet" <?php echo (isset($stepData['step3']['page5']['haveProffesionals']) && $stepData['step3']['page5']['haveProffesionals'] == 'Not sure yet')? 'selected' : ''?>>Not sure yet</option>
                                <option value="Part-time" <?php echo (isset($stepData['step3']['page5']['haveProffesionals']) && $stepData['step3']['page5']['haveProffesionals'] == 'Part-time')? 'selected' : ''?>>Part-time</option>
                                <option value="As often as possible" <?php echo (isset($stepData['step3']['page5']['haveProffesionals']) && $stepData['step3']['page5']['haveProffesionals'] == 'As often as possible')? 'selected' : ''?>>As often as possible</option>
                            </select>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/hosting-terms'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <h5>Based on your responses, we can recommend specific availability settings for you.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $('form').validate({
        rules: {
            'page5[everRented]' :{ required:true},
            'page5[haveProffesionals]' :{ required:true}
        },
        submitHandler: function(form) {  
            $('form button').text('Please wait...');
            $.post(form.action, $(form).serialize(), function(){
                $('form.listing-form button').text('Next');
                window.location.href = "<?= site_url('Space/availability-settings'); ?>";
            });
        }
    });
</script>
</body>
</html>