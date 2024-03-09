<?php

require_once 'config/connection.php';

$page = $_GET['page'];

/* This code is checking if the variable $page is not empty. If it is not empty, it performs the
following actions: */
if (!empty($page)) {
        session_start();

        $db = DBConexion::connection();

        $sql = "SELECT urlpage_page FROM pages";
        
        $result = $db->query($sql);

		$data = array();

        require_once 'allowAccess.php';

        if($allowAccess){
            /* This code is responsible for dynamically mapping the requested page to its corresponding
            model, view, and controller. */
            if ($result->num_rows > 0) {
                foreach ($result as $row) {
    
                    $urlpage_page = $row["urlpage_page"]; 
    
                    $data[$urlpage_page] = array(
                        'model' => ucfirst($urlpage_page).'Model', 
                        'view' => $urlpage_page,
                        'controller' => ucfirst($urlpage_page).'Controller',
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
                    // header('Location: 404');
            }
        }else{
            include'./views/pages/forbidden/forbidden.php';
        }
} else {
	header('Location: login');
}