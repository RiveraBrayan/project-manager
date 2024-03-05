<?php
   	require_once realpath(dirname(__FILE__) . '/../') . '/' . "config/connection.php";

	class PagesModel{
		
		static public function pagesTable()
		{
			$db = DBConexion::connection();

			$sql = 'SELECT * FROM pages';
	
			$stmt = $db->prepare($sql);
			
			$stmt->execute();
			
			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				$counter = 1;
				while ($row = $result->fetch_assoc()) {
					$id_page = $row['id_page'];
					$name_page = $row['name_page'];
					$clase_page = $row['clase_page'];

					$clase_page = "<span class='badge bg-gradient-info'><i class='$clase_page'></i></span>";

					$actions = "
					<div class='float-end'>
					<a type='button' href='pages&id=$id_page' class='btn btn-icon btn-2 btn-info'>
						<span class='btn-inner--icon'><i class='fas fa-edit'></i></span>
					</a>
					<button class='btn btn-icon btn-2 btn-danger deleteRegister' type='button' data-id='$id_page' data-table='pages' data-suffix='page' data-page='pages'>
						<span class='btn-inner--icon'><i class='fas fa-trash-alt'></i></span>
					</button>
				</div>
								";
	
					$data[] = array(
						"counter" => $counter,
						"name_page" => $name_page,
						"clase_page" => $clase_page,
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

        static public function pagesInfo($id_page)
		{

			$db = DBConexion::connection();

			$sql = "SELECT * FROM pages WHERE id_page = ?";
			$stmt = $db->prepare($sql);

			$stmt->bind_param("i", $id_page);

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

		static public function savePagesInfo($fields)
		{
			$db = DBConexion::connection();

			$id_rol = $fields['id'];
			$name_rol = $fields['txtRol'];
			$status_rol = $fields['checkboxActive'];

			if(isset($id_rol) && $id_rol != ''){

				$sql = "UPDATE pages SET name_rol = ?, status_rol = ? WHERE id_rol = ?";

				$stmt = $db->prepare($sql);

				$stmt->bind_param("sss", $name_rol, $status_rol, $id_rol);

				if ($stmt->execute()) {
					$arrayDatos = array('status' => 202, 'message'=> 'Data Updated');
				} else {
					$arrayDatos = array('status' => 404, 'message'=> 'Error');
				}
				
				$stmt->close();

			}else{

				$sql = "INSERT INTO pages (name_rol) 
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
