<?php


$data['login'] = array(
	'model' => 'LoginModel',
	'view' => 'login',
	'controller' => 'LoginController',
);

$data['sign-up'] = array(
	'model' => 'LoginModel',
	'view' => 'singup',
	'controller' => 'LoginController',
);

$data['profile'] = array(
	'model' => 'ProfileModel',
	'view' => 'profile',
	'controller' => 'ProfileController',
);

$data['404'] = array(
	'model' => 'TemplateModel',
	'view' => 'Error404',
	'controller' => 'TemplateController',
);

$data['forbidden'] = array(
	'model' => 'TemplateModel',
	'view' => 'forbidden',
	'controller' => 'TemplateController',
);

$data['exit'] = array(
	'model' => 'TemplateModel',
	'view' => 'logout',
	'controller' => 'TemplateController',
);



if (isset($_SESSION['userData']['su_user'])) {
	$data['users'] = array(
		'model' => 'UsersModel',
		'view' => 'users',
		'controller' => 'UsersController',
	);

	$data['roles'] = array(
		'model' => 'RolesModel',
		'view' => 'roles',
		'controller' => 'RolesController',
	);

	$data['pages'] = array(
		'model' => 'PagesModel',
		'view' => 'pages',
		'controller' => 'PagesController',
	);
}

$db = DBConexion::connection();
$allowAccess = "";

if(isset($_SESSION['userData']['su_user'])){
	if ($_SESSION['userData']['su_user'] != 1) {
	
		$namePage  = $page;
		$idUser  = $_SESSION['userData']['id_user'];
	
		$stmt = $db->prepare("CALL Permissions_validation(?, ?, ?, @countMatches)");
		$stmt->bind_param("sii", $namePage, $idPage, $idUser);
		$stmt->execute();
		$stmt->close();
	
		// Obtener el resultado del procedimiento almacenado
		$result_permission = $db->query("SELECT @countMatches AS countMatches");
		$data_permission = $result_permission->fetch_assoc();
		$countMatches = $data_permission['countMatches'];
	
		// Verificar el resultado
		if ($countMatches > 0) {
			$allowAccess = true;
		} else {
			$allowAccess = false;
		}
	
		// Cerrar la conexión a la base de datos
		$db->close();
	} else {
		$allowAccess = true;
	}
}
