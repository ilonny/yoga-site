$(document).ready(function()
{
    $(".reviews-form").on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/categories/save-review',
            data: formData,
            success: function (data) {
                $(".help-block").html(data)
            },
            error: function(data){
                console.log('возникла ошибка ', data)
            }
        })
    });

});/*КОНЕЦ*/
    
