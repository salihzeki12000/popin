$(document).ready(function () {
    // enable fileuploader plugin
    $('input[name="files"]').fileuploader({
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
        changeInput: ' ',
        theme: 'thumbnails',
        enableApi: true,
        addMore: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                    '<ul class="fileuploader-items-list">' +
                    '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner">+</div></li>' +
                    '</ul>' +
                    '</div>',
            item: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="thumbnail-holder">${image}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                    '</div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',
            item2: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="thumbnail-holder">${image}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                    '</div>' +
                    '</div>' +
                    '</li>',
            startImageRenderer: false,
            canvasImage: false,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove'
            },
            onItemShow: function (item, listEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input');

                plusInput.insertAfter(item.html);

                if (item.format == 'image') {
                    item.html.find('.fileuploader-item-icon').hide();
                }
            }
        },
        afterRender: function (listEl, parentEl, newInputEl, inputEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = $.fileuploader.getInstance(inputEl.get(0));

            plusInput.on('click', function () {
                api.open();
            });
        },
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
                setTimeout(function () {
                    item.html.find('.progress-holder').hide();
                    item.renderImage();
                }, 400);
            },
            onError: function (item) {

                item.html.find('.progress-holder').hide();
                item.html.find('.fileuploader-item-icon i').text('Failed!');
            },
            onProgress: function (data, item) {
                var progressBar = item.html.find('.progress-holder');

                if (progressBar.length > 0) {
                    progressBar.show();
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
        }
    });

});