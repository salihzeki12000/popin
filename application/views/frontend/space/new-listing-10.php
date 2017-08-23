<?php $stepData = $this->session->userdata('stepData'); ?>
<?php if(isset($stepData['step2']['fileuploader'])){ $percentage = 40; $percentageText = $percentage."% Complete"; ?>
<?php }else{ $percentage = 0; $percentageText = ""; }?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage; ?>%">
        <?= $percentageText; ?>
    </div>
</div>
<section class="middle-container new-partner6 new-partner16">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Start creating your description</h3>
                    <form method="post" action="<?php echo site_url('space/description_submit'); ?>" autocomplete="off">
                        <div class="feild">
                            <input type="text" class="textbox" name="page2[businessClose]" placeholder="My business is close to" value="<?= isset($stepData['step2']['page2']['businessClose'])?$stepData['step2']['page2']['businessClose']:''; ?>" />
                        </div>
                        <div class="feild">
                            <input type="text" class="textbox" name="page2[loveWorkSpace]" placeholder="You’ll love my workspaces because of" value="<?= isset($stepData['step2']['page2']['loveWorkSpace'])?$stepData['step2']['page2']['loveWorkSpace']:''; ?>" />
                        </div>
                        <div class="feild">
                            <textarea class="textarea" name="page2[productCarried]" placeholder="Products carried in my business (optional)"><?= isset($stepData['step2']['page2']['productCarried'])?$stepData['step2']['page2']['productCarried']:''; ?></textarea>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/photos'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <h5>This description will appear at the top of your listing page. We have selected common questions professionals have when looking for a workspace. You can edit and write more next. </h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $('form').validate({
        rules: {
            'page2[businessClose]' :{ required:true},
            'page2[loveWorkSpace]' : { required:true}
        },
        submitHandler: function(form) {
            $('form button').text('Please wait...');
            $.post(form.action, $(form).serialize(), function(){
                $('form button').text('Next');
                window.location.href = "<?= site_url('Space/space-description'); ?>";
            });
        }
    });
</script>
</body>
</html>