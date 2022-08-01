<div class="row align-equal">
    <?php 
            
        global $wpdb;
        global $user_ID;
        $all_books = $wpdb->get_results(
            // $wpdb->prepare(
                "SELECT * from ".my_book_table()." ORDER BY id DESC" 
            // )
        ); 
        // echo "<pre>";
        // print_r($user_ID);
        // echo "</pre>";
        if (count ($all_books) >0){
            $i=1;
            foreach($all_books as $key => $value){
                ?>
                    <div class="col large-3">
                        <div class="col-inner">
                            <div class="book-item rounded">
                                <div><img src="<?php echo $value->book_image;?>" alt=""></div>
                                <div class="book-content p-3">
                                    <div class="book-name"><?php echo $value->name;?></div>
                                    <p>Author : <?php echo $value->author;?></p>
                                    <p> 
                                        <a class="btn btn-enrol btn-sm" href = "<?php 
                                        if($user_ID >0){echo "javascript:void(0)";}else{ echo wp_login_url();}
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
    
   
</div>