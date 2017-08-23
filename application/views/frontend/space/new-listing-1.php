<section class="middle-container new-partner5">
    <div class="container">
        <div class="row clearfix">
            <div class="col-sm-6 hi-cassiday">
                <h2>Hi, <?php echo $userProfileInfo->firstName; ?>! Let’s get your <br/>listing ready to start renting <br/>your space.</h2>
                <div class="step">Step 1</div>
                <h3>What kind of space do you have?</h3>
                <div class="row what-kind">
                    <form action="<?php echo site_url('Space/establishment'); ?>" method="post" autocomplete="off">
                        <div class="col-md-5">
                            <div class="feild">
                                <select class="selectbox" name="start[establishment]">
                                    <?php $establishments = unserialize(ESTABLISHMENT); 
                                    foreach($establishments as $establishment){ ?>
                                    <option value="<?= $establishment[0]; ?>"><?= $establishment[0]; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="feild">
                                <select class="selectbox" name="start[space]">
                                    <?php $spaces = unserialize(SPACE); 
                                    foreach($spaces as $space){ ?>
                                    <option value="<?= $space; ?>"><?= $space; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="feild">
                                <input type="text" class="textbox" name="start[full_address]" placeholder="Street Name, City, State, Zip" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn-red">Continue</button>
                        </div>
                    </form>
                </div>
                <div class="listing-star">
                    <img src="<?php echo base_url('theme/front/assests/img/star-icon.png')?>" alt="" />
                    <p>Listing for a week, we think you could earn</p>
                    <h5>$5,481&nbsp;<i class="fa fa-question-circle-o" aria-hidden="true"></i></h5>
                </div>
            </div>
        </div>
    </div>    
</section>
</body>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDx2JMX91vY411oEI6jv4T34fpWeUdBRAI" type="text/javascript"></script>
<script>
$('form').validate({
    rules: {
        'start[establishment]' :{ required:true},
        'start[space]' :{ required:true},
        'start[full_address]' :{ required:true}
    }
});
var currgeocoder;

         //Set geo location lat and long

         navigator.geolocation.getCurrentPosition(function(position, html5Error) {

             geo_loc = processGeolocationResult(position);
             currLatLong = geo_loc.split(",");
             initializeCurrent(currLatLong[0], currLatLong[1]);

        });

        //Get geo location result

       function processGeolocationResult(position) {
             html5Lat = position.coords.latitude; //Get latitude
             html5Lon = position.coords.longitude; //Get longitude
             html5TimeStamp = position.timestamp; //Get timestamp
             html5Accuracy = position.coords.accuracy; //Get accuracy in meters
             return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
       }

        //Check value is present or not & call google api function

        function initializeCurrent(latcurr, longcurr) {
             currgeocoder = new google.maps.Geocoder();
             console.log(latcurr + "-- ######## --" + longcurr);

             if (latcurr != '' && longcurr != '') {
                 var myLatlng = new google.maps.LatLng(latcurr, longcurr);
                 return getCurrentAddress(myLatlng);
             }
       }

        //Get current address

         function getCurrentAddress(location) {
              currgeocoder.geocode({
                  'location': location

            }, function(results, status) {
           
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results[0]);
                    $("input[name='start[full_address]']").val(results[0].formatted_address);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
         }

</script>
</html>