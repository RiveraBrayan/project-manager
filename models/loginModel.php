<?php

	// require_once realpath(dirname(__FILE__)."/../") . '/'."controllers/templateController.php";
    require_once "config/connection.php";

	class LoginModel{

		static public function login($fields){
			if (isset($fields['username_user']) && isset($fields['password_user']) && !empty($fields['username_user']) && !empty($fields['password_user'])){
				$username_user = $fields['username_user'];
				$password_user = $fields['password_user'];
			
				$db = DBConexion::connection();
			
				
				//Preparing a 
				$stmt = $db->prepare("SELECT id_user, name_user, password_user, username_user, photo_user, su_user FROM users WHERE username_user = ?");
				
				// Vincualte parameters
				$stmt->bind_param("s", $username_user);
				
				// Execute
				$stmt->execute();
				
				// Save results
				$result = $stmt->get_result();
			
				$data = array();
			
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
			
					if (password_verify($password_user, $row['password_user'])) {
						$data["status"] = 202;
						$data["id_user"] = $row['id_user'];
						$data["username_user"] = $row['username_user'];
						$data["photo_user"] = $row['photo_user'];
						$data["su_user"] = $row['su_user'];
			
						return $data;
					} else {
						$data["status"] = 404;
						return $data;
					}
				} else {
					$data["status"] = 505;
					return $data;
				}
			
				// statment and conecction close
				$stmt->close();
				$db->close();
			}
			
		}

        
	}
