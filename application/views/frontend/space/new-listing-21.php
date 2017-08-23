<?php $stepData = $this->session->userdata('stepData'); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:45%">
        45% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner24 new-partner31">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Successful hosting starts with your calender</h3>
                    <p>Professionals will book available days instantly. Only get booked when you can he by keeping your calendar and availability settings up-to-date.</p>
                    <p>Canceling disrupts professional's schedules. If you cancel because your calendar is inaccurate, you'll be charged a penalty fee and the times won't be available for anyone else to rent.</p>
                    <form method="post" action="<?php echo site_url('Space/hosting_terms'); ?>">
                        <div class="feild">
                            <label for="user_preference">
                                <input id="user_preference" type="checkbox" name="acceptHostingTerms" <?php echo isset($stepData['step3']['acceptHostingTerms'])&&$stepData['step3']['acceptHostingTerms']==1? 'checked' : ''?>> I understand! I'll keep my calender up to date.
                            </label>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?= site_url('Space/review-how-professional-book'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="green-btn">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <h5>To prevent scheduling mishaps, we offer a service to manage your calendar for a small monthly fee. <br>This will allow you to.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<script>
$('form').validate({
    rules: {
        acceptHostingTerms :{ required:true}
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element.parent());
    },
    submitHandler: function(form) {  
        $(form).find('button').text('Please wait...');
        $.post(form.action, $(form).serialize(), function(){
            $(form).find('button').text('Next');
            window.location.href = "<?= site_url('Space/availability-questions'); ?>";
        });        
    }
});
</script>
</body>
</html>