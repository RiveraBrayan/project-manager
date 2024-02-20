<?php
	require_once "models/adminModel.php";

	class AdminController{

		public function login(){

            session_start();
            session_destroy();
            require_once('./views/pages/login/login.php');
		}

        public function accesUser() {
            if (isset($_POST['txtUsername']) && $_POST['txtUsername'] != '' && isset($_POST['txtPassword']) && $_POST['txtPassword'] != '') {

		        session_start();

                $fields = array(
                    "username_usuario" => $_POST['txtUsername'],
                    "password_usuario" => isset($_POST['txtPassword']) ? $_POST['txtPassword'] : ''
                );

                $response = AdminModel::loginModel($fields);

                if($response['status'] == 202){
                    $_SESSION['userData'] = $response;
                    header('Location: home');
                }
            }
        }
    
        public function cerrarSesion() {
            session_start();
            session_destroy();
            header('Location: login');
        }

        public function Error404(){
            require_once('./views/pages/404/404.php');
        }
		
    }
    