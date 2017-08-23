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
                                    <h4 class="page-title">Module Name Here..</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        <div class="row">
						
                          This is admin dashboard
                           
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->