<?php $stepData = $this->session->userdata('stepData');//print_r($stepData); ?>
<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width:95%">
        95% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner39 new-partner40">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Additional pricing</h3>
                    <p>Discount for longer rentals</p>
                    <form class="listing-form" action="<?php echo site_url('Space/additional-pricing'); ?>" method="post">
                        <div class="feild">
                            <label>Daily discount</label>
                            <input type="text" class="textbox" name="page8[daily_discount]" maxlength="3" placeholder="0% off" value="<?php echo isset($stepData['step3']['page8']['daily_discount'])?  $stepData['step3']['page8']['daily_discount'] : ''?>" />
                            <a href="#" data-target="page8[daily_discount]" data-amount="33"><p><span class="green"><strong>Tip: 33% Set</strong> <i class="fa fa-question-circle" aria-hidden="true"></i></span></p></a>
                        </div>
                        <div class="feild">
                            <label>Weekly discount</label>
                            <input type="text" class="textbox" name="page8[weekly_discount]" maxlength="3" placeholder="0% off" value="<?php echo isset($stepData['step3']['page8']['weekly_discount'])?  $stepData['step3']['page8']['weekly_discount'] : ''?>" />
                            <a href="#" data-target="page8[weekly_discount]" data-amount="65"><p><span><strong>Tip: 65% Set</strong> <i class="fa fa-question-circle" aria-hidden="true"></i></span></p></a>
                            
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/cancellation-policy'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <h5>Discount for longer rentals</h5>
                    <p>To encourage longer rentals, some owners set a daily or weekly discount. if you want your listing to appear in searches for reservations of 5 days or more, set a weekly discount.</p>
                    <p>Daily discounts will apply to any reservation of 8 or more hours.</p>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $(document).on('click', 'a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target'),
                amount = $(this).data('amount');
                
            $("input[name='"+target+"']").val(amount);//show target
    });
    $('form.listing-form').validate({
        rules: {
            'page8[daily_discount]' :{ required:true,min: 0,max: 100},
            'page8[weekly_discount]' :{ required:true,min: 0,max: 100}
        },
        submitHandler: function(form) {  
            $('form button').text('Please wait...');
            $.post(form.action, $(form).serialize(), function(){
                $(form).find('button').text('Next');
                window.location.href = "<?= site_url('Space/booking-scenarios'); ?>";
            });
        }
    });
</script>
</body>
</html>