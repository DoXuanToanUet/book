(function($) {
    $(document).ready(function() {
        
        $('#my-book').DataTable();

        $("#btn-upload").on("click",function(){
           var image = wp.media({
               title: "Upload image for my book" ,
               mulitple:false 
           }).open().on("select",function(){
               var upload_image = image.state().get("selection").first();
               var get_image= upload_image.toJSON().url;
               $("#show-image").html(`<img src="${get_image}" style="height:100px; width:100px;object-fit:cover"/>`);
               $("#image_name").val(get_image);
               $("#editimage_name").val(get_image);
           })
        })
        // $("#formAddBook").validate();
        // $("#formEditBook").validate();
      
        $('#formAddBook').submit(function(e){
            e.preventDefault();
           
            var name = $('#formAddBook #name').val();
            var author = $('#formAddBook #book-author').val();
            var category = $('#formAddBook #book-cat').val();
            var about = $('#formAddBook #about').val();
            var book_image = $("#formAddBook #image_name").val();
            var book_link = $("#formAddBook #book-link").val();
            // console.log(name);
            // console.log(author);
            // console.log(category);
            // console.log(about);
            // console.log(book_image);
            $.ajax({
                type : "post", //Phương thức truyền post hoặc get
                dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
                url :ajax_url, 
                data: {
                    param : 'save_book',
                    action: "book_add",
                    author:author,
                    name:name,
                    about:about,
                    book_image: book_image,
                    category: category,
                    link:book_link
                },
                success:function(res){
                   var  data= res.data;

                    if( data.status == 1){
                        $('.bookadd_alert').show();
                        $('.bookadd_alert_content').text(data.message);
                        setTimeout(function(){
                            $('.bookadd_alert').hide();
                        },1000)
                        $('#formAddBook #name,#formAddBook #book-author,#formAddBook #about,#formAddBook #image_name,#formAddBook #book-cat').val('');
                        $('#show-image').hide();
                    }
                    
                }
            })

        })

        $('#formEditBook').submit(function(e){

            console.log("form edit");
            e.preventDefault();
            var name = $('#editname').val();
            var author = $('#editauthor').val();
            var about = $('#editabout').val();
            var book_image = $("#editimage_name").val();
            var category_id = $('#formEditBook #book-cat').val();
            var link = $('#formEditBook #book-link').val();
            $.ajax({
                type : "post", //Phương thức truyền post hoặc get
                dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
                url :ajax_url, 
                data: {
                    // param : 'edit_book',
                    action: "book_edit",
                    book_id: book_id,
                    editauthor:author,
                    editname:name,
                    editabout:about,
                    editbook_image: book_image,
                    category_id:category_id,
                    link:link
                },
                success:function(res){
                    // console.log(res);
                   var  data= res.data;

                    if( data.status == 1){
                        $('.bookadd_alert').show();
                        $('.bookadd_alert_content').text(data.message);
                        setTimeout(function(){
                            $('.bookadd_alert').hide();
                        },1000)
                    }
                    
                }
            })

        })
        var ajax_url = $("input[name='url_ajax']").val();
        var book_id = $("input[name='book_id']").val();
    
        $('#formCatEdit').submit(function(e){

            // console.log("form edit");
            e.preventDefault();
            var name = $('#editname').val();
            var catid = $("input[name='cat_id']").val()
            $.ajax({
                type : "post", //Phương thức truyền post hoặc get
                dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
                url :ajax_url, 
                data: {
                    // param : 'edit_book',
                    action: "cat_edit",
                    editname:name,
                    catid:catid
                },
                success:function(res){
                    // console.log(res);
                   var  data= res.data;

                    if( data.status == 1){
                        $('.bookadd_alert').show();
                        $('.bookadd_alert_content').text(data.message);
                        setTimeout(function(){
                            $('.bookadd_alert').hide();
                        },1000)
                    }
                    
                }
            })

        })

        // delete table
        // $(document).on("click",".btnbookdelete",function(){
        //     // var delete_id = $(this).attr('data-id');
        //     // alert(delete_id);
        //     console.log("del");
        // })
        $('.btnbookdelete').each(function(){
            $(this).click(function(){
                 var conf = confirm("Are you sure want to delete?");
                 if (conf){
                    var delete_id = $(this).attr('data-id');
                    $.ajax({
                       type : "post", //Phương thức truyền post hoặc get
                       dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
                       url :ajax_url, 
                       data: {
                           // param : 'edit_book',
                           action: "book_del",
                           delete_id: delete_id,
                       },
                       success:function(res){
                           // console.log(res);
                          var  data= res.data;
       
                           if( data.status == 1){
                               $('.bookadd_alert').show();
                               $('.bookadd_alert_content').text(data.message);
                               setTimeout(function(){
                                   $('.bookadd_alert').hide();
                               },1000)
                           }
                       }
                   })
                   setTimeout(function(){
                       location.reload();
                   },2000)
                 }
               
            })
        })
       
        // author ajax 
        $("#formAddCategory").validate({
            submitHandler: function(form) {
                var name = $('#formAddCategory #name').val();
                // var fb_link = $('#formAddAuthor #fb_link').val();
                // var about = $('#formAddAuthor #about').val();
    
                $.ajax({
                    type : "post", //Phương thức truyền post hoặc get
                    dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
                    url :ajax_url,
                    context: this, 
                    data: {
                        action: "cat_myadd",
                        Aname:name,
                        // Afb_link:fb_link,
                        // Aabout:about
                    },
                    success:function(res){
                        console.log(res);
                        var  data= res.data;
    
                        if( data.status == 1){
                            $('.bookadd_alert').show();
                            $('.bookadd_alert_content').text(data.message);
                            setTimeout(function(){
                                $('.bookadd_alert').hide();
                            },1000)
                            $('#formAddCategory #name').val('');
                        }
                        
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        //Làm gì đó khi có lỗi xảy ra
                        console.log( 'The following error occured: ' + textStatus, errorThrown );
                    }
                })
            }    
        });
        

        // student ajax
        $("#formAddStudent").validate({
            submitHandler: function(form) {
                var name = $('#formAddStudent #name').val();
                var email = $('#formAddStudent #email').val();
                var username = $('#formAddStudent #username').val();
                var psw = $('#formAddStudent #password').val();
                var conf_psw = $('#formAddStudent #conf_password').val();
    
                $.ajax({
                    type : "post", //Phương thức truyền post hoặc get
                    dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
                    url :ajax_url,
                    context: this, 
                    data: {
                        action: "student_myadd",
                        student_name:name,
                        student_email:email,
                        student_username:username,
                        student_psw:psw,
                        student_conf_psw:conf_psw

                    },
                    success:function(res){
                        console.log(res);
                        var  data= res.data;
    
                        if( data.status == 1){
                            $('.bookadd_alert').show();
                            $('.bookadd_alert_content').text(data.message);
                            setTimeout(function(){
                                $('.bookadd_alert').hide();
                            },1000)
                        }
                        
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        //Làm gì đó khi có lỗi xảy ra
                        console.log( 'The following error occured: ' + textStatus, errorThrown );
                    }
                })
            }    
        });

        $(document).on('click','.pagination .page-link',function (e){
            e.preventDefault();
            console.log("object");
            var number = $(this).data("number");
            console.log( number );
            $.ajax({
                type: "post",
                dataType: "json",
                async: true,
                url: ajax_url,
                data: {
                    action:'bookajax',
                    number: number,
                    // pass: pass,
                },
                beforeSend: function () {
                },
                success: function (response) {
                    console.log(response);
                    $('.book-page .row').html(response.data)
                    // $('html, body').animate({
                    //     scrollTop: $(".book-page .container").offset().top
                    // }, 1000);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //Làm gì đó khi có lỗi xảy ra
                    console.log('The following error occured: ' + textStatus, errorThrown);
                }
            })
        })
    });

})( jQuery );