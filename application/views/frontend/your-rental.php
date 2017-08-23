<?php
	$this->load->view('frontend/include/user-header');
?>
<?php if(empty($userRentals['upcoming']) && empty($userRentals['past'])): 
  $amount = getSingleRecord('settings','id','1');
?>
<div class="rentals-banner">
    <div class="container">
        <div class="pull-left"> 
        <!-- currency -->
            <h2>Choose your next office</h2>
            <p>Give your Colleagues <?= getCurrency_symbol($userProfileInfo->currency).number_format($amount->join_amount); ?> to try Popln and you will also<br /> get <?= getCurrency_symbol($userProfileInfo->currency).number_format($amount->referral_credit_amount); ?> in rental credit when they complete their first rental.</p>
            <a class="green-btn" href="<?= site_url('invite');?>">Invite Colleagues</a>
        </div>
        <div class="pull-right">
            <img src="<?php echo base_url('theme/front/assests/img/promo-pak.png')?>" alt="" />
        </div>
    </div>
</div>
<?php endif;?>
<?php if(!empty($userRentals['upcoming'])):?>
<section class="middle-container rentals-section">
    <div class="container">
        <h2>Upcoming Rentals</h2>
        <div class="row clearfix">
            <?php foreach($userRentals['upcoming'] as $rental):?>
            <div class="col-md-3 one-third">
                <div class="one-third-main">
                    <div class="img">
                        <img src="<?php echo $rental['space']['image']; ?>" alt="" />
                    </div>
                    <div class="content">
                        <h3><?php echo $rental['space']['title']; ?></h3>
                        <p><?php echo date("M d, Y", strtotime($rental['booking']['checkIn'])); ?><?php echo ($rental['booking']['checkInTime'] != "00:00:00")?': '.date("h:i a", strtotime($rental['booking']['checkInTime'])):''; ?><br/><?php echo $rental['space']['city'].' '.$rental['space']['state'].', '.$rental['space']['country']; ?></p>
                        <ul>
                            <li></li>
                            <li><a href="<?= site_url('rentals/receipt/'.$rental['booking']['id']);?>">View Receipt</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>    
</section>
<?php endif;?>
<?php if(!empty($userRentals['past'])):?>
<section class="middle-container rentals-section">
    <div class="container">
        <h2>Past Rentals</h2>
        <div class="row clearfix">
            <?php foreach($userRentals['past'] as $rental):?>
            <div class="col-md-3 one-third">
                <div class="one-third-main">
                    <div class="img">
                        <img src="<?php echo $rental['space']['image']; ?>" alt="" />
                    </div>
                    <div class="content">
                        <h3><?php echo $rental['space']['title']; ?></h3>
                        <p><?php echo date("M d, Y", strtotime($rental['booking']['checkIn'])); ?><?php echo ($rental['booking']['checkInTime'] != "00:00:00")?': '.date("h:i a", strtotime($rental['booking']['checkInTime'])):''; ?><?php echo ($rental['booking']['checkOutTime'] != "00:00:00")?' - '.date("h:i a", strtotime($rental['booking']['checkOutTime'])):''; ?> <br/><?php echo $rental['space']['city'].' '.$rental['space']['state'].', '.$rental['space']['country']; ?></p>
                        <ul>
                            <li>
                            <div class="text-center col-md-9 col-md-offset-2"><?= createHTMLRating($rental['booking']['space']); ?></div>                          
                            <br>
                            </li>
                            <li><a href="<?= site_url('rentals/receipt/'.$rental['booking']['id']);?>">View Receipt</a></li>
                            <li><a href="reivews/<?= $rental['booking']['id'].'/'.$rental['booking']['space'];?>">Submit Your Review</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>    
</section>
<?php endif;?>
<?php
	$this->load->view('frontend/include/user-footer');
?>