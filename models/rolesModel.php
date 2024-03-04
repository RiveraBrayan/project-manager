<?php
   	require_once realpath(dirname(__FILE__) . '/../') . '/' . "config/connection.php";

	class RolesModel{
		
		static public function rolesTable($fields)
		{
			$db = DBConexion::connection();

			$status_rol = $fields['status'];

			if($status_rol != ''){

				$sql = 'SELECT * FROM roles WHERE status_rol = ?';
	
				$stmt = $db->prepare($sql);
				
				$stmt->bind_param('i', $status_rol); 

			}else{

				$sql = 'SELECT * FROM roles';
	
				$stmt = $db->prepare($sql);
			}
			
			$stmt->execute();
			
			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				$counter = 1;
				while ($row = $result->fetch_assoc()) {
					$id_rol = $row['id_rol'];
					$name_rol = $row['name_rol'];
					$status_rol = $row['status_rol'] == 1 ? 'Active' : 'Inactive';
					$actions = "
								<a type='button' href='roles&id=$id_rol' class='btn btn-icon btn-2 btn-info'>
									<span class='btn-inner--icon'><i class='fas fa-edit'></i></span>
								</a>
								<button class='btn btn-icon btn-2 btn-danger deleteRegister' type='button' data-id='$id_rol' data-table='roles' data-suffix='rol' data-page='roles'>
									<span class='btn-inner--icon'><i class='fas fa-trash-alt'></i></span>
								</button>
								";
	
					$data[] = array(
						"counter" => $counter,
						"name_rol" => $name_rol,
						"status_rol" => $status_rol,
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
			$db->close();

		}

        static public function infoRoles($id_rol)
		{

			$db = DBConexion::connection();

			$sql = "SELECT * FROM roles WHERE id_rol = ?";
			$stmt = $db->prepare($sql);

			$stmt->bind_param("i", $id_rol);

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

		static public function saveRolesInfo($fields)
		{
			$db = DBConexion::connection();

			$id_rol = $fields['id'];
			$name_rol = $fields['txtRol'];
			$status_rol = $fields['checkboxActive'];

			if(isset($id_rol) && $id_rol != ''){

				$sql = "UPDATE roles SET name_rol = ?, status_rol = ? WHERE id_rol = ?";

				$stmt = $db->prepare($sql);

				$stmt->bind_param("sss", $name_rol, $status_rol, $id_rol);

				if ($stmt->execute()) {
					$arrayDatos = array('status' => 202, 'message'=> 'Data Updated');
				} else {
					$arrayDatos = array('status' => 404, 'message'=> 'Error');
				}
				
				$stmt->close();

			}else{

				$sql = "INSERT INTO roles (name_rol) 
				VALUES (?)";

				$stmt = $db->prepare($sql);

				$stmt->bind_param("s", $name_rol);

				if ($stmt->execute()) {
					$arrayDatos = array('status' => 202, 'message'=> 'Rol Created');
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
