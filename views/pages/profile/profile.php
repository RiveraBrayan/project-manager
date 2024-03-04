<?php
     $userInfo = new ProfileController();

     $infoUser = $userInfo->userInfo();

    if (isset($_POST['profileSubmit'])) {
        $saveInfo = $userInfo->saveInfo();
    }

    if (isset($_POST['PictureSubmit'])) {
        $changePhoto = $userInfo->changePhoto();
    }

    if (isset($_POST['PasswordSubmit'])) {
        $changePassword = $userInfo->changePassword();
    }
?>
<div class="card card-body mx-3 mx-md-4 mt-n6" style="margin-top: 0px !important">
    <div class="row gx-4 mb-2">
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="<?php echo $infoUser['photo_user']  != '' ? './views/archives/profile_picture/'.$infoUser['id_user'].'/'.$infoUser['photo_user'] : './views/assets/img/userIcon.jpeg'?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100"> 
                <h5 class="mb-1">
                    <?php echo $infoUser['name_user'] ?>
                </h5>
                <p class="mb-0 font-weight-normal text-sm">
                    <?php echo $infoUser['deparment_user'] . '/' . $infoUser['position_user'] ?>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Profile Information</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="javascript:;">
                                    <i class="fas fa-user-edit text-secondary text-sm modalEditUser" data-toggle="modal" data-target="#editionInformationModal" ></i><span class="sr-only">Edit Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $infoUser['name_user'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <?php echo $infoUser['phone_user'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $infoUser['email_user'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Deparment:</strong> &nbsp; <?php echo $infoUser['deparment_user'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Position:</strong> &nbsp; <?php echo $infoUser['position_user'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Profile Picture</h6>
                    </div>
                    <form method="post"  class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="txtId" value="<?php echo $infoUser['id_user'] ?>">
                        <div class="card-body p-3">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_profile" id="file_profile">
                                    <label class="custom-file-label" for="file_profiles">Choose file</label>
                                </div>
                            </div>
                            
                            <button type="submit" name="PictureSubmit" class="btn btn-info" style="width: 100%;">Change Picture</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Change Password</h6>
                    </div>
                    <form method="post"  class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="txtId" value="<?php echo $infoUser['id_user'] ?>">
                        <div class="card-body p-3">
                            <div class="input-group input-group-static mb-4">
                                <label>Old Password</label>
                                <input type="password" class="form-control" name="txtOldPassword" value="">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="txtNewPassword" value="">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Repeat New Password</label>
                                <input type="password" class="form-control" name="txtRNewPassword" value="">
                            </div>
                            
                            <button type="submit" name="PasswordSubmit" class="btn btn-info" style="width: 100%;">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Profile Information-->
<div class="modal fade" id="editionInformationModal" tabindex="-1" role="dialog" aria-labelledby="editionInformationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editionInformationModalLabel">Edit Profile Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <form method="post"  class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
            <div class="modal-body">
                    <input type="hidden" name="txtId" value="<?php echo $infoUser['id_user'] ?>">

                    <div class="input-group input-group-static mb-4">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="txtName" value="<?php echo $infoUser['name_user'] ?>">
                    </div>

                    <div class="input-group input-group-static mb-4">
                        <label>Mobile</label>
                        <input type="text" class="form-control" name="txtPhone" value="<?php echo $infoUser['phone_user'] ?>">
                    </div>

                    <div class="input-group input-group-static mb-4">
                        <label>Email</label>
                        <input type="text" class="form-control" name="txtEmail" value="<?php echo $infoUser['email_user'] ?>">
                    </div>

                    <div class="input-group input-group-static mb-4">
                        <label>Deparment</label>
                        <input type="text" class="form-control" name="txtDeparment" value="<?php echo $infoUser['deparment_user'] ?>">
                    </div>

                    <div class="input-group input-group-static mb-4">
                        <label>Position</label>
                        <input type="text" class="form-control" name="txtPosition" value="<?php echo $infoUser['position_user'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="profileSubmit" class="btn btn-success">Save changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>