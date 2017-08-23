<?php $stepData = $this->session->userdata('stepData'); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
        20% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner11 new-partner25 new-partner28">
    <div class="container">
        <div class="row clearfix">
            <div class="col-sm-9">
                <div class="space-are">
                    <h3>Set clean up procedures for professionals</h3>
                    <form class="listing-form" action="<?php echo site_url('Space/cleanup_procedures'); ?>" method="post">
                        <div class="add-rules">
                            <div class="additional-rules">
                                <?php 
                                if(isset($stepData['step3']['page3']['cleanUpProcedures']) && !empty($stepData['step3']['page3']['cleanUpProcedures'])){ 
                                    foreach($stepData['step3']['page3']['cleanUpProcedures'] as $cleanUpProcedures){
                                ?>
                                <div class="append-div">
                                    <input class="textbox" name="cleanUpProcedures[]" value="<?= $cleanUpProcedures; ?>" type="text" readonly />
                                    <a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a>
                                </div>
                                <?php }} ?>
                            </div>
                            <div class="clearfix">
                                <span class="pull-left"><input id="rule-text" class="textbox" type="text" placeholder="Add clean up procedure rules"></span>
                                <span class="pull-left"><button class="red-btn" id="add-rule" type="button">Add</button></span>
                            </div>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/rules'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit" name="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--<div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="img/blub.png" alt="" />
                    <h5>Have an amenity that isn’t listed? Scroll down to the bottom of the list to add your own.</h5>
                </div>
            </div>-->
        </div>
    </div>    
</section>
<script type="text/javascript">
    $("form.listing-form").submit(function(e){
        e.preventDefault();
        $(this).find("button[type='submit']").text('Please wait...');
        $.post($(this).attr('action'), $(this).serialize(), function(){
            $("form.listing-form button[type='submit']").text('Next');
            window.location.href = "<?= site_url('Space/review-professional-requirements'); ?>";
        });
    });
    $('#add-rule').click(function(){
        var text = $('#rule-text').val();
        if(text.trim() !== ""){
            $('.additional-rules').append('<div class="append-div"><input class="textbox" name="cleanUpProcedures[]" value="'+text+'" type="text" readonly /><a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a></div>');
            $('#rule-text').val('');
        }
    });
    $(document).on('click','.cancel-rule',function(event){
        event.preventDefault();
        $(this).parent('div').remove();
    });
    $(document).on("keypress", "input#rule-text", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('add-rule').click();
        }
    });
</script>
</body>
</html>