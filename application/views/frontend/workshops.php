<section class="workshops-home">
    <div class="container">
        <div class="row">
            <h3>Workshops</h3>
            <ul class="clearfix">
                <?php for($i=0; $i<25; $i++): ?>
                <li>
                    <div class="slide-main clearfix">
                        <div class="slide-contant">
                            <div class="img">
                                <img src="<?php echo base_url('theme/front/assests/img/image5.jpg') ?>" alt="">
                            </div>
                            <div class="content">
                                <p><strong>$<?= number_format(rand(1000, 9000));?></strong> Tune into daily rhythms with a Cuban scholars Team</p>
                                <div class="review"><?= createRatingStars(rand(0, 5)); ?><span><?= rand(50, 500); ?> reviews</span></div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</section>