<?php $stepData = $this->session->userdata('stepData');// echo "<pre>"; print_r($stepData); echo "</pre>"; ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
        40% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner7">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>What kind of workspaces does your space have?</h3>
                    <form id="workspaces_info_form" action="<?php echo site_url('Space/professionals_submit'); ?>" method="post">
                        <div class="works-details">
                            <h4 style="font-weight: normal">Workspace Details</h4>
                            <ul>
                                <li class="clearfix" style="border-bottom: none;">
                                    <div class="pull-left">
                                        <strong>Common spaces</strong>
                                        <p id="total_workspaces" style="margin-bottom: 5px;">
                                            <?php
                                            if(isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail'])){
                                                $workSpaceDetail = unserialize($stepData['step1']['page2']['workSpaceDetail']);
                                                
                                                echo ($workSpaceDetail['common'] + $workSpaceDetail['space1'] + $workSpaceDetail['space2']). " workspaces";
                                            }else{
                                                echo "0 workspaces";
                                            }
                                            ?>                                            
                                        </p>
                                        <p id="workspace_info">
                                            <?php
                                            if(isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail'])){
                                                $workSpaceDetail = unserialize($stepData['step1']['page2']['workSpaceDetail']);
                                                
                                                echo $workSpaceDetail['common'] . " common workspaces, " . $workSpaceDetail['space1'] . " space 1, " . $workSpaceDetail['space2'] . " space 2";
                                            }
                                            ?>  
                                        </p>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <a class="btn btn-default" href="javascript:;" id="add_spaces"><?php echo (isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail']))? 'Edit spaces' : 'Add spaces'?></a>
                                    </div>
                                </li>
                            </ul>
                            <div id="guest_open" style="display: none;">
                                <div class="feild">
                                    <label>How many common spaces?</label>
                                    <div class="main">
                                        <input type='text' class="textbox" name='commonWorkspace' value='<?php echo (isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail']))? $workSpaceDetail['common'] : '0'?>' class='qty' />
                                        <input type='button' value='' class='qtyminus' field='commonWorkspace' />
                                        <input type='button' value='' class='qtyplus' field='commonWorkspace' />
                                    </div>
                                </div>
                                <div class="feild">
                                    <label>How many space 1?</label>
                                    <div class="main">
                                        <input type='text' class="textbox" name='space1' value='<?php echo (isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail']))? $workSpaceDetail['space1'] : '0'?>' class='qty' />
                                        <input type='button' value='' class='qtyminus' field='space1' />
                                        <input type='button' value='' class='qtyplus' field='space1' />
                                    </div>
                                </div>
                                <div class="feild">
                                    <label>How many space 2?</label>
                                    <div class="main">
                                        <input type='text' class="textbox" name='space2' value='<?php echo (isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail']))? $workSpaceDetail['space2'] : '0'?>' class='qty' />
                                        <input type='button' value='' class='qtyminus' field='space2' />
                                        <input type='button' value='' class='qtyplus' field='space2' />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/workspaces'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn-red" <?php echo (isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail']))?"":"disabled"; ?>>Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <p style="line-height: 1.5; font-weight: bold;">Adding details about what kind of workspaces you have will help professionals understand what the arrangements are like.</p>
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

        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            currentVal++;
            $('input[name='+fieldName+']').val(currentVal + inputString);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0 + inputString);
        }
        
        //update_workspace_count();
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $('input[name='+fieldName+']').val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            currentVal--;
            $('input[name='+fieldName+']').val(currentVal + inputString);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0 + inputString);
        }
        
        //update_workspace_count();
    });
    
    function update_workspace_count(){
        var space1 = parseInt($("input[name='commonWorkspace']").val());
        var space2 = parseInt($("input[name='space1']").val());
        var space3 = parseInt($("input[name='space2']").val());
        
        var total = space1 + space2 + space3;
        
        $("#total_workspaces").html(total + " workspaces");
        
        $("#workspace_info").html(space1 + " common workspaces, " + space2 + " space 1, " + space3 + " space 2");
        
        if(total > 0){
            $("form button[type='submit']").prop("disabled", false);
        }else{
            $("form button[type='submit']").prop("disabled", true);
        }
    }
    
    $(document).on('click', '#add_spaces', function() {      
        var button_text = $(this).text();

        $("#guest_open, #workspace_info").toggle();
        
        if($("#guest_open").is(':visible')){
            button_text = "Done";
        }else{
            button_text = "<?php echo (isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail']))? 'Edit spaces' : 'Add spaces'?>";
        }
        
        $(this).text(button_text);
    });
    
    $("form#workspaces").submit(function(e){
        e.preventDefault();
        
        var professionalCapacity = parseInt($("input[name='professionalCapacity']").val());
        var workSpaceCount = parseInt($("input[name='workSpaceCount']").val());
        
        $("label.professionalCapacity").remove();$("label.workSpaceCount").remove();
        
        if(isNaN(professionalCapacity) || professionalCapacity < 1){
            var errorMsg = $('<label for="professionalCapacity" class="error professionalCapacity">Please select a valid value.</label>');            
            errorMsg.insertAfter($("input[name='professionalCapacity']").parent());
            return false;
        }
        if(isNaN(workSpaceCount) || workSpaceCount < 1){
            var errorMsg = $('<label for="workSpaceCount" class="error workSpaceCount">Please select a valid value.</label>');            
            errorMsg.insertAfter($("input[name='workSpaceCount']").parent());
            return false;
        }
        
        $(".loader").show();
        $(this).find('button').text('Please wait...');
        $.post($(this).attr('action'), $(this).serialize(), function(){
            $(".loader").hide();
            $('form#workspaces button').text('Next');
            $('section#step-1').hide();
            $('section#step-2').removeClass('hidden');
            //window.location.href = "<?= site_url('Space/become-a-partner/'.$stepData['id']); ?>";
        });
    });
</script>
</body>
</html>