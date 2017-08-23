<footer class="foot">
    <div class="container">
        <div class="row">
            <div class="foot_top clearfix">
                <div class="col-lg-3 one-foruth">
                    <select name="site_language" id="site_language">
                        <?php $all_languages = unserialize(LANGUAGES);
                        foreach ($all_languages as $k => $v) {
                            ?>
                            <option value="<?= $k; ?>"><?= $v; ?></option>
<?php } ?>
                    </select>

                    <select name="site_currency" id="site_currency">
                        <?php $all_currency = unserialize(CURRENCIES);
                        foreach ($all_currency as $k => $v) {
                            ?>
                            <option value="<?= $k; ?>"><?= $v; ?></option>
<?php } ?>
                    </select>
                </div>

                <?php
                $all_footer_sections = unserialize(FOOTER_SECTION);
                foreach ($all_footer_sections as $k => $v) {
                    $CI = & get_instance();
                    $CI->load->model(ADMIN_DIR . '/AdminSettings', 'settings');
                    $pages = $CI->settings->getAllFooterPages($k);
                    $pages_array = explode(',', $pages->page);
                    /* echo '<pre>';
                      print_r($pages_array);
                      exit; */
                    ?>

                    <div class="col-lg-3 one-foruth pd-left">
                        <h5><?= $v; ?></h5>
                            <?php if (!empty($pages_array)) { ?>
                            <ul>
                                <?php
                                foreach ($pages_array as $v) {
                                    $CI = & get_instance();
                                    $CI->load->model(ADMIN_DIR . '/AdminSettings', 'settings');
                                    $pageDetail = $CI->settings->getPageDetail($v);
                                    if (!empty($pageDetail)) {
                                        ?>
                                        <li><a href="<?= base_url('p/' . $pageDetail->url); ?>"><?= $pageDetail->pageName; ?></a></li>
                                <?php }
                            } ?>
                            </ul>
    <?php } ?>
                    </div>                
<?php } ?> 
            </div>
            <div class="foot_bottom clearfix">
                <div class="copy-right">
                    <p>&copy Popln, Inc.</p>
                </div>
                <div class="terms">
                    <ul>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Site Map</a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    //highlight current or active link
    $('.head-tab ul li a').each(function() {
        if ($($(this))[0].href === String(window.location)){
            $(this).addClass('active');
        }
    });
    $('input.icon1').focus(function () {
        $(this).attr('placeholder', 'Destination, city, address');
    }).blur(function () {
        $(this).attr('placeholder', 'Anywhere');
    });

    $('#guest_button').on("click", function (e) {
        $('#guest_open').slideToggle();
        e.stopPropagation();
    });
    $(document).on("click", function (e) {
        if (!(e.target.closest('#guest_open'))) {
            $("#guest_open").slideUp();
        }
    });
    // This button will increment the value
    $('.qtyplus').click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name=' + fieldName + ']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name=' + fieldName + ']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name=' + fieldName + ']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name=' + fieldName + ']').val(0);
        }
    });
});
</script>

<script src="<?= base_url('theme/front/assests/js/ac.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('theme/front/assests/js/fileuploader.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('theme/front/assests/js/fileuploader-custom2.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('theme/front/assests/js/bxslider.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/jquery.jcarousel.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/jcarousel.responsive.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/moment.min.js') ?>" type="text/javascript"></script>
<?php if(isset($search_nav) && $search_nav == 1){ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<?php }else{?>
<script src="<?php echo base_url('theme/front/assests/js/owl.carousel.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/daterangepicker.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/jquery-ui.js') ?>" type="text/javascript"></script>
<?php }?>
</body>
</html>
<?php
if ($this->session->userdata('session_login_id') == '') {
    include_once('user-modalbox.php');
}
?>