<?php
    require_once "config/connection.php";

	class IncludesModel{

		static public function MenuSidebar()
		{
			 // Utiliza la función connection de la clase DBConexion
			 $db = DBConexion::connection();
	
			 // Consulta para obtener la información del menu
			 $sql = "SELECT * FROM paginas WhERE id_parent_pagina = 0 ORDER BY orden_pagina";
			 $result = $db->query($sql);

			 $sqlSubMenu = "SELECT * FROM paginas WhERE id_parent_pagina != 0 ORDER BY orden_pagina";
			 $resultSubMenu = $db->query($sqlSubMenu);
	
			 if ($result->num_rows > 0) {
				 // Inicializar un array para almacenar los resultados
				$data = array();
				$datasubMenu = array();
	
				// Procesar los resultados
				if ($result->num_rows > 0) {
					// Almacenar cada fila en el array
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
				 // Usuario no encontrado
				 echo "Error.";
			 }
		}

        
	}
