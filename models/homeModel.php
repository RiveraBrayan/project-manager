<?php
   	require_once realpath(dirname(__FILE__) . '/../') . '/' . "config/connection.php";

	class HomeModel{

		static public function userCard()
		{

			$db = DBConexion::connection();

			$sql = "SELECT count(id_user) as total_user FROM users";

			$stmt = $db->prepare($sql);

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

        
	}
