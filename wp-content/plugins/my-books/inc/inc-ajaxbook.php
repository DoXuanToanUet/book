<?php 

add_action('wp_ajax_book_edit','book_edit_ajax');
function book_edit_ajax(){
    global $wpdb;
        $editauthor = (isset($_POST['editauthor'])) ? esc_attr($_POST['editauthor']) :'';
        $editname =(isset($_POST['editname']))? esc_attr($_POST['editname']) :'';
        $editabout =(isset($_POST['editabout']))? esc_attr($_POST['editabout']) :'';
        $editbook_image =(isset($_POST['editbook_image']))? esc_attr($_POST['editbook_image']) :'';
        $book_id = (isset($_POST['book_id']))? esc_attr($_POST['book_id']) :'';

        $wpdb->update($wpdb->prefix."my_books",array(
            'name'=>$editname,
            'author'=> $editauthor,
            'about'=>  $editabout,
            'book_image'=>  $editbook_image
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
                $result=$wpdb->insert($wpdb->prefix."my_books",array(
                    'name'=> $name,
                    'author'=> $author,
                    'about'=> $about,
                    'category'=> $category,
                    'book_image'=> $book_image
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
   

  