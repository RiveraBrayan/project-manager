<?php
	require_once realpath(dirname(__FILE__) . '/../') . '/' . "models/rolesModel.php";

	class RolesController{
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

            public function tableRoles(){

                  $status = isset($_GET["status"]) ? $_GET["status"] : '';

                  $fields = array(
                        "status" => $status
                  );
                  
                  $data = RolesModel::rolesTable($fields);

                  echo json_encode($data);
            }

            public function infoRoles(){
                  $id = $_POST['id'];

                  echo RolesModel::infoRoles($id);
                  
            }

            public function saveRolesInfo(){
                  $id = isset($_POST["id"]) ? $_POST["id"] : '';
                  $txtRol = isset($_POST["txtRol"]) ? $_POST["txtRol"] : '';
                  $checkboxActive = isset($_POST["checkboxActive"]) ? $_POST["checkboxActive"] : '';

                  $fields = array(
                        "id" => $id,
                        "txtRol" => $txtRol,
                        "checkboxActive" => $checkboxActive,
                  );
                  
                  echo RolesModel::saveRolesInfo($fields);
                  
            }
		
    }
    
if (isset($_GET['action']) && $_GET['action'] === 'tableRoles') {
      $tableRoles = new RolesController();
      $tableRoles->tableRoles();
}

if (isset($_POST['action']) && $_POST['action'] === 'infoRoles') {
      $infoRoles = new RolesController();
      $infoRoles->infoRoles();
}

if (isset($_POST['action']) && $_POST['action'] === 'saveRolesInfo') {
      $saveRolesInfo = new RolesController();
      $saveRolesInfo->saveRolesInfo();
}