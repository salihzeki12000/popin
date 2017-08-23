<?php $stepData = $this->session->userdata('stepData'); ?>
<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%">
        90% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner11 new-partner25">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>What facilities can professionals use?</h3>
                    <form id="spaces-form" action="<?php echo site_url('Space/facilities_submit'); ?>" method="post">
                        <?php foreach($facilities as $k => $facility){ ?>
                        <div class="feild">
                            <label for="<?= $k; ?>">
                                <input id="<?= $k; ?>" type="checkbox" name="facilities[main][]" value="<?= $facility['id']; ?>" <?php echo (isset($stepData['step1']['page6']['facilities']['main']) && !empty($stepData['step1']['page6']['facilities']['main']) && in_array($facility['id'], $stepData['step1']['page6']['facilities']['main']))? 'checked' : ''?>> <?= $facility['name']; ?>
                                <?php if(!empty($facility['description'])): ?>
                                <span></span>
                                <?php endif;?>
                            </label>
                        </div>
                        <?php } ?>
                        <div class="add-rules">
                            <div class="additional-rules">
                                <?php 
                                if(isset($stepData['step1']['page6']['facilities']['other']) && !empty($stepData['step1']['page6']['facilities']['other'])){
                                    foreach($stepData['step1']['page6']['facilities']['other'] as $amenity){
                                ?>
                                <div class="append-div">
                                    <input class="textbox" name="facilities[other][]" value="<?= $amenity; ?>" type="text" readonly />
                                    <a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a>
                                </div>
                                <?php }} ?>
                            </div>
                            <div class="clearfix">
                                <span class="pull-left"><input id="rule-text" class="textbox" type="text" placeholder="Add your own facilities" ></span>
                                <span class="pull-left"><button class="red-btn" id="add-rule" type="button">Add</button></span>
                            </div>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/amenities'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                    <p>Spaces should be on the property. Don’t include laundromats or nearby places that aren’t part of your property.</p>
                </div>
            </div>
        </div>
    </div>    
</section>
<style>
    .new-partner25 .add-rules .pull-left .textbox{
        width: 300px;
    }
</style>
<script type="text/javascript">
$("#spaces-form").submit(function(e){
    e.preventDefault();
    $(this).find('button[type="submit"]').text('Please wait...');
    $.post($(this).attr('action'), $(this).serialize(), function(){
        $('#spaces-form button[type="submit"]').text('Finished');
        window.location.href = "<?= site_url('Space/become-a-partner'); ?>";
    });
});
$('#add-rule').click(function(){
    var text = $('#rule-text').val();
    if(text.trim() !== ""){
        $('.additional-rules').append('<div class="append-div"><input class="textbox" name="facilities[other][]" value="'+text+'" type="text" readonly /><a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a></div>');
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