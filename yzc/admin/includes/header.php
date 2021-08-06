<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yönetici Paneli</title>

    <!-- Custom fonts for this template-->
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/css/cropit.css" rel="stylesheet">
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/css/style.css" rel="stylesheet">


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-text mx-3">Yönetici Paneli</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/index2.php">
                <i class="fas fa-fw fa-info"></i>
                <span>Hakkımda</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#anilar"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-file"></i>
                <span>Anılar</span>
            </a>
            <div id="anilar" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/anilar/ekle.php">Anı Ekle</a>
                    <a class="collapse-item" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/anilar/guncelle.php">Anı Ara/Güncelle</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#albumler"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-book"></i>
                <span>Albümler</span>
            </a>
            <div id="albumler" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/albumler/ekle.php">Albüm Ekle</a>
                    <a class="collapse-item" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/albumler/guncelle.php">Albüm Ara/Güncelle</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#yazilar"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-file-signature"></i>
                <span>Yazılar</span>
            </a>
            <div id="yazilar" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/yazilar/ekle.php">Yazı Ekle</a>
                    <a class="collapse-item" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/yazilar/guncelle.php">Yazı Ara/Güncelle</a>
                </div>
            </div>
        </li>

<!--        <li class="nav-item ">-->
<!--            <a class="nav-link" href="index.html">-->
<!--                <i class="fas fa-fw fa-mail-bulk"></i>-->
<!--                <span>İletişim</span></a>-->
<!--        </li>-->


        <!-- Sidebar Toggler (Sidebar) -->
        <!--        <div class="text-center d-none d-md-inline">-->
        <!--            <button class="rounded-circle border-0" id="sidebarToggle"></button>-->
        <!--        </div>-->


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a style="color: black"
                               href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/password.php"
                               class="dropdown-item">Şifre Değiştir</a>
                            <a style="color: black"
                               href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/logout.php"
                               class="dropdown-item">Çıkış Yap</a>
                        </div>
                    </li>
                </ul>
            </nav>

<?php $conn = new DBController(); ?>