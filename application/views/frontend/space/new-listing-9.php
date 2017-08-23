<?php $stepData = $this->session->userdata('stepData');//echo "<pre>"; print_r($stepData); echo "</pre>"; ?>
<link href="<?php echo base_url()?>theme/front/assests/css/bxslider.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>theme/front/assests/css/fileuploader.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url()?>theme/front/assests/js/fileuploader.min.js" type="text/javascript"></script>
<?php if(isset($stepData['step2']['fileuploader'])){ $editMode = true; ?>
<link href="<?php echo base_url()?>theme/front/assests/css/fileuploader-theme-thumbnails.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url()?>theme/front/assests/js/fileuploader-custom-2.js" type="text/javascript"></script>
<?php }else{ $editMode = false; ?>
<link href="<?php echo base_url()?>theme/front/assests/css/fileuploader-dragdrop.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url()?>theme/front/assests/js/fileuploader-custom.js" type="text/javascript"></script>
<?php }?>
<script src="<?php echo base_url()?>theme/front/assests/js/bxslider.js" type="text/javascript"></script>

<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
</div>
<section class="middle-container new-partner14">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-9 col-md-offset-2">
                <h3>Show professionals what your business looks like</h3>
                <div><input type="file" name="files" data-fileuploader-files='<?php if(isset($stepData['step2']['fileuploader'])){ echo $stepData['step2']['fileuploader']; }?>'></div>
                <p class="need-a">NEED A PHOTOGRAPHER?</p>
                <div class="next-prevs clearfix">
                    <div class="pull-left">
                        <a class="gost-btn" href="<?php echo site_url('Space/become-a-partner/'.$stepData['id']); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-default" id="skip-gallery" href="<?php echo site_url('Space/description'); ?>">Skip for now</a>
                        <img class="loader" src="<?php echo base_url()?>/assets/images/loading-spinner-grey.gif">&nbsp;&nbsp;
                        <button id="save-gallery" class="btn-red" style="display: none;">Next</button>
                    </div>
                </div>
                <div class="tips-slder">
                    <div class="help-panel" style="display: none;"><div class="help-panel-bulb-img img-center"></div></div>
                    <ul class="bxslider">
                        <li>
                            <div class="close-icon">
                                <a href="#"><img src="<?php echo base_url('theme/front/assests/img/close-icon.png')?>" alt="" /></a>
                            </div>
                            <div>
                                <br/>
                                <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                            </div>
                            <div class="img">
                                <br/>
                                <img src="<?php echo base_url('theme/front/assests/img/tip-slider-img-1.png')?>" alt="" />
                            </div>
                            <p><br/>Many owners have at least 8 photos. You can start with one photo and add more later. Include photos of all the spaces to help professionals imagine themselves using your space.</p>
                        </li>
                        <li style="height: auto;">
                            <div class="close-icon">
                                <a href="#"><img src="<?php echo base_url('theme/front/assests/img/close-icon.png')?>" alt="" /></a>
                            </div>
                            <div>
                                <br/>
                                <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                            </div>
                            <div class="img">
                                <br/>
                                <img src="<?php echo base_url('theme/front/assests/img/tip-slider-img-2.png')?>" alt="" />
                            </div>
                            <p><br/>Make sure the room is well-lit. Or take photos during daylight hours.</p>
                        </li>
                        <li>
                            <div class="close-icon">
                                <a href="#"><img src="<?php echo base_url('theme/front/assests/img/close-icon.png')?>" alt="" /></a>
                            </div>
                            <div>
                                <br/>
                                <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                            </div>
                            <div class="img">
                                <br/>
                                <img src="<?php echo base_url('theme/front/assests/img/tip-slider-img-3.png')?>" alt="" />
                            </div>
                            <p><br/>Sometimes shooting from a corner (instead of straight-on) gives you a better shot.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
</section>


<script type="text/javascript">
$('.bxslider').bxSlider({
    minSlides: 1,
    maxSlides: 1,
    slideWidth: 330,
    slideMargin: 10
});
<?php if($editMode){ ?> $(".bx-wrapper").hide();$(".help-panel").show();$("#skip-gallery").hide(); $("#save-gallery").show(); <?php }?>
$(".close-icon a").click(function(e){
    e.preventDefault();
    $(".bx-wrapper").slideUp('fast', 'linear', function() {
        $(".help-panel").show();
    });
}); 
$(".help-panel").click(function(e){
    e.preventDefault();
    $(".help-panel").hide();
    $(".bx-wrapper").slideDown('fast', 'linear');
}); 
$(".loader").hide();
$("#save-gallery").on('click', function(e){
    e.preventDefault();
    $(".loader").show();
    $("#save-gallery").text('Please wait...');
    $.get('<?php echo site_url('space/gallery_submit'); ?>', function(){
        $(".loader").hide();
        $('#save-gallery').text('Next');
        window.location.href = "<?= site_url('Space/description'); ?>";
    });
});
</script>
<style type="text/css">
    .help-panel {
        position: relative;
        height: 50px;
        width: 50px;
        cursor: pointer;
        padding-top: 8px;
        border: 0;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.08), 0 2px 2px rgba(0,0,0,0.04);
        -moz-box-shadow: 0 0 0 1px rgba(0,0,0,0.08),0 2px 2px rgba(0,0,0,0.04);
        box-shadow: 0 0 0 1px rgba(0,0,0,0.08), 0 2px 2px rgba(0,0,0,0.04);
        background-color: white;
        bottom: 22px;
    }
    .help-panel-bulb-img {
        margin-bottom: 14px;
        background-repeat: no-repeat;
        background-image: url(<?php echo base_url()?>theme/front/assests/img/bulb.png);
        width: 22px;
        height: 31px;
    }
    .img-center {
        margin: auto;
        background-position: center;
    }
</style>
</body>
</html>