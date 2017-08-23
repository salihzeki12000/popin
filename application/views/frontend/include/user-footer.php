<footer class="foot">
    <div class="container">
        <div class="row">
            <div class="foot_top clearfix">
                <div class="col-lg-3 one-foruth">
                    <div id="google_translate_element"></div>
<!--                    <select name="site_language" id="site_language">-->
                        <?php $all_languages = unserialize(LANGUAGES);
                        $langCodes = '';
                        foreach ($all_languages as $k => $v) {
                            $langCodes .= $k.',';
                            ?>
<!--                            <option value="<?= $k; ?>" <?= !empty($userProfileInfo->language) ? ($userProfileInfo->language == $k ? 'selected' : '') : ($k == 'en' ? 'selected' : ''); ?> ><?= $v; ?></option>-->
                        <?php } $allLangCodes = rtrim($langCodes, ','); ?>
<!--                    </select>-->

                    <select name="site_currency" id="site_currency">
                        <?php $all_currency = unserialize(CURRENCIES);
                        foreach ($all_currency as $k => $v) {
                            ?>
                            <option value="<?= $k; ?>" <?= !empty($userProfileInfo->currency) ? ($userProfileInfo->currency == $k ? 'selected' : '') : ($k == 'USD' ? 'selected' : ''); ?> ><?= $v; ?></option>
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
                                        <li><a href="<?= base_url('page/' . $pageDetail->url); ?>"><?= $pageDetail->pageName; ?></a></li>
                                <?php }
                            } ?>
                            </ul>
                            <?php } ?>
                    </div>
                <?php } ?>

            </div>
            <?php $settings = getSingleRecord('settings', 'id', '1');?>
            <div class="foot_bottom clearfix">
                <div class="copy-right">
                    <p>&copy Popln, Inc.</p>
                </div>
                <div class="terms">
                    <ul>
                        <li><a href="<?= base_url('page/terms'); ?>">Terms</a></li>
                        <li><a href="<?= base_url('page/privacy-policy'); ?>">Privacy</a></li>
                        <li><a href="#">Site Map</a></li>
                        <?php if(!empty($settings->facebookLink)){ ?><li><a href="<?= $settings->facebookLink; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php }?>
                        <?php if(!empty($settings->twitterLink)){ ?><li><a href="<?= $settings->twitterLink; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php }?>
                        <?php if(!empty($settings->instagramLink)){ ?><li><a href="<?= $settings->instagramLink; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li><?php }?>
                        <?php if(!empty($settings->linkedInLink)){ ?><li><a href="<?= $settings->linkedInLink; ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><?php }?>
                        <?php if(!empty($settings->googlePlusLink)){ ?><li><a href="<?= $settings->googlePlusLink; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li><?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        //highlight current or active link
        $('#cssmenu ul li a,.sidenav-list ul li a').each(function () {
            if ($($(this))[0].href === String(window.location)) {
                $(this).parent().addClass('active');
            }
        });
    });

    function scrollToDiv(target) {
        $('html, body').animate({scrollTop: $(target).offset().top}, 500);
    }
    if($("#search-box").length) {
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('search-box'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                console.log(mesg);
                $("#latitude").val(latitude);$("#longitude").val(longitude);
                $(".space-search-form").submit();
            });
        });
    }
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
        {
            defaultLanguage: 'en', 
            //pageLanguage: 'en', 
            includedLanguages: '<?= $allLangCodes;?>', 
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            //autoDisplay: false,
            //multilanguagePage: true
        }, 
        'google_translate_element');
    }
</script>
</body>
</html>
<?php $this->session->unset_userdata('filters');?>
