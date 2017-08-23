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
                        			<form class="form-horizontal" role="form"  name="add_banner" id="add_banner" method="post" action="<?= base_url(ADMIN_DIR.'/banner/add_banner/'); ?>" enctype="multipart/form-data">
	                                            <div class="form-group">
	                                                <label for="caption" class="col-sm-3 control-label">Caption</label>
	                                                <div class="col-sm-9">
	                                                  <input type="text" placeholder="Festival Offer" name="caption" class="form-control" id="caption" value=""> 
	                                                  <p>Minimum 5 Characters and Maximum 50 Characters</p>
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="url" class="col-sm-3 control-label">Banner Link</label>
	                                                <div class="col-sm-9">
	                                                 <input type="text" name="url" id="url" class="form-control" value="">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="description" class="col-sm-3 control-label">Banner Description</label>
	                                                <div class="col-sm-9">
	                                                  <textarea id="description" name="description" class="form-control"></textarea>
	                                                  <p>Minimum 20 Characters and Maximum 120 Characters</p>
	                                                </div>
	                                            </div>
	                                            
	                                            <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Banner Image</label>
	                                                <div class="col-sm-9">
	                                                 <input type="file" id="image" name="image">
                                                      <p class="help-block avatarError"></p>
                                                      <p>Standard (1200px * 800px)</p>
	                                                </div>
	                                            </div>
	                                            
	                                            <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Status</label>
	                                                <div class="col-sm-9">
	                                                 <select name="status" id="status" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Active" selected>Active</option>
                                                            <option value="DeActive">DeActive</option>
                                                            </select>
	                                                </div>
	                                            </div>
	                                            
	                                           
	                                            <div class="form-group m-b-0">
	                                                <div class="col-sm-offset-3 col-sm-9">
	                                                  <button type="submit" class="btn btn-info waves-effect waves-light" id="submit" name="submit">Add</button>
	                                                </div>
	                                            </div>
	                                        </form>
                                </div>
                            </div>
                           
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
<script>
    $(document).ready(function(e) {
		
		$('#add_banner').validate({
					rules: {
						caption		:	{	required:	true
						},
						description : {required:true},
						url : {required:true,url:true},
						status 		: 	{	required:	true	},
						image		: 	{	
											required:true,
											accept	:	"jpg|png|jpeg|gif",
											fileSize : true
										}
						},
					messages : {
						caption:{
							          required:"Please Enter Banner Caption Name",
									   min:"Minimum 20 Characters Long Banner Caption Is Required",
									   max:"Maximum 200 Characters Long Banner Caption Is Required",
						},
						description : {
									   required:"Please Enter Banner Description",
									   min:"Minimum 20 Characters Long Banner Description Is Required",
									   max:"Maximum 200 Characters Long Banner Description Is Required",
									   
						},
						url : { 
								required:"Please Enter Banner URL",
								url : "Please Enter Valid Banner URL"}
						,
						status	:	
								{	
									required:"Please Select Banner Status"},
						image : { 
								   required : "Please Upload Banner Image",
								   accept : "Allowed Image Types Are JPG, PNG, JPEG, GIF"
								 }
					},
					errorPlacement: function(error, element) {
						if(element.attr("name") == "image") {
							error.appendTo('.avatarError');
						}
						else {
							error.insertAfter(element);
						}
					}
				});
    });
    </script>