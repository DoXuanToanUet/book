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
        /* Các bước làm pagination 
        1. Tìm tổng số record
        2.TÌM LIMIT VÀ CURRENT_PAGE
        3.
        */

        // TÌM TỔNG SỐ RECORD
        $total_records = count ($all_books);

        // TÌM LIMIT VÀ CURRENT_PAGE
        $current_page = isset($_GET['pag']) ? $_GET['pag'] : 1;
        $limit = 8;
        
        //TÍNH TOÁN TOTAL_PAGE VÀ START
        $total_page = ceil($total_records / $limit);

        

        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }

        // Tìm Start
        $start = ($current_page - 1) * $limit;
        
        // echo "<pre>";
        // var_dump($total_records);
        // var_dump($current_page);
        // var_dump($total_page);
        // echo "</pre>";
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
        ?>
                 
            </ul>
        </nav>
        <?php 
    ?>
    
   
</div>