<?php
	$this->load->view('frontend/include/user-header');
?>
<div class="container" style="margin-top: 15px;">
<div class="panel-group">
     <div class="panel panel-default required">
            <div class="panel-heading"><h3>Reviews</h3></div>
              <div class="panel-body">
<div class="reviews-popin" id="ReviewsView" >
<span id="AllListView" >
<?php 
if (!empty($reivewsList)) {
     $count = 0;
            foreach ($reivewsList as $key => $value) { 
            if ($count <= 10) {
                echo '<div class="reviews" >';
                echo '<div class="reviews-head">
                         <div class="img">
                          <div class="inner">
                               <img src="'.base_url('uploads/user/thumb/'.(!empty($value['avatar'])?$value['avatar']:'user_pic-225x225.png')).'" alt="" />
                            </div>
                      </div>';
                echo '<div class="content">
                          <h4>'.$value['firstName'].' '.$value['lastName'].'</h4>
                                <div class="date">
                                   '.time_elapsed_string(date('d-m-Y h:i:s a',$value['ratingsDate'])).'
                                </div>
                            </div>
                        </div>
                        <div class="main-conte">
                           <span class="more">'.$value['review'].'</span>
                        </div>
                </div>';
                 break;
                }
                $count++;
            }
       }
       echo '</span>';
       if (count($reivewsList) > 0) {  
        ?>
            <div class="read-all clearfix">
                <div class="pull-left">
                    <h4><a href="javascript:viewAllReviews();">Read all <?= count($reivewsList); ?> reviews</a></h4>
                </div>
                <div class="pull-right">
                    <?= createHTMLRating($spaceID);?>
                </div>
            </div>
   <?php  }else{
    echo  '<div class="read-all clearfix"><div class="pull-left">
            <h4>No Reviews</h4>
        </div></div>';
   }
   if (empty($checkStatus)) { ?>

   <span id="blockPost" >
    <div class="group-size">
        <div class="reting">
            <h4>Rating</h4>
        </div>
        <div class="grup-contant">
            <fieldset class="rating" id="myForm" >
                <input type="radio" id="star5" name="rating" value="5" />
                <label class = "full" for="star5" title="Awesome - 5 stars">    
                </label>
                <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="4.5 stars"></label>
                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="4 stars"></label>
                <input type="radio" id="star3half" name="rating" value="3.5"  /><label class="half" for="star3half" title="3.5 stars"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="3 stars"></label>
                <input type="radio" id="star2half" name="rating" value="2.5"  /><label class="half" for="star2half" title="2.5 stars"></label>
                <input type="radio" id="star2" name="rating" value="2"  /><label class = "full" for="star2" title="2 stars"></label>
                <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="1.5 stars"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="1 star"></label>
                <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="0.5 stars"></label>
            </fieldset>
        </div>
    </div>
    <div class="group-size">
        <div class="reting">
            <h4>Review</h4>
        </div>
        <div class="grup-contant">
            <textarea class="textarea control-form" rows="5" name="reviews" id="reviews"></textarea><span id="error"></span>
        </div>
    </div>
      <div class="group-size">
        <div class="reting">
            <h4>&nbsp;</h4>
        </div>
          <div class="grup-contant">
            <input type="button" id="RatingReviews" class="btn2" value="Submit" />
          </div>
        </div>
        </span>
<?php }
  ?>
     </div>
 </div>
</div></div></div>
<!-- close -->
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
 $('#RatingReviews').click(function(){
    var rating    = $('input[name=rating]:checked', '#myForm').val();
    var bookingID = '<?= $bookingID;?>';
    var spaceID   =  '<?= $spaceID;?>';
    var reviews   = $('textarea[name=reviews]').val();
    if (rating == undefined) {
      $('#error').html('<span style="color:red;" >Rating and Reviews cannot be empty</span>');    
    }else if (reviews == '') {
      $('#error').html('<span style="color:red;" >Rating and Reviews cannot be empty</span>');    
    }else{
        $.ajax({
            url: '<?= base_url('Dashboard/RatingReviews'); ?>',
            type: 'POST',
            data: {bookingID:bookingID,spaceID:spaceID,rating:rating,reviews:reviews},
            beforeSend: function(){
                $(".loader").show();
            },
            complete: function(){
                $('.loader').hide();
            },
            success: function(response) {
                if (response != 2) {
                    $('#blockPost').css('display','none');
                    $('#ReviewsView').prepend(response);   
                }else{
                   $('#error').html('<span style="color:red;" >Something is worng please try again.</span>');    
                 }
            }          
        });
    }
 });
 $('textarea[name=reviews]').keyup(function(){
      $('#error').html(' ');    
 });
 // all list  of views
 function viewAllReviews(){
    var spaceID   =  '<?= $spaceID;?>';
     $.ajax({
            url: '<?= base_url('Dashboard/viewAllListReviews'); ?>',
            type: 'POST',
            data: {spaceID:spaceID},
            beforeSend: function(){
                $(".loader").show();
            },
            complete: function(){
                $('.loader').hide();
            },
            success: function(response) {
             //    console.log(response);
             $('#AllListView').html(response);   
            }          
        });
 }
</script>
<?php
	$this->load->view('frontend/include/user-footer');
?>