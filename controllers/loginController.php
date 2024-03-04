<?php
	require_once "models/loginModel.php";

	class LoginController{

		public function login(){
            // session_start();
            session_destroy();
            require_once('./views/pages/login/login.php');
		}

        public function accesUser() {
            if (isset($_POST['txtUsername']) && $_POST['txtUsername'] != '' && isset($_POST['txtPassword']) && $_POST['txtPassword'] != '') {

		        session_start();

                $fields = array(
                    "username_user" => $_POST['txtUsername'],
                    "password_user" => isset($_POST['txtPassword']) ? $_POST['txtPassword'] : ''
                );

                $response = LoginModel::login($fields);

                if($response['status'] == 202){
                    $_SESSION['userData'] = $response;
                    header('Location: home');
                }else{
                    echo '<div class="alert alert-danger alert-dismissible text-white" role="alert">
                    <span class="text-sm">Wrong User or Password.</span>
                    </div>';
                }
            }
        }
    
        public function signOut() {
            session_start();
            session_destroy();
            header('Location: login');
        }

        public function Error404(){
            require_once('./views/pages/404/404.php');
        }
		
    }
    