<section class="middle-container account-section profile-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <?php $this->load->view('frontend/include/profile-sidebar'); ?>
                </aside>
                <article class="col-lg-9 main-right">
                    <div id="exTab2">
                        <ul class="nav nav-tabs mr20">
                            <li class="active"><a href="#1" data-toggle="tab">Reviews About You</a></li>
                            <li><a href="#2" data-toggle="tab">Reviews By You</a></li>
                        </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="1">
                            <div class="panel-group">
                                <div class="panel panel-default reviews">
                                    <div class="panel-heading">Past Reviews</div>
                                    <div class="panel-body">
                                        <p>Reviews are written at the end of a reservation through <?= SITE_DISPNAME; ?>. Reviews you’ve received will be visible both here and on your public profile.</p>
                                        <!-- <p class="font12">No one has reviewed you yet.</p> -->
                                        <div class="reviews-popin">
                                        <?php  
                                        $reviewsList = getMultiRecord('space_ratings','reviewOnId',$userProfileInfo->id);
                                        if (!empty($reviewsList)) {
                                            foreach ($reviewsList as $key => $value) { 
                                            $userList = getSingleRecord('user','id',$value['reviewerId']);
                                            echo '<div class="reviews" >';
                                            echo '<div class="reviews-head">
                                                     <div class="img">
                                                      <div class="inner">
                                                           <img src="'.base_url('uploads/user/thumb/').(!empty($userList->avatar)?$userList->avatar:'user_pic-225x225.png').'" alt="" />
                                                        </div>
                                                  </div>';
                                            echo '<div class="content">
                                                      <h4>'.$userList->firstName.' '.$userList->lastName.'</h4>
                                                            <div class="date">
                                                               '.time_elapsed_string(date('d-m-Y h:i:s a',$value['createdDate'])).'
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="main-conte">
                                                       <span class="more">'.$value['review'].'</span>
                                                    </div>
                                            </div>';
                                            }
                                           }else{
                                            echo '<p class="font12">No one has reviewed you yet.</p>';
                                           }
                                        ?>
                                        </div>
                                        <!-- close here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="2">
                            <div class="panel-group">
                                <div class="panel panel-default reviews">
                                    <div class="panel-heading">Past Reviews You’ve Written</div>
                                    <div class="panel-body">
                                        <div class="reviews-popin">
                                        <?php  
                                        $reviewsList = getMultiRecord('space_ratings','reviewerId',$userProfileInfo->id);
                                        if (!empty($reviewsList)) {
                                            foreach ($reviewsList as $key => $value) { 
                                            $userList = getSingleRecord('user','id',$value['reviewerId']);
                                            echo '<div class="reviews" >';
                                            echo '<div class="reviews-head">
                                                     <div class="img">
                                                      <div class="inner">
                                                           <img src="'.base_url('uploads/user/thumb/').(!empty($userList->avatar)?$userList->avatar:'user_pic-225x225.png').'" alt="" />
                                                        </div>
                                                  </div>';
                                            echo '<div class="content">
                                                      <h4>'.$userList->firstName.' '.$userList->lastName.'</h4>
                                                            <div class="date">
                                                               '.time_elapsed_string(date('d-m-Y h:i:s a',$value['createdDate'])).'
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="main-conte">
                                                       <span class="more">'.$value['review'].'</span>
                                                    </div>
                                            </div>';
                                            }
                                           }else{
                                            echo '<p class="font12">No one has reviewed you yet.</p>';
                                           }
                                        ?>
                                        </div>
                                        <!-- close here -->
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </article>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
       $(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 150;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Read More >";
    var lesstext = "Read less";
    $('.more').each(function() {
        var content = $(this).html();
        if(content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
        }
    });
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
    //  Sumbit rating and reviews 
</script>
