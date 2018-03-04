/**
 * Плагин для загрузки изображения через ajax
 */
(function ($) {
    $.fn.galleryUploader = function () {
        return this.each(function () {
            var _this = $(this);
            var sendAjax = function (gallery, index) {
                if (gallery.length > index) {
                    var gallery_item = gallery[index];
                    return $.ajax({
                        type: 'POST',
                        url: gallery_item.url,
                        data: gallery_item.form_data,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            gallery_item.image.attr('src', data.preview);
                            gallery_item.input.val(data.filename);
                        },
                        error: function(data) {
                        },
                        complete: function () {
                            sendAjax(gallery, ++index);
                        }
                    });
                }
            };

            _this.on('change', function(){
                if (_this[0].files) {
                    var gallery = [];
                    for (var i = 0; i < _this[0].files.length; i++) {
                        var form_data = new FormData();
                        form_data.append('image_files', _this[0].files[i]);
                        var galleryBlock  = {
                            url : $(this).data('upload-url'),
                            form_data: form_data,
                            liBlock : $('<li class="gallery"></li>'),
                            image : $('<img class="imgMain" src="/adm/images/preloader.gif"/>'),
                            input : $('<input type="hidden" name="images[]"/>'),
                            deleteButton : $( '<div class="deleteImage"></div>').append('<img src="/adm/images/delete_button.png" alt=""/>'),
                            func : function(liBlock, deleteButton) {
                                deleteButton.on('click', function () {
                                    liBlock.remove();
                                });
                            }
                        };
                        galleryBlock.func(galleryBlock.liBlock, galleryBlock.deleteButton);
                        galleryBlock.liBlock.append(galleryBlock.image).append(galleryBlock.input).append(galleryBlock.deleteButton);
                        gallery.push(galleryBlock);
                        // sendAjax(galleryBlock.image, $input, $(this).data('upload-url'), form_data);
                        $('.img_block').append(galleryBlock.liBlock);
                    }
                    sendAjax(gallery, 0);
                }
            });
        });
    };
})(jQuery);