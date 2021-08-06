<?php include "includes/header.php";
$limit = 150;
?>

<main id="main">
    <div class="container subpage">
        <h3>Anılar</h3>
        <hr>
        <div class="row yazilar">
            <div class="col-12"><br></div>
            <?php $anilar = $conn->anilar("");
            foreach ($anilar as $ani) { ?>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                    <div class="icon"><img style="border-radius: 10%" width="100%" src="<?= $ani['kapak'] ?>" alt=""></div>
                    <a href="ani.html?id=<?=$ani['id']?>">
                        <h4 class="title"><?=$ani['baslik']?></h4>
                        <div class="description">
                            <?php if (strlen($ani['ani']) > 150) { ?>
                                <?= substr($ani['ani'], 0, $limit) ?>...
                            <?php } else { ?>
                                <?php echo $ani['ani'];
                            } ?>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
</main><!-- End #main -->

<?php include "includes/footer.php"; ?>
