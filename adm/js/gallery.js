$('.get-fields').on('change', function () {
    var _this = $(this);
    $(_this.data('dependent-selector')).html('').change();
   $.ajax({
       url: '/adm/install/gallery/get-fields',
       data: {
           table: _this.val()
       },
       dataType: 'json',
       type: 'get',
       success: function (data) {
           var items = '';
           $.each(data, function (index, value) {
              items += "<option value=\""+ index +"\">"+ index +"</option>\n"
           });
           $(_this.data('dependent-selector')).html(items);
       }
   })
});
