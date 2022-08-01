<?php wp_enqueue_media();?>
<?php 

    $book_id = isset($_GET['edit'] ) ? intval($_GET['edit'] ) : 0;
    global $wpdb;
    $book_detail = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * from wp_my_books WHERE id = %d ",$book_id
            )
    );
    // echo "<pre>";
    // print_r($book_detail);
    // echo "</pre>";   
?>
<div class="container">
    <div class="row">
        <div class="alert text-center">
            <h5>Edit book</h5>
        </div>
        <div class="alert alert-success alert-dismissible fade show bookadd_alert" role="alert">
            <strong class="bookadd_alert_content"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form action="javascript:void(0)" id="formEditBook">
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="editname">Name</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" value="<?php echo $book_detail->name;?>"  name="editname" id="editname" placeholder="Enter Book Name" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="editauthor">Author</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php echo $book_detail->author;?>" class="form-control" name="editauthor" id="editauthor" placeholder="Enter Book Author" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="book-link">Link book</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  value="<?php echo $book_detail->link;?>" name="book-link" id="book-link" placeholder="Enter Book Link" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="author">Category</label>
                        <div class="col-sm-10">
                            <select name="book-cat" id="book-cat" class="form-select form-select-lg mb-3">
                                <option value="">--Choose Category</option>
                                <?php 
                                    global $wpdb;
                                    $category_id = $book_detail->category_id;
                                    // echo "<pre>";
                                    // print_r($cat);
                                    // echo "</pre>"; 
                                   $getallcat =  $wpdb->get_results(
                                        "SELECT * from ".my_book_category_table()." ORDER by id desc"
                                    );
                                    // echo "<pre>";
                                    // print_r($getallcat);
                                    // echo "</pre>";  
                                    foreach($getallcat  as $index => $cat){
                                        ?>
                                            <option value="<?php echo $cat->id;?>" <?php if ( $category_id == $cat->id) echo "selected";?>><?php  echo $cat->name;?></option>
                                        <?php 
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="editabout">About</label>
                        <div class="col-sm-10">
                            <textarea name="editabout"  id="editabout" style="width:100%; height:200px"><?php
                                  echo $book_detail->about;
                                  ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="btn-upload">Upload book Image</label>
                        <div class="col-sm-10">
                            <input type="button"  id="btn-upload" class="btn btn-info"  value="Upload image">
                            <span id="show-image">
                                <img src="<?php echo  $book_detail->book_image;?>" alt="" style="width:80px;height:80px; object-fit:cover;">
                            </span>
                            <input type="hidden" id="editimage_name" name="editimage_name" value="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <input type="hidden" name="book_id" value="<?php echo isset($_GET['edit'])? intval($_GET['edit']) : 0 ;?>">
                    <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
                </form>
            </div>
        </div>
    </div>
</div>