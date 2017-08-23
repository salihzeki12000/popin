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
                        			<form class="form-horizontal" role="form" name="edit_faq_category" id="edit_faq_category" method="post" action="<?= base_url(ADMIN_DIR.'/settings/update_Establishment/'); ?>" enctype="multipart/form-data">
                        			 <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Industry list</label>
	                                                <div class="col-sm-9">
	                                                 <select name="industry" id="industry" class="form-control">
                                                            <option value="">Select industry</option>
                                                            <?php 
                                                              $industry = getMultiRecord('industry','status','active','industry_name','asc');
                                                              foreach ($industry as $key => $value) {
                                                              echo '<option value="'.$value['id'].'" '.($establishment->industry_ID == $value['id']?'selected':'' ).' >'.$value['industry_name'].'</option>';
                                                              }
                                                             ?>
                                                            </select>
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="caption" class="col-sm-3 control-label">Establishment Name</label>
	                                                <div class="col-sm-9">
	                                                 <input type="text" placeholder="General" name="name" class="form-control" id="name" value="<?= $establishment->name; ?>">
	                                                </div>
	                                            </div>
	                                             <div class="form-group">
	                                                <label for="caption" class="col-sm-3 control-label">Description</label>
	                                                <div class="col-sm-9">
	                                                 <textarea class="form-control" name="description" ><?= $establishment->description; ?></textarea>
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Status</label>
	                                                <div class="col-sm-9">
	                                                 <select name="status" id="status" class="form-control">
                                                                    <option value=""></option>
                                                                    <option value="active" <?php echo ($establishment->status=='active')?'selected':''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo ($establishment->status=='inactive')?'selected':''; ?>>Inactive</option>
                                                     </select>
	                                                </div>
	                                            </div>
	  	                                            <div class="form-group m-b-0">
	                                                <div class="col-sm-offset-3 col-sm-9">
                                                  	  <input type="hidden" name="id" value="<?= $establishment->id; ?>" id="id">
                                                      <button type="submit" class="btn btn-info waves-effect waves-light" id="submit" name="submit">Update</button>
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
  //   $(document).ready(function(e) {
		
		// $('#edit_faq_category').validate({
		// 			rules: {
		// 				name		:	{	required:	true,
		// 									remote :  {
		// 							  			url: "<?= base_url(ADMIN_DIR.'/faq_category/check_exist_name'); ?>",
  //       										type: "post" ,
		// 										data : {faq_category_id :'<?= $establishment->id; ?>'}
		// 									}
		// 				},
		// 				status 		: 	{	required:	true}
		// 				},
		// 			messages : {
		// 				name:{required:"Please Enter FAQ Category Name",remote:"This Category Name Is Already Exist, Please Try With Another Name"},
		// 				status	:	{	required:"Please Select Customer Status"}
		// 			}
		// 		});
  //   });
    </script>