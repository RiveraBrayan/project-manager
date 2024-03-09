<?php

	require_once realpath(dirname(__FILE__)."/../") . '/'."config/connection.php";

	class FunctionModel{

        static public function lastOrder($pages,$column,$where)
    	{
			
			$db = DBConexion::connection();

			$sql = "SELECT MAX(?) as lastValue FROM $pages WHERE $where";

			$stmt = $db->prepare($sql);
		
			$stmt->bind_param("s", $column);
			$stmt->execute();

			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				$fila = $result->fetch_assoc();

				$stmt->close();
				
				$db->close();

				return $fila['lastValue'] + 1;
			}
			
			$stmt->close();
			$db->close();
        
    	}

		static public function generateSelect($table,$select,$where,$whereTo)
		{
			// Establish a database connection
			$db = DBConexion::connection();

			// Use a prepared statement to avoid SQL injection
			$stmt = $db->prepare("SELECT $select FROM $table WHERE $where = ?");

			// Assuming $whereTo is a string, adjust "s" if it's a different type
			$stmt->bind_param("s", $whereTo);

			// Execute the query
			$stmt->execute();

			// Get the result set
			$result = $stmt->get_result();

			// Initialize the select options with a default option
			$selectOptions = "<option value=''>Choose an Option</option>";

			if ($result->num_rows > 0) {
				// Loop through each row in the result set
				while ($row = $result->fetch_assoc()) {
					// Extract data from the row
					$id = $row["id"];
					$value = $row["value"];
					$name = $row["name"];
			
					// Add an option to the select list
					$selectOptions .= "<option value='$value' data-id='$id'>$name</option>";
				}

				$arrayDatos = array('status' => 202, 'JsonData' => $selectOptions);
			}else{
				$arrayDatos = array('status' => 404, 'JsonData' => 'Error');
			}

			// Close the prepared statement
			$stmt->close();

			// Close the database connection
			$db->close();

			// Return the select options as a JSON-encoded string
		
			header("Content-Type: application/json; charset=UTF-8");
			echo json_encode($arrayDatos, JSON_PRETTY_PRINT);

		}

		static public function deleteRegister($id,$table,$suffix)
		{
			// Establish a database connection
			$db = DBConexion::connection();

			// Use a prepared statement to avoid SQL injection
			$stmt = $db->prepare("DELETE FROM $table WHERE id_$suffix = ?");

			if ($stmt === false) {
				// Check for errors in the preparation of the statement
				echo "Error in preparing statement: " . $db->error;
			} else {
				// Assuming $id is a string, adjust "s" if it's a different type
				$stmt->bind_param("s", $id);

				// Execute the query
				if ($stmt->execute()) {
					return 202;
				} else {
					return 404;
				}

				// Close the statement
				$stmt->close();
			}

			// Close the database connection
			$db->close();
			
		}
        
	}