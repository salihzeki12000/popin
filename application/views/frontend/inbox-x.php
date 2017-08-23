<?php
	$this->load->view('frontend/include/header');
?>

<section class="middle-container inbox_x">
    <div class="container">
        <div class="alert alert-info fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><img src="<?php echo base_url('theme/front/assests/img/alert-close-icon.png')?>" alt="" /></a>
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="<?php echo base_url('theme/front/assests/img/doller-icon.png')?>" alt="" />
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Earn $3,600 travel credit</h4>
                    <p>Give your friends $1,200 off their first trip on Popln and you’ll get up to $3,600 travel credit. </p>
                    <button class="btn2">Invite Friends</button>
                    <button class="btn btn-default">Later</button>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-md-3 all-msessage">
                     <select data-reactid="7"><option selected="" value="all" data-reactid="8">All Messages (1)</option><option value="starred" data-reactid="9">Starred (0)</option><option value="unread" data-reactid="10">Unread (0)</option><option value="reservations" data-reactid="11">Reservations (0)</option><option value="pending_requests" data-reactid="12">Pending Requests (0)</option><option value="hidden" data-reactid="13">Archived (0)</option></select>
                </div>
            </div>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <td><center><img src="<?php echo base_url('theme/front/assests/img/pic-2.jpg')?>" alt="" /></center></td>
                                        <td><span class="dark-gery">Freya <br />08/11/2016</span></td>
                                        <td>Okay!! <br />San Luis Obispo, CA (Aug 12 - 14, 2016)</td>
                                        <td>
                                            <h4>Accepted</h4>
                                            <span class="price">&255</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
	$this->load->view('frontend/include/footer');
?>