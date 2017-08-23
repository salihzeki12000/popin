<style>
    /*close button has ben remove on the map*/
    .gm-style-iw + div {display: none;}
    .gm-style-iw > div > div {overflow: hidden !important;}
    #googleMap { width: 100%; height: 400px; top: 0; left: 0; right: 0; bottom: 0; }
    /*style the box*/  
    .gm-style .gm-style-iw {
        /*background-color: #fff !important;
        top: 0 !important;
        left: 0 !important;
        width: 120% !important;
        height: 100% !important;
        min-height: 150px !important;
        padding-top: 2px;
        padding-bottom: 5px;
        display: block !important;*/
    }    
    .gm-style .gm-style-iw {
        font-weight: 600;
        font-size: 16px;
        text-align: center;
    }
    .content.mapContent{
        padding-left: 17px;
        padding-top: 5px;
        font-family: 'Roboto', sans-serif;
        font-size: 15px;
    } 
</style>
<section class="spaces-home wishlist2">
    <div class="container-fluid">
        <div class="col-md-4 spaces-left">
            <div class="row">
                <div class="a-list">
                    <?php if($this->session->has_userdata('user_id') && $this->session->userdata('user_id') == $WishListMaster['user']){ ?>
                    <a href="<?= site_url('wishlists'); ?>">All lists</a>
                    <a class="posi" href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <?php }?>
                    <h3 class="wishlist-name"><?= $WishListMaster['name']; ?></h3>
<!--                    <p>No dates · 1 guest</p>
                    <a class="gost-btn" href="#">Invite others</a>-->
                </div>
                <?php if($this->session->has_userdata('user_id') && $this->session->userdata('user_id') == $WishListMaster['user']){ ?>
                <div class="after-click">
                    <form id="wishlist-form" method="post" action="<?php echo site_url("dashboard/update_wishlist"); ?>" novalidate autocomplete="off">
                        <div class="setting-s">
                            <div class="tow-btn clearfix">
                                <a class="pull-left" id="setting-clo" href="#">Cancel</a>
                                <button class="btn2 pull-right" type="submit">Save</button>
                            </div>
                            <h3>Settings</h3>
                            <div class="feild">
                                <h4>Name</h4>
                                <input type="hidden" name="wishlist_master_id" value="<?= $WishListMaster['id']; ?>">
                                <input type="text" class="textbox" name="wishlist_name" value="<?= $WishListMaster['name']; ?>" placeholder="Wish List Name"/>
                            </div> 
                        </div>
    <!--                    <div class="dat-e">
                            <div class="feild clearfix">
                                <h4>Dates</h4>
                                <div class="col-sm-6">
                                    <label for="startDate">Check In</label>
                                    <input id="startDate" class="textbox" placeholder="mm/dd/yyyy" type="text">
                                </div>
                                <div class="col-sm-6">
                                    <label for="endDate">Check Out</label>
                                    <input id="endDate" class="textbox" placeholder="mm/dd/yyyys" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="guest-s clearfix">
                            <div class="col-xs-12">
                                <div class="feild clearfix">
                                    <label>Adults</label>
                                    <span class="pull-right"><input value="" class="qtyminus" field="adult" type="button"> <input name="adult" value="0" class="qty" type="text"> <input value="" class="qtyplus" field="adult" type="button"></span>
                                </div>
                                <div class="feild clearfix">
                                    <label>Children<br> <span class="age">Ages 2 - 12</span></label>
                                    <span class="pull-right"><input value="" class="qtyminus" field="children" type="button"> <input name="children" value="0" class="qty" type="text"> <input value="" class="qtyplus" field="children" type="button"></span>
                                </div>
                                <div class="feild clearfix">
                                    <label>Infants<br> <span class="age">Under 2</span></label>
                                    <span class="pull-right"><input value="" class="qtyminus" field="infant" type="button"> <input name="infant" value="0" class="qty" type="text"> <input value="" class="qtyplus" field="infant" type="button"></span>
                                </div>
                                <div class="pull-left"><a href="#">Cancel</a></div>
                                <div class="pull-right"><a href="#">Apply</a></div>
                            </div>
                        </div>-->
                        <div class="setting-s invite-f clearfix">
                            <h4>Privacy</h4>
                            <select class="selectbox" name="privacy">
                                <option value="everyone" <?= $WishListMaster['privacy']=='everyone'?'selected':''; ?>>Everyone</option>
                                <option value="invite-only" <?= $WishListMaster['privacy']=='invite-only'?'selected':''; ?>>Invite Only</option>
                            </select>
                        </div>
    <!--                    <div class="invite-f clearfix">
                            <h4>Friends</h4>
                            <a href="#">Invite more</a>
                            <div class="col-xs-12">
                                <div class="media">
                                    <div class="media-left">
                                        <div class="inner">
                                            <img src="img/avatar-pic.png" class="img-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="media-body media-middle">
                                        <p>Shashank Shekhar</p>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </form>
                    <div class="invite-f clearfix" style="padding-bottom: 0;">
                        <a data-toggle="modal" data-target="#myModal2" href="#" data-wishlistId="<?= $WishListMaster['id']; ?>" data-wishlistName="<?= $WishListMaster['name']; ?>">Delete this Wish List</a>
                    </div>
                </div>
                <?php }?>
            </div>
            <?php if(!empty($WishListDetails)): ?>
            <div class="row">
                <h4 class="wishlist-homes"><?= count($WishListDetails); ?> listings</h4>
                <?php foreach($WishListDetails as $listing): ?>
                <?php
                $basePrice = (!empty($listing['base_price']))? getCurrency_symbol($listing['currency']). $listing['base_price']:'';
                $spaceTitle = $listing['spaceTitle'];
                $rentType = $listing['establishment_type'].'/'.$listing['space_type'];
                $workspaces = $listing['workSpaceCount']." workspaces";
                $gallery = $this->user->getSpaceGallery($listing['space_id']);
                ?>
                <div id="space-<?= $listing['space_id']; ?>" class="col-md-12 owl-carousel">
                    <?php foreach($gallery as $image):?>
                    <div class="item">
                        <div class="slide-main clearfix">
                            <div class="slide-contant">
                                <div class="activeBarContainer"></div>
                                <?php if($this->session->has_userdata('user_id') && $this->session->userdata('user_id') == $WishListMaster['user']){ ?>
                                <span class="add-to-wishlist pull-right" data-space-id="<?= $listing['space_id']; ?>" data-wishlist-id="<?= $WishListMaster['id']; ?>"><i class="fa fa-heart red"></i></span>
                                <?php }?>
                                <div class="img" style="background-image: url(<?= base_url('uploads/user/gallery/'.$image); ?>);"></div>
                                <div class="content">
                                    <p><strong><?= $basePrice; ?> · <?= $spaceTitle; ?></strong></p>
                                    <p><span><?= $rentType; ?> · </span> <?= $workspaces; ?></p>
                                    <div class="review"><?= createRatingStars($listing['ratings']); ?><span style="top: 2px;"><?= totalReivewsGet($listing['space_id']); ?> reviews</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="row nothing-saved">                
                <div class="col-sm-12 mr20">
                    <h4>Nothing saved yet</h4>
                </div>
                <div class="col-sm-12 mr20">
<!--                    <p class="line-height13em">When you find something you like, click the heart icon to save it. If you’re planning a rental with others, invite them so they can save and vote on their favorites.</p>-->
                    <p class="line-height13em">When you find something you like, click the heart icon to save it.</p>
                </div>
                <div class="col-sm-12">
                    <a class="btn2" href="<?= site_url('spaces'); ?>">Start exploring</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8 spaces-map">
            <div class="row">
                <div class="map-overlay"></div>
                <div class="only-map" id="googlemap">
                    
                </div>
            </div>
        </div>
    </div>
</section>
<?php if($this->session->has_userdata('user_id') && $this->session->userdata('user_id') == $WishListMaster['user']){ ?>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="delete-wishlist-form" method="post" action="<?= site_url('Dashboard/deleteWishList'); ?>">
                    <input type="hidden" name="wishlistId">
                    <img class="loader hidden" src="<?php echo base_url()?>/assets/images/loading-spinner-grey.gif">&nbsp;&nbsp;
                    <button class="btn2" type="submit">Yes, delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>                
            </div>
        </div>

    </div>
</div>
<?php }?>

<script type="text/javascript">
    $(document).ready(function () {
        <?php if($this->session->has_userdata('user_id')){ ?>
        $('#myModal2').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var wishlistName = button.attr('data-wishlistName'); // Extract info from data-* attributes
            var wishlistId = button.attr('data-wishlistId');
            var modal = $(this);
            modal.find('.modal-title').text('Are you sure you want to delete ' + wishlistName + '?');
            modal.find('.modal-body input[name="wishlistId"]').val(wishlistId);
        });
        $("#delete-wishlist-form").submit(function(e){
            e.preventDefault();
            $(".loader").removeClass('hidden');
            $(this).find("button[type='submit']").text('Please wait...');
            $.post($(this).attr('action'), $(this).serialize(), function(response){
                $(".loader").addClass('hidden');
                $("#delete-wishlist-form button[type='submit']").text('Deleted');
                if(response){
                    window.location.href = "<?= site_url('wishlists'); ?>";
                }else{
                    
                }
            });
        });
        $("#wishlist-form").submit(function(e){
            e.preventDefault();
            $.post($(this).attr('action'), $(this).serialize(), function(data){
                var response = JSON.parse(data);
                if(response.success){
                    $("body .wishlist-name").text($("input[name='wishlist_name']").val());
                    $('#setting-clo').trigger('click');
                }else{
                    
                }
            });
        });
        $(document).on('click', '.add-to-wishlist', function(){
            var $this = $(this);
            var wishlist_id = $(this).attr('data-wishlist-id');
            var space_id = $(this).attr('data-space-id');
            var params = {wishlist_id: wishlist_id, space_id: space_id};
            $.post("<?= site_url('dashboard/add_to_wishlist')?>", params, function(response){
                var result = JSON.parse(response);
                if(result.success === 1 || result.success === 2){
                    $this.find('i.fa').removeClass('fa-heart-o').addClass('fa-heart').addClass('red');
                }else if(result.success === 0){
                    $this.find('i.fa').removeClass('fa-heart').addClass('fa-heart-o').removeClass('red');
                }
            });
        });
        <?php }?>
        /*$('#startDate').daterangepicker({
         singleDatePicker: true,
         startDate: moment().subtract(6, 'days')
         });
         $('#endDate').daterangepicker({
         singleDatePicker: true,
         startDate: moment()
         });
         
         $('#startDate2').daterangepicker({
         singleDatePicker: true,
         startDate: moment().subtract(6, 'days')
         });
         $('#endDate2').daterangepicker({
         singleDatePicker: true,
         startDate: moment()
         });*/
        // This button will increment the value
        $('.qtyplus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
        // This button will decrement the value till 0
        $(".qtyminus").click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    });

    $('.map-overlay').hide();
    $('.posi').click(function (e) {
        e.preventDefault();
        $('.after-click').show();
        $('.map-overlay').show();
        $('.a-list,.nothing-saved').hide();
        $('.owl-carousel').parent().hide();
    });
    $('#setting-clo').click(function (e) {
        e.preventDefault();
        $('.after-click').hide();
        $('.map-overlay').hide();
        $('.a-list,.nothing-saved').show();
        $('.owl-carousel').parent().show();
    });
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    //highlight current or active link
    $('.head-tab ul li a').each(function() {
        if ($($(this))[0].href === String(window.location)){
            $(this).addClass('active');
        }
    });
    $('#destination').focus(function () {
        $(this).attr('placeholder', 'Destination, city, address');
    }).blur(function () {
        $(this).attr('placeholder', 'Anywhere');
    });

    $('#guest_button').on("click", function (e) {
        $('#guest_open').slideToggle();
        e.stopPropagation();
    });
    $(document).on("click", function (e) {
        if (!(e.target.closest('#guest_open'))) {
            $("#guest_open").slideUp();
        }
    });
    var initialVal = parseInt($("input[name='professionals']").val());
    // This button will increment the value
    $('.qtyplus').click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name=' + fieldName + ']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            currentVal++;
            $('input[name=' + fieldName + ']').val(currentVal);
            $("button#guest_button span:eq(1)").text(currentVal + " professionals");
        } else {
            // Otherwise put a 0 there
            //$('input[name=' + fieldName + ']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name=' + fieldName + ']').val());
        // If it isn't undefined or its greater than 0
        // Decrement one
            currentVal--;
        if (!isNaN(currentVal) && currentVal > 0) {
            
            $('input[name=' + fieldName + ']').val(currentVal);
            $("button#guest_button span:eq(1)").text(currentVal + " professionals");
        } else {
            // Otherwise put a 0 there
            //$('input[name=' + fieldName + ']').val(0);
        }
    });
    $('#guest-cancel').on("click", function(e) {
        e.preventDefault(); 
        $("input[name='professionals']").val(initialVal);
        $("button#guest_button span:eq(1)").text(initialVal+" professionals");
        $('#guest_open').slideToggle();
        e.stopPropagation(); 
    });
    $('#guest-apply').on("click", function(e) {
        e.preventDefault(); 
        mergeForms("space_search_form", "space_filter_form");
        $('#guest_open').slideToggle();
        e.stopPropagation(); 
    });
});
function mergeForms(form1, form2) {
    var forms = [];
    $.each($.makeArray(arguments), function(index, value) {
        forms[index] = document.forms[value];
    });
    var targetForm = forms[0];
    $.each(forms, function(i, f) {
        if (i != 0) {
            $(f).find('input, select, textarea')
                .hide()
                .appendTo($(targetForm));
        }
    });
    $(targetForm).submit();
}
</script>
<?php 
    $getViewHtml = array();
    $count = 1;
    $basePrice = $spaceTitle = $rentType= $workspaces='';
    foreach($WishListDetails as $listing):        
        $basePrice = (!empty($listing['base_price']))? getCurrency_symbol($listing['currency']). $listing['base_price']:'';
        $spaceTitle = $listing['spaceTitle'];
        $rentType = $listing['establishment_type'].'/'.$listing['space_type'];
        $workspaces = $listing['workSpaceCount']." workspaces";
        $gallery = $this->user->getSpaceGallery($listing['space_id']);

        if(!empty($gallery)){
            $listingHTML  =  '<span><img style="height:120px;width:100%;" src="'.base_url('uploads/user/gallery/'.$gallery[0]).'"></span><div class="content mapContent"><p><strong>'.$basePrice.' · '.$spaceTitle.'</strong></p><p><span style="font-family: \'Roboto\', sans-serif;" >'.$rentType.' · </span>'.$workspaces.'</p><div class="">'.createRatingStars($listing['ratings']).'&nbsp;&nbsp;<span>'.totalReivewsGet($listing['space_id']).' review</span></div></div>';      
        }
        $count = 1;
        $get['gallery']     = $listingHTML;
        $get['price']       = $basePrice;
        $get['target']      = "space-{$listing['space_id']}";
        $get['latitude']    = $listing['latitude'];
        $get['longitude']   = $listing['longitude'];
        $getViewHtml[] = $get;
    endforeach;
?>
<script>
var markers = [];
var labels = '';// The array where to store the markers
function initialize() {
    var mapOptions = {
        zoom: 2,
        center: new google.maps.LatLng(31.7860603,132.0853276),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("googlemap"), mapOptions);
    var getJson = <?php echo json_encode($getViewHtml); ?>;
    var getValue = [];
    var get = [];
    $.each(getJson, function(i,n) { 
          get['0']  = n.gallery;
          get['1']  = n.latitude;
          get['2']  = n.longitude;
          get['3']  = n.target;
          get['4']  = n.price;
          getValue.push(get);
          get = [];
    });
    // passing array value
    var locations = getValue; 
    var marker, i;
    var infowindow = new google.maps.InfoWindow();
    
    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            //title: "Derby",
            // label: {
            // color: 'red',
            // fontWeight: 'bold',
            // text: 'Price',
            // },
            // label: "<p style='color:red;' >hello</p>",
            // animation:google.maps.Animation.DROP,
            // icon: 'http://www.codeshare.co.uk/images/blue-pin.png'
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][4]);
                infowindow.open(map, marker);
                scroll(locations[i][3]);
            };
        })(marker, i));
        // Push the marker to the 'markers' array
        markers.push(marker);
    }
}
google.maps.event.addDomListener(window, 'load', initialize);
// The function to trigger the marker click, 'id' is the reference index to the 'markers' array.
function myClick(id){
    google.maps.event.trigger(markers[id], 'click');
}
function scroll(target){
    $('.spaces-left').animate({ scrollTop: $("html").find("#"+target).offset().top}, 500);
    $(".activeBarContainer").css('opacity','0');
    $("#"+target+" .activeBarContainer").css('opacity','1');
}
google.maps.event.addDomListener(window, 'load', function () {
    var places = new google.maps.places.Autocomplete(document.getElementById('search-box'));
    google.maps.event.addListener(places, 'place_changed', function () {
        var place = places.getPlace();
        var address = place.formatted_address;
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        var mesg = "Address: " + address;
        mesg += "\nLatitude: " + latitude;
        mesg += "\nLongitude: " + longitude;
        $("#latitude").val(latitude);$("#longitude").val(longitude);
        $(".space-search-form").submit();
    });
});
</script>
<script src="<?php echo base_url('theme/front/assests/js/moment.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/owl.carousel.js') ?>" type="text/javascript"></script>
<?php if(isset($search_nav) && $search_nav == 1){ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<?php }else{?>
<script src="<?php echo base_url('theme/front/assests/js/daterangepicker.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/jquery-ui.js') ?>" type="text/javascript"></script>
<?php }?>
</body>
</html>
<?php
if ($this->session->userdata('session_login_id') == '') {
    include_once('include/user-modalbox.php');
}
?>
