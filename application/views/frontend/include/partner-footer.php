<footer class="foot">
    <div class="container">
        <div class="row">
            <div class="foot_top clearfix">
                <div class="col-lg-3 one-foruth">
                    <select name="site_language" id="site_language">
					<?php $all_languages = unserialize(LANGUAGES); 
					foreach($all_languages as $k=>$v) { ?>
					<option value="<?= $k; ?>"><?= $v; ?></option>
					<?php } ?>
					</select>
                    
                    <select name="site_currency" id="site_currency">
					<?php $all_currency = unserialize(CURRENCIES); 
					foreach($all_currency as $k=>$v) { ?>
					<option value="<?= $k; ?>"><?= $v; ?></option>
					<?php } ?>
					</select>
                </div>
                <div class="col-lg-3 one-foruth pd-left">
                    <h5>Popln</h5>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Policies</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Diversity &amp; Belonging</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 one-foruth pd-left">
                    <h5>Discover</h5>
                    <ul>
                        <li><a href="#">Trust &amp; Safety</a></li>
                        <li><a href="#">Travel Credit</a></li>
                        <li><a href="#">Gift Cards</a></li>
                        <li><a href="#">Popln Citizen</a></li>
                        <li><a href="#">Business Travel</a></li>
                        <li><a href="#">Guidebooks</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 one-foruth pd-left">
                    <h5>Hosting</h5>
                    <ul>
                        <li><a href="#">Why Host</a></li>
                        <li><a href="#">Hospitality</a></li>
                        <li><a href="#">Responsible Hosting</a></li>
                    </ul>
                </div>
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

<script src="<?php echo base_url('theme/front/assests/js/jQuery.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/nav.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/bootstrap.min.js')?>" type="text/javascript"></script>