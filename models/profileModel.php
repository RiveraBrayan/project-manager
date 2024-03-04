<?php
require_once "config/connection.php";

class ProfileModel
{

	static public function userInfo($id_user)
	{

		$db = DBConexion::connection();

		$sql = "SELECT * FROM users WHERE id_user = ?";
		$stmt = $db->prepare($sql);

		$stmt->bind_param("i", $id_user);

		$stmt->execute();

		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$data = $result->fetch_assoc();
			return $data;
		} else {
			echo "Query failed.";
		}

		$stmt->close();
		$db->close();
	}

	static public function saveInfo($fields)
	{

		if (isset($fields['id_user']) && isset($fields['id_user'])) {
			$db = DBConexion::connection();

			$id_user = $fields['id_user'];
			$name_user = $fields['name_user'];
			$phone_user = $fields['phone_user'];
			$email_user = $fields['email_user'];
			$deparment_user = $fields['deparment_user'];
			$position_user = $fields['position_user'];

			$sql = "UPDATE users SET name_user = ?, phone_user = ?, email_user = ?, deparment_user = ?, position_user = ? WHERE id_user = ?";

			$stmt = $db->prepare($sql);

			$stmt->bind_param("ssssss", $name_user, $phone_user, $email_user, $deparment_user, $position_user, $id_user);

			if ($stmt->execute()) {
				return 202;
			} else {
				return 404;
			}

			$stmt->close();
			$db->close();
		} else {
			return 505;
		}
	}

	static public function changePhoto($fields)
	{
		if (isset($fields['id_user']) && isset($fields['id_user'])) {
			$db = DBConexion::connection();

			$id_user = $fields['id_user'];
			$photo_user = $fields['photo_user'];

			$sql = "UPDATE users SET photo_user = ? WHERE id_user = ?";

			$stmt = $db->prepare($sql);

			$stmt->bind_param("ss", $photo_user, $id_user);

			if ($stmt->execute()) {
				return 202;
			} else {
				return 404;
			}

			$stmt->close();
			$db->close();
		} else {
			return 505;
		}
	}

	static public function changePassword($fields)
	{
		$db = DBConexion::connection();
		$id_user = $fields['id_user'];
		$password_user = $fields['password_user'];
		$oldpassword_user = $fields['oldpassword_user'];

		// Prepared statement
		$sql = "SELECT password_user FROM users WHERE id_user = ?";
		$stmt = $db->prepare($sql);

		// Bind parameters
		$stmt->bind_param("i", $id_user);

		// Execute the query
		$stmt->execute();

		// Get the result
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$data = $result->fetch_assoc();
			if (password_verify($oldpassword_user,$data['password_user'])) {
				// Generate new hash for the new password
				$hash = password_hash($password_user, PASSWORD_BCRYPT);

				// Prepared statement for UPDATE
				$sql_update = "UPDATE users SET password_user = ? WHERE id_user = ?";
				$stmt_update = $db->prepare($sql_update);

				// Bind parameters for UPDATE
				$stmt_update->bind_param("si", $hash, $id_user);

				// Execute the UPDATE query
				$result_update = $stmt_update->execute();

				// Check if the UPDATE query was successful
				if ($result_update) {
					// Operation successful
					return 202;
				} else {
					// Error updating user information
					return 404;
				}

				// Close the UPDATE statement
				$stmt_update->close();
			} else {
				// Incorrect old password
				return 404;
			}
		} else {
			// User not found
			return 404;
		}

		// Close the SELECT statement and database connection
		$stmt->close();
		$db->close();
	}
}
