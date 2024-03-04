<?php
$base_path = "/portafolio/project-manager/views";
require_once "controllers/includesController.php";


$InfoUser = new IncludesController();
$arrayNavbar = $InfoUser->MenuSidebar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Gestor-MVC
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="<?php echo $base_path; ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?php echo $base_path; ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="<?php echo $base_path; ?>/assets/css/dataTables.dataTables.min.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="<?php echo $base_path; ?>/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
  <style>
    /* Estilo para hacer la imagen redonda y pequeña */
    .user-icon {
      border-radius: 50%;
      width: 30px; /* Ajusta el tamaño según tus necesidades */
      height: 30px; /* Ajusta el tamaño según tus necesidades */
      object-fit: cover; /* Ajusta la forma de ajustar la imagen dentro del contenedor */
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php if($_GET['page'] != 'sign-up' AND $_GET['page'] != 'login'): ?>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="home">
        <img src="<?php echo $base_path; ?>/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Gestor MVC</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <?php
          if(isset($_SESSION['userData']['su_user'])){
            $usersArray = array(
              'id_pagina'=> '',
              'nombre_pagina'=> 'Users',
              'urlpagina_pagina'=> 'users',
              'clase_pagina'=> 'fas fa-users',
              'id_parent_pagina'=> '',
              'catalogo_pagina'=> '',
            );
    
            $rolesArray = array(
              'id_pagina'=> '',
              'nombre_pagina'=> 'Roles',
              'urlpagina_pagina'=> 'roles',
              'clase_pagina'=> 'fas fa-user-tag',
              'id_parent_pagina'=> '',
              'catalogo_pagina'=> '',
            );
    
            $pagesArray = array(
              'id_pagina'=> '',
              'nombre_pagina'=> 'Pages',
              'urlpagina_pagina'=> 'pages',
              'clase_pagina'=> 'fas fa-bars',
              'id_parent_pagina'=> '',
              'catalogo_pagina'=> '',
            );
    
            $arrayNavbar[] = $usersArray;
            $arrayNavbar[] = $rolesArray;
            $arrayNavbar[] = $pagesArray;
          }
          foreach ($arrayNavbar as $pagina) {
            $idPagina = $pagina['id_pagina'];
            $nombrePagina = $pagina['nombre_pagina'];
            $urlPagina = $pagina['urlpagina_pagina'];
            $clasesPagina = $pagina['clase_pagina'];
            $idParentPagina = $pagina['id_parent_pagina'];
            $catalogoPagina = $pagina['catalogo_pagina'];

            if ($_GET['page'] == $urlPagina) {
              $active = 'active';
            } else {
              $active = '';
            }

            if($nombrePagina == 'Users'){
              echo '<li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Settings</h6>
                  </li>';
            }

            echo '<li class="nav-item">';
              echo '<a class="nav-link text-white ' . $active . '" href="' . $urlPagina . '">';
                echo '<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">';
                  echo '<i class="' . $clasesPagina . '"></i>';
                echo '</div>';
                echo '<span class="nav-link-text ms-1">' . $nombrePagina . '</span>';
              echo '</a>';
            echo '</li>';
          }
        ?>
      </ul>
    </div>
  </aside>
  <?php endif ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <?php if($_GET['page'] != 'sign-up' AND $_GET['page'] != 'login'): ?>
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">

          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo ucfirst($_GET['page']) ?></li>
          </ol>
          <h6 class="font-weight-bolder mb-0"><?php echo ucfirst($_GET['page']) ?></h6>

        </nav>
        <!-- Alert -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

            <!-- <div class="input-group input-group-outline">
            </div> -->

          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- <i class="fas fa-user"></i> -->
                <img src="<?php echo $_SESSION['userData']['photo_user']  != '' ? './views/archives/profile_picture/'.$_SESSION['userData']['id_user'].'/'.$_SESSION['userData']['photo_user'] : './views/assets/img/userIcon.jpeg'?>" alt="" class="user-icon">
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="profile">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h4 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">Profile</span>
                        </h4>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="exit">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h4 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">Log Out</span>
                        </h4>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>

              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>
  <?php endif ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row min-vh-80 h-100">
        <div class="col-12">