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
