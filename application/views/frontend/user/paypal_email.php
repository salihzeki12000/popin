<?php if($message_notification = $this->session->flashdata('message_notification')) { ?>
									<!-- Message Notification Start -->
									<div id="message_notification">
									<div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
										<button class="close" data-dismiss="alert" type="button">×</button>
										<strong>
											<?= $this->session->flashdata('message_notification'); ?> 
										</strong>
									</div>
									</div>
									<!-- Message Notification End -->
<?php } ?>
<section class="middle-container account-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <div class="sidenav-list">
						<ul>
							<li><a href="<?php echo base_url('account')?>" title="Notifications">Notifications</a></li>
							<li  class="active"><a href="<?php echo base_url('account/payment')?>" title="Payment Methods">Payment Methods</a></li>
							<li><a href="<?php echo base_url('account/transaction_history')?>" title="Transaction History">Transaction History</a></li>
							<li><a href="<?php echo base_url('account/privacy')?>" title="Privacy">Privacy</a></li>
							<li><a href="<?php echo base_url('account/security')?>" title="Security">Security</a></li>
							<li><a href="<?php echo base_url('account/settings')?>" title="Settings">Settings</a></li>
							<li><a href="<?php echo base_url('account/badges')?>" title="Badges">Badges</a></li>
						</ul>
                    </div>
                    <a class="btn btn-default btn-block" href="javascript:void(0);">Rental Credit</a>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        
                        <div class="panel panel-default gift-card">
                            <div class="panel-heading">Paypal Email Address</div>
                            <div class="panel-body">
							<form name="paymentAccount" id="paymentAccount" method="post" action="<?= base_url('account/submit_payment'); ?>">
                                <ul>
                                    <li><input type="text" name="paypalEmail" id="paypalEmail" value="<?= $hostProfileInfo->paypalEmail; ?>" /></li>
                                    <li><button type="submit" name="submit" id="submit" class="btn-red">Apply To Account</button></li>
                                </ul>
							 </form>
                                <p>Remember: <?= SITE_DISPNAME; ?> will never ask you to wire money. <a href="javascript:void(0);">Learn more</a>.</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
		</div>
    </div>
</section>
<script>
$(document).ready(function(e) {
		$('#paymentAccount').validate({
					rules: {
						paypalEmail : {email:true},
						
					},
					messages : {
						paypalEmail : {email : "Please Enter Valid Paypal Email Address"}
					}
				});		
    });
</script>