<?php 
/**
 * Plugin Name:       My Book
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Add list books and show on dashboard
 * Version:           1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Toandev
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

    if( !defined('ABSPATH')){
            exit();
    }
    if( !defined('MY_BOOK_PLUGIN_DIR_PATH') ){
        define( "MY_BOOK_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__) );
    }
    if( !defined('MY_BOOK_PLUGIN_URL') ){
        define( "MY_BOOK_PLUGIN_URL",   plugins_url()."/my-books");
    }

    // echo MY_BOOK_PLUGIN_DIR_PATH;
    // echo MY_BOOK_PLUGIN_URL;
    function my_book_include_assets(){

        // $slug = '';
        // $page_include = array("book-list","book-add-new","add-book-cat","remove-author","add-student","remove-student","course-tracker");
        // $currentPage = $_GET['page'];

        // if( empty($currentPage)){
        //     $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
           
        //     if( preg_match("/my_book/", $actual_link)){
        //         $currentPage = "book-list";
        //     }
        // }
        // echo  $currentPage;
        // if( in_array( $currentPage , $page_include)){
            wp_enqueue_style('cssbootstrap', MY_BOOK_PLUGIN_URL.'/assets/css/bootstrap.min.css' ,'');
            wp_enqueue_style('dataTable', MY_BOOK_PLUGIN_URL.'/assets/css/jquery.dataTables.min.css' ,'');
            wp_enqueue_style('dataTable', MY_BOOK_PLUGIN_URL.'/assets/css/jquery.dataTables.min.css' ,'');
            wp_enqueue_style('notify', MY_BOOK_PLUGIN_URL.'/assets/css/jquery.notifyBar.css' ,'');
            wp_enqueue_style('style', MY_BOOK_PLUGIN_URL.'/assets/css/style.css' ,'');
    
            wp_enqueue_script('jsbootstrap', MY_BOOK_PLUGIN_URL.'/assets/js/bootstrap.min.js' ,'');
            wp_enqueue_script('jqueryt', MY_BOOK_PLUGIN_URL.'/assets/js/jquery.min.js' ,'');
            wp_enqueue_script('dataTable', MY_BOOK_PLUGIN_URL.'/assets/js/jquery.dataTables.min.js' ,'');
            wp_enqueue_script('validate', MY_BOOK_PLUGIN_URL.'/assets/js/jquery.validate.js' ,'');
            wp_enqueue_script('notify', MY_BOOK_PLUGIN_URL.'/assets/js/jquery.notifyBar.js' ,'');
            wp_enqueue_script('main', MY_BOOK_PLUGIN_URL.'/assets/js/main.js' ,'');
          
        // }
       
    }

    add_action('init','my_book_include_assets');

    function my_books_plugins_menu(){
        add_menu_page("My Book", "My Book", "manage_options", "book-list", "my_book_list", "dashicons-book-alt", 30);
        add_submenu_page("book-list", "Book List", "Book List", "manage_options", "book-list", "my_book_list");
        add_submenu_page("book-list", "Add New", "Add New", "manage_options", "book-add-new", "my_book_add");
        add_submenu_page("book-list", "", "", "manage_options", "book-edit", "my_book_edit");
        add_submenu_page("book-list", "", "", "manage_options", "cat-edit", "my_cat_edit");

         /// my extended submenus
        add_submenu_page("book-list", "Add New Category", "Add New Category", "manage_options", "add-book-cat", "my_bookcat_add");
        add_submenu_page("book-list", "Manage Category", "Manage Category", "manage_options", "manage-book-cat", "manage_book_cat");
            // add_submenu_page("book-list", "Add New Student", "Add New Student", "manage_options", "add-student", "my_student_add");
            // add_submenu_page("book-list", "Manage Student", "Manage Student", "manage_options", "remove-student", "my_student_remove");
            // add_submenu_page("book-list", "Course Tracker", "Course Tracker", "manage_options", "course-tracker", "course_tracker");
    }
    add_action("admin_menu", "my_books_plugins_menu");


    function my_admin_enqueue( $hook_suffix ) {
        $page_include = array("book-list","book-edit","book-add-new","add-book-cat","remove-author","add-student","remove-student","course-tracker");
        
        if( isset($_GET['page']) ){
            $currentPage = $_GET['page'];
            if( in_array( $currentPage , $page_include)  ) {
                wp_register_style('my-theme-settings', MY_BOOK_PLUGIN_URL.'/assets/css/book.css');   
                wp_enqueue_style( 'my-theme-settings' );  
            }
        } 
        wp_register_style('book-admincss', MY_BOOK_PLUGIN_URL.'/assets/css/bookadmin.css');   
        wp_enqueue_style( 'book-admincss' );  
    }
    add_action( 'admin_enqueue_scripts', 'my_admin_enqueue', 10 );
    //callback functions to menus and submenus
  function my_book_list() {
        include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/book-list.php";
    }

    function my_book_add() {
        include_once MY_BOOK_PLUGIN_DIR_PATH . '/views/book-add.php';
    }
    function my_book_edit() {
        include_once MY_BOOK_PLUGIN_DIR_PATH . '/views/book-edit.php';
    }

    function my_bookcat_add(){
        include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/category-add.php";
    }
    function manage_book_cat(){
        include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/manager-cat.php";
    }

    function my_cat_edit() {
        include_once MY_BOOK_PLUGIN_DIR_PATH . '/views/category-edit.php';
    }
    // function my_student_add(){
    //     include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/student-add.php";
    // }
    // function my_student_remove(){
    //     include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/manager-student.php";
    // }
    // function course_tracker(){
    //     include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/course-tracker.php";
    // }
    function my_book_category_table(){
        global $wpdb;
        return $wpdb->prefix."my_book_category";
    }
    function my_student_table(){
        global $wpdb;
        return $wpdb->prefix."my_students";
    }
    function my_book_table(){
        global $wpdb;
        return $wpdb->prefix."my_books";
    }
    include_once MY_BOOK_PLUGIN_DIR_PATH."/inc/inc-data.php";
    include_once MY_BOOK_PLUGIN_DIR_PATH."/inc/inc-ajaxbook.php";
    // Create table database
 
    register_activation_hook(__FILE__,'my_books_table');

    // Drop datatase after deactive plugin 
    function drop_table_plugin_books() {
        global $wpdb;
        // $wpdb->query("DROP TABLE IF EXISTS wp_my_books" );
        if( !empty(get_option('my_book_page_id'))){
            wp_delete_post(get_option('my_book_page_id'),true);
            delete_option("my_book_page_id");
        }

    }
      
    register_deactivation_hook(__FILE__, "drop_table_plugin_books");

    function my_book_function(){
        ob_start();
        include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/my_books_frontend_list.php";
        $content = ob_get_clean();
        return $content;
    }

    add_shortcode( 'book_page', 'my_book_function' );
    
    // add filter page template 
    add_filter( "page_template", "book_custom_page_layout" );
    
    function book_custom_page_layout($page_template){
        global $post;
        $page_slug = $post->post_name;
        // echo $page_slug;
        if( $page_slug === "my_book"){
            $page_template = include_once MY_BOOK_PLUGIN_DIR_PATH . "/views/frontend-book-template.php";
        }
        return $page_template;
    }

    // get author detail
    function get_author_details($author_id){
        global $wpdb;
        $author_detail = $wpdb->get_row(

            $wpdb->prepare(
                "SELECT * from ".my_author_table()." WHERE name = %s",$author_id
            ),ARRAY_A
        );
        return  $author_detail;
    }

    // custom user role 
    function login_user_bookrole($redirect_to, $request,$user){
        global $user;
        if( isset($user->roles) && is_array($user->roles)){
            if(in_array("wp_book_user_key",$user->roles)){
                return $redirect_to = site_url()."/my_book";
            }else {
                return  $redirect_to;
            }
        }
    }

    add_filter( 'login_redirect', 'login_user_bookrole',10,3);
    
    function logout_user_bookrole(){
        wp_redirect(site_url()."/my_book");
        exit();
    }

    add_filter("wp_logout",'logout_user_bookrole');

   
?>
