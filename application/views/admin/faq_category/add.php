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
                        			<form class="form-horizontal" role="form"  name="add_faq_category" id="add_faq_category" method="post" action="<?= base_url(ADMIN_DIR.'/faq_category/add_category/'); ?>" enctype="multipart/form-data">
	                                            <div class="form-group">
	                                                <label for="name" class="col-sm-3 control-label">Category Name</label>
	                                                <div class="col-sm-9">
	                                                 <input type="text" name="name" id="name" class="form-control" value="">
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
		
		$('#add_faq_category').validate({
					rules: {
						name		:	{	required:	true,
											remote :  {
									  			url: "<?= base_url(ADMIN_DIR.'/faq_category/check_exist_name'); ?>",
        										type: "post" 
											}
						},
						status 		: 	{	required:	true}
						},
					messages : {
						name:{required:"Please Enter FAQ Category Name",remote:"This Category Name Is Already Exist, Please Try With Another Name"},
						status	:	{	required:"Please Select Customer Status"}
					}
				});
    });
    </script>