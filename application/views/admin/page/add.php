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
                <div class="col-sm-12">
                    <div class="card-box">
                        <form class="form-horizontal" role="form"  name="add_page" id="add_page" method="post" action="<?= base_url(ADMIN_DIR . '/pages/add_page/'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="caption" class="col-sm-3 control-label">Page Name</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="About Us" name="pageName" class="form-control" id="pageName" value=""> 
                                    <p>Minimum 5 Characters and Maximum 50 Characters</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-3 control-label">Page Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pageTitle" id="pageTitle" class="form-control" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Page Content</label>
                                <div class="col-sm-9">
                                    <textarea class="summernote" id="" name="pageContent"></textarea>
                                    <p class="pageContentError"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Meta Keywords</label>
                                <div class="col-sm-9">
                                    <textarea id="metaKeywords" name="metaKeywords" class="form-control"></textarea>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Meta Description</label>
                                <div class="col-sm-9">
                                    <textarea id="metaDescription" name="metaDescription" class="form-control"></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="url" class="col-sm-3 control-label">Meta Author</label>
                                <div class="col-sm-9">
                                    <input type="text" name="metaAuthor" id="metaAuthor" class="form-control" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-sm-3 control-label">Featured Image</label>
                                <div class="col-sm-9">
                                    <input type="file" id="featuredImage" name="featuredImage">
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
    <script type="text/javascript">
        $(document).ready(function () {
            if ($("#pageContent").length > 0) {
                tinymce.init({
                    selector: "textarea#pageContent",
                    theme: "modern",
                    height: 300,
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
        $(document).ready(function (e) {

            var validator = $("#add_page").submit(function () {
                // update underlying textarea before submit validation
                tinymce.triggerSave();
                $("#pageContent").valid();
            }).validate({
                ignore: "",
                rules: {
                    pageName: {required: true,
                        remote: {
                            url: "<?= base_url(ADMIN_DIR . '/pages/check_exist_page_name'); ?>",
                            type: "post"
                        }
                    },
                    pageTitle: {required: true},
                    metaDescription: {required: true},
                    metaKeywords: {required: true},
                    metaAuthor: {required: true},
                    pageContent: {required: true},
                    featuredImage: {accept: "image/jpg,image/jpeg,image/png,image/gif", fileSize: true},
                    status: {required: true}
                },
                messages: {
                    pageName: {required: "<?php echo "Please Enter The Page Name"; ?>", remote: "This Page Name Is Already Taken, Please Try With Another Name"},
                    pageTitle: {required: "<?php echo "Please Enter The Page Title"; ?>"},
                    metaDescription: {required: "Please Enter The Meta Description"},
                    metaKeywords: {required: "Please Enter The Meta Keywords"},
                    metaAuthor: {required: "Please Enter The Meta Author"},
                    pageContent: {required: "Please Enter The Page Content"},
                    featuredImage: {
                        accept: "Please Upload JPG,JPEG,PNG,GIF Image Type"
                    },
                    status: {required: "Please Select Page Status"}
                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "pageContent")
                    {
                        error.appendTo('.pageContentError');
                    } else if (element.attr("name") == "featuredError") {
                        error.appendTo('.avatarError');
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>