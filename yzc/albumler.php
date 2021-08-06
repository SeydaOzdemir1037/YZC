<?php include "includes/header.php"; ?>

  <main id="main">
     <div class="container subpage">
     	<h3>Albümler</h3><hr>
        <div class="row galeri-container" data-aos="fade-up" data-aos-delay="100">
            <?php $albumler = $conn->albumler("");
            foreach ($albumler as $album) { ?>
                <div class="col-lg-3 col-md-6 galeri-item">
                    <a href="album.html?id=<?=$album['id']?>">
                        <img style="height: 200px;width: 250px" src="<?=$album['kapak']?>" class="img-fluid" alt="">
                    </a>
                    <span class="galeri-title"><b><?=$album['baslik']?> </b>- <?=$album['tarih']?></span>
                </div>
            <?php } ?>
        </div>     	  
     </div>
  </main><!-- End #main -->
<?php include "includes/footer.php"; ?>
