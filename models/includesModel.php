<?php
    require_once "config/connection.php";

	class IncludesModel{

		static public function MenuSidebar()
		{
			 $db = DBConexion::connection();
	
			 $sql = "SELECT * FROM pages WHERE id_parent_page = 0 AND status_page = 1 ORDER BY order_page";
			 $result = $db->query($sql);

			 $sqlSubMenu = "SELECT * FROM pages WHERE id_parent_page != 0 AND status_page = 1 ORDER BY order_page";
			 $resultSubMenu = $db->query($sqlSubMenu);

	
			 if ($result->num_rows > 0) {
				$data = array();
				$datasubMenu = array();
	
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$data[] = $row;
					}
					while ($rowSubMenu = $resultSubMenu->fetch_assoc()) {
						$datasubMenu[] = $rowSubMenu;
					}
					
					$resultado = array_merge($data, $datasubMenu);

					return $resultado;
				} else {
					echo "0 results";
				}
			 } else {
				 echo "Error.";
			 }
		}

        
	}
