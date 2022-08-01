<?php 

   global $wpdb;
   $allstudent = $wpdb->get_results(
       $wpdb->prepare(
           "SELECT * from ".my_student_table()." ORDER by id desc"
       )
    );
    // echo "<pre>";
    // print_r($allstudent);
    // echo "</pre>";
?>
<!-- <?php //phpinfo();?> -->
<div class="container">
    <div class="row">
    <div class="alert alert-info">
        <h5>My Student List</h5>
    </div>
    <div class="alert alert-success alert-dismissible fade show bookadd_alert" role="alert">
            <strong class="bookadd_alert_content"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <div class="panel panel-default">
        <div class="panel-heading">My Student List</div>
        <div class="panel-body">
            <table id="my-book" class="display" style="width:100%" >
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Create at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                            if (count ($allstudent) >0){
                                $i=1;
                                foreach($allstudent as $key => $value){
                                    $userdetail = get_userdata($value->user_login_id);
                                    
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $value->name; ?></td>
                                            <td><?php echo $value->email; ?></td>
                                            <td><?php echo  $userdetail->user_login; ?></td>
                                            <td><?php echo $value->created_at; ?></td>
                                            <td>
                                                <a class="btn btn-info" href="admin.php?page=book-edit&edit=<?php echo $value->id;?>">Edit</a>
                                                <p class="btn btn-danger btnbookdelete" href="" data-id="<?php echo $value->id;?>">Delete</p>
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