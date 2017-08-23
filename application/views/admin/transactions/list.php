<div class="content-page">
    <div class="content">
        <div class="container">
            <!--Module Title-->    
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box">
                        <?php $message_notification = $this->session->flashdata('message_notification'); if ($message_notification) { ?>
                            <!-- Message Notification Start -->
                            <div id="message_notification">
                                <div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
                                    <button class="close" data-dismiss="alert" type="button">×</button>
                                    <strong>
                                        <?= $message_notification; ?>
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
                                <table class="table table-striped table-bordered table-hover table-checkable" id="subscriber_list">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="10%"> User Name </th>
                                            <th width="5%"> Paid For </th>
                                            <th width="15%"> Space Title/Subscription Name </th>
                                            <th width="10%"> Transaction Id </th>
                                            <th width="10%"> Amount Paid </th>
                                            <th width="10%"> Payer Email </th>
                                            <th width="10%"> Payment Date </th>
                                            <th width="10%"> Payment Status </th>
<!--                                            <th width="10%"> Action </th>-->
                                        </tr>
<!--                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td>
                                                <select class="form-control form-filter input-sm" name="paid_for">
                                                    <option></option>
                                                    <option value="rental">Rental</option>
                                                    <option value="subscription">Subscription</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
                                                <select name="payment_status" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>                                                    
                                                    <option value="Completed">Completed</option>
                                                    <option value="Declined">Declined</option>
                                                    <option value="Expired">Expired</option>
                                                    <option value="Failed">Failed</option>
                                                    <option value="In-Progress">In-Progress</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Processed">Processed</option>
                                                    <option value="Refunded">Refunded</option>
                                                    <option value="Reversed">Reversed</option>
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
                                        </tr>-->
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
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



<script>
    var TableDatatablesAjax = function () {

        var initPickers = function () {
            //init date pickers
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
        }



        var subscriber_list = function () {

            var grid = new Datatable();

            grid.init({
                src: $("#subscriber_list"),
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
                        "url": "<?= base_url(ADMIN_DIR . '/Transactions/get_all_list'); ?>", // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ],// set first column as a default sort by asc
                    dom: "Bfrtip",
                    buttons: [{
                        extend: "copy",
                        className: "btn-sm"
                    }, {
                        extend: "csv",
                        className: "btn-sm"
                    }, {
                        extend: "excel",
                        className: "btn-sm"
                    }, {
                        extend: "pdf",
                        className: "btn-sm"
                    }, {
                        extend: "print",
                        className: "btn-sm"
                    }],
                    //responsive: !0,
                    //scrollX: true
                }
            });
            
        }

        return {

            //main function to initiate the module
            init: function () {
                initPickers();
                subscriber_list();
            }

        };

    }();

    jQuery(document).ready(function () {
        TableDatatablesAjax.init();
        $('.btn-group').button();
    });
</script>
<!--Customer List Section End-->
