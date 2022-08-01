<?php 

    global $wpdb;
   
?>
<!-- <?php //phpinfo();?> -->
<div class="container">
    <div class="row">
    <div class="alert alert-info">
        <h5>My Course Tracker List</h5>
    </div>
    <div class="alert alert-success alert-dismissible fade show bookadd_alert" role="alert">
            <strong class="bookadd_alert_content"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <div class="panel panel-default">
        <div class="panel-heading">My Author List</div>
        <div class="panel-body">
            <table id="my-book" class="display" style="width:100%" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Create at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                 
                </tbody>
                <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
            </table>
        </div>
    </div>
       
    </div>
</div>