function deleteImage(i){
    //$('#smi0'+i).remove();
    var inputAction = $('#smi0'+i).find('.actionImage').val('delete');
    $('#smi0'+i).hide();

}
function uploadPosters(params) {
    var processingImages = params.imagesCount;
    var commonImages = params.imagesCount;
    var currentImage = commonImages;
    function sendFile(i){
        if (i==0) {
            params.fileInput.val("");
            return 0;
        }
        i--;
        var fd = new FormData();
        fd.append('id', '123');
        fd.append('type', 'one');
        fd.append('image_files', params.fileInput[0].files[i]);
        $.ajax({
                  type: 'POST',
                  url: params.url,
                  data: fd,
                  processData: false,
                  contentType: false,
                  dataType: "json",
                  success: function(data) {
                    $('#thumb'+processingImages).attr('src', data.preview);
                    $('#imgHolder'+processingImages).val(data.filename);
                    processingImages++;

                    sendFile(i);
                  },
                  error: function(data) {
                     sendFile(i);
                  }
                });
        delete fd;
    }
    function readURL() {
        if (params.fileInput[0].files) {
            for (var i = 0; i < params.fileInput[0].files.length; i++) {
                //if (commonImages>=30) continue;
                var dom =
                    '<li id="smi0'+currentImage+'" class="gallery">'
                        +'<div class="rotateBlock">'
                            +'<img class="rotateImage" data-direction="left" src="/img/rotate_left.png" alt="">'
                            +'<img class="rotateImage" data-direction="right"  src="/img/rotate_right.png" alt="">'
                        +'</div>'
                        +'<input type="hidden" class="imgUrl" id="imgHolder'+currentImage+'" value="" name="images['+currentImage+'][url]" />'
                        +'<input type="hidden" value="new" name="images['+currentImage+'][action]" />'
                        +'<input type="hidden" class="imgPosition" value="'+currentImage+'" name="images['+currentImage+'][position]" />'
                        +'<img class="imgMain" id="thumb'+currentImage+'" src="/img/loading.gif" />'
                        +'<div class="uploadedImageInfo">'
                            +'<span>'
                                +'<label for="">Опубликован:</label>'
                                +'<input type="hidden" value="0" name="images['+currentImage+'][published]">'
                                +'<input type="checkbox" value="1" name="images['+currentImage+'][published]" class="published_checkbox">'
                            +'</span>'
                            +'<a class="deleteImage" href="#" onclick="deleteImage('+currentImage+'); return false;">'
                                +'<img src="/img/deleteButton.png" alt="">'
                            +'</a>'
                        +'</div>'
                    +'</li>';
                $('.img_block').append(dom);
                commonImages++;
                currentImage++;
            }

            sendFile(params.fileInput[0].files.length);
        }
    }
    params.fileInput.on('change', function(){
         readURL();
    });
}
