<?php
   	require_once realpath(dirname(__FILE__) . '/../') . '/' . "config/connection.php";

	class UsersModel{
		
		static public function usersTable($fields)
		{

			$db = DBConexion::connection();

			$txtNameFilter = $fields['txtNameFilter'];
			$txtUsernameFilter = $fields['txtUsernameFilter'];
			$txtEmailFilter = $fields['txtEmailFilter'];
			$txtStatusUser = $fields['txtStatusUser'];

			$bindParams = array();
			$sqlWhere = "";

			if (isset($txtNameFilter) && $txtNameFilter != '') {
				$sqlWhere .= "AND name_user LIKE ? ";
				$bindParams[] = "%$txtNameFilter%";
			}

			if (isset($txtUsernameFilter) && $txtUsernameFilter != '') {
				$sqlWhere .= "AND username_user LIKE ? ";
				$bindParams[] = "%$txtUsernameFilter%";
			}

			if (isset($txtEmailFilter) && $txtEmailFilter != '') {
				$sqlWhere .= "AND email_user LIKE ? ";
				$bindParams[] = "%$txtEmailFilter%";
			}

			if (isset($txtStatusUser) && $txtStatusUser != '') {
				$status = "WHERE active_user = ?";
				$bindParams[] = $txtStatusUser;
			} else {
				$status = "WHERE active_user >= 0 ";
			}

			$sql = "SELECT * FROM users $status $sqlWhere";

			$stmt = $db->prepare($sql);

			if ($stmt) {

				if (!empty($bindParams)) {
					call_user_func_array(array($stmt, 'bind_param'), $bindParams);
				}

				$stmt->execute();

				$result = $stmt->get_result();

				if ($result->num_rows > 0) {
				
					$counter = 1;
					while ($row = $result->fetch_assoc()) {
						$id_user = $row['id_user'];
						$name_user = $row['name_user'];
						$username_user = $row['username_user'];
						$email_user = $row['email_user'];
						$deparment_user = $row['deparment_user'];
						$position_user = $row['position_user'];
						$actions = "
									<a type='button' href='users&id=$id_user' class='btn btn-icon btn-2 btn-info'>
										<span class='btn-inner--icon'><i class='fas fa-edit'></i></span>
									</a>
									<button class='btn btn-icon btn-2 btn-danger deleteRegister' type='button' data-id='$id_user' data-table='users' data-suffix='user' data-page='users'>
										<span class='btn-inner--icon'><i class='fas fa-trash-alt'></i></span>
									</button>
									";
	
						$data[] = array(
							"counter" => $counter,
							"name_user" => $name_user,
							"username_user" => $username_user,
							"email_user" => $email_user,
							"deparment_user" => $deparment_user,
							"position_user" => $position_user,
							"actions" => $actions
						);
	
						$counter++;
					}
	
					
					return $data;
				} else {
					$data = array();
					return $data;
				}

				$stmt->close();

			} else {
				echo "Error en la preparación de la consulta.";
			}

			

			$db->close();

		}

        static public function usersInfo($id_user)
		{

			$db = DBConexion::connection();

			$sql = "SELECT id_user, name_user, username_user, email_user, phone_user, deparment_user, position_user, su_user, active_user FROM users WHERE id_user = ?";
			$stmt = $db->prepare($sql);

			$stmt->bind_param("i", $id_user);

			$stmt->execute();

			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				$data = $result->fetch_assoc();
				$arrayDatos = array('status' => 202, 'JsonData' => $data);
			} else {
				$data = array();
				$arrayDatos = array('status' => 404, 'JsonData' => $data);
			}

			
			header("Content-Type: application/json; charset=UTF-8");
			echo json_encode($arrayDatos, JSON_PRETTY_PRINT);

			$stmt->close();
			$db->close();
		}

		static public function saveUsersInfo($fields)
		{
			$db = DBConexion::connection();

			if(isset($fields['id_user']) && $fields['id_user'] != ''){

				$id_user = $fields['id_user'];
				$username_user = $fields['username_user'];
				$name_user = $fields['name_user'];
				$email_user = $fields['email_user'];
				$phone_user = $fields['phone_user'];
				$deparment_user = $fields['deparment_user'];
				$position_user = $fields['position_user'];
				$active_user = $fields['checkbocActive'];

				$sql = "UPDATE users SET username_user = ?, name_user = ?, email_user = ?, phone_user = ?, deparment_user = ?, position_user = ?, active_user = ? WHERE id_user = ?";

				$stmt = $db->prepare($sql);

				$stmt->bind_param("ssssssss", $username_user, $name_user, $email_user, $phone_user, $deparment_user, $position_user, $active_user, $id_user);

				if ($stmt->execute()) {
					$arrayDatos = array('status' => 202, 'message'=> 'User Updated');
				} else {
					$arrayDatos = array('status' => 404, 'message'=> 'Error');
				}
				
				$stmt->close();

			}else{
				
				$username_user = $fields['username_user'];
				$password_user = $fields['password_user'];
				$password_user = password_hash($password_user, PASSWORD_BCRYPT);
				$name_user = $fields['name_user'];
				$email_user = $fields['email_user'];
				$phone_user = $fields['phone_user'];
				$deparment_user = $fields['deparment_user'];
				$position_user = $fields['position_user'];

				$sql = "INSERT INTO users (username_user,password_user,name_user,email_user,phone_user,deparment_user,position_user) 
				VALUES (?,?,?,?,?,?,?)";

				$stmt = $db->prepare($sql);

				$stmt->bind_param("sssssss", $username_user, $password_user, $name_user, $email_user, $phone_user, $deparment_user, $position_user);

				if ($stmt->execute()) {
					$arrayDatos = array('status' => 202, 'message'=> 'User Created');
				} else {
					$arrayDatos = array('status' => 404, 'message'=> 'Error');
				}

				$stmt->close();
			}
			
			header("Content-Type: application/json; charset=UTF-8");
			echo json_encode($arrayDatos, JSON_PRETTY_PRINT);

			
			$db->close();
		}
	}
