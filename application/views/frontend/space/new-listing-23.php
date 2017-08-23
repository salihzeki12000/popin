<?php $stepData = $this->session->userdata('stepData');//print_r($stepData); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
        60% Complete
    </div>
</div>
<!-- Settings 1 -->
<section id="settings-1" class="middle-container new-partner6 new-partner32 new-partner33 new-partner34">
    <div class="container">
        <div class="row clearfix">            
            <div class="col-md-8">
                <div class="space-are">
                    <?php $noticesArray = unserialize(NOTICES); $gapsArray = unserialize(GAPS); $advanceArray = unserialize(ADVANCE_NOTICES); ?>
                    <form class="dates-form" action="<?php echo site_url('Space/availability_settings'); ?>" method="post">
                        <h3>How much notice do you need before a professional arrives?</h3>
                        <div class="feild">
                            <select class="selectbox custom-select" name="page6[noticeTime]">
                                <?php foreach($noticesArray as $k => $v){ ?>
                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['noticeTime']) && $stepData['step3']['page6']['noticeTime'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <p><strong>Tip:</strong> At least <strong>1 day notice</strong> can help you plan for a professionals arrival, but you might miss out on last-minute rentals.</p>
                        
                        <h3>How much time do you want between professionals?</h3>
                        <div class="feild">
                            <select class="selectbox custom-select" name="page6[bookingGap]">
                                <?php foreach($gapsArray as $k => $v){ ?>
                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['bookingGap']) && $stepData['step3']['page6']['bookingGap'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="rental-hours">
                            <a href="#"><h5 style="color: #008489;">When can professionals rent your workspace?</h5></a>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">&nbsp;</th>
                                        <td>From:</td>
                                        <td>To:</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Monday</th>
                                        <td>
                                            <select class="selectbox" name="page6[monFrom]">
                                                <?php $times = unserialize(TIMES); 
                                                foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['monFrom']) && $stepData['step3']['page6']['monFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                        <td>
                                            <select class="selectbox" name="page6[monTo]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['monTo']) && $stepData['step3']['page6']['monTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Tuesday</th>
                                        <td>
                                            <select class="selectbox" name="page6[tueFrom]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['tueFrom']) && $stepData['step3']['page6']['tueFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                        <td>
                                            <select class="selectbox" name="page6[tueTo]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['tueTo']) && $stepData['step3']['page6']['tueTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Wednesday</th>
                                        <td>
                                            <select class="selectbox" name="page6[wedFrom]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['wedFrom']) && $stepData['step3']['page6']['wedFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                        <td>
                                            <select class="selectbox" name="page6[wedTo]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['wedTo']) && $stepData['step3']['page6']['wedTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Thursday</th>
                                        <td>
                                            <select class="selectbox" name="page6[thuFrom]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['thuFrom']) && $stepData['step3']['page6']['thuFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                        <td>
                                            <select class="selectbox" name="page6[thuTo]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['thuTo']) && $stepData['step3']['page6']['thuTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Friday</th>
                                        <td>
                                            <select class="selectbox" name="page6[friFrom]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['friFrom']) && $stepData['step3']['page6']['friFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                        <td>
                                            <select class="selectbox" name="page6[friTo]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['friTo']) && $stepData['step3']['page6']['friTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Saturday</th>
                                        <td>
                                            <select class="selectbox" name="page6[satFrom]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['satFrom']) && $stepData['step3']['page6']['satFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                        <td>
                                            <select class="selectbox" name="page6[satTo]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['satTo']) && $stepData['step3']['page6']['satTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sunday</th>
                                        <td>
                                            <select class="selectbox" name="page6[sunFrom]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['sunFrom']) && $stepData['step3']['page6']['sunFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                        <td>
                                            <select class="selectbox" name="page6[sunTo]">
                                                <?php foreach($times as $k=>$v){ ?>
                                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['sunTo']) && $stepData['step3']['page6']['sunTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                              </table>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/availability-questions'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit" name="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="to-day">
                    <h5>Today</h5>
                    <ul class="clearfix">
                        <li><img src="<?php echo base_url('theme/front/assests/img/today-img1.jpg')?>" alt="" /></li>
                        <li><img src="<?php echo base_url('theme/front/assests/img/today-img2.jpg')?>" alt="" /></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
</section>

<!-- Settings 2 -->
<section id="settings-2" class="middle-container new-partner6 new-partner32 new-partner33 new-partner35">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>How far in advance can professionals book?</h3>
                    <form class="advance-form" action="<?php echo site_url('Space/availability_settings'); ?>" method="post">
                        <div class="feild">
                            <select class="selectbox custom-select" name="page6[advanceBook]">
                                <?php foreach($advanceArray as $k => $v){ ?>
                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step3']['page6']['advanceBook']) && $stepData['step3']['page6']['advanceBook'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <p><strong>Tip:</strong> Most partners can keep their calendars updated up to 3 months out.</h5></p>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" id="back-1" href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit" name="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="to-day">
                    <h5>Today</h5>
                    <ul class="clearfix">
                        <li><img src="<?php echo base_url('theme/front/assests/img/calender-img1.jpg')?>" alt="" /></li>
                        <li><img src="<?php echo base_url('theme/front/assests/img/calender-img2.jpg')?>" alt="" /></li>
                        <li><img src="<?php echo base_url('theme/front/assests/img/calender-img3.jpg')?>" alt="" /></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
</section>

<!-- Settings 3 -->
<section id="settings-3" class="middle-container new-partner6 new-partner7 new-partner33 new-partner36">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>How long can professionals stay?</h3>
                    <div class="alert alert-danger" style="display: none;">
                        <strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i></strong> Minimum stay can’t be higher than maximum stay.
                    </div>
                    <form class="night-stay-form" action="<?php echo site_url('Space/availability_settings'); ?>" method="post">
                        <div class="feild">
                            <div class="main">
                                <input type='text' class="textbox" name='minStay' value='<?php echo isset($stepData['step3']['page6']['minStay'])? $stepData['step3']['page6']['minStay'] : 1?> <?php echo isset($stepData['step3']['page6']['minStayType'])? $stepData['step3']['page6']['minStayType'] : 'hours'?> min' class='qty' />
                                <input type='button' value='' class='qtyminus' field='minStay' />
                                <input type='button' value='' class='qtyplus' field='minStay' />
                            </div>
                            <input type='hidden' value='<?php echo isset($stepData['step3']['page6']['minStayType'])? $stepData['step3']['page6']['minStayType'] : 'hours'?>' name='minStayType' />
                        </div>
                        <div class="feild">
                            <div class="main">
                                <input type='text' class="textbox" name='maxStay' value='<?php echo isset($stepData['step3']['page6']['maxStay'])? $stepData['step3']['page6']['maxStay'] : 0?> <?php echo isset($stepData['step3']['page6']['maxStayType'])? $stepData['step3']['page6']['maxStayType'] : 'hours'?> max' class='qty2' />
                                <input type='button' value='' class='qtyminus' field='maxStay' />
                                <input type='button' value='' class='qtyplus' field='maxStay' />
                            </div>
                            <input type='hidden' value='<?php echo isset($stepData['step3']['page6']['maxStayType'])? $stepData['step3']['page6']['maxStayType'] : 'hours'?>' name='maxStayType' />
                        </div>
                        <p><strong>Tip:</strong> Shorter rentals can mean more profit, but you might have to turn over your space more often.</p>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" id="back-2" href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit" name="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="to-day">
                    <pre><?= nbs(18);?>1 hour              No max</pre><img src="<?php echo base_url('theme/front/assests/img/nights-1.png')?>" alt="" />
                </div>
            </div>
        </div>
    </div>    
</section>
<script type="text/javascript">
    $("#settings-1,#settings-2,#settings-3").hide();
    
    if(window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        $("#"+hash).show();
        // hash found
    } else {
        // No hash found
        $("#settings-1").show();
    }
    $('form.dates-form').validate({
        rules: {
            'page6[monFrom]' :{ required:function(element){ return $("select[name='page6[monTo]']").val().length > 0;}},
            'page6[monTo]' :{ required:function(element){ return $("select[name='page6[monFrom]']").val().length > 0;}},
            'page6[tueFrom]' :{ required:function(element){ return $("select[name='page6[tueTo]']").val().length > 0;}},
            'page6[tueTo]' :{ required:function(element){ return $("select[name='page6[tueFrom]']").val().length > 0;}},
            'page6[wedFrom]' :{ required:function(element){ return $("select[name='page6[wedTo]']").val().length > 0;}},
            'page6[wedTo]' :{ required:function(element){ return $("select[name='page6[wedFrom]']").val().length > 0;}},
            'page6[thuFrom]' :{ required:function(element){ return $("select[name='page6[thuTo]']").val().length > 0;}},
            'page6[thuTo]' :{ required:function(element){ return $("select[name='page6[thuFrom]']").val().length > 0;}},
            'page6[friFrom]' :{ required:function(element){ return $("select[name='page6[friTo]']").val().length > 0;}},
            'page6[friTo]' :{ required:function(element){ return $("select[name='page6[friFrom]']").val().length > 0;}},
            'page6[satFrom]' :{ required:function(element){ return $("select[name='page6[satTo]']").val().length > 0;}},
            'page6[satTo]' :{ required:function(element){ return $("select[name='page6[satFrom]']").val().length > 0;}},
            'page6[sunFrom]' :{ required:function(element){ return $("select[name='page6[sunTo]']").val().length > 0;}},
            'page6[sunTo]' :{ required:function(element){ return $("select[name='page6[sunFrom]']").val().length > 0;}}
        },
        submitHandler: function(form) {  
            $(form).find('button').text('Please wait...');
            $.post(form.action, $(form).serialize(), function(){
                $(form).find('button').text('Next');
                $("#settings-1").hide();$("#settings-2").show();
            });
        }
    });
    $("form.advance-form").submit(function(e){
        e.preventDefault();
        $(this).find('button').text('Please wait...');
        $.post($(this).attr('action'), $(this).serialize(), function(){
            $('form.advance-form button').text('Next');
            $("#settings-2").hide();$("#settings-3").show();
        });
    });
    $("form.night-stay-form").submit(function(e){
        e.preventDefault();
        var minStay = parseInt($("input[name='minStay']").val());
        var maxStay = parseInt($("input[name='maxStay']").val());
        var minStayType = $("input[name='minStayType']").val();
        var maxStayType = $("input[name='maxStayType']").val();
        
        $("label.minStay").remove();$("label.maxStay").remove();
        
        if(isNaN(minStay) || minStay < 0){
            var errorMsg = $('<label for="minStay" class="error minStay">Please enter valid value.</label>');            
            errorMsg.insertAfter($("input[name='minStay']").parent());
            $('form.night-stay-form button').text('Next');
            return false;
        }
        if(isNaN(maxStay) || maxStay < 0){
            var errorMsg = $('<label for="maxStay" class="error maxStay">Please enter valid value.</label>');            
            errorMsg.insertAfter($("input[name='maxStay']").parent());
            $('form.night-stay-form button').text('Next');
            return false;
        }
        if(minStay > maxStay && maxStay !== 0 && minStayType === maxStayType){
            return false;
        }else if(maxStay !== 0 && minStayType === "days" && maxStayType === "hours"){
            return false;
        }

        $(this).find('button').text('Please wait...');
        $.post($(this).attr('action'), $(this).serialize(), function(){

            $('form.night-stay-form button').text('Next');
            window.location.href = "<?= site_url('Space/calendar'); ?>";
        });
    });
    
    $(".rental-hours > a").click(function(e){
        e.preventDefault();
        $(".rental-hours table").toggle();
    });
    $("a#back-1").click(function(e){
        e.preventDefault();
        $("#settings-1").show();$("#settings-2").hide();
    });
    $("a#back-2").click(function(e){
        e.preventDefault();
        $("#settings-2").show();$("#settings-3").hide();
    });
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
        var variable = get_stay_var(currentVal, inputString, 'Plus');
        // If is not undefined
        if (!isNaN(variable[0])) {            
            $('input[name='+fieldName+']').val(variable[0] + variable[1]);
            $('input[name='+fieldName+'Type]').val(variable[2]);
        } else {
            // Otherwise put a 0 there
            //$('input[name='+fieldName+']').val(0 + inputString);
        }

        var minStay = parseInt($("input[name='minStay']").val());
        var maxStay = parseInt($("input[name='maxStay']").val());
        validate_inputs(minStay, maxStay, variable[2]);
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
        var variable = get_stay_var(currentVal, inputString, 'Minus');
        // If it isn't undefined or its greater than 0
        if (!isNaN(variable[0]) && variable[0] >= 0) {            
            $('input[name='+fieldName+']').val(variable[0] + variable[1]);
            $('input[name='+fieldName+'Type]').val(variable[2]);
        } else {
            // Otherwise put a 0 there
            //$('input[name='+fieldName+']').val(0 + variable[1]);
        }

        var minStay = parseInt($("input[name='minStay']").val());
        var maxStay = parseInt($("input[name='maxStay']").val());
        validate_inputs(minStay, maxStay, variable[2]);
    });
    var minStayVar = parseInt($("input[name='minStay']").val());
    var maxStayVar = parseInt($("input[name='maxStay']").val());
    validate_inputs(minStayVar, maxStayVar);
    function validate_inputs(minStay, maxStay) {
        //console.log("Min: " + minStay + ", Max: " + maxStay);
        var minStayType = $("input[name='minStayType']").val();
        var maxStayType = $("input[name='maxStayType']").val();
        // Remove error label
        if(minStay > 0){
            $("label.minStay").remove();
        }
        if(maxStay > 0){
            $("label.maxStay").remove();
        }
        // Check for valid inputs
        if(minStay > maxStay && maxStay !== 0 && minStayType === maxStayType){
            $(".alert").show();
        }else if(maxStay !== 0 && minStayType === "days" && maxStayType === "hours"){
            $(".alert").show();
        }else{
            $(".alert").hide();
        }
        // logic for changing the sidebar image
        var minText, maxText;
        
        if(minStay == 0){
            minText = "No min";
        }else if(minStay < 2){
            minText = minStay+" "+minStayType;
        }else{
            minText = minStay+" "+minStayType;
        }
        
        if(maxStay == 0){
            maxText = "No max";
        }else if(maxStay < 2){
            maxText = maxStay+" "+maxStayType;
        }else{
            maxText = maxStay+" "+maxStayType;
        }
        
        var night_1 = '<pre><?= nbs(18);?>'+minText+'              '+maxText+'</pre><img src="<?php echo base_url('theme/front/assests/img/nights-1.png')?>" alt="" />';
        var night_2 = '<pre><?= nbs(20);?>'+minText+'           '+maxText+'</pre><img src="<?php echo base_url('theme/front/assests/img/nights-2.png')?>" alt="" />';
        var night_3 = '<pre><?= nbs(20);?>'+minText+'              '+maxText+'</pre><img src="<?php echo base_url('theme/front/assests/img/nights-3.png')?>" alt="" />';
        var night_4 = '<pre><?= nbs(20);?>'+minText+'       '+maxText+'</pre><img src="<?php echo base_url('theme/front/assests/img/nights-4.png')?>" alt="" />';
        
        if(minStay == 1 && maxStay == 0){
            $("#settings-3 div.to-day").html(night_1);
        }else if(minStay > 1 && maxStay == 0){
            $("#settings-3 div.to-day").html(night_2);
        }else if(minStay > 1 && maxStay >= 1){
            $("#settings-3 div.to-day").html(night_4);
        }else if(minStay >= 0 && maxStay >= 1){
            $("#settings-3 div.to-day").html(night_3);
        }else if(minStay == 0 && maxStay == 0){
            $("#settings-3 div.to-day").html(night_1);
        }
    }
    
    function get_stay_var(value, type, action){
        var myArray = new Array(2);
        myArray[0] = value;
        myArray[1] = type;
        myArray[2] = (type === " hours min" || type === " hours max")?"hours":"days";
        
        if(value > 12 && (type === " hours min" || type === " hours max")){
            myArray[0] = 1;
            myArray[1] = (type === " hours min")?" days min":" days max";
            myArray[2] = "days";
        }else if(action === "Minus" && value == 0 && (type === " days min" || type === " days max")){
            myArray[0] = 12;
            myArray[1] = (type === " days min")?" hours min":" hours max";
            myArray[2] = "hours";
        }
        //console.log(myArray);
        return myArray;
    }
</script>
</body>
</html>