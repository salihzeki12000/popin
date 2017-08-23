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
                        			<form class="form-horizontal" role="form" name="edit_banner" id="edit_banner" method="post" action="<?= base_url(ADMIN_DIR.'/banner/update_banner/'); ?>" enctype="multipart/form-data">
	                                            <div class="form-group">
	                                                <label for="caption" class="col-sm-3 control-label">Caption</label>
	                                                <div class="col-sm-9">
	                                                  <input type="text" placeholder="Festival Offer" name="caption" class="form-control" id="caption" value="<?= $bannerInfo->caption; ?>"> 
	                                                  <p>Minimum 5 Characters and Maximum 50 Characters</p>
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="url" class="col-sm-3 control-label">Banner Link</label>
	                                                <div class="col-sm-9">
	                                                 <input type="text" name="url" id="url" class="form-control" value="<?= $bannerInfo->url; ?>">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="description" class="col-sm-3 control-label">Banner Description</label>
	                                                <div class="col-sm-9">
	                                                  <textarea id="description" name="description" class="form-control"><?= $bannerInfo->description; ?></textarea>
	                                                  <p>Minimum 20 Characters and Maximum 120 Characters</p>
	                                                </div>
	                                            </div>
	                                            
	                                            <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Banner Image</label>
	                                                <div class="col-sm-9">
	                                                <img src="<?= base_url('uploads/banner/thumb/'.$bannerInfo->image); ?>" alt="<?= $bannerInfo->caption; ?>"><br><br>
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
                                                            <option value="Active" <?= ($bannerInfo->status=='Active')?'selected':''; ?>>Active</option>
                                                            <option value="DeActive" <?= ($bannerInfo->status=='DeActive')?'selected':''; ?>>DeActive</option>
                                                            </select>
	                                                </div>
	                                            </div>
	                                            
	                                           
	                                            <div class="form-group m-b-0">
	                                                <div class="col-sm-offset-3 col-sm-9">
                                                  	  <input type="hidden" name="id" value="<?= $bannerInfo->id; ?>" id="id">
                                                      <input type="hidden" name="oldImage" id="oldImage" value="<?= $bannerInfo->image; ?>">
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
		
		$('#edit_banner').validate({
					rules: {
						caption		:	{	required:	true
						},
						description : {required:true},
						url : {required:true,url:true},
						status 		: 	{	required:	true	},
						image		: 	{	
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