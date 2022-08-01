<?php 

    global $wpdb;
    $all_cats = $wpdb->get_results(

        // $wpdb->prepare(
            "SELECT * from ".my_book_category_table()." order by id desc" 
        // )
    );
?>

<div class="container">
    <div class="row">
    <div class="alert text-center">
        <h5>My Author List</h5>
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
                        <!-- <th>Fb Link</th>
                        <th>About</th> -->
                        <th>Create at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        if (count ($all_cats) >0){
                            $i=1;
                            foreach($all_cats as $key => $value){
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <!-- <td><?php //echo $value->fb_link; ?></td>
                                        <td><?php //echo $value->about; ?></td> -->
                                        <td><?php echo $value->created_at; ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-info btn-sm me-2" href="admin.php?page=cat-edit&edit=<?php echo $value->id;?>">Edit</a>
                                                <a class="btn btn-danger btn-sm btncatdelete" href="" data-id="<?php echo $value->id;?>">Delete</a>
                                            </div>
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