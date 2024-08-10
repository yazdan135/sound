<?php
session_start();
include("../config/connection.php");
include("./components/login_checker.php");

$username = $_SESSION["admin"];
$sql_admin_profile = "SELECT * FROM users WHERE username='$username'";
$result_admin_profile = mysqli_fetch_assoc(mysqli_query($conn, $sql_admin_profile));

$full_name = $result_admin_profile["full_name"];
$email = $result_admin_profile["email"];
$profile_pic = $result_admin_profile["profile_pic"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sound-Admin</title>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="../logo.png" type="image/x-icon">
    <!-- Vector CSS -->
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- simplebar CSS-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="assets/css/sidebar-menu.css" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet" />
    <!-- My Style-->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-theme bg-theme1">

    <!-- Start wrapper-->
    <div id="wrapper">
        <!--Start sidebar-wrapper-->
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
            <div class="brand-logo">
                <a href="index.php" style="display: flex; align-items: center; justify-content: center;">
                    <img src="../logo.png" class="logo-icon" alt="logo icon">
                    <h5 class="logo-text">SOUND</h5>
                </a>
            </div>
            <ul class="sidebar-menu do-nicescrol">
                <li class="sidebar-header">MAIN NAVIGATION</li>
                <li>
                    <a href="./index.php">
                        <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="./category_show.php">
                        <i class="fa-solid fa-table-list"></i> <span>Categories</span>
                    </a>
                </li>

                <li>
                    <a href="./songs_show.php">
                        <i class="fa-solid fa-music"></i> <span>Songs</span>
                    </a>
                </li>

                <li>
                    <a href="./videos_show.php">
                        <i class="fa-solid fa-video"></i> <span>Videos</span>
                    </a>
                </li>

                <li>
                    <a href="./users_show.php">
                        <i class="fa-solid fa-user"></i> <span>Users</span>
                    </a>
                </li>

                <li>
                    <a href="./banned_users_show.php">
                        <i class="fa-solid fa-user-slash"></i> <span>Banned Users</span>
                    </a>
                </li>

                <li class="sidebar-header">User Panel</li>
                <li><a href="../index.php"><i class="zmdi zmdi-coffee text-danger"></i> <span>User Panel</span></a></li>
            </ul>

        </div>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="icon-menu menu-icon"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            <span class="user-profile"><img src="../images/<?php echo $profile_pic; ?>" class="img-circle" alt="user avatar"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar"><img class="align-self-start mr-3" src="../images/<?php echo $profile_pic; ?>" alt="user avatar"></div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title"><?php echo $full_name; ?></h6>
                                            <p class="user-subtitle"><?php echo $email; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!--End topbar header-->