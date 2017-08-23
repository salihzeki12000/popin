<?php $stepData = $this->session->userdata('stepData');// echo "<pre>"; print_r($stepData); echo "</pre>"; ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
        20% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner7">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>How many professionals can your space accommodate?</h3>
                    <form id="workspaces-form" action="<?php echo site_url('Space/professionals_submit'); ?>" method="post">
                        <div class="feild">
                            <div class="main">
                                <input type='text' class="textbox" name='professionalCapacity' value='<?php echo isset($stepData['step1']['page2']['professionalCapacity'])? $stepData['step1']['page2']['professionalCapacity'] : '1'?> professionals' class='qty' />
                                <input type='button' value='' class='qtyminus' field='professionalCapacity' />
                                <input type='button' value='' class='qtyplus' field='professionalCapacity' />
                            </div>
                        </div>
                        
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/establishment'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn-red">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <p style="line-height: 1.5; font-weight: bold;"></p>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $('input[name='+fieldName+']').val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // Increment
        currentVal++;
        // If is not undefined
        if (!isNaN(currentVal)) {
            $('input[name='+fieldName+']').val(currentVal + inputString);
        } else {
            // Otherwise put a 0 there
            //$('input[name='+fieldName+']').val(0 + inputString);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $('input[name='+fieldName+']').val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // Decrement
        currentVal--;
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {            
            $('input[name='+fieldName+']').val(currentVal + inputString);
        } else {
            // Otherwise put a 0 there
            //$('input[name='+fieldName+']').val(0 + inputString);
        }
    });
    
    $("form#workspaces-form").submit(function(e){
        e.preventDefault();
        
        var professionalCapacity = parseInt($("input[name='professionalCapacity']").val());
        
        
        $("label.professionalCapacity").remove();$("label.workSpaceCount").remove();
        
        if(isNaN(professionalCapacity) || professionalCapacity < 1){
            var errorMsg = $('<label for="professionalCapacity" class="error professionalCapacity">Please select a valid value.</label>');            
            errorMsg.insertAfter($("input[name='professionalCapacity']").parent());
            return false;
        }
        
        
        $(".loader").show();
        $(this).find('button').text('Please wait...');
        $.post($(this).attr('action'), $(this).serialize(), function(){
            $(".loader").hide();
            $('form#workspaces-form button').text('Next');
            window.location.href = "<?= site_url('Space/workspace-detail'); ?>";
        });
    });
</script>
</body>
</html>