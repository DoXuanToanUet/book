<?php 

    global $wpdb;
    $all_books = $wpdb->get_results(

        $wpdb->prepare(
            "SELECT * from  wp_my_books order by id desc" 
        ),ARRAY_A 
    );
    // echo "<pre>";
    // print_r($all_books);
    // echo "</pre>";
?>
<!-- <?php //phpinfo();?> -->
<div class="container">
    <div class="row">
    <div class="alert text-center">
        <h3>My book add</h3>
    </div>
    <div class="alert alert-success alert-dismissible fade show bookadd_alert" role="alert">
            <strong class="bookadd_alert_content"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="my-book" class="table table-striped" style="width:100%" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>About</th>
                        <th>Book Image</th>
                        <th>Create at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   <?php 
                        if (count ($all_books) >0){
                            $i=1;
                            foreach($all_books as $key => $value){
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value["author"]; ?></td>
                                        <td><?php echo $value["category"]; ?></td>
                                        <td><?php echo wp_trim_words($value["about"],20); ?></td>
                                        <td>
                                            <img src="<?php  echo $value["book_image"]; ?>" alt="" style="width:80px; height:80px; object-fit:cover;">
                                          
                                        </td>
                                        <td><?php echo $value["created_at"]; ?></td>
                                        <td>
                                            <a class="btn btn-info" href="admin.php?page=book-edit&edit=<?php echo $value["id"];?>">Edit</a>
                                            <p class="btn btn-danger btnbookdelete" href="" data-id="<?php echo $value["id"];?>">Delete</p>
                                        </td>
                                    </tr>    
                                <?php
                            }
                        }
                   ?>
                </tbody>
                <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
            </table>
        </div>
    </div>
       
    </div>
</div>