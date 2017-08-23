<div class="content-page">
    <div class="content">
        <div class="container">
            <!-- BEGIN PAGE BASE CONTENT -->

            <!--Module Title-->
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box">
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
                                        <div class="col-sm-8">
                                            <select class="table-group-action-input form-control" name="status">
                                                <option value="">Select...</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                                <option value="Yes">Featured</option>
                                                <option value="No">Remove Featured</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-teal btn-bordered waves-light waves-effect  m-b-5 table-group-action-submit"> Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover table-checkable" id="faq_category_list">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="2%">
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th width="10%"> Title</th>
                                            <th width="25%"> Industry / Establishment / Space</th>
                                            <th width="15%"> Space Details</th>
                                            <th width="3%"> Base Price</th>
                                            <th width="20%"> Created Date</th>
                                            <th width="15%"> Featured </th>
                                            <th width="15%"> Status </th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <td> </td>
                                            <td>
                                                <!-- <input type="text" class="form-control form-filter input-sm" name="name"> -->
                                            </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
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
                                                <select name="isFeatured" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <div style="margin-top: 2px;" ></div>
                                                <button class="btn btn-sm btn-success filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
                                                <button class="btn btn-sm btn-danger filter-cancel">
                                                <i class="fa fa-times"></i> Reset</button>
                                            </td>
                                            <td>
                                                <select name="status" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                                <div style="margin-top: 2px;" ></div>
                                                    <button class="btn btn-sm btn-success filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
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

<script>
    var TableDatatablesAjax = function() {

        var initPickers = function() {
            //init date pickers
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
        }

        var faq_category_list = function() {

            var grid = new Datatable();

            grid.init({
                src: $("#faq_category_list"),
                onSuccess: function(grid, response) {
                    // grid:        grid object
                    // response:    json object of server side ajax response
                    // execute some code after table records loaded
                },
                onError: function(grid) {
                    // execute some code on network or other general error  
                },
                onDataLoad: function(grid) {
                    // execute some code on ajax data load
                },
                loadingMessage: 'Loading...',
                dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

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
                        "url": "<?= base_url(ADMIN_DIR.'/PosteList/get_all_Space_list'); ?>", // ajax source
                    },
                    "order": [
                            [1, "asc"]
                        ] // set first column as a default sort by asc
                }
            });

            // handle group actionsubmit button click
            grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
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
            init: function() {
                initPickers();
                faq_category_list();
            }

        };

    }();

    jQuery(document).ready(function() {
        TableDatatablesAjax.init();
        $('.btn-group').button();
    });
</script>
<!--Customer List Section End-->