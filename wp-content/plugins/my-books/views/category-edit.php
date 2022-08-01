<?php wp_enqueue_media();?>
<?php 

    $cat_id = isset($_GET['edit'] ) ? intval($_GET['edit'] ) : 0;
    global $wpdb;
    $book_detail = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * from ".my_book_category_table()." WHERE id = %d ",$cat_id
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
                <form action="javascript:void(0)" id="formCatEdit">
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="editname">Name</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" value="<?php echo $book_detail->name;?>"  name="editname" id="editname" placeholder="Enter Book Name" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <input type="hidden" name="cat_id" value="<?php echo isset($_GET['edit'])? intval($_GET['edit']) : 0 ;?>">
                    <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
                </form>
            </div>
        </div>
    </div>
</div>