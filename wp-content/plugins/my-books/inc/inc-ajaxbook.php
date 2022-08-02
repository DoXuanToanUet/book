<?php 

add_action('wp_ajax_book_edit','book_edit_ajax');
function book_edit_ajax(){
    global $wpdb;
        $editauthor = (isset($_POST['editauthor'])) ? esc_attr($_POST['editauthor']) :'';
        $editname =(isset($_POST['editname']))? esc_attr($_POST['editname']) :'';
        $editabout =(isset($_POST['editabout']))? esc_attr($_POST['editabout']) :'';
        $editbook_image =(isset($_POST['editbook_image']))? esc_attr($_POST['editbook_image']) :'';
        $editbook_cat=(isset($_POST['category_id']))? esc_attr($_POST['category_id']) :'';
        $book_id = (isset($_POST['book_id']))? esc_attr($_POST['book_id']) :'';
        $link = (isset($_POST['link']))? esc_attr($_POST['link']) :'';

        $wpdb->update($wpdb->prefix."my_books",array(
            'name'=>$editname,
            'author'=> $editauthor,
            'about'=>  $editabout,
            'book_image'=>  $editbook_image,
            'category_id' => $editbook_cat,
            'link' => $link
            ),array(
                'id'=>$book_id 
            )
        );
        wp_send_json_success(array(
            "status"=> "1",
            "message"=>"Book update successfully"
        ));
        die();
}
add_action('wp_ajax_bookajax','bookajax_pagination');
function bookajax_pagination(){
    global $wpdb;
    global $user_ID;
    ob_start();
    $limit = 8;
    $all_books = $wpdb->get_results(
        // $wpdb->prepare(
            "SELECT * from ".my_book_table()." ORDER BY id DESC" 
        // )
    );  
    $total_records = count ($all_books);
    $total_page = ceil($total_records / $limit);
    $current_page = (isset($_POST['number']))? esc_attr($_POST['number']) :'';
    // var_dump ($current_page);
    $current_page = (int)$current_page;
   
    $start = ( $current_page - 1 ) * $limit;
    
    // var_dump ($start);
    $result = $wpdb->get_results(
        // $wpdb->prepare(
            "SELECT * from ".my_book_table()." ORDER BY id DESC LIMIT $start, $limit" 
        // )
    ); 
    if (count ($result) >0){
        $i=1;
        foreach($result as $key => $value){
            ?>
                <div class="col col-12 large-3 medium-6">
                    <div class="col-inner">
                        <div class="book-item rounded">
                            <div><img src="<?php echo $value->book_image;?>" alt=""></div>
                            <div class="book-content p-3">
                                <div class="book-name"><?php echo $value->name;?></div>
                                <div class="book-desc"><?php echo wp_trim_words($value->about, 20);?></div>
                                <p>Author : <?php echo $value->author;?></p>
                                <p> 
                                    <a class="btn btn-enrol btn-sm"  href = "<?php 
                                    $link = $value->link;
                                    if($user_ID >0){echo $link;}else{ echo wp_login_url();} 
                                    ?>">
                                        <?php if($user_ID >0){echo "Enroll Now";}else{echo "Login to Enrol";}?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
    ?>
        <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
      
        <nav aria-label="Page navigation example">
            <ul class="pagination">
            
    <?php
        // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
        if ($current_page > 1 && $total_page > 1){
            echo '<li class="page-item"> <a class="page-link" data-number="'.($current_page-1).'" >Prev</a> </li>';
        }
        // Lặp khoảng giữa
        for ($i = 1; $i <= $total_page; $i++){
            // Nếu là trang hiện tại thì hiển thị thẻ span
            // ngược lại hiển thị thẻ a
            if ($i == $current_page){
                echo '<li class="page-item">  <a class="page-link" data-number="'.($i).'"> <span>'.$i.'</span> </a></li>';
            }
            else{
                echo '<li class="page-item">  <a class="page-link" data-number="'.$i.'" >'.$i.'</a> </li>';
            }
        }
        // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
        if ($current_page < $total_page && $total_page > 1){
            echo '<li class="page-item"> <a class="page-link" data-number="'.($current_page+1).'" >Next</a> </li>';
        }

    $content = ob_get_clean(); 
    wp_send_json_success($content);
    die();
}

add_action('wp_ajax_cat_edit','bookcat_edit_ajax');
function bookcat_edit_ajax(){
    global $wpdb;
        
        $editname =(isset($_POST['editname']))? esc_attr($_POST['editname']) :'';
        $cat_id = (isset($_POST['catid']))? esc_attr($_POST['catid']) :'';
        $wpdb->update($wpdb->prefix."my_book_category",array(
            'name'=>$editname,
            ),array(
                'id'=>$cat_id 
            )
        );
        wp_send_json_success(array(
            "status"=> "1",
            "message"=>"Edit Book update successfully"
        ));
        die();
}
    // book del
    add_action('wp_ajax_book_del','book_del_ajax');
    function book_del_ajax(){
        global $wpdb;
           
            $delete_id = (isset($_POST['delete_id']))? esc_attr($_POST['delete_id']) :'';

            $wpdb->delete($wpdb->prefix."my_books",array(
                    "id"=> $delete_id
                )
            );
            wp_send_json_success(array(
                "status"=> "1",
                "message"=>"Book delete successfully"
            ));
            die();
    }


    
    // author edit
    add_action('wp_ajax_cat_myadd','cat_myadd_ajax');
    add_action( 'wp_ajax_nopriv_cat_myadd', 'cat_myadd_ajax' );
    function cat_myadd_ajax(){
        global $wpdb;
        // $about = (isset($_POST['Aabout'])) ? esc_attr($_POST['Aabout']) :'';
        $name =(isset($_POST['Aname']))? esc_attr($_POST['Aname']) :'';
        // $fb_link =(isset($_POST['Afb_link']))? esc_attr($_POST['Afb_link']) :'';
      
        $result_cat = $wpdb->insert($wpdb->prefix."my_book_category",array(
            'name'=> $name,
            // 'fb_link'=> $fb_link,
            // 'about'=> $about
        ));
      
        if($result_cat>0){
            wp_send_json_success(array(
                "status"=> "1",
                "message"=>"Book Category create successfully"
            ));
        }
        die();
    }

      // student edit
      add_action('wp_ajax_student_myadd','my_student_ajax');
      add_action( 'wp_ajax_nopriv_student_myadd', 'my_student_ajax' );
      function my_student_ajax(){
          global $wpdb;
          
          
          $name =(isset($_POST['student_name']))? esc_attr($_POST['student_name']) :'';
          $email =(isset($_POST['student_email']))? esc_attr($_POST['student_email']) :'';
          $username =(isset($_POST['student_username']))? esc_attr($_POST['student_username']) :'';
          $psw =(isset($_POST['student_psw']))? esc_attr($_POST['student_psw']) :'';
  
          $student_id =wp_create_user($username,$psw , $email);
          $user = new WP_User($student_id);
          $user->set_role("wp_book_user_key");
          $result_author=$wpdb->insert($wpdb->prefix."my_students",array(
              'name'=> $name,
              'email'=>   $email ,
              'user_login_id'=>  $student_id
              
          ));
        
          if($result_author>0){
              wp_send_json_success(array(
                  "status"=> "1",
                  "message"=>"Student create successfully"
              ));
          }
          die();
      }



    add_action('wp_ajax_book_add','book_add_ajax');
    function book_add_ajax(){
        // $check_user = $wpdb->get_results( 
        //     $wpdb->prepare( "SELECT name FROM wp_custom_plugin WHERE name='{$name}'")
        //  );
        // if( $check_user){
        //     wp_send_json_success(array(
        //         'error'=> 'Ten da ton tai'
        //     ));
        // } else{
        //    if ( $_POST['param'] == "save_book"){
                global $wpdb;
                $author = (isset($_POST['author'])) ? esc_attr($_POST['author']) :'';
                $name =(isset($_POST['name']))? esc_attr($_POST['name']) :'';
                $about =(isset($_POST['about']))? esc_attr($_POST['about']) :'';
                $book_image =(isset($_POST['book_image']))? esc_attr($_POST['book_image']) :'';
                $category =(isset($_POST['category']))? esc_attr($_POST['category']) :'';
                $book_link =(isset($_POST['link']))? esc_attr($_POST['link']) :'';
                $result=$wpdb->insert($wpdb->prefix."my_books",array(
                    'name'=> $name,
                    'author'=> $author,
                    'about'=> $about,
                    'category_id'=> $category,
                    'book_image'=> $book_image,
                    'link'=>$book_link
                ));
                if($result>0){
                    wp_send_json_success(array(
                        "status"=> "1",
                        "message"=>"Book create successfully"
                    ));
                }
        //    }  
          
        // }
        die();
       
    }
   

  