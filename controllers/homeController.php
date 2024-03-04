<?php
	require_once realpath(dirname(__FILE__) . '/../') . '/' . "models/homeModel.php";

	class HomeController{

		public function home(){
                  
                  if ( isset($_SESSION['userData']) && $_SESSION['userData']['status'] == '202') {
                        require_once('./views/includes/header.php');
                        require_once('./views/pages/home/home.php');
                        require_once('./views/includes/footer.php');
                  } else{
                        header('Location: login');
                        die();
                  }
		}

            public function userCard(){
                  echo HomeModel::userCard();
            }
            
		
    }
    
if (isset($_POST['action']) && $_POST['action'] === 'userCard') {
  $infoUsers = new HomeController();
  $infoUsers->userCard();
}