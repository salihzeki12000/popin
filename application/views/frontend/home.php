<?php if ($this->session->flashdata('alert_message')) { ?>
    <!-- Message Notification Start -->
    <div id="message_notification">
        <div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
            <button class="close" data-dismiss="alert" type="button">×</button>
            <center><strong><?= $this->session->flashdata('alert_message'); ?></strong></center>
        </div>
    </div>
    <!-- Message Notification End -->
<?php } ?>
<section class="home-main-content">
    <div class="row">
        <div class="container">
            <div class="feat-indus">
                <div class="row">
                    <div class="pull-left">
                        <h3>Industries</h3>
                    </div>
                    <div class="pull-right">
                        <a href="#">See all</a>
                    </div>
                </div>
                <div class="row">
                    <div id="jc1" class="jcarousel-wrapper">
                        <div class="jcarousel">
                            <ul class="clearfix">
                                <?php foreach($industries as $industry): ?>
                                <li>
                                    <div class="slide-main clearfix">
                                        <div class="slide-contant">
                                            <div class="img">
                                                <img src="<?php echo base_url('uploads/industries/'.$industry['slide_image']) ?>" alt="" />
                                            </div>
                                            <div class="content">
                                                <h4 class="text-center"><?= $industry['industry_name']; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                        <a href="#" class="jcarousel-control-next">&rsaquo;</a>
                        <p class="jcarousel-pagination"></p>
                    </div>
                </div>
            </div>
            <div class="feat-indus work-shops">
                <div class="row">
                    <div class="pull-left">
                        <h3>Workshops</h3>
                    </div>
                    <div class="pull-right">
                        <a href="<?= site_url('workshops'); ?>">See all</a>
                    </div>
                </div>
                <div class="row">
                    <div id="#jc2" class="jcarousel-wrapper">
                        <div class="jcarousel">
                            <ul class="clearfix">
                                <?php for($i=0; $i<10; $i++): ?>
                                <li>
                                    <div class="slide-main clearfix">
                                        <div class="slide-contant">
                                            <div class="img">
                                                <img src="<?php echo base_url('theme/front/assests/img/image5.jpg') ?>" alt="" />
                                            </div>
                                            <div class="content">
                                                <p><strong>$5,255</strong> Tune into daily rhythms with a Cuban scholars Team</p>
                                                <div class="review"><?= createRatingStars(rand(0, 5)); ?><span><?= rand(50, 500); ?> reviews</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                        <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                        <a href="#" class="jcarousel-control-next">&rsaquo;</a>
                        <p class="jcarousel-pagination"></p>
                    </div>
                </div>
            </div>
            
            <div class="feat-indus spaces">
                <div class="row">
                    <div class="pull-left">
                        <h3>Spaces</h3>
                    </div>
                    <div class="pull-right">
                        <a href="<?= site_url('spaces'); ?>">See all</a>
                    </div>
                </div>
                <div class="row">
                    <div class="owl-carousel owl-theme">
                        <?php if(!empty($featuredSpaces)): ?>
                        <?php foreach($featuredSpaces as $featuredSpace): $gallery = $this->user->getSpaceGallery($featuredSpace['id']); ?>
                        <div class="item">
                            <div class="slide-main clearfix">
                                <div class="slide-contant">
                                    <a target="_blank" href="<?= site_url('spaces/'.$featuredSpace['id']); ?>" style="color: inherit;">
                                        <div class="img" <?php if($gallery){ ?>style="background-image: url(<?= base_url('uploads/user/gallery/'.$gallery[0]); ?>);"<?php }?>>
                                        </div>
                                        <div class="content">
                                            <p><strong><?= getCurrency_symbol($featuredSpace['currency']).$featuredSpace['base_price']; ?><span></span> <?= $featuredSpace['spaceTitle']; ?> </strong></p>
                                            <p><span><?= $featuredSpace['establishment_type'].'/'.$featuredSpace['space_type']; ?> · </span><?= $featuredSpace['workSpaceCount']; ?> workspaces</p>
                                            <div class="review"><?= createRatingStars($featuredSpace['ratings']); ?><span><?= totalReivewsGet($featuredSpace['id']); ?> reviews</span></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php else: ?>
                        <?php for($i=0; $i<10; $i++): ?>
                        <div class="item">
                            <div class="slide-main clearfix">
                                <div class="slide-contant">
                                    <div class="img" style="background-image: url(<?php echo base_url('theme/front/assests/img/image1.jpg') ?>);">
                                    </div>
                                    <div class="content">
                                        <p><strong>$4,452<span></span> I SETTE CONI - TRULLO EDERA </strong></p>
                                        <p><span>Entire home/apt ·</span> 2 workspaces</p>
                                        <div class="review"><?= createRatingStars(rand(0, 5)); ?><span><?= rand(50, 500); ?> reviews</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endfor;?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<script type="text/javascript">
    
    $(function () {
        $('#demo-range').daterangepicker({
            autoUpdateInput: false,
            minDate: moment(),
            //showDropdowns: true,
            //timePicker: true,
            //timePickerIncrement: 30,
            locale: {
                format: 'MMM-DD' //MM/DD/YYYY h:mm A
            }
        }, 
        function(start, end, label) {
            //alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            $("#checkIn").val(start.format('YYYY-MM-DD'));$("#checkOut").val(end.format('YYYY-MM-DD'));
        });
        $('#demo-range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MMM-DD') + ' - ' + picker.endDate.format('MMM-DD'));
            mergeForms("space_search_form", "space_filter_form");
        });
        $('#demo-range').on('cancel.daterangepicker', function(ev, picker) {
            $("#checkIn").val('');
            $("#checkOut").val('');
            $(this).attr('placeholder', 'Anytime');
            mergeForms("space_search_form", "space_filter_form");
        });
        $('#demo-range').focus(function () {
            $(this).attr('placeholder', 'Pop In - Pop Out');
        }).blur(function () {
            $(this).attr('placeholder', 'Anytime');
        });
        //Initiate slider-one
        $('#jc1 .jcarousel')
                .jcarousel({
                    // Core configuration goes here
                })
                .jcarouselAutoscroll({
                    interval: 1000,
                    target: '+=1',
                    autostart: false
                });

        //Initiate slider-two
        $('#jc2 .jcarousel')
                .jcarousel({
                    // Core configuration goes here
                })
                .jcarouselAutoscroll({
                    interval: 1000,
                    target: '+=1',
                    autostart: false
                });
    });


    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false,
                    margin: 20
                }
            }
        });
    });
</script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('destination'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var mesg = "Address: " + address;
            mesg += "\nLatitude: " + latitude;
            mesg += "\nLongitude: " + longitude;
            $("#latitude").val(latitude);$("#longitude").val(longitude);
            mergeForms("space_search_form", "space_filter_form");
        });
    });
</script>
</body>
</html>
