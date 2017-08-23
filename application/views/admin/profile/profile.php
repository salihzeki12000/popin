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

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4">
                                            <div class="text-center card-box">
                                                <div class="member-card">
                                                    <div class="thumb-xl member-thumb m-b-10 center-block">
                                                        <img src="<?= base_url('uploads/admin/'.$adminProfileInfo->avatar); ?>" class="img-circle img-thumbnail img-responsive" alt="<?= $adminProfileInfo->name; ?>">
                                                        <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                                    </div>

                                                    <div class="">
                                                        <h4 class="m-b-5"><?= $adminProfileInfo->name; ?></h4>
                                                        <p class="text-muted">@<?= $adminProfileInfo->uname; ?></p>
                                                    </div>
                                                   
                                                    <hr/>

                                                    <div class="text-left">
                                                        <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15"><?= $adminProfileInfo->name; ?></span></p>

                                                        <p class="text-muted font-13"><strong>User Name :</strong><span class="m-l-15"><?= $adminProfileInfo->uname; ?></span></p>

                                                        <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15"><?= $adminProfileInfo->email; ?></span></p>
                                                        
                                                    </div>

                                                </div>

                                            </div> <!-- end card-box -->

                                        </div> <!-- end col -->

                                        <div class="col-md-8 col-lg-9">
                                            <h4>Basic Profile Section</h4>
									
                                            <div class="row m-t-20">
                                              
                                              <form role="form" action="<?= base_url(ADMIN_DIR.'/profile/edit_personal_info') ?>" name="edit_personal_info" id="edit_personal_info" method="post">
                                                                        <div class="form-group">
                                                                            <label class="control-label"> Name</label>
                                                                            <input type="text" placeholder="Aliasgar Vanak" class="form-control"  name="name" id="name" value="<?= $adminProfileInfo->name; ?>"/> 
                                                                        </div>
                                                                       
                                                                        <div class="form-group">
                                                                            <label class="control-label">Username</label>
                                                                             <input type="text" placeholder="aliasgar.vanak" class="form-control"  name="uname" id="uname" value="<?= $adminProfileInfo->uname; ?>"/> 
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">Email</label>
                                                                             <input type="text" placeholder="aliasgar.vanak@gmail.com" class="form-control"  name="email" id="email" value="<?= $adminProfileInfo->email; ?>"/> 
                                                                       </div>
                                                                       
                                                                        
                                                                        
                                                                        <div class="margiv-top-10">
                                                                        	<input type="hidden" name="admin_id" value="<?= $adminProfileInfo->id; ?>">
                                                                            <input type="submit" class="btn btn-success" name="personal_info_submit" id="personal_info_submit" value="Save Changes">
                                                                            <input type="reset" name="personal_info_rest" id="personal_info_reset" class="btn default" value="Cancel">
                                                                        </div>
                                                                    </form>
                                              
                                            </div> <!-- end row -->

                                            <hr/>
                                            
                                            <h4>Avatar</h4>

                                            <div class="row m-t-20">
                                             <form action="<?= base_url(ADMIN_DIR.'/profile/edit_avatar_info'); ?>" name="edit_avatar_info" id="edit_avatar_info" role="form" enctype="multipart/form-data" method="post">
                                              <input name="avatar" id="avatar" type="file">
                                              
                                              <div class="m-t-10">
                                              	
                                              	<input type="hidden" name="old_avatar" id="old_avatar" value="<?= $adminProfileInfo->avatar?>">
                                                                            <input type="hidden" name="admin_id" value="<?= $adminProfileInfo->id; ?>">
                                                                            <input type="submit" class="btn btn-success" name="avatar_info_submit" id="personal_info_submit" value="Save Changes">
                                                                            <input type="reset" name="avatar_info_rest" id="avatar_info_reset" class="btn default" value="Cancel">
                                              </div>
												</form>
                                            </div> <!-- end row -->
                                            <hr>
                                            <h4>Change Password</h4>

                                            <div class="row m-t-20">
                                              <form action="<?= base_url(ADMIN_DIR.'/profile/edit_change_password'); ?>" name="edit_password_info" id="edit_password_info" method="post">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Current Password</label>
                                                                            <input type="password" name="current_password" id="current_password" class="form-control" value="" /> 
                                                                       </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">New Password</label>
                                                                            <input type="password" name="new_password" id="new_password" value="" class="form-control" /> 
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">Re-type New Password</label>
                                                                            <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" value="" />
                                                                        </div>
                                                                        <div class="margin-top-10">
                                                                        <input type="hidden" name="admin_id" value="<?= $adminProfileInfo->id; ?>">
                                                                            <input type="submit" class="btn btn-success" name="password_info_submit" id="password_info_submit" value="Save Changes">
                                                                            <input type="reset" name="password_info_rest" id="password_info_reset" class="btn default" value="Cancel">
                                                                        </div>
                                                                    </form>
                                            </div> <!-- end row -->
                                            
                                        </div>
                                        <!-- end col -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->
<script>
    $(document).ready(function(e) {
		$('#edit_personal_info').validate({
					rules: {
						name		:	{	required:	true	},
						uname		:	{	required:	true	},
						email 		: 	{	required:	true,
											email	:	true    }
						},
					messages : {
						name:{required: "Please Enter Full Name"},
						uname:{required:"Please Enter Username"},
						email : {required:"Please Enter Email Address",email:"Please Enter Valid Email Address"}
					}
				});
		
		$('#edit_avatar_info').validate({
					rules: {
						avatar	: 	{	
										required: true,
										accept	:	"jpg|png|jpeg|gif",
										fileSize : true
										}
						},
					messages : {
						avatar : { 
									required: "Please Uplaod Your Avatar",
									accept : "Allowed Image Types Are JPG, PNG, JPEG, GIF"
								 }
					}
				});
		
		$('#edit_password_info').validate({
					rules: {
						current_password	: 	{	required:	true	},
						new_password 		: 	{
													required:true
												},
						confirm_new_password: 	{	required:	true,
											equalTo : 	'#new_password'}
						},
					messages : {
						current_password: {required:"Please Enter Your Current Password"},
						new_password : {required:"Please Enter Your New Password"},
						confirm_new_password : {required:"Please Enter Confirm Password",equalTo:"New Password And Confirm Password Should Match"},
					}
				});
		
    });
    </script>