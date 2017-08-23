<link href="<?php echo base_url('theme/front/assests/css/btnswitch.css')?>" rel="stylesheet" type="text/css" />
<?php $stepData = $this->session->userdata('stepData'); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%">
        10% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner16 new-partner25">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Set space rules for professionals</h3>
                    <form class="listing-form" action="<?php echo site_url('Space/rules'); ?>" method="post" autocomplete="off">
                        <ul>
                            <li class="clearfix">
                                <div class="pull-left">
                                    <p>Age Requirements</p>
                                    <input type="number" placeholder="Age" min="1" name="ageLimit" value="<?= isset($stepData['step3']['page2']['ageLimit'])?$stepData['step3']['page2']['ageLimit']:'';?>" <?= (isset($stepData['step3']['page2']['ageRequirements']) && strtolower($stepData['step3']['page2']['ageRequirements']) == 'no')?"disabled":'';?> />
                                </div>
                                <div class="pull-right">
                                    <div class="demo1" id="a"></div>
                                    <input type="hidden" id="ageRequirements" name="ageRequirements" value="<?= isset($stepData['step3']['page2']['ageRequirements'])?$stepData['step3']['page2']['ageRequirements']:'Yes';?>" />
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="pull-left">
                                    <p>Display License or Certificate in workspace</p>
                                </div>
                                <div class="pull-right">
                                    <div class="demo1" id="b"></div>
                                    <input type="hidden" id="displayLicence" name="displayLicence" value="<?= isset($stepData['step3']['page2']['displayLicence'])?$stepData['step3']['page2']['displayLicence']:'Yes';?>" />
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="pull-left">
                                    <p>Suitable for pets</p>
                                </div>
                                <div class="pull-right">
                                    <div class="demo1" id="c"></div>
                                    <input type="hidden" id="suitablePets" name="suitablePets" value="<?= isset($stepData['step3']['page2']['suitablePets'])?$stepData['step3']['page2']['suitablePets']:'Yes';?>" />
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="pull-left">
                                    <p>Events or parties allowed</p>
                                </div>
                                <div class="pull-right">
                                    <div class="demo1" id="d"></div>
                                    <input type="hidden" id="eventPartiesAllowed" name="eventPartiesAllowed" value="<?= isset($stepData['step3']['page2']['eventPartiesAllowed'])?$stepData['step3']['page2']['eventPartiesAllowed']:'Yes';?>" />
                                </div>
                            </li>
                        </ul>
                        <div class="add-rules">
                            <h4>Additional rules</h4>
                            <div class="additional-rules">
                                <?php 
                                if(isset($stepData['step3']['page2']['additionalRules']) && !empty($stepData['step3']['page2']['additionalRules'])){ 
                                    foreach($stepData['step3']['page2']['additionalRules'] as $additionalRules){
                                ?>
                                <div class="append-div">
                                    <input class="textbox" name="additionalRules[]" value="<?= $additionalRules; ?>" type="text" readonly />
                                    <a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a>
                                </div>
                                <?php }} ?>
                            </div>
                            <div class="clearfix">
                                <span class="pull-left"><input id="rule-text" class="textbox" type="text" placeholder="Require scrubs? Required all-black wardrobe?"></span>
                                <span class="pull-left"><button class="red-btn" id="add-rule" type="button">Add</button></span>
                            </div>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/professional-requirements'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <h5>In addition to PopIn requirements, professionals must agree to all your Hou. Rules before they book.</h5>
                    <h5>If you're ever uncomfortable with a reservation, you can cancel penalty-free before or during a trip.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>

<script src="<?php echo base_url('theme/front/assests/js/jquery-3.1.1.slim.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/btnswitch.js')?>" type="text/javascript"></script>
<script type="text/javascript">
    $('#a').btnSwitch({
        OnValue: "Yes",
        OffValue: "No",
        ToggleState: $("#ageRequirements").val(),
        HiddenInputId: "ageRequirements",
        OnCallback: function(val) {
            //alert('system is now on');
            $("input[name='ageLimit']").prop("disabled", false);
        },
        OffCallback: function (val) {
            //alert('system is now off');
            $("input[name='ageLimit']").prop("disabled", true);
        }
    });
    $('#b').btnSwitch({
        OnValue: "Yes",
        OffValue: "No",
        ToggleState: $("#displayLicence").val(),
        HiddenInputId: "displayLicence"
    });
    $('#c').btnSwitch({
        OnValue: "Yes",
        OffValue: "No",
        ToggleState: $("#suitablePets").val(),
        HiddenInputId: "suitablePets"
    });
    $('#d').btnSwitch({
        OnValue: "Yes",
        OffValue: "No",
        ToggleState: $("#eventPartiesAllowed").val(),
        HiddenInputId: "eventPartiesAllowed"
    });
    $('#add-rule').click(function(){
        var text = $('#rule-text').val();
        if(text.trim() !== ""){
            $('.additional-rules').append('<div class="append-div"><input class="textbox" name="additionalRules[]" value="'+text+'" type="text" readonly /><a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a></div>');
            $('#rule-text').val('');
        }
    });
    $(document).on('click','.cancel-rule',function(event){
        event.preventDefault();
        $(this).parent('div').remove();
    });
    $(document).on("keypress", "input#rule-text", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('add-rule').click();
        }
    });
</script>
</body>
</html>