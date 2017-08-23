<?php $stepData = $this->session->userdata('stepData'); ?>
<?php if(isset($stepData['step2']['fileuploader'])){ $percentage = 50; $percentageText = $percentage."% Complete"; ?>
<?php }else{ $percentage = 10; $percentageText = $percentage."% Complete"; }?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage; ?>%">
        <?= $percentageText; ?>
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner17">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Edit your description</h3>
                    <form method="post" action="<?php echo site_url('space/space_description_submit'); ?>" autocomplete="off">
                        <div class="feild">
                            <?php
                            $short_desc = "";
                            if(isset($stepData['step2']['page2'])){
                                $short_desc = "My business is close to {$stepData['step2']['page2']['businessClose']}. You'll love my workspace because of {$stepData['step2']['page2']['loveWorkSpace']}. Products carried in my business {$stepData['step2']['page2']['productCarried']}.";
                            }elseif(isset($stepData['step2']['page3']['spaceDescription'])){
                                $short_desc = $stepData['step2']['page3']['spaceDescription'];
                            }
                            ?>
                            <textarea class="textarea" name="page3[spaceDescription]" placeholder="My business is close to Whole Foods, Brea Mall . You'll love my workspace because of the warm and inviting environment. My place is good for hairstylists."><?= $short_desc; ?></textarea>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/description'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <h5>Based on what you chose, this is your summary description. You can edit and change it as you wish. Keeping it brief makes it easier for professionals to read.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $('form').validate({
        rules: {
            'page3[spaceDescription]' :{ required:true}
        },
        submitHandler: function(form) {
            $('form button').text('Please wait...');
            $.post(form.action, $(form).serialize(), function(){
                $('form button').text('Next');
                window.location.href = "<?= site_url('Space/title'); ?>";
            });
        }
    });
</script>
</body>
</html>