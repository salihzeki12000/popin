<section class="middle-container account-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                   <?php $this->load->view(FRONT_DIR . '/include/account-sidebar');?>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default social-connec">
                            <div class="panel-heading">Social Connections</div>
                            <div class="panel-body">
                                <p>Social Connections highlights your <?= SITE_DISPNAME; ?> activity, which may include your username, Facebook profile photo, and recent locations you visited to your Facebook friends who are also on <?= SITE_DISPNAME; ?>.</p>
                                <p>If you turn off this feature, you will still be connected to Facebook, but your <?= SITE_DISPNAME; ?> activity will not be shared to other Facebook friends on <?= SITE_DISPNAME; ?>. Your public <?= SITE_DISPNAME; ?> activity (such as wish lists and public reviews) on the platform will still be shown to other <?= SITE_DISPNAME; ?> users.</p>
                                <p>If you want to disconnect your Facebook account from <?= SITE_DISPNAME; ?>, go to Trust and Verifications to <a href="#">Learn more</a>.</p>
                                <p><label><input name="socialConnection" type="checkbox" value="Yes" id="socialConnection" onchange="autoSave(this.id, this.value, this.checked)" <?= ($userProfileInfo->socialConnection == 'Yes') ? 'checked' : ''; ?> /> &nbsp;Share my activity with my Facebook friends that are also on <?= SITE_DISPNAME; ?> (recommended)</label></p>
<!--                                <div class="row">
                                    <div class="panel-footer">
                                        <div class="align-right">
                                            <button class="btn-red">Save Social Connections</button>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>


                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<script>
    function autoSave(fieldId, value, checked)
    {
        if(!checked){
            value = "No";
        }
        var field = fieldId;
        $.ajax({
            url: '<?= base_url('user/ajax_submit_basic'); ?>',
            type: 'POST',
            dataType: "json",
            data: {col: field, val: value},
            beforeSend: function () {
                $(".loader").show();
            },
            complete: function () {
                $('.loader').hide();
            },
            success: function (response) {
                if (response['class'] == '<?= A_FAIL ?>')
                {
                    $('#message_notification').html('<div class="alert alert-<?= A_FAIL; ?>"><button class="close" data-dismiss="alert" type="button">×</button><strong>' + response['message'] + '</strong></div>');
                    //alert(response['message']);
                } else {
                    //$('#message_notification').html('<div class="alert alert-<?= A_SUC; ?>"><button class="close" data-dismiss="alert" type="button">×</button><strong>'+response['message']+'</strong></div>');
                }
            }
        });
    }
</script>