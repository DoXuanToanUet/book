<?php wp_enqueue_media();?>
<div class="container">
    <div class="row">
        <div class="alert text-center">
            <h5>Add book</h5>
        </div>
        <div class="alert alert-success alert-dismissible fade show bookadd_alert" role="alert">
            <strong class="bookadd_alert_content"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form action="javascript:void(0)" id="formAddBook" class="p-4">
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Book Name" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="book-author">Author</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="book-author" id="book-author" placeholder="Enter Author" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="author">Category</label>
                        <div class="col-sm-10">
                            <select name="book-cat" id="book-cat" class="form-select form-select-lg mb-3">
                                <option value="">--Choose Category</option>
                                <?php 
                                    global $wpdb;
                                   $getallcat =  $wpdb->get_results(
                                        $wpdb->prepare(
                                            "SELECT * from ".my_book_category_table()." ORDER by id desc"
                                        )
                                    );
                                    echo "<pre>";
                                    print_r($getallcat);
                                    echo "</pre>";  
                                    foreach($getallcat  as $index => $cat){
                                        ?>
                                            <option value="<?php  echo $cat->id;?>"><?php  echo $cat->name;?></option>
                                        <?php 
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="about">About</label>
                        <div class="col-sm-10">
                            <textarea name="about" id="about" style="width:100%; height:200px" rows="3"  class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="btn-upload">Upload book Image</label>
                        <div class="col-sm-10">
                            <input type="button"  id="btn-upload" class="btn btn-info"  value="Upload image">
                            <span id="show-image"></span>
                            <input type="hidden" id="image_name" name="image_name" value="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
                </form>
            </div>
        </div>
    </div>
</div>