(function ($) {
    $(document).ready(function(){
        $(document).on('submit', '#recruitment-form',function(e){
            e.preventDefault();
            var ajax_url = $("input[name='url_ajax']").val();
            var recruitment_cat = $("#recruitment_cat option:selected").val();
            var recruitment_area = $("#recruitment_area option:selected").val();
            var search = $("input[name='search']").val();
            $.ajax({
                type: "post",
                dataType: "json",
                async: true,
                url: ajax_url,
                data: {
                    action:'recruitmentAction',
                    recruitment_cat:recruitment_cat,
                    recruitment_area:recruitment_area,
                    search:search,
                    security:$('form #security').val()
                },
                beforeSend: function () {
                    // $('.tailor-loading').show();
                },
                success: function (response) {
                   console.log(response);
                   $('.show').html(`${response.data}`);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //Làm gì đó khi có lỗi xảy ra
                    console.log('The following error occured: ' + textStatus, errorThrown);
                }
            });
        })

    })
})(jQuery);