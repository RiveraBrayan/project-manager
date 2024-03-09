<?php
	require_once realpath(dirname(__FILE__) . '/../') . '/' . "models/pagesModel.php";

	class PagesController{
		public function pages(){
                  
                  if ( isset($_SESSION['userData']) && $_SESSION['userData']['status'] == '202') {
                        require_once('./views/includes/header.php');
                        require_once('./views/pages/pages/pages.php');
                        require_once('./views/includes/footer.php');
                  } else{
                        header('Location: login');
                        die();
                  }
		}

            public function pagesTable(){
                  
                  $data = PagesModel::pagesTable();

                  echo json_encode($data);
            }

            public function rolesTable(){

                  $id_page = isset($_GET["id_page"]) ? $_GET["id_page"] : '';

                  $fields = array(
                        "id_page" => $id_page,
                  );
                  
                  $data = PagesModel::rolesTable($fields);

                  echo json_encode($data);
            }

            public function pagesInfo(){
                  $id = $_POST['id'];

                  echo PagesModel::pagesInfo($id);
                  
            }

            public function savePagesInfo(){
                  $txtId = isset($_POST["txtId"]) ? $_POST["txtId"] : '';
                  $txtName = isset($_POST["txtName"]) ? $_POST["txtName"] : '';
                  $txtUrl = isset($_POST["txtUrl"]) ? $_POST["txtUrl"] : '';
                  $txtIcon = isset($_POST["txtIcon"]) ? $_POST["txtIcon"] : '';
                  $checkboxActive = isset($_POST["checkboxActive"]) ? $_POST["checkboxActive"] : 0;

                  $fields = array(
                        "txtId" => $txtId,
                        "txtName" => $txtName,
                        "txtUrl" => $txtUrl,
                        "txtIcon" => $txtIcon,
                        "checkboxActive" => $checkboxActive,
                  );
                  
                  echo PagesModel::savePagesInfo($fields);
                  
                  
            }

            public function saveRolesinfo(){
                  $id_page = isset($_POST["id_page"]) ? $_POST["id_page"] : '';
                  $id_rol = isset($_POST["id_rol"]) ? $_POST["id_rol"] : '';

                  $fields = array(
                        "id_page" => $id_page,
                        "id_rol" => $id_rol,
                  );
                  
                  echo PagesModel::saveRolesinfo($fields);
                  
            }
                  
      }
    
if (isset($_GET['action']) && $_GET['action'] === 'tablePages') {
      $pagesTable = new PagesController();
      $pagesTable->pagesTable();
}
    
if (isset($_GET['action']) && $_GET['action'] === 'tableRoles') {
      $tableRoles = new PagesController();
      $tableRoles->rolesTable();
}

if (isset($_POST['action']) && $_POST['action'] === 'infoPages') {
      $infoUsers = new PagesController();
      $infoUsers->pagesInfo();
}

if (isset($_POST['action']) && $_POST['action'] === 'savePagesInfo') {
      $savePagesInfo = new PagesController();
      $savePagesInfo->savePagesInfo();
}

if (isset($_POST['action']) && $_POST['action'] === 'saveRolesinfo') {
      $saveRolesinfo = new PagesController();
      $saveRolesinfo->saveRolesinfo();
}