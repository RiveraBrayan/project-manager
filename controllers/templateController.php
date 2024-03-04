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
		
    }
    