<?php if($this->session->has_userdata('message_notification')) { ?>
<div class="alert alert-<?= $this->session->userdata('class'); ?>">    
    <button class="close" data-dismiss="alert" type="button">×</button>
    <center><strong><?= $this->session->userdata('message_notification'); ?></strong></center>
</div>
<?php }
$this->session->unset_userdata(array('class','message_notification'));
?>
<section class="middle-container cms-content">
    <div class="container">
        <div class="row">
            <div class="contact-us">
                <h2>Contact Us</h2>
                <p>Please use the selections below to troubleshoot your issue. Accurately selecting your specific issue from the drop-down lists below will enable you to get an answer to your question more quickly.</p>
                <form id="contact-form" method="post" action="" autocomplete="off">
                    <div class="question-about">
                        <h4>What is your question about?</h4>
                        <label for="topic-2"><input id="topic-2" type="radio" name="contact_topic" value="Hosting" checked="checked" required> Hosting</label>
                        <label for="topic-3"><input id="topic-3" type="radio" name="contact_topic" value="Renting"> Renting</label>
                    </div>
                    <div class="question-about you-with">
                        <h4>What is your question about?</h4>
                        <select class="selectbox" name="question_topic" required>
                            <option value="">-- Please Select --</option>
                            <option>Messaging and Booking</option>
                            <option>Manage Listing</option>
                            <option>Payouts</option>
                            <option>Alterations and Cancellations</option>
                            <option>Account and Profile</option>
                            <option>Safety</option>
                            <option>Taxes</option>
                            <option>Laws and Regulations</option>
                            <option>Superhost Program</option>
                            <option>Natural Disaster Response</option>
                            <option>PopIn Merchandise</option>
                        </select>
                    </div>
                    <div class="question-about you-with">
                        <div class="form-group">
                            <input class="textbox" name="name" type="text" placeholder="Name..." required />
                        </div>
                        <div class="form-group">
                            <input class="textbox" name="email" type="email" placeholder="Email..." required />
                        </div>
                        <div class="form-group">
                            <input class="textbox" name="number" type="text" placeholder="Phone..." />
                        </div>
                        <textarea class="textarea" name="message" placeholder="Your message..." required></textarea>
                        <input type="submit" class="btn2" value="Submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function(){
    $('#contact-form').validate();
});
</script>