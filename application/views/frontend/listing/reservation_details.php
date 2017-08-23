<?php
	$this->load->view('frontend/include/user-header');
?>
<!-- Sweet Alert -->
<link href="<?= base_url('assets/global/sweetalert/sweetalert.css'); ?>" rel="stylesheet" type="text/css">
<?php $all_countries = unserialize(ALL_COUNTRY); ?>
<div class="loader" style="display:none;"></div>
<section class="middle-container receipt-section">
    <div class="container">
        <div class="row">
            <div class="receipt-top clearfix">
                <h2><?= $bookingInfo['numberBooking'].' '.$bookingInfo['bookingType']; ?> in <?= $spaceInfo['city'].', '.$spaceInfo['state']; ?></h2>
                <div class="pull-left">
                    <p>Booked by <strong><?= $userInfo->firstName.' '.$userInfo->lastName; ?></strong> <br/><?= date("l, M d, Y", $bookingInfo['createdDate']); ?></p>
                </div>
                <div class="pull-right">
                    <p>Partner Approval: <strong><?= $bookingInfo['partnerStatus']; ?></strong></p>
                    <?php if($this->session->userdata('user_id') == $hostInfo->id && strtolower($bookingInfo['partnerStatus']) == 'pending' && time() < strtotime($bookingInfo['checkOut'])):?>
                    <button class="btn2 update-request" data-booking-id="<?= $bookingInfo['id']; ?>" data-status="Accepted">Accept</button>
                    <button class="green-btn cancel-reservation" data-booking-id="<?= $bookingInfo['id']; ?>" data-status="Rejected">Reject</button>
                    <?php elseif($this->session->userdata('user_id') == $hostInfo->id && strtolower($bookingInfo['partnerStatus']) == 'accepted' && time() < strtotime($bookingInfo['checkOut'])):?>
                    <a href="javascript:;" class="green-btn cancel-reservation" data-booking-id="<?= $bookingInfo['id']; ?>" data-status="Rejected">Cancel Reservation</a>
                    <?php elseif(strtolower($bookingInfo['partnerStatus']) == 'rejected'):?>
                    <h5><b>Reason for Cancellation:</b> <?= $bookingInfo['reason']; ?></h5>
                    <?php endif;?>
                </div>
            </div>
            <div class="row receipt-slip clearfix">
                <div class="col-md-5">
                    <div class="receipt-left">
                        <ul>
                            <li class="clearfix">
                                <div class="pull-left">
                                    <span>Pop In</span>
                                    <strong><?= date("M d, Y", strtotime($bookingInfo['checkIn'])); ?><?php echo ($bookingInfo['checkInTime'] != "00:00:00")?': '.date("h:i a", strtotime($bookingInfo['checkInTime'])):''; ?></strong>
                                </div>
                                <div class="pull-right">
                                    <span>Pop Out</span>
                                    <strong><?= date("M d, Y", strtotime($bookingInfo['checkOut'])); ?><?php echo ($bookingInfo['checkOutTime'] != "00:00:00")?': '.date("h:i a", strtotime($bookingInfo['checkOutTime'])):''; ?></strong>
                                </div>
                            </li>
                            <li>
                                <?php 
                                $establishmentType = $this->space_model->getDropdownDataRow('establishment_types', $spaceInfo['establishmentType']); 
                                $spaceType = $this->space_model->getDropdownDataRow('space_types', $spaceInfo['spaceType']);
                                ?>
                                <h4><?= $establishmentType['name']; ?></h4>
                                <p><?= $spaceType['name']; ?> in <?= $spaceInfo['city']; ?></p>
                            </li>
                            <?php $avatar = ($userInfo->avatar != '' && file_exists('uploads/user/thumb/' . $userInfo->avatar)) ? $userInfo->avatar : 'user_pic-225x225.png'; ?>
                            <li>
                                <h4><?= $bookingInfo['professionals']; ?> Professional(s) on this rental</h4>
                                <div class="media">
                                     <div class="media-left">
                                         <a href="<?= site_url('home/viewProfile/'.$userInfo->id); ?>"><img class="media-object image-round image-border" src="<?= base_url('uploads/user/thumb/' . $avatar); ?>" height="50" width="50" alt=""></a>
                                     </div>
                                     <div class="media-body">
                                         <p><?= $userInfo->firstName.' '.$userInfo->lastName; ?></p>
                                     </div>
                                </div>
                                <?php $restProfessionals = $bookingInfo['professionals'] - 1; if($restProfessionals):?>
                                <br/>
                                <a href="javascript:;"> &nbsp;+&nbsp;<?= $restProfessionals; ?> more guest</a>
                                <?php endif;?>
                            </li>
                        </ul>
                    </div>
                    <div class="receipt-left business-trip">
                        <h3>Notes</h3>
                        <span class="font12"><?= !empty(trim($bookingInfo['professionalNote']))?nl2br($bookingInfo['professionalNote']):'None added'; ?></span>
                    </div>
                </div>
                <?php 
                $bookingCurrency = getCurrency_symbol($bookingInfo['currency']);
                $bookingPrice = $bookingInfo['totalAmount'] - $bookingInfo['addtionalCosts'];
                ?>
                <div class="col-md-7">
                    <div class="receipt-right">
                        <h3>Charges</h3>
                        <ul>
                            <li class="clearfix">
                                <div class="pull-left"><?= $bookingCurrency.$bookingInfo['amount']; ?> x <?= $bookingInfo['numberBooking'].' '.$bookingInfo['bookingType']; ?></div>
                                <div class="pull-right"><?= $bookingCurrency.$bookingPrice; ?></div>
                            </li>
                            <?php if($bookingInfo['bookingType'] == "days" && $bookingInfo['numberBooking']<7  && $spaceInfo['daily_discount']>0){?>
                            <li class="clearfix">
                                <div class="pull-left">Daily discount (Applied)</div>
                                <div class="pull-right"><?= $spaceInfo['daily_discount'].'%'; ?></div>
                            </li>
                            <?php } if($spaceInfo['cleaningFee']>0){?>
                            <li class="clearfix">
                                <div class="pull-left">Cleaning fees</div>
                                <div class="pull-right"><?= $bookingCurrency.$spaceInfo['cleaningFee']; ?></div>
                            </li>
                            <?php }
                            $settings = getSingleRecord('settings','id','1');
                            if($settings->serviceFee > 0){
                                $serviceCharges = round($bookingPrice * $settings->serviceFee / 100, 2);
                            ?>
                            <li class="clearfix">
                                <div class="pull-left">Service fee</div>
                                <div class="pull-right"><?= $bookingCurrency.$serviceCharges; ?></div>
                            </li>
                            <?php }?>                            
                        </ul>
                        <footer class="clearfix">
                            <div class="pull-left"><strong>Total</strong></div>
                            <div class="pull-right"><strong><?= $bookingCurrency.$bookingInfo['totalAmount']; ?></strong></div>
                        </footer>
                    </div>
                    
                    <div class="receipt-right payment">
                        <h3>Payment</h3>
                        <ul>
                            <?php if(!$bookingInfo['transactionId']): ?>
                            <li class="clearfix">
                                <div class="pull-left">Status: <?= $bookingInfo['paymentStatus'] ?></div>
                            </li>
                            <?php else: ?>
                            <li class="clearfix">
                                <div class="pull-left">Charged to <?= $bookingInfo['paymentAccount']; ?> <br/><?= date("M d, Y", $bookingInfo['updatedDate']); ?></div>
                                <div class="pull-right"><?= getCurrency_symbol($bookingInfo['currency_code']).$bookingInfo['payment_gross']; ?></div>
                            </li>
                            <?php endif;?>
                        </ul>
<!--                        <footer class="clearfix">
                            <a href="#">Add billing details</a>
                        </footer>-->
                    </div>
                    
                </div>
            </div>
            <div class="policy">
                <p>Payment Processed by:<br/><strong>PopIn, Inc.</strong><br/>1253 E. Imperial Highway<br/>Placentia, CA 92870</p>
            </div>
        </div>
    <div>
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
                        $this.parent().html('<p>Partner Approval: <strong>'+booking_status+'</strong></p>');
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
                $("button.update-request").parent().html('<p>Partner Approval: <strong>'+booking_status+'</strong></p>');
            }
        });
    });
});
</script>
<?php
	$this->load->view('frontend/include/user-footer');
?>