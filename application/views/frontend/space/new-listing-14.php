<?php $stepData = $this->session->userdata('stepData');?>
<?php if(isset($stepData['step2']['fileuploader'])){ $percentage = 90; $percentageText = $percentage."% Complete"; $barClass="success"; ?>
<?php }else{ $percentage = 50; $percentageText = $percentage."% Complete"; $barClass="warning"; }?>
<div class="progress">
    <div class="progress-bar progress-bar-<?= $barClass; ?> progress-bar-striped" role="progressbar" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage; ?>%">
        <?= $percentageText; ?>
    </div>
</div>
<?php
//if((isset($stepData['step2']['page6']['numberVerified']) && strtolower($stepData['step2']['page6']['numberVerified']) == 'yes')||($hostProfileInfo->phone_verify=='yes'))
$numberVerified = FALSE;
if(isset($stepData['step2']['page6']['numberVerified'])){
    if(strtolower($stepData['step2']['page6']['numberVerified']) == 'yes'){
        //$numberVerified = TRUE;
    }
}elseif (trim($hostProfileInfo->phone) != "" && strtolower($hostProfileInfo->phone_verify)=='yes') {
    //$numberVerified = TRUE;
}
?>

<section class="middle-container new-partner6 new-partner16 new-partner21 <?php echo ($numberVerified)?'new-partner22':''; ?>">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Add your mobile number</h3>
                    <form method="post" action="<?php echo site_url('space/phone_submit'); ?>" autocomplete="off">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="<?php echo base_url('theme/front/assests/img/mobile-icon-circle.png')?>" alt="" />
                                </a>
                            </div>
                            <?php
                            if(isset($stepData['step2']['page6']['mobileNumber']) && !empty($stepData['step2']['page6']['mobileNumber'])){
                                $mobile = explode("-",$stepData['step2']['page6']['mobileNumber']);
                                if(count($mobile) == 2){
                                    $country_code = $mobile[0];
                                    $mobile_number = $mobile[1];
                                }else{
                                    $mobile_number = $stepData['step2']['page6']['mobileNumber'];
                                }
                                
                            }else{
                                $mobile = explode("-",$hostProfileInfo->phone);
                                if(count($mobile) == 2){
                                    $country_code = $mobile[0];
                                    $mobile_number = $mobile[1];
                                }else{
                                    $mobile_number = $hostProfileInfo->phone;
                                }
                            } 
                            ?>
                            <div class="media-body media-middle">
                                <div class="mobile-number">
                                    <span class="country-code"><?= isset($country_code)?$country_code:'+1';?></span>
                                    <input <?php echo ($numberVerified)?'class="verified"':''; ?> type="text" name="page6[mobileNumber]" maxlength="10" value="<?= $mobile_number; ?>" <?php echo ($numberVerified)?'readonly':''; ?> />
                                    <?php if(!$numberVerified): ?>
                                    <a class="verify-button" href="javascript:;" onclick="verifyPhone()">Verify</a>
                                    <?php endif;?>
                                </div>
                                <?php if(!$numberVerified){ ?>
                                <p class="phone-country">Not in <span id="country-name">United States</span>? <a href="#" id="change-country">Change country</a>
                                <select id="country" style="position: relative;bottom: 0;left: 0;right: 0;top: 0; display: none;" name="country-code">
                                    <?php $all_countries = unserialize(MOBILECODES); 
                                    foreach($all_countries as $k=>$v){ ?>
                                    <option value="<?= $v['code']; ?>" <?= (isset($country_code) && ltrim($country_code,"+") == $v['code'])?"selected":"";?>><?= ucfirst(strtolower($v['name'])); ?></option>
                                    <?php } ?> 
                                </select>
                                </p>
                                <?php }else{ ?>
                                <input type="hidden" name="country-code" value="<?= isset($country_code)?ltrim($country_code,"+"):'1';?>">
                                <?php }?>
                                
                                <?php if(!$numberVerified){ ?>
                                <div class="varification">
                                    <p>Enter 4 digits code below:</p>
                                    <input class="verify selectbox" type="text" name="verifyCodeNumber" maxlength="4">
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <?php
                                $back_url = site_url('Space/profile-photo');
                                if(empty($hostProfileInfo->avatar)){
                                    $back_url = site_url('Space/profile-photo');
                                }else{
                                    $back_url = site_url('Space/title');
                                }
                                ?>
                                <a class="gost-btn" href="<?= $back_url; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit">Finish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <h5>Only confirmed professionals get your phone number. This helps Professionals contact your quickly if needed.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>

<script type="text/javascript">
    $("a#change-country").on('click', function(e){
        e.preventDefault();
        $("select#country").toggle();
    });
    $("select#country").on('change', function(){
        var mobile_code = $(this).val();
        var country_name = $(this).find('option:selected').text();

        $("span.country-code").text("+"+mobile_code);
        $("span#country-name").text(country_name);

        $(this).hide();
    });
    <?php
    if(isset($country_code)){
    ?>
        $("span#country-name").text($("select#country").find('option:selected').text());
    <?php
    }
    ?>
    $("input[name='page6[mobileNumber]']").keypress(function (e) {
        
        if (e.which !== 8 && e.which !== 0 && e.which !== 13 && (e.which < 48 || e.which > 57)) {
            //display error message
            var errorMsg = $('<label for="page6[mobileNumber]" class="error">Please enter digits only.</label>');
            $("label.error").remove();
            errorMsg.insertAfter($(this).parent());
            //$("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
        }else if(e.which === 13){
            verifyPhone();
        }else{
            $("label.error").remove();
            $("a.verify-button").css('display', 'inline-block');
        }
    });
    $("input[name='page6[mobileNumber]']").on('keyup', function () {
        if($(this).val() !== ""){
            $("a.verify-button").css('display', 'inline-block');
            $("form button[type='submit']").prop('disabled', true);
        }else{
            $("a.verify-button").css('display', 'none');
        }
    });
    
    $('form').validate({
        rules: {
            'page6[mobileNumber]' :{ required:true}
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        },
        submitHandler: function(form) {
            submitVerifyCode();
        }
    });
    function verifyPhone(){
        var numberCode  = $('select[name="country-code"]').val();
        var number      = $('input[name="page6[mobileNumber]"]').val();
        
        var fullphone   = '+' + numberCode + '' + number;
        
        $.ajax({
            url: '<?= base_url('Space/ajax_verify_phoneNumber'); ?>',
            type: 'POST',
            dataType: "json",
            data: {phone:fullphone},
            beforeSend: function(){
                $(".new-partner21 .media-body").block({ 
                    overlayCSS: { backgroundColor: '#E5E5E5' }, 
                    message: '<img src="<?= base_url(); ?>assets/images/loading-spinner-grey.gif" alt="please wait...">',
                    css: { border: 'none', backgroundColor: 'transparent' }  
                });
            },
            complete: function(){
                $(".new-partner21 .media-body").unblock();
            },
            success: function(response) {
                if(response){
                    $("section.new-partner21").addClass("new-partner22");
                    $("a.verify-button").hide();
                    $('input[name="page6[mobileNumber]"]').prop('readonly', true);
                    $("form button[type='submit']").prop('disabled', false);
                }
            }          
        });
    }
    function submitVerifyCode(){
        var enterCode  = $('input[name="verifyCodeNumber"]').val();
        if (typeof enterCode !== "undefined") {
            $.ajax({
                url: '<?= base_url('Space/ajax_verifyCode'); ?>',
                type: 'POST',
                dataType: "json",
                data: {enterCode:enterCode},
                beforeSend: function(){
                    $("p.error").remove();
                    $('form button').text('Please wait...');
                },
                complete: function(){
                    $('form button').text('Finish');
                },
                success: function(response) {
                    if (response === 1 || response === 2) {
                        $.post($('form').attr('action'), $('form').serialize(), function(){
                            $('input[name="page6[mobileNumber]"]').addClass('verified');
                            window.location.href = "<?= site_url('Space/become-a-partner'); ?>";
                        });
                    }else if (response === 0){
                        var errorMsg = $('<p class="error">Wrong verification code.</p>');
                        errorMsg.insertAfter($('input[name="verifyCodeNumber"]'));
                        return false;
                    }
                }          
            });
        }else{
            $('form button').text('Please wait...');
            $.post($('form').attr('action'), $('form').serialize(), function(){
                $('form button').text('Finish');
                window.location.href = "<?= site_url('Space/become-a-partner'); ?>";
            });
        }
    }
</script>
</body>
</html>