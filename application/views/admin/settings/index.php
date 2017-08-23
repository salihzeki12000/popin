<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <?php if ($message_notification = $this->session->flashdata('message_notification')) { ?>
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

                <div class="card-box">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#general" data-toggle="tab" aria-expanded="true">
                                <span class="hidden-xs"><i class="fa fa-home"></i> General</span>
                            </a>
                        </li>
                        <li>
                            <a href="#contact" data-toggle="tab" aria-expanded="false">
                                <span class="hidden-xs"><i class="fa fa-globe"></i> Contact Details</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#emails" data-toggle="tab" aria-expanded="false">
                                <span class="hidden-xs"><i class="fa fa-envelope-o"></i> Emails</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#socials" data-toggle="tab" aria-expanded="false">
                                <span class="hidden-xs"><i class="fa fa-gear"></i> Social</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            <form class="form-horizontal" role="form"  name="general_settings" id="general_settings" method="post" action="<?= base_url(ADMIN_DIR . '/settings/general_settings/'); ?>" enctype="multipart/form-data">


                                <div class="form-group">
                                    <label for="siteName" class="col-sm-3 control-label">Site Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Popin" name="siteName" class="form-control" id="siteName" value="<?= $settings->siteName; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="siteTitle" class="col-sm-3 control-label">Site Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Popin" name="siteTitle" class="form-control" id="siteTitle" value="<?= $settings->siteTitle; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="metaKeyWords" class="col-sm-3 control-label">Meta Keywords</label>
                                    <div class="col-sm-9">
                                        <textarea name="metaKeyWords" class="form-control" id="metaKeyWords"><?= $settings->metaKeyWords; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="metaDescription" class="col-sm-3 control-label">Meta Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="metaDescription" class="form-control" id="metaDescription"><?= $settings->metaDescription; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metaAuthor" class="col-sm-3 control-label">Meta Author</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Popin" name="metaAuthor" class="form-control" id="metaAuthor" value="<?= $settings->metaAuthor; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="logo" class="col-sm-3 control-label">Logo</label>
                                    <div class="col-sm-9">
                                        <?= ($settings->logo != '') ? '<img src="' . base_url('uploads/site/' . $settings->logo) . '" height="100" width="100" alt="' . $settings->siteName . '"><br><br>' : ''; ?>
                                        <input type="file"  name="logo"  id="logo" value="">
                                        <p class="help-block logoError"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="favicon" class="col-sm-3 control-label">Favicon</label>
                                    <div class="col-sm-9">
                                        <?= ($settings->favicon != '') ? '<img src="' . base_url('uploads/site/' . $settings->favicon) . '" height="100" width="100" alt="' . $settings->siteName . '"><br><br>' : ''; ?>
                                        <input type="file"  name="favicon"  id="favicon" value="">
                                        <p class="help-block faviconError"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="siteEmail" class="col-sm-3 control-label">Site Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="abc.xyz@gmail.com" name="siteEmail" class="form-control" id="siteEmail" value="<?= $settings->siteEmail; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="siteNumber" class="col-sm-3 control-label">Site Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="(+1)123-456-7890" name="siteNumber" class="form-control" id="siteNumber" value="<?= $settings->siteNumber; ?>">
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="hidden" name="oldLogo" id="oldLogo" value="<?= $settings->logo ?>">
                                        <input type="hidden" name="oldFavicon" id="oldFavicon" value="<?= $settings->favicon ?>">
                                        <button type="submit" class="btn btn-info waves-effect waves-light" id="general_submit" name="general_submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="contact">
                            <form class="form-horizontal" role="form"  name="contact_settings" id="contact_settings" method="post" action="<?= base_url(ADMIN_DIR . '/settings/contact_settings/'); ?>" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="contactAddress" class="col-sm-3 control-label">Contact Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="contactAddress" class="form-control" id="contactAddress"><?= $settings->contactAddress; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contactEmail" class="col-sm-3 control-label">Contact Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="info@yoursitename.com" name="contactEmail" class="form-control" id="contactEmail" value="<?= $settings->contactEmail; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contactNumber" class="col-sm-3 control-label">Contact Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="(+1)123-456-7890" name="contactNumber" class="form-control" id="contactNumber" value="<?= $settings->contactNumber; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="longitude" class="col-sm-3 control-label">Longitude</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Longitude" name="longitude" class="form-control" id="longitude" value="<?= $settings->longitude; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="latitude" class="col-sm-3 control-label">Latitude</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Latitude" name="latitude" class="form-control" id="latitude" value="<?= $settings->latitude; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-info waves-effect waves-light" id="contact_submit" name="contact_submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="emails">
                            <form class="form-horizontal" role="form"  name="emails_settings" id="emails_settings" method="post" action="<?= base_url(ADMIN_DIR . '/settings/emails_settings/'); ?>" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="signature" class="col-sm-3 control-label">Email Signature</label>
                                    <div class="col-sm-9">
                                        <textarea id="emailSignature" name="emailSignature"><?= $settings->emailSignature; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="supportEmail" class="col-sm-3 control-label">Support Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="abc.xyz@gmail.com" name="supportEmail" class="form-control" id="supportEmail" value="<?= $settings->supportEmail; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="careerEmail" class="col-sm-3 control-label">Career Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="abc.xyz@gmail.com" name="careerEmail" class="form-control" id="careerEmail" value="<?= $settings->careerEmail; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="fromEmail" class="col-sm-3 control-label">From Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="abc.xyz@gmail.com" name="fromEmail" class="form-control" id="fromEmail" value="<?= $settings->fromEmail; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="replyEmail" class="col-sm-3 control-label">Reply Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="abc.xyz@gmail.com" name="replyEmail" class="form-control" id="replyEmail" value="<?= $settings->replyEmail; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="noReplyEmail" class="col-sm-3 control-label">No-Reply Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="abc.xyz@gmail.com" name="noReplyEmail" class="form-control" id="noReplyEmail" value="<?= $settings->noReplyEmail; ?>">
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-info waves-effect waves-light" id="emails_submit" name="emails_submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="socials">
                            <form class="form-horizontal" role="form"  name="social_settings" id="social_settings" method="post" action="<?= base_url(ADMIN_DIR . '/settings/social_settings/'); ?>" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="facebookLink" class="col-sm-3 control-label">Facebook Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="https://www.facebook.com/<?= SITE_DISPNAME; ?>" name="facebookLink" class="form-control" id="facebookLink" value="<?= $settings->facebookLink; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="instagramLink" class="col-sm-3 control-label">Instagram Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="https://www.instagram.com/<?= SITE_DISPNAME; ?>" name="instagramLink" class="form-control" id="instagramLink" value="<?= $settings->instagramLink; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="twitterLink" class="col-sm-3 control-label">Twitter Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="https://www.twitter.com/<?= SITE_DISPNAME; ?>" name="twitterLink" class="form-control" id="twitterLink" value="<?= $settings->twitterLink; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="linkedInLink" class="col-sm-3 control-label">LinkedIn Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="https://www.linkedin.com/<?= SITE_DISPNAME; ?>" name="linkedInLink" class="form-control" id="linkedInLink" value="<?= $settings->linkedInLink; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="googlePlusLink" class="col-sm-3 control-label">Google Plus Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="https://plus.google.com/<?= SITE_DISPNAME ?>" name="googlePlusLink" class="form-control" id="googlePlusLink" value="<?= $settings->googlePlusLink; ?>">
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-info waves-effect waves-light" id="contact_submit" name="contact_submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDx2JMX91vY411oEI6jv4T34fpWeUdBRAI" type="text/javascript"></script>
    <script type="text/javascript">
        getGeoCoordinates($("#contactAddress").val());
        $(document).on("change", "#contactAddress", function(){
            getGeoCoordinates($(this).val());
        })
        function getGeoCoordinates(full_address){
            if(full_address.trim() != ""){
                geocoder = new google.maps.Geocoder();

                geocoder.geocode( { 'address': full_address }, function(results, status) {
                    // log out results from geocoding
                    console.log(results);
                    if (status == google.maps.GeocoderStatus.OK) {
                        
                        var latitude = parseFloat(results[0].geometry.location.lat());
                        var longitude = parseFloat(results[0].geometry.location.lng());

                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;
                    }
                });
            }
        }
        $(document).ready(function () {
        if ($("#emailSignature").length > 0){
        tinymce.init({
        selector: "textarea#emailSignature",
                theme: "modern",
                height:300,
                plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
        });
        }
        });
    </script>		
    <script>
        $(document).ready(function(e) {
        $('#general_settings').validate({
        ignore: [],
                rules: {
                siteName : { required:true},
                        siteTitle :{required:true},
                        metaKeyWords : {required:true},
                        metaDescription : {required:true},
                        metaAuthor : {required:true},
                        logo : {
<?php if ($settings->logo == '') { ?>
                            required : true,
<?php } ?>
                        accept	:	"jpg|png|jpeg|gif",
                                fileSize : true
                        },
                        favicon : {
<?php if ($settings->favicon == '') { ?>
                            required : true,
<?php } ?>
                        fileSize : true
                        },
                        siteEmail : {email:true}
                },
                messages : {
                siteName:{required:"<?php echo "Please Enter The Site Name"; ?>"},
                        setTitle : {required:"Please Enter The Site Title"},
                        metaKeyWords : {required:"Please Enter The Meta KeyWords"},
                        metaDescription : { required:"Please Enter The Meta Description"},
                        metaAuthor : {required:"Please Enter Meta Author"},
                        logo : {
<?php if ($settings->logo == '') { ?>
                            required : "Please Upload Site Logo",
<?php } ?>
                        accept : "Allowed Image Types Are JPG, PNG, JPEG, GIF",
                                fileSize : true
                        },
                        favicon : {
<?php if ($settings->favicon == '') { ?>
                            required : "Please Upload Site Favicon",
<?php } ?>
                        fileSize : true
                        },
                        siteEmail : {email : "Please Enter Valid Email Address" }
                },
                errorPlacement: function(error, element) {
                if (element.attr("name") == "logo") {
                error.appendTo('.logoError');
                }
                else if (element.attr("name") == "favicon") {
                error.appendTo('.faviconError');
                }
                else {
                error.insertAfter(element);
                }
                }
        });
        $('#contact_settings').validate({
        ignore: [],
                rules: {
                contactAddress : { required:true},
                        contactEmail :{required:true, email:true},
                        contactNumber : {required:true},
//                        longitude : {required:true},
//                        latitude : {required:true}
                },
                messages : {
                contactAddress : { required:"Please Enter Contact Address"},
                        contactEmail :{required:"Please Enter Contact Email Address", email:"Please Enter Valid Email Address"},
                        contactNumber : {required:"Please Enter Contact Number"},
                        longitude : {required:"Please Enter Longitude"},
                        latitude : {required:"Please Enter Latitude"}
                }
        });
        $('#social_settings').validate({
        ignore: [],
                rules: {
                facebookLink : { url:true},
                        instagramLink :{url:true},
                        twitterLink : {url:true},
                        googlePlusLink : {url:true},
                        linkedInLink : {url:true}
                },
                messages : {
                facebookLink : { url:"Please Enter Valid Facebook Page Link"},
                        instagramLink :{url:"Please Enter Valid Instagram Page Link"},
                        twitterLink : {url:"Please Enter Valid Twitter Page Link"},
                        googlePlusLink : {url:"Please Enter Valid Google Plus Link"},
                        linkedInLink : {url:"Please Enter Valid LinkedIn Link"}
                }
        });
        var validator = $("#emails_settings").submit(function() {
        // update underlying textarea before submit validation
        tinymce.triggerSave();
        $("#emailSignature").valid();
        }).validate({
        ignore: [],
                rules: {
                supportEmail :{email:true},
                        careerEmail : {email:true},
                        fromEmail : {email:true},
                        replyEmail : {email:true},
                        noReplyEmail : {email:true},
                        emailSignature : {required:true}
                },
                messages : {
                supportEmail :{email:"Please Enter Valid Email Address"},
                        careerEmail : {email:"Please Enter Valid Email Address"},
                        fromEmail : {email:"Please Enter Valid Email Address"},
                        replyEmail : {email:"Please Enter Valid Email Address"},
                        noReplyEmail : {email:"Please Enter Valid Email Address"},
                        emailSignature : {required:"Please Enter Email Signature"}

                }
        });
        });
    </script>