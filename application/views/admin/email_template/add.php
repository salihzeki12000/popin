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
                        <form class="form-horizontal" role="form" name="add_email" id="add_email" method="post" action="<?= base_url(ADMIN_DIR . '/email_template/add_email/'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="caption" class="col-sm-3 control-label">Email Type</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="user-register" name="emailType" class="form-control" id="emailType" value=""> 

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-3 control-label">Subject</label>
                                <div class="col-sm-9">
                                    <input type="text" name="subject" id="subject" class="form-control" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Email Content</label>
                                <div class="col-sm-9">
                                    <textarea id="" name="content" class="summernote"></textarea>
                                    <p class="contentError"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Email Note</label>
                                <div class="col-sm-9">
                                    <textarea id="note" name="note" class="form-control"></textarea>

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
            if ($("#content").length > 0) {
                tinymce.init({
                    selector: "textarea#content",
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

            var validator = $("#add_email").submit(function () {
                // update underlying textarea before submit validation
                tinymce.triggerSave();
                $("#content").valid();
            }).validate({
                ignore: "",
                rules: {
                    emailType: {required: true,
                        remote: {
                            url: "<?= base_url(ADMIN_DIR . '/email_template/check_exist_email_subject'); ?>",
                            type: "post"
                        }},
                    subject: {required: true},
                    note: {required: true},
                    content: {
                        required: true
                    },
                    status: {required: true}
                },
                messages: {
                    emailType: {required: "<?php echo "Please Enter The Email Type"; ?>", remote: "This Email Type Subject Is Already Taken, Please Try With Another Type"},
                    subject: {required: "<?php echo "Please Enter The Email Subject"; ?>"},
                    note: {required: "<?php echo "Please Enter The Email Note"; ?>"},
                    content: {required: "Please Enter The Email Content"},
                    status: {required: "Please Select Email Status"}
                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") == 'content') {
                        error.appendTo('.contentError');
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>