
<div class="row">
    <div class="col-md-2">
        <div class="input-group input-group-outline my-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="txtNameFilter">
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group input-group-outline my-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" id="txtUsernameFilter">
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group input-group-outline my-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" id="txtEmailFilter">
        </div>
    </div>
    <div class="col-md-3">
    <div class="input-group input-group-static mb-4">
     <label for="txtStatusUser" class="ms-0">Status User</label>
     <select class="form-control" id="txtStatusUser">
       <option value="">Select an option</option>
       <option value="1">Active</option>
       <option value="2">Inactive</option>
     </select>
    </div>
    </div>
    <div class="col-md-1">
        <div class="input-group input-group-outline my-3">
            <button class="btn btn-icon btn-2 btn-info searchInfo" type="button">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </button>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group input-group-outline my-3">
            <a class="btn btn-icon btn-2 btn-success" type="button" style="color :white" href="users?edition=">
                <span class="btn-inner--icon"><i class="fas fa-plus-square"></i> Create User</span>
            </a>
        </div>
    </div>


</div>

<table id="tableUsers" class="display" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Deparment</th>
            <th>Position</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>