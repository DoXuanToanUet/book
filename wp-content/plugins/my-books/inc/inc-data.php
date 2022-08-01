<?php
    function my_books_table(){
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();

        // create table book
        $contactTable = $wpdb->prefix . 'my_books';
        $createContactTable = "CREATE TABLE IF NOT EXISTS `{$contactTable}` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            `author` varchar(255) DEFAULT NULL,
            `category` varchar(255) DEFAULT NULL,
            `about` text,
            `book_image` text,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) {$charsetCollate};";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $createContactTable );

        // Create table author
        // $authorTable = $wpdb->prefix . 'my_authors';
        // $createAuthorTable = "CREATE TABLE IF NOT EXISTS `{$authorTable}` (
        //     `id` int(11) NOT NULL AUTO_INCREMENT,
        //     `name` varchar(255) DEFAULT NULL,
        //     `fb_link` text DEFAULT NULL,
        //     `about` text DEFAULT NULL,
        //     `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        //     PRIMARY KEY (`id`)
        // ) {$charsetCollate};";
        // require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        // dbDelta( $createAuthorTable );

        // create table book category 
        $bookCategoryTable =  $wpdb->prefix . 'my_book_category'; 
        $createbookCategoryTable = "CREATE TABLE IF NOT EXISTS `{$bookCategoryTable}` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
        ) {$charsetCollate};";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $createbookCategoryTable );


        // create table student
        $studentTable = $wpdb->prefix . 'my_students';
        $createStudentTable = "CREATE TABLE IF NOT EXISTS `{$studentTable}` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            `email` varchar(255) DEFAULT NULL,
            `user_login_id` int(11) DEFAULT NULL,
            `password` text  NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
        ) {$charsetCollate};";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $createStudentTable );

        // create table enroll
        $enrolTable = $wpdb->prefix . 'my_enrol';
        $createEnrolTable = "CREATE TABLE IF NOT EXISTS `{$enrolTable}` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `student_id` int(11) NOT NULL,
            `book_id` int(11) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
        ) {$charsetCollate};";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $createEnrolTable );

        //user role registration
        add_role("wp_book_user_key","My Book User",array(
            "read"=>true
        )); 


        // create page when active plugin 
        $my_post = array(
            'post_title'    => "Book Page",
            'post_content'  => "",// shortcode
            'post_status'   => 'publish',
            "post_type"     => "page",
            "post_name" => "my_book"
          );
           
          // Insert the post into the database
          $book_id= wp_insert_post( $my_post );
          add_option("my_book_page_id",$book_id);


    }