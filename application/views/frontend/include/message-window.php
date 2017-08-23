<?php 
$settings = getSingleRecord('settings','id','1');
if(!isset($userProfileInfo)){
    $userProfileInfo = $this->user->userProfileInfo();
}
$messages = $this->user->getNewUserMessages($userProfileInfo->id);
//print_array($messages,true);
?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Messages <span class="badge <?= count($messages) ? '' : 'hidden'; ?>"><?= count($messages); ?></span><span class="caret"></span></a>
<ul class="dropdown-menu">
    <li>
        <a href="<?= site_url('inbox'); ?>">
            <div class="view-trip clearfix">
                <div class="pull-left"><strong>New Messages (<?= count($messages); ?>)</strong></div>
                <div class="pull-right"><strong>View All</strong></div>
            </div>
        </a>
    </li>
    <?php if(!empty($messages)): foreach($messages as $message): 
        $avatar = ($message['picture']!='' && file_exists('uploads/user/thumb/' . $message['picture']))?$message['picture']:'user_pic-225x225.png';
    ?>
    <li>
        <a href="<?= site_url('inbox'); ?>">
            <div class="cassidy">
                <ul>
                    <li>
                        <img class="img-circle" src="<?= base_url('uploads/user/thumb/'.$avatar); ?>" width="50" height="50" alt="picture" />
                    </li>
                    <li><?= $message['subject']; ?> <br /><br /><?= time_elapsed_string(date("Y-m-d H:i:s", $message['createdDate'])); ?><?php //echo word_limiter($message['message'],10); ?></li>
                </ul>
            </div>
        </a>
    </li>
    <?php endforeach;    endif;?>
    <li>
        <a href="<?= site_url('dashboard'); ?>">
            <div class="view-trip wight-top-border clearfix">
                <div class="pull-left"><strong>Notifications (3)</strong></div>
                <div class="pull-right"><strong>View All</strong></div>
            </div>
        </a>
    </li>
    <li>
        <a href="<?= site_url('spaces'); ?>">
            <div class="cassidy">
                <ul>
                    <li>
                        <img src="<?= base_url('theme/front/img/nav-icon2.png'); ?>" alt="" />
                    </li>
                    <li><?= ucfirst($userProfileInfo->firstName); ?>, new spaces have <br />arrived! Book now before they run out.</li>
<!--                    <li>
                        <img src="<?= base_url('theme/front/img/close-icon.png'); ?>" alt="" />
                    </li>-->
                </ul>
            </div>
        </a>
    </li>
    <li>
        <a href="<?= site_url('spaces'); ?>">
            <div class="cassidy">
                <ul>
                    <li>
                        <img src="<?= base_url('theme/front/img/nav-icon2.png'); ?>" alt="" />
                    </li>
                    <li><?= ucfirst($userProfileInfo->firstName); ?>, Book workspaces led by <br />experienced business owners.<br />Now over 51 to choose form.</li>

                </ul>
            </div>
        </a>
    </li>
    <li>
        <a href="<?= site_url('invite'); ?>">
            <div class="cassidy">
                <ul>
                    <li>
                        <img src="<?= base_url('theme/front/img/nav-icon2.png'); ?>" alt="" />
                    </li>
                    <li><?= ucfirst($userProfileInfo->firstName); ?>, Invite your colleague to join <br />Popln and you’ll get <?= getCurrency_symbol($userProfileInfo->currency).number_format($settings->referral_credit_amount); ?> <br />after their first rental.</li>

                </ul>
            </div>
        </a>
    </li>
</ul>