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

        public function pagesInfo(){
              $id = $_POST['id'];

              echo PagesModel::pagesInfo($id);
              
        }

        public function savePagesInfo(){
              $id_user = isset($_POST["txtId"]) ? $_POST["txtId"] : '';
              $username_user = isset($_POST["txtUsername"]) ? $_POST["txtUsername"] : '';

              $fields = array(
                    "id_user" => $id_user,
                    "username_user" => $username_user,
              );
              
              echo PagesModel::savePagesInfo($fields);
              
        }
		
    }
    
if (isset($_GET['action']) && $_GET['action'] === 'tablePages') {
      $pagesTable = new PagesController();
      $pagesTable->pagesTable();
}

if (isset($_POST['action']) && $_POST['action'] === 'infoUsers') {
      $infoUsers = new PagesController();
      $infoUsers->pagesInfo();
}

if (isset($_POST['action']) && $_POST['action'] === 'saveUsersInfo') {
      $saveUsersInfo = new PagesController();
      $saveUsersInfo->savePagesInfo();
}