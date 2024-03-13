<?php
require_once "config/connection.php";

class IncludesModel
{

	static public function MenuSidebar()
	{
		$db = DBConexion::connection();

		// Query to get main pages
		$sql = "SELECT * FROM pages WHERE id_parent_page = 0 AND status_page = 1 ORDER BY order_page";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();

		// Query to get submenus
		$sqlSubMenu = "SELECT * FROM pages WHERE id_parent_page != 0 AND status_page = 1 ORDER BY order_page";
		$stmtSubMenu = $db->prepare($sqlSubMenu);
		$stmtSubMenu->execute();
		$resultSubMenu = $stmtSubMenu->get_result();

		$data = array();
		$datasubMenu = array();

		// Get results from the main query
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}

		// Get results from the submenu query
		while ($rowSubMenu = $resultSubMenu->fetch_assoc()) {
			$datasubMenu[] = $rowSubMenu;
		}

		// Merge results
		$result = array_merge($data, $datasubMenu);

		return $result;
	}

	static public function userInfo($id_user)
	{
		$db = DBConexion::connection();

		// Query to fetch the user's photo
		$sql = "SELECT photo_user,name_user FROM users WHERE id_user = ?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param("i", $id_user); // Bind the parameter to avoid SQL injection
		$stmt->execute();
		$result = $stmt->get_result();

		return $result->fetch_assoc();
	}
}
