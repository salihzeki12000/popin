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
                        			<form class="form-horizontal" role="form" name="edit_faq_category" id="edit_faq_category" method="post" action="<?= base_url(ADMIN_DIR.'/settings/update_Amenities/'); ?>" enctype="multipart/form-data">
	                                          <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Industry list</label>
	                                                <div class="col-sm-9">
	                                                 <select name="industry" id="industry" class="form-control" onchange="onchange_industry(this.value)" >
                                                            <option value="">Select industry</option>
                                                            <?php 
                                                              $industry = getMultiRecord('industry','status','active','industry_name','asc');
                                                              foreach ($industry as $key => $value) {
                                                              echo '<option value="'.$value['id'].'" '.($value['id']==$amenities->industry_id?'selected':'').' >'.$value['industry_name'].'</option>';
                                                              }
                                                             ?>
                                                            </select>
	                                                </div>
	                                            </div>
	                                            <span id="showEstablishment">
	                                            <div class="form-group">
	                                               <label for="image" class="col-sm-3 control-label">Establishment list</label>
	                                                <div class="col-sm-9">
	                                                 <select name="establishment" id="establishment" class="form-control">
                                                     <option value="">Select establishment type</option>
                                                        <?php 
                                                         $establishment = getMultiRecord('establishment_types','status','active');
                                                          foreach ($establishment as $key => $value) {
                                                          	     if ($amenities->industry_id == $value['industry_ID']) {
                                                                  echo '<option value="'.$value['id'].'" '.($value['id']==$amenities->establishment_id?'selected':'').' >'.$value['name'].'</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
	                                                </div>
	                                            </div>
	                                            </span>
	                                             <div class="form-group">
	                                                <label for="name" class="col-sm-3 control-label">Amenities Name</label>
	                                                <div class="col-sm-9">
	                                                 <input type="text" placeholder="enter amenities name" name="name" id="name" class="form-control" value="<?= $amenities->amenities_name; ?>">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Important</label>
	                                                <div class="col-sm-9">
	                                                <label class="radio-inline"><input type="radio" value="2" name="important" <?= ($amenities->amenitiesType == 2?'checked':''); ?> >No</label>
	                                                <label class="radio-inline"><input type="radio" value="1" name="important" <?= ($amenities->amenitiesType == 1?'checked':''); ?> >Yes</label>
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="image" class="col-sm-3 control-label">Status</label>
	                                                <div class="col-sm-9">
	                                                 <select name="status" id="status" class="form-control">
                                                                    <option value=""></option>
                                                                    <option value="active" <?php echo ($amenities->status=='active')?'selected':''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo ($amenities->status=='inactive')?'selected':''; ?>>Inactive</option>
                                                     </select>
	                                                </div>
	                                            </div>
	                                            <div class="form-group m-b-0">
	                                                <div class="col-sm-offset-3 col-sm-9">
                                                  	  <input type="hidden" name="id" value="<?= $amenities->id; ?>" id="id">
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
<script type="text/javascript">
    	function  onchange_industry(getID) {
    	  var establishment	 = '<?php echo json_encode(getMultiRecord('establishment_types','status','active','name','asc'));?>';
    	  var html = '';
    	      html = '<div class="form-group">'+
                     '<label for="image" class="col-sm-3 control-label">Establishment list</label>'+
                     '<div class="col-sm-9"><select name="establishment" id="establishment" class="form-control">'+
                      '<option value="">Select establishment type</option>';
    	      $.each(JSON.parse(establishment), function(idx, obj) {
    	      	  if (obj.industry_ID == getID) {
    	      	  	html += '<option value="'+obj.id+'">'+obj.name+'</option>';
    	      	  }
              });
              html += '</select></div></div>';
              $('#showEstablishment').html(html);
    	}
</script>