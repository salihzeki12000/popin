<?php $this->load->view('frontend/include/user-header'); ?>
<!-- Only for Calander -->
<link href="<?php echo base_url('theme/admin/plugins/fullcalendar/css/fullcalendar.min.css') ?>" rel="stylesheet" type="text/css" />
<!-- /Only for Calander -->
<section class="middle-container account-section listings-section list-progress">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <article class="col-sm-12 main-right">
                    <div class="col-sm-12 col-md-10 col-md-offset-1">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading"><?= $module_heading; ?></div>
                                <div class="panel-body">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('frontend/include/user-footer'); ?>
<script src="<?php echo base_url('theme/front/assests/js/moment.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/admin/plugins/fullcalendar/js/fullcalendar.min.js')?>" type="text/javascript"></script>
<script>
$(document).ready(function() {
		
    $('#calendar').fullCalendar({
            header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
            },
            firstDay: 1,
            defaultDate: '<?= date('Y-m-d'); ?>',
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            eventSources: [

                // your event source
                {
                    url: '<?= site_url('Listing/fetch_reservations'); ?>',
                    type: 'POST',
                    data: {
                        space_id: '<?= $space_id; ?>'
                    },
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: '#008489',   // a non-ajax option
                    //textColor: 'black' // a non-ajax option
                }

                // any other sources...

            ]
    });

});

</script>