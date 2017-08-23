<?php if ($message_notification = $this->session->flashdata('message_notification')) { ?>
    <!-- Message Notification Start -->
    <div id="message_notification">
        <div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
            <button class="close" data-dismiss="alert" type="button">×</button>
            <center><strong><?= $this->session->flashdata('message_notification'); ?></strong></center>
        </div>
    </div>
    <!-- Message Notification End -->
<?php } ?>
<section class="middle-container account-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <?php $this->load->view(FRONT_DIR . '/include/account-sidebar');?>
                </aside>
                <form name="securityAccount" id="securityAccount" method="post" action="<?= base_url('account/submit_security'); ?>">
                    <article class="col-lg-9 main-right">
                        <div class="panel-group">
                            <div class="panel panel-default social-connec change-pass">
                                <div class="panel-heading">Change Your Password</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="col-md-5 text-right">
                                                <label for="old_password">Old Password</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input id="currentPassword" name="currentPassword"  type="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="col-md-5 text-right">
                                                <label for="old_password">New Password</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input id="newPassword" name="newPassword" value=""  type="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="col-md-5 text-right">
                                                <label for="old_password">Confirm Password</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input id="confirmNewPassword" name="confirmNewPassword" value="" type="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="panel-footer">
                                            <div class="align-right">
                                                <button class="btn-red" type="submit" name="submit" id="submit">Update Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default social-connec change-pass">
                                <div class="panel-heading">Login History</div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Browser/Device</th>
                                                    <th>Location <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Location is approximated"></i></th>
                                                    <th colspan="2">Recent Activity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($loginHistory)): ?>
                                                <?php foreach($loginHistory as $loginKey => $histories): $count = 0; foreach($histories as $history): ?>
                                                <tr <?php if($count > 0){ echo "class='".$loginKey." hidden'";}?>>
                                                    <td><?= $history['agent']; ?><br /> <?= $history['platform']; ?></td>
                                                    <td><?= $history['location']; ?></td>
                                                    <td>
                                                        <?= $history['last_seen']; ?> <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-html="true" title="Time: <?= $history['timestamp']; ?><br />IP: <?= $history['ip_address']; ?>"></i><br />
                                                        <?php if(count($histories) > 1 && $count == 0){ ?><a href="#" class="show-more" data-login-key="<?= $loginKey; ?>" data-login-count="<?= count($histories)-1; ?>"><?= count($histories)-1; ?> more <i class="fa fa-sort-down" aria-hidden="true"></i></a><?php }?>
                                                    </td>
                                                    <td><?= $history['login_status']; ?></td>
                                                </tr>
                                                <?php $count++; endforeach; endforeach; endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="panel-footer">
                                            <div class="align-right">
                                                <p>If you see something unfamiliar, <a href="javascript:;" onclick="scrollToDiv('.change-pass');">change your password.</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function (e) {
        $('#securityAccount').validate({
            rules: {
                currentPassword: {required: true},
                newPassword: {
                    required: true
                },
                confirmNewPassword: {required: true,
                    equalTo: '#newPassword'}
            },
            messages: {
                currentPassword: {required: "Please Enter Your Current Password"},
                newPassword: {required: "Please Enter Your New Password"},
                confirmNewPassword: {required: "Please Enter Confirm Password", equalTo: "New Password And Confirm Password Should Match"}
            }
        });
        
        $(document).on('click', 'a.show-more', function(e){
            e.preventDefault();
            var $this = $(this), target = $(this).attr("data-login-key"), count = $(this).attr("data-login-count");
            
            //$("."+target).toggle();
            $( "."+target ).toggleClass(function() {
                if ( $( this ).is( ".hidden" ) ) {
                    console.log('shown');
                    $this.html('less <i class="fa fa-sort-up" aria-hidden="true"></i>');
                    return "hidden";
                } else {
                    console.log('hidden');
                    $this.html(count + ' more <i class="fa fa-sort-down" aria-hidden="true"></i>');
                    return "hidden";
                }
                
            });
        });
        
        $(document).on('click', 'a.logout-user', function(e){
            e.preventDefault();
            var $this = $(this), id = $(this).attr("data-id");
            
            $.post("<?= site_url('Account/logout_user_log'); ?>", {'log_id': id}, function(response){
                if(response){
                    $this.parent().html("Logged Out");
                }
            });
        });
    });
</script>