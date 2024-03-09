<?php
    require_once "config/connection.php";

	class TemplateModel{

		static public function usersAccess($fields)
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
				
			} else {
			}

			
			$stmt->close();
			$db->close();

		}

	}
