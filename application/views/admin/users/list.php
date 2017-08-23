
<div class="content-page">
    <div class="content">
        <div class="container">

            <!-- BEGIN PAGE BASE CONTENT -->

            <!--Module Title-->    
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box">
                        <?php if ($message_notification = $this->session->flashdata('message_notification')) { ?>
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
                        <h4 class="page-title"><?= $module_heading; ?></h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-body">
                            <div class="table-container">
                                <div class="table-actions-wrapper">
                                    <div class="col-sm-12 pull-right">
                                        <div class="col-sm-8"><select class="table-group-action-input form-control" name="status">
                                                <option value="">Select...</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Active">Active</option>
                                                <option value="Deactive">Deactive</option>
                                                <option value="Suspended">Suspended</option>
                                                <option value="Cancel">Cancel</option>
                                            </select></div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-teal btn-bordered waves-light waves-effect  m-b-5 table-group-action-submit"> Submit</button>
                                        </div>


                                    </div>

                                </div>

                                <table class="table table-striped table-bordered table-hover table-checkable" id="users_list">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="2%">
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th width="10%">Avatar</th>
                                            <th width="10%"> Name </th>
                                            <th width="10%">Email</th>
                                            <th width="10%">Number</th>
                                            <th width="10%">Gender</th>
                                            <th width="10%"> Created Date</th>
                                            <th width="10%"> Updated Date</th>
                                            <th width="10%"> Status </th>
                                            <th width="10%"> Actions </th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <td> </td>
                                            <td> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="name">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="email">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="phone">
                                            </td>
                                            <td>
                                                <select class="form-control form-filter input-sm" name="gender">
                                                    <option></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_date_from" placeholder="From">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_date_to" placeholder="To">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_date_from_updated" placeholder="From">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_date_to_updated" placeholder="To">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="status" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Active">Active</option>
                                                    <option value="DeActive">DeActive</option>
                                                    <option value="Suspended">Suspended</option>
                                                    <option value="Cencel">Cancelled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="m-b-5">
                                                    <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                                        <i class="fa fa-search"></i> Search</button>
                                                </div>
                                                <button class="btn btn-sm btn-danger filter-cancel">
                                                    <i class="fa fa-times"></i> Reset</button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
    </div>
</div>


<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Partners Detail</h4>
            </div>
            <div class="modal-body">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Basic Profile Details</h4><hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Avatar</label>
                                <p class="text-muted m-b-15 font-13 avatarBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">First Name</label>
                                <p class="text-muted m-b-15 font-13 firstNameBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Last Name</label>
                                <p class="text-muted m-b-15 font-13 lastNameBlock"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Email Address</label>
                                <p class="text-muted m-b-15 font-13 emailBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Phone Number</label>
                                <p class="text-muted m-b-15 font-13 phoneBlock"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Gender</label>
                                <p class="text-muted m-b-15 font-13 genderBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Date of Birth</label>
                                <p class="text-muted m-b-15 font-13 dobBlock"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Preferred Language</label>
                                <p class="text-muted m-b-15 font-13 languageBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Preferred Currency</label>
                                <p class="text-muted m-b-15 font-13 currencyBlock"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Where You Live ?</label>
                                <p class="text-muted m-b-15 font-13 addressBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Describe Yourself</label>
                                <p class="text-muted m-b-15 font-13 aboutYouBlock"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Business Name</label>
                                <p class="text-muted m-b-15 font-13 businessNameBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Business Number</label>
                                <p class="text-muted m-b-15 font-13 businessNumberBlock"></p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Verification Code</label>
                                <p class="text-muted m-b-15 font-13 verificationCodeBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Status</label>
                                <p class="text-muted m-b-15 font-13 statusBlock"></p>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Additional Profile Details</h4><hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">School/Institution Attended</label>
                                <p class="text-muted m-b-15 font-13 schoolInstitutionBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">License/Certificate Received</label>
                                <p class="text-muted m-b-15 font-13 licenceCertificateBlock"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Time Zone</label>
                                <p class="text-muted m-b-15 font-13 timeZoneBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Languages</label>
                                <p class="text-muted m-b-15 font-13 languagesBlock"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Emergency Contact</label>
                                <p class="text-muted m-b-15 font-13 emergencyContactBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Shipping Address</label>
                                <p class="text-muted m-b-15 font-13 shippingAddressBlock"></p>
                            </div>
                        </div>
                    </div>	
                </div>

                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Trust & Verification</h4><hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">License/Certificate Copy</label>
                                <p class="text-muted m-b-15 font-13 licenceCopyBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Establishment Year</label>
                                <p class="text-muted m-b-15 font-13 establishmentLicenceBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Liability Insurance</label>
                                <p class="text-muted m-b-15 font-13 liabilityInsuranceBlock"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Google Verified</label>
                                <p class="text-muted m-b-15 font-13 googleVerifiedBlock"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Google Email</label>
                                <p class="text-muted m-b-15 font-13 googleEmailBlock"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Account Notification Details</h4><hr>
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Text Message Settings</h4><hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">SMS Notification Number</label>
                                    <p class="text-muted m-b-15 font-13 numberNotificationBlock"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Messages (From Parnters and Users)</label>
                                    <p class="text-muted m-b-15 font-13 numberNotificationBlock"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Rentals Update (Requests, confirmations, changes and more)</label>
                                    <p class="text-muted m-b-15 font-13 rentalUpdatesBlock"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Other (Feature updates and more)</label>
                                    <p class="text-muted m-b-15 font-13 otherUpdatesBlock"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Email Settings</h4><hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">General and Promotional Emails</label>
                                    <p class="text-muted m-b-15 font-13 generalPromotionalEmailBlock"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Rentals and Review Reminders</label>
                                    <p class="text-muted m-b-15 font-13 rentalReviewRemindersBlock"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Account Activity</label>
                                    <p class="text-muted m-b-15 font-13 accountActivityBlock"></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Phone Preferences</h4><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Calls about my account, listings, Rentals, or the Popln community	</label>
                                    <p class="text-muted m-b-15 font-13 reciveCallsBlock"></p>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Payment Methods</h4><hr>
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Paypal Email Address</h4><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="text-muted m-b-15 font-13 paypalEmailBlock"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Crdit and Debit Cards</h4><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="text-muted m-b-15 font-13 cardsBlock"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Country Residance</h4><hr>
                    <p class="text-muted m-b-15 font-13 countryResidenceBlock">															
                    </p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->


<!-- End Bootstrap modal -->        

<script>
    var TableDatatablesAjax = function () {

        var initPickers = function () {
            //init date pickers
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
        };

        var users_list = function () {

            var grid = new Datatable();

            grid.init({
                src: $("#users_list"),
                onSuccess: function (grid, response) {
                    // grid:        grid object
                    // response:    json object of server side ajax response
                    // execute some code after table records loaded
                },
                onError: function (grid) {
                    // execute some code on network or other general error  
                },
                onDataLoad: function (grid) {
                    // execute some code on ajax data load
                },
                loadingMessage: 'Loading...',
                dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                    "lengthMenu": [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "pageLength": 10, // default record count per page
                    "ajax": {
                        "url": "<?= base_url(ADMIN_DIR . '/users/get_all_list'); ?>", // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
                }
            });

            // handle group actionsubmit button click
            grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                e.preventDefault();
                var action = $(".table-group-action-input", grid.getTableWrapper());
                if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                    grid.setAjaxParam("customActionType", "group_action");
                    grid.setAjaxParam("customActionName", action.val());
                    grid.setAjaxParam("id", grid.getSelectedRows());
                    grid.getDataTable().ajax.reload();
                    grid.clearAjaxParams();
                } else if (action.val() == "") {
                    App.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'Please select an action',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                } else if (grid.getSelectedRowsCount() === 0) {
                    App.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'No record selected',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                }
            });

        }

        return {

            //main function to initiate the module
            init: function () {
                initPickers();
                users_list();
            }

        };

    }();

    jQuery(document).ready(function () {
        TableDatatablesAjax.init();
        $('.btn-group').button();
    });
</script>
<!--Customer List Section End-->
<script>
    function view_user(id)
    {
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url(ADMIN_DIR . '/users/view') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('.firstNameBlock').html(data.firstName);
                $('.lastNameBlock').html(data.lastName);
                $('.phoneBlock').html(data.phone);
                $('.emailBlock').html(data.email);
                $('.dobBlock').html(data.dob);
                $('.genderBlock').html(data.gender);
                $('.languageBlock').html(data.language);
                $('.currencyBlock').html(data.currency);
                $('.addressBlock').html(data.address);

                $('.businessNameBlock').html(data.businessName);
                $('.businessNumberBlock').html(data.businessNumber);

                $('.aboutYouBlock').html(data.aboutYou);
                $('.schoolInstitutionBlock').html(data.schoolInstitution);
                $('.licenceCertificateBlock').html(data.licenceCertificate);
                $('.timeZoneBlock').html(data.timeZone);
                $('.emergencyContactBlock').html(data.emergencyContact);
                $('.languagesBlock').html(data.languages);
                $('.shippingAddressBlock').html(data.shippingAddress);
                $('.avatarBlock').html(data.avatar);


                $('.licenceCopyBlock').html(data.licenceCopy);
                $('.establishmentLicenceBlock').html(data.establishmentLicence);
                $('.liabilityInsuranceBlock').html(data.liabilityInsurance);
                $('.googleVerifiedBlock').html(data.googleVerified);
                $('.googleEmailBlock').html(data.googleEmail);
                $('.verificationCodeBlock').html(data.verificationCode);
                $('.paypalEmailBlock').html(data.paypalEmail);
                $('.notificationNumberBlock').html(data.notificationNumber);
                $('.numberNotificationBlock').html(data.numberNotification);
                $('.rentalUpdatesBlock').html(data.rentalUpdates);
                $('.otherUpdatesBlock').html(data.otherUpdates);
                $('.generalPromotionalEmailBlock').html(data.generalPromotionalEmail);
                $('.rentalReviewRemindersBlock').html(data.rentalReviewReminders);
                $('.accountActivityBlock').html(data.accountActivity);
                $('.reciveCallsBlock').html(data.reciveCalls);
                $('.countryResidenceBlock').html(data.countryResidence);
                $('.newsLetterBlock').html(data.newsLetter);
                $('.createdDateBlock').html(data.createdDate);
                $('.updatedDateBlock').html(data.updatedDate);
                $('.cardsBlock').html('<div class="row">');
                jQuery.each(data.card, function (i, val) {

                    $('.cardsBlock').append('<div class="col-lg-6 col-md-6"><div class="card-box widget-box-two widget-two-primary"><div class="wigdet-two-content"><div class="row"><p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Expiration : ' + val.expirationMonth + ' | ' + val.expirationYear + '</p></div><div class="row"><p class="text-muted m-0"><b>Card Number:</b> ' + val.cardNumber + '</p></div><div class="row"><p class="text-muted m-0"><b>Card Type:</b> ' + val.cardType + '</p></div><div class="row"><div class="pull-left"><p class="text-muted m-0"><b>Default:</b> ' + val.isPrimary + '</p></div><div class="pull-right"><i class="fa fa-cc-' + val.cardType.toLowerCase() + ' fa-3x"></i></div></div></div></div></div>');
                });
                $('.cardsBlock').append('</div>');
                $('.statusBlock').html(data.status);
                $('.removeSaveButton').html('');
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Partner Detail of ' + data.firstName + ' ' + data.lastName); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    }
</script>