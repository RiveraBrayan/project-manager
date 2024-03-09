<?php

if (isset($_GET['roles']) && $_GET['roles'] != '') {
    $id_user = $_GET['roles'];
    $tittle = "User Roles";
}

?>

<input type="hidden" id="id_user" value="<?php echo $id_user ?>">

<div class="row"> 
    <div class="col-md-3">
        <div class="input-group input-group-static mb-4">
            <label for="txtRoles" class="ms-0">Roles</label>
            <select class="form-control" id="txtRoles">
                <option value="">Select an option</option>
            </select> 
        </div>
    </div>
    <div class="col-md-1">
        <div class="input-group input-group-outline my-3">
            <button class="btn btn-icon btn-2 btn-info saveRol" type="button">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i></span>
            </button>
        </div>
    </div>


</div>

<table id="tableRoles" class="display" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Rol</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>



<div class="d-flex justify-content-end" style="margin-top: 50px;">
    <a type="button" href="users" class="btn btn-danger ml-2" style="color: white;">Cancel</a>
</div>