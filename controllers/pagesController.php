<?php
	require_once realpath(dirname(__FILE__) . '/../') . '/' . "models/pagesModel.php";

	class PagesController{
		public function roles(){
                  
                  if ( isset($_SESSION['userData']) && $_SESSION['userData']['status'] == '202') {
                        require_once('./views/includes/header.php');
                        require_once('./views/pages/roles/roles.php');
                        require_once('./views/includes/footer.php');
                  } else{
                        header('Location: login');
                        die();
                  }
		}

        public function rolesTable(){

              $txtNameFilter = isset($_GET["txtNameFilter"]) ? $_GET["txtNameFilter"] : '';
              $txtUsernameFilter = isset($_GET["txtUsernameFilter"]) ? $_GET["txtUsernameFilter"] : '';
              $txtEmailFilter = isset($_GET["txtEmailFilter"]) ? $_GET["txtEmailFilter"] : '';
              $txtStatusUser = isset($_GET["txtStatusUser"]) ? $_GET["txtStatusUser"] : '';

              $fields = array(
                    "txtNameFilter" => $txtNameFilter,
                    "txtUsernameFilter" => $txtUsernameFilter,
                    "txtEmailFilter" => $txtEmailFilter,
                    "txtStatusUser" => $txtStatusUser,
              );
              
              $data = RolesModel::rolesTable($fields);

              echo json_encode($data);
        }

        public function rolesInfo(){
              $id_user = $_POST['id_user'];

              echo RolesModel::rolesInfo($id_user);
              
        }

        public function saveRolesInfo(){
              $id_user = isset($_POST["txtId"]) ? $_POST["txtId"] : '';
              $username_user = isset($_POST["txtUsername"]) ? $_POST["txtUsername"] : '';
              $password_user = isset($_POST["txtPassword"]) ? $_POST["txtPassword"] : '';
              $name_user = isset($_POST["txtFullname"]) ? $_POST["txtFullname"] : '';
              $email_user = isset($_POST["txtEmail"]) ? $_POST["txtEmail"] : '';
              $phone_user = isset($_POST["txtPhone"]) ? $_POST["txtPhone"] : '';
              $deparment_user = isset($_POST["txtDeparment"]) ? $_POST["txtDeparment"] : '';
              $position_user = isset($_POST["txtPosition"]) ? $_POST["txtPosition"] : '';
              $checkbocActive = isset($_POST["checkbocActive"]) ? $_POST["checkbocActive"] : '';

              $fields = array(
                    "id_user" => $id_user,
                    "username_user" => $username_user,
                    "password_user" => $password_user,
                    "name_user" => $name_user,
                    "email_user" => $email_user,
                    "phone_user" => $phone_user,
                    "deparment_user" => $deparment_user,
                    "position_user" => $position_user,
                    "checkbocActive" => $checkbocActive,
              );
              
            //   echo RolesModel::saveRolesInfo($fields);
              
        }
		
    }
    
if (isset($_GET['action']) && $_GET['action'] === 'tableUsers') {
      $tableUsers = new RolesController();
      $tableUsers->rolesTable();
}

if (isset($_POST['action']) && $_POST['action'] === 'infoUsers') {
      $infoUsers = new RolesController();
      $infoUsers->rolesInfo();
}

if (isset($_POST['action']) && $_POST['action'] === 'saveUsersInfo') {
      $saveUsersInfo = new RolesController();
      $saveUsersInfo->saveRolesInfo();
}