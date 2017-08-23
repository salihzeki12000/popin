<?php $stepData = $this->session->userdata('stepData'); ?>
<div class="progress">
    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
</div>
<section class="middle-container new-partner6">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="space-are">
                    <h3>What kind of business space are you listing?</h3>
                    <form action="<?php echo site_url('Space/professionals'); ?>" method="post" enctype="multipart/form-data">
                        <div class="feild">
                            <label>What type of industry is this?</label>
                            <select class="selectbox custom-select" name="page1[industryType]" onchange="onchange_industry(this.value)" required>
                                <option value="" selected disabled>Select industry</option>
                                <?php foreach($industries as $industry){ ?>
                                <option value="<?= $industry['id']; ?>" <?php echo (isset($stepData['step1']['page1']['industryType']) && $stepData['step1']['page1']['industryType'] == $industry['id'])? 'selected' : ''?>><?= $industry['industry_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="feild">
                            <label>What type of establishment is this?</label>
                            <select class="selectbox custom-select" name="page1[establishmentType]" required>
                                <option value="" selected disabled>Select establishment type</option>
                                <?php foreach($establishment_types as $establishment){ if (isset($stepData['step1']['page1']['industryType'])&&$stepData['step1']['page1']['industryType'] == $establishment['industry_ID']) {?>
                                <option value="<?= $establishment['id']; ?>" <?php echo (isset($stepData['step1']['page1']['establishmentType']) && $stepData['step1']['page1']['establishmentType'] == $establishment['id'])? 'selected' : ''?>><?= $establishment['name']; ?></option>
                                <?php }}?>
                            </select>
                        </div>
                        <div class="feild">
                            <label>What type of space is this?</label>
                            <select class="selectbox custom-select" name="page1[spaceType]" required>
                                <option value="" selected disabled>Select space type</option>
                                <?php foreach($space_types as $space){ ?>
                                <option value="<?= $space['id']; ?>" <?php echo (isset($stepData['step1']['page1']['spaceType']) && $stepData['step1']['page1']['spaceType'] == $space['id'])? 'selected' : ''?>><?= $space['name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <?php if(trim($userProfileInfo->establishmentLicenceNumber) ==""): ?>
                        <div class="feild">
                            <label>Establishment License Number</label>
                            <?php $errors_3 = $this->session->flashdata('errors_3'); if(!empty($errors_3)){ ?><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?= $errors_3; ?></div><?php }?>
                            <input type="text" class="textbox" name="page1[establishmentLicence]" placeholder="Establishment License Number" value="<?php echo isset($stepData['step1']['page1']['establishmentLicence'])? $stepData['step1']['page1']['establishmentLicence'] : $userProfileInfo->establishmentLicenceNumber;?>"  required/>                            
                        </div>
                        <?php endif;?>
                        <?php //if(trim($userProfileInfo->establishmentLicence) ==""): ?>
                        <div class="feild row">   
                            <?php $errors_1 = $this->session->flashdata('errors_1'); if(!empty($errors_1)){ ?><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?= $errors_1; ?></div><?php }?>
                            <div class="col-sm-8">                                
                                <label class="btn-block">Establishment License</label>
                                <label class="btn btn-default btn-file">
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input type="file" style="display: none;" name="establishmentLicenceFile" onchange="readImageURL(this, 'establishmentLicenceFile');"> Upload Photo
                                </label>
                            </div>
                            <?php 
                            $establishmentLicenceFile = "";
                            if(isset($stepData['step1']['page1']['establishmentLicenceFile']) && !empty($stepData['step1']['page1']['establishmentLicenceFile'])):
                                $establishmentLicenceFile = base_url('uploads/user/document/'.$stepData['step1']['page1']['establishmentLicenceFile']);
                            else:
                                $establishmentLicenceFile = base_url('uploads/user/document/'.trim($userProfileInfo->establishmentLicence));
                            endif;
                            ?>
                            <div class="col-sm-4">
                                <?php
                                $establishmentLicence  = explode(".",$establishmentLicenceFile);
                                $establishmentLicenceExt = end($establishmentLicence);
                                if ($establishmentLicenceExt == 'pdf') { ?>
                                    <a target="_blank" href="<?php echo $establishmentLicenceFile; ?>" title="View Licence"><i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i></a>
                                <?php }else if ($establishmentLicenceExt == 'doc' || $establishmentLicenceExt == 'docx') { ?>
                                    <a target="_blank" href="<?php echo $establishmentLicenceFile; ?>" title="View Licence"><i class="fa fa-file-word-o fa-5x" aria-hidden="true"></i></a>
                                <?php  }else{ ?>
                                    <a target="_blank" href="<?php echo $establishmentLicenceFile; ?>" title="View Licence"><img title="View Licence" src="<?php echo $establishmentLicenceFile; ?>"></a>
                                <?php }?>
                                <img id="establishmentLicenceFile" src="" alt="establishmentLicenceFile" style="display: none;">
                            </div>
                        </div>
                        <?php //endif;?>
                        <?php //if(trim($userProfileInfo->liabilityInsurance) ==""): ?>
                        <div class="feild row">
                            <?php $errors_2 = $this->session->flashdata('errors_2'); if(!empty($errors_2)){ ?><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?= $errors_2; ?></div><?php }?>
                            <div class="col-sm-8">                                
                                <label class="btn-block">Liability Insurance</label>
                                <label class="btn btn-default btn-file">
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input type="file" style="display: none;" name="liabilityInsurance" onchange="readImageURL(this, 'liabilityInsuranceFile');"> Upload Photo
                                </label>
                            </div>
                            <?php 
                            $liabilityInsuranceFile = "";
                            if(isset($stepData['step1']['page1']['liabilityInsurance']) && !empty($stepData['step1']['page1']['liabilityInsurance'])):
                                $liabilityInsuranceFile = base_url('uploads/user/document/'.$stepData['step1']['page1']['liabilityInsurance']);
                            else:
                                $liabilityInsuranceFile = base_url('uploads/user/document/'.trim($userProfileInfo->liabilityInsurance));
                            endif;
                            ?>
                            <div class="col-sm-4">
                                <?php
                                $licenceCopy  = explode(".",$liabilityInsuranceFile);
                                $licenceCopyExt = end($licenceCopy);
                                if ($licenceCopyExt == 'pdf') { ?>
                                    <a target="_blank" href="<?php echo $liabilityInsuranceFile; ?>" title="View Licence"><i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i></a>
                                <?php }else if ($licenceCopyExt == 'doc' || $licenceCopyExt == 'docx') { ?>
                                    <a target="_blank" href="<?php echo $liabilityInsuranceFile; ?>" title="View Licence"><i class="fa fa-file-word-o fa-3x" aria-hidden="true"></i></a>
                                <?php  }else{ ?>
                                    <a target="_blank" href="<?php echo $liabilityInsuranceFile; ?>" title="View Licence"><img title="View Licence" src="<?php echo $liabilityInsuranceFile; ?>"></a>
                                <?php  } ?>
                                <img id="liabilityInsuranceFile" src="" alt="liabilityInsuranceFile" style="display: none;">
                            </div>
                        </div>
                        <?php //endif;?>
                        <div class="next-prevs clearfix">
                            <div class="pull-left">
                                <a class="gost-btn" href="<?php echo site_url('Space'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="pull-right">
                                <button class="btn-red" type="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 entire-palce">
                <div class="entire-main">
                    <img src="<?php echo base_url('theme/front/assests/img/bulb.png')?>" alt="" />
                    
                    <?php foreach($industries as $industry){ ?>
                    <span id="show1-<?= $industry['id']; ?>" class="sidebar-box-1 hidden">
                        <h5><?= $industry['industry_name']; ?></h5>
                        <p></p>
                    </span>
                    <?php }?>
                    
                    <?php foreach($establishment_types as $establishment){ ?>
                    <span id="show2-<?= $establishment['id']; ?>" class="sidebar-box-2 hidden">
                        <h5><?= $establishment['name']; ?></h5>
                        <p><?= $establishment['description']; ?></p>
                    </span>
                    <?php }?>
                    
                    <?php foreach($space_types as $space){ ?>
                    <span id="show3-<?= $space['id']; ?>" class="sidebar-box-3 hidden">
                        <h5><?= $space['name']; ?></h5>
                        <p><?= $space['description']; ?></p>
                    </span>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>    
</section>
<script>
    $(document).ready(function(){
        show_hide_sidebar(".sidebar-box-1", "#show1", $("select[name='page1[industryType]']").find("option:selected").val());
        $("select[name='page1[industryType]']").on("change", function(){
            var optionSelected = $(this).find("option:selected");
            show_hide_sidebar(".sidebar-box-1", "#show1", optionSelected.val());
        });
        
        show_hide_sidebar(".sidebar-box-2", "#show2", $("select[name='page1[establishmentType]']").find("option:selected").val());
        $("select[name='page1[establishmentType]']").on("change", function(){
            var optionSelected = $(this).find("option:selected");
            show_hide_sidebar(".sidebar-box-2", "#show2", optionSelected.val());
        });
        
        show_hide_sidebar(".sidebar-box-3", "#show3", $("select[name='page1[spaceType]']").find("option:selected").val());
        $("select[name='page1[spaceType]']").on("change", function(){
            var optionSelected = $(this).find("option:selected");
            show_hide_sidebar(".sidebar-box-3", "#show3", optionSelected.val());
        });
        
        $(':file').on('fileselect', function(event, numFiles, label) {
            console.log(numFiles);
            console.log(label);
        });
        
        $('form').validate({
            rules: {
                'page1[industryType]' :{ required:true},
                'page1[establishmentType]' : { required:true},
                'page1[spaceType]' : { required:  true },
                'page1[establishmentLicence]' : {required:true}
            },
            messages : {
                'page1[industryType]' :{ required:"Please select an industry type."},
                'page1[establishmentType]' : { required:"Please select an establishment type."},
                'page1[spaceType]' : { required:"Please select a space type."},
                'page1[establishmentLicence]' : { required:"Please enter Establishment Licence Number." }
            }
        });
    });
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    
    function show_hide_sidebar(section, target, box_id){
        $(section).addClass("hidden");
        $(target + "-" + box_id).removeClass("hidden");
    }
    function readImageURL(input, target_id) {
        if (input.files && input.files[0] && (typeof FileReader !== "undefined")) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#' + target_id)
                    .attr('src', e.target.result)
                    .fadeIn('slow');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function  onchange_industry(getID) {
        var establishment	 = '<?php echo json_encode($establishment_types);?>';
        var html = '';
        html = '<option value="" selected disabled>Select establishment type</option>';
        $.each(JSON.parse(establishment), function(idx, obj) {
            if (obj.industry_ID === getID) {
                  html += '<option value="'+obj.id+'">'+obj.name+'</option>';
            }
        });

        $("select[name='page1[establishmentType]']").html(html);
    }
</script>
</body>
</html>