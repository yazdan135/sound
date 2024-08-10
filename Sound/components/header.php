<?php
include("./config/connection.php");
include("./components/page_checker.php");
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sound</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="shortcut icon" href="./logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .my-logo {
            gap: 4px;
        }

        .my-logo span {
            font-size: 25px;
            font-weight: 700;
            color: white;
        }

        .my-btn {
            border-radius: 20vw;
            padding: .5rem 1rem;
            background-color: #3C3D55;
        }

        .my-btn-hover {
            cursor: pointer;
        }

        .my-btn-hover:hover {
            background-color: #636472;
        }

        .my-btn-active {
            background-color: white !important;
            color: #0B0C2A !important;
        }

        .my-btn-active:hover {
            background-color: #cccccc !important;
            color: #0B0C2A !important;
        }

        .tag {
            list-style: none !important;
            font-size: 10px !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            padding: 1px 10px !important;
            background: #3C3D55 !important;
            border-radius: 50px !important;
            display: inline-block !important;
        }

        .controls {
            width: 100%;
            height: 20vw;
            background-color: #1D1E39;
            border-radius: 10px;
            margin: 10px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .title-tag {
            list-style: none !important;
            font-size: 10px !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            padding: 1px 10px !important;
            background: rgba(255, 255, 255, 0.2) !important;
            border-radius: 50px !important;
            display: inline-block !important;
            font-size: 1.4vw !important;
            margin-bottom: 30px;
        }

        .bar {
            text-align: center;
            width: 80%;
        }

        .bar-progress {
            height: 4px;
            border-radius: 30px;
            background-color: #474869;
            margin: auto;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .bar-progress-active {
            width: 0;
            height: 100%;
            background-color: white;
        }

        .bar-time {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 4px;
        }

        .control-btns {
            align-items: center;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .controls .control-btn {
            border-radius: 50%;
            width: 5vw;
            aspect-ratio: 1/1 !important;
            outline: none;
            background-color: white;
            color: #0B0C2A !important;
            color: white;
            font-size: 2vw;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .controls .control-btn:hover {
            background-color: #cccccc !important;
            color: #0B0C2A !important;
        }

        .controls .control-btn:nth-last-child(1),
        .controls .control-btn:nth-child(1) {
            width: 4vw;
            height: 4vw;
        }

        .disabled-btn {
            background-color: #858585 !important;
        }

        .login-btn {
            border-radius: 10px;
            color: white;
            outline: none;
            border: none;
            padding: .5rem 1rem;
            background-color: #E53637;
        }

        .login-btn:hover {
            background-color: #ff6f70;
        }

        .admin-btn {
            border-radius: 10px;
            color: white;
            outline: none;
            border: none;
            padding: .5rem 1rem;
            background-color: #3d3f78;
        }

        .admin-btn:hover {
            background-color: #545587;
        }

        .search-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: black;
            justify-content: center;
            align-items: center;
        }

        .search-close-btn {
            display: flex;
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2vw;
            color: white;
            background-color: #333333;
            cursor: pointer;
            width: 4vw;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1/1;
            border-radius: 50%;
        }

        .search-form input {
            outline: none;
            border: none;
            background-color: transparent;
            border-bottom: 2px solid #333333;
            padding: 10px;
            color: white;
        }

        .search-form button {
            background-color: #333333;
            border: 2px solid #333333;
            border-radius: 10px;
            padding: 10px 15px;
        }

        .search-icon {
            background-color: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 1.2rem;
        }

        .product__item__pic {
            position: relative;
            overflow: hidden;
        }
        
        .product__item__pic:hover .hover-elem {
            opacity: 1;
        }

        .product__item__pic:hover .hover-elem a {
            transform: translateY(-10px);
        }

        .hover-elem {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #00000085;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 70px;
            font-size: 1.5rem;
            opacity: 0;
            transition: .2s ease-in-out all;
        }

        .hover-elem a {
            padding: 10px 20px;
            border-radius: 10px;
            outline: none;
            border: none;
            background-color: #3d3f78;
            color: white;
            transform: translateY(10px);
            transition: .1s ease-in-out all;
        }

        .hover-elem a:hover {
            background-color: #545587;
            scale: 1.1;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div class="search-modal">
        <div class="search-close-btn" onclick="this.parentElement.style.display='none'"><i class="icon_close"></i></div>
        <form class="search-form" method="GET" action="./<?php echo $_SESSION["page"]; ?>.php">
            <input type="text" placeholder="Search..." name="search_input">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="./index.php" class="d-flex align-items-center my-logo">
                            <img src="./logo.png" height="40px" alt=""> <span class="">SOUND</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="<?php checkPage('index'); ?>"><a href="./index.php">Homepage</a></li>
                                <li class="<?php checkPage('categories'); ?>"><a href="./categories.php">Categories</a></li>
                                <li class="<?php checkPage('songs'); ?>"><a href="./songs.php">Songs</a></li>
                                <li class="<?php checkPage('videos'); ?>"><a href="./videos.php">Videos</a></li>
                                <li class="<?php checkPage('favourites'); ?>"><a href="./favourites.php">Favourites</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right d-flex align-items-center justify-content-end" style="gap: 10px;">
                        <?php if ("songs" == $_SESSION["page"] or "videos" == $_SESSION["page"]) { ?>
                            <button onclick="document.querySelector('.search-modal').style.display='flex'" class="search-icon" style="margin: 0;"><span class="icon_search"></span></button>
                        <?php } ?>
                        <?php if (isset($_SESSION['admin'])) { ?>
                            <a href="./admin/index.php" style="margin: 0;">
                                <button class="admin-btn">Admin</button>
                            </a>
                        <?php } ?>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <a href="./logout.php" style="margin: 0;">
                                <button class="login-btn">Logout</button>
                            </a>
                        <?php } else { ?>
                            <a href="./login.php" style="margin: 0;">
                                <button class="login-btn">Login</button>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->