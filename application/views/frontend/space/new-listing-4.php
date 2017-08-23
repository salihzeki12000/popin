<link href="<?php echo base_url('theme/front/assests/css/btnswitch.css')?>" rel="stylesheet" type="text/css" />
<?php $stepData = $this->session->userdata('stepData'); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
        40% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner7 new-partner8 new-partner25">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>How many bathrooms</h3>
                    <form action="<?php echo site_url('Space/location'); ?>" method="post">
                        <div class="feild">
                            <div class="main">
                                <input type='text' class="textbox" name='bathrooms' value='<?php echo isset($stepData['step1']['page3']['bathrooms'])? $stepData['step1']['page3']['bathrooms'] : '1'?> bathrooms' class='qty' />
                                <input type='button' value='' class='qtyminus' field='bathrooms' />
                                <input type='button' value='' class='qtyplus' field='bathrooms' />
                            </div>
                        </div>
                        <div class="feild">
                            <label>Is your bathroom ADA Compliant? <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="bathroom ADA Compliant" data-html="true"></i></label>
                            <div class="pull-left">
                                <div class="demo1" id="a"></div>
                                <input type="hidden" id="bathroomADACompliant" name="bathroomADACompliant" value="<?= isset($stepData['step1']['page3']['bathroomADACompliant'])?$stepData['step1']['page3']['bathroomADACompliant']:'Yes';?>" />
                            </div>
<!--                            <input id="toggle-demo" type="checkbox" name="bathroomADACompliant" value="1"  <?php echo (isset($stepData['step1']['page3']['bathroomADACompliant']) && $stepData['step1']['page3']['bathroomADACompliant'] == 'Yes')? 'checked' : ''?>>-->
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/workspace-detail'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--<div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="img/blub.png" alt="" />
                </div>
            </div>-->
        </div>
    </div>    
</section>
<script src="<?php echo base_url('theme/front/assests/js/jquery-3.1.1.slim.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/btnswitch.js')?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#a').btnSwitch({
            OnValue: "Yes",
            OffValue: "No",
            ToggleState: $("#bathroomADACompliant").val(),
            HiddenInputId: "bathroomADACompliant",
            OnCallback: function(val) {
                
            },
            OffCallback: function (val) {
                
            }
        });
    });
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        currentVal++;
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal+" bathrooms");
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0 + " bathroom");
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        currentVal--;
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal+" bathrooms");
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0+" bathroom");
        }
    });
    
    $("form").submit(function(e){
        //e.preventDefault();
        
        var bathrooms = parseInt($("input[name='bathrooms']").val());
        
        $("label.bathrooms").remove();
        
        if(isNaN(bathrooms) || bathrooms < 1){
            var errorMsg = $('<label for="bathrooms" class="error bathrooms">Please select a valid value.</label>');            
            errorMsg.insertAfter($("input[name='bathrooms']").parent());
            return false;
        }
    });
</script>
</body>
</html>