<?php $stepData = $this->session->userdata('stepData');//print_r($stepData); ?>
<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
        80% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner39">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Base price</h3>
                    <p>Your base price is your default hourly rate.</p>
                    <form class="listing-form" action="<?php echo site_url('Space/price_settings'); ?>" method="post" autocomplete="off">
                        <div class="feild">
                            <label>Base price</label>
                            <input type="text" class="textbox" name="page7[base_price]" placeholder="per hour" value="<?php echo isset($stepData['step3']['page7']['base_price'])?  $stepData['step3']['page7']['base_price'] : ''?>" />
                        </div>
                        <div class="feild">
                            <label>Currency</label>
                            <select class="textbox custom-select" name="page7[currency]">
                                <?php $all_currency = unserialize(CURRENCIES); 
                                 foreach($all_currency as $k=>$v) { ?>
                                 <option value="<?= $k; ?>" <?php echo ((isset($stepData['step3']['page7']['currency']) && $stepData['step3']['page7']['currency'] == $k) || $hostProfileInfo->currency == $k)? 'selected' : ''?>><?= $v; ?></option>
                                 <?php } ?>
                            </select>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/calendar'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <h5>Base hourly price</h5>
                    <p>Some owners start off with a lower price and raise it after earning positive reviews.</p>
                    <p>You can always change your price in response to demand. for example: a higher price may help you earn more during busy industry seasons, while a lowar price may get you more reservations when it’s slow.</p>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $("input[name='page7[base_price]']").keypress(function (e) {
        
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            var errorMsg = $('<label for="page7[base_price]" class="error">Please enter digits only.</label>');
            $("label.error").remove();
            errorMsg.insertAfter($(this));
            return false;
        }else{
            $("label.error").remove();
        }
    });
    $('form.listing-form').validate({
        rules: {
            'page7[base_price]' :{ required:true},
            'page7[currency]' :{ required:true}
        },
        submitHandler: function(form) {  
            $('form button').text('Please wait...');
            $.post(form.action, $(form).serialize(), function(){
                $(form).find('button').text('Next');
                window.location.href = "<?= site_url('Space/cancellation-policy'); ?>";
            });
        }
    });
</script>
</body>
</html>