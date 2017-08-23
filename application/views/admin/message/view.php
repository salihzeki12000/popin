            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                   <?php if($message_notification = $this->session->flashdata('message_notification')) { ?>
									<!-- Message Notification Start -->
									<div id="message_notification">
									<div class="alert alert-<?= $this->session->flashdata('class'); ?>">    
										<button class="close" data-dismiss="alert" type="button">×</button>
										<strong>
											<?= $this->session->flashdata('message_notification'); ?> 
										</strong>
									</div>
									</div>
									<!-- Message Notification End -->
						<?php } ?>
                                    <h4 class="page-title"><?= $module_heading; ?></h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
             <?php 
              $sender   = getSingleRecord('user','id',$message->sender);
              $receiver = getSingleRecord('user','id',$message->receiver);
              $senderName     = $sender->firstName.' '.$sender->lastName;
              $receiverName   = $receiver->firstName.' '.$receiver->lastName;
              ?>
                        <div class="row">
                           <div class="col-sm-12">
                                <div class="card-box">
                        			<form class="form-horizontal" role="form" name="edit_faq_category" id="edit_faq_category" method="post" enctype="multipart/form-data">
	                                            <div class="form-group">
	                                                <label for="caption" class="col-sm-3 control-label">Sender Name</label>
	                                                <div class="col-sm-9">
	                                                 <input type="text" placeholder="enter space name" name="name" class="form-control" id="name" value="<?= $senderName; ?>">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="caption" class="col-sm-3 control-label">Receiver Name</label>
	                                                <div class="col-sm-9">
	                                                 <input type="text" placeholder="enter space name" name="name" class="form-control" id="name" value="<?= $receiverName; ?>">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="caption" class="col-sm-3 control-label">Subject</label>
	                                                <div class="col-sm-9">
	                                                 <input type="text" placeholder="enter space name" name="name" class="form-control" id="name" value="<?= $message->subject; ?>">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="caption" class="col-sm-3 control-label">Message</label>
	                                                <div class="col-sm-9">
	                                                 <textarea rows="15" class="form-control" name="description" ><?= $message->message; ?></textarea>
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Status</label>
	                                                <div class="col-sm-9">
	                                                 <select name="status" id="status" class="form-control">
                                                       <option value="" selected=""><?= $message->status; ?></option>
                                                           
                                                     </select>
	                                                </div>
	                                            </div>
	                                        </form>
                                </div>
                            </div>
                           
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
    <script type="text/javascript">
       $("input").attr("disabled", true);
       $("textarea").attr("disabled", true);
       $("select").attr("disabled", true);
    </script>