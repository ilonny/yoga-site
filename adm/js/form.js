tinymce.init({
    selector: ".tiny-editor",
    // fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt",
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px 48px 56px 72px",
    language: "ru",
    language_url: '/adm/vendor/tiny_mce/language/ru.js',
    theme: "modern",
    height: 300,
    browser_spellcheck:true,
    gecko_spellcheck: false,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textcolor colorpicker textpattern imagetools spellchecker"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic  fontsizeselect | alignleft aligncenter alignright alignjustify customformat | bullist numlist outdent indent",
    toolbar2: "forecolor backcolor",
    relative_urls: false,
});

$(".image-uploader").imageUploader();
$('.gallery-uploader').galleryUploader();
function deleteImage(_this){
    $(_this).parent().remove();
}

jQuery.datetimepicker.setLocale('ru');
$('.datetimepicker').datetimepicker({
    scrollInput: false,
    format: 'd.m.Y H:i:s'
});
$('.datepicker').datetimepicker({
    timepicker: false,
    scrollInput: false,
    format: 'Y-m-d',
});
$('.timepicker').datetimepicker({
    format: 'H:i',
    datepicker: false,
    step: 15,
});