<?php

require_once 'config/connection.php';

$page = $_GET['page'];

/* This code is checking if the variable $page is not empty. If it is not empty, it performs the
following actions: */
if (!empty($page)) {
		
        $db = DBConexion::connection();

        $sql = "SELECT urlpagina_pagina FROM paginas";
        
        $result = $db->query($sql);

		$data = array();

        $data['login'] = array(
            'model' => 'AdminModel', 
            'view' => 'login',
            'controller' => 'AdminController',
        );

        $data['profile'] = array(
            'model' => 'ProfileModel', 
            'view' => 'profile',
            'controller' => 'ProfileController',
        );

        $data['404'] = array(
            'model' => 'AdminModel', 
            'view' => 'Error404',
            'controller' => 'AdminController',
        );

        /* This code is responsible for dynamically mapping the requested page to its corresponding
        model, view, and controller. */
        if ($result->num_rows > 0) {
            foreach ($result as $row) {

                $urlpagina_pagina = $row["urlpagina_pagina"]; 

                $data[$urlpagina_pagina] = array(
                    'model' => ucfirst($urlpagina_pagina).'Model', 
                    'view' => $urlpagina_pagina,
                    'controller' => ucfirst($urlpagina_pagina).'Controller',
                );
            }
        }
    
        foreach($data as $key => $components) {
            if ($page == $key) {
                $model = $components['model'];
                $view = $components['view'];
                $controller = $components['controller'];
                break;
            }
        }
        
        if (file_exists('controllers/'.$controller.'.php')) {
            require_once 'controllers/'.$controller.'.php';
            $objeto = new $controller();
            $objeto->$view();
        }else{
                header('Location: 404');
        }
} else {
	header('Location: login');
}