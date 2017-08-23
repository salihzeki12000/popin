<link href="<?php echo base_url('theme/front/assests/css/fullcalendar.css'); ?>" rel="stylesheet" type="text/css" />
<section class="middle-container account-section your-scheduler">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <div class="sidenav-list">
                        <ul>
                            <li class="active"><a href="<?= site_url('scheduler'); ?>">Your Scheduler</a></li>
                            <li><a href="<?= site_url('services'); ?>">Your Services</a></li>
                        </ul>
                    </div>
                    <a class="green-btn" href="#">You Rentals</a>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">Scheduler</div>
                            <div class="panel-body">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url('theme/front/assests/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('theme/front/assests/js/fullcalendar.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2017-05-12',
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            events: [
                {
                    title: 'Business Lunch',
                    start: '2017-05-03T13:00:00',
                    constraint: 'businessHours'
                },
                {
                    title: 'Meeting',
                    start: '2017-05-13T11:00:00',
                    constraint: 'availableForMeeting', // defined below
                    color: '#257e4a'
                },
                {
                    title: 'Conference',
                    start: '2017-05-18',
                    end: '2017-05-20'
                },
                {
                    title: 'Party',
                    start: '2017-05-29T20:00:00'
                },

                // areas where "Meeting" must be dropped
                {
                    id: 'availableForMeeting',
                    start: '2017-05-11T10:00:00',
                    end: '2017-05-11T16:00:00',
                    rendering: 'background'
                },
                {
                    id: 'availableForMeeting',
                    start: '2017-05-13T10:00:00',
                    end: '2017-05-13T16:00:00',
                    rendering: 'background'
                },

                // red areas where no events can be dropped
                {
                    start: '2017-05-24',
                    end: '2017-05-28',
                    overlap: false,
                    rendering: 'background',
                    color: '#ff9f89'
                },
                {
                    start: '2017-05-06',
                    end: '2017-05-08',
                    overlap: false,
                    rendering: 'background',
                    color: '#ff9f89'
                }
            ]
        });
        $('.fc-right .fc-button-group').append('<div class="dropdown"><button class="fc-button fc-state-default dropdown-toggle" type="button" data-toggle="dropdown">+</button><ul class="dropdown-menu"><li><a data-toggle="modal" data-target="#myModal" href="#">Add Appointment</a></li><li><a href="#">Book New Rental</a></li></ul></div>');
        $('.fc-right .fc-button-group').append('<div class="dropdown"><button class="fc-button fc-state-default dropdown-toggle" type="button" data-toggle="dropdown">V</button><ul class="dropdown-menu"><li><a href="#">Change View</a></li><li><a href="#">My Schedule</a></li><li class="active"><a href="#">Barber on Wheels</a></li><li><a href="#">Orange Station</a></li></ul></div>');
    });
</script>