
<div class="content-page">
    <div class="content">
        <div class="container">

            <!-- BEGIN PAGE BASE CONTENT -->

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
                                            <th width="15%"> Subscription Name </th>
                                            <th width="10%"> Subscribed Date </th>
                                            <th width="10%"> Paid Through </th>
                                            <th width="12%"> Paid With </th>
                                            <th width="10%"> Valid Till </th>
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
                        "url": "<?= base_url(ADMIN_DIR . '/Subscriptions/get_all_list'); ?>", // ajax source
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
