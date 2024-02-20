<?php

	// require_once realpath(dirname(__FILE__)."/../") . '/'."controllers/templateController.php";
    require_once "config/connection.php";

	class AdminModel{

		static public function loginModel($fields){
			if (isset($fields['username_usuario']) && isset($fields['password_usuario']) && !empty($fields['username_usuario']) && !empty($fields['password_usuario'])){
				$username_usuario = $fields['username_usuario'];
				$password_usuario = $fields['password_usuario'];

				$db = DBConexion::connection();

				$sql = "SELECT id_usuario, nombre_usuario, password_usuario, username_usuario, rol_usuario FROM usuarios WHERE username_usuario = '$username_usuario'";
				
				$result = $db->query($sql);

                $data = array();

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
			
					if (password_verify($password_usuario, $row['password_usuario'])) {
                        $data["status"] = 202;
                        $data["id_usuario"] = $row['id_usuario'];
                        $data["username_usuario"] = $row['username_usuario'];
                        $data["rol_usuario"] = $row['rol_usuario'];

                        return $data;
					} else {
                        $data["status"] = 404;
                        return $data;
					}
				} else {
                    $data["status"] = 505;
                    return $data;
				}
			}
		}

        
	}
