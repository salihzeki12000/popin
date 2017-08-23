<?php $this->load->view('frontend/include/user-header'); ?>
<style>
.guest_open .feild {margin-bottom: 20px;width: 100%;}
.guest_open{display: none;}
ul.chosen-choices{margin: 0 !important;padding: 5px !important;}
ul.chosen-choices li {padding: 0 !important;border-top: none  !important;}
ul.chosen-results{ margin: 0 4px 4px 0 !important; }
ul.chosen-results li{ margin: 0 !important;padding: 5px 6px !important;border-top: none  !important; }
.new-partner25 .add-rules .pull-left .textbox{width: 300px;}
</style>
<link href="<?php echo base_url('theme/front/assests/css/btnswitch.css')?>" rel="stylesheet" type="text/css" />
<div class="loader" style="display:none;"></div>
<section class="middle-container listing-sett">
    <div class="container">
        <div class="head-btn clearfix">
            <div class="pull-left">
                <h2>Listings</h2>
            </div>
            <div class="pull-right">
                <a href="<?= site_url('manage-calendar/'.$space_id); ?>"><button class="gost-btn">Calendar</button></a>
            </div>
        </div>
        <div class="main-content">
            <div class="row clearfix">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Listing Details</a></li>
                        <li><a data-toggle="tab" href="#menu1">Renting Settings</a></li>
                        <li><a data-toggle="tab" href="#menu2">Pricing</a></li>
                        <li><a data-toggle="tab" href="#menu3">Availability</a></li>
                        <li><a data-toggle="tab" href="#menu4">Business Partners</a></li>
                    </ul>
                </div>
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="col-md-8 pric">
                                <div class="pro-requr">
                                    <h3>Title &amp; Description</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <form id="title_n_desc" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;" novalidate>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Title</label>
                                                <div class="col-sm-9"><input name="spaceTitle" class="textbox valid" type="text" value="<?= $listing['spaceTitle'];?>" placeholder="Listing Title" required></div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Description</label>
                                                <div class="col-sm-9"><textarea name="spaceDescription" class="textbox valid" placeholder="Listing Description" rows="5" required><?= $listing['spaceDescription'];?></textarea></div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Address</label>
                                                <div class="col-sm-9">
                                                    <div class="main-input">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label class="align-right">Street Address</label>
                                                                <input type="text" class="textbox" name="streetAddress" placeholder="e.g 123 Main St." value="<?php echo $listing['streetAddress']; ?>" required/>
                                                            </div>
                                                            
                                                            <div class="col-sm-6">
                                                                <label class="align-right">Suite, Bldg. (optional)</label>
                                                                <input type="text" class="textbox" name="suiteBuilding" placeholder="e.g. Apt #7" value="<?php echo $listing['suiteBuilding']; ?>" />
                                                            </div>
                                                            
                                                            <div class="col-sm-6">
                                                                <label class="align-right">City</label>
                                                                <input type="text" class="textbox" name="city" placeholder="City" value="<?php echo $listing['city']; ?>" required />
                                                            </div>
                                                            
                                                            <div class="col-sm-6">
                                                                <label class="align-right">State</label>
                                                                <input type="text" class="textbox" name="state" placeholder="State" value="<?php echo $listing['state']; ?>" required />
                                                            </div>
                                                            
                                                            <div class="col-sm-6">
                                                                <label class="align-right">Zip code</label>
                                                                <input type="text" class="textbox" name="zipCode" placeholder="Zip code" value="<?php echo $listing['zipCode']; ?>" required />
                                                            </div>
                                                            
                                                            <div class="col-sm-6">
                                                                <label class="align-right">Country</label>
                                                                <select class="selectbox" name="country" required>
                                                                    <?php $all_countries = unserialize(ALL_COUNTRY); 
                                                                    foreach($all_countries as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['country'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </div>
                                                            <input type="hidden" id="lat" name="latitude" value="<?= $listing['latitude'];?>">
                                                            <input type="hidden" id="lng" name="longitude" value="<?= $listing['longitude'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="pull-right">
                                                        <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                        <button class="btn-red update-btn" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">Title</div>
                                            <div class="pull-right"><?= $listing['spaceTitle'];?></div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="row">
                                                <div class="pull-left col-sm-3">Description</div>
                                                <div class="pull-right col-sm-9"><?= $listing['spaceDescription'];?></div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="row">
                                                <div class="pull-left col-sm-3">Address</div>
                                                <div class="pull-right col-sm-9"><?= $listing['full_address'];?></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-requr space-r">
                                    <h3>Establishment</h3>
                                    <button class="gost-btn edit-btn">Edit</button> 
                                    <form id="establishment" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;">
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Industry</label>
                                                <div class="col-sm-5">
                                                    <select class="selectbox" name="industryType" onchange="onchange_industry(this.value)" required>
                                                        <?php foreach($industries as $industry){ ?>
                                                        <option value="<?= $industry['id']; ?>" <?php echo ($listing['industryTypeId'] == $industry['id'])? 'selected' : ''?>><?= $industry['industry_name']; ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Establishment Type</label>
                                                <div class="col-sm-5">
                                                    <select class="selectbox" name="establishmentType" required>
                                                        <?php foreach($establishment_types as $establishment_type){ if ($listing['industryTypeId'] == $establishment_type['industry_ID']) { ?>
                                                        <option value="<?= $establishment_type['id']; ?>" <?php echo ($listing['establishmentTypeId'] == $establishment_type['id'])? 'selected' : ''?>><?= $establishment_type['name']; ?></option>
                                                        <?php }} ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Space Type</label>
                                                <div class="col-sm-5">
                                                    <select class="selectbox" name="spaceType" required>
                                                        <?php foreach($space_types as $space_type){ ?>
                                                        <option value="<?= $space_type['id']; ?>" <?php echo ($listing['spaceTypeId'] == $space_type['id'])? 'selected' : ''?>><?= $space_type['name']; ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Establishment License Number</label>
                                                <div class="col-sm-5"><input name="establishmentLicence" class="textbox valid" type="text" value="<?= $listing['establishmentLicence'];?>" placeholder="Establishment License Number" required></div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="pull-right">
                                                        <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                        <button class="btn-red update-btn" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                Industry
                                            </div>
                                            <div class="pull-right">
                                                <?= $listing['industryType'];?>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                Establishment Type
                                            </div>
                                            <div class="pull-right">
                                                <?= $listing['establishmentType'];?>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                Space Type
                                            </div>
                                            <div class="pull-right">
                                                <?= $listing['spaceType'];?>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                Establishment License Number
                                            </div>
                                            <div class="pull-right">
                                                <?= $listing['establishmentLicence'];?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-requr new-partner6 new-partner7">
                                    <h3>About Space</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <div class="space-are">                                        
                                        <form id="workspaces-form" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;">
                                            <h3>How many professionals can your space accommodate?</h3>
                                            <div class="feild">
                                                <div class="main">
                                                    <input type='text' class="textbox" name='professionalCapacity' value='<?php echo $listing['professionalCapacity']; ?> professionals' class='qty' />
                                                    <input type='button' value='' class='qtyminus' field='professionalCapacity' />
                                                    <input type='button' value='' class='qtyplus' field='professionalCapacity' />
                                                </div>
                                            </div>
                                            
                                            <h3>How many workspaces does your space have?</h3>
                                            <div class="feild">
                                                <div class="main">
                                                    <input type='text' class="textbox" name='workSpaceCount' value='<?php echo $listing['workSpaceCount'];?> workspaces' class='qty' />
                                                    <input type='button' value='' class='qtyminus' field='workSpaceCount' />
                                                    <input type='button' value='' class='qtyplus' field='workSpaceCount' />
                                                </div>
                                            </div>
                                            
                                            <h3>What kind of workspaces does your space have?</h3>
                                            <div class="feild works-details">
                                                <h4 style="font-weight: normal">Workspace Details</h4>
                                                <ul></ul>
                                            </div>
                                            
                                            <div class="main-input">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="pull-right">
                                                            <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                            <button class="btn-red update-btn" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                Accommodates
                                            </div>
                                            <div class="pull-right">
                                                <?= $listing['professionalCapacity'];?> Professional(s)
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                Workspaces
                                            </div>
                                            <div class="pull-right">
                                                <?= $listing['workSpaceCount'];?> Workspaces(s)
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="row">
                                                <div class="pull-left col-sm-3">Workspace Details</div>
                                                <div class="pull-right col-sm-9">
                                                    <ul style="padding: 0;float: right;">
                                                    <?php
                                                    if(isset($listing['workSpaceDetail'])){
                                                        $workSpaceDetail = json_decode($listing['workSpaceDetail'], TRUE);
                                                        for($i = 1; $i<=count($workSpaceDetail); $i++){
                                                    ?>
                                                    <li style="display: inline-block;border: none;padding: 0 10px;">
                                                        <?php if(isset($workSpaceDetail["ws{$i}"])){ ?>
                                                        <p><strong>Workspace <?= $i; ?></strong></p>
                                                        <p>
                                                            <?php
                                                                foreach($space_types as $v){
                                                                    if(isset($workSpaceDetail["ws{$i}"]["sp"]) && $workSpaceDetail["ws{$i}"]["sp"] == $v['id']){
                                                                        echo $v['name'];
                                                                    }
                                                                }
                                                            ?>
                                                            <?php
                                                                if(isset($workSpaceDetail["ws{$i}"]["cm"])){
                                                                    echo "(In Common Space)";
                                                                }
                                                            ?>
                                                        </p>
                                                        <?php }?>
                                                    </li>
                                                    <?php }}?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-requr new-partner6 new-partner25">
                                    <h3>Amenities</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <div class="space-are">                                        
                                        <form id="amenities-form" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;">
                                            <h3>What amenities do you offer?</h3>
                                            <?php foreach($amenities['Important'] as $k => $amtyI){ ?>
                                            <div class="feild">
                                                <label for="aminity<?= $k; ?>">
                                                    <input id="aminity<?= $k; ?>" type="checkbox" name="amenities[main][]" value="<?= $amtyI['id']; ?>" <?php echo (isset($listing['amenities']['main']) && !empty($listing['amenities']['main']) && in_array($amtyI['id'], $listing['amenities']['main']))? 'checked' : ''?> required> <?= $amtyI['name']; ?>
                                                </label>
                                            </div>
                                            <?php } ?> 
                                            <div class="feild amenity hidden">
                                                <label>More amenities</label>
                                                <select class="selectbox  chosen-select" name="amenities[main][]" data-placeholder="Select Amenities" multiple>
                                                    <?php foreach($amenities['General'] as $amtyG){ ?>
                                                    <option value="<?= $amtyG['id']; ?>" <?php echo (isset($listing['amenities']['main']) && !empty($listing['amenities']['main']) && in_array($amtyG['id'], $listing['amenities']['main']))? 'selected' : ''?>><?= $amtyG['name']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="feild"><a href="#" class="show-more" data-target-key="amenity">+ Expand More</a></div>

                                            <div class="feild add-rules">
                                                <div class="additional-rules">
                                                    <?php 
                                                    if(isset($listing['amenities']['other']) && !empty($listing['amenities']['other'])){
                                                        foreach($listing['amenities']['other'] as $amenity){
                                                    ?>
                                                    <div class="append-div">
                                                        <input class="textbox" name="amenities[other][]" value="<?= $amenity; ?>" type="text" readonly />
                                                        <a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a>
                                                    </div>
                                                    <?php }} ?>
                                                </div>
                                                <div class="clearfix">
                                                    <span class="pull-left"><input id="rule-text" class="textbox" type="text" placeholder="Add your own amenities" ></span>
                                                    <span class="pull-left"><button class="red-btn" id="add-rule" type="button">Add</button></span>
                                                </div>
                                            </div>
                                            <?php if(!empty($facilities)): ?>
                                            <h3 class="mt20">What facilities can professionals use?</h3>
                                            <?php foreach($facilities as $k => $facility){ ?>
                                            <div class="feild">
                                                <label for="facility<?= $k; ?>">
                                                    <input id="facility<?= $k; ?>" type="checkbox" name="facilities[main][]" value="<?= $facility['id']; ?>" <?php echo (!empty($listing['facilities']['main']) && in_array($facility['id'], $listing['facilities']['main']))? 'checked' : ''?>> <?= $facility['name']; ?>
                                                    <?php if(!empty($facility['description'])): ?>
                                                    <span></span>
                                                    <?php endif;?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                            <?php endif;?>
                                            <div class="feild add-rules">
                                                <div class="additional-facilities">
                                                    <?php 
                                                    if(isset($listing['facilities']['other']) && !empty($listing['facilities']['other'])){
                                                        foreach($listing['facilities']['other'] as $facility){
                                                    ?>
                                                    <div class="append-div">
                                                        <input class="textbox" name="facilities[other][]" value="<?= $facility; ?>" type="text" readonly />
                                                        <a class="clos cancel-facility" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a>
                                                    </div>
                                                    <?php }} ?>
                                                </div>
                                                <div class="clearfix">
                                                    <span class="pull-left"><input id="facility-text" class="textbox" type="text" placeholder="Add your own facilities" ></span>
                                                    <span class="pull-left"><button class="red-btn" id="add-facility" type="button">Add</button></span>
                                                </div>
                                            </div>
                                            
                                            <div class="main-input">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="pull-right">
                                                            <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                            <button class="btn-red update-btn" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left col-sm-3">
                                                Amenities
                                            </div>
                                            <div class="pull-right col-sm-9">
                                                <?php 
                                                $aminity_value = "";
                                                if(!empty($listing['amenities']['main'])){
                                                foreach($amenities['Important'] as $aminity){ 
                                                    if(!empty($listing['amenities']['main']) && in_array($aminity['id'], $listing['amenities']['main'])){ 
                                                        $aminity_value .= "<strong>".$aminity['name']."</strong>, ";
                                                    }
                                                }
                                                foreach($amenities['General'] as $aminity){ 
                                                    if(!empty($listing['amenities']['main']) && in_array($aminity['id'], $listing['amenities']['main'])){ 
                                                        $aminity_value .= $aminity['name'].", ";
                                                    }
                                                }?>
                                                <p><?= rtrim($aminity_value, ", "); ?></p>
                                                <?php }?>
                                                <?php
                                                if(!empty($listing['amenities']['other'])){
                                                    $aminity_value = implode(", ", $listing['amenities']['other']);
                                                ?>
                                                <p><?= $aminity_value; ?></p>
                                                <?php }?>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left col-sm-3">
                                                Facilities
                                            </div>
                                            <div class="pull-right col-sm-9">
                                                <?php 
                                                $facility_value = "";
                                                if(!empty($listing['facilities']) && isset($listing['facilities']['main'])){
                                                foreach($facilities as $facility){ 
                                                    if(in_array($facility['id'], $listing['facilities']['main'])){ 
                                                        $facility_value .= "<strong>".$facility['name']."</strong>, ";
                                                    }
                                                }}?>
                                                <p><?= rtrim($facility_value, ", "); ?></p>
                                                <?php
                                                if(!empty($listing['facilities']['other'])){
                                                    $aminity_value = implode(", ", $listing['facilities']['other']);
                                                ?>
                                                <p><?= $aminity_value; ?></p>
                                                <?php }?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">            
                            <div class="col-md-8">
                                <h3>How professionals can rent</h3>
                                <p>Partners easily get more rentals when they allow professionals to rent without requesting approval. <br/><a href="#">learn more</a></p>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optradio" value="No" onchange="autoSave('rentalRequests',this.value)" <?= ($listing['rentalRequests']=='No')?'checked':''?>>Professionals who meet all your requirements can rent without requesting approval
                                        <span>RECOMMENDED</span>
                                        <P>Everyone must submit a rental request</P>
                                    </label>
                                </div>
                                 <div class="radio border-none pd0">
                                     <label><input type="radio" name="optradio" value="Yes" onchange="autoSave('rentalRequests',this.value)" <?= ($listing['rentalRequests']=='Yes')?'checked':''?>>All professionals must send rental requests</label>
                                </div>
                                <div class="pro-requr">
                                    <h3>Professional requirements</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <strong>PopIn standard requirements</strong>
                                    <p>Profile photo, confirmed email and phone number, payment information, agreement to Space Rules.</p>
                                    <form id="professional-rules" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;">
                                        <?php $spacesRules = unserialize(REQUIREMENTS); 
                                        foreach($spacesRules as $k=>$v){ ?>
                                        <div class="feild">
                                            <label for="requirement_<?= $k; ?>">
                                                <input id="requirement_<?= $k; ?>" type="checkbox" name="professionalRequirements[]" value="<?= $k; ?>" <?php echo (!empty($listing['professionalRequirements']) && in_array($k, $listing['professionalRequirements']))? 'checked' : ''?>> <?= $v; ?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                        <div class="main-input">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="pull-right">
                                                        <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                        <button class="btn-red update-btn" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="listing-info">
                                        <?php foreach($spacesRules as $k=>$v){ ?>
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                <?= $v; ?> <span>Instant Rent Only</span>
                                            </div>
                                            <div class="pull-right">
                                                <?php if(!in_array($k, $listing['professionalRequirements'])){ ?>
                                                <strong>Not set</strong>
                                                <?php }else{ ?>
                                                <img src="<?= base_url('theme/front/assests/img/right-singh.png'); ?>" alt="">
                                                <?php }?>
                                            </div>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                                <div class="pro-requr space-r new-partner25">
                                    <h3>Space Rules</h3>
<!--                                    <button class="gost-btn">Edit</button>-->
                                    <form id="space-rules" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off">
                                        <ul class="space-are">
                                            <li class="clearfix">
                                                <div class="pull-left">Age requirement</div>
                                                
                                                <div class="pull-right">
                                                    <?php //echo $listing['ageRequirements']=='Yes'?$listing['ageLimit']:$listing['ageRequirements'];?>
                                                    <div class="demo1" id="a" style="margin-top: 5px;"></div>
                                                    <input type="hidden" id="ageRequirements" name="ageRequirements" value="<?= $listing['ageRequirements'];?>" />
                                                </div>
                                                <div class="pull-right age-req" <?= $listing['ageRequirements']=='No'?'style="display: none;"':'';?>>
                                                    <input type="number" placeholder="Age" min="1" name="ageLimit" value="<?= $listing['ageLimit'];?>" <?= (strtolower($listing['ageRequirements']) == 'no')?"disabled":'';?> />                                                
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="pull-left">Display License or Certificate in workspace</div>
                                                <div class="pull-right">
                                                    <div class="demo1" id="b"></div>
                                                    <input type="hidden" id="displayLicence" name="displayLicence" value="<?= $listing['displayLicence'];?>" />
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="pull-left">Events or parties are allowed</div>
                                                <div class="pull-right">
                                                    <div class="demo1" id="d"></div>
                                                    <input type="hidden" id="eventPartiesAllowed" name="eventPartiesAllowed" value="<?= $listing['eventPartiesAllowed'];?>" />
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="pull-left">Pets allowed</div>
                                                <div class="pull-right">
                                                    <div class="demo1" id="c"></div>
                                                    <input type="hidden" id="suitablePets" name="suitablePets" value="<?= $listing['suitablePets'];?>" />
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="add-rules">
                                            <h4>Additional rules</h4>
                                            <div class="additional-rules">
                                                <?php if(isset($listing['additionalRules']) && !empty($listing['additionalRules'])){ ?>                                    
<!--                                                <ul class="listing-info">-->
                                                <?php  foreach($listing['additionalRules'] as $additionalRules){ ?>
                                                    <div class="append-div">
                                                        <input class="textbox" name="additionalRules[]" value="<?= $additionalRules; ?>" type="text" readonly />
                                                        <a class="clos delete-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a>
                                                    </div>
                                                <?php } ?>
<!--                                                </ul>-->
                                                <?php } ?>                                                
                                            </div>
                                            <div class="feild">
                                                <input type="text" id="rule-textbox" class="textarea" placeholder="Add your own here" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="pro-requr space-r policie-s">
                                    <h3>Policies</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <form id="policies" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;" novalidate>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Currency:</label>
                                                <div class="col-sm-6">
                                                    <select class="selectbox custom-select" name="cancellation_term" required>
                                                        <?php 
                                                        $cancellation_term = 'Not Set'; $cancellation_term_details = '';
                                                        foreach($cancellation_policies as $policy) { 
                                                            $selected = $listing['cancellation_term'] == $policy['id']? 'selected' : '';
                                                            if($listing['cancellation_term'] == $policy['id']){
                                                                $cancellation_term = $policy['term'];
                                                                $cancellation_term_details = $policy['description'];
                                                            }                                                            
                                                        ?>
                                                        <option value="<?= $policy['id']; ?>" <?= $selected; ?>><?= $policy['term']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="pull-right">
                                                        <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                        <button class="btn-red update-btn" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">
                                                Cancellation policy
                                            </div>
                                            <div class="pull-right">                                                
                                                <p><strong><?= $cancellation_term; ?></strong>: <?= $cancellation_term_details; ?></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="increase-profit">
                                    <h3>Increase your profit with Instant Rental</h3>
                                    <p>Instant Rental can give your listing an advantage.<br/>Professionals enjoy the ease of renting instantly</p>
                                    <button class="btn2">Turn on Instant Book</button>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="col-md-8 pric">
                                <div class="pro-requr space-r">
                                    <h3>Currency</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <form id="currency" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;" novalidate>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Currency:</label>
                                                <div class="col-sm-6">
                                                    <select class="textbox" name="currency" required>
                                                        <?php $all_currency = unserialize(CURRENCIES); 
                                                         foreach($all_currency as $k=>$v) { ?>
                                                         <option value="<?= $k; ?>" <?php echo $listing['currency'] == $k? 'selected' : ''?>><?= $v; ?></option>
                                                         <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="pull-right">
                                                        <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                        <button class="btn-red update-btn" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">Currency</div>
                                            <div class="pull-right"><?= $listing['currency']?></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-requr space-r">
                                    <h3>Hourly Price</h3>
                                    <button class="gost-btn edit-btn">Edit</button> 
                                    <form id="base-price" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;" novalidate>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Base Price (per hour):</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="textbox" name="base_price" placeholder="per hour" value="<?php echo $listing['base_price'];?>" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="pull-right">
                                                        <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                        <button class="btn-red update-btn" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">Base price</div>
                                            <div class="pull-right"><?= getCurrency_symbol($listing['currency']).$listing['base_price'];?>/hour</div>
                                        </li>
                                        <li class="clearfix">
                                            You are responsible for choosing the listing price. <a href=”#”>Learn More</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-requr space-r">
                                    <h3>Discounts</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <form id="discounts" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;" novalidate>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Daily discount:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="textbox" name="daily_discount" min="0" max="100" maxlength="3" placeholder="0% off" value="<?php echo $listing['daily_discount'];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Weekly discount:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="textbox" name="weekly_discount" min="0" max="100" maxlength="3" placeholder="0% off" value="<?php echo $listing['weekly_discount'];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="pull-right">
                                                        <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                        <button class="btn-red update-btn" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">Daily</div>
                                            <div class="pull-right"><?= $listing['daily_discount']?$listing['daily_discount'].'%':'None'; ?></div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">Weekly</div>
                                            <div class="pull-right"><?= $listing['weekly_discount']?$listing['weekly_discount'].'%':'None'; ?></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-requr space-r">
                                    <h3>Additional Costs</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <form id="additional-costs" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;" novalidate>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Cleaning Fee:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="textbox" name="cleaningFee" maxlength="5" placeholder="Cleaning Fee" value="<?php echo $listing['cleaningFee'];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <label class="align-right col-sm-3">Security Deposit:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="textbox" name="securityDeposit" maxlength="5" placeholder="Security Deposit" value="<?php echo $listing['securityDeposit'];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-input">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="pull-right">
                                                        <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                        <button class="btn-red update-btn" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">Cleaning Fee</div>
                                            <div class="pull-right"><?= $listing['cleaningFee']?getCurrency_symbol($listing['currency']).$listing['cleaningFee']:'None'; ?></div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">Security Deposit</div>
                                            <div class="pull-right"><?= $listing['securityDeposit']?getCurrency_symbol($listing['currency']).$listing['securityDeposit']:'None'; ?></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php $noticesArray = unserialize(NOTICES); $gapsArray = unserialize(GAPS); $advanceArray = unserialize(ADVANCE_NOTICES); ?>
                        <div id="menu3" class="tab-pane fade">
                            <div class="col-md-8 new-partner6 new-partner7 new-partner34">
                                <div class="pro-requr space-r">
                                    <h3>Availability Settings</h3>
                                    <button class="gost-btn edit-btn">Edit</button>
                                    <div class="space-are">
                                        <form id="availability" class="form-horizontal" method="post" action="<?= site_url('listing/update_listing_details'); ?>" autocomplete="off" style="display: none;" novalidate>
                                            <h3>How much notice do you need before a professional arrives?</h3>
                                            <div class="main-input feild">
                                                <select class="selectbox custom-select" name="noticeTime">
                                                    <?php foreach($noticesArray as $k => $v){ ?>
                                                    <option value="<?= $k; ?>" <?php echo ($listing['noticeTime'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            
                                            <h3>How much time do you want between professionals?</h3>
                                            <div class="feild">
                                                <select class="selectbox custom-select" name="bookingGap">
                                                    <?php foreach($gapsArray as $k => $v){ ?>
                                                    <option value="<?= $k; ?>" <?php echo ($listing['bookingGap'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            
                                            <div class="rental-hours">
                                                <h4>When can professionals rent your workspace?</h4>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">&nbsp;</th>
                                                            <td>From:</td>
                                                            <td>To:</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Monday</th>
                                                            <td>
                                                                <select class="selectbox" name="monFrom">
                                                                    <?php $times = unserialize(TIMES); 
                                                                    foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['monFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="selectbox" name="monTo">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['monTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <th scope="row">Tuesday</th>
                                                            <td>
                                                                <select class="selectbox" name="tueFrom">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['tueFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="selectbox" name="tueTo">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['tueTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Wednesday</th>
                                                            <td>
                                                                <select class="selectbox" name="wedFrom">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['wedFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="selectbox" name="wedTo">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['wedTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Thursday</th>
                                                            <td>
                                                                <select class="selectbox" name="thuFrom">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['thuFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="selectbox" name="thuTo">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['thuTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Friday</th>
                                                            <td>
                                                                <select class="selectbox" name="friFrom">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['friFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="selectbox" name="friTo">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['friTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Saturday</th>
                                                            <td>
                                                                <select class="selectbox" name="satFrom">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['satFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="selectbox" name="satTo">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['satTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Sunday</th>
                                                            <td>
                                                                <select class="selectbox" name="sunFrom">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['sunFrom'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="selectbox" name="sunTo">
                                                                    <?php foreach($times as $k=>$v){ ?>
                                                                    <option value="<?= $k; ?>" <?php echo ($listing['sunTo'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                                    <?php } ?> 
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                  </table>
                                            </div>
                                            
                                            <h3>How far in advance can professionals book?</h3>
                                            <div class="main-input feild">
                                                <select class="selectbox custom-select" name="advanceBook">
                                                    <?php foreach($advanceArray as $k => $v){ ?>
                                                    <option value="<?= $k; ?>" <?php echo ($listing['advanceBook'] == $k)? 'selected' : ''?>><?= $v; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            
                                            <h3>How long can professionals stay?</h3>
                                            <div class="alert alert-danger" style="display: none;">
                                                <strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i></strong> Minimum stay can’t be higher than maximum stay.
                                            </div>
                                            
                                            <div class="main-input feild">
                                                <div class="main">
                                                    <input type='text' class="textbox" name='minStay' value='<?php echo $listing['minStay']; ?> <?php echo $listing['minStayType']?> min' class='qty' />
                                                    <input type='button' value='' class='qtyminus2' field='minStay' />
                                                    <input type='button' value='' class='qtyplus2' field='minStay' />
                                                </div>
                                                <input type='hidden' value='<?php echo $listing['minStayType']?>' name='minStayType' />
                                            </div>
                                            <div class="main-input feild">
                                                <div class="main">
                                                    <input type='text' class="textbox" name='maxStay' value='<?php echo $listing['maxStay']; ?> <?php echo $listing['maxStayType']?> max' class='qty2' />
                                                    <input type='button' value='' class='qtyminus2' field='maxStay' />
                                                    <input type='button' value='' class='qtyplus2' field='maxStay' />
                                                </div>
                                                <input type='hidden' value='<?php echo $listing['maxStayType']?>' name='maxStayType' />
                                            </div>
                                            <div class="main-input">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="pull-right">
                                                            <a class="btn2 cancel-btn" href="#">Cancel</a>
                                                            <button class="btn-red update-btn" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>                                        
                                    </div>
                                    <ul class="listing-info">
                                        <li class="clearfix">
                                            <div class="pull-left">How much notice do you need before a professional arrives?</div>
                                            <div class="pull-right"><?= $noticesArray[$listing['noticeTime']]; ?></div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">How much time do you want between professionals?</div>
                                            <div class="pull-right"><?= $gapsArray[$listing['bookingGap']]; ?></div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">How far in advance can professionals book?</div>
                                            <div class="pull-right"><?= $advanceArray[$listing['advanceBook']]; ?></div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="pull-left">How long can professionals stay?</div>
                                            <div class="pull-right">
                                                <strong><?php echo !empty($listing['minStay'])? $listing['minStay'].$listing['minStayType'] : 'No'?></strong> Min Stay, <strong><?php echo !empty($listing['maxStay'])? $listing['maxStay'].$listing['maxStayType'] : 'No'; ?></strong> Max Stay
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane fade">
                            <h3>Business Partners</h3>
<!--                            <p>Some content in menu 2.</p>-->
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>

<script>
function  onchange_industry(getID) {
    var establishment	 = '<?php echo json_encode($establishment_types);?>';
    var html = '';
    html = '<option value="" selected disabled>Select establishment type</option>';
    $.each(JSON.parse(establishment), function(idx, obj) {
        if (obj.industry_ID === getID) {
              html += '<option value="'+obj.id+'">'+obj.name+'</option>';
        }
    });
    
    $("select[name='establishmentType']").html(html);
}
$(document).ready(function(){
    $('.chosen-select').chosen();
    
    $(".edit-btn").on("click", function(){
        $("form:not(#space-rules)").hide();
        $("ul.listing-info").show();
        
        $(this).parent().find("form").toggle();
        $(this).parent().find("ul.listing-info").toggle();
    });
    $(".cancel-btn").on("click", function(e){
        e.preventDefault();        
        $(this).parents("form").toggle();
        $(this).parents(".pro-requr").find("ul.listing-info").toggle();
        $(this).parents("form").trigger("reset");
    });
    
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $('input[name='+fieldName+']').val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // Increment
        currentVal++;
        // If is not undefined
        if (!isNaN(currentVal)) {            
            $('input[name='+fieldName+']').val(currentVal + inputString);
            if(fieldName === 'workSpaceCount'){
                create_workspace_boxes(currentVal);
            }
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $('input[name='+fieldName+']').val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // Decrement one
        currentVal--;
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {            
            $('input[name='+fieldName+']').val(currentVal + inputString);
            if(fieldName === 'workSpaceCount'){
                create_workspace_boxes(currentVal);
            }
        }
    });
    
    var workSpacesCount = parseInt($("input[name='workSpaceCount']").val());
    create_workspace_boxes(workSpacesCount);
    activate_deactivate_submit();    
    
    $(document).on("change", ".works-details select", function(){
        var type = $(this).find("option:selected").text();
        var $parent = $(this).parents('li');
        
        $parent.find("p.workspace_type").text(type);
    });
    $(document).on("click", ".works-details input[type='checkbox']", function(){
        var $parent = $(this).parents('li');
        if($(this).is(":checked")){
            $parent.find("p.workspace_info").text("In Common Space");
        }else{
            $parent.find("p.workspace_info").text("");
        }
        
    });
    
    $(document).on('click', 'a.add_spaces', function() {      
        var button_text = $(this).text();
        
        $(this).parents('li').find(".guest_open, .workspace_type, .workspace_info").toggle();
        
        if($(this).parents('li').find(".guest_open").is(':visible')){
            button_text = "Done";
        }else{
            var action = $(this).parents('li').find("p.workspace_type").text();
            if(action !== ""){
                button_text = "Edit spaces";
            }else{
                button_text = "Add spaces";
            }
        }
        
        $(this).text(button_text);
        
        activate_deactivate_submit();
    });
    
    $(document).on('click', 'a.show-more', function(e){
        e.preventDefault();
        var $this = $(this), target = $(this).attr("data-target-key");

        //$("."+target).toggle();
        $( "."+target ).toggleClass(function() {
            if ( $( this ).is( ".hidden" ) ) {
                console.log('shown');
                $this.html('- Less');
                return "hidden";
            } else {
                console.log('hidden');
                $this.html('+ Expand More');
                return "hidden";
            }

        });
    });
    // Amenities
    $('#add-rule').click(function(){
        var text = $('#rule-text').val();
        if(text.trim() !== ""){
            $('.additional-rules').append('<div class="append-div"><input class="textbox" name="amenities[other][]" value="'+text+'" type="text" readonly /><a class="clos cancel-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a></div>');
            $('#rule-text').val('');
        }
    });
    $(document).on('click','.cancel-rule, .cancel-facility',function(event){
        event.preventDefault();
        $(this).parent('div').remove();
    });
    $(document).on("keypress", "input#rule-text", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('add-rule').click();
        }
    });
    // Facilities
    $('#add-facility').click(function(){
        var text = $('#facility-text').val();
        if(text.trim() !== ""){
            $('.additional-facilities').append('<div class="append-div"><input class="textbox" name="facilities[other][]" value="'+text+'" type="text" readonly /><a class="clos cancel-facility" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a></div>');
            $('#facility-text').val('');
        }
    });
    $(document).on("keypress", "input#facility-text", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById('add-facility').click();
        }
    });
    
    $(document).on("keypress", "input#rule-textbox", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            var text = $(this).val();
            if(text.trim() !== ""){
                $(this).parent().prev().append('<div class="append-div"><input class="textbox" name="additionalRules[]" value="'+text+'" type="text" readonly /><a class="clos delete-rule" href="#"><img src="<?= base_url('theme/front/assests/img/alert-close-icon.png'); ?>" alt="" /></a></div>');
                $(this).val('');
                submit_rule_form();
            }
        }
    });
    $(document).on('click','.delete-rule',function(event){
        event.preventDefault();
        $(this).parent('div').remove();
        submit_rule_form();
    });
    
    $("input[name='base_price'],input[name='daily_discount'],input[name='weekly_discount'],input[name='cleaningFee'],input[name='securityDeposit']").keypress(function (e) {
        
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //var errorMsg = $('<label for="page6[mobileNumber]" class="error">Please enter digits only.</label>');
            //$("label.error").remove();
            //errorMsg.insertAfter($(this).parent());
            //$("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
        }else{
            //$("label.error").remove();
            //$("a.verify-button").css('display', 'inline-block');
        }
    });
    // This button will increment the value
    $('.qtyplus2').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $('input[name='+fieldName+']').val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // Increment
        currentVal++;
        var variable = get_stay_var(currentVal, inputString, 'Plus');
        // If is not undefined
        if (!isNaN(variable[0])) {            
            $('input[name='+fieldName+']').val(variable[0] + variable[1]);
            $('input[name='+fieldName+'Type]').val(variable[2]);
        } else {
            // Otherwise put a 0 there
            //$('input[name='+fieldName+']').val(0 + inputString);
        }

        var minStay = parseInt($("input[name='minStay']").val());
        var maxStay = parseInt($("input[name='maxStay']").val());
        validate_inputs(minStay, maxStay, variable[2]);
    });
    // This button will decrement the value till 0
    $(".qtyminus2").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var fieldName = $(this).attr('field');
        // Get its current value
        var inputString = $('input[name='+fieldName+']').val();
        var currentVal = parseInt(inputString);
        inputString = inputString.replace(/[0-9]/g, '');
        // Decrement
        currentVal--;
        var variable = get_stay_var(currentVal, inputString, 'Minus');
        // If it isn't undefined or its greater than 0
        if (!isNaN(variable[0]) && variable[0] >= 0) {            
            $('input[name='+fieldName+']').val(variable[0] + variable[1]);
            $('input[name='+fieldName+'Type]').val(variable[2]);
        } else {
            // Otherwise put a 0 there
            //$('input[name='+fieldName+']').val(0 + variable[1]);
        }

        var minStay = parseInt($("input[name='minStay']").val());
        var maxStay = parseInt($("input[name='maxStay']").val());
        validate_inputs(minStay, maxStay, variable[2]);
    });
    $('form#availability').validate({
        rules: {
            monFrom :{ required:function(element){ return $("select[name='monTo']").val().length > 0;}},
            monTo :{ required:function(element){ return $("select[name='monFrom']").val().length > 0;}},
            tueFrom :{ required:function(element){ return $("select[name='tueTo']").val().length > 0;}},
            tueTo :{ required:function(element){ return $("select[name='tueFrom']").val().length > 0;}},
            wedFrom :{ required:function(element){ return $("select[name='wedTo']").val().length > 0;}},
            wedTo :{ required:function(element){ return $("select[name='wedFrom']").val().length > 0;}},
            thuFrom :{ required:function(element){ return $("select[name='thuTo']").val().length > 0;}},
            thuTo :{ required:function(element){ return $("select[name='thuFrom']").val().length > 0;}},
            friFrom :{ required:function(element){ return $("select[name='friTo']").val().length > 0;}},
            friTo :{ required:function(element){ return $("select[name='friFrom']").val().length > 0;}},
            satFrom :{ required:function(element){ return $("select[name='satTo']").val().length > 0;}},
            satTo :{ required:function(element){ return $("select[name='satFrom']").val().length > 0;}},
            sunFrom :{ required:function(element){ return $("select[name='sunTo']").val().length > 0;}},
            sunTo :{ required:function(element){ return $("select[name='sunFrom']").val().length > 0;}}
        },
        submitHandler: function(form) {
            var minStay = parseInt($("input[name='minStay']").val());
            var maxStay = parseInt($("input[name='maxStay']").val());
            var minStayType = $("input[name='minStayType']").val();
            var maxStayType = $("input[name='maxStayType']").val();
            
            if(minStay > maxStay && maxStay !== 0 && minStayType === maxStayType){
                return false;
            }else if(maxStay !== 0 && minStayType === "days" && maxStayType === "hours"){
                return false;
            }
            $.ajax({
                url: form.action,
                type: form.method,
                data: "space_id=<?= $space_id; ?>&" + $(form).serialize(),
                dataType: 'json',
                beforeSend: function(){
                    $(".loader").show();
                },
                complete: function(){
                    $('.loader').hide();
                },
                success: function(response) {
                    if(response.success){
                        window.location.reload();
                    }

                }            
            });
        }
    });
    $('form:not(#space-rules,#availability)').each(function() {   // <- selects every <form> on page
        $(this).validate({
            ignore: ":not(:visible),:disabled",
            
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: "space_id=<?= $space_id; ?>&" + $(form).serialize(),
                    dataType: 'json',
                    beforeSend: function(){
                        $(".loader").show();
                    },
                    complete: function(){
                        $('.loader').hide();
                    },
                    success: function(response) {
                        if(response.address){
                            geocoder = new google.maps.Geocoder();

                            geocoder.geocode( { 'address': response.full_address }, function(results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    // log out results from geocoding

                                    var latitude = parseFloat(results[0].geometry.location.lat());
                                    var longitude = parseFloat(results[0].geometry.location.lng());

                                    document.getElementById('lat').value = latitude;
                                    document.getElementById('lng').value = longitude;

                                    $.post(form.action, "space_id=<?= $space_id; ?>&" + $(form).serialize(), function(data){
                                        var response = JSON.parse(data);
                                        if(response.success){
                                            window.location.reload();
                                        }
                                    });
                                }
                            });
                        }else if(response.success){
                            window.location.reload();
                        }

                    }            
                });
            }
        });
    });
});
<?php
$this->session->unset_userdata('stepData');
?>
function create_workspace_boxes(workspaces){
    <?php
    $stepData['step1']['page2']['workSpaceDetail'] = $listing['workSpaceDetail'];
    $this->session->set_userdata('stepData', $stepData);
    ?>
    $(".works-details ul").block({ 
        overlayCSS: { backgroundColor: '#E5E5E5' }, 
        message: '<img src="<?= base_url(); ?>assets/images/loading-spinner-grey.gif" alt="please wait...">',
        css: { border: 'none', backgroundColor: 'transparent' }  
    });

    $.ajax({
        url: "<?= site_url('Space/create_workspace_boxes'); ?>",
        type: "POST",
        data: "workspaces="+workspaces,
        success: function(response) {
            $(".works-details ul").html(response);
            $(".works-details ul").unblock();
            activate_deactivate_submit();
        },
        error: function(response){
            $(".works-details ul").unblock();
        }
    });
}
function activate_deactivate_submit(){
    var fullTotal = false;
    $(".ws-box").each(function(){
        var boxValue = $(this).find('p.workspace_type').text();
        if(boxValue !== ""){
            fullTotal = true;
        }else{
            fullTotal = false;
        }
    });
    //console.log(fullTotal);
    if(fullTotal){
        $("form#workspaces-form button[type='submit']").prop("disabled", false);
    }else{
        $("form#workspaces-form button[type='submit']").prop("disabled", true);
    }
}
function submit_rule_form(){
    //$("form#space-rules").trigger('submit');
    $.ajax({
        url: $("form#space-rules").attr('action'),
        type: $("form#space-rules").attr('method'),
        data: "space_id=<?= $space_id; ?>&" + $("form#space-rules").serialize(),
        dataType: 'json',
        beforeSend: function(){
            $(".loader").show();
        },
        complete: function(){
            $('.loader').hide();
        },
        success: function(response) {

        }            
    });
}
function autoSave(fieldName,fieldvalue)
{
    $.ajax({
        url: '<?= site_url('listing/update_listing_details'); ?>',
        type: 'POST',
        dataType: "json",
        data: "space_id=<?= $space_id; ?>&" + fieldName + "=" + fieldvalue,
        beforeSend: function(){
            $(".loader").show();
        },
        complete: function(){
            $('.loader').hide();
        },
        success: function(response) {
                
        }          
    });
}
var minStayVar = parseInt($("input[name='minStay']").val());
var maxStayVar = parseInt($("input[name='maxStay']").val());
validate_inputs(minStayVar, maxStayVar);
function validate_inputs(minStay, maxStay) {
    //console.log("Min: " + minStay + ", Max: " + maxStay);
    var minStayType = $("input[name='minStayType']").val();
    var maxStayType = $("input[name='maxStayType']").val();
    // Remove error label
    if(minStay > 0){
        $("label.minStay").remove();
    }
    if(maxStay > 0){
        $("label.maxStay").remove();
    }
    // Check for valid inputs
    if(minStay > maxStay && maxStay !== 0 && minStayType === maxStayType){
        $(".alert").show();
    }else if(maxStay !== 0 && minStayType === "days" && maxStayType === "hours"){
        $(".alert").show();
    }else{
        $(".alert").hide();
    }
}

function get_stay_var(value, type, action){
    var myArray = new Array(2);
    myArray[0] = value;
    myArray[1] = type;
    myArray[2] = (type === " hours min" || type === " hours max")?"hours":"days";

    if(value > 12 && (type === " hours min" || type === " hours max")){
        myArray[0] = 1;
        myArray[1] = (type === " hours min")?" days min":" days max";
        myArray[2] = "days";
    }else if(action === "Minus" && value == 0 && (type === " days min" || type === " days max")){
        myArray[0] = 12;
        myArray[1] = (type === " days min")?" hours min":" hours max";
        myArray[2] = "hours";
    }
    //console.log(myArray);
    return myArray;
}
</script>
<script src="<?php echo base_url('theme/front/assests/js/jquery-3.1.1.slim.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('theme/front/assests/js/btnswitch.js')?>" type="text/javascript"></script>
<script type="text/javascript">
    jQuery.noConflict();
    (function( $ ) {
      $(function() {
        // More code using $ as alias to jQuery
        $('#a').btnSwitch({
            OnValue: "Yes",
            OffValue: "No",
            ToggleState: $("#ageRequirements").val(),
            HiddenInputId: "ageRequirements",
            OnCallback: function(val) {
                //alert('system is now on');
                $(".age-req").toggle();
                $("input[name='ageLimit']").prop("disabled", false);
                submit_rule_form();
            },
            OffCallback: function (val) {
                //alert('system is now off');
                $(".age-req").toggle();
                //$("input[name='ageLimit']").val("");
                $("input[name='ageLimit']").prop("disabled", true);
                submit_rule_form();
            }
        });
        $('#b').btnSwitch({
            OnValue: "Yes",
            OffValue: "No",
            ToggleState: $("#displayLicence").val(),
            HiddenInputId: "displayLicence",
            OnCallback: function(val) {
                submit_rule_form();
            },
            OffCallback: function (val) {
                submit_rule_form();
            }
        });
        $('#c').btnSwitch({
            OnValue: "Yes",
            OffValue: "No",
            ToggleState: $("#suitablePets").val(),
            HiddenInputId: "suitablePets",
            OnCallback: function(val) {
                submit_rule_form();
            },
            OffCallback: function (val) {
                submit_rule_form();
            }
        });
        $('#d').btnSwitch({
            OnValue: "Yes",
            OffValue: "No",
            ToggleState: $("#eventPartiesAllowed").val(),
            HiddenInputId: "eventPartiesAllowed",
            OnCallback: function(val) {
                submit_rule_form();
            },
            OffCallback: function (val) {
                submit_rule_form();
            }
        });
      });
    })(jQuery);
</script>
<?php $this->load->view('frontend/include/user-footer'); ?>