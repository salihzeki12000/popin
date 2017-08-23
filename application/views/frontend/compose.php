<?php
	$this->load->view('frontend/include/user-header');
?>
<!-- Summernote CSS -->
<link rel="stylesheet" href="<?= base_url('theme/admin/plugins/summernote/summernote.css'); ?>">
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
                <form id="" method="post" action="<?= site_url('compose'); ?>" autocomplete="off">
                    <article class="col-xs-12 main-right">
                        <div class="panel-group">
                            <div class="panel panel-default social-connec change-pass">
                                <div class="panel-heading">Compose new message</div>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <div class="col-md-3 text-right">
                                                <label for="to">To:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type='hidden' id='user-id' name='user_id' value='<?= isset($contactUser)?$contactUser->id:''; ?>'/>
                                                <input class="form-control" id="to_user" name="to_user" type="text" placeholder="Type name..." value="<?= isset($contactUser)?$contactUser->firstName.' '.$contactUser->lastName:''; ?>" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <div class="col-md-3 text-right">
                                                <label for="subject">Subject:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" name="subject" type="text" placeholder="Subject:" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <div class="col-md-3 text-right">
                                                <label for="message">Message:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea class="summernote" name="message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="panel-footer">
                                            <div class="align-right">
                                                <button class="btn-red" type="submit" name="submit" id="submit">Send message</button>
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
<script src="<?= base_url('theme/admin/plugins/summernote/summernote.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/global/jquery-ui.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('assets/global/jquery-ui.js'); ?>"></script>
<script>
    $(document).ready(function(){

        $('.summernote').summernote({
            height: 250,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
        var WEBURL = '<?php echo site_url(); ?>';
        $( "#to_user" ).autocomplete({
            source: WEBURL + 'dashboard/search_user',
            //autoFocus: true,
            minLength: 3,
            focus: function( event, ui ) {
                $( "#to_user" ).val( ui.item.name );
                $( "#user-id" ).val( ui.item.id );
                return false;
            },
            select: function( event, ui ) {
                //$( "#to_user" ).val( ui.item.name + " <" + ui.item.email + ">" );
                $( "#to_user" ).val( ui.item.name );
                $( "#user-id" ).val( ui.item.id );
                return false;
            }
        })
        .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
           return $( "<li>" )
           //.append( "<a><b>" + item.name + "</b><br>" + item.email + "</a>" )
           .append( "<a><img src='<?= base_url('uploads/user/thumb/'); ?>"+item.image+"' height='50' width='50'>&nbsp;&nbsp;<b>" + item.name + "</b></a>" )
           .appendTo( ul );
        };
    });
    
</script>
<style>
    .tooltip-inner{color: #fff !important;}
</style>
<?php
	$this->load->view('frontend/include/user-footer');
?>