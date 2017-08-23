<?php $stepData = $this->session->userdata('stepData');// echo "<pre>"; print_r($stepData); echo "</pre>"; ?>
<?php $workspaces = $workspace_options; ?>
<?php
if(isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail'])){
    $workSpaceDetail = json_decode($stepData['step1']['page2']['workSpaceDetail'], TRUE);
    //echo "<pre>"; print_r($stepData); echo "</pre>";
}
?>
<style>
.guest_open .feild {
    margin-bottom: 20px;
    width: 100%;
}
.guest_open{display: none;}
.bz_guest_box {display: none;margin-top: 20px;}
.bz_guest_box label {font-size: 18px; width: 115px; font-weight: 600; color: #222;vertical-align: text-bottom;margin-bottom: 5px !important;}
.bz_guest_box input[type="text"] {background-color: #fff; height: 27px; text-align: center; width: 40px; border: none 0; font-weight: 600; font-size: 18px;}
.bz_guest_box input.qty {vertical-align: top;margin-top: 5px;}
.bz_guest_box input.qtyplus, .bz_guest_box input.qtyminus { position: inherit; background-color: transparent; background-position: center center; background-repeat: no-repeat; height: 32px; border:none 0; width: 32px;}
.bz_guest_box input.qtyplus {background-image: url("<?= base_url('theme/front/assests/')?>img/circle-plus.png");}
.bz_guest_box input.qtyminus {background-image: url("<?= base_url('theme/front/assests/')?>img/circle-minus.png");}
</style>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
        30% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner7">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <form id="workspaces_info_form" action="<?php echo site_url('Space/workspace_detail'); ?>" method="post">
                        <h3>How many workspaces does your space have?</h3>
                        <div class="feild">
                            <div class="main">
                                <input type='text' class="textbox" name='workSpaceCount' value='<?php echo isset($stepData['step1']['page2']['workSpaceCount'])? $stepData['step1']['page2']['workSpaceCount'] : '0'?> workspaces' class='qty' />
                                <input type='button' value='' class='qtyminus' field='workSpaceCount' />
                                <input type='button' value='' class='qtyplus' field='workSpaceCount' />
                            </div>
                        </div>
                        
                        <h3>What kind of workspaces does your space have?</h3>
                        <div class="works-details">
                            <h4 style="font-weight: normal">Workspace Details</h4>
                            <ul>
<!--                                <li class="clearfix">
                                    <div class="pull-left ws-box">
                                        <strong>Workspace 1</strong>
                                        <p class="workspace_type" style="margin-bottom: 5px;">Booth</p>
                                        <p class="workspace_info">In common space</p>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <a class="btn btn-default add_spaces" href="javascript:;">Add spaces</a>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    
                                    <div class="clearfix guest_open">
                                        <div class="feild">
                                            <label>Type of workspace</label>
                                            <select class="selectbox">
                                                <option>AAA</option><option>BBB</option>
                                            </select>
                                        </div>
                                        <div class="feild">
                                            <label for="in-common"><input id="in-common" type="checkbox" name="" value="1"> In common space</label>
                                        </div>
                                    </div>
                                </li>-->
                            </ul>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/professionals'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <p style="line-height: 1.5; font-weight: bold;">Adding details about what kind of workspaces you have will help professionals understand what the arrangements are like.</p>
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    <?php 
        if(isset($stepData['step1']['page2']['workSpaceCount'])){
            if($stepData['step1']['page2']['workSpaceCount'] > 0 && !empty($stepData['step1']['page2']['workSpaceDetail'])){
                ?>
                    var workSpacesCount = parseInt($("input[name='workSpaceCount']").val());
                    create_workspace_boxes(workSpacesCount);
    <?php   }
        }
    ?>
    
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $("input[name='"+fieldName+"']").val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // Increment
        currentVal++;
        // If is not undefined
        if (!isNaN(currentVal)) {
            $("input[name='"+fieldName+"']").val(currentVal + inputString);
            create_workspace_boxes(currentVal);
        } else {
            // Otherwise put a 0 there
            //$("input[name='"+fieldName+"']").val(0 + inputString);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $("input[name='"+fieldName+"']").val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // Decrement
        currentVal--;
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            $("input[name='"+fieldName+"']").val(currentVal + inputString);
            create_workspace_boxes(currentVal);
        } else {
            // Otherwise put a 0 there
            //$("input[name='"+fieldName+"']").val(0 + inputString);
        }
    });
    
    $(document).on("change", ".works-details select", function(){
        var type = $(this).find("option:selected").text();
        var $parent = $(this).parents('li');
        
        $parent.find("p.workspace_type").text(type);
    });
    $(document).on("click", ".works-details input[type='checkbox']", function(){
        var $parent = $(this).parents('li');
        if($(this).is(":checked")){
            $parent.find("p.workspace_info").text("In Common Space");
        }else{
            $parent.find("p.workspace_info").text("");
        }
        
    });
    
    $(document).on('click', 'a.add_spaces', function() {      
        var button_text = $(this).text();
        
        $(this).parents('li').find(".guest_open, .workspace_type, .workspace_info").toggle();
        
        if($(this).parents('li').find(".guest_open").is(':visible')){
            button_text = "Done";
        }else{
            var action = $(this).parents('li').find("p.workspace_type").text();
            if(action !== ""){
                button_text = "Edit spaces";
            }else{
                button_text = "Add spaces";
            }
        }
        
        $(this).text(button_text);
    });
    
    function create_workspace_boxes(workspaces){
        $(".works-details ul").block({ 
            overlayCSS: { backgroundColor: '#E5E5E5' }, 
            message: '<img src="<?= base_url(); ?>assets/images/loading-spinner-grey.gif" alt="please wait...">',
            css: { border: 'none', backgroundColor: 'transparent' }  
        });
        
        $.ajax({
            url: "<?= site_url('Space/create_workspace_boxes'); ?>",
            type: "POST",
            data: "workspaces="+workspaces,
            success: function(response) {
                $("label.workSpaceCount").remove();
                $(".works-details ul").html(response);
                $(".works-details ul").unblock();
            },
            error: function(response){
                $("label.workSpaceCount").remove();
                $(".works-details ul").unblock();
            }
        });
    }
    $("form#workspaces_info_form").submit(function(e){
        e.preventDefault();
        
        var workSpaceCount = parseInt($("input[name='workSpaceCount']").val());
        if(isNaN(workSpaceCount) || workSpaceCount < 1){
            $("label.workSpaceCount").remove();
            var errorMsg = $('<label for="workSpaceCount" class="error workSpaceCount">Please select a valid value.</label>');            
            errorMsg.insertAfter($("input[name='workSpaceCount']").parent());
            return false;
        }
        
        var fullTotal = false;
        $(".ws-box").each(function(){
            var boxValue = $(this).find('p.workspace_type').text();
            if(boxValue !== ""){
                fullTotal = true;
            }else{
                fullTotal = false;
            }
        });
        //console.log(fullTotal);
        if(!fullTotal){
            $(".workSpaceDetails").remove();
            var errorMsg = $('<label for="workSpaceDetails" class="error workSpaceDetails">Please enter all workspace details.</label>');            
            errorMsg.insertAfter($(".works-details > h4"));
            return false;
        }
        
        $(".loader").show();
        $(this).find('button').text('Please wait...');
        $.post($(this).attr('action'), $(this).serialize(), function(){
            $(".loader").hide();
            $('form#workspaces_info_form button').text('Next');
            window.location.href = "<?= site_url('Space/bathrooms'); ?>";
        });
    });
</script>

</body>
</html>