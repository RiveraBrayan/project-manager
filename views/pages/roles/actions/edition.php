<?php

    if(isset($_GET['id']) && $_GET['id'] != ''){
        $id = $_GET['id'];
        $tittle = "Edit Rol";

    }else{
        $id = '';
        $tittle = "Create Rol";

    }

?>

<div class="row">
    <h4><?php echo $tittle ?> </h4>
    <form method="post"  class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" id="txtId" value="<?php echo $id ?>">

            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label>Roles</label>
                    <input type="text" class="form-control" id="txtRol" value="">
                </div>
            </div>

            <div class="col-md-6" id="inputCheckbox" style="display:none;">
                <div class="form-check form-switch" style="margin-top: 5% !important;">
                    <input class="form-check-input" type="checkbox" id="checkboxActive">
                    <label class="form-check-label" for="checkboxActive">Is Active?</label>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-info saveSubmit">Save</button>
                <a type="button" href="roles" class="btn btn-danger ml-2" style="color: white;">Cancel</a>
            </div>
        </div>
    </form>
</div>