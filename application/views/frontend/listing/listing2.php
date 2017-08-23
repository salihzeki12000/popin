<?php $this->load->view('frontend/include/user-header'); ?>
<!-- Sweet Alert -->
<link href="<?= base_url('assets/global/sweetalert/sweetalert.css'); ?>" rel="stylesheet" type="text/css">
<div class="loader" style="display:none;"></div>
<section class="middle-container account-section listings-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-sm-2 left-sidebar">
                    <?php $this->load->view('frontend/include/listing-sidebar'); ?>
                </aside>
                <article class="col-sm-10 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default your-reservations">
                            <div class="panel-body">
                                <?php if(empty($myReservations)){ ?>
                                <p>You have no upcoming reservations.</p>
                                <?php }else{ ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Space Name</th>
                                                <th>Professionals</th>
                                                <th>Pop In</th>
                                                <th>Pop Out</th>
                                                <th>Actions</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($myReservations as $rental){ ?>
                                            <tr>
                                                <td><?php echo $rental['title']; ?></td>
                                                <td><?php echo $rental['professionals']; ?></td>
                                                <td>
                                                    <?php echo date("M d, Y", strtotime($rental['checkIn'])); ?><?php echo ($rental['checkInTime'] != "00:00:00")?': '.date("h:i a", strtotime($rental['checkInTime'])):''; ?>
                                                </td>
                                                <td>
                                                    <?php echo date("M d, Y", strtotime($rental['checkOut'])); ?><?php echo ($rental['checkOutTime'] != "00:00:00")?': '.date("h:i a", strtotime($rental['checkOutTime'])):''; ?>
                                                </td>
                                                <td>
                                                    <?php if(strtolower($rental['partnerStatus']) == 'pending'):?>
                                                    <button class="btn2 update-request" data-booking-id="<?= $rental['id']; ?>" data-status="Accepted">Accept</button>
                                                    <button class="green-btn cancel-reservation" data-booking-id="<?= $rental['id']; ?>" data-status="Rejected">Reject</button>
                                                    <?php elseif(strtolower($rental['partnerStatus']) == 'accepted'):?>
                                                    <a href="javascript:;" class="green-btn cancel-reservation" data-booking-id="<?= $rental['id']; ?>" data-status="Rejected">Cancel Reservation</a>
                                                    <?php elseif(strtolower($rental['partnerStatus']) == 'rejected'):?>
                                                    <h5><b><?= $rental['partnerStatus']; ?></b> </h5>
                                                    <?php endif;?>                                                    
                                                </td>
                                                <td><a href="<?= site_url('reservation-details/'.$rental['id']);?>">View</a></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php }?>
                                
                                <a href="<?= site_url('past-reservations'); ?>">View past reservation history</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<!-- Sweet-Alert  -->
<script src="<?= base_url('assets/global/sweetalert/sweetalert.min.js'); ?>"></script>
<script>
$(document).ready(function(){    
    $('.cancel-reservation').click(function () {
        var $this = $(this),
            booking_id = $(this).attr("data-booking-id"),
            booking_status = $(this).attr("data-status");
        swal({
            title: "Are you sure?",
            text: "Give a reason for the cancellation:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Reason for the cancellation"
          },
          function(inputValue){
            if (inputValue === false) return false;

            if (inputValue === "") {
              swal.showInputError("You need to write something!");
              return false;
            }else{
                $.ajax({
                    url: '<?= base_url('listing/update_reservation_request'); ?>',
                    type: 'POST',
                    data: {id: booking_id, status: booking_status, reason: inputValue},
                    success: function (response) {
                        $this.parent().html('<strong>'+booking_status+'</strong>');
                        swal("Nice!", "Reservation is cancelled successfully.", "success");
                    }
                });
            }
          });
    });
    $("button.update-request").on("click",function(){
        var booking_id = $(this).attr("data-booking-id"), booking_status = $(this).attr("data-status");
        $.ajax({
            url: '<?= base_url('listing/update_reservation_request'); ?>',
            type: 'POST',
            data: {id: booking_id, status: booking_status},
            beforeSend: function () {
                $(".loader").show();
            },
            complete: function () {
                $('.loader').hide();
            },
            success: function (response) {
                $("button.update-request").parent().html('<strong>'+booking_status+'</strong>');
            }
        });
    });
});
</script>
<?php $this->load->view('frontend/include/user-footer'); ?>
