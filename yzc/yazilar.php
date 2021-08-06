<?php include "includes/header.php";
$limit=150;?>

  <main id="main">
     <div class="container subpage">
     	<h3>Yazılar</h3><hr>
        <div class="row yazilar">
        	<div class="col-12"><br></div>
            <?php $yazilar = $conn->yazilar("");
            foreach ($yazilar as $yazi) { ?>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                    <div class="icon"><img style="border-radius: 10%" width="100%" src="<?= $yazi['kapak'] ?>" alt=""></div>
                    <a href="yazi.html?id=<?=$yazi['id']?>">
                        <h4 class="title"><?=$yazi['baslik']?></h4>
                        <div class="description">
                            <?php if (strlen($yazi['yazi']) > 150) { ?>
                                <?= substr($yazi['yazi'], 0, $limit) ?>...
                            <?php } else { ?>
                                <?php echo $yazi['yazi'];
                            } ?>
                        </div>
                    </a>
                </div>
            <?php }?>
     </div>
  </main><!-- End #main -->
<?php include "includes/footer.php"; ?>
