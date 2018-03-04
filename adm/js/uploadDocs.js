$(document).ready(function () {

    $("input[name='DynamicModel[path]']").on("focus", function () {
        console.log('fds')
        $(this).blur();
    })

    $(".input-doc__input").on("change", function () {
        $(".input-doc__label span").html(this.files[0].name)
        $(".input-doc__label .message").html("Загрузка файла..")
        $(".submit-form").attr("disabled", true);
        file = new FormData();
        file.append('file', $('.input-doc__input')[0].files[0]);
        console.log(file)
        $.ajax({
            type: "POST",
            url: "/adm/tools/doc",
            processData: false,
            contentType: false,
            data: file,
            success: function (file_url) {
                $("input[name='DynamicModel[path]']").val(file_url)
                $(".input-doc__label .message").html("Файл загружен, теперь можно нажать \"Сохранить\"")
                $(".submit-form").attr("disabled", false);
            }
        })
    })
});