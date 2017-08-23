<?php $message_notification = $this->session->flashdata('message_notification'); if ($message_notification) { ?>
    <!-- Message Notification Start -->
    <div id="message_notification">
        <div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
            <button class="close" data-dismiss="alert" type="button">×</button>
            <center><strong><?= $message_notification; ?></strong></center>
        </div>
    </div>
    <!-- Message Notification End -->
<?php } ?>
<section class="middle-container account-section">
    <div class="container">
        <div class="main-content">
                <div class="row clearfix">
                    <aside class="col-lg-3 left-sidebar">
                        <?php $this->load->view(FRONT_DIR . '/include/account-sidebar');?>
                    </aside>
                    <article class="col-lg-9 main-right">
                        <div class="panel-group">
                            <div class="panel panel-default pay-methods">
                                <div class="panel-heading">Payment Methods</div>
                                <div class="panel-body">
                                    <div class="add-payment">
                                        <ul>
                                            <?php foreach ($cardDetails as $k => $v) { ?>

                                                <li class="clearfix">
                                                    <p><?= 'XXXX-XXXX-XXXX-' . substr($v->cardNumber, -4); ?> <br/><?= (($v->expirationMonth < 10) ? '0' . $v->expirationMonth : $v->expirationMonth) . ' / ' . $v->expirationYear; ?></p>
                                                    <div class="wrap">
                                                        <div class="pull-left">
                                                            <?php if ($v->isPrimary == 'Yes') { ?>
                                                                Default Card
                                                            <?php } else { ?>
                                                                <a href="javascript:void(0);" onclick="setDefault('<?= $v->id; ?>')">Set Default</a>
                                                            <?php } ?>
                                                            <a href="javascript:void(0);" onclick="removeCard('<?= $v->id; ?>')">Remove</a>
                                                        </div>
                                                        <div class="pull-right">
                                                            <i class="fa fa-cc-<?= strtolower($v->cardType); ?> fa-3x"></i>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <li class="center">
                                                <a href="javascript:void(0);" onclick="openAddCardBox()">
                                                <center><img src="<?= base_url('theme/front/img/add-plus.png'); ?>" alt="" /></center>
                                                <p>Add Credit / Debit Card</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p>Remember: <?= SITE_DISPNAME; ?> will never ask you to wire money. <a href="javascript:void(0);">Learn more</a>.</p>
                                </div>
                            </div>
<!--                            <div class="panel panel-default gift-card">
                                <div class="panel-heading">Gift Card</div>
                                <div class="panel-body">
                                    <h3><?= SITE_DISPNAME; ?> gift card balance: <spna><?= $userProfileInfo->giftCardBalance; ?></spna></h3>
                                    <p>The credit balance from gift cards will be automatically applied when you book a trip.</p>
                                    <p class="card_code"><?= SITE_DISPNAME; ?> gift card code</p>
                                    <form method="post" action="<?= base_url('account/submit_gift_card'); ?>">
                                        <input type="hidden" name="giftCardBalance" value="<?= $userProfileInfo->giftCardBalance; ?>" />
                                        <ul>
                                            <li><input type="text" name="giftCardCode" /></li>
                                            <li><button class="btn-red">Apply to Account</button></li>
                                        </ul>
                                    </form>
                                    <a href="#"><?= SITE_DISPNAME; ?> gift cards help</a>
                                </div>
                            </div>-->
                            <div class="panel panel-default gift-card">
                                <div class="panel-heading">Paypal Email Address</div>
                                <div class="panel-body">
                                    <form name="paymentAccount" id="paymentAccount" method="post" action="<?= base_url('account/submit_payment'); ?>">
                                        <ul>
                                            <li><input type="text" name="paypalEmail" id="paypalEmail" value="<?= $userProfileInfo->paypalEmail; ?>" /></li>
                                            <li><button type="submit" name="submit" id="submit" class="btn-red">Apply To Account</button></li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <?php if(!empty($subscription)): $today = time(); ?>
                            <div class="panel panel-default gift-card">
                                <div class="panel-heading"><?= SITE_DISPNAME; ?> Subscription</div>
                                <div class="panel-body">
                                    <h3><?= $subscription->name; ?>: <span>$<?= $subscription->amount; ?> per month</span></h3>
                                    <p><?= $subscription->details; ?></p>
                                    <?php if(!empty($my_subscription)): ?>
                                    <p>You have successfully subscribed for this on <b><?= date("d F, Y", $my_subscription->subscribed_date); ?></b>.</p>
                                    <?php if(!empty($my_subscription->valid_date) && $my_subscription->valid_date >= time()){ ?>
                                    <p>Your subscription is valid till <b><?= date("d F, Y", $my_subscription->valid_date); ?></b>.</p>
                                    <?php }else{ ?>
                                    <p>Your subscription is expired now.</p>
                                    <form method="post" action="<?= base_url('account/buy_subscription'); ?>">
                                        <input type="hidden" name="subscription_code" value="<?= $subscription->code; ?>" />
                                        <input type="hidden" name="subscription_name" value="<?= $subscription->name; ?>" />
                                        <ul>
                                            <li><button class="btn-red">Renew subscription</button></li>
                                        </ul>
                                    </form>
                                    <?php }?>
                                    
                                    <?php elseif(!empty($paypalInfo)): ?>
                                    <p>You have successfully subscribed for <?= $subscription->name; ?>.</p>                 
                                    
                                    <?php else: ?>
                                    <form method="post" action="<?= base_url('account/buy_subscription'); ?>">
                                        <input type="hidden" name="subscription_code" value="<?= $subscription->code; ?>" />
                                        <input type="hidden" name="subscription_name" value="<?= $subscription->name; ?>" />
                                        <ul>
                                            <li><button class="btn-red">Buy now</button></li>
                                        </ul>
                                    </form>
                                    <?php endif;?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </article>
                </div>
        </div>
    </div>
</section>
<!--User Sign In Model Start-->
<div id="addCardBox" class="modal fade new-partner-model" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Credit / Debit Card</h4>
            </div>
            <form name="addCardForm" id="addCardForm" method="post" action="<?= base_url('account/submit_card'); ?>">
                <div class="modal-body">
                    <div class="felid form-group">
                        <input placeholder="Card Number" id="cardNumber" name="cardNumber" value="" class="textbox" type="text" />
                    </div>
                    <div class="felid form-group">
                        <p><b>Expiration</b></p><br>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="selectbox" name="expirationMonth" id="expirationMonth">
                                    <option value="" selected>Month</option>
                                    <?php $all_months = unserialize(MONTH_DIG);
                                    foreach ($all_months as $k => $v) { if($k != ""){
                                        ?>
                                        <option value="<?= $k; ?>"><?= $v." ({$k})"; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="selectbox" name="expirationYear" id="expirationYear">
                                    <option value="">Year</option>
                                    <?php for ($i = date('Y'); $i <= (date('Y') + 20); $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="felid">
                    </div><br><br>
                    <input type="submit" class="btn-red btn-block" name="card_submit" id="card_submit" value="Add Card">
                </div>
            </form>
        </div>
    </div>
</div>
<!--User Sign In Modal End-->
<script>
    function openAddCardBox()
    {
        $('#addCardBox').modal('show');
    }
    $(document).ready(function (e) {
        $('#paymentAccount').validate({
            rules: {
                paypalEmail: {email: true}

            },
            messages: {
                paypalEmail: {email: "Please Enter Valid Paypal Email Address"}
            }
        });
        $('#addCardForm').validate({
            rules: {
                cardNumber: {required: true, creditcard: true},
                expirationMonth: {required: true},
                expirationYear: {required: true}
            },
            messages: {
                cardNumber: {required: "Please Enter Card Number", creditcard: "Please Enter Valid Card Number"},
                expirationMonth: {required: "Please Select Expiration Month"},
                expirationYear: {required: "Please Select Expiration Year"}
            }
        });
    });

    function setDefault(id)
    {
        if (confirm('Are you sure, you want to set this card as your default card ?')) {
            window.location.href = "<?= base_url('account/set_default/') ?>" + id;

        } else {
            return false;
        }
    }

    function removeCard(id)
    {
        if (confirm('Are you sure, you want to remove this card ?')) {
            window.location.href = "<?= base_url('account/remove_card/') ?>" + id;
        } else {
            return false;
        }
    }

</script>
