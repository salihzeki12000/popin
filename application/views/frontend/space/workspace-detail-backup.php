<?php $stepData = $this->session->userdata('stepData');// echo "<pre>"; print_r($stepData); echo "</pre>"; ?>
<?php $workspaces = $workspace_options; ?>
<?php
if(isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail'])){
    $workSpaceDetail = json_decode($stepData['step1']['page2']['workSpaceDetail'], TRUE);
    //echo "<pre>"; print_r($workSpaceDetail); echo "</pre>";
}
?>
<style>
#guest_open .feild {
    margin-bottom: 20px;
    width: 100%;
}
.bz_guest_box {display: none;margin-top: 20px;}
.bz_guest_box label {font-size: 18px; width: 115px; font-weight: 600; color: #222;vertical-align: text-bottom;margin-bottom: 5px !important;}
.bz_guest_box input[type="text"] {background-color: #fff; height: 27px; text-align: center; width: 40px; border: none 0; font-weight: 600; font-size: 18px;}
.bz_guest_box input.qty {vertical-align: top;margin-top: 5px;}
.bz_guest_box input.qtyplus, .bz_guest_box input.qtyminus { position: inherit; background-color: transparent; background-position: center center; background-repeat: no-repeat; height: 32px; border:none 0; width: 32px;}
.bz_guest_box input.qtyplus {background-image: url("<?= base_url('theme/front/assests/')?>img/circle-plus.png");}
.bz_guest_box input.qtyminus {background-image: url("<?= base_url('theme/front/assests/')?>img/circle-minus.png");}
</style>
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
                    <form id="workspaces_info_form" action="<?php echo site_url('Space/workspace_detail'); ?>" method="post">
                        <div class="works-details">
                            <h4 style="font-weight: normal">Workspace Details</h4>
                            <ul>
                                <?php 
                                if(isset($stepData['step1']['page2']['workSpaceCount'])){
                                    for($i = 1; $i<=$stepData['step1']['page2']['workSpaceCount']; $i++){
                                        ?>
                                <li class="clearfix">
                                    <div class="pull-left ws-box">
                                        <strong>Workspace <?= $i; ?></strong>
                                        <p class="total_workspaces" style="margin-bottom: 5px;">
                                            <?php
                                            if(isset($workSpaceDetail["ws{$i}"])){                                                
                                                echo array_sum($workSpaceDetail["ws{$i}"]). " workspaces";
                                            }else{
                                                echo "0 workspaces";
                                            }
                                            ?> 
                                        </p>
                                        <p class="workspace_info">
                                            <?php
                                            if(isset($workSpaceDetail["ws{$i}"])){ 
                                                $workspaceInfo="";
                                                foreach($workspaces as $v){
                                                    if($workSpaceDetail["ws{$i}"]["sp".$v['id']] != 0){
                                                        $workspaceInfo .= $workSpaceDetail["ws{$i}"]["sp".$v['id']]." ".$v['name'].", ";
                                                    }
                                                }
                                                echo rtrim($workspaceInfo, ", ");
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <a class="btn btn-default add_spaces" href="javascript:;"><?php echo isset($workSpaceDetail["ws{$i}"])? 'Edit spaces' : 'Add spaces'?></a>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    
                                    <div class="bz_guest_box clearfix guest_open">
                                        <?php foreach($workspaces as $v){ $name = "ws{$i}[sp{$v['id']}]"; ?>
                                        <div class="feild">
                                            <label><?= $v['name']; ?></label>
                                            <span><input value="" class="qtyminus" field="<?= $name; ?>" type="button"> <input name="<?= $name; ?>" value="<?php echo isset($workSpaceDetail["ws{$i}"])? $workSpaceDetail["ws{$i}"]["sp".$v['id']] : 0; ?>" class="qty" type="text" readonly> <input value="" class="qtyplus" field="<?= $name; ?>" type="button"></span>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                                <?php    }
                                }
                                ?>
                                <li class="clearfix" id="asvbaji">
                                    <div class="pull-left ws-box">
                                        <strong>Common spaces</strong>
                                        <p class="total_workspaces" style="margin-bottom: 5px;">
                                            <?php
                                            if(isset($workSpaceDetail["cm"])){                                                
                                                echo array_sum($workSpaceDetail["cm"]). " workspaces";
                                            }else{
                                                echo "0 workspaces";
                                            }
                                            ?>
                                        </p>
                                        <p class="workspace_info">
                                            <?php
                                            if(isset($workSpaceDetail["cm"])){ 
                                                $workspaceInfo="";
                                                foreach($workspaces as $v){
                                                    if($workSpaceDetail["cm"]["sp".$v['id']] != 0){
                                                        $workspaceInfo .= $workSpaceDetail["cm"]["sp".$v['id']]." ".$v['name'].", ";
                                                    }
                                                }
                                                echo rtrim($workspaceInfo, ", ");
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    
                                    <div class="pull-right">
                                        <a class="btn btn-default add_spaces" href="javascript:;"><?php echo isset($workSpaceDetail["cm"])? 'Edit spaces' : 'Add spaces'?></a>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    
                                    <div class="bz_guest_box clearfix guest_open">
                                        <?php foreach($workspaces as $v){ $name = "cm[sp{$v['id']}]"; ?>
                                        <div class="feild">
                                            <label><?= $v['name']; ?></label>
                                            <span><input value="" class="qtyminus" field="<?= $name; ?>" type="button"> <input name="<?= $name; ?>" value="<?php echo isset($workSpaceDetail["cm"])? $workSpaceDetail["cm"]["sp".$v['id']] : 0; ?>" class="qty" type="text" readonly> <input value="" class="qtyplus" field="<?= $name; ?>" type="button"></span>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/workspaces'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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

        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            currentVal++;
            $("input[name='"+fieldName+"']").val(currentVal + inputString);
        } else {
            // Otherwise put a 0 there
            $("input[name='"+fieldName+"']").val(0 + inputString);
        }
        
        update_workspace_count(fieldName);
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
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            currentVal--;
            $("input[name='"+fieldName+"']").val(currentVal + inputString);
        } else {
            // Otherwise put a 0 there
            $("input[name='"+fieldName+"']").val(0 + inputString);
        }
        
        update_workspace_count(fieldName);
    });
    
    function update_workspace_count(fieldName){
        var total = 0, workspace_info = "";
        var $parent = $("input[name='"+fieldName+"']").parents('li');

        $parent.find("input[type='text']").each(function(){
            var inputValue = parseInt($(this).val());
            total += inputValue;
            
            if(inputValue > 0){
                var spaceName = $(this).parents("div.feild").find("label").text();
                workspace_info += inputValue + " " + spaceName + ", ";
            }            
        });
        
        $parent.find("p.total_workspaces").html(total + " workspaces");
        $parent.find("p.workspace_info").html(workspace_info.slice(0, -2));
        
        activate_deactivate_submit();
    }
    
    $(document).on('click', 'a.add_spaces', function() {      
        var button_text = $(this).text();
        
        //$(".guest_open, .workspace_info").hide();
        //$('a.add_spaces').text("<?php echo (isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail']))? 'Edit spaces' : 'Add spaces'?>");
        
        $(this).parents('li').find(".guest_open, .workspace_info").toggle();
        
        if($(this).parents('li').find(".guest_open").is(':visible')){
            button_text = "Done";
        }else{
            var action = parseInt($(this).parents('li').find("p.total_workspaces").html());
            if(!isNaN(action) && action !== 0){
                button_text = "Edit spaces";
            }else{
                button_text = "Add spaces";
            }
        }
        
        $(this).text(button_text);
        
        activate_deactivate_submit();
    });
    activate_deactivate_submit();
    function activate_deactivate_submit(){
        var fullTotal = false;
        $(".ws-box").each(function(){
            var boxValue = parseInt($(this).find('p.total_workspaces').text());
            if(!isNaN(boxValue) && boxValue > 0){
                fullTotal = true;
            }else{
                fullTotal = false;
            }
        });
        //console.log(fullTotal);
        if(fullTotal){
            $("form button[type='submit']").prop("disabled", false);
        }else{
            $("form button[type='submit']").prop("disabled", true);
        }
    }
    
    $("form#workspaces_info_form").submit(function(e){
        e.preventDefault();
        
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