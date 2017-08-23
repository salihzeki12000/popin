 <footer class="footer text-right">
                    <?= date('Y'); ?> © <?= SITE_DISPNAME; ?>.
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

                   <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?= base_url('theme/admin/assets/js/detect.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/assets/js/fastclick.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/assets/js/jquery.blockUI.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/assets/js/waves.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/assets/js/jquery.slimscroll.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/assets/js/jquery.scrollTo.min.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/plugins/switchery/switchery.min.js'); ?>"></script>

        <!-- Counter js  -->
        <script src="<?= base_url('theme/admin/plugins/waypoints/jquery.waypoints.min.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/plugins/counterup/jquery.counterup.min.js'); ?>"></script>

        <!--Morris Chart-->
        <script src="<?= base_url('theme/admin/plugins/morris/morris.min.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/plugins/raphael/raphael-min.js'); ?>"></script>

        <!-- Dashboard init -->
        <script src="<?= base_url('theme/admin/assets/pages/jquery.dashboard.js'); ?>"></script>

        <!-- App js -->
        <script src="<?= base_url('theme/admin/assets/js/jquery.core.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/assets/js/jquery.app.js'); ?>"></script>
        <script src="<?= base_url('theme/admin/plugins/datatables/app.js'); ?>" type="text/javascript"></script>
        
        <script src="<?= base_url('theme/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
        
         <!-- BEGIN DATATABLE PLUGINS -->
        <script src="<?= base_url('theme/admin/plugins/datatables/datatable.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('theme/admin/plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('theme/admin/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>" type="text/javascript"></script>
        <!--END DATATABLE PLUGINS-->
        
        <!--Summernote js-->
        <script src="<?= base_url('theme/admin/plugins/summernote/summernote.min.js'); ?>"></script>
        
        <script>

            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 350,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });

            });
        </script>
    </body>
</html>