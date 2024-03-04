<?php
require_once realpath(dirname(__FILE__) . '/../') . '/' . "models/profileModel.php";
require_once realpath(dirname(__FILE__) . '/../') . '/' . "controllers/functionsController.php";

class ProfileController{

      public function showNotification($response, $successMessage, $errorMessage){
            echo "<script>";
                  if ($response == 202) {
                  echo "Swal.fire({
                              title: 'Success!',
                              text: '$successMessage',
                              type: 'success'
                              }).then(function() {
                              window.location = 'profile';
                              });";
                  } elseif ($response == 404) {
                  echo "Swal.fire({
                              icon: 'error',
                              title: 'Error!',
                              text: '$errorMessage'
                              }).then(function() {
                              window.location = 'profile';
                              });";
                  } else {
                  echo "Swal.fire({
                              icon: 'error',
                              title: 'Error!',
                              text: '$errorMessage'
                              }).then(function() {
                              window.location = 'profile';
                              });";
                  }
            echo "</script>";
            exit();
      }
      
      public function profile(){
            if ( isset($_SESSION['userData']) && $_SESSION['userData']['status'] == '202') {
                  require_once('./views/includes/header.php');
                  require_once('./views/pages/profile/profile.php');
                  require_once('./views/includes/footer.php');
            } else{
                  header('Location: login');
                  die();
            }
      }

      public function userInfo(){
            $id_user = $_SESSION['userData']['id_user'];
            return ProfileModel::userInfo($id_user);
      }

      public function saveInfo(){
            $fields = array(
                  "id_user" => $_POST['txtId'],
                  "name_user" => $_POST['txtName'],
                  "phone_user" => $_POST['txtPhone'],
                  "email_user" => $_POST['txtEmail'],
                  "deparment_user" => $_POST['txtDeparment'],
                  "position_user" => $_POST['txtPosition']
            );
            
            $response = ProfileModel::saveInfo($fields);

            $this->showNotification($response, 'Data saved successfully!', 'Error with the process!');
      }

      public function changePhoto(){
            if(isset($_POST["txtId"]) && isset($_FILES['file_profile']["tmp_name"]) && !empty($_FILES['file_profile']["tmp_name"])){
                  $documento = $_FILES['file_profile'];
                  $folder = "profile_picture";
                  $path = $_POST["txtId"];
                  $name = uniqid('DOC_');
                  $extArchivo = pathinfo($_FILES['file_profile']['name'], PATHINFO_EXTENSION);

                  $saveFile = FunctionsController::saveFile($documento, $folder, $path, $name, $extArchivo);

                  if($saveFile != "error"){
                        $fields = array(
                              "id_user" => $_POST["txtId"],
                              "photo_user" => $saveFile,
                        );

                        $response = ProfileModel::changePhoto($fields);

                        $this->showNotification($response, 'Data saved successfully!', 'Error with the process!');

                  }

            }
      }

      public function changePassword(){
            if(isset($_POST['txtId']) && $_POST['txtId'] != '' && isset($_POST['txtOldPassword']) &&  $_POST['txtOldPassword'] != '' && isset($_POST['txtNewPassword']) &&  $_POST['txtNewPassword'] != '' && isset($_POST['txtRNewPassword']) &&  $_POST['txtRNewPassword'] != ''){
                  if($_POST['txtNewPassword'] != $_POST['txtRNewPassword']){
                        $this->showNotification(404, 'Data saved successfully!', 'The passwords are differents!');
                  }

                  if($_POST['txtOldPassword'] === $_POST['txtNewPassword'] OR $_POST['txtOldPassword'] === $_POST['txtRNewPassword']){
                        $this->showNotification(404, 'Data saved successfully!', 'The new password can be equal to the old!');
                  }
              
                  $fields = array(
                        "id_user" => isset($_POST['txtId']) ? $_POST['txtId'] : "",
                        "oldpassword_user" => isset($_POST['txtOldPassword']) ? $_POST['txtOldPassword'] : "",
                        "password_user" => isset($_POST['txtNewPassword']) ? $_POST['txtNewPassword'] : "",
                  );
            
                  $response = ProfileModel::changePassword($fields);
                  
                  $this->showNotification($response, 'Password changed successfully!', 'Error with the process!');  

            }else{
                  $this->showNotification(404, 'Data saved successfully!', 'No Empty Inputs');    
            }       
      }       
}