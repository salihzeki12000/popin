$(document).ready(function () {

    // enable fileuploader plugin
    $('input[name="files"]').fileuploader({
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
        changeInput: '<div class="fileuploader-input">' +
                '<div class="fileuploader-input-inner">' +
                '<img src="../theme/front/assests/img/fileuploader-dragdrop-icon.png">' +
                '<div class="btn-red"><span>Upload Photos</span></div>' +
                '<p class="drag">or drag them in</p>' +
                '</div>' +
                '</div>',
        theme: 'dragdrop',
        upload: {
            url: 'ajax_upload_file',
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: null,
            onSuccess: function (result, item) {
                var data = JSON.parse(result);

                // if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
                }

                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings);
                    }

                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    // go out from success function by calling onError function
                    // in this case we have a animation there
                    // you can also response in PHP with 404
                    return this.onError ? this.onError(item) : null;
                }

                item.html.find('.column-actions').append('<a class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Remove"><i></i></a>');
                setTimeout(function () {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function (item) {
                var progressBar = item.html.find('.progress-bar2');

                if (progressBar.length > 0) {
                    progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                    item.html.find('.progress-bar2').fadeOut(400);
                }

                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                        '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                        ) : null;
            },
            onProgress: function (data, item) {
                var progressBar = item.html.find('.progress-bar2');

                if (progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
        onRemove: function (item) {
            $.post('ajax_remove_file', {
                file: item.name
            });
        },
        captions: {
            feedback: 'Drag and drop files here',
            feedback2: 'Drag and drop files here',
            drop: 'Drag and drop files here'
        },
        // Callback fired after selecting and processing of all files
        afterSelect: function (listEl, parentEl, newInputEl, inputEl) {
            // callback will go here
            $("#skip-gallery").hide();
            $("#save-gallery").show();
        },
        // Callback fired when fileuploader has no files
        onEmpty: function (listEl, parentEl, newInputEl, inputEl) {
            // callback will go here
            $("#skip-gallery").show();
            $("#save-gallery").hide();
        },
    });

});