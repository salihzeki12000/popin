<?php $this->load->view('frontend/include/user-header'); ?>
<section class="middle-container account-section listings-section list-progress">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-sm-3 left-sidebar">
                    <?php $this->load->view('frontend/include/listing-sidebar'); ?>
                </aside>
                <article class="col-sm-9 main-right">                    
                    <div class="panel-group">
                        <?php if(empty($listings) && empty($inprogress)){?>
                        <div class="panel panel-default your-listings">
                            <div class="panel-body">
                                <h3>You don’t have any listings!</h3>
                                <p>Make money by renting out your extra space on Popln. You’ll also get to network with more professionals.</p>
                                <a class="green-btn" href="<?php echo site_url()?>Space">Post a new listing</a>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <?php if(!empty($inprogress)){ ?>
                        <div class="panel panel-default your-reservations">
                            <div class="panel-heading">In progress</div>
                            <div class="panel-body">
                                <?php foreach($inprogress as $listing){
                                $spaceType = $this->space_model->getDropdownDataRow('space_types', $listing['spaceType']);
                                if(!empty($spaceType)){
                                    $listing['spaceType'] = $spaceType['name'];
                                }
                                $total_percentage = $listing['step_1_percentage'] + $listing['step_2_percentage'] + $listing['step_3_percentage'];
                                
                                $spaceGallery = $this->db->select('image')->order_by('position', 'asc')->limit('1')->get_where('space_gallery', array('space' => $listing['id']))->row_array();
                                if(!empty($spaceGallery)){
                                    $listingImage = base_url('uploads/user/gallery/'.$spaceGallery['image']);
                                }else{
                                    if($listing['step_1_percentage'] == 100 && $listing['step_3_percentage'] > 0){
                                        $total_percentage = $listing['step_1_percentage'] + ($listing['step_2_percentage'] - 40) + $listing['step_3_percentage'];
                                    }
                                    
                                    $listingImage = base_url("theme/front/assests/img/cam-pic.jpg");
                                }
                                $listComplete = round($total_percentage/3);
                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <div class="inner">
                                            <img src="<?= $listingImage; ?>" alt="" />
                                        </div>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?= $listComplete;?>"
                                            aria-valuemin="0" aria-valuemax="100" style="width:<?= $listComplete; ?>%">
                                            </div>
                                        </div>
                                        <div class="pro-status"><p>You’re <?= $listComplete; ?>% done with your listing.</p></div>
                                        <h4><?= $listing['spaceTitle']; ?></h4>
                                        <h4><?= $listing['spaceType']; ?> in <?= $listing['city'].', '.$listing['state']; ?></h4>
                                        <p>Last updated on <?= date("d F, Y",$listing['updatedDate']); ?></p>
                                        <div class="three-btn">
                                            <a href="<?= site_url('Space/become-a-partner/'. $listing['id']); ?>" class="green-btn">Finish the Listing</a>
                                            <a target="_blank" href="<?= site_url('preview-listing/'.$listing['id']); ?>"><button class="btn">Preview</button></a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(!empty($listings)){ ?>
                        <div class="panel panel-default your-reservations">
                            <div class="panel-heading">Listed</div>
                            <div id="listingBlock" class="panel-body">
                                <?php echo $listings; ?>
                                <div style="text-align: center;display: none;" id="loader"><?php echo img(array("src"=>base_url("assets/images/loading-spinner-grey.gif"), "alt"=> "loading...")); ?></div>
                            </div>
                        </div>
                        <?php }}?>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('frontend/include/user-footer'); ?>
<style>
    #listingBlock .img {
        background-color: #484848;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 220px;
    }
    #listingBlock .item, #listingBlock .img {
        margin-bottom: 15px;
    }
    #listingBlock .item{
        padding: 0 8px;
    }
    #listingBlock .slide-main p {
        color: #484848;
        line-height: 16px;
        margin-bottom: 10px;
    }
    #listingBlock .slide-main p strong {
        font-size: 18px;
        font-weight: 600;
    }
</style>
<script>
//Scroll script 
var ajax_arry=[];
var ajax_index =0;
$(function () {    
    $(window).scroll(function(){
        var height = $('#listingBlock').height();
        var scroll_top = $(this).scrollTop();
        if(ajax_arry.length>0){
            for(var i=0;i<ajax_arry.length;i++){
                ajax_arry[i].abort();
            }
        }
        var page = $('#listingBlock').find('.nextpage').val();
        if ($(window).scrollTop() == $(document).height() - $(window).height() && page>0){
            $('#loader').show();
            var ajaxreq = $.ajax({
                            url:"<?php echo  site_url("Listing/listingData") ?>",
                            type:"POST",
                            data:"page="+page,
                            cache: false,
                            success: function(response){
                                    $('#listingBlock').find('.nextpage').remove();
                                    $('#listingBlock').find('#loader').remove();
                                    $('#listingBlock').append(response);
                                    $('#listingBlock').append('<div style="text-align: center;display: none;" id="loader"><?php echo img(array("src"=>base_url("assets/images/loading-spinner-grey.gif"), "alt"=> "loading...")); ?></div>');
                            }
            });
            ajax_arry[ajax_index++]= ajaxreq;
        }
        return false;
        if($(window).scrollTop() == $(window).height()) {
            alert("bottom!");
        }
    });
});
</script>