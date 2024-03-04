<div class="row">
    <div class="col-md-3">
        <div class="input-group input-group-static mb-4">
            <label for="txtStatusRol" class="ms-0">Status User</label>
            <select class="form-control" id="txtStatusRol">
                <option value="">Select an option</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group input-group-outline my-3">
            <button class="btn btn-icon btn-2 btn-info searchInfo" type="button">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </button>
        </div>
    </div>
    <div class="col-md-5"></div>
    <div class="col-md-2">
        <div class="input-group input-group-outline my-3">
            <a class="btn btn-icon btn-2 btn-success" type="button" style="color :white" href="roles?id=">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i> Create Rol</span>
            </a>
        </div>
    </div>
</div>

<table id="tableRoles" class="display" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Rol</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
