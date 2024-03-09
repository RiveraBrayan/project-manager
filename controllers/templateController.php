<?php
	require_once "models/templateModel.php";

	class TemplateController{
        public function logout() {
            session_destroy();
            header('Location: login');
        }

        public function Error404(){
            require_once('./views/pages/404/404.php');
        }

        public function forbidden(){
            require_once('./views/pages/forbidden/forbidden.php');
        }

        public function usersAccess(){
            $page = isset($_GET["page"]) ? $_GET["page"] : '';
            $id_user = isset($_GET["id_user"]) ? $_GET["id_user"] : '';
            $su_user = isset($_GET["su_user"]) ? $_GET["su_user"] : '';

            $fields = array(
                  "page" => $page,
                  "id_user" => $id_user,
                  "su_user" => $su_user,
            );
            
            $data = TemplateModel::usersAccess($fields);

            echo json_encode($data);
        }
		
    }

if (isset($_GET['action']) && $_GET['action'] === 'usersAccess') {
    $usersAccess = new TemplateController();
    $usersAccess->usersAccess();
}
    