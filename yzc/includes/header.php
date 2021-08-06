<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Yusuf Ziyaattin CENİK</title>
  <meta content="Yusuf ziyaattin CENİK kişisel web sitesi" name="description">
  <meta content="Yusuf ziyaattin Cenik, YARGITAY, Çaldıran Noteri, Genel Sekreter, Yargıtay Üyesi" name="keywords">

  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet" >
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>
  <header id="header">
    <div class="d-flex flex-column">
      <div class="profile">
        <img src="assets/img/profile-img.jpg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.html">Yusuf Ziyaattin CENİK</a></h1>
        <div class="social-links mt-3 text-center">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>
      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="#ana"><i class="bx bx-home"></i> <span>Ana Sayfa</span></a></li>
          <li><a href="index.html#hakkimda"><i class="bx bx-user"></i> <span>Hakkımda</span></a></li>
          <li><a href="index.html#anilar"><i class="bx bx-file-blank"></i> <span>Anılar</span></a></li>
          <li><a href="index.html#galeri"><i class="bx bx-book-content"></i> Albüm</a></li>
          <li><a href="index.html#yazilar"><i class="bx bx-file-blank"></i> Yazılar</a></li>
          <li><a href="index.html#iletisim"><i class="bx bx-envelope"></i> İletişim</a></li>
        </ul>
      </nav>
      <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>
    </div>
  </header>


<?php
require_once("DBController.php");
$conn = new DBController();
?>