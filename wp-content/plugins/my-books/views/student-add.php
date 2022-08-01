<?php wp_enqueue_media();?>
<div class="container">
    <div class="row">
        <div class="alert alert-info text-center">
            <h5>Student add page</h5>
        </div>
        <div class="alert alert-success alert-dismissible fade show bookadd_alert" role="alert">
            <strong class="bookadd_alert_content"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Panel Heading</div>
            <div class="panel-body">
                <form action="javascript:void(0)" id="formAddStudent">
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" name="name" id="name" placeholder="Enter Author" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" name="email" id="email" placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="username">Username</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" name="username" id="username" placeholder="Enter Username" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="password">Password</label>
                        <div class="col-sm-10">
                            <input type="password"  class="form-control" name="password" id="password" placeholder="Enter Password" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="conf_password">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password"  class="form-control" name="conf_password" id="conf_password" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
                </form>
            </div>
        </div>
    </div>
</div>