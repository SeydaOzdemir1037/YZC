<?php include "includes/header.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"]) || is_int($_GET["id"])) {
        header('Location: index.html');
        die();
    }
    $id = trim($_GET["id"]);
    $album = $conn->albumbul($id);
    if ($album == null) {
        header('Location: index.html');
        die();
    }
}

?>
  <main id="main">
     <div class="container subpage">
     	<h3>Fotoğraf Albümü - <?=$album['baslik']?></h3><hr>
         <?php
         foreach (glob("documents/albumler/" . $album['id'] . "/*.*") as $file) {
             $endimg = explode('/', $file);
             $link = "documents/" . $endimg[0] . "/" . $endimg[1] . "/" . $endimg[2];
             ?>
             <?php if (pathinfo($file, PATHINFO_EXTENSION) == "jpg" || pathinfo($file, PATHINFO_EXTENSION) == "jpeg" || pathinfo($file, PATHINFO_EXTENSION) == "png") { ?>

                 <a href="<?php echo $file; ?>" data-fancybox="gallery">
                     <img style="margin:10px 20px;" class="img-fluid" width="15%" src="<?php echo $file; ?>" alt=""/>
                 </a>

             <?php }
         } ?>


     </div>
  </main><!-- End #main -->
<?php include "includes/footer.php"; ?>
