<?php $stepData = $this->session->userdata('stepData'); ?>
<?php
if(isset($stepData['step1']['page4']['latitude']) && isset($stepData['step1']['page4']['longitude']) && !empty($stepData['step1']['page4']['latitude']) && !empty($stepData['step1']['page4']['longitude'])){
    $editMode = TRUE;
}else{
    $editMode = FALSE;
}
$zip = $state = $city = $street = "";
/*if(isset($stepData['start']['full_address']) && !empty($stepData['start']['full_address'])){
    $full_address = explode(",", $stepData['start']['full_address']);
    $street = isset($full_address[0])?trim($full_address[0]):"";
    $city   = isset($full_address[1])?trim($full_address[1]):"";
    $state  = isset($full_address[2])?trim($full_address[2]):"";
    $zip    = isset($full_address[3])?trim($full_address[3]):"";
}*/
?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
        60% Complete
    </div>
</div>
<section class="middle-container new-partner6 new-partner9">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>Where’s your business located?</h3>
                    <?php if(isset($stepData['start']['full_address']) && $editMode == TRUE): ?><h4 class="mr15"><?= $stepData['start']['full_address'];?></h4><?php endif;?>
                    <form id="location-form" action="<?php echo site_url('Space/location_submit'); ?>" method="post" <?php if($editMode){ echo "style='display: none;'"; }?>>
                        <div class="feild">
                            <label>Country</label>
                            <select class="selectbox custom-select" name="page4[country]">
                                <?php $all_countries = unserialize(ALL_COUNTRY); 
                                foreach($all_countries as $k=>$v){ ?>
                                <option value="<?= $k; ?>" <?php echo (isset($stepData['step1']['page4']['country']) && $stepData['step1']['page4']['country'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                <?php } ?> 
                            </select>
                        </div>
                        <div class="feild">
                            <label>Street Address</label>
                            <input type="text" class="textbox" name="page4[streetAddress]" placeholder="e.g 123 Main St." value="<?php echo isset($stepData['step1']['page4']['streetAddress'])? $stepData['step1']['page4']['streetAddress'] : $street?>" />
                        </div>
                        <div class="feild">
                            <label>Suite, Bldg. (optional)</label>
                            <input type="text" class="textbox" name="page4[suiteBuilding]" placeholder="e.g. Apt #7" value="<?php echo isset($stepData['step1']['page4']['suiteBuilding'])? $stepData['step1']['page4']['suiteBuilding'] : ''?>" />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="feild">
                                    <label>City</label>
                                    <input type="text" class="textbox" name="page4[city]" placeholder="Fullerton" value="<?php echo isset($stepData['step1']['page4']['city'])? $stepData['step1']['page4']['city'] : $city?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feild">
                                    <label>State</label>
                                    <input type="text" class="textbox" name="page4[state]" placeholder="CA" value="<?php echo isset($stepData['step1']['page4']['state'])? $stepData['step1']['page4']['state'] : $state?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="feild">
                                    <label>ZIP Code</label>
                                    <input type="text" class="textbox" name="page4[zipCode]" placeholder="e.g. 94103" value="<?php echo isset($stepData['step1']['page4']['zipCode'])? $stepData['step1']['page4']['zipCode'] : $zip?>" />
                                </div>
                            </div>
                        </div>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space/bathrooms'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red">Next</button>
                            </div>
                        </div>
                    </form>

                    <div id="location-map" <?php if(!$editMode){ echo "class='hidden'"; }?>>
                        <a href="javascript:;" id="edit-address">Edit address</a>
                        
                        <div class="map mr15" style="margin-top: 15px;">
                            <div id="display_map" style="width:100%;height:350px;"></div> 
                        </div>

                        <h4>Drag pin to change location.</h4>

                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <?php
                                if($editMode){
                                ?>
                                <a class="gost-btn" href="<?php echo site_url('Space/bathrooms'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                <?php }else{ ?>
                                <a class="gost-btn" href="javascript:;" id="map-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                <?php }?>
                            </div>
                            <div class="pull-right">
                                <form id="geo-location" action="<?php echo site_url('Space/geo_location_submit'); ?>" method="post">
                                    <input type="hidden" id="lat" name="latitude" value="<?= isset($stepData['step1']['page4']['latitude'])?$stepData['step1']['page4']['latitude']:'';?>">
                                    <input type="hidden" id="lng" name="longitude" value="<?= isset($stepData['step1']['page4']['longitude'])?$stepData['step1']['page4']['longitude']:'';?>">
                                    <button class="btn-red">Next</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    <h5>Your exact address will only be shared with confirmed professionals.</h5>
                </div>
            </div>
        </div>
    </div>    
</section>
<style type="text/css">
    label.error {
        color: #ff5a60 !important;
    }
</style>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDx2JMX91vY411oEI6jv4T34fpWeUdBRAI" type="text/javascript"></script>
<script type="text/javascript">
<?php if($editMode){ ?>            
    var full_address = "<?= $stepData['start']['full_address']; ?>";
    geocoder = new google.maps.Geocoder();

    geocoder.geocode( { 'address': full_address }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            // log out results from geocoding
            //console.log(results);parseFloat

            var latitude = document.getElementById('lat').value;
            var longitude = document.getElementById('lng').value;

            var latlngPos = new google.maps.LatLng(latitude, longitude);

            var myOptions = {
                zoom: 15,
                center: latlngPos,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE
                }
            };
            // Define the map
            var map = new google.maps.Map(document.getElementById("display_map"), myOptions);

            addMarker(latlngPos, full_address, map);
        }
    });
<?php }?>
    
$('#location-form').validate({
    rules: {
        'page4[country]' :{ required:true},
        'page4[streetAddress]' : { required:true},
        'page4[city]' : { required:  true },
        'page4[state]' : {required:true},
        'page4[zipCode]' : {required:true}
    },
    messages : {
        'page4[country]' :{ required:"Please select a country."},
        'page4[streetAddress]' : { required:"Please enter street address."},
        'page4[city]' : { required:"Please enter city."},
        'page4[state]' : { required:"Please enter state." },
        'page4[zipCode]' : {required:"Please enter zip code."}
    },
    submitHandler: function(form) {
        $('#location-form button').text('Please wait...');
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            dataType: 'json',
            success: function(response) {
                $(form).find('button').text('Next');
                $(".space-are h4:eq(0)").html(response.full_address);
                $(form).hide();
                $("#location-map").removeClass('hidden');
                //console.log("user entered location = " + response.full_address);

                geocoder = new google.maps.Geocoder();

                geocoder.geocode( { 'address': response.full_address }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        // log out results from geocoding
                        //console.log(results);parseFloat
                        
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();

                        document.getElementById('lat').value = latitude;
                        document.getElementById('lng').value = longitude;

                        var latlngPos = new google.maps.LatLng(latitude, longitude);

                        var myOptions = {
                            zoom: 15,
                            center: latlngPos,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            zoomControlOptions: {
                                style: google.maps.ZoomControlStyle.LARGE
                            }
                        };
                        // Define the map
                        var map = new google.maps.Map(document.getElementById("display_map"), myOptions);

                        addMarker(latlngPos, response.full_address, map);
                    }
                });
            }            
        });
    }
});
$("#edit-address, #map-back").on('click', function () {
    $('#location-form').show();
    $("#location-map").addClass('hidden');
});

$("#geo-location").submit(function(e){
    e.preventDefault();
    $('#geo-location button').text('Please wait...');
    $.post($("#geo-location").attr('action'), $("#geo-location").serialize(), function(){
        $('#geo-location button').text('Next');
        window.location.href = "<?= site_url('Space/amenities'); ?>";
    })
});

function addMarker(latlng,title,map) {
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: title,
        icon:'<?= base_url('assets/images/map-red.png'); ?>',
        draggable:true,
        animation: google.maps.Animation.DROP
    });
    // Add circle overlay and bind to marker
    var circle = new google.maps.Circle({
        map: map,
        radius: 250,            
        strokeColor: "#007a87",
        strokeOpacity: 0.8,
        strokeWeight: 1,
        fillColor: '#007a87',
        fillOpacity: 0.3,
        center: latlng
    });
    circle.bindTo('center', marker, 'position');

    google.maps.event.addListener(marker,'drag',function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    });

    google.maps.event.addListener(marker,'dragend',function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
        //alert(marker.getPosition());
    });
    /*google.maps.event.addListener(map, 'zoom_changed', function () {
        document.getElementById('zoom').value =map.getZoom();
    }); */   
}
</script>
</body>
</html>