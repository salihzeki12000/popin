<?php 
$userID = $this->session->userdata('user_id'); 
$upcomingRentals = $this->user->getUpcomingRentals($userID);
$userWishLists = $this->user->getWishLists($userID);
?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rentals <span class="caret"></span></a>
<ul class="dropdown-menu">
    <li>
        <a href="<?= site_url('rentals'); ?>">
            <div class="view-trip clearfix">
                <div class="pull-left"><strong>Rentals</strong></div>
                <div class="pull-right"><strong>View Rentals</strong></div>
            </div>
        </a>
    </li>
    <?php if(!$upcomingRentals):?>
    <li>
        <div class="no-upcoming">
            <div class="content">
                <h4>No upcoming rentals</h4>
<!--                <p>Continue searching in Patagonia</p>-->
            </div>
            <div class="img-icon">
                <div class="inner">
                    <img src="<?= base_url('theme/front/img/nav-icon1.jpg'); ?>" width="75" height="75" alt="" />
                </div>
            </div>
        </div>
    </li>
    <?php else: foreach($upcomingRentals as $rental): ?>
    <li>
        <a href="<?= site_url('rentals'); ?>">
            <div class="no-upcoming">
                <div class="content">
                    <p><b><?= $rental['space']['title'];?></b>-<?= $rental['booking']['partnerStatus'];?></p>
                    <p><?= date('d M', strtotime($rental['booking']['checkIn'])).' - '. date('d M', strtotime($rental['booking']['checkOut']));?>&nbsp;<span class="dot">.</span>&nbsp;<?= $rental['booking']['professionals']; ?><?= $rental['booking']['professionals'] == 1?" professional":" professionals";?></p>
                </div>
                <div class="img-icon">
                    <div class="inner">
                        <img src="<?= $rental['space']['image'];?>" width="75" height="75" alt="" />
                    </div>
                </div>
            </div>
        </a>
    </li>
    <?php endforeach; endif; ?>
    <li>
        <a href="<?= site_url('wishlists'); ?>">
            <div class="view-trip clearfix">
                <div class="pull-left"><strong>Wish Lists</strong></div>
                <div class="pull-right"><strong>View Wish Lists</strong></div>
            </div>
        </a>
    </li>
    <li>
        <?php if(empty($userWishLists)):?>
        <a href="<?= site_url('wishlists'); ?>">
            <div class="no-upcoming">
                <div class="content">
                    <h4>No Wish List created</h4>
                    <p>Create a wish list</p>
                </div>
                <div class="img-icon">
                    <div class="inner">
                        <img src="<?= base_url('theme/front/img/nav-icon2.png'); ?>" alt="" />
                    </div>
                </div>
            </div>
        </a>
        <?php else: if(isset($userWishLists[0])){?>
        <a href="#">
            <div class="no-upcoming">
                <div class="content">
                    <h4><?= $userWishLists[0]['name'];?></h4>
                    <p><?= isset($userWishLists[0]['userLists'])?count($userWishLists[0]['userLists']):'0';?> Listings</p>
                    <p><?= (isset($userWishLists[0]['userLists']) && !empty($userWishLists[0]['userLists']))?$userWishLists[0]['userLists'][0]['professionals'].' professionals':'1 professional';?></p>
                </div>
                <div class="img-icon">
                    <div class="inner">
                        <?php if(!isset($userWishLists[0]['userLists'])){ ?>
                        <img src="<?= base_url('theme/front/img/nav-icon2.png'); ?>" alt="" />
                        <?php }else{ ?>
                        <img src="<?= $userWishLists[0]['userLists'][0]['image']; ?>" alt="" />
                        <?php }?>
                    </div>
                </div>
            </div>
        </a>
        <?php } endif; ?>
    </li>
    <li>
        <a href="<?= site_url('scheduler'); ?>">
            <div class="view-trip clearfix">
                <div class="pull-left"><strong>Scheduler</strong></div>
                <div class="pull-right"><strong>Manage Scheduler</strong></div>
            </div>
        </a>
    </li>
</ul>