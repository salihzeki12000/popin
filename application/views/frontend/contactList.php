<?php
$this->load->view('frontend/include/user-header');
?>
<style>
    /*
        Image credits:
        uifaces.com (http://uifaces.com/authorized)
    */

    #login { display: none; }
    .login,
    .logout {
        position: absolute;
        top: -3px;
        right: 0;
    }
    .page-header { position: relative; }
    .reviews {
        color: #555;
        font-weight: bold;
        margin: 10px auto 20px;
    }
    .notes {
        color: #999;
        font-size: 12px;
    }
    .media .media-object { max-width: 120px; }
    .media-body { position: relative; }
    .media-date {
        position: absolute;
        right: 25px;
        top: 25px;
    }
    .media-date li { padding: 0; }
    .media-date li:first-child:before { content: ''; }
    .media-date li:before {
        content: '.';
        margin-left: -2px;
        margin-right: 2px;
    }
    .media-comment { margin-bottom: 20px; }
    .media-replied { margin: 0 0 20px 50px; }
    .media-replied .media-heading { padding-left: 6px; }

    .btn-circle {
        font-weight: bold;
        font-size: 12px;
        padding: 6px 15px;
        border-radius: 20px;
    }
    .btn-circle span { padding-right: 6px; }
    .embed-responsive { margin-bottom: 20px; }
    .tab-content {
        padding: 50px 15px;
        border: 1px solid #ddd;
        border-top: 0;
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    .custom-input-file {
        overflow: hidden;
        position: relative;
        width: 120px;
        height: 120px;
        background: #eee url('https://s3.amazonaws.com/uifaces/faces/twitter/walterstephanie/128.jpg');
        background-size: 120px;
        border-radius: 120px;
    }
    input[type="file"]{
        z-index: 999;
        line-height: 0;
        font-size: 0;
        position: absolute;
        opacity: 0;
        filter: alpha(opacity = 0);-ms-filter: "alpha(opacity=0)";
        margin: 0;
        padding:0;
        left:0;
    }
    .uploadPhoto {
        position: absolute;
        top: 25%;
        left: 25%;
        display: none;
        width: 50%;
        height: 50%;
        color: #fff;
        text-align: center;
        line-height: 60px;
        text-transform: uppercase;
        background-color: rgba(0,0,0,.3);
        border-radius: 50px;
        cursor: pointer;
    }
    .custom-input-file:hover .uploadPhoto { display: block; }
</style>
<section class="middle-container inbox_x">
    <div class="container">
        <div class="main-content">            
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" id="logout">
                        <div class="comment-tabs">
                            <div class="panel panel-default">
                                <div class="panel-heading">Contact List</div>
                                <div class="panel-body messageBlock" id="comments-logout">
                                    <input type='hidden' class='nextpage' value='0'>
                                    <ul class="media-list">
                                        <!--  start here-->
                                        <?php if (empty($messages)): ?>
                                            <div class="col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-4 text-center">
                                                <h3>Contact List empty.</h3><br/>
                                                <input type='hidden' class='nextpage' value='0'>
                                            </div>
                                        <?php else: ?>
                                            <?= $messages; ?>
                                            <!-- end here -->
                                        <?php endif; ?>
                                    </ul>
                                    <div style="text-align: center;display: none;" id="loader"><?php echo img(array("src" => base_url("assets/images/loading-spinner-grey.gif"), "alt" => "loading...")); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contact list so here design part -->
        </div>
    </div>
</section>
<script src="<?php echo base_url('theme/front/assests/js/jquery.blockUI.js') ?>" type="text/javascript"></script>
<script>
//Scroll script
    var ajax_arry = [];
    var ajax_index = 0;
    $(function () {
        $(window).scroll(function () {
            var height = $('.messageBlock').height();
            var scroll_top = $(this).scrollTop();
            if (ajax_arry.length > 0) {
                for (var i = 0; i < ajax_arry.length; i++) {
                    ajax_arry[i].abort();
                }
            }
            var page = $('.messageBlock').find('.nextpage').val();
            console.log(page);
            if ($(window).scrollTop() == $(document).height() - $(window).height() && page > 0) {
                $('#loader').show();
                var ajaxreq = $.ajax({
                    url: "<?php echo site_url("dashboard/contactRequest") ?>",
                    type: "POST",
                    data: "page=" + page,
                    cache: false,
                    success: function (response) {
                        $('#loader').hide();
                        $('.messageBlock').find('.nextpage').remove();
                        $('.media-list').append(response);
                    }
                });
                ajax_arry[ajax_index++] = ajaxreq;
            }
            return false;
        });
    });
</script>
<?php
$this->load->view('frontend/include/user-footer');
?>
