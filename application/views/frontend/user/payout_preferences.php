<section class="middle-container account-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <?php $this->load->view(FRONT_DIR . '/include/account-sidebar'); ?>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group" id="payoutMethods">
                        <div class="panel panel-default payout-methods">
                            <div class="panel-heading">Payout Methods</div>
                            <div class="panel-body">
                                <span id="showMessage"></span>
                                <span id="lsitShow">
                                    <?php
                                    if (!empty($check)) {
                                        echo $result;
                                    } else {
                                        ?>
                                        <div class="align-center">
                                            <p><img src="<?= base_url('theme/front/assests/'); ?>img/icon1.png" alt="" /></p>
                                            <p><strong>To get paid, you need to set up a payout method</strong></p>
                                            <p>Popln releases payouts about 24 hours after a professional’s scheduled check-in time. <br/>The time it takes for the funds to appear in your account depends on your payout method. <a href="#">Learn more</a></p>
                                            <hr>
                                            <button id="nextMessageBox" class="btn-red">Add Payout Method</button>
                                        </div>
                                    <?php }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Dipaly payout mthod message show here -->
                    <div class="panel-group" id="showMessageBox" style="display: none;">
                        <div class="panel panel-default payout-methods">
                            <div class="panel-heading">Payout Methods</div>
                            <div class="panel-body">
                                <div class="text-justify">
                                    <p>Payouts for reservations are released to you at the end of the business day (5pm) of the professional’s scheduled pop-in (rental start) time. The time it takes for the money to reach the account depends on your payment method.</p>
                                    <br>
                                    <p>We can send money to people with these payout methods. Which do you prefer?</p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Methods</th>
                                                <th>Processed IN</th>
                                                <th>Free</th>
                                                <th>Currency</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label for="payout_method_1"><input id="payout_method_1" type="radio" name="payout_method" value="1" checked>PayPal Account</label></td>
                                                <td>3-5 business days</td>
                                                <td>None</td>
                                                <td>USD</td>
                                                <td>Business day processing only; weekends and banking holidays may cause delays.</td>
                                            </tr>
<!--                                            <tr>
                                                <td><label for="payout_method_2"><input id="payout_method_2" <input type="radio" name="payout_method" value="2">Bank Transfer</label></td>
                                                <td>3-5 business days</td>
                                                <td>None</td>
                                                <td>USD</td>
                                                <td>Business day processing only; weekends and banking holidays may cause delays.</td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                    <hr>
                                    <span style="float: right;" ><button id="backBTn" class="btn2">Back</button>&nbsp;&nbsp;<button id="nextBTn" class="btn-red">Next</button></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add user payout method Form-->
                    <div class="panel-group" id="payoutMethodsShow" style="display: none;">
                        <div class="panel panel-default payout-methods">
                            <div class="panel-heading">Payout Methods</div>
                            <div class="panel-body">
                                <span id="showError"></span>
                                <div class="align-center">
                                    <!-- select type add account dropdown here -->
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3" for="payout-method" style="padding-top: 7px;">Preferred Payout Method:</label>
                                        <div class="col-sm-9 col-md-6">          
                                            <select class="form-control" name="selectType" >
                                                <option value="" disabled>Select Payout Method</option>
                                                <option value="1" >PayPal Account</option>
<!--                                                <option value="2" >Bank Account</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Add payPal account form start here -->
                                    <form id="paypalForm" class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3" for="pwd">First Name:</label>
                                            <div class="col-sm-9 col-md-6">          
                                                <input type="text" class="form-control" id="pwd" placeholder="Enter first name" name="firstName" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="pwd">Last Name:</label>
                                            <div class="col-sm-9 col-md-6">          
                                                <input type="text" class="form-control" id="pwd" placeholder="Enter last name" name="lastName">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="email">Email:</label>
                                            <div class="col-sm-9 col-md-6">
                                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">        
                                            <div class="col-sm-offset-6 col-sm-4">
                                                <button type="button" id="SubmitForm" class="btn-red">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Add payPal account form close here -->
                                    <!-- Add bank account information here -->
                                    <form id="bankAccountForm" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="pwd">Bank Account Type:</label>
                                            <div class="col-sm-9 col-md-6">          
                                                <select class="form-control" name="BankaccountType" >
                                                    <option value="" >Select Account Type</option>
                                                    <option value="Personal" >Personal</option>
                                                    <option value="Company" >Company</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="pwd">Bank Country:</label>
                                            <div class="col-sm-9 col-md-6">          
                                                <select class="form-control" name="bankCountry" >
                                                    <option value="" >Select bank country</option>
                                                    <?php
                                                    $all_country = unserialize(ALL_COUNTRY);
                                                    foreach ($all_country as $k => $v) {
                                                        ?>
                                                        <option value="<?= $k; ?>"><?= $v; ?></option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="email">Bank Name:</label>
                                            <div class="col-sm-9 col-md-6">
                                                <input type="text" class="form-control" id="email" placeholder="Enter bank name" name="bankName" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="email">Account Number:</label>
                                            <div class="col-sm-9 col-md-6">
                                                <input type="text" class="form-control" placeholder="Enter account number" name="accountNumber" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="email">IFSC Code:</label>
                                            <div class="col-sm-9 col-md-6">
                                                <input type="text" class="form-control" id="email" placeholder="Enter IFSC code" name="ifscCode" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="email">PAN Number:</label>
                                            <div class="col-sm-9 col-md-6">
                                                <input type="text" class="form-control" id="email" placeholder="Enter PAN Number" name="panNumber">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="email">Account Type:</label>
                                            <div class="col-sm-9 col-md-6">
                                                <select class="form-control" name="accountType" >
                                                    <option value="" >Select account type </option>
                                                    <option value="Current Account" >Current Account</option>
                                                    <option value="Saving Account" >Saving Account</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">        
                                            <div class="col-sm-offset-6 col-sm-4">
                                                <button type="button" id="bankDetailsSumbit" class="btn-red">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- close here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Close here form -->
                </article>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {

        $('#nextBTn').click(function () {
            var payout_method = $("input[name='payout_method']:checked").val();
            $('select[name="selectType"]').val(payout_method);
            $('select[name="selectType"]').trigger('change');
            $('#showMessageBox').css('display', 'none');
            $('#payoutMethods').css('display', 'none');
            $('#payoutMethodsShow').css('display', 'block');
        });
        $(document).on('click', '#nextMessageBox', function () {
            $('#payoutMethods').css('display', 'none');
            $('#payoutMethodsShow').css('display', 'none');
            $('#paypalForm, #bankAccountForm').hide();
            $('#showMessageBox').css('display', 'block');
        });
        $('#backBTn').click(function () {
            $('#showMessageBox').css('display', 'none');
            $('#payoutMethods').css('display', 'block');
            $('#payoutMethodsShow').css('display', 'none');
        });
        $('#backBTnSecond').click(function () {
            $('#showMessageBox').show();
            $('#payoutMethodsShow').hide();
        });
        $('select[name="selectType"]').change(function () {
            if (this.value === "1") {
                $('#paypalForm').show();
                $('#bankAccountForm').hide();
            } else if (this.value === "2") {
                $('#paypalForm').hide();
                $('#bankAccountForm').show();
            }
        });
        $('#SubmitForm').click(function () {
            var formData = $('#paypalForm').serialize();
            $.ajax({
                url: '<?= base_url('account/checkPaypal_Preferences') ?>',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $(".loader").show();
                },
                complete: function () {
                    $('.loader').hide();
                },
                success: function (response) {
                    var getvalue = response.split('||');
                    if (getvalue[1] == 'Failure') {
                        $('#showError').html('<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Warning! </strong> ' + getvalue[0] + '</div>');
                    } else {
                        $('#payoutMethodsShow').css('display', 'none');
                        $('#showMessageBox').css('display', 'none');
                        $('#payoutMethods').css('display', 'block');
                        $('#showMessage').html('<div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>You’ve successfully added a payout method.</strong></br>We’ll pay you through this payout method.</div>');
                        $('#lsitShow').html(getvalue[2]);
                    }
                    // <button id="nextMessageBox" class="btn-red">Add Payout Method</button> 
                }
            });
        });
        $('#bankDetailsSumbit').click(function () {
            var formData = $('#bankAccountForm').serialize();
            $.ajax({
                url: '<?= base_url('account/addBank_details') ?>',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $(".loader").show();
                },
                complete: function () {
                    $('.loader').hide();
                },
                success: function (response) {
                    if (response == 1) {
                        $('#showError').html('<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Warning! </strong> !Oops something is wrong. Please try again.</div>');
                    } else {
                        $('#payoutMethodsShow').css('display', 'none');
                        $('#showMessageBox').css('display', 'none');
                        $('#payoutMethods').css('display', 'block');
                        $('#showMessage').html('<div class="alert alert-success fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>You’ve successfully added a payout method.</strong></br>It’ll take up to 5 business days for us to verify it. Once its status is set to "Ready", we’ll pay you through this payout method.</div>');
                        $('#lsitShow').html(response);
                    }
                }
            });
        });
    });
</script>