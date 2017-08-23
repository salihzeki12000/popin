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
                        			<form class="form-horizontal" role="form"  name="add_faq" id="add_faq" method="post" action="<?= base_url(ADMIN_DIR.'/faq/update_faq/'); ?>" enctype="multipart/form-data">
	                                            <div class="form-group">
	                                                <label for="name" class="col-sm-3 control-label">Category</label>
	                                                <div class="col-sm-9">
	                                                  <select id="category" name="category" class="form-control select2">
                                                                    <option></option>
																	<?php 
                                                                    $query = $this->db->select('id,name,status')->from('faq_category')->get();
                                                                    $category =  $query->result();
                                                                    foreach($category as $cat)
                                                                    {
                                                                    ?>
                                                                    <option <?= ($faqInfo->category==$cat->id)?'selected':''; ?> value="<?php echo $cat->id; ?>" <?= ($cat->status!='Active')?'disabled':''; ?>><?php echo $cat->name; ?></option>
                                                                    <?php } ?>                                                                   
                                                                </select>
	                                                </div>
	                                            </div>
												
												<div class="form-group">
	                                                <label for="name" class="col-sm-3 control-label">Question</label>
	                                                <div class="col-sm-9">
	                                                  <input type="text" placeholder="Festival Offer On Christmas" name="question" class="form-control" id="question" value="<?= $faqInfo->question; ?>">
	                                                </div>
	                                            </div>
												
												<div class="form-group">
	                                                <label for="name" class="col-sm-3 control-label">Answer</label>
	                                                <div class="col-sm-9">
	                                                 <textarea class="form-control input-sm"  name="answer" id="answer"><?= $faqInfo->answer; ?></textarea>
	                                                </div>
	                                            </div>
												
												
	                                            
	                                            <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Status</label>
	                                                <div class="col-sm-9">
	                                                 <select name="status" id="status" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Active" <?= ($faqInfo->status=='Active')?'selected':''; ?>>Active</option>
                                                            <option value="DeActive" <?= ($faqInfo->status=='DeActive')?'selected':''; ?>>DeActive</option>
                                                            </select>
	                                                </div>
	                                            </div>
	                                            
	                                           
	                                            <div class="form-group m-b-0">
	                                                <div class="col-sm-offset-3 col-sm-9">
														<input type="hidden" name="id" id="id" value="<?= $faqInfo->id; ?>">
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
    $(document).ready(function(e) {
		$('#edit_faq').validate({
					ignore: [],
					rules: {
						question : { required:true},
						answer :{required:true},
						category : {required:true},
						status : {required:true}
					},
					messages : {
						question:{required:"<?php echo "Please Enter The Question"; ?>"},
						answer : {required:"Please Enter The Answer"},
						category : {required:"Please Select The Category"},
						status : { required:"Please Select FAQ Status"}
					}
				});
    });
    </script>