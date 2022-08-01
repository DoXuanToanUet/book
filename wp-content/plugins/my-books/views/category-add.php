
<div class="container">
    <div class="row">
        <div class="alert text-center">
            <h5>Category Add</h5>
        </div>
        <div class="alert alert-success alert-dismissible fade show bookadd_alert" role="alert">
            <strong class="bookadd_alert_content"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form action="javascript:void(0)" id="formAddCategory">
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" name="name" id="name" placeholder="Enter Category" required>
                        </div>
                    </div>
                    <!-- <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="fb_link">Fb link</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" name="fb_link" id="fb_link" placeholder="Enter Facebook link" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-2" for="about">About</label>
                        <div class="col-sm-10">
                            <textarea name="about" id="about" placeholder="Enter about" style="width:100%; height:200px"></textarea>
                        </div>
                    </div> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="url_ajax" value="<?= admin_url('admin-ajax.php'); ?>">
                </form>
            </div>
        </div>
    </div>
</div>