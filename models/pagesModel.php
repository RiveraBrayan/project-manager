<?php
require_once realpath(dirname(__FILE__) . '/../') . '/' . "config/connection.php";

class PagesModel
{

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
					<div >
					<a type='button' href='pages&edition=$id_page' class='btn btn-icon btn-2 btn-info'>
						<span class='btn-inner--icon'><i class='fas fa-edit'></i></span>
					</a>
					<a type='button' href='pages&roles=$id_page' class='btn btn-icon btn-2 btn-success'>
						<span class='btn-inner--icon'><i class='fas fa-user-tag'></i></span>
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

		$id_page = $fields['txtId'];
		$name_page = $fields['txtName'];
		$urlpage_page = $fields['txtUrl'];
		$clase_page = $fields['txtIcon'];
		$status_page = $fields['checkboxActive'];


		$arrayDatos = array('status' => 404, 'message' => $fields);


		if (isset($id_page) && $id_page != '') {

			$sql = "UPDATE pages SET name_page = ?, urlpage_page = ?, clase_page = ?, status_page = ? WHERE id_page = ?";

			$stmt = $db->prepare($sql);

			$stmt->bind_param("sssss", $name_page, $urlpage_page, $clase_page, $status_page, $id_page);

			if ($stmt->execute()) {
				$arrayDatos = array('status' => 202, 'message' => 'Data Updated');
			} else {
				$arrayDatos = array('status' => 404, 'message' => 'Error');
			}

			$stmt->close();
		} else {

			$sql = "INSERT INTO pages (name_page,urlpage_page,clase_page,status_page) 
				VALUES (?,?,?,?)";

			$stmt = $db->prepare($sql);

			$stmt->bind_param("ssss", $name_page, $urlpage_page, $clase_page, $status_page);

			if ($stmt->execute()) {
				$arrayDatos = array('status' => 202, 'message' => 'Page Created');
			} else {
				$arrayDatos = array('status' => 404, 'message' => 'Error');
			}

			$stmt->close();
		}

		header("Content-Type: application/json; charset=UTF-8");
		echo json_encode($arrayDatos, JSON_PRETTY_PRINT);


		$db->close();
	}

	static public function rolesTable($fields)
	{

		$db = DBConexion::connection();

		$id_page = $fields['id_page'];

		$sql = "SELECT pp.id_permission, r.name_rol FROM page_permissions pp INNER JOIN pages p ON pp.id_page = p.id_page INNER JOIN roles r ON pp.id_rol = r.id_rol WHERE p.id_page = ?";

		$stmt = $db->prepare($sql);

		$stmt->bind_param("i", $id_page);

		if ($stmt) {

			$stmt->execute();

			$result = $stmt->get_result();

			if ($result->num_rows > 0) {

				$counter = 1;
				while ($row = $result->fetch_assoc()) {
					$id_permission = $row['id_permission'];
					$name_rol = $row['name_rol'];
					$actions = "
									<button class='btn btn-icon btn-2 btn-danger deleteRegister' type='button' data-id='$id_permission' data-table='page_permissions' data-suffix='permission' data-page='pages&roles=$id_page'>
										<span class='btn-inner--icon'><i class='fas fa-trash-alt'></i></span>
									</button>
									";

					$data[] = array(
						"counter" => $counter,
						"name_rol" => $name_rol,
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

	static public function saveRolesinfo($fields)
	{
		$db = DBConexion::connection();

		$id_page = $fields['id_page'];
		$id_rol = $fields['id_rol'];

		$sql = "INSERT INTO page_permissions (id_page, id_rol) 
			VALUES (?,?)";

		$stmt = $db->prepare($sql);

		$stmt->bind_param("ss", $id_page, $id_rol);

		if ($stmt->execute()) {
			$arrayDatos = array('status' => 202, 'message' => 'Assigned Role');
		} else {
			$arrayDatos = array('status' => 404, 'message' => 'Error');
		}

		$stmt->close();


		header("Content-Type: application/json; charset=UTF-8");
		echo json_encode($arrayDatos, JSON_PRETTY_PRINT);


		$db->close();
	}
}
