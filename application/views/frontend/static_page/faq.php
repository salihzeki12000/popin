<link href="<?= base_url('theme/front/assests/'); ?>css/accordion.css" rel="stylesheet" type="text/css" />
<section class="middle-container cms-content">
    <div class="container">
        <div class="row">
            <div class="faq">
                <h2>Frequently asked questions</h2>
                <?php if(!empty($faqs)):?>
                <div class="accordion">
                    <?php foreach($faqs as $category => $questions): if(!empty($questions)): $cat = url_title($category,'-',TRUE);?>
                    <h4><?= $category; ?></h4>
                    <?php foreach($questions as $question):?>
                    <div class="accordion-section">
                        <a class="accordion-section-title" href="#<?= $cat.$question['id']; ?>"><?= $question['question']; ?></a>
                        <div id="<?= $cat.$question['id']; ?>" class="accordion-section-content">
                            <p><?= $question['answer']; ?></p>
                        </div><!--end .accordion-section-content-->
                    </div><!--end .accordion-section-->
                    <?php endforeach;?>
                    <br/>
                    <?php endif; endforeach;?>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url('theme/front/assests/'); ?>js/accordion.js" type="text/javascript"></script>