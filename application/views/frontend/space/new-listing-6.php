<link href="<?= base_url('theme/front/assests/css/chosen.css'); ?>" rel="stylesheet" type="text/css" />
<?php $stepData = $this->session->userdata('stepData'); //print_array($stepData);?>
<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
        80% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner11 new-partner25">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>What amenities do you offer?</h3>
                    <form id="amenities-form" action="<?php echo site_url('Space/amenities_submit'); ?>" method="post" autocomplete="off">
                        <?php foreach($amenities['Important'] as $k => $amtyI){ ?>
                        <div class="feild">
                            <label for="<?= $k; ?>">
                                <input id="<?= $k; ?>" type="checkbox" name="amenities[main][]" value="<?= $amtyI['id']; ?>" <?php echo (isset($stepData['step1']['page5']['amenities']['main']) && !empty($stepData['step1']['page5']['amenities']['main']) && in_array($amtyI['id'], $stepData['step1']['page5']['amenities']['main']))? 'checked' : ''?>> <?= $amtyI['name']; ?>
                                <?php //if(!empty($v['desc'])): ?>
<!--                                <span></span>-->
                                <?php //endif;?>
                            </label>
                        </div>
                        <?php } ?> 
                        <div class="feild amenity hidden">
                            <label>More amenities</label>
                            <select class="selectbox  chosen-select" name="amenities[main][]" data-placeholder="Select Amenities" multiple>
                                <?php foreach($amenities['General'] as $amtyG){ ?>
                                <option value="<?= $amtyG['id']; ?>" <?php echo (isset($stepData['step1']['page5']['amenities']['main']) && !empty($stepData['step1']['page5']['amenities']['main']) && in_array($amtyG['id'], $stepData['step1']['page5']['amenities']['main']))? 'selected' : ''?>><?= $amtyG['name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="feild"><a href="#" class="show-more" data-target-key="amenity">+ Expand More</a></div>
                        
                        <div class="add-rules">
                            <div class="additional-rules">
                                <?php 
                                if(isset($stepData['step1']['page5']['amenities']['other']) && !empty($stepData['step1']['page5']['amenities']['other'])){
                                    foreach($stepData['step1']['page5']['amenities']['other'] as $amenity){
                                ?>
                                <div class="append-div">
                                    <input class="textbox" name="amenities[other][]" value="<?= $amenity; ?>" type="text" readonly />
                                    <a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a>
                                </div>
                                <?php }} ?>
                            </div>
                            <div class="clearfix">
                                <span class="pull-left"><input id="rule-text" class="textbox" type="text" placeholder="Add your own amenities" ></span>
                                <span class="pull-left"><button class="red-btn" id="add-rule" type="button">Add</button></span>
                            </div>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/location'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <h5>Have an amenity that isn't listed? Scroll down to the bottom of the list to add your own.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<style>
    .new-partner25 .add-rules .pull-left .textbox{
        width: 300px;
    }
    ul.chosen-choices{margin: 0 !important;}
    ul.chosen-choices li {font-size: 16px; font-weight: 600;}
    ul.chosen-results{ margin: 0 4px 4px 0 !important; }
    ul.chosen-results li{ margin: 0 !important; font-size: 16px; font-weight: 600; }
    
</style>
<script src="<?= base_url('theme/front/assests/js/chosen.js'); ?>"  type="text/javascript"></script>
<script type="text/javascript">
$('.chosen-select').chosen();
$(document).on('click', 'a.show-more', function(e){
    e.preventDefault();
    var $this = $(this), target = $(this).attr("data-target-key");

    //$("."+target).toggle();
    $( "."+target ).toggleClass(function() {
        if ( $( this ).is( ".hidden" ) ) {
            console.log('shown');
            $this.html('- Less');
            return "hidden";
        } else {
            console.log('hidden');
            $this.html('+ Expand More');
            return "hidden";
        }

    });
});
$("#amenities-form").submit(function(e){
    e.preventDefault();
    $(this).find("button[type='submit']").text('Please wait...');
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $("#amenities-form button[type='submit']").text('Next');
        window.location.href = "<?= site_url('Space/facilities'); ?>";
    });
});
$('#add-rule').click(function(){
    var text = $('#rule-text').val();
    if(text.trim() !== ""){
        $('.additional-rules').append('<div class="append-div"><input class="textbox" name="amenities[other][]" value="'+text+'" type="text" readonly /><a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a></div>');
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