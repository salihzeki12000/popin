<?php
	$this->load->view('frontend/include/user-header');
?>
<?php $all_countries = unserialize(ALL_COUNTRY); ?>
<!--<div class="print-section">
    <div class="container">
        <div class="row">
            <div class="media">
                <div class="media-left col-md-3">
                    <a href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i> To Itinerary</a>
                </div>
                <div class="media-body">
                    <button class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                </div>
            </div>
        </div>
    </div>
</div>-->
<section class="middle-container receipt-section">
    <div class="container">
        <div class="row">
            <div class="receipt-top clearfix">
                <h2>Receipt: <?= $bookingInfo['numberBooking'].' '.$bookingInfo['bookingType']; ?> in <?= $spaceInfo['city'].', '.$spaceInfo['state']; ?></h2>
                <div class="pull-left">
                    <p>Booked by <strong><?= $userInfo->firstName.' '.$userInfo->lastName; ?></strong> <br/><?= date("l, M d, Y", $bookingInfo['createdDate']); ?></p>
                </div>
                <div class="pull-right">
                    <p>Partner Approval: <strong><?= $bookingInfo['partnerStatus']; ?></strong></p>
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
                                $establishmentType = $this->space->getDropdownDataRow('establishment_types', $spaceInfo['establishmentType']); 
                                $spaceType = $this->space->getDropdownDataRow('space_types', $spaceInfo['spaceType']);
                                ?>
                                <h4><?= $establishmentType['name']; ?></h4>
                                <p><?= $spaceType['name']; ?> in <?= $spaceInfo['city']; ?> <br/><?= $spaceInfo['streetAddress']; ?> <?= !empty(trim($spaceInfo['suiteBuilding']))?'<br>'.$spaceInfo['suiteBuilding']:''; ?><br/><?= $spaceInfo['city']; ?>, <?= $spaceInfo['state']; ?> <?= $spaceInfo['zipCode']; ?> <br/><?= $all_countries[$spaceInfo['country']]; ?></p>
                                <p class="mr0">Hosted by <?= $hostInfo->firstName.' '.$hostInfo->lastName; ?> <br/>Phone: <?= $spaceInfo['mobileNumber']; ?></p>
                            </li>
                            <li>
                                <h4><?= $bookingInfo['professionals']; ?> Professional(s) on this rental</h4>
<!--                                <div class="media">
                                     <div class="media-left">
                                         <a href="#"><img class="media-object" src="<?php echo base_url('theme/front/assests/img/small-pic1.png')?>" alt=""></a>
                                     </div>
                                     <div class="media-body">
                                         <p>Cassidy Garcia</p>
                                     </div>
                                </div>
                                <a href="#"> &nbsp;+&nbsp; &nbsp; 1 more guest</a>-->
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
            <div class="cost-per">
                <strong>Cost per hour</strong>
                <p>This rental was <strong><?= getCurrency_symbol($spaceInfo['currency']).$spaceInfo['base_price']; ?></strong> per hour, excluding <br/>taxes and other fees</p>
                <?php if($spaceInfo['securityDeposit']>0){?>
                <strong>Security Deposit</strong>
                <p>Partner requires a Security Deposit of <?= getCurrency_symbol($spaceInfo['currency']).$spaceInfo['securityDeposit']; ?> to book this <br />listing. The Renter is responsible for the amount of the <br/>Security Deposit, but it will not be charged unless the partner makes a claim.</p>
                <?php } ?>
            </div>
            <div class="need-help clearfix">
                <div class="pull-left">
                    <h4>Need help?</h4>
                    <p>Visit the <a href="<?= site_url('page/help'); ?>">Help Center</a> for any questions.</p>
                </div>
                <div class="pull-right">
                    <p>Booked by <strong><?= $userInfo->firstName.' '.$userInfo->lastName; ?></strong> <br/><?= date("l, M d, Y", $bookingInfo['createdDate']); ?></p>
                </div>
            </div>
            <?php 
            $cancellation_term = 'Not Set'; $cancellation_term_details = '';
            foreach($cancellation_policies as $policy) {
                if($spaceInfo['cancellation_term'] == $policy['id']){
                    $cancellation_term = $policy['term'];
                    $cancellation_term_details = $policy['description'];
                }  
            }
            ?>
            <div class="policy">
                <p><strong>Cancellation policy:</strong> <a href="javascript:;"><?= $cancellation_term; ?></a>. Certain fees and taxes may be non-refundable. See <a href="#">here</a> for more details.</p>
                <p><?= $cancellation_term_details; ?></p>
<!--                <p><strong>Explanation of Security Deposit:</strong></p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>-->
                <p>Payment Processed by:<br/><strong>Popln, Inc.</strong><br/>1253 E. Imperial Highway<br/>Placentia, CA 92870</p>
            </div>
        </div>
    <div>
</section>
<?php
	$this->load->view('frontend/include/user-footer');
?>