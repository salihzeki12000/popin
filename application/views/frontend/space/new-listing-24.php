<?php $stepData = $this->session->userdata('stepData');//print_array($stepData); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
        70% Complete
    </div>
</div>
<section class="middle-container new-partner37">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-9 col-md-offset-2">
                <div id='calendar'></div>
                <div class="next-prevs clearfix">
                    <div class="pull-left">
                        <a class="gost-btn" href="<?php echo site_url('Space/availability-settings'); ?>#settings-3"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </div>
                    <div class="pull-right">
                        <a class="green-btn" href="<?php echo site_url('Space/price-settings'); ?>"> Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
<script src="<?php echo base_url('theme/front/assests/js/jQuery.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/moment.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/fullcalendar.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/locale-all.js')?>" type="text/javascript"></script>
<script type="text/javascript">
        var slotsObj = [], buttonObj = {};
    	$(document).ready(function() {            
            var initialLocaleCode = 'en';
            $('#calendar').fullCalendar({
                    header: {
                            left: 'prev,next',
                            center: 'title',
                            right: ''
                    },
                    firstDay: 1,
                    defaultDate: '<?= date('Y-m-d')?>',
                    defaultView: 'month',
                    validRange: function(nowDate) {
                        return {
                            start: nowDate.subtract(1, 'day')
                            //end: nowDate.clone().add(1, 'months')
                        };
                    },
                    locale: initialLocaleCode,
                    showNonCurrentDates: false,
                    editable: true,
                    loading: function(bool) {
                            $('#loading').toggle(bool);
                    },
                    navLinks: false,
                    /*navLinkDayClick: function(date, jsEvent) {
                        alert('Date '+ date.format());
                        console.log('day', date.format()); // date is a moment
                        //console.log('coords', jsEvent.pageX, jsEvent.pageY);
                    },*/
            });
            // when the timezone selector changes, dynamically change the calendar option
            $('#timezone-selector').on('change', function() {
                    $('#calendar').fullCalendar('option', 'timezone', this.value || false);
            });
            $(".fc-right").append('<img id="loading" src="<?php echo base_url()?>/assets/images/loading-spinner-grey.gif">&nbsp;&nbsp;<button class="btn btn-default block-unblock" data-action="1">Unblock all dates</button>');
            $("#loading").hide();
            
            $(document).find("#calendar td.fc-day-top").each(function() {
                $(this).addClass('space-unavailable');
            });
            <?php
            if(isset($stepData['step3']['calendar'])){
                if(isset($stepData['step3']['calendar']['available_dates']) && !empty($stepData['step3']['calendar']['available_dates'])){
                    foreach($stepData['step3']['calendar']['available_dates'] as $date){
            ?>
                    var slotItem = {}, slotDate = '<?= $date; ?>';
                    slotItem ["booking"]    = "Available";
                    slotItem ["class"]      = "space-available";
                    slotItem ["canBook"]    = 1;
                    slotsObj[slotDate]      = slotItem;                    
            <?php            
                }}
            ?>
            <?php
                if(isset($stepData['step3']['calendar']['unavailable_dates']) && !empty($stepData['step3']['calendar']['unavailable_dates'])){
                    foreach($stepData['step3']['calendar']['unavailable_dates'] as $date){
            ?>
                    var slotItem = {}, slotDate = '<?= $date; ?>';
                    slotItem ["booking"]    = "Unavailable";
                    slotItem ["class"]      = "space-unavailable";
                    slotItem ["canBook"]    = 0;
                    slotsObj[slotDate]      = slotItem;                    
            <?php            
                }}
            ?>
                    console.log('slots ', slotsObj);
                    updateCalendar();
            <?php
            }
            ?>
            $(document).on('click', "#calendar td.fc-day-top", function(){
                var booking, canBook, setClass;
                var date = $(this).data('date');
                var item = {};
                $( this ).toggleClass(function() {
                    if ( $( this ).is( ".space-unavailable" ) ) {
                        booking = "Available";
                        canBook = 1;
                        setClass = "space-available";
                        $(this).addClass('space-available');
                    } else {
                        booking = "Unavailable";
                        canBook = 0;
                        setClass = "space-unavailable";
                    }
                    return "space-unavailable";
                });
                $( this ).find(".booking-status").remove();
                $( this ).append("<span class='booking-status'>" + booking + "</span>");
                
                item ["booking"]    = booking;
                item ["canBook"]    = canBook;
                item ["class"]      = setClass;
                slotsObj[date]      = item;   
                //console.log('slots ', slotsObj);
            });
            $(document).find('#calendar button.fc-prev-button').on('click', function() {                
                updateCalendar();
            });

            $(document).find('#calendar button.fc-next-button').on('click', function() {
                updateCalendar();
            });
            
            $(document).on('click', '#calendar .block-unblock', function() {
                var $button = $(this);
                var action = $button.data('action');
                //alert(action);
                if(action == "0"){ // Blocking
                    $(document).find("#calendar td.fc-day-top").each(function() {
                        $( this ).addClass("space-unavailable");
                        $( this ).find(".booking-status").remove();
                        //$( this ).append("<span class='booking-status'>Unavailable</span>");
                        
                        var date = $(this).data('date');
                        if (typeof slotsObj[date] !== "undefined") {
                            delete slotsObj[date];
                        }
                        var item = {};
                        item ["booking"]    = "Unavailable";
                        item ["canBook"]    = 0;
                        item ["class"]      = "space-unavailable";
                        slotsObj[date]      = item;
                    });
                    $( ".fc-right" ).find(".block-unblock").remove();
                    $(".fc-right").append('<button class="btn btn-default block-unblock" data-action="1">Unblock all dates</button>');
                    
                    var monthString = $(document).find('#calendar .fc-center h2').text();
                    var month = monthString.replace(/[0-9]/g, '');
                    buttonObj[month]      = "1";

                }else if(action == "1"){ // Unblocking
                    $(document).find("#calendar td.fc-day-top").each(function() {
                        $( this ).removeClass("space-unavailable");
                        $( this ).find(".booking-status").remove();
                        //$( this ).append("<span class='booking-status'>Available</span>");
                        
                        var date = $(this).data('date');
                        if (typeof slotsObj[date] !== "undefined") {
                            delete slotsObj[date];
                        }
                        var item = {};
                        item ["booking"]    = "Available";
                        item ["canBook"]    = 1;
                        item ["class"]      = "space-available";
                        slotsObj[date]      = item;
                    });
                    $( ".fc-right" ).find(".block-unblock").remove();
                    $(".fc-right").append('<button class="btn btn-default block-unblock" data-action="0">Block all dates</button>');
                    
                    var monthString = $(document).find('#calendar .fc-center h2').text();
                    var month = monthString.replace(/[0-9]/g, '');
                    buttonObj[month]      = "0";
                }
                console.log('slots ', slotsObj);
                //console.log('button ', buttonObj);
            });
 
            $(document).find('a.green-btn').on('click', function(e) {
                e.preventDefault();
                //console.log('slots ', Object.keys(slotsObj).length);
                if(Object.keys(slotsObj).length === 0){
                    alert("Please select some dates");
                    return false;
                }
                
                $(this).text('Please wait...');
                $.ajax({
                    url         : '<?php echo site_url('Space/calendar'); ?>',
                    data        : objectToFormData(slotsObj),
                    processData : false,
                    contentType : false,
                    type        : 'POST'
                }).done(function(data){
                    $('a.green-btn').text('Next');
                    window.location.href = $('a.green-btn').attr('href');
                });
            });
            // takes a {} object and returns a FormData object
            var objectToFormData = function(obj, form, namespace) {

              var fd = form || new FormData();
              var formKey;

              for(var property in obj) {
                if(obj.hasOwnProperty(property)) {

                  if(namespace) {
                    formKey = namespace + '[' + property + ']';
                  } else {
                    formKey = property;
                  }

                  // if the property is an object, but not a File,
                  // use recursivity.
                  if(typeof obj[property] === 'object' && !(obj[property] instanceof File)) {

                    objectToFormData(obj[property], fd, property);

                  } else {

                    // if it's a string or a File object
                    fd.append(formKey, obj[property]);
                  }

                }
              }

              return fd;

            };
	});
        function updateCalendar(){
            var isUnblocked = 0;
            $(document).find("#calendar td.fc-day-top").each(function() {
                var date = $(this).data('date');
                if (typeof slotsObj[date] !== "undefined") {
                    $( this ).removeClass("space-unavailable");
                    $( this ).addClass(slotsObj[date]["class"]);
                    $( this ).append("<span class='booking-status'>" + slotsObj[date]["booking"] + "</span>");
                }else{
                    $( this ).addClass("space-unavailable");
                }
                
                if($(this).hasClass("space-available")){
                    isUnblocked++;
                }                
            });
            
            $( ".fc-right" ).find(".block-unblock").remove();
            var monthString = $(document).find('#calendar .fc-center h2').text();
            var month = monthString.replace(/[0-9]/g, '');
            if (typeof buttonObj[month] !== "undefined") {
                if(buttonObj[month] === "0"){
                    $(".fc-right").append('<button class="btn btn-default block-unblock" data-action="0">Block all dates</button>');
                }else{
                    $(".fc-right").append('<button class="btn btn-default block-unblock" data-action="1">Unblock all dates</button>');
                }
            }else{
                $(".fc-right").append('<button class="btn btn-default block-unblock" data-action="1">Unblock all dates</button>');
            }
            
            if(isUnblocked > 0){
                $( ".fc-right" ).find(".block-unblock").remove();
                $(".fc-right").append('<button class="btn btn-default block-unblock" data-action="0">Block all dates</button>');
            }
        }
</script>
</body>
</html>