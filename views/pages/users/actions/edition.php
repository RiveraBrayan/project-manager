<?php

    if(isset($_GET['edition']) && $_GET['edition'] != ''){
        $id_user = $_GET['edition'];
        $tittle = "Edit User Info";

    }else{
        $id_user = '';
        $tittle = "Create User Info";

    }

?>

<div class="row">
    <h4><?php echo $tittle ?> </h4>
    <form method="post"  class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" id="txtId" value="<?php echo $id_user ?>">

            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label>Username</label>
                    <input type="text" class="form-control" id="txtUsername" value="">
                </div>
            </div>

            <div class="col-md-6" id="inputPassword" style="display:none">
                <div class="input-group input-group-static mb-4">
                    <label>Password</label>
                    <input type="text" class="form-control" id="txtPassword">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label>Full Name</label>
                    <input type="text" class="form-control" id="txtFullname" value="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label>Email</label>
                    <input type="text" class="form-control" id="txtEmail" value="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label>Phone</label>
                    <input type="text" class="form-control" id="txtPhone" value="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label>Deparment</label>
                    <input type="text" class="form-control" id="txtDeparment" value="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label>Position</label>
                    <input type="text" class="form-control" id="txtPosition" value="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="checkboxSuperSu">
                    <label class="form-check-label" for="checkboxSuperSu">Is SuperUs?</label>
                </div>
            </div>

            <div class="col-md-6" id="inputCheckbox" style="display:none">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="checkboxActive">
                    <label class="form-check-label" for="checkboxActive">Is Active?</label>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-info userSubmit">Save</button>
                <a type="button" href="users" class="btn btn-danger ml-2" style="color: white;">Cancel</a>
            </div>


        </div>
    </form>
</div>